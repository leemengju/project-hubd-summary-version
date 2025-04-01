@extends('layouts.app')

@section('title', '飾品')
@section('meta_description', '商品分類：飾品')
@section('meta_keywords', 'accessories, 飾品')

@section('content')
<section class="mt-[150px] flex flex-col justify-center items-center">
    <!-- 麵包屑 -->
    <x-breadcrumb :items="[
             ['name' => '首頁', 'url' => route('home')],
             ['name' => '飾品'],
         ]" />

    <!-- 標題文字 -->
    <section class="w-full mt-5 pt-10 flex justify-center items-center">
        <!-- 商品卡片區 -->
        <section class="product-section w-full h-[4800px] md:h-[1580px] lg:h-[1240px] flex flex-col justify-start items-center mb-[60px]">
            <div class="w-full md:w-[770px] lg:w-[1230px] h-[418px] grid md:grid-cols-3 lg:grid-cols-4 justify-center items-center gap-5">
                @foreach($accessories->sortByDesc(function($item) {
                return $item->specs_sum_product_stock > 0;
                }) as $index => $accessory)
                @if($accessory->specs_sum_product_stock == 0)
                <!-- 無連結商品卡片 -->
                <div class="product-card w-[250px] lg:w-[300px] h-[250px] md:h-full flex flex-col justify-center items-center gap-5 mb-32 md:mb-14 cursor-default">
                    <div class="relative w-full h-[250px] lg:w-[300px] lg:h-[300px]">
                        <div class="absolute w-36 h-14 bg-brandGray-light bg-opacity-20 text-[24px] text-brandGray-light flex justify-center items-center top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-30">SOLD OUT</div>
                        <div class="absolute w-full h-full bg-brandGray-normal opacity-60 flex justify-center items-center top-0 left-0"></div>
                        <img src="{{ 'http://localhost:8000/storage/' . $accessory->product_img}}" alt="{{$accessory->product_name}}" class="w-full h-[250px] md:h-full object-cover">
                    </div>
                    <div class="w-full h-[74px] flex flex-col justify-center items-start gap-5 text-[20px]">
                        <p class="text-brandGrey-darker">{{$accessory->product_name}}</p>
                        <p class="text-brandGrey-normal text-[18px]">NT$&nbsp;<span id="price">{{$accessory->product_price}}</span></p>
                    </div>
                </div>
                @else
                <!-- 有連結商品卡片 -->
                <a href="{{route('product_details', ['id' => $accessory->product_id])}}" class="product-card w-[250px] lg:w-[300px] h-[250px] md:h-full flex flex-col justify-center items-center hover:opacity-80 gap-5 mb-32 md:mb-14">
                    <div class="relative w-full h-[250px] lg:w-[300px] lg:h-[300px]">
                        <img src="{{ 'http://localhost:8000/storage/' . $accessory->product_img}}" alt="{{$accessory->product_name}}" class="w-full h-[250px] md:h-full object-cover">
                    </div>
                    <div class="w-full h-[74px] flex flex-col justify-center items-start gap-5 text-[20px]">
                        <p class="text-brandGrey-darker">{{$accessory->product_name}}</p>
                        <p class="text-brandGrey-normal text-[18px]">NT$&nbsp;<span id="price">{{$accessory->product_price}}</span></p>
                    </div>
                </a>
                @endif
                @endforeach

            </div>
        </section>
    </section>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        function updateSectionHeight() {
            let totalItems = $(".product-card").length; // 取得商品總數
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
            let newHeight = totalRows * 450; // 每列 450px

            // 設定高度
            $(".product-section").css("height", newHeight + "px");
        }

        // 初始化
        updateSectionHeight();

        // 監聽視窗縮放，調整高度
        $(window).resize(function() {
            updateSectionHeight();
        });
    });
</script>
@endpush