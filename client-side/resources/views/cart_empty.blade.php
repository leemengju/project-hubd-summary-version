@extends('layouts.app')

@section('title', '交易成功')
@section('meta_description', '交易成功')
@section('meta_keywords', '交易成功')

@section('content')
<section class="mt-[150px] ">
  <!-- 麵包屑 -->
  <x-breadcrumb :items="[
             ['name' => '首頁', 'url' => route('home')],
             ['name' => '購物車'],
         ]" />

<div class="flex flex-col items-center justify-center w-full  min-h-full gap-5">
    <img class="h-[260px]" src="{{ asset('images/cart_empty/cart_empty.png')   }}" alt="">
    <p class="text-[36px] text-brandGray-normal font-lexend font-semibold">購物車無商品</p>
    <p class="text-[24px] text-brandGray-normal font-normal">您尚沒有選購商品</p>
    <a href="{{ route('home') }}"
        class="flex overflow-hidden items-center py-4  font-bold text-white bg-red-500 rounded-md min-h-[56px] w-[176px] ">
        <span class="goHome self-stretch my-auto mx-auto ">回到首頁</span>
    </a>
</div>
</section>
@endsection
@push('scripts')
<!-- jQuery 內容 -->
@endpush
