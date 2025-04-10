@extends('layouts.with_sidebar')

@section('title', '我的訂單')
@section('meta_description', '查看和管理您的所有訂單')
@section('meta_keywords', '訂單, 購買記錄, 會員中心')
@section('breadcrumb_title', '我的訂單')

@section('main_content')
    <div class="w-full p-6 bg-white rounded-lg shadow-sm">
        <h1 class="text-2xl font-bold text-brandGrey-normal mb-6">我的訂單</h1>
        
        <!-- 訂單篩選與搜尋 -->
        <div class="mb-6">
            <div class="flex flex-col md:flex-row flex-wrap">
                <!-- 狀態篩選 -->
                <div class="w-full md:w-auto md:flex-grow">
                    <!-- 大螢幕用按鈕篩選 -->
                    <div class="hidden md:block mb-4">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-brandGrey-normal font-medium mr-2">狀態：</span>
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('user.orders', ['status' => 'all']) }}" class="px-4 py-2 {{ $status == 'all' ? 'bg-brandBlue-normal text-white' : 'bg-brandGray-light text-brandGray-normal hover:bg-brandGray-lightHover' }} rounded-md">全部</a>
                                <a href="{{ route('user.orders', ['status' => 'pending']) }}" class="px-4 py-2 {{ $status == 'pending' ? 'bg-brandBlue-normal text-white' : 'bg-brandGray-light text-brandGray-normal hover:bg-brandGray-lightHover' }} rounded-md">待付款</a>
                                <a href="{{ route('user.orders', ['status' => 'processing']) }}" class="px-4 py-2 {{ $status == 'processing' ? 'bg-brandBlue-normal text-white' : 'bg-brandGray-light text-brandGray-normal hover:bg-brandGray-lightHover' }} rounded-md">處理中</a>
                                <a href="{{ route('user.orders', ['status' => 'shipped']) }}" class="px-4 py-2 {{ $status == 'shipped' ? 'bg-brandBlue-normal text-white' : 'bg-brandGray-light text-brandGray-normal hover:bg-brandGray-lightHover' }} rounded-md">已出貨</a>
                                <a href="{{ route('user.orders', ['status' => 'completed']) }}" class="px-4 py-2 {{ $status == 'completed' ? 'bg-brandBlue-normal text-white' : 'bg-brandGray-light text-brandGray-normal hover:bg-brandGray-lightHover' }} rounded-md">已完成</a>
                                <a href="{{ route('user.orders', ['status' => 'cancelled']) }}" class="px-4 py-2 {{ $status == 'cancelled' ? 'bg-brandBlue-normal text-white' : 'bg-brandGray-light text-brandGray-normal hover:bg-brandGray-lightHover' }} rounded-md">已取消</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- 小螢幕用下拉選單篩選 -->
                    <div class="md:hidden mb-4">
                        <label for="status_filter" class="block text-brandGray-normal font-medium mb-2">狀態：</label>
                        <select id="status_filter" class="w-full px-3 py-2 border border-brandGray-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal pr-8" onchange="window.location.href=this.value">
                            <option value="{{ route('user.orders', ['status' => 'all']) }}" {{ $status == 'all' ? 'selected' : '' }}>全部</option>
                            <option value="{{ route('user.orders', ['status' => 'pending']) }}" {{ $status == 'pending' ? 'selected' : '' }}>待付款</option>
                            <option value="{{ route('user.orders', ['status' => 'processing']) }}" {{ $status == 'processing' ? 'selected' : '' }}>處理中</option>
                            <option value="{{ route('user.orders', ['status' => 'shipped']) }}" {{ $status == 'shipped' ? 'selected' : '' }}>已出貨</option>
                            <option value="{{ route('user.orders', ['status' => 'completed']) }}" {{ $status == 'completed' ? 'selected' : '' }}>已完成</option>
                            <option value="{{ route('user.orders', ['status' => 'cancelled']) }}" {{ $status == 'cancelled' ? 'selected' : '' }}>已取消</option>
                        </select>
                    </div>
                </div>
                
                <!-- 搜尋欄位 -->
                <div class="relative w-full md:w-64 lg:w-72 xl:w-80 md:mt-0 md:ml-4">
                    <form action="{{ route('user.orders') }}" method="GET">
                        <input type="hidden" name="status" value="{{ $status }}">
                        <input type="text" name="search" placeholder="搜尋訂單編號" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2 border border-brandGray-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal">
                        <i class="icon-[mdi--magnify] w-5 h-5 text-brandGray-normalLight absolute left-3 top-2.5"></i>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- 訂單列表 -->
        <div class="space-y-6">
            @forelse ($orders as $order)
                <div class="border border-brandGray-light rounded-lg overflow-hidden">
                    <div class="bg-brandGray-lightLight p-4 border-b border-brandGray-light">
                        <div class="flex flex-wrap justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-brandGray-normal">訂單編號: {{ $order->order_id }}</h3>
                                <p class="text-sm text-brandGray-normalLight">訂購日期: {{ $order->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                            <div class="text-right mt-2 md:mt-0">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($order->trade_status == 'pending') bg-brandRed-light text-brandRed-normal
                                    @elseif($order->trade_status == 'processing' || $order->trade_status == 'shipped') bg-brandBlue-light text-brandBlue-normal
                                    @elseif($order->trade_status == 'completed') bg-brandGreen-light text-brandGreen-normal
                                    @else bg-brandGray-light text-brandGray-normal
                                    @endif">
                                    {{ $order->status_name }}
                                </span>
                                <p class="text-sm font-medium text-brandGray-normal mt-1">NT$ {{ number_format($order->total_price_with_discount, 0) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 bg-white">
                        <div class="space-y-4">
                            @foreach($order->items as $item)
                                <div class="flex flex-wrap md:flex-nowrap items-center gap-4">
                                    <!-- 商品預覽圖 (已註釋) -->
                                    <!--
                                    <div class="w-20 h-20 bg-brandGray-light rounded-md flex-shrink-0">
                                        <img src="https://via.placeholder.com/80" alt="{{ $item->product_name }}" class="w-full h-full object-cover rounded-md" loading="lazy">
                                    </div>
                                    -->
                                    
                                    <!-- 商品資訊區塊 (調整寬度以平衡視覺) -->
                                    <div class="flex-grow pl-3">
                                        <h4 class="text-md font-medium text-brandGray-normal">{{ $item->product_name }}</h4>
                                        <p class="text-sm text-brandGray-normalLight">數量: {{ $item->quantity }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-md font-medium text-brandGray-normal">NT$ {{ number_format($item->product_price, 0) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 flex flex-wrap justify-between items-center border-t border-brandGray-light pt-4">
                            <div class="mb-3 sm:mb-0">
                                <p class="text-sm text-brandGray-normalLight">付款方式: {{ $order->payment_method_name }}</p>
                                <p class="text-sm text-brandGray-normalLight">配送方式: 宅配</p>
                            </div>
                            <div class="flex w-full sm:w-auto space-x-2">
                                <a href="{{ route('user.orders.detail', $order->order_id) }}" class="flex-1 sm:flex-none px-4 py-2 border border-brandBlue-lightActive text-brandBlue-normal rounded-md hover:bg-brandBlue-light">查看詳情</a>
                                
                                @if($order->trade_status == 'pending')
                                    <a href="#" class="flex-1 sm:flex-none px-4 py-2 bg-brandBlue-normal text-white rounded-md hover:bg-brandBlue-normalHover">前往付款</a>
                                @elseif($order->trade_status == 'shipped')
                                    <a href="#" class="flex-1 sm:flex-none px-4 py-2 bg-brandBlue-normal text-white rounded-md hover:bg-brandBlue-normalHover">查詢物流</a>
                                @elseif($order->trade_status == 'completed' || $order->trade_status == 'cancelled')
                                    <a href="#" class="flex-1 sm:flex-none px-4 py-2 bg-brandBlue-normal text-white rounded-md hover:bg-brandBlue-normalHover">再次購買</a>
                                @endif
                                
                                @if(in_array($order->trade_status, ['pending', 'processing']))
                                    <form action="{{ route('user.orders.cancel', $order->order_id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="flex-1 sm:flex-none px-4 py-2 border border-brandGray-lightActive text-brandGray-normal rounded-md hover:bg-brandGray-light" onclick="return confirm('確定要取消此訂單嗎？')">取消訂單</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <p class="text-brandGray-normalLight text-lg">尚無訂單記錄</p>
                </div>
            @endforelse
        </div>
        
        <!-- 分頁 -->
        @if($orders->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $orders->appends(['status' => $status, 'search' => request('search')])->links() }}
            </div>
        @endif
    </div>
@endsection 