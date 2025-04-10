@extends('layouts.with_sidebar')

@section('title', '收件地址')
@section('meta_description', '管理您的收件地址')
@section('meta_keywords', '收件地址, 會員中心')
@section('breadcrumb_title', '收件地址')

@section('main_content')
    <div class="w-full p-4 sm:p-6 bg-white rounded-lg shadow-sm">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <h1 class="text-xl sm:text-2xl font-bold text-brandGray-normal mb-3 sm:mb-0">收件地址</h1>
            <a href="{{ route('user.address.add') }}" class="px-3 py-1.5 sm:px-4 sm:py-2 bg-brandBlue-normal text-white rounded-md hover:bg-brandBlue-normalHover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandBlue-normal whitespace-nowrap">
                <i class="icon-[mdi--map-marker-plus-outline] w-5 h-5 mr-2"></i>
                新增收件地址
            </a>
        </div>
        
        <!-- 地址列表 -->
        <div class="space-y-4">
            <!-- 地址 1 -->
            <div class="border border-brandGray-light rounded-lg overflow-hidden">
                <div class="bg-brandGray-lightLight p-4 flex flex-wrap justify-between items-center">
                    <div class="flex items-center">
                        <i class="icon-[mdi--map-marker] w-6 h-6 text-brandGray-normal mr-2"></i>
                        <h3 class="font-medium text-brandGray-normal">住家地址</h3>
                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-brandBlue-light text-brandBlue-normal">
                            預設
                        </span>
                    </div>
                    <div class="flex space-x-2 mt-2 sm:mt-0">
                        <a href="{{ route('user.address.edit', 1) }}" class="text-brandGray-normalLight hover:text-brandGray-normal">
                            <i class="icon-[mdi--pencil] w-5 h-5"></i>
                        </a>
                        <form action="{{ route('user.address.delete', 1) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-brandGray-normalLight hover:text-brandRed-normal" onclick="return confirm('確定要刪除此地址嗎？')">
                                <i class="icon-[mdi--delete] w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="p-4">
                    <div class="space-y-2">
                        <p class="text-brandGray-normal">王小明</p>
                        <p class="text-brandGray-normal">0912-345-678</p>
                        <p class="text-brandGray-normal">台北市信義區信義路五段7號</p>
                        <p class="text-sm text-brandGray-normalLight">郵遞區號: 110</p>
                    </div>
                </div>
            </div>
            
            <!-- 地址 2 -->
            <div class="border border-brandGray-light rounded-lg overflow-hidden">
                <div class="bg-brandGray-lightLight p-4 flex flex-wrap justify-between items-center">
                    <div class="flex items-center">
                        <i class="icon-[mdi--map-marker] w-6 h-6 text-brandGray-normal mr-2"></i>
                        <h3 class="font-medium text-brandGray-normal">公司地址</h3>
                    </div>
                    <div class="flex space-x-2 mt-2 sm:mt-0">
                        <a href="{{ route('user.address.edit', 2) }}" class="text-brandGray-normalLight hover:text-brandGray-normal">
                            <i class="icon-[mdi--pencil] w-5 h-5"></i>
                        </a>
                        <form action="{{ route('user.address.delete', 2) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-brandGray-normalLight hover:text-brandRed-normal" onclick="return confirm('確定要刪除此地址嗎？')">
                                <i class="icon-[mdi--delete] w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="p-4">
                    <div class="space-y-2">
                        <p class="text-brandGray-normal">王小明</p>
                        <p class="text-brandGray-normal">0912-345-678</p>
                        <p class="text-brandGray-normal">台北市內湖區瑞光路513巷</p>
                        <p class="text-sm text-brandGray-normalLight">郵遞區號: 114</p>
                    </div>
                    <div class="mt-3">
                        <form action="{{ route('user.address.update', 2) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="set_default" value="1">
                            <button type="submit" class="text-sm text-brandBlue-normal hover:text-brandBlue-normalHover">設為預設</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 地址說明 -->
        <div class="mt-8 p-4 bg-brandGray-lightLight rounded-lg">
            <h3 class="text-lg font-medium text-brandGray-normal mb-2">地址說明</h3>
            <p class="text-sm text-brandGray-normalLight mb-2">
                您可以新增多個收件地址，並設定一個預設地址。在結帳時，系統會自動選擇您的預設地址，但您仍可以選擇其他已儲存的地址。
            </p>
            <p class="text-sm text-brandGray-normalLight">
                如有任何地址相關問題，請聯繫我們的客服團隊：service@example.com
            </p>
        </div>
    </div>
@endsection 