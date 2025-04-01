<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- 設定動態 SEO 標題與描述 -->
    <title>@yield('title', '預設網站標題')</title>
    <meta name="description" content="@yield('meta_description', '這是預設網站描述')">
    <meta name="keywords" content="@yield('meta_keywords', '預設關鍵字1, 預設關鍵字2')">

    <!-- 設定 Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon.png') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- animate.css -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Vite + Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="relative font-lexend antialiased bg-white w-screen h-screen">

    @if(Route::currentRouteNamed('home') && $noAdCookie)
    <section id="coverArea" class="fixed inset-0 z-[80] flex justify-center items-center">
        <!-- 蓋板廣告與遮罩 -->
        @include('layouts.cover_ad')
        <div id="overlay" class="hidden animate__animated animate__fadeIn animate__slow fixed inset-0 w-screen h-screen bg-gray-900 bg-opacity-50 z-40"></div>
    </section>
    @endif

    <header class="w-full flex justify-center">
        <!-- marquee -->
        @include('layouts.header_marquee')
        <!-- nav -->
        @include('layouts.navigation')
    </header>

    <!-- main -->
    <main class="max-w-full min-w-[390px] mx-auto mt-6 animate__animated animate__fadeIn animate__slow">
        <x-go-top-button />
        @yield('content')
    </main>

    <!-- footer -->
    @include('layouts.footer')

    @stack('scripts')

    <script>
        // 顯示廣告和遮罩
        $('#coverAd').removeClass('hidden');
        $('#overlay').removeClass('hidden');

        // 點擊關閉按鈕
        $('#closeBtn').on('click', function() {
            $('#coverArea').addClass('hidden');
            $('#coverAd').addClass('hidden');
            $('#overlay').addClass('hidden');
        });

        // 點擊 coverAd 時阻止事件冒泡
        $('#coverAd').on('click', function(e) {
            e.stopPropagation();
        });

        // 點擊畫面其他地方時關閉
        $(document).on('click', function() {
            $('#coverArea').addClass('hidden');
            $('#coverAd').addClass('hidden');
            $('#overlay').addClass('hidden');
        });

        // 判斷是否需要系統正在維護
        // 如果維護中，則跳轉到維護頁，如果未維護，則跳轉到首頁
        // $(document).ready(function() {
        //     $.ajax({
        //         url: '{{ route("system.maintenance") }}',
        //         type: 'GET',
        //         success: function(response) {
        //             console.log(response);
        //             if (response.data.length > 0) {
        //                 window.location.href = '{{ route("system-maintenance") }}';
        //             }
        //             else {
        //                 window.location.href = '{{ route("home") }}';
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             console.log('Error:', error);
        //             window.location.href = '{{ route("home") }}';
        //         }
        //     });
        // });
    </script>

</body>

</html>