<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * 顯示用戶的訂單列表
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $status = $request->query('status', 'all');
        
        // 查詢用戶的訂單
        $query = Order::where('id', $user->id);
        
        // 根據狀態過濾
        if ($status !== 'all') {
            $statusMap = [
                'pending' => 'pending',
                'processing' => 'processing',
                'shipped' => 'shipped',
                'completed' => 'completed',
                'cancelled' => 'cancelled'
            ];
            
            if (isset($statusMap[$status])) {
                $query->where('trade_status', $statusMap[$status]);
            }
        }
        
        // 排序並分頁
        $orders = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // 載入關聯數據
        $orders->load('items');
        
        return view('user.orders', compact('orders', 'status'));
    }
    
    /**
     * 顯示訂單詳情
     */
    public function show($id)
    {
        $user = Auth::user();
        
        // 查詢訂單，確保是當前用戶的訂單
        $order = Order::with('items')
            ->where('order_id', $id)
            ->where('id', $user->id)
            ->firstOrFail();
        
        // 獲取訂單狀態時間線
        $statusTimeline = $this->getStatusTimeline($order);
        
        return view('user.order_detail', compact('order', 'statusTimeline'));
    }
    
    /**
     * 取消訂單
     */
    public function cancel($id)
    {
        $user = Auth::user();
        
        // 查詢訂單，確保是當前用戶的訂單
        $order = Order::where('order_id', $id)
            ->where('id', $user->id)
            ->firstOrFail();
            
        // 判斷訂單是否可以取消
        if (!in_array($order->trade_status, ['pending', 'processing'])) {
            return redirect()->back()->with('error', '此訂單狀態無法取消');
        }
        
        // 更新訂單狀態
        $order->trade_status = 'cancelled';
        $order->save();
        
        return redirect()->route('user.orders')->with('success', '訂單已成功取消');
    }
    
    /**
     * 申請退貨
     */
    public function returnOrder($id)
    {
        $user = Auth::user();
        
        // 查詢訂單，確保是當前用戶的訂單
        $order = Order::with('items')
            ->where('order_id', $id)
            ->where('id', $user->id)
            ->firstOrFail();
            
        return view('user.order_return', compact('order'));
    }
    
    /**
     * 處理退貨申請
     */
    public function storeReturn(Request $request, $id)
    {
        // 處理退貨申請邏輯
        // ...
        
        return redirect()->route('user.orders.detail', $id)->with('success', '退貨申請已提交');
    }
    
    /**
     * 生成訂單狀態時間線
     */
    private function getStatusTimeline($order)
    {
        // 根據訂單狀態和時間生成時間線
        $timeline = [
            'created' => [
                'status' => '訂單成立',
                'time' => $order->created_at->format('Y/m/d'),
                'completed' => true
            ],
            'paid' => [
                'status' => '付款完成',
                'time' => $order->trade_status != 'pending' ? $order->created_at->addHours(1)->format('Y/m/d') : '-',
                'completed' => $order->trade_status != 'pending'
            ],
            'processing' => [
                'status' => '訂單處理',
                'time' => in_array($order->trade_status, ['processing', 'shipped', 'completed']) ? $order->created_at->addHours(2)->format('Y/m/d') : '-',
                'completed' => in_array($order->trade_status, ['processing', 'shipped', 'completed'])
            ],
            'shipped' => [
                'status' => '已出貨',
                'time' => in_array($order->trade_status, ['shipped', 'completed']) ? $order->created_at->addDays(1)->format('Y/m/d') : '-',
                'completed' => in_array($order->trade_status, ['shipped', 'completed'])
            ],
            'completed' => [
                'status' => '已送達',
                'time' => $order->trade_status == 'completed' ? $order->created_at->addDays(2)->format('Y/m/d') : '-',
                'completed' => $order->trade_status == 'completed'
            ]
        ];
        
        return $timeline;
    }
} 