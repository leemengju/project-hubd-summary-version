@extends('layouts.with_sidebar')

@section('title', '變更密碼')
@section('meta_description', '更新您的帳戶密碼')
@section('meta_keywords', '密碼, 安全, 會員中心')
@section('breadcrumb_title', '變更密碼')

@section('main_content')
    <div class="w-full p-4 sm:p-6 bg-white rounded-lg shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl sm:text-2xl font-bold text-brandGrey-normal">變更密碼</h1>
            <a href="{{ route('user.user_profile') }}" class="px-3 py-1.5 sm:px-4 sm:py-2 border border-brandGrey-lightActive text-brandGrey-normal rounded-md hover:bg-brandGrey-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandGrey-light">
                返回個人檔案
            </a>
        </div>
        
        <form action="{{ route('user.change_password.update') }}" method="POST" class="max-w-md mx-auto">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label for="current_password" class="block text-sm font-medium text-brandGrey-normal mb-1">目前密碼</label>
                    <input type="password" id="current_password" name="current_password" class="w-full px-3 py-2 border border-brandGrey-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal" required>
                </div>
                
                <div>
                    <label for="new_password" class="block text-sm font-medium text-brandGrey-normal mb-1">新密碼</label>
                    <input type="password" id="new_password" name="new_password" class="w-full px-3 py-2 border border-brandGrey-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal" required>
                    <p class="mt-1 text-sm text-brandGrey-normalLight">密碼必須至少包含 8 個字符，並包含字母和數字</p>
                </div>
                
                <div>
                    <label for="new_password_confirmation" class="block text-sm font-medium text-brandGrey-normal mb-1">確認新密碼</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="w-full px-3 py-2 border border-brandGrey-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal" required>
                </div>
                
                <div class="pt-4">
                    <button type="submit" class="w-full px-4 py-2 bg-brandBlue-normal text-white rounded-md hover:bg-brandBlue-normalHover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandBlue-normal">
                        更新密碼
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection 