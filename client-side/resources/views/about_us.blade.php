@extends('layouts.app')

@section('title', '關於我們')
@section('meta_description', '關於我們')
@section('meta_keywords', '關於我們')


@section('content')

<section class="mt-[150px]">
    <x-breadcrumb :items="[
             ['name' => '首頁', 'url' => route('home')],
             ['name' => '關於我們'],
         ]" />

    <!-- Header -->
    <section
        class="flex flex-col items-center w-full font-light text-center text-zinc-700 
            max-md:max-w-full max-md:px-6"
        style="margin-bottom: 6.25rem;">
        <div class="max-w-full w-[305px]">

            <h2 class="text-3xl leading-snug font-bold whitespace-nowrap">
                364 <br class="hidden lg:block" />
                <span class="mt-[-5px] inline-block relative left-[-5px]">HAPPY UNBIRTHDAY</span>
            </h2>

            <p class="mt-4 text-xl leading-9">since 2020</p>

        </div>
    </section>
    <!-- Brand Story -->
    <section class="text-xl font-normal leading-9 text-center text-zinc-700 max-md:text-lg max-md:px-6"
        style="margin-bottom: 6.25rem;">
        <p class="mt-6">一年中有364天不是生日，但在這些「非生日」的日子裡，我們依舊選擇閃耀發光。</p>
        <p class="mt-6">364HUBD的誕生，源自對日常的熱愛與不妥協的態度，讓平凡的每一天都值得被慶祝。</p>
        <p class="mt-6">在這裡，我們不僅僅創造設計更創造一種生活方式——提醒每個人，</p>
        <p class="mt-6">即使沒有特別的理由，今天依然值得用心生活！</p>
    </section>

    <section
        class="flex flex-wrap justify-between items-center lg:w-[1270px] mx-auto gap-12 
        max-md:flex-col max-md:items-center"
        style="margin-bottom: 100px;">

        <figure class="w-[30%] max-w-[400px] h-[460px] flex-shrink-0 max-md:w-[80%] max-md:h-auto">
            <img src="https://cdn.builder.io/api/v1/image/assets/fff8f95ab9b14906ad7fee76d4c8586f/cbefd3aed4daf175f120182b73b291ce9b6e8e4bf4f31695abdef7b63c6241fd?placeholderIfAbsent=true"
                alt="Brand image 1" class="w-full h-full object-cover rounded-xl" />
        </figure>

        <figure class="w-[30%] max-w-[400px] h-[460px] flex-shrink-0 max-md:w-[80%] max-md:h-auto">
            <img src="https://cdn.builder.io/api/v1/image/assets/fff8f95ab9b14906ad7fee76d4c8586f/594f8bbf49e2000eb3d0c1db379670cb85c65f32e87d28e69580cd7c7eda6eb7?placeholderIfAbsent=true"
                alt="Brand image 2" class="w-full h-full object-cover rounded-xl" />
        </figure>

        <figure class="w-[30%] max-w-[400px] h-[460px] flex-shrink-0 max-md:w-[80%] max-md:h-auto">
            <img src="https://cdn.builder.io/api/v1/image/assets/fff8f95ab9b14906ad7fee76d4c8586f/351e68aacce29594dd601472fc3944d0efc20ce281fd7656670f99454cf1aebb?placeholderIfAbsent=true"
                alt="Brand image 3" class="w-full h-full object-cover rounded-xl" />
        </figure>

    </section>

    <section
        class="flex flex-col pt-1.5 pr-20 pb-5 w-full text-xl font-normal leading-9 text-zinc-700 
           max-md:pr-5 max-md:mt-10 max-md:px-6 
           lg:ml-[calc((100%-1270px)/2)] lg:max-w-[1270px]"
        style="margin-bottom:6.25rem;">

        <article class="self-start max-md:max-w-full">
            <h3 class="font-normal mt-6">為你的日常注入獨特光彩</h3>
            <p class="mt-6">我們相信，真正的風格不需要等待特別的日子來展現。</p>
            <p class="mt-6">無論是平凡的星期一，還是忙碌的星期五，每一天都值得被珍視。</p>
        </article>

        <article>
            <p class="mt-6">364HUBD 不僅提供時尚服飾與配件，還涵蓋設計諮詢、客製化商品與限量聯名合作，為你創造全方位的潮流體驗。</p>
            <p class="mt-6">364HUBD 致力於為每一位獨一無二的你，提供不被定義的設計與靈感，</p>
            <p class="mt-6">讓你在364個「非生日」裡，都能找到屬於自己的風格與態度。</p>
            <p class="mt-6">因為我們知道，光芒不需要等到特別時刻才能綻放。</p>
        </article>
    </section>

    <section class="flex justify-center" style="margin-bottom:6.25rem;">
        <figure class="overflow-hidden" style="width: 1270px; height: 705px; border-radius: 10px;">
            <img src="{{ asset('images/all.jpg') }}" alt="Brand image" class="w-full h-full object-cover" />
        </figure>
    </section>


    <section class="mx-auto lg:max-w-[1270px]" style="margin-bottom:6.25rem;">
        <div class="flex items-center gap-16 max-md:flex-col max-md:items-center max-md:space-y-6">

            <!-- 圖片 -->
            <img src="https://cdn.builder.io/api/v1/image/assets/fff8f95ab9b14906ad7fee76d4c8586f/2c965e66c4fc625573d8fcf9c38cdbd541277e7ff3e459222341cdec8b0752d4"
                alt="Workspace image"
                class="object-cover w-[499px] flex-shrink-0 rounded-xl max-md:w-[90%] max-md:h-auto"
                style="height: 584px;" />

            <!-- 文字區塊 -->
            <div
                class="w-full lg:min-w-[750px] text-xl font-normal leading-9 text-zinc-700 
                           max-md:mt-10 max-md:max-w-full max-md:px-6 max-md:pl-0 lg:pl-20">
                <h3 class="font-normal">靈感誕生的空間</h3>
                <p class="mt-6">364HUBD 的工作室位於淡水，鄰近海邊，</p>
                <p class="mt-6">將現代簡約風格，沒有過多修飾，純粹且貼近日常。</p>
                <p class="mt-6">微鹹的海風與淡水獨有的悠閒氛圍，成為我們靈感的泉源。</p>
                <p class="mt-6">無論是靜謐的夕陽還是波光粼粼的水面，都激發著我們對設計的熱情。</p>
                <p class="mt-6">在這片連結自然與創意的空間裡，我們將每一個想法化為現實，</p>
                <p class="mt-6">讓每位造訪者都能感受無限可能與純粹熱情。</p>
            </div>
        </div>
    </section>

    <!-- Google Maps -->
    <section class="flex justify-center">
        <div class="w-full lg:max-w-[1270px] mx-auto overflow-hidden rounded-lg shadow-lg px-6 
                        max-md:w-full max-md:h-[400px]"
            style="height: 800px;">
            <iframe class="w-full h-full max-md:h-[400px]"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3610.201743644777!2d121.42239877543093!3d25.19641813173205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3442bb0d8aa42a71%3A0x2d078bc91be4932f!2s364%20HAPPY%20UNBIRTHDAY!5e0!3m2!1szh-TW!2stw!4v1741014934074!5m2!1szh-TW!2stw"
                style="border:0; height: 100%;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </section>

</section>

@endsection


@push('scripts')
<!-- <script type="module" src="{{ asset('resources/js/home.js') }}"></script> -->
@endpush