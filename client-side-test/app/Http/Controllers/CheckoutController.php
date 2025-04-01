<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\OrderMain;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use App\Models\ProductSpec;



class CheckoutController extends Controller
{


    public function InsertOrderMain(Request $request)
        {
            $orderMainData = $request->input('orderMainData'); // Remove extra space
        if ($request->has('orderMainData')) {
            // // Insert into `order_main` table
            $orderMain = new OrderMain();
            $orderMain->trade_No = $orderMainData['trade_No'];
            $orderMain->id = $orderMainData['id'];
            $orderMain->total_price_with_discount = $orderMainData['total_price_with_discount'];
            $orderMain->payment_type = $orderMainData['payment_type'];
            $orderMain->trade_status = $orderMainData['trade_status'];
            $orderMain->order_id = $orderMainData['order_id'];

            // Manually set created_at and updated_at
            $orderMain->created_at = now();
            $orderMain->updated_at = now();
            $orderMain->trade_Date = now();

            $orderMain->save();
            return response()->json(['res' => $orderMainData]);
        } else {
            return response()->json(['res' => "none"]);
        }

    
    }


public function InsertOrderDetail(Request $request)
{
    // Get the product list data from the request
    $productList = $request->input('productList');
    
    if ($request->has('productList')) {
        // Loop through each product in the products array
        foreach ($productList['products'] as $product) {
            // Create a new order detail entry for each product
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $productList['order_id'];  // Assign order_id from the parent object
           // $productList下面的'products'陣列
            $orderDetail->product_name = $product['product_name'];
            $orderDetail->product_size = $product['product_size'];
            $orderDetail->product_color = $product['product_color'];
            $orderDetail->quantity = $product['quantity'];
            $orderDetail->product_price = $product['product_price'];

            // Manually set created_at and updated_at
            $orderDetail->created_at = now();
            $orderDetail->updated_at = now();

            // Save the order detail to the database
            $orderDetail->save();
        }

        // Return the product list as a response
        return response()->json(['res' => $productList]);
    } else {
        return response()->json(['res' => "none"]);
    }
}

public function DeleteCart(Request $request)
{
    // 檢查請求中是否包含 product_ids 數據
    if (!$request->has('product_ids')) {
        return response()->json(['success' => false, 'message' => '缺少必要參數'], 400);
    }

    // 獲取用戶ID和產品信息
    $data = $request->input('product_ids');
    $userId = $data['id'];
    $products = $data['products'];
   
   
    try {
        foreach ($products as $product) {
            $productId = $product['product_id'];
            $quantity = $product['quantity'];

            // 刪除購物車中對應的商品
            Cart::where('id', $userId)
                ->where('product_id', $productId)
                ->delete();
            }
            

        // 提交事務
        DB::commit();

        return response()->json([
            'success' => true, 
            'message' => '購物車商品已成功刪除，庫存已更新'
        ]);
    } catch (\Exception $e) {
        // 發生錯誤時回滾事務
        DB::rollBack();

        return response()->json([
            'success' => false, 
            'message' => '操作失敗: ' . $e->getMessage()
        ], 500);
    }
}

public function UpdateProductStock(Request $request)
{
    
    if (!$request->has('product_stock')) {
        return response()->json(['success' => false, 'message' => '缺少必要參數'], 400);
    }

    // 獲取產品信息
    $data = $request->input('product_stock');
    $products = $data['products'];
   
    // 開始事務處理
    DB::beginTransaction();

    try {
        foreach ($products as $product) {
            $productId = $product['product_id'];
            $quantity = $product['quantity'];
            
            // 更新產品庫存 - 使用 product_id 作為查詢條件
            $productSpec = ProductSpec::where('product_id', $productId)->first();
            if ($productSpec) {
                // 確保庫存不會變成負數
                if ($productSpec->product_stock >= $quantity) {
                    // 直接更新庫存數量，不使用 id 欄位
                    DB::table('product_spec')
                        ->where('product_id', $productId)
                        ->update([
                            'product_stock' => $productSpec->product_stock - $quantity,
                            'updated_at' => now()
                        ]);
                } else {
                    // 如果庫存不足，回滾事務並返回錯誤
                    DB::rollBack();
                    return response()->json([
                        'success' => false, 
                        'message' => "產品 {$productId} 庫存不足"
                    ], 400);
                }
            } else {
                // 如果找不到產品規格，回滾事務並返回錯誤
                DB::rollBack();
                return response()->json([
                    'success' => false, 
                    'message' => "找不到產品 {$productId} 的規格"
                ], 404);
            }
        }

        // 提交事務
        DB::commit();

        return response()->json([
            'success' => true, 
            'message' => '庫存已成功更新'
        ]);
    } catch (\Exception $e) {
        // 發生錯誤時回滾事務
        DB::rollBack();

        return response()->json([
            'success' => false, 
            'message' => '操作失敗: ' . $e->getMessage()
        ], 500);
    }
}
}
