@extends('layouts.with_sidebar')

@section('title', '訂單詳情')
@section('meta_description', '查看您的訂單詳細資訊')
@section('meta_keywords', '訂單詳情, 購買記錄, 會員中心')
@section('breadcrumb_title', '訂單詳情')

@section('main_content')
    <div class="w-full p-4 sm:p-6 bg-white rounded-lg shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl sm:text-2xl font-bold text-brandGrey-normal">訂單詳情</h1>
            <a href="{{ route('user.orders') }}" class="px-3 py-1.5 sm:px-4 sm:py-2 border border-brandGrey-lightActive text-brandGrey-normal rounded-md hover:bg-brandGrey-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandGrey-light">
                返回訂單列表
            </a>
        </div>
        
        <!-- 訂單狀態追蹤 (已註釋) -->
        <!--
        <div class="mb-8">
            <h2 class="text-lg font-medium text-brandGrey-normal mb-4">訂單狀態</h2>
            <div class="relative">
        -->
                <!-- 進度條 -->
                <!--
                <div class="hidden sm:block absolute left-0 top-1/2 w-full h-1 bg-brandGray-light -translate-y-1/2 z-0"></div>
                -->
                <!-- 狀態點 -->
            <!--
                <div class="flex justify-between relative z-10">
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full bg-brandBlue-normal text-white flex items-center justify-center mb-2">
                            <i class="icon-[mdi--check] w-5 h-5"></i>
                        </div>
                        <span class="text-sm text-brandGray-normal text-center">訂單成立</span>
                        <span class="text-xs text-brandGray-normalLight text-center">{{ $statusTimeline['created']['time'] }}</span>
                    </div>
                    
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full {{ $statusTimeline['paid']['completed'] ? 'bg-brandBlue-normal text-white' : 'bg-brandGray-light text-brandGray-normal' }} flex items-center justify-center mb-2">
                            <i class="icon-[mdi--{{ $statusTimeline['paid']['completed'] ? 'check' : 'credit-card-outline' }}] w-5 h-5"></i>
                        </div>
                        <span class="text-sm text-brandGray-normal text-center">付款完成</span>
                        <span class="text-xs text-brandGray-normalLight text-center">{{ $statusTimeline['paid']['time'] }}</span>
                    </div>
                    
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full {{ $statusTimeline['processing']['completed'] ? 'bg-brandBlue-normal text-white' : 'bg-brandGray-light text-brandGray-normal' }} flex items-center justify-center mb-2">
                            <i class="icon-[mdi--{{ $statusTimeline['processing']['completed'] ? 'check' : 'package-variant-closed' }}] w-5 h-5"></i>
                        </div>
                        <span class="text-sm text-brandGray-normal text-center">訂單處理</span>
                        <span class="text-xs text-brandGray-normalLight text-center">{{ $statusTimeline['processing']['time'] }}</span>
                    </div>
                    
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full {{ $statusTimeline['shipped']['completed'] ? 'bg-brandBlue-normal text-white' : 'bg-brandGray-light text-brandGray-normal' }} flex items-center justify-center mb-2">
                            <i class="icon-[mdi--{{ $statusTimeline['shipped']['completed'] ? 'check' : 'truck-outline' }}] w-5 h-5"></i>
                        </div>
                        <span class="text-sm text-brandGray-normal text-center">已出貨</span>
                        <span class="text-xs text-brandGray-normalLight text-center">{{ $statusTimeline['shipped']['time'] }}</span>
                    </div>
                    
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full {{ $statusTimeline['completed']['completed'] ? 'bg-brandBlue-normal text-white' : 'bg-brandGray-light text-brandGray-normal' }} flex items-center justify-center mb-2">
                            <i class="icon-[mdi--{{ $statusTimeline['completed']['completed'] ? 'check' : 'home-outline' }}] w-5 h-5"></i>
                        </div>
                        <span class="text-sm text-brandGray-normal text-center">已送達</span>
                        <span class="text-xs text-brandGray-normalLight text-center">{{ $statusTimeline['completed']['time'] }}</span>
                    </div>
                </div>
            </div>
            -->
            
        <!-- 目前狀態 -->
        <div class="mb-8 p-4 rounded-lg {{ $order->trade_status == 'cancelled' ? 'bg-brandGray-lightLight' : 'bg-brandBlue-light' }}">
            <div class="flex items-center">
                <i class="icon-[mdi--information-outline] w-6 h-6 mr-3 {{ $order->trade_status == 'cancelled' ? 'text-brandGray-normal' : 'text-brandBlue-normal' }}"></i>
                <p class="text-base {{ $order->trade_status == 'cancelled' ? 'text-brandGray-normal' : 'text-brandBlue-normal' }}">
                    @if ($order->trade_status == 'completed')
                        您的訂單已送達。如有任何問題，請聯繫客服。
                    @elseif ($order->trade_status == 'shipped')
                        您的訂單已出貨，預計 1-2 天內送達。
                    @elseif ($order->trade_status == 'processing')
                        您的訂單正在處理中，我們將盡快為您出貨。
                    @elseif ($order->trade_status == 'pending')
                        您的訂單已建立，請於 24 小時內完成付款，以免訂單自動取消。
                    @elseif ($order->trade_status == 'cancelled')
                        您的訂單已取消。
                    @else
                        訂單狀態：{{ $order->status_name }}
                    @endif
                </p>
            </div>
        </div>
        
        <!-- 訂單資訊 -->
        <div class="mb-8">
            <h2 class="text-lg font-medium text-brandGrey-normal mb-4">訂單資訊</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-medium text-brandGrey-normal mb-2">基本資訊</h3>
                    <div class="bg-brandGrey-lightLight p-4 rounded-lg">
                        <p class="text-sm mb-2">
                            <span class="text-brandGray-normalLight">訂單編號：</span>
                            <span class="text-brandGray-normal">{{ $order->order_id }}</span>
                        </p>
                        <p class="text-sm mb-2">
                            <span class="text-brandGray-normalLight">訂購日期：</span>
                            <span class="text-brandGray-normal">{{ $order->created_at->format('Y/m/d H:i') }}</span>
                        </p>
                        <p class="text-sm mb-2">
                            <span class="text-brandGray-normalLight">付款方式：</span>
                            <span class="text-brandGray-normal">{{ $order->payment_method_name }}</span>
                        </p>
                        <p class="text-sm">
                            <span class="text-brandGray-normalLight">訂單狀態：</span>
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium 
                                @if($order->trade_status == 'pending') bg-brandRed-light text-brandRed-normal
                                @elseif($order->trade_status == 'processing' || $order->trade_status == 'shipped') bg-brandBlue-light text-brandBlue-normal
                                @elseif($order->trade_status == 'completed') bg-brandGreen-light text-brandGreen-normal
                                @else bg-brandGray-light text-brandGray-normal
                                @endif">
                                {{ $order->status_name }}
                            </span>
                        </p>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-brandGrey-normal mb-2">收件資訊</h3>
                    <div class="bg-brandGrey-lightLight p-4 rounded-lg">
                        <p class="text-sm mb-2">
                            <span class="text-brandGray-normalLight">收件人：</span>
                            <span class="text-brandGray-normal">{{ Auth::user()->name }}</span>
                        </p>
                        <p class="text-sm mb-2">
                            <span class="text-brandGray-normalLight">聯絡電話：</span>
                            <span class="text-brandGray-normal">{{ Auth::user()->phone ?? '未設定' }}</span>
                        </p>
                        <p class="text-sm mb-2">
                            <span class="text-brandGray-normalLight">收件地址：</span>
                            <span class="text-brandGray-normal">{{ Auth::user()->address ?? '未設定' }}</span>
                        </p>
                        <p class="text-sm">
                            <span class="text-brandGrey-normalLight">配送方式：</span>
                            <span class="text-brandGrey-normal">宅配</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 商品明細 -->
        <div class="mb-8">
            <h2 class="text-lg font-medium text-brandGrey-normal mb-4">商品明細</h2>
            <div class="border border-brandGrey-light rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-brandGrey-light">
                        <thead class="bg-brandGrey-lightLight">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-brandGrey-normal uppercase tracking-wider">商品</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-brandGrey-normal uppercase tracking-wider">單價</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-brandGrey-normal uppercase tracking-wider">數量</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-brandGrey-normal uppercase tracking-wider">小計</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-brandGray-light">
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center">
                                            <!-- 商品預覽圖 (已註釋) -->
                                            <!--
                                            <div class="flex-shrink-0 h-16 w-16 bg-brandGray-lightLight rounded-md overflow-hidden">
                                                <img src="https://via.placeholder.com/64" alt="{{ $item->product_name }}" class="h-full w-full object-cover">
                                            </div>
                                            -->
                                            <div class="ml-0">
                                                <div class="text-sm font-medium text-brandGray-normal">{{ $item->product_name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-brandGray-normal">NT$ {{ number_format($item->product_price, 0) }}</td>
                                    <td class="px-4 py-4 text-sm text-brandGray-normal">{{ $item->quantity }}</td>
                                    <td class="px-4 py-4 text-sm text-brandGray-normal">NT$ {{ number_format($item->product_price * $item->quantity, 0) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- 金額摘要 -->
                <div class="bg-brandGrey-lightLight px-4 py-4">
                    <div class="flex justify-end">
                        <div class="w-full sm:w-64">
                            @php
                                $subtotal = $order->items->sum(function($item) {
                                    return $item->product_price * $item->quantity;
                                });
                                $shipping = 60; // 固定運費
                                $discount = $subtotal + $shipping - $order->total_price_with_discount;
                            @endphp
                            <div class="flex justify-between mb-2">
                                <span class="text-sm text-brandGray-normalLight">商品小計：</span>
                                <span class="text-sm text-brandGray-normal">
                                    NT$ {{ number_format($subtotal, 0) }}
                                </span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm text-brandGray-normalLight">運費：</span>
                                <span class="text-sm text-brandGray-normal">NT$ {{ number_format($shipping, 0) }}</span>
                            </div>
                            @if($discount > 0)
                                <div class="flex justify-between mb-2">
                                    <span class="text-sm text-brandGray-normalLight">優惠券折抵：</span>
                                    <span class="text-sm text-brandRed-normal">-NT$ {{ number_format($discount, 0) }}</span>
                                </div>
                            @endif
                            <div class="flex justify-between pt-2 border-t border-brandGray-light">
                                <span class="text-base font-medium text-brandGray-normal">總計：</span>
                                <span class="text-base font-medium text-brandGray-normal">
                                    NT$ {{ number_format($order->total_price_with_discount, 0) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 操作按鈕 -->
        <div class="flex flex-wrap justify-end gap-3">
            @if ($order->trade_status == 'completed')
                <a href="{{ route('user.orders.return', $order->order_id) }}" class="flex items-center justify-center px-4 py-2 border border-brandGray-lightActive text-brandGray-normal rounded-md hover:bg-brandGray-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandGray-light">
                    <i class="icon-[mdi--cash-refund] w-5 h-5 mr-1 inline-block"></i>
                    申請退貨
                </a>
            @elseif ($order->trade_status == 'shipped')
                <a href="#" class="flex items-center justify-center px-4 py-2 border border-brandGray-lightActive text-brandGray-normal rounded-md hover:bg-brandGray-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandGray-light">
                    <i class="icon-[mdi--truck-outline] w-5 h-5 mr-1 inline-block"></i>
                    查詢物流
                </a>
            @elseif ($order->trade_status == 'processing')
                <form action="{{ route('user.orders.cancel', $order->order_id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center justify-center px-4 py-2 border border-brandGrey-lightActive text-brandGrey-normal rounded-md hover:bg-brandGrey-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandGrey-light" onclick="return confirm('確定要取消此訂單嗎？')">
                        <i class="icon-[mdi--close-circle-outline] w-5 h-5 mr-1 inline-block"></i>
                        取消訂單
                    </button>
                </form>
            @elseif ($order->trade_status == 'pending')
                <a href="#" class="flex items-center justify-center px-4 py-2 bg-brandBlue-normal text-white rounded-md hover:bg-brandBlue-normalHover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandBlue-normal">
                    <i class="icon-[mdi--credit-card-outline] w-5 h-5 mr-1 inline-block"></i>
                    前往付款
                </a>
                <form action="{{ route('user.orders.cancel', $order->order_id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center justify-center px-4 py-2 border border-brandGrey-lightActive text-brandGrey-normal rounded-md hover:bg-brandGrey-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandGrey-light" onclick="return confirm('確定要取消此訂單嗎？')">
                        <i class="icon-[mdi--close-circle-outline] w-5 h-5 mr-1 inline-block"></i>
                        取消訂單
                    </button>
                </form>
            @elseif ($order->trade_status == 'cancelled')
                <a href="#" class="flex items-center justify-center px-4 py-2 bg-brandBlue-normal text-white rounded-md hover:bg-brandBlue-normalHover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandBlue-normal">
                    <i class="icon-[mdi--cart-outline] w-5 h-5 mr-1 inline-block"></i>
                    重新購買
                </a>
            @endif
            
            <button id="print-order-btn" class="flex items-center justify-center px-4 py-2 border border-brandGray-lightActive text-brandGray-normal rounded-md hover:bg-brandGray-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandGray-light">
                <i class="icon-[mdi--printer-outline] w-5 h-5 mr-1 inline-block"></i>
                列印訂單
            </button>
        </div>
    </div>

    <!-- 列印樣式 -->
    <style type="text/css" media="print">
        /* 重置所有元素 */
        * {
            box-sizing: border-box;
        }
        
        /* 隱藏不需要列印的元素 */
        header, footer, nav, .sidebar, .breadcrumb, .no-print, button, a, 
        .flex.flex-wrap.justify-end.gap-3, .mb-8.p-4.rounded-lg,
        body > *:not(.print-container) {
            display: none !important;
        }
        
        /* 確保頁面按照 A4 尺寸列印 */
        @page {
            size: A4 portrait;
            margin: 1.5cm;
        }
        
        /* 基本頁面設定 */
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            font-size: 11pt;
            line-height: 1.4;
            background: white;
            color: #333;
        }
        
        /* 列印內容容器 */
        .print-container {
            width: 100%;
            max-width: 100%;
            padding: 0;
            margin: 0 auto;
            background: white;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
            overflow: visible;
        }
        
        /* 頁眉樣式 */
        .print-header {
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 20px;
            border-bottom: 2px solid #eaeaea;
        }
        
        .print-header-title {
            font-size: 20pt;
            font-weight: bold;
            color: #333;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        
        .print-header-subtitle {
            font-size: 12pt;
            color: #666;
            margin: 5px 0 0 0;
            text-align: center;
        }
        
        .print-logo {
            text-align: center;
            margin-bottom: 10px;
            font-weight: bold;
            letter-spacing: 1px;
            font-size: 22pt;
            color: #2b6cb0;
        }
        
        /* 訂單資訊區塊 */
        .print-info-grid {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
            width: 100%;
        }
        
        .print-info-column {
            width: 50%;
            padding: 0 10px;
            box-sizing: border-box;
        }
        
        .print-info-box {
            border: 1px solid #eaeaea;
            border-radius: 5px;
            padding: 10px;
            height: 100%;
        }
        
        .print-info-title {
            font-size: 12pt;
            font-weight: bold;
            margin: 0 0 10px 0;
            padding-bottom: 5px;
            border-bottom: 1px solid #eaeaea;
        }
        
        .print-info-item {
            margin-bottom: 6px;
            font-size: 10pt;
        }
        
        .print-info-label {
            font-weight: normal;
            color: #666;
            display: inline-block;
            width: 70px;
        }
        
        .print-info-value {
            font-weight: bold;
            color: #333;
        }
        
        /* 商品表格樣式 */
        .print-table-container {
            margin-bottom: 20px;
            width: 100%;
        }
        
        .print-table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: avoid;
            table-layout: fixed;
        }
        
        .print-table th,
        .print-table td {
            padding: 8px;
            text-align: left;
            white-space: normal;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        
        .print-table th {
            background-color: #f5f5f5;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
            font-size: 9pt;
            text-transform: uppercase;
        }
        
        .print-table td {
            border-bottom: 1px solid #eaeaea;
            font-size: 10pt;
        }
        
        .print-table th:nth-child(1),
        .print-table td:nth-child(1) {
            width: 40%;
        }
        
        .print-table th:nth-child(2),
        .print-table td:nth-child(2),
        .print-table th:nth-child(3),
        .print-table td:nth-child(3),
        .print-table th:nth-child(4),
        .print-table td:nth-child(4) {
            width: 20%;
        }
        
        /* 金額摘要區塊 - 重新設計 */
        .print-summary-table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }
        
        .print-summary-table td {
            padding: 4px 8px;
            font-size: 9pt;
            border: none;
        }
        
        .print-summary-table .summary-label {
            text-align: right;
            color: #666;
            width: 85%;
        }
        
        .print-summary-table .summary-value {
            text-align: right;
            font-weight: bold;
            width: 15%;
        }
        
        .print-summary-table .summary-total {
            font-size: 11pt;
            border-top: 1px solid #eaeaea;
            padding-top: 6px;
            margin-top: 4px;
        }
        
        /* 頁腳樣式 */
        .print-footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9pt;
            color: #999;
            padding-top: 15px;
            border-top: 1px solid #eaeaea;
        }
    </style>

    <!-- 列印功能 -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('print-order-btn').addEventListener('click', function(e) {
                e.preventDefault();
                
                // 創建列印容器
                const printContainer = document.createElement('div');
                printContainer.className = 'print-container';
                printContainer.id = 'print-container';
                
                // 創建頁眉
                const header = document.createElement('div');
                header.className = 'print-header';
                
                // 使用圖片 logo 替換文字 logo
                const logo = document.createElement('div');
                logo.className = 'print-logo';
                const logoImg = document.createElement('img');
                logoImg.src = '/images/layouts/logo_nav1.jpg';
                logoImg.alt = '網站 Logo';
                logoImg.style.maxHeight = '50px';
                logoImg.style.margin = '0 auto';
                logoImg.style.display = 'block';
                logo.appendChild(logoImg);
                
                const title = document.createElement('h1');
                title.className = 'print-header-title';
                title.textContent = '訂單明細';
                
                const subTitle = document.createElement('p');
                subTitle.className = 'print-header-subtitle';
                subTitle.textContent = '訂單編號: {{ $order->order_id }}';
                
                header.appendChild(logo);
                header.appendChild(title);
                header.appendChild(subTitle);
                printContainer.appendChild(header);
                
                // 創建訂單資訊區塊
                const infoGrid = document.createElement('div');
                infoGrid.className = 'print-info-grid';
                
                // 基本資訊
                const basicInfoColumn = document.createElement('div');
                basicInfoColumn.className = 'print-info-column';
                
                const basicInfoBox = document.createElement('div');
                basicInfoBox.className = 'print-info-box';
                
                const basicInfoTitle = document.createElement('div');
                basicInfoTitle.className = 'print-info-title';
                basicInfoTitle.textContent = '基本資訊';
                basicInfoBox.appendChild(basicInfoTitle);
                
                const basicInfoContent = document.createElement('div');
                basicInfoContent.innerHTML = `
                    <div class="print-info-item">
                        <span class="print-info-label">訂單編號：</span>
                        <span class="print-info-value">{{ $order->order_id }}</span>
                    </div>
                    <div class="print-info-item">
                        <span class="print-info-label">訂購日期：</span>
                        <span class="print-info-value">{{ $order->created_at->format('Y/m/d H:i') }}</span>
                    </div>
                    <div class="print-info-item">
                        <span class="print-info-label">付款方式：</span>
                        <span class="print-info-value">{{ $order->payment_method_name }}</span>
                    </div>
                    <div class="print-info-item">
                        <span class="print-info-label">訂單狀態：</span>
                        <span class="print-info-value">{{ $order->status_name }}</span>
                    </div>
                `;
                basicInfoBox.appendChild(basicInfoContent);
                basicInfoColumn.appendChild(basicInfoBox);
                infoGrid.appendChild(basicInfoColumn);
                
                // 收件資訊
                const shippingInfoColumn = document.createElement('div');
                shippingInfoColumn.className = 'print-info-column';
                
                const shippingInfoBox = document.createElement('div');
                shippingInfoBox.className = 'print-info-box';
                
                const shippingInfoTitle = document.createElement('div');
                shippingInfoTitle.className = 'print-info-title';
                shippingInfoTitle.textContent = '收件資訊';
                shippingInfoBox.appendChild(shippingInfoTitle);
                
                const shippingInfoContent = document.createElement('div');
                shippingInfoContent.innerHTML = `
                    <div class="print-info-item">
                        <span class="print-info-label">收件人：</span>
                        <span class="print-info-value">{{ Auth::user()->name }}</span>
                    </div>
                    <div class="print-info-item">
                        <span class="print-info-label">聯絡電話：</span>
                        <span class="print-info-value">{{ Auth::user()->phone ?? '未設定' }}</span>
                    </div>
                    <div class="print-info-item">
                        <span class="print-info-label">收件地址：</span>
                        <span class="print-info-value">{{ Auth::user()->address ?? '未設定' }}</span>
                    </div>
                    <div class="print-info-item">
                        <span class="print-info-label">配送方式：</span>
                        <span class="print-info-value">宅配</span>
                    </div>
                `;
                shippingInfoBox.appendChild(shippingInfoContent);
                shippingInfoColumn.appendChild(shippingInfoBox);
                infoGrid.appendChild(shippingInfoColumn);
                
                printContainer.appendChild(infoGrid);
                
                // 商品明細
                const productsSection = document.createElement('div');
                productsSection.className = 'print-table-container';
                
                const productsTitle = document.createElement('div');
                productsTitle.className = 'print-info-title';
                productsTitle.textContent = '商品明細';
                productsSection.appendChild(productsTitle);
                
                // 商品表格
                const tableHTML = `
                    <table class="print-table">
                        <thead>
                            <tr>
                                <th>商品</th>
                                <th>單價</th>
                                <th>數量</th>
                                <th>小計</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>NT$ {{ number_format($item->product_price, 0) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>NT$ {{ number_format($item->product_price * $item->quantity, 0) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                `;
                productsSection.innerHTML += tableHTML;
                
                // 金額摘要 - 新設計，使用表格布局代替flex布局
                @php
                    $subtotal = $order->items->sum(function($item) {
                        return $item->product_price * $item->quantity;
                    });
                    $shipping = 60; // 固定運費
                    $discount = $subtotal + $shipping - $order->total_price_with_discount;
                @endphp
                
                const summaryTableHTML = `
                    <table class="print-summary-table">
                        <tr>
                            <td class="summary-label">商品小計：</td>
                            <td class="summary-value">NT$ {{ number_format($subtotal, 0) }}</td>
                        </tr>
                        <tr>
                            <td class="summary-label">運費：</td>
                            <td class="summary-value">NT$ {{ number_format($shipping, 0) }}</td>
                        </tr>
                        @if($discount > 0)
                        <tr>
                            <td class="summary-label">優惠券折抵：</td>
                            <td class="summary-value">-NT$ {{ number_format($discount, 0) }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td class="summary-label summary-total">總計：</td>
                            <td class="summary-value summary-total">NT$ {{ number_format($order->total_price_with_discount, 0) }}</td>
                        </tr>
                    </table>
                `;
                productsSection.innerHTML += summaryTableHTML;
                
                printContainer.appendChild(productsSection);
                
                // 頁腳
                const footer = document.createElement('div');
                footer.className = 'print-footer';
                footer.innerHTML = `
                    <p>感謝您的訂購！如有任何問題，請聯繫客服。</p>
                    <p>此訂單列印於 ${new Date().toLocaleString()}</p>
                `;
                printContainer.appendChild(footer);
                
                // 移除舊的列印容器（如果存在）
                const oldContainer = document.getElementById('print-container');
                if (oldContainer) {
                    document.body.removeChild(oldContainer);
                }
                
                // 將列印容器添加到頁面
                document.body.appendChild(printContainer);
                
                // 隱藏所有其他元素
                const allElements = document.body.children;
                for (let i = 0; i < allElements.length; i++) {
                    if (allElements[i] !== printContainer) {
                        allElements[i].style.display = 'none';
                    }
                }
                
                // 記錄當前URL，用於列印後重新載入頁面
                const currentUrl = window.location.href;
                
                // 稍作延遲以確保樣式已應用
                setTimeout(function() {
                    // 註冊afterprint事件，當列印完成或取消後觸發
                    window.addEventListener('afterprint', function() {
                        // 延遲一下重新載入頁面，確保DOM完全恢復
                        setTimeout(function() {
                            window.location.href = currentUrl;
                        }, 100);
                    }, {once: true}); // 只執行一次
                    
                    window.print();
                    
                    // 處理舊瀏覽器可能不支援afterprint事件的情況
                    // 列印完成後恢復頁面顯示
                    for (let i = 0; i < allElements.length; i++) {
                        if (allElements[i] !== printContainer) {
                            allElements[i].style.display = '';
                        }
                    }
                    
                    // 移除列印容器
                    document.body.removeChild(printContainer);
                    
                    // 額外保障：如果afterprint事件未觸發，確保1.5秒後刷新頁面
                    setTimeout(function() {
                        window.location.href = currentUrl;
                    }, 1500);
                }, 300);
            });
        });
    </script>
@endsection 