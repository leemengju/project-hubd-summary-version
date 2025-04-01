<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>最後一步 Last Step</title>
    <!-- Vite + Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <main class="flex justify-center items-center min-h-screen bg-cover bg-center h-screen w-full px-5"
        style="background-image: url('{{ asset('images/bg.jpg') }}');">

        {{-- 遮罩 --}}
        <div class="absolute inset-0 bg-gray-100 bg-opacity-50"></div>

        <section
            class="relative flex flex-col justify-center items-center bg-white border border-solid border-[#E4E4E4] 
              w-full max-w-[992px] 
              mx-auto 
              lg:w-[992px] lg:min-h-[693px] 
              md:w-[85vw] md:aspect-[992/693] 
              sm:w-[90vw] sm:aspect-[992/693] 
              p-10 max-md:p-6 max-sm:p-4 transition-all duration-300">

            <header class="flex items-center gap-3 mb-6 text-2xl font-semibold text-gray-500 w-full max-w-[320px]">
                <a href="{{ route('home') }}">
                    <img src="https://cdn.builder.io/api/v1/image/assets/fff8f95ab9b14906ad7fee76d4c8586f/159e9f4ecf610330c5c778310757bf2a24227f9b658abbd411d0cc73d44f8cfa?placeholderIfAbsent=true"
                        class="object-contain h-[46px] w-[46px] rounded-full" alt="Logo" />
                </a>
                <h1 class="text-2xl font-semibold leading-9 text-gray-500">Last Step</h1>
            </header>

            <form method="POST"
                action="{{ route('mylaststep.submit') }}"class="flex flex-col w-full max-w-[320px] mx-auto">
                @csrf
                <p class="mb-3 text-base tracking-widest leading-6 text-black opacity-50 text-left">
                    請輸入你的個人資料以完成註冊流程！
                </p>

                {{-- 用戶名 --}}
                <div class="mb-4 w-full">
                    <input type="text" placeholder="用戶名" name="name" value="{{ old('name') }}"
                        class="px-5 py-3 w-full text-base font-light rounded-md border border-solid border-neutral-200 text-neutral-400" />
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 手機 --}}
                <div class="mb-4 w-full">
                    <input type="tel" placeholder="手機號碼" name="phone" value="{{ old('phone') }}"
                        class="px-5 py-3 w-full text-base font-light rounded-md border border-solid border-neutral-200 text-neutral-400" />
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 密碼 --}}
                <div class="mb-4 w-full relative">
                    <input type="password" placeholder="密碼" name="password" id="password"
                        class="px-5 py-3 w-full text-base font-light rounded-md border border-solid border-neutral-200 text-neutral-400" />
                    <img id="toggle-password"
                        src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBmaWxsPSIjNmI3MjgwIiBkPSJNMjEuODcgMTEuNWMtLjY0LTEuMTEtNC4xNi02LjY4LTEwLjE0LTYuNWMtNS41My4xNC04LjczIDUtOS42IDYuNWExIDEgMCAwIDAgMCAxYy42MyAxLjA5IDQgNi41IDkuODkgNi41aC4yNWM1LjUzLS4xNCA4Ljc0LTUgOS42LTYuNWExIDEgMCAwIDAgMC0xTTEyLjIyIDE3Yy00LjMxLjEtNy4xMi0zLjU5LTgtNWMxLTEuNjEgMy42MS00LjkgNy42MS01YzQuMjktLjExIDcuMTEgMy41OSA4IDVjLTEuMDMgMS42MS0zLjYxIDQuOS03LjYxIDUiLz48cGF0aCBmaWxsPSIjNmI3MjgwIiBkPSJNMTIgOC41YTMuNSAzLjUgMCAxIDAgMy41IDMuNUEzLjUgMy41IDAgMCAwIDEyIDguNW0wIDVhMS41IDEuNSAwIDEgMSAxLjUtMS41YTEuNSAxLjUgMCAwIDEtMS41IDEuNSIvPjwvc3ZnPg=="
                        alt="顯示、隱藏密碼" class="absolute right-3 w-4 h-4 top-[10px] cursor-pointer" />
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 生日 --}}
                <fieldset class="flex flex-col w-full font-bold tracking-wide">
                    <legend class="text-xs leading-loose opacity-50 text-neutral-700 mb-2">
                        生日日期 (選填)
                    </legend>
                    <div class="flex gap-2">
                        <select name="year"
                            class="px-5 py-3 flex-1 text-base font-light rounded-md border border-solid border-neutral-200 text-neutral-400">
                            <option value="">選擇年</option>
                            @for ($i = date('Y'); $i >= 1900; $i--)
                            <option value="{{ $i }}" {{ old('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        <select name="month"
                            class="px-5 py-3 flex-1 text-base font-light rounded-md border border-solid border-neutral-200 text-neutral-400">
                            <option value="">選擇月</option>
                            @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ old('month') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        <select name="day"
                            class="px-5 py-3 flex-1 text-base font-light rounded-md border border-solid border-neutral-200 text-neutral-400">
                            <option value="">選擇日</option>
                            @for ($i = 1; $i <= 31; $i++)
                            <option value="{{ $i }}" {{ old('day') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    @error('year')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    @error('month')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    @error('day')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </fieldset>

                <div class="mt-10 w-full">
                    <button type="submit"
                        class="px-0 py-3 w-full text-base font-bold tracking-wide text-center text-white bg-gray-500 rounded-md cursor-pointer border-[none] hover:bg-gray-600 transition-colors">
                        完成註冊
                    </button>
                </div>
            </form>
        </section>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function togglePassword(inputId, toggleId) {
                var passwordField = document.getElementById(inputId);
                var toggleIcon = document.getElementById(toggleId);

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
            }

            togglePassword("password", "toggle-password");
        });
    </script>
</body>
