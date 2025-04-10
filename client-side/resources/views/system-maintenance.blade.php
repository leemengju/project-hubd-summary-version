@extends('layouts.app')

@section('title', '維護中')
@section('meta_description', '維護中')
@section('meta_keywords', '維護中')

@section('content')
<section class="mt-[150px] ">
    <!-- 麵包屑 -->
    <x-breadcrumb :items="[
             ['name' => '首頁', 'url' => route('home')],
             ['name' => '維護中'],
         ]" />


    <div class="system-maintenance flex flex-col items-center justify-center w-full  min-h-full gap-5">
        <!-- 靜態維護中畫面 -->
    <!-- <img class="h-[260px]" src="{{ asset('images/system_maintenance/maintain.png')   }}" alt="">
        <div class="flex flex-col items-center justify-center w-full  min-h-full gap-2">
            <p class="text-[36px] text-brandGray-normal font-lexend font-semibold">系統維護中</p>
            <p class="text-[24px] text-brandGray-normal font-normal">維護時間:2025-03-10 到 2025-03-30</p>
            <p class="text-[20px] flex flex-wrap max-w-[380px] text-brandGray-normalLight font-normal">維護說明:親愛的顧客，感謝您長期以來的支持！為了慶祝周年慶，我們將於近期暫時關閉網站進行升級與維護。敬請留意我們的開放時間，期待與您再度相見！</p>
        </div>
        <a href="{{ route('home') }}"
            class="flex overflow-hidden items-center py-4  font-bold text-white bg-red-500 rounded-md min-h-[56px] w-[176px] ">
            <span class="goHome self-stretch my-auto mx-auto ">回到首頁</span>
        </a> -->
    </div>
</section>
@endsection

@push('scripts')
<!-- jQuery 內容 -->
<script>
    $.ajax({
        url: '{{ route("system.maintenance") }}',
        type: 'GET',
        success: function(response) {
            console.log(response);
            console.log(response.data);
            console.log(response.data[0].start_date);
            let resultHTML = "";
            resultHTML += `<img class="h-[260px]" src="{{ asset('images/system_maintenance/maintain.png') }}" alt="">
            <div class="flex flex-col items-center justify-center w-full min-h-full gap-2">
                <p class="text-[36px] text-brandGray-normal font-lexend font-semibold">系統維護中</p>
                <p class="text-[24px] text-brandGray-normal font-normal">維護時間:${response.data ? response.data[0].start_date : ''} 到 ${response.data ? response.data[0].end_date : ''}</p>
                <p class="text-[20px] flex flex-wrap max-w-[380px] text-brandGray-normalLight font-normal">維護說明:${response.data ? response.data[0].maintain_description : ''}</p>
            </div>`
            // <a href="{{ route('home') }}" class="flex overflow-hidden items-center py-4 font-bold text-white bg-red-500 rounded-md min-h-[56px] w-[176px]">
            //     <span class="goHome self-stretch my-auto mx-auto">回到首頁</span>
            // </a>;

            $('.system-maintenance').html(resultHTML);
        },
        error: function(xhr, status, error) {
            console.log('Error:', error);
        }
    });
</script>
</script>
@endpush