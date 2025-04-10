@extends('layouts.with_sidebar')

@section('title', '個人檔案')
@section('meta_description', '管理您的個人資料')
@section('meta_keywords', '個人檔案, 會員中心')
@section('breadcrumb_title', '個人檔案')

@section('main_content')
    <div class="w-full p-4 sm:p-6 bg-white rounded-lg shadow-sm">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <h1 class="text-xl sm:text-2xl font-bold text-brandGray-normal mb-2 sm:mb-0">個人檔案</h1>
            <div class="flex items-center gap-2">
            <!-- 變更密碼按鈕 -->
            <a href="{{ route('user.change_password') }}" class="inline-flex items-center justify-center px-4 py-2 bg-brandGray-light text-brandGray-normal rounded-md hover:bg-brandGray-lightHover hover:text-brandGray-normalHover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandGray-lightActive transition-colors duration-200">
                    <i class="icon-[mdi--lock-outline] w-5 h-5 mr-2"></i>
                    變更密碼
                </a>
            <!-- 編輯個人資料按鈕 -->
            <a href="{{ route('user.edit_profile') }}" class="inline-flex items-c
            enter justify-center px-4 py-2 bg-brandBlue-normal text-white rounded-md hover:bg-brandBlue-normalHover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandBlue-normal transition-colors duration-200">
                <i class="icon-[mdi--account-edit-outline] w-5 h-5 mr-2"></i>
                編輯個人資料
            </a>
            </div>
        </div>
        
        <!-- 個人資料 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-lg font-medium text-brandGrey-normal mb-4">基本資料</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-brandGray-normalLight">姓名</p>
                        <p class="text-brandGray-normal">{{ $user->name ?? '未設定' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-brandGray-normalLight">電子郵件</p>
                        <p class="text-brandGray-normal break-all">{{ $user->email ?? '未設定' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-brandGray-normalLight">手機號碼</p>
                        <p class="text-brandGray-normal">{{ $user->phone ?? '未設定' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-brandGray-normalLight">生日</p>
                        <p class="text-brandGray-normal">{{ $user->birthday ?? '未設定' }}</p>
                    </div>
                </div>
            </div>
            
            <div>
                <h2 class="text-lg font-medium text-brandGrey-normal mb-4">帳戶資訊</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-brandGray-normalLight">註冊日期</p>
                        <p class="text-brandGray-normal">{{ $user->created_at ? $user->created_at->format('Y/m/d') : '未記錄' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-brandGray-normalLight">最後變更</p>
                        <p class="text-brandGray-normal">{{ $user->updated_at ? $user->updated_at->format('Y/m/d') : '未記錄' }}</p>
                    </div>
                </div>
            </div>
        </div>
        
       
        
        <!-- 通知設定 -->
        <div class="mt-8 pt-6 border-t border-brandGrey-light">
            <h2 class="text-lg font-medium text-brandGrey-normal mb-4">通知設定</h2>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input type="checkbox" id="email_notification" checked class="h-4 w-4 text-brandBlue-normal focus:ring-brandBlue-normal border-brandGrey-lightActive rounded">
                    </div>
                    <div class="ml-3">
                        <label for="email_notification" class="text-brandGrey-normal">電子郵件通知</label>
                        <p class="text-sm text-brandGrey-normalLight">接收訂單更新、優惠活動等相關通知</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input type="checkbox" id="sms_notification" class="h-4 w-4 text-brandBlue-normal focus:ring-brandBlue-normal border-brandGrey-lightActive rounded">
                    </div>
                    <div class="ml-3">
                        <label for="sms_notification" class="text-brandGrey-normal">簡訊通知</label>
                        <p class="text-sm text-brandGrey-normalLight">接收訂單狀態更新和重要通知</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input type="checkbox" id="marketing_notification" checked class="h-4 w-4 text-brandBlue-normal focus:ring-brandBlue-normal border-brandGrey-lightActive rounded">
                    </div>
                    <div class="ml-3">
                        <label for="marketing_notification" class="text-brandGrey-normal">行銷通知</label>
                        <p class="text-sm text-brandGrey-normalLight">接收最新商品、促銷活動和專屬優惠資訊</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 