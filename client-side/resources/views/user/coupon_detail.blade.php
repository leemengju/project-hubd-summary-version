@extends('layouts.with_sidebar')

@section('title', '優惠券詳情')
@section('meta_description', '查看優惠券詳細資訊')
@section('meta_keywords', '優惠券, 折扣, 會員中心')
@section('breadcrumb_title', '優惠券詳情')

@section('main_content')
    <div class="w-full p-4 sm:p-6 bg-white rounded-lg shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl sm:text-2xl font-bold text-brandGrey-normal">優惠券詳情</h1>
            <a href="{{ route('user.coupons') }}" class="px-3 py-1.5 sm:px-4 sm:py-2 border border-brandGrey-lightActive text-brandGrey-normal rounded-md hover:bg-brandGrey-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandGrey-light">
                返回列表
            </a>
        </div>
        
        <div class="border border-brandGray-light rounded-lg overflow-hidden">
            <div class="bg-brandGray-lightLight p-4 border-b border-brandGray-light flex justify-between items-center">
                <h2 class="text-lg font-semibold text-brandGray-normal">{{ $coupon['title'] }}</h2>
                @if($coupon['status'] === 'active')
                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                        可使用
                    </span>
                @elseif($coupon['status'] === 'expired' || $coupon['status'] === 'disabled')
                    <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">
                        已過期
                    </span>
                @elseif($coupon['status'] === 'scheduled')
                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                        即將開始
                    </span>
                @endif
                
                @if(isset($coupon['is_used']) && $coupon['is_used'])
                    <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">
                        已使用
                    </span>
                @endif
            </div>
            <div class="p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-md font-medium text-brandGrey-normal mb-2">優惠券資訊</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-brandGrey-normalLight">優惠說明</p>
                                <p class="text-brandGrey-normal">{{ $coupon['description'] }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-brandGrey-normalLight">優惠碼</p>
                                <div class="flex items-center">
                                    <p class="text-brandGrey-normal font-mono bg-brandGrey-lightLight px-2 py-1 rounded mr-2">{{ $coupon['code'] }}</p>
                                    <button type="button" class="text-brandBlue-normal hover:text-brandBlue-normalHover" onclick="copyToClipboard('{{ $coupon['code'] }}')">
                                        <i class="icon-[mdi--content-copy] w-5 h-5"></i>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-brandGrey-normalLight">有效期限</p>
                                <p class="text-brandGrey-normal">{{ $coupon['expiry_date'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-md font-medium text-brandGray-normal mb-2">使用條款</h3>
                        <div class="text-brandGray-normal whitespace-pre-line">
                            {{ $coupon['terms'] }}
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 pt-4 border-t border-brandGray-light">
                    @if($coupon['status'] === 'active' && (!isset($coupon['is_used']) || !$coupon['is_used']))
                        <a href="/categories/all" class="inline-block px-4 py-2 bg-brandBlue-normal text-white rounded-md hover:bg-brandBlue-normalHover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandBlue-normal">
                            立即使用
                        </a>
                    @elseif(isset($coupon['is_used']) && $coupon['is_used'])
                        <p class="inline-block px-4 py-2 bg-gray-200 text-gray-500 rounded-md cursor-not-allowed">
                            已使用
                        </p>
                    @elseif($coupon['status'] === 'expired' || $coupon['status'] === 'disabled')
                        <p class="inline-block px-4 py-2 bg-gray-200 text-gray-500 rounded-md cursor-not-allowed">
                            已過期
                        </p>
                    @elseif($coupon['status'] === 'scheduled')
                        <p class="inline-block px-4 py-2 bg-gray-200 text-gray-500 rounded-md cursor-not-allowed">
                            尚未開始
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('優惠碼已複製到剪貼簿');
            }, function(err) {
                console.error('無法複製文字: ', err);
            });
        }
    </script>
@endpush 