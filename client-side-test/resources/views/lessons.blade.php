@extends('layouts.app')

@section('title', '銀黏土課程')
@section('meta_description', '銀黏土課程')
@section('meta_keywords', '銀黏土課程')


@section('content')
<section class="mt-[150px] text-gray-900 leading-loose">
    <!-- 麵包屑 -->
    <x-breadcrumb :items="[
             ['name' => '首頁', 'url' => route('home')],
             ['name' => '銀黏土課程'],
         ]" />

    <!-- 課程標題 -->
    <div class="max-w-screen-lg mx-auto px-4 mb-6">
        <h2 class="text-3xl font-bold text-center">銀黏土課程 | 寶石戒指</h2>
    </div>

    <hr class="border-gray-300">

    <!-- 輪播圖 -->
    <div class="max-w-screen-lg mx-auto px-4 my-6" x-data="{ activeSlide: 0, slides: [
        '{{ asset('images/lessons/L1.jpg') }}',
        '{{ asset('images/lessons/L2.jpg') }}',
        '{{ asset('images/lessons/L3.jpg') }}',
        '{{ asset('images/lessons/L4.jpg') }}'
    ] }">
        <div class="relative w-full overflow-hidden">
            <template x-for="(slide, index) in slides" :key="index">
                <img :src="slide" class="w-full rounded-lg shadow-md transition-opacity duration-700"
                    x-show="activeSlide === index">
            </template>

            <!-- Previous Button -->
            <button @click="activeSlide = (activeSlide === 0) ? slides.length - 1 : activeSlide - 1"
                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full">
                &#9664;
            </button>

            <!-- Next Button -->
            <button @click="activeSlide = (activeSlide === slides.length - 1) ? 0 : activeSlide + 1"
                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full">
                &#9654;
            </button>
        </div>

        <!-- 課程介紹 -->
        <div class="max-w-screen-lg mx-auto px-4 my-6 text-lg leading-loose">
            <p><strong>▪️價格:1人/$1750NT</strong></p>
            <br>
            <p>▪️ 1人即可開班，一個時段最多4人，也歡迎組團包班！</p>
            <br>
            <p>▪️ 基於操作安全考量，年滿「12歲以上」即可報名。</p>
            <br>
            <p>▪️ 本單位保有確認報名資格之權利，未符規定者，依取消政策辦理。</p>
        </div>

        <br><br>

        <div class="max-w-screen-lg mx-auto px-4 my-6 leading-loose ">

            <p class="font-bold">無論什麼日子</p>

            <p class="font-bold">我們都可以來364工作室增加一點儀式感</p>

            <p class="font-bold">情侶、朋友、家人、自己</p>

            <p class="font-bold">約會、娛樂、紀念日、沒什麼特別的日子、淡水一日遊？</p>

            <p class="font-bold">不管是什麼組合、什麼理由 都超級適合來玩的啦👯‍♀️</p>
        </div>

        <br><br>

        <div class="max-w-screen-lg mx-auto px-4 my-6 leading-loose">
            <h2 class="font-bold">‧說明</h2>
            <p class="font-bold">【 課 程 須 知 】</p>
            <p>▪️ 過程中，如不慎造成無法修復之裂損，可加購基礎材料重製。</p>
            <p>▪️ 詳細內容請閱讀下列須知，有課程問題請使用官方Line詢問。</p>
            <br>
            <hr>
            <br>
            <p class="font-bold">【 預 約 須 知 】</p>
            <br>
            <p class="font-bold">▪️ 完成訂金才算預約完成!</p>
            <br>
            <p>▪️ 請完整閱讀下列須知。</p>
            <br>
            <hr>
        </div>

        <br>

        <div class="max-w-screen-lg mx-auto px-4 my-6">
            <img src="{{ asset('images/lessons/lessons.jpg') }}" alt="課程介紹" class="block w-1/2 max-w-md mx-auto rounded-lg shadow-md">
            <br>
            <img src="{{ asset('images/lessons/reservation.jpg') }}" alt="預約須知" class="block w-1/2 max-w-md mx-auto rounded-lg shadow-md">
            <br>
            <img src="{{ asset('images/lessons/make.jpg') }}" alt="製作須知" class="block w-1/2 max-w-md mx-auto rounded-lg shadow-md">
        </div>

        <br><br><br>

        <div class="max-w-screen-lg mx-auto px-4 my-6 leading-relaxed">
            <hr>
            <h4><b>‧注意事項</b></h4>
            <br>
            <p> 本活動將以拍照、錄影等方式，側拍學員的製作花絮和作品，並分享在社群平台、官網或其他媒體，為保障您的肖像權益，如不希望被拍攝敬請提前告知。 </p>
            <p>364HUBD保有對本課程所有事宜做出最終解釋及決定的權力。</p>
        </div>

        <br>

        <div class="max-w-screen-lg mx-auto px-4 my-6 leading-relaxed">
            <hr>
            <h4><b>‧上課地點</b></h4>
            <p>364HUBD工作室</p>
            <p>新北市淡水區新市二路一段86號</p>
        </div>
        <div class="max-w-screen-lg mx-auto px-4 my-6">
            <img src="{{ asset('images/lessons/traffic.jpg')}}" alt="交通資訊" class="block w-1/2 max-w-md mx-auto rounded-lg shadow-md">
        </div>

        <br>

        <div class="max-w-screen-lg mx-auto px-4 my-6">
            <iframe class="block w-full"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3610.2018875441486!2d121.4223987761534!3d25.19641327771143!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3442bb0d8aa42a71%3A0x2d078bc91be4932f!2s364%20HAPPY%20UNBIRTHDAY!5e0!3m2!1szh-TW!2stw!4v1734859543111!5m2!1szh-TW!2stw"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <!-- 立即預約 -->
        <div class="sticky bottom-0 left-0 w-full bg-white shadow-md py-3 pt-4 flex flex-col items-center z-30">
            <h1 class="text-lg font-bold mb-2">寶石戒指課程</h1>
            <a href="https://line.me/R/ti/p/@528gygcj?oat_content=url"
                class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 mt-2">立即預約</a>
        </div>

        </body>

        @endsection


        @push('scripts')
        <!-- <script type="module" src="{{ asset('resources/js/home.js') }}"></script> -->
        @endpush