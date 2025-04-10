@extends('layouts.with_sidebar')

@section('title', '編輯收件地址')
@section('meta_description', '編輯您的收件地址')
@section('meta_keywords', '收件地址, 會員中心')
@section('breadcrumb_title', '編輯收件地址')

@section('main_content')
    <div class="w-full p-4 sm:p-6 bg-white rounded-lg shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl sm:text-2xl font-bold text-brandGrey-normal">編輯收件地址</h1>
            <a href="{{ route('user.address') }}" class="px-3 py-1.5 sm:px-4 sm:py-2 border border-brandGrey-lightActive text-brandGrey-normal rounded-md hover:bg-brandGrey-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandGrey-light">
                返回收件地址
            </a>
        </div>
        
        <form action="{{ route('user.address.update', $id) }}" method="POST" class="max-w-lg mx-auto">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- 地址標籤 -->
                <div>
                    <label for="address_label" class="block text-sm font-medium text-brandGrey-normal mb-1">地址標籤</label>
                    <input type="text" id="address_label" name="address_label" value="{{ $id == 1 ? '住家地址' : '公司地址' }}" class="w-full px-3 py-2 border border-brandGrey-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal" required>
                </div>
                
                <!-- 收件人資訊 -->
                <div class="border border-brandGrey-light rounded-lg p-4">
                    <h3 class="text-lg font-medium text-brandGrey-normal mb-4">收件人資訊</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="recipient_name" class="block text-sm font-medium text-brandGrey-normal mb-1">收件人姓名</label>
                            <input type="text" id="recipient_name" name="recipient_name" value="王小明" class="w-full px-3 py-2 border border-brandGrey-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal" required>
                        </div>
                        
                        <div>
                            <label for="recipient_phone" class="block text-sm font-medium text-brandGrey-normal mb-1">收件人電話</label>
                            <input type="tel" id="recipient_phone" name="recipient_phone" value="0912-345-678" class="w-full px-3 py-2 border border-brandGrey-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal" required>
                        </div>
                    </div>
                </div>
                
                <!-- 地址資訊 -->
                <div class="border border-brandGrey-light rounded-lg p-4">
                    <h3 class="text-lg font-medium text-brandGrey-normal mb-4">地址資訊</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="postal_code" class="block text-sm font-medium text-brandGrey-normal mb-1">郵遞區號</label>
                            <input type="text" id="postal_code" name="postal_code" value="{{ $id == 1 ? '110' : '114' }}" class="w-full px-3 py-2 border border-brandGrey-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal" required>
                        </div>
                        
                        <div>
                            <label for="city" class="block text-sm font-medium text-brandGrey-normal mb-1">縣市</label>
                            <select id="city" name="city" class="w-full px-3 py-2 border border-brandGrey-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal" required>
                                <option value="">請選擇縣市</option>
                                <option value="台北市" selected>台北市</option>
                                <option value="新北市">新北市</option>
                                <option value="桃園市">桃園市</option>
                                <option value="台中市">台中市</option>
                                <option value="台南市">台南市</option>
                                <option value="高雄市">高雄市</option>
                                <!-- 其他縣市選項 -->
                            </select>
                        </div>
                        
                        <div>
                            <label for="district" class="block text-sm font-medium text-brandGrey-normal mb-1">鄉鎮市區</label>
                            <select id="district" name="district" class="w-full px-3 py-2 border border-brandGrey-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal" required>
                                <option value="">請選擇鄉鎮市區</option>
                                <option value="信義區" {{ $id == 1 ? 'selected' : '' }}>信義區</option>
                                <option value="大安區">大安區</option>
                                <option value="中山區">中山區</option>
                                <option value="內湖區" {{ $id == 2 ? 'selected' : '' }}>內湖區</option>
                                <!-- 其他區域選項 -->
                            </select>
                        </div>
                        
                        <div>
                            <label for="address" class="block text-sm font-medium text-brandGrey-normal mb-1">詳細地址</label>
                            <input type="text" id="address" name="address" value="{{ $id == 1 ? '信義路五段7號' : '瑞光路513巷' }}" class="w-full px-3 py-2 border border-brandGrey-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal" required>
                        </div>
                    </div>
                </div>
                
                <!-- 設為預設 -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input type="checkbox" id="set_default" name="set_default" {{ $id == 1 ? 'checked' : '' }} class="h-4 w-4 text-brandBlue-normal focus:ring-brandBlue-normal border-brandGrey-lightActive rounded">
                    </div>
                    <div class="ml-3">
                        <label for="set_default" class="text-brandGrey-normal">設為預設收件地址</label>
                    </div>
                </div>
                
                <!-- 提交按鈕 -->
                <div class="pt-4">
                    <button type="submit" class="w-full px-4 py-2 bg-brandBlue-normal text-white rounded-md hover:bg-brandBlue-normalHover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandBlue-normal">
                        更新收件地址
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection 