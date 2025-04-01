@extends('layouts.with_sidebar')

@section('title', '編輯付款方式')
@section('meta_description', '編輯您的付款方式')
@section('meta_keywords', '付款資訊, 信用卡, 會員中心')
@section('breadcrumb_title', '編輯付款方式')

@section('main_content')
    <div class="w-full p-4 sm:p-6 bg-white rounded-lg shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl sm:text-2xl font-bold text-brandGrey-normal">編輯付款方式</h1>
            <a href="{{ route('user.payment') }}" class="px-3 py-1.5 sm:px-4 sm:py-2 border border-brandGrey-lightActive text-brandGrey-normal rounded-md hover:bg-brandGrey-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandGrey-light">
                返回付款資訊
            </a>
        </div>
        
        <form action="{{ route('user.payment.update', $id) }}" method="POST" class="max-w-lg mx-auto">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- 付款方式選擇 -->
                <div>
                    <label class="block text-sm font-medium text-brandGrey-normal mb-2">付款方式</label>
                    <div class="flex space-x-4">
                        <div class="flex items-center">
                            <input type="radio" id="credit_card" name="payment_type" value="credit_card" checked class="h-4 w-4 text-brandBlue-normal focus:ring-brandBlue-normal border-brandGrey-lightActive">
                            <label for="credit_card" class="ml-2 text-brandGrey-normal">信用卡</label>
                        </div>
                    </div>
                </div>
                
                <!-- 信用卡資訊 -->
                <div class="border border-brandGrey-light rounded-lg p-4">
                    <h3 class="text-lg font-medium text-brandGrey-normal mb-4">信用卡資訊</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="card_number" class="block text-sm font-medium text-brandGrey-normal mb-1">卡號</label>
                            <input type="text" id="card_number" name="card_number" value="**** **** **** 1234" class="w-full px-3 py-2 border border-brandGrey-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal bg-brandGrey-lightLight" readonly>
                            <p class="mt-1 text-xs text-brandGrey-normalLight">基於安全考量，卡號無法編輯</p>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="expiry_date" class="block text-sm font-medium text-brandGrey-normal mb-1">到期日</label>
                                <input type="text" id="expiry_date" name="expiry_date" value="12/25" class="w-full px-3 py-2 border border-brandGrey-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal" required>
                            </div>
                            <div>
                                <label for="cvv" class="block text-sm font-medium text-brandGrey-normal mb-1">安全碼</label>
                                <input type="text" id="cvv" name="cvv" placeholder="123" class="w-full px-3 py-2 border border-brandGrey-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal" required>
                            </div>
                        </div>
                        
                        <div>
                            <label for="cardholder_name" class="block text-sm font-medium text-brandGrey-normal mb-1">持卡人姓名</label>
                            <input type="text" id="cardholder_name" name="cardholder_name" value="王小明" class="w-full px-3 py-2 border border-brandGrey-lightActive rounded-md focus:outline-none focus:ring-1 focus:ring-brandBlue-normal" required>
                        </div>
                    </div>
                </div>
                
                <!-- 設為預設 -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input type="checkbox" id="set_default" name="set_default" checked class="h-4 w-4 text-brandBlue-normal focus:ring-brandBlue-normal border-brandGrey-lightActive rounded">
                    </div>
                    <div class="ml-3">
                        <label for="set_default" class="text-brandGrey-normal">設為預設付款方式</label>
                    </div>
                </div>
                
                <!-- 提交按鈕 -->
                <div class="pt-4">
                    <button type="submit" class="w-full px-4 py-2 bg-brandBlue-normal text-white rounded-md hover:bg-brandBlue-normalHover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandBlue-normal">
                        更新付款方式
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection 