

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>忘記密碼 Forget Password</title>
    <!-- Vite + Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-['Lexend']">
    <main class="flex justify-center items-center min-h-screen bg-cover bg-center  w-full px-5"
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
                <img src="https://cdn.builder.io/api/v1/image/assets/fff8f95ab9b14906ad7fee76d4c8586f/159e9f4ecf610330c5c778310757bf2a24227f9b658abbd411d0cc73d44f8cfa?placeholderIfAbsent=true"
                    class="object-contain h-[46px] w-[46px] rounded-full" alt="Logo" />
                <h1 class="text-2xl font-semibold leading-9 text-gray-500">Forget  Password</h1>
            </header>

            <form method="POST" action="{{ route('password.email.send') }}"
                class="flex flex-col w-full max-w-[320px] mx-auto">
                @csrf
                <p class="mb-3 text-base tracking-widest leading-6 text-black opacity-50 text-left">
                    我們會將驗證碼寄送到您的信箱，請輸入電子郵件以重設密碼。
                </p>

                <div class="mb-4 w-full">
                    <input type="email" placeholder="請輸入電子信箱" name="email"
                        class="px-5 py-3 w-full text-base font-light rounded-md border border-solid border-neutral-200 text-neutral-400" />
                        @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    </div>

                <div class="mt-10 w-full flex flex-col gap-3">
                    <button type="submit"
                        class="px-0 py-3 w-full text-base font-bold tracking-wide text-center text-white bg-gray-500 rounded-md cursor-pointer border-[none] hover:bg-gray-600 transition-colors">
                        寄送驗證碼
                    </button>
                    <a href="{{ route('mylogin') }}"
                        class="px-0 py-3 w-full text-base font-bold tracking-wide text-center text-gray-500 rounded-md border border-gray-500 border-solid cursor-pointer hover:bg-gray-100 transition-colors">
                        返回登入
                    </a>
                  </div>
            </form>
            
        </section>
    </main>
</body>

</html>