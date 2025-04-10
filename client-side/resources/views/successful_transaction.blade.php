@extends('layouts.app')

@section('title', '交易成功')
@section('meta_description', '交易成功')
@section('meta_keywords', '交易成功')

@section('content')
<section class="mt-[150px] ">
  <!-- 麵包屑 -->
  <x-breadcrumb :items="[
             ['name' => '首頁', 'url' => route('home')],
             ['name' => '交易成功'],
         ]" />

<div class="flex flex-col items-center justify-center w-full  min-h-full gap-5">
    <img class="h-[260px]" src="{{ asset('images/successful_transaction/success.png')   }}" alt="">
    <p class="text-[36px] text-brandGray-normal font-lexend font-semibold">交易成功~</p>
    <p class="text-[24px] text-brandGray-normal font-normal">恭喜你買到本日份的幸福時光</p>
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
