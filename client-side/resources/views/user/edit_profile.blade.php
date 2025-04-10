@extends('layouts.with_sidebar')

@section('title', '編輯個人資料')
@section('meta_description', '更新您的個人資料')
@section('meta_keywords', '個人資料, 編輯, 會員中心')
@section('breadcrumb_title', '編輯個人資料')

@section('main_content')
    <div class="w-full p-4 sm:p-6 bg-white rounded-lg shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl sm:text-2xl font-bold text-brandGrey-normal">編輯個人資料</h1>
            <a href="{{ route('user.user_profile') }}" class="px-3 py-1.5 sm:px-4 sm:py-2 border border-brandGrey-lightActive text-brandGrey-normal rounded-md hover:bg-brandGrey-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandGrey-light">
                返回個人檔案
            </a>
        </div>
        
        <form action="{{ route('user.user_profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- 基本資料 -->
            <div class="border border-brandGrey-light rounded-lg overflow-hidden">
                <div class="bg-brandGrey-lightLight p-4 border-b border-brandGrey-light">
                    <h2 class="text-lg font-semibold text-brandGrey-normal">基本資料</h2>
                </div>
                <div class="p-4 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-brandGrey-normal mb-1">姓名</label>
                            <input type="text" id="name" name="name" value="王小明" class="w-full px-3 py-2 border border-brandGrey-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-brandGrey-normal mb-1">電子郵件</label>
                            <input type="email" id="email" name="email" value="example@mail.com" class="w-full px-3 py-2 border border-brandGrey-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-brandGrey-normal mb-1">手機號碼</label>
                            <input type="tel" id="phone" name="phone" value="0912-345-678" class="w-full px-3 py-2 border border-brandGrey-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal">
                        </div>
                        <div>
                            <label for="birthday" class="block text-sm font-medium text-brandGrey-normal mb-1">生日</label>
                            <input type="date" id="birthday" name="birthday" value="1990-01-01" class="w-full px-3 py-2 border border-brandGrey-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- 通知設定 -->
            <div class="border border-brandGrey-light rounded-lg overflow-hidden">
                <div class="bg-brandGrey-lightLight p-4 border-b border-brandGrey-light">
                    <h2 class="text-lg font-semibold text-brandGrey-normal">通知設定</h2>
                </div>
                <div class="p-4 space-y-4">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox" id="email_notification" name="email_notification" checked class="h-4 w-4 text-brandBlue-normal focus:ring-brandBlue-normal border-brandGrey-lightActive rounded">
                        </div>
                        <div class="ml-3">
                            <label for="email_notification" class="text-brandGrey-normal">電子郵件通知</label>
                            <p class="text-sm text-brandGrey-normalLight">接收訂單更新、優惠活動等相關通知</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox" id="sms_notification" name="sms_notification" class="h-4 w-4 text-brandBlue-normal focus:ring-brandBlue-normal border-brandGrey-lightActive rounded">
                        </div>
                        <div class="ml-3">
                            <label for="sms_notification" class="text-brandGrey-normal">簡訊通知</label>
                            <p class="text-sm text-brandGrey-normalLight">接收訂單狀態更新和重要通知</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox" id="marketing_notification" name="marketing_notification" checked class="h-4 w-4 text-brandBlue-normal focus:ring-brandBlue-normal border-brandGrey-lightActive rounded">
                        </div>
                        <div class="ml-3">
                            <label for="marketing_notification" class="text-brandGrey-normal">行銷通知</label>
                            <p class="text-sm text-brandGrey-normalLight">接收最新商品、促銷活動和專屬優惠資訊</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- 提交按鈕 -->
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-brandBlue-normal text-white rounded-md hover:bg-brandBlue-normalHover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandBlue-normal">
                    儲存變更
                </button>
            </div>
        </form>
    </div>
@endsection 