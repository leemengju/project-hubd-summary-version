<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>註冊 Regiser</title>
    <!-- Vite + Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-['Lexend']">
    <main
        class="flex items-center justify-center min-h-screen bg-cover bg-center h-screen w-full 
               max-md:px-5 max-md:py-24 max-sm:px-5 max-sm:py-12"
        style="background-image: url('{{ asset('images/bg.jpg') }}');">
        {{-- 遮罩 --}}
        <div class="object-cover absolute inset-0 size-full bg-gray-100 bg-opacity-50 bg-cover bg-center"></div>

        <!-- 外層 Section -->
        <section
            class="relative flex flex-col justify-center items-center bg-white border border-solid border-[#e4e4e4] 
                    mx-auto 
                    w-full max-w-[992px] 
                    xl:max-w-[992px] 
                    lg:w-[992px] lg:h-[693px] 
                    md:w-[90vw] md:aspect-[992/693] 
                    sm:w-[85vw] sm:aspect-[992/693] 
                    transition-all duration-300 ease-in-out">

            <!-- Wrapper 容器 -->
            <div
                class="flex flex-col items-center w-full max-w-[496px] scale-100 transition-transform 
                        xl:mx-auto xl:items-center 
                        lg:scale-100 
                        max-lg:scale-[.85] 
                        max-md:scale-[.75] 
                        max-sm:scale-[.65] 
                        mx-auto">

                <!-- 標題和 LOGO -->
                <header class="flex flex-row items-center w-full max-w-[299px] text-2xl font-semibold text-gray-500">
                    <a href="{{ route('home') }}">
                        <img src="https://cdn.builder.io/api/v1/image/assets/fff8f95ab9b14906ad7fee76d4c8586f/159e9f4ecf610330c5c778310757bf2a24227f9b658abbd411d0cc73d44f8cfa?placeholderIfAbsent=true"
                            alt="Logo" class="object-contain h-[46px] rounded-[800px] w-[46px]" />
                    </a>
                    <h1 class="ml-2 text-2xl">Register</h1>
                </header>

                <!-- 表單區塊 -->
                <form method="POST" action="{{ route('myregister.email.send') }}"
                    class="flex flex-col mt-11 w-full max-w-[299px]">
                    @csrf
                    {{-- email輸入框 --}}
                    <div>
                        <input type="email" name="email" placeholder="請輸入電子信箱" value="{{ old('email') }}"
                            class="px-5 py-2.5 w-full rounded-md border border-solid border-[#e4e4e4] text-neutral-400"
                            required />
                        @error('email')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- 隱私政策 --}}
                    <div
                        class="flex gap-3.5 items-center self-start mt-2 text-base tracking-wide leading-7 text-zinc-500">
                        <input type="checkbox" id="privacy-policy"
                            class="appearance-none flex shrink-0 self-stretch my-auto bg-white rounded-md border border-solid border-zinc-300 h-[25px] w-[25px] cursor-pointer"
                            required />
                        <label for="privacy-policy" class="self-stretch my-auto cursor-pointer">
                            我同意網站
                            <a class="underline" href="/">隱私權政策</a>
                        </label>
                    </div>
                    <!-- 按鈕區塊 -->
                    <div class="mt-11 w-full max-w-[299px]">
                        <!-- 下一步按鈕 -->
                        <button type="submit"
                            class="p-2.5 font-bold text-center text-white bg-gray-500 rounded-md w-full">
                            下一步
                        </button>
                        <!-- 返回登入按鈕 -->
                        <a href="{{ route('mylogin') }}"
                            class="mt-4 p-2.5 font-bold text-center text-gray-500 bg-white rounded-md border border-solid border-[#626981] w-full block">
                            返回登入
                        </a>
                    </div>
                </form>

            </div>
        </section>
    </main>
</body>
