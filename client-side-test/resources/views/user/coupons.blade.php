@extends('layouts.with_sidebar')

@section('title', '我的優惠')
@section('meta_description', '查看和管理您的優惠券')
@section('meta_keywords', '優惠券, 折扣, 會員中心')
@section('breadcrumb_title', '我的優惠')

@section('main_content')
    <div class="w-full p-4 sm:p-6 bg-white rounded-lg shadow-sm">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <h1 class="text-xl sm:text-2xl font-bold text-brandGray-normal mb-3 sm:mb-0">我的優惠</h1>
            <!-- 兌換優惠券區塊 (已註釋) -->
            <!--
            <div class="flex flex-col sm:flex-row w-full sm:w-auto gap-2">
                <form action="{{ route('user.coupons.redeem') }}" method="POST" class="flex flex-col sm:flex-row w-full sm:w-auto gap-2">
                    @csrf
                    <div class="relative w-full sm:w-auto">
                        <input type="text" name="coupon_code" placeholder="輸入優惠碼" class="w-full sm:w-auto px-4 py-2 border border-brandGray-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal">
                    </div>
                    <button type="submit" class="px-3 py-1.5 sm:px-4 sm:py-2 bg-brandBlue-normal text-white rounded-md hover:bg-brandBlue-normalHover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandBlue-normal whitespace-nowrap">
                        兌換優惠碼
                    </button>
                </form>
            </div>
            -->
        </div>
        
        <!-- 顯示成功或錯誤訊息 -->
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @endif
        
        @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-200 text-red-700 rounded-md">
                {{ session('error') }}
            </div>
        @endif
        
        <!-- 顯示模式切換 -->
        <div class="flex justify-end mb-4">
            <div class="inline-flex rounded-md shadow-sm" role="group">
                <button type="button" id="list-view-btn" class="view-toggle-btn px-3 py-1.5 text-sm font-medium {{ $viewPreference == 'list' ? 'active' : '' }} rounded-l-md focus:z-10 focus:ring-2 focus:ring-brandBlue-normal">
                    <i class="icon-[mdi--format-list-bulleted] w-5 h-5"></i>
                </button>
                <button type="button" id="grid-view-btn" class="view-toggle-btn px-3 py-1.5 text-sm font-medium {{ $viewPreference == 'grid' ? 'active' : '' }} rounded-r-md focus:z-10 focus:ring-2 focus:ring-brandBlue-normal">
                    <i class="icon-[mdi--grid] w-5 h-5"></i>
                </button>
            </div>
        </div>
        
        <!-- 優惠券列表 -->
        <div class="space-y-4">
            <div class="border border-brandGrey-light rounded-lg overflow-hidden">
                <div class="bg-brandGrey-lightLight p-3 border-b border-brandGrey-light">
                    <h3 class="font-medium text-brandGrey-normal">可使用的優惠券</h3>
                </div>
                <!-- 列表/網格顯示區域 -->
                <div id="coupon-container" class="{{ $viewPreference == 'grid' ? 'view-grid' : 'view-list' }}">
                    @forelse ($activeCoupons as $coupon)
                        <!-- 優惠券項目 -->
                        <div class="coupon-item {{ isset($coupon['is_expiring']) && $coupon['is_expiring'] ? 'coupon-expiring' : 'coupon-active' }}" data-coupon-id="{{ $coupon['id'] }}" onclick="window.location.href='{{ route('user.coupons.show', $coupon['id']) }}'">
                            @if (isset($coupon['is_expiring']) && $coupon['is_expiring'])
                                <span class="expiring-badge">
                                    <i class="icon-[mdi--clock-alert-outline] w-4 h-4"></i>
                                    @if ($coupon['days_left'] == 0)
                                        今日到期
                                    @else
                                        剩餘 {{ $coupon['days_left'] }} 天
                                    @endif
                                </span>
                            @endif
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <h4 class="text-lg font-semibold text-brandGrey-normal">{{ $coupon['title'] }}</h4>
                                    <p class="text-sm text-brandGrey-normalLight mb-1">{{ $coupon['description'] }}</p>
                                </div>
                                <p class="expiry-date">有效期限：{{ $coupon['expiry_date'] }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center text-brandGrey-normalLight">
                            目前沒有可使用的優惠券
                        </div>
                    @endforelse
                </div>
            </div>
            
            <!-- 已使用的優惠券 -->
            @if (count($usedCoupons) > 0)
                <div class="border border-brandGrey-light rounded-lg overflow-hidden">
                    <div class="bg-brandGrey-lightLight p-3 border-b border-brandGrey-light">
                        <h3 class="font-medium text-brandGrey-normal">已使用的優惠券</h3>
                    </div>
                    <div id="used-coupon-container" class="{{ $viewPreference == 'grid' ? 'view-grid' : 'view-list' }}">
                        @foreach ($usedCoupons as $coupon)
                            <div class="coupon-item coupon-used">
                                <span class="status-badge">已使用</span>
                                <div class="flex flex-col justify-between h-full">
                                    <div>
                                        <h4 class="text-lg font-semibold text-brandGrey-normal">{{ $coupon['title'] }}</h4>
                                        <p class="text-sm text-brandGrey-normalLight mb-1">{{ $coupon['description'] }}</p>
                                    </div>
                                    <p class="expiry-date">使用日期：{{ $coupon['used_date'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <!-- 已過期的優惠券 -->
            @if (count($expiredCoupons) > 0)
                <div class="border border-brandGrey-light rounded-lg overflow-hidden">
                    <div class="bg-brandGrey-lightLight p-3 border-b border-brandGrey-light">
                        <h3 class="font-medium text-brandGrey-normal">已過期的優惠券</h3>
                    </div>
                    <div id="expired-coupon-container" class="{{ $viewPreference == 'grid' ? 'view-grid' : 'view-list' }}">
                        @foreach ($expiredCoupons as $coupon)
                            <div class="coupon-item coupon-expired">
                                <span class="status-badge">已過期</span>
                                <div class="flex flex-col justify-between h-full">
                                    <div>
                                        <h4 class="text-lg font-semibold text-brandGrey-normal">{{ $coupon['title'] }}</h4>
                                        <p class="text-sm text-brandGrey-normalLight mb-1">{{ $coupon['description'] }}</p>
                                    </div>
                                    <p class="expiry-date">有效期限：{{ $coupon['expiry_date'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

    <style>
        /* 列表視圖樣式 */
        .view-list {
            display: block;
        }
        
        .view-list .coupon-item {
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem;
            position: relative;
        }
        
        .view-list .coupon-item:last-child {
            border-bottom: none;
        }
        
        .view-list .coupon-item:hover {
            background-color: #f9fafb;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            cursor: pointer;
        }
        
        .view-list .status-badge {
            display: inline-block;
            position: absolute;
            right: 1rem;
            top: 1rem;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            background-color: #e5e7eb;
            color: #6b7280;
        }
        
        .view-list .expiry-date {
            margin-top: 0.5rem;
        }
        
        /* 網格視圖樣式 - 改進版 */
        .view-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 1.25rem;
            padding: 1.25rem;
        }
        
        @media (min-width: 640px) {
            .view-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (min-width: 1024px) {
            .view-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        .view-grid .coupon-item {
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            padding: 1.25rem;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
            position: relative;
            overflow: hidden;
            background: linear-gradient(to bottom right, #ffffff, #f9fafb);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        
        .view-grid .coupon-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, #3b82f6, #60a5fa);
            opacity: 0.8;
        }
        
        .view-grid .coupon-active:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            cursor: pointer;
        }
        
        .view-grid .coupon-item h4 {
            margin-bottom: 0.75rem;
            font-size: 1.125rem;
            line-height: 1.4;
            color: #374151;
        }
        
        .view-grid .coupon-item p {
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }
        
        .view-grid .coupon-item .expiry-date {
            margin-top: auto;
            padding-top: 0.75rem;
            font-size: 0.875rem;
            color: #6b7280;
            border-top: 1px dashed #e5e7eb;
        }
        
        /* 已使用/已過期優惠券樣式 */
        .coupon-used, .coupon-expired {
            opacity: 0.7;
        }
        
        .view-grid .coupon-used::before, .view-grid .coupon-expired::before {
            background: linear-gradient(to right, #9ca3af, #d1d5db);
        }
        
        .coupon-used:hover, .coupon-expired:hover {
            transform: none !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05) !important;
            cursor: default !important;
        }
        
        /* 即將到期優惠券樣式 */
        .view-grid .coupon-expiring::before {
            background: linear-gradient(to right, #f59e0b, #fbbf24);
        }
        
        .expiring-badge {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            background-color: #fff7ed;
            color: #9a3412;
            display: flex;
            align-items: center;
            gap: 0.25rem;
            border: 1px solid #fed7aa;
        }
        
        /* 狀態標籤樣式 */
        .view-grid .status-badge {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .view-grid .coupon-used .status-badge {
            background-color: #e5e7eb;
            color: #6b7280;
        }
        
        .view-grid .coupon-expired .status-badge {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        /* 視圖切換按鈕樣式 */
        .view-toggle-btn {
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
            color: #6b7280;
        }
        
        .view-toggle-btn.active {
            background-color: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }
    </style>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 獲取視圖切換按鈕和容器元素
            const listViewBtn = document.getElementById('list-view-btn');
            const gridViewBtn = document.getElementById('grid-view-btn');
            const couponContainers = document.querySelectorAll('.view-list, .view-grid');
            
            // 切換到列表視圖
            listViewBtn.addEventListener('click', function() {
                switchView('list');
                saveViewPreference('list');
            });
            
            // 切換到網格視圖
            gridViewBtn.addEventListener('click', function() {
                switchView('grid');
                saveViewPreference('grid');
            });
            
            // 切換視圖函數
            function switchView(viewType) {
                // 更新按鈕狀態
                if (viewType === 'list') {
                    listViewBtn.classList.add('active');
                    gridViewBtn.classList.remove('active');
                } else {
                    gridViewBtn.classList.add('active');
                    listViewBtn.classList.remove('active');
                }
                
                // 更新容器類名
                couponContainers.forEach(container => {
                    if (viewType === 'list') {
                        container.classList.remove('view-grid');
                        container.classList.add('view-list');
                    } else {
                        container.classList.remove('view-list');
                        container.classList.add('view-grid');
                    }
                });
            }
            
            // 保存視圖偏好到服務器
            function saveViewPreference(viewType) {
                fetch('{{ route('user.coupons.switch-view') }}?view_type=' + viewType, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).then(response => {
                    if (!response.ok) {
                        console.error('保存視圖偏好失敗');
                    }
                }).catch(error => {
                    console.error('保存視圖偏好出錯:', error);
                });
            }
            
            // 為可用優惠券添加點擊事件
            // const activeCoupons = document.querySelectorAll('#coupon-container .coupon-item');
            // activeCoupons.forEach(coupon => {
            //     coupon.addEventListener('click', function() {
            //         // 獲取優惠券 ID
            //         const couponId = this.dataset.couponId;
            //         if (couponId) {
            //             // 跳轉到優惠券詳情頁面
            //             window.location.href = `/user/coupons/${couponId}`;
            //         }
            //     });
            // });
        });
    </script>
@endpush