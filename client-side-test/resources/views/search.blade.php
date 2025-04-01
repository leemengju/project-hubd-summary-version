@extends('layouts.app')

@section('title', '搜尋商品')
@section('meta_description', '搜尋')
@section('meta_keywords', 'search, 搜尋')

@section('content')
<section class="mt-[150px] flex flex-col justify-center items-center">
    <!-- 麵包屑 -->
    <x-breadcrumb :items="[
             ['name' => '首頁', 'url' => route('home')],
             ['name' => '搜尋商品'],
         ]" />

    <div class="w-full mb-10 px-[120px] text-md text-brandRed-lightActive">
        <p>關鍵字：{{$keywords}}</p>
    </div>

    <!-- 標題文字 -->
    <section class="w-full mt-5 pt-10 flex justify-center items-center">
        <!-- 商品卡片區 -->
        <section class="product-section w-full h-[4800px] md:h-[1580px] lg:h-[1240px] flex flex-col justify-start items-center mb-[60px]">
            <div class="w-full md:w-[770px] lg:w-[1230px] h-[418px] grid md:grid-cols-3 lg:grid-cols-4 justify-center items-center gap-5">
                @foreach($results as $index => $result)
                <!-- 商品 -->
                <a href="{{route('product_details', ['id' => $result->product_id])}}" class="product-card w-[250px] lg:w-[300px] h-[250px] md:h-full flex flex-col justify-center items-center hover:opacity-80 gap-5 mb-32 md:mb-14">
                    <div class="relative w-full h-[250px] lg:w-[300px] lg:h-[300px]">
                        <img src="{{ 'http://localhost:8000/storage/' . $result->product_img}}" alt="{{$result->product_name}}" class="w-full h-[250px] md:h-full object-cover">
                    </div>
                    <div class="w-full h-[74px] flex flex-col justify-center items-start gap-5 text-[20px]">
                        <p class="text-brandGrey-darker">{{$result->product_name}}</p>
                        <p class="text-brandGrey-normal text-[18px]">NT$&nbsp;<span id="price">{{$result->product_price}}</span></p>
                    </div>
                </a>
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