<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>登錄 Login</title>

    <!-- Vite + Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="font-['Lexend']">
    <main
        class="flex overflow-hidden relative flex-col justify-center items-center px-56 py-48 min-h-screen  bg-cover bg-center  h-screen w-full  max-md:px-5 max-md:py-24 max-sm:px-5 max-sm:py-12"
        style="background-image: url('{{ asset('images/bg.jpg') }}');">
        {{-- 遮罩 --}}
        <div class="object-cover absolute inset-0 size-full bg-gray-100 bg-opacity-50 bg-cover bg-center"></div>


        <section
            class="flex justify-center items-center relative border border-solid border-[#e4e4e4] 
            w-full max-w-[992px] 
            lg:w-[992px] lg:h-[693px] 
            md:w-[90vw] md:aspect-[992/693] 
            sm:w-[85vw] sm:aspect-[992/693] 
            transition-all duration-300 ease-in-out">

            <!-- 左側背景圖片區塊：在 <lg 隱藏 -->
            <div class="object-cover w-[496px] h-[693px] bg-cover bg-center  hidden lg:block"
                style="background-image: url('{{ asset('images/bg.jpg') }}');">
            </div>

            <!-- 右側表單內容區塊：等比縮小並居中對齊 -->
            <div
                class="flex flex-col items-center justify-center px-24 pt-16 pb-32 bg-white w-[496px] h-full mx-auto transition-transform lg:scale-100  max-lg:scale-[.85]  max-md:scale-[.75]  max-sm:scale-[.65]">
                <!-- 標題和 LOGO -->
                <header
                    class="flex flex-row items-center w-full max-w-[299px] text-2xl font-semibold text-gray-500 xl:self-start lg:self-start ml-[-5px]">
                    <a href="{{ route('home') }}">

                        <img src="https://cdn.builder.io/api/v1/image/assets/fff8f95ab9b14906ad7fee76d4c8586f/159e9f4ecf610330c5c778310757bf2a24227f9b658abbd411d0cc73d44f8cfa?placeholderIfAbsent=true"
                            alt="Logo" class="object-contain h-[46px] rounded-[800px] w-[46px]" />
                    </a>
                    <h1 class="ml-2 text-2xl">Login</h1>
                </header>


                <form method="POST" action="{{ route('mylogin') }}"
                    class="flex relative flex-col gap-6 mt-11 w-full max-w-[299px]">
                    @csrf

                    <!-- Email 輸入框 -->
                    <div>
                        <input type="text" placeholder="信箱" name="email"
                            class="px-5 py-2.5 w-full rounded-md border border-solid border-[#e4e4e4] text-neutral-400"
                            aria-label="Email" />

                    </div>

                    <div class="relative">
                        <input id="password" type="password" placeholder="密碼" name="password"
                            class="px-5 py-2.5 w-full rounded-md border border-solid border-[#e4e4e4] text-neutral-400"
                            aria-label="Password" />
                        <img id="togglePassword"
                            src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBmaWxsPSIjNmI3MjgwIiBkPSJNMjEuODcgMTEuNWMtLjY0LTEuMTEtNC4xNi02LjY4LTEwLjE0LTYuNWMtNS41My4xNC04LjczIDUtOS42IDYuNWExIDEgMCAwIDAgMCAxYy42MyAxLjA5IDQgNi41IDkuODkgNi41aC4yNWM1LjUzLS4xNCA4Ljc0LTUgOS42LTYuNWExIDEgMCAwIDAgMC0xTTEyLjIyIDE3Yy00LjMxLjEtNy4xMi0zLjU5LTgtNWMxLTEuNjEgMy42MS00LjkgNy42MS01YzQuMjktLjExIDcuMTEgMy41OSA4IDVjLTEuMDMgMS42MS0zLjYxIDQuOS03LjYxIDUiLz48cGF0aCBmaWxsPSIjNmI3MjgwIiBkPSJNMTIgOC41YTMuNSAzLjUgMCAxIDAgMy41IDMuNUEzLjUgMy41IDAgMCAwIDEyIDguNW0wIDVhMS41IDEuNSAwIDEgMSAxLjUtMS41YTEuNSAxLjUgMCAwIDEtMS41IDEuNSIvPjwvc3ZnPg=="
                            alt="顯示、隱藏密碼" class="absolute right-3 w-4 h-4 top-[10px] cursor-pointer" />
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- 記住我 -->
                    <div class="flex items-center justify-between w-full max-w-[299px] mt-2">
                        <label for="remember"
                            class="flex items-center cursor-pointer select-none text-sm text-gray-500">
                            <input type="checkbox" name="remember" id="remember" class="hidden peer">
                            <div
                                class="w-5 h-5 border-2 border-[#e4e4e4] rounded-md flex items-center justify-center transition-all duration-200 peer-checked:border-gray-700 peer-checked:bg-[#100d0d]">
                            </div>
                            <span class="ml-2">記住我</span>
                        </label>

                        <!-- 忘記密碼 -->
                        <a href="{{ route('password.email.send') }}"
                            class="text-xs text-gray-500 hover:underline opacity-80">
                            忘記密碼？
                        </a>
                    </div>



                    <div class="mt-11 w-full">
                        <button type="submit"
                            class="p-2.5 mb-4 font-bold text-center text-white bg-gray-500 hover:bg-gray-600 rounded-md w-full">
                            登入
                        </button>
                        <a href="{{ route('myregister') }}"
                            class="p-2.5 font-bold text-center text-gray-500 hover:bg-gray-100 rounded-md border border-solid border-[#626981] w-full block">
                            註冊會員
                        </a>
                    </div>

                </form>




            </div>
        </section>


    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var passwordField = document.getElementById("password");
            var toggleIcon = document.getElementById("togglePassword");

            // 定義不同狀態的圖示 URL
            var showIcon =
                "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMiIgaGVpZ2h0PSIxMiIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBmaWxsPSIjNmI3MjgwIiBkPSJNMjEuODcgMTEuNWMtLjY0LTEuMTEtNC4xNi02LjY4LTEwLjE0LTYuNWMtNS41My4xNC04LjczIDUtOS42IDYuNWExIDEgMCAwIDAgMCAxYy42MyAxLjA5IDQgNi41IDkuODkgNi41aC4yNWM1LjUzLS4xNCA4Ljc0LTUgOS42LTYuNWExIDEgMCAwIDAgMC0xTTEyLjIyIDE3Yy00LjMxLjEtNy4xMi0zLjU5LTgtNWMxLTEuNjEgMy42MS00LjkgNy42MS01YzQuMjktLjExIDcuMTEgMy41OSA4IDVjLTEuMDMgMS42MS0zLjYxIDQuOS03LjYxIDUiLz48cGF0aCBmaWxsPSIjNmI3MjgwIiBkPSJNMTIgOC41YTMuNSAzLjUgMCAxIDAgMy41IDMuNUEzLjUgMy41IDAgMCAwIDEyIDguNW0wIDVhMS41IDEuNSAwIDEgMSAxLjUtMS41YTEuNSAxLjUgMCAwIDEtMS41IDEuNSIvPjwvc3ZnPg=="; // 眼睛開啟
            var hideIcon =
                "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMiIgaGVpZ2h0PSIxMiIgdmlld0JveD0iMCAwIDI0IDI0Ij48ZyBmaWxsPSJub25lIiBzdHJva2U9IiM2YjcyODAiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIgc3Ryb2tlLXdpZHRoPSIyIj48cGF0aCBkPSJNMTAuNzMzIDUuMDc2YTEwLjc0NCAxMC43NDQgMCAwIDEgMTEuMjA1IDYuNTc1YTEgMSAwIDAgMSAwIC42OTZhMTAuOCAxMC44IDAgMCAxLTEuNDQ0IDIuNDltLTYuNDEtLjY3OWEzIDMgMCAwIDEtNC4yNDItNC4yNDIiLz48cGF0aCBkPSJNMTcuNDc5IDE3LjQ5OWExMC43NSAxMC43NSAwIDAgMS0xNS40MTctNS4xNTFhMSAxIDAgMCAxIDAtLjY5NmExMC43NSAxMC43NSAwIDAgMSA0LjQ0Ni01LjE0M00yIDJsMjAgMjAiLz48L2c+PC9zdmc+"; // 眼睛關閉

            toggleIcon.addEventListener("click", function() {
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    toggleIcon.src = hideIcon; // 切換為「眼睛關閉」圖示
                } else {
                    passwordField.type = "password";
                    toggleIcon.src = showIcon; // 切換為「眼睛開啟」圖示
                }
            });
        });
    </script>
</body>
