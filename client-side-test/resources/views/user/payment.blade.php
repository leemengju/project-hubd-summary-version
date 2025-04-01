@extends('layouts.with_sidebar')

@section('title', '付款資訊')
@section('meta_description', '管理您的付款方式')
@section('meta_keywords', '付款資訊, 信用卡, 會員中心')
@section('breadcrumb_title', '付款資訊')

@section('main_content')
    <div class="w-full p-4 sm:p-6 bg-white rounded-lg shadow-sm">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <h1 class="text-xl sm:text-2xl font-bold text-brandGrey-normal mb-3 sm:mb-0">付款資訊</h1>
            <a href="{{ route('user.payment.add') }}" class="px-3 py-1.5 sm:px-4 sm:py-2 bg-brandBlue-normal text-white rounded-md hover:bg-brandBlue-normalHover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandBlue-normal whitespace-nowrap">
                <i class="icon-[mdi--credit-card-plus-outline] w-5 h-5 mr-2"></i>
                新增付款方式
            </a>
        </div>
        
        <!-- 付款方式列表 -->
        <div class="space-y-4">
            <!-- 信用卡 1 -->
            <div class="border border-brandGrey-light rounded-lg overflow-hidden">
                <div class="bg-brandGrey-lightLight p-4 flex flex-wrap justify-between items-center">
                    <div class="flex items-center">
                        <i class="icon-[mdi--credit-card] w-6 h-6 text-brandGrey-normal mr-2"></i>
                        <h3 class="font-medium text-brandGrey-normal">信用卡</h3>
                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-brandBlue-light text-brandBlue-normal">
                            預設
                        </span>
                    </div>
                    <div class="flex space-x-2 mt-2 sm:mt-0">
                        <a href="{{ route('user.payment.edit', 1) }}" class="text-brandGrey-normalLight hover:text-brandGrey-normal">
                            <i class="icon-[mdi--pencil] w-5 h-5"></i>
                        </a>
                        <form action="{{ route('user.payment.delete', 1) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-brandGrey-normalLight hover:text-brandRed-normal" onclick="return confirm('確定要刪除此付款方式嗎？')">
                                <i class="icon-[mdi--delete] w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="p-4">
                    <div class="space-y-2">
                        <p class="text-brandGrey-normal">**** **** **** 1234</p>
                        <p class="text-sm text-brandGrey-normalLight">到期日: 12/25</p>
                        <p class="text-sm text-brandGrey-normalLight">持卡人: 王小明</p>
                    </div>
                </div>
            </div>
            
            <!-- 信用卡 2 -->
            <div class="border border-brandGrey-light rounded-lg overflow-hidden">
                <div class="bg-brandGrey-lightLight p-4 flex flex-wrap justify-between items-center">
                    <div class="flex items-center">
                        <i class="icon-[mdi--credit-card] w-6 h-6 text-brandGrey-normal mr-2"></i>
                        <h3 class="font-medium text-brandGrey-normal">信用卡</h3>
                    </div>
                    <div class="flex space-x-2 mt-2 sm:mt-0">
                        <button class="text-brandGrey-normalLight hover:text-brandGrey-normal">
                            <i class="icon-[mdi--pencil] w-5 h-5"></i>
                        </button>
                        <button class="text-brandGrey-normalLight hover:text-brandRed-normal">
                            <i class="icon-[mdi--delete] w-5 h-5"></i>
                        </button>
                    </div>
                </div>
                <div class="p-4">
                    <div class="space-y-2">
                        <p class="text-brandGrey-normal">**** **** **** 5678</p>
                        <p class="text-sm text-brandGrey-normalLight">到期日: 09/24</p>
                        <p class="text-sm text-brandGrey-normalLight">持卡人: 王小明</p>
                    </div>
                    <div class="mt-3">
                        <button class="text-sm text-brandBlue-normal hover:text-brandBlue-normalHover">設為預設</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 付款安全說明 -->
        <div class="mt-8 p-4 bg-brandGrey-lightLight rounded-lg">
            <h3 class="text-lg font-medium text-brandGrey-normal mb-2">付款安全說明</h3>
            <p class="text-sm text-brandGrey-normalLight mb-2">
                我們使用業界標準的加密技術來保護您的付款資訊安全。您的信用卡資訊將被加密存儲，我們不會儲存您的 CVV 安全碼。
            </p>
            <p class="text-sm text-brandGrey-normalLight">
                如有任何付款相關問題，請聯繫我們的客服團隊：service@example.com
            </p>
        </div>
    </div>
@endsection 