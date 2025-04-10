@extends('layouts.app')

@section('title', '服飾')
@section('meta_description', '商品分類：服飾')
@section('meta_keywords', '衣服, 服飾')

{{-- 麵包屑的東西 --}}
@php
$from = $from ?? request('from');
$initialTab = 0;
if ($from === 'long') {
$initialTab = 1;
} elseif ($from === 'jacket') {
$initialTab = 2;
}
@endphp


@section('content')
<section class="mt-[150px]">
    <!-- 麵包屑 -->
    <x-breadcrumb :items="[
             ['name' => '首頁', 'url' => route('home')],
             ['name' => '服飾'],
         ]" />

    <!-- 標題文字 -->
    <section class="w-full">
        <!-- tabs -->
        <x-tabs :tabs="['短袖', '長袖／毛衣', '外套／夾克']" :active-tab="$initialTab">
            <!-- 商品卡片區 短袖 -->
            <div x-show="activeTab === 0">
                <section class="product-section w-full flex flex-col justify-start items-center mt-36 md:mt-20">
                    <div class="w-full md:w-[770px] lg:w-[1230px] h-[418px] grid md:grid-cols-3 lg:grid-cols-4 justify-center items-center gap-5">
                        @foreach($shorts as $index => $short)
                        <!-- 商品 -->
                        <a href="{{ route('product_details', ['id' => $short->product_id, 'from' => 'short']) }}" class="product-card w-[250px] lg:w-[300px] h-[250px] md:h-full flex flex-col justify-center items-center hover:opacity-80 gap-10 mb-52 md:mb-20">
                            <div class="relative w-full h-[250px] lg:w-[300px] lg:h-[300px]">
                                @if($short->specs_sum_product_stock == 0)
                                <div class="absolute w-36 h-14 bg-brandGray-light bg-opacity-20 text-[24px] text-brandGray-light flex justify-center items-center top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-30">SOLD OUT</div>
                                <div class="absolute w-full h-full bg-brandGray-normal opacity-60 flex justify-center items-center top-0 left-0"></div>
                                @endif
                                <img src="{{ 'http://localhost:8000/storage/' . $short->product_img}}" alt="{{$short->product_name}}" class="w-full h-[250px] md:h-full object-cover">
                            </div>
                            <div class="w-full h-[74px] flex flex-col justify-center items-start gap-5 text-[20px]">
                                <p class="text-brandGrey-darker">{{$short->product_name}}</p>
                                <p class="text-brandGrey-normal text-[18px]">NT$&nbsp;<span id="price">{{$short->product_price}}</span></p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </section>
            </div>
            <!-- 商品卡片區 長袖 -->
            <div x-show="activeTab === 1">
                <section class="product-section w-full flex flex-col justify-start items-center mt-36 md:mt-20">
                    <div class="w-full md:w-[770px] lg:w-[1230px] h-[418px] grid md:grid-cols-3 lg:grid-cols-4 justify-center items-center gap-5">
                        @foreach($longs as $index => $long)
                        <!-- 商品 -->
                        <a href="{{ route('product_details', ['id' => $long->product_id, 'from' => 'long']) }}" class="product-card w-[250px] lg:w-[300px] h-[250px] md:h-full flex flex-col justify-center items-center hover:opacity-80 gap-10 mb-52 md:mb-20">
                            <div class="relative w-full h-[250px] lg:w-[300px] lg:h-[300px]">
                                @if($long->specs_sum_product_stock == 0)
                                <div class="absolute w-36 h-14 bg-brandGray-light bg-opacity-20 text-[24px] text-brandGray-light flex justify-center items-center top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-30">SOLD OUT</div>
                                <div class="absolute w-full h-full bg-brandGray-normal opacity-60 flex justify-center items-center top-0 left-0"></div>
                                @endif
                                <img src="{{'http://localhost:8000/storage/' . $long->product_img}}" alt="{{$long->product_name}}" class="w-full h-[250px] md:h-full object-cover">
                            </div>
                            <div class="w-full h-[74px] flex flex-col justify-center items-start gap-5 text-[20px]">
                                <p class="text-brandGrey-darker">{{$long->product_name}}</p>
                                <p class="text-brandGrey-normal text-[18px]">NT$&nbsp;<span id="price">{{$long->product_price}}</span></p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </section>
            </div>
            <!-- 商品卡片區 外套 -->
            <div x-show="activeTab === 2">
                <section class="product-section w-full flex flex-col justify-start items-center mt-36 md:mt-20">
                    <div class="w-full md:w-[770px] lg:w-[1230px] h-[418px] grid md:grid-cols-3 lg:grid-cols-4 justify-center items-center gap-5">
                        @foreach($jackets as $index => $jacket)
                        @if($jacket->specs_sum_product_stock == 0)
                        <!-- 無連結商品卡片 -->
                        <div class="product-card w-[250px] lg:w-[300px] h-[250px] md:h-full flex flex-col justify-center items-center hover:opacity-80 gap-10 mb-52 md:mb-20">
                            <div class="relative w-full h-[250px] lg:w-[300px] lg:h-[300px]">
                                <div class="absolute w-36 h-14 bg-brandGray-light bg-opacity-20 text-[24px] text-brandGray-light flex justify-center items-center top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-30">SOLD OUT</div>
                                <div class="absolute w-full h-full bg-brandGray-normal opacity-60 flex justify-center items-center top-0 left-0"></div>
                                <img src="{{'http://localhost:8000/storage/' . $jacket->product_img}}" alt="{{$jacket->product_name}}" class="w-full h-[250px] md:h-full object-cover">
                            </div>
                            <div class="w-full h-[74px] flex flex-col justify-center items-start gap-5 text-[20px]">
                                <p class="text-brandGrey-darker">{{$jacket->product_name}}</p>
                                <p class="text-brandGrey-normal text-[18px]">NT$&nbsp;<span id="price">{{$jacket->product_price}}</span></p>
                            </div>
                        </div>

                        @else
                        <!-- 有連結商品卡片 -->
                        <a href="{{ route('product_details', ['id' => $jacket->product_id, 'from' => 'jacket']) }}" class="product-card w-[250px] lg:w-[300px] h-[250px] md:h-full flex flex-col justify-center items-center hover:opacity-80 gap-10 mb-52 md:mb-20">
                            <div class="relative w-full h-[250px] lg:w-[300px] lg:h-[300px]">
                                <img src="{{'http://localhost:8000/storage/' . $jacket->product_img}}" alt="{{$jacket->product_name}}" class="w-full h-[250px] md:h-full object-cover">
                            </div>
                            <div class="w-full h-[74px] flex flex-col justify-center items-start gap-5 text-[20px]">
                                <p class="text-brandGrey-darker">{{$jacket->product_name}}</p>
                                <p class="text-brandGrey-normal text-[18px]">NT$&nbsp;<span id="price">{{$jacket->product_price}}</span></p>
                            </div>
                        </a>
                        @endif
                        @endforeach
                    </div>
                </section>
            </div>
        </x-tabs>
    </section>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        function updateSectionHeight() {
            let activeTab = $(".product-section:visible"); // 取得當前可見的 tab
            let totalItems = activeTab.find(".product-card").length; // 取得當前 tab 內的商品總數
            let itemsPerRow = 4; // 預設一列 4 個商品（對應 lg:grid-cols-4）
            let windowWidth = $(window).width();

            // RWD 判斷：不同螢幕寬度的 `grid-cols`
            if (windowWidth < 1024) { // md:grid-cols-3
                itemsPerRow = 3;
            }
            if (windowWidth < 768) { // 手機顯示單列
                itemsPerRow = 1;
            }

            // 計算行數（無條件進位）
            let totalRows = Math.ceil(totalItems / itemsPerRow);
            let newHeight = totalRows * 480; // 每列 480px

            // 只調整當前 `tab` 內的 `product-section` 高度
            activeTab.css("height", newHeight + "px");
        }

        // **初始化：設定當前顯示的 `tab` 高度**
        updateSectionHeight();

        // **監聽 `tabs` 切換**
        $(".tab-button").click(function() {
            setTimeout(updateSectionHeight, 100); // 讓 DOM 更新後再計算
        });

        // **監聽視窗縮放**
        $(window).resize(function() {
            updateSectionHeight();
        });
    });
</script>
@endpush