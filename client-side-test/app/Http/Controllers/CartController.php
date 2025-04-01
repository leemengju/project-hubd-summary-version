<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductMain;
use App\Models\ProductSpec;
use App\Models\Coupons;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;



class CartController extends Controller

{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', '請先登入');
        }
        return view('cart');
    }
    public function getCartData()
    {
        // 驗證用戶是否已登入
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', '請先登入');
        }
        
        $userId = Auth::id();
        
        // 獲取所有符合用戶ID的購物車條目
        $cartItems = Cart::where('id', $userId)->get();
       
        // 拼裝資料
        $productData = [];

        foreach ($cartItems as $cartItem) {
            // 獲取與 cart 表中 product_id 匹配的產品資訊
           $productSpec = ProductSpec::where('product_id', $cartItem->product_id)->first();
            $productMain = ProductMain::where('product_id', $cartItem->product_id)->first();
          
           
            $productData[] = [
                'product_img' => $productMain ? $productMain->product_img : null,
                'product_stock' => $productMain ? $productSpec->product_stock : null,
                'product_name' => $cartItem->product_name,
                'product_size' => $productSpec ? $productSpec->product_size : null,
                'product_color' => $productSpec ? $productSpec->product_color : null,
                'quantity' => $cartItem->quantity,
                'product_price' => $productMain ? $productMain->product_price : null,
                'product_id' => $cartItem->product_id,
                'cart_id' => $cartItem->id
            ];
             // 返回資料

        }
        // view('cart');
        return 
        response()->json([
            'success' => true,
            'user_id' => $userId,
            'cart_items' => $productData

        ]);
    }// end of getCartData

    public function insertCart(Request $request)
    {
        try {
            $isAccessory = str_starts_with($request->product_id, 'pa');

            $data = $request->validate([
                'product_id' => 'required|string',
                'product_color' => $isAccessory ? 'nullable' : 'required|string',
                'product_size' => $isAccessory ? 'nullable' : 'required|string',
                'quantity' => 'required|integer|min:1',
            ]);

            $userId = Auth::id();
          
            if (!$userId) {
                return response()->json(['error' => '請先登入以加入購物車'], 401);
            }

            $existing = DB::table('cart')
                ->where('id', $userId)
                ->where('product_id', $data['product_id'])
                ->where('product_color', $data['product_color'])
                ->where('product_size', $data['product_size'])
                ->first();

            if ($existing) {
                DB::table('cart')
                    ->where('id', $userId)
                    ->where('product_id', $data['product_id'])
                    ->where('product_color', $data['product_color'])
                    ->where('product_size', $data['product_size'])
                    ->update([
                        'quantity' => $existing->quantity + $data['quantity'],
                        'updated_at' => now(),
                    ]);
            } else {
                DB::table('cart')->insert([
                    'id' => $userId,
                    'product_id' => $data['product_id'],
                    'product_name' => ProductMain::where('product_id', $data['product_id'])->value('product_name'),
                    'product_color' => $data['product_color'],
                    'product_size' => $data['product_size'],
                    'quantity' => $data['quantity'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return response()->json(['message' => '購物車更新成功！'], 200);

        } catch (\Throwable $e) {
            return response()->json(['error' => 'Server error', 'message' => $e->getMessage()], 500);
        }
    }

    public function updateCart(Request $request)
    {
        // 確保請求不是空的
        $cartData = $request->json()->all();

        if (empty($cartData)) {
            return response()->json(['message' => '無效的請求！'], 400);
        }

        // 解析請求數據
        $productId = $cartData['product_id'] ?? null;
        $quantity = $cartData['quantity'] ?? null;
        $productSize = $cartData['product_size'] ?? null;
        $productColor = $cartData['product_color'] ?? null;

        if (!$productId || !$quantity || !$productSize || !$productColor) {
            return response()->json(['message' => '缺少必要參數！'], 400);
        }

        // 更新資料庫
        $updated = DB::table('cart')
            ->where('product_id', $productId)
            ->update([
                'quantity' => $quantity,
                'product_size' => $productSize,
                'product_color' => $productColor
            ]);

        if ($updated) {
            return response()->json(['message' => '購物車更新成功！'], 200);
        } else {
            return response()->json(['message' => '購物車更新失敗或無變更！'], 500);
        }
    }

    public function getCoupons()
    {
        $coupons = Coupons::pluck('title');
        return response()->json($coupons);
    }
}
