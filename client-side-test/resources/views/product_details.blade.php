@extends('layouts.app')

@section('title', 'Product_Details')
@section('meta_description', '商品內頁')
@section('meta_keywords', '首頁, home, homepage')

{{-- 麵包屑邏輯 --}}
@php
    use Illuminate\Support\Str;

    $isAccessory = Str::startsWith($product->product_id, 'pa');
    $from = request('from'); // 取得 query 參數

    $categoryName = $isAccessory ? '飾品' : '服飾';
    $categoryRoute = $isAccessory ? route('categories_accessories') : route('categories_clothes');
    
    // 簡化子分類處理，統一導向服飾頁面
    $subcategory = null;
    if (!$isAccessory && $from) {
        $subcategory = [
            'short' => '短袖',
            'long' => '長袖',
            'jacket' => '夾克'
        ][$from] ?? null;
    }
@endphp

@section('content')


    <div class="lg:mt-[150px] lg:w-[1440px] mx-auto  md:mt-[189px] md:w-[960px]  ">
        <x-breadcrumb :items="array_filter([
            ['name' => '首頁', 'url' => route('home')],
            ['name' => $categoryName, 'url' => $categoryRoute],
            $subcategory ? ['name' => $subcategory, 'url' => $categoryRoute] : null,
            ['name' => $product->product_name],
        ])" />
    </div>

    <main
        class=" flex mx-auto lg:w-[1320px] lg:h-[580px]  lg:px-[60px] lg:gap-10 md:gap-5 sm:gap-[20px] md:w-[720px] md:h-[375px] sm:w-[350px] sm:h-full md:flex-row sm:flex-col md:mt-[0px] sm:mt-[139px] ">
        <section
            class="flex lg:gap-7 lg:w-[600px] lg:h-[580px] md:gap-[14px] md:w-[360px] md:h-[375px] sm:w-[350px] sm:h-[380px]  "
            aria-label="Product Gallery">
            <div
                class=" flex-col overflow-y-auto lg:gap-5 lg:h-[580px] lg:w-[118px] md:w-[71px] md:h-[375px] md:gap-2.5 md:flex sm:hidden ">
                @foreach ($product->images as $image)
                    <button
                        class="focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 lg:h-[180px] md:h-[118.33px] rounded-[5px]">
                        <img src="{{ 'http://localhost:8000/storage/' . $image->product_img_url }}"
                            alt="{{ $image->product_alt_text }}"
                            class="object-cover rounded-md lg:h-[180px] lg:w-[118px] md:h-[118.33px]" loading="lazy" />
                    </button>
                @endforeach

            </div>

            <div
                class="relative lg:w-[454px] lg:h-[580px] md:w-[275px] md:h-[375px] rounded-[5px] sm:w-[350px] sm:h-[380px] ">
                <button class="focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <div>
                        <img id="mainProductImage" src="{{ 'http://localhost:8000/storage/' . $product->product_img }}"
                            alt="{{ $product->product_name }}"
                            class="object-cover lg:w-[454px] rounded-md lg:h-[580px] md:w-[275px] md:h-[375px] sm:w-[350px] sm:h-[380px]"
                            loading="lazy" />
                    </div>
                </button>
                <button
                    class="prev-btn flex absolute lg:left-6 md:left-3 sm:left-0 top-2/4 justify-center items-center w-10 h-10 rounded-full -translate-y-2/4 cursor-pointer bg-white bg-opacity-80"
                    aria-label="Previous image">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M25 30L15 20L25 10" stroke="black" stroke-width="3.33333" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>

                <button
                    class="next-btn flex absolute lg:right-6 md:right-3 sm:right-0 top-2/4 justify-center items-center w-10 h-10 rounded-full -translate-y-2/4 cursor-pointer bg-white bg-opacity-80"
                    aria-label="Next image">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 30L25 20L15 10" stroke="black" stroke-width="3.33333" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </section>
        <div
            class="lg:w-[560px] lg:h-[580px] md:w-[340px] md:h-[375px]   flex-col justify-start items-start lg:gap-11 md:gap-4 sm:gap-[20px] inline-flex">
            <div class="self-stretch md:h-[116px] flex-col justify-start items-start gap-5 flex">
                <div class="self-stretch justify-between items-center inline-flex">
                    <div class=" lg:pb-[6.82px] justify-center items-center flex">
                        <div
                            class=" break-all break-words lg:w-[502px]  md:w-[300px] sm:w-[275px]  relative  text-brandGray-normal lg:text-2xl sm:text-xl font-light font-['Lexend'] lg:leading-9 sm:leading-[30px]">
                            {{ $product->product_name }} </div>
                    </div>
                    <button id="likeBtn" data-product-id="{{ $product->product_id }}" class="relative focus:outline-none">
                        <svg id="likeIcon" width="30" height="30" viewBox="0 0 30 30"
                            xmlns="http://www.w3.org/2000/svg"
                            class="transition duration-300 ease-in-out text-brandGray-normal fill-none">
                            <path
                                d="M21.25 8.125C22.6307 8.125 23.75 9.24429 23.75 10.625M15 7.12817L15.8563 6.25C18.52 3.51839 22.8386 3.51839 25.5023 6.25C28.0944 8.90825 28.174 13.1923 25.6826 15.9499L18.5246 23.8727C16.623 25.9775 13.3769 25.9775 11.4753 23.8727L4.31741 15.9499C1.82598 13.1923 1.90563 8.90828 4.49775 6.25002C7.1614 3.51841 11.48 3.51841 14.1437 6.25002L15 7.12817Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <div
                    class="opacity-60 text-brandGray-normal lg:text-sm sm:text-xs font-light font-['Lexend'] lg:leading-snug md:leading-[18px] max-h-[120px] overflow-hidden hover:overflow-visible">
                    {{ $product->product_description }}</div>
            </div>
            <div class="justify-start items-center gap-2.5 inline-flex">
                <div
                    class="text-brandGray-normal lg:text-2xl sm:text-lg font-light font-['Lexend'] lg:leading-9 sm:leading-relaxed">
                    NT$ {{ number_format($product->product_price) }}</div>
            </div>
            <div class="flex flex-col lg:gap-9 md:gap-4 sm:gap-[10px] w-full">
                @unless($isAccessory)
                <!-- 顏色選擇區 -->
                <div class="flex items-center gap-3">
                    <span
                        class="text-brandGray-normal lg:text-2xl sm:text-lg font-['Lexend'] lg:leading-9 sm:leading-relaxed font-light">顏色:</span>
                    <div data-color-wrapper class="flex gap-3">
                        @foreach ($product->specs->pluck('product_color')->unique() as $color)
                            <div class="lg:w-12 lg:h-12 sm:w-7 sm:h-7 rounded-full border border-gray-400 cursor-pointer"
                                style="background-color: {{ $color }}" data-color="{{ $color }}"></div>
                        @endforeach
                    </div>
                </div>
                @endunless

                @unless($isAccessory)
                <!-- 尺寸選擇區 -->
                <div class="flex items-center gap-3 ">
                <span
                class="text-brandGray-normal lg:text-2xl sm:text-lg font-['Lexend'] lg:leading-9 sm:leading-relaxed font-light">尺寸:</span>
                <div data-color-wrapper class="flex gap-3">
                    @foreach ($product->specs->pluck('product_size')->unique() as $size)
                        <button
                            class="size-option lg:w-12 lg:h-12 sm:w-7 sm:h-7 border border-brandBlue-normal flex items-center justify-center rounded-md">
                            <span
                                class="text-brandBlue-normal lg:text-2xl md:text-lg font-light font-['Lexend'] leading-9">{{ $size }}</span>
                        </button>
                    @endforeach
                    </div>
                </div>
                @endunless
            </div>
            <div class="w-full lg:h-[58px] md:h-[40px] justify-start items-center gap-4 inline-flex">
                <div class="grid grid-cols-5 lg:w-[216px] sm:w-[177px]  border border-brandGrey-lightHover rounded-md">
                    <!-- 減少數量按鈕 -->
                    <button id="decrese"
                        class="col-span-1 flex justify-center items-center bg-white hover:bg-gray-200 lg:h-[58px] sm:h-10 cursor-pointer">
                        <span class="text-brandGrey-normal lg:text-2xl sm:text-lg font-medium">-</span>
                    </button>

                    <!-- 數量顯示 -->
                    <div
                        class="col-span-3 flex justify-center items-center border-x border-brandGrey-lightHover bg-white lg:h-[58px] sm:h-10">
                        <span id="quantity" class="text-brandGrey-normal lg:text-2xl sm:text-lg font-light">01</span>
                    </div>

                    <!-- 增加數量按鈕 -->
                    <button id="add"
                        class="col-span-1 flex justify-center items-center bg-white hover:bg-gray-200 lg:h-[58px] sm:h-10 cursor-pointer">
                        <span class="text-brandGrey-normal lg:text-2xl sm:text-lg font-medium">+</span>
                    </button>
                </div>
                @unless($isAccessory)
                <div
                    class="text-brandGray-normalLight lg:text-lg sm:text-sm font-light font-['Lexend'] lg:leading-relaxed sm:leading-snug">
                    請選擇顏色與尺寸
                </div>
                @else
                <div
                    id="accessory-stock"
                    class="text-brandGray-normalLight lg:text-lg sm:text-sm font-light font-['Lexend'] lg:leading-relaxed sm:leading-snug">
                </div>
                @endunless
                <div id="stockWarning" class="text-red-500 text-sm font-light hidden">已達最大庫存</div>
            </div>
            <!-- <div
                                                                                        class="lg:w-[558px] md:w-[340px] sm:w-full justify-start items-start md:gap-2.5 sm:gap-4 inline-flex max-md:flex-col ">
                                                                                        <div
                                                                                            class="md:grow md:shrink md:basis-0 lg:w-[271px] md:w-[165px] lg:h-[58px] md:h-[47.5px] md:px-10 md:py-[15px] sm:w-full sm:h-7 bg-brandBlue-normal rounded-[5px] flex-col justify-center items-center gap-2.5 inline-flex overflow-hidden cursor-pointer">
                                                                                            <div
                                                                                                class="text-center text-white lg:text-2xl sm:text-base md:font-light sm:font-bold font-['Lexend'] lg:leading-9 md:leading-normal sm:leading-loose">
                                                                                                加入購物車</div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="md:grow md:shrink md:basis-0 lg:w-[271px] md:w-[165px] lg:h-[58px] md:h-[47.5px] md:px-10 md:py-[15px] sm:w-full sm:h-7 bg-brandRed-normal rounded-[5px] flex-col justify-center items-center gap-2.5 inline-flex overflow-hidden cursor-pointer">
                                                                                            <div
                                                                                                class="text-center text-white lg:text-2xl sm:text-base md:font-light sm:font-bold font-['Lexend'] lg:leading-9 md:leading-normal sm:leading-loose">
                                                                                                直接購買</div>
                                                                                        </div>
                                                                                    </div> -->
            <div class="flex flex-col md:flex-row items-center w-full gap-4 md:gap-6">
                <!-- 加入購物車按鈕 -->
                <button id="addToCartBtn"
                    class=" flex-1 lg:h-[58px] md:h-[47.5px] sm:h-10 bg-brandBlue-normal rounded-md flex justify-center items-center cursor-pointer w-full">
                    <span
                        class="text-white lg:text-2xl sm:text-base md:font-light sm:font-bold lg:leading-9 md:leading-normal sm:leading-loose">
                        加入購物車
                    </span>
                </button>

                <!-- 直接購買按鈕 -->
                <button id="buyNowBtn"
                    class="flex-1 lg:h-[58px] md:h-[47.5px] sm:h-10 bg-brandRed-normal rounded-md flex justify-center items-center cursor-pointer w-full">
                    <span
                        class="text-white lg:text-2xl sm:text-base md:font-light sm:font-bold lg:leading-9 md:leading-normal sm:leading-loose">
                        直接購買
                    </span>
                </button>
            </div>
            <form id="quickBuyForm" method="POST" action="{{ route('cart') }}">
                @csrf
                <input type="hidden" name="product_id" id="formProductId">
                <input type="hidden" name="product_size" id="formProductSize">
                <input type="hidden" name="product_color" id="formProductColor">
                <input type="hidden" name="quantity" id="formQuantity">
            </form>
        </div>
    </main>

    <div
        class=" flex mx-auto  lg:w-[1320px]  md:w-[720px] sm:w-[390px]  flex-col justify-start items-center gap-5  lg:mt-[100px] md:mt-[55px] sm:mt-10">
        <div class="md:h-[54px] border-b border-brandGrey-lightHover w-full justify-center items-start gap-10 inline-flex">
            <div id="info"
                class="md:px-4 md:py-3  shadow-[inset_0px_-3px_0px_0px_rgba(220,53,69,1.00)] justify-start items-start gap-2 flex cursor-pointer">
                <div id="info-text" class="text-brandRed-normal md:text-xl md:font-light font-['Lexend'] leading-[30px]">
                    產品須知</div>
            </div>
            <div id="show-img" class="md:px-4 md:py-3  justify-start items-start gap-2 flex cursor-pointer">
                <div id="show-img-text"
                    class="text-brandGrey-normal md:text-xl md:font-light font-['Lexend'] leading-[30px]">產品展示圖</div>
            </div>
        </div>
        <div id="show-img-content" class="w-full hidden ">
            @foreach ($product->displayImages as $img)
                <figure class="w-full">
                    <img src="{{ 'http://localhost:8000/storage/' . $img->product_img_URL }}"
                        alt="{{ $img->product_alt_text }}" class="object-contain w-full aspect-[1.5]" />
                </figure>
            @endforeach
        </div>
        <div id="info-content" class="w-full lg:px-[180px] sm:px-10 pt-10 pb-[60px] bg-neutral-50 flex flex-col gap-6">

            @foreach ($product->information as $info)
                <div class="w-full flex flex-col gap-2 border-b border-[#c6c6c6] pb-4">
                    <div class="bg-[#484848] text-white text-sm font-light px-3 py-1 rounded-md w-fit">
                        {{ $info->title }}
                    </div>
                    <p class="text-[#484848] text-sm font-light leading-snug">
                        {{ $info->content }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@push('scripts')
    <!-- <script type="module" src="{{ asset('resources/js/home.js') }}"></script> -->
    <script>
        $(document).ready(function() {
            $("[data-svg-wrapper] rect").remove();
            let selectedColor = null;
            let selectedSize = null;
            const isAccessory = {{ $isAccessory ? 'true' : 'false' }};

            // 如果是飾品，初始化時設置庫存顯示
            if (isAccessory && specs.length > 0) {
                const accessoryStock = specs[0].product_stock;
                $("#accessory-stock").text(`庫存剩 ${accessoryStock} 件`);
                
                if (accessoryStock <= 0) {
                    $("#stockWarning").removeClass("hidden").text("此商品已售罄");
                }
            }

            function updatePath() {




                if (window.innerWidth < 768) {
                    // 當螢幕小於 768px (手機) 時，使用這個 `d` 值
                    $("#svgcolor").attr("viewBox", "0 0 107 32"); // 縮小 viewBox 適應小螢幕
                    $("#color1").attr("d",
                        "M16 28.5C22.9036 28.5 28.5 22.9036 28.5 16C28.5 9.09644 22.9036 3.5 16 3.5C9.09644 3.5 3.5 9.09644 3.5 16C3.5 22.9036 9.09644 28.5 16 28.5Z"
                    );
                    $("#color2").attr("d",
                        "M54 28.5C60.9036 28.5 66.5 22.9036 66.5 16C66.5 9.09644 60.9036 3.5 54 3.5C47.0964 3.5 41.5 9.09644 41.5 16C41.5 22.9036 47.0964 28.5 54 28.5Z"
                    );
                    $("#color3").attr("d",
                        "M92 28.5C98.9036 28.5 104.5 22.9036 104.5 16C104.5 9.09644 98.9036 3.5 92 3.5C85.0964 3.5 79.5 9.09644 79.5 16C79.5 22.9036 85.0964 28.5 92 28.5Z"
                    );
                    $("#color4").attr("d",
                        "M92 28.5C98.9036 28.5 104.5 22.9036 104.5 16C104.5 9.09644 98.9036 3.5 92 3.5C85.0964 3.5 79.5 9.09644 79.5 16C79.5 22.9036 85.0964 28.5 92 28.5Z"
                    );
                } else if (window.innerWidth < 1200) {
                    // 當螢幕 768px ~ 1023px (平板) 時，使用這個 `d` 值
                    $("#svgcolor").attr("viewBox", "0 0 123 32");
                    $("#color1").attr("d",
                        "M16 28.5C22.9036 28.5 28.5 22.9036 28.5 16C28.5 9.09644 22.9036 3.5 16 3.5C9.09644 3.5 3.5 9.09644 3.5 16C3.5 22.9036 9.09644 28.5 16 28.5Z"
                    );
                    $("#color2").attr("d",
                        "M62 28.5C68.9036 28.5 74.5 22.9036 74.5 16C74.5 9.09644 68.9036 3.5 62 3.5C55.0964 3.5 49.5 9.09644 49.5 16C49.5 22.9036 55.0964 28.5 62 28.5Z"
                    );
                    $("#color3").attr("d",
                        "M108 28.5C114.904 28.5 120.5 22.9036 120.5 16C120.5 9.09644 114.904 3.5 108 3.5C101.096 3.5 95.5 9.09644 95.5 16C95.5 22.9036 101.096 28.5 108 28.5Z"
                    );
                    $("#color4").attr("d",
                        "M108 28.5C114.904 28.5 120.5 22.9036 120.5 16C120.5 9.09644 114.904 3.5 108 3.5C101.096 3.5 95.5 9.09644 95.5 16C95.5 22.9036 101.096 28.5 108 28.5Z"
                    );

                } else {
                    // 當螢幕 >= 1024px (桌面) 時，使用這個 `d` 值
                    $("#svgcolor").attr("viewBox", "0 0 183 52");
                    $("#color1").attr("d",
                        "M26.0013 46.8333C37.5072 46.8333 46.8346 37.5059 46.8346 26C46.8346 14.494 37.5072 5.16663 26.0013 5.16663C14.4954 5.16663 5.16797 14.494 5.16797 26C5.16797 37.5059 14.4954 46.8333 26.0013 46.8333Z"
                    );
                    $("#color2").attr("d",
                        "M92.0013 46.8333C103.507 46.8333 112.835 37.5059 112.835 26C112.835 14.494 103.507 5.16663 92.0013 5.16663C80.4954 5.16663 71.168 14.494 71.168 26C71.168 37.5059 80.4954 46.8333 92.0013 46.8333Z"
                    );
                    $("#color3").attr("d",
                        "M158.001 46.8333C169.507 46.8333 178.835 37.5059 178.835 26C178.835 14.494 169.507 5.16663 158.001 5.16663C146.495 5.16663 137.168 14.494 137.168 26C137.168 37.5059 146.495 46.8333 158.001 46.8333Z"
                    );
                    $("#color4").attr("d",
                        "M158.001 46.8333C169.507 46.8333 178.835 37.5059 178.835 26C178.835 14.494 169.507 5.16663 158.001 5.16663C146.495 5.16663 137.168 14.494 137.168 26C137.168 37.5059 146.495 46.8333 158.001 46.8333Z"
                    );
                }
            }

            // 監聽螢幕縮放
            window.addEventListener("resize", updatePath);

            // 頁面載入時先執行一次
            updatePath();

            // 點擊我的最愛Icon，透過 AJAX 切換收藏狀態
            document.getElementById("likeBtn")?.addEventListener("click", function() {
                let productId = this.dataset.productId;
                let likeIcon = document.getElementById("likeIcon");


                fetch("{{ route('wishlist.toggle') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "added") {
                            likeIcon.classList.add("text-brandRed-normal", "fill-brandRed-normal");
                            likeIcon.classList.remove("text-brandGray-normal", "fill-none");
                        } else if (data.status === "removed") {
                            likeIcon.classList.add("text-brandGray-normal", "fill-none");
                            likeIcon.classList.remove("text-brandRed-normal", "fill-brandRed-normal");
                        }
                    })
                    .catch(error => console.error("錯誤:", error));
            });


            let images = $("button img").map(function() {
                return $(this).attr("src"); // 取得所有縮圖的 src
            }).get(); // 轉換為純陣列
            let currentIndex = 0; // 記錄當前圖片索引

            // 點擊縮圖，切換主圖片
            $("button>img").click(function() {
                let newSrc = $(this).attr("src"); // 取得點擊的圖片 src
                $("#mainProductImage").fadeOut(150, function() {
                    $(this).attr("src", newSrc).fadeIn(150);
                });

                currentIndex = images.indexOf(newSrc); // 更新當前索引
            });

            //  點擊「上一張」按鈕
            $(".prev-btn").click(function() {
                currentIndex = (currentIndex - 1 + images.length) % images.length; // 循環切換
                $("#mainProductImage").fadeOut(150, function() {
                    $(this).attr("src", images[currentIndex]).fadeIn(150);
                });
            });

            //  點擊「下一張」按鈕
            $(".next-btn").click(function() {
                currentIndex = (currentIndex + 1) % images.length; // 循環切換
                $("#mainProductImage").fadeOut(150, function() {
                    $(this).attr("src", images[currentIndex]).fadeIn(150);
                });
            })

            // 監聽點擊顏色按鈕
            $("[data-svg-wrapper] path").click(function() {
                // 移除所有現有的外框
                $("[data-svg-wrapper] rect").remove();

                // 取得當前選中的顏色的 `path`
                let selectedPath = $(this);
                let parentSvg = selectedPath.closest("svg");

                // 取得 `path` 的位置資訊
                let bbox = this.getBBox(); // 確保獲取正確的大小和位置

                // 創建新的外框 `rect`
                let newRect = document.createElementNS("http://www.w3.org/2000/svg", "rect");
                newRect.setAttribute("x", bbox.x - 3); // 調整 x 位置
                newRect.setAttribute("y", bbox.y - 3); // 調整 y 位置
                newRect.setAttribute("width", bbox.width + 6); // 讓外框稍微大一點
                newRect.setAttribute("height", bbox.height + 6);
                newRect.setAttribute("rx", "25.5"); // 保持圓角
                newRect.setAttribute("stroke", "#484848"); // 設定外框顏色

                newRect.setAttribute("fill", "none"); // 不填充，只顯示外框

                // **將 `rect` 添加到 `SVG` 內**
                parentSvg[0].insertBefore(newRect, parentSvg[0].firstChild);

                // **取得當前點擊的顏色**
                let selectedColor = $(this).attr("fill");


            });

            // 監聽尺寸按鈕點擊事件
            $(document).on("click", ".size-option", function() {
                // 移除所有尺寸按鈕的選中狀態
                $(".size-option").removeClass("bg-brandBlue-normal text-white")
                    .addClass("border border-brandBlue-normal text-brandBlue-normal");

                // 為當前點擊的按鈕添加選中狀態
                $(this).addClass("bg-brandBlue-normal text-white")
                    .removeClass("border border-brandBlue-normal text-brandBlue-normal");

                // **改變內部文字顏色**
                $(".size-option span").removeClass("text-white").addClass("text-brandBlue-normal");
                $(this).find("span").removeClass("text-brandBlue-normal").addClass("text-white");

                selectedSize = $(this).text().trim();
                $("#stockWarning").addClass("hidden");

                const matched = specs.find(spec =>
                    spec.product_color === selectedColor && spec.product_size === selectedSize
                );

                const stockText = matched ? `庫存剩 ${matched.product_stock} 件` : "無此規格";
                $(".text-brandGray-normalLight").text(stockText);

                // 顯示庫存不足警告
                if (matched && matched.product_stock <= 0) {
                    $("#stockWarning").removeClass("hidden").text("此商品已售罄");
                }
            });


            // 監聽顏色圓圈點擊事件
            $("[data-color-wrapper] div").click(function() {
                // 移除所有圓圈的邊框強調（取消選取）
                $("[data-color-wrapper] div").removeClass("ring-2 ring-brandBlue-normal");

                // 為當前點擊的顏色圓圈加上選取樣式
                $(this).addClass("ring-2 ring-brandBlue-normal");

                // 可選：取得點選的顏色
                selectedColor = $(this).data("color");
                $("#stockWarning").addClass("hidden");
                console.log("選中的顏色是：", selectedColor);
                selectedSize = null;
                $(".text-brandGray-normalLight").text("請選擇顏色和尺寸");
                
                // 過濾對應尺寸
                const sizeOptions = specs
                    .filter(spec => spec.product_color === selectedColor)
                    .map(spec => spec.product_size);

                // 重新渲染尺寸按鈕
                const sizeContainer = $(".size-option").parent(); // 找到尺寸區塊
                sizeContainer.empty(); // 清空
                sizeOptions.forEach(size => {
                    sizeContainer.append(`
                     <button class="size-option lg:w-12 lg:h-12 sm:w-7 sm:h-7 border border-brandBlue-normal flex items-center justify-center rounded-md">
                    <span class="text-brandBlue-normal lg:text-2xl md:text-lg font-light font-['Lexend'] leading-9">${size}</span></button>
                    `);
                });

                // 將庫存數字清除
                selectedSize = null;
                $(".text-brandGray-normalLight").text("請選擇尺寸");
            });




            function addToCart() {
                // 檢查必要參數
                if (!isAccessory && (!selectedColor || !selectedSize)) {
                    alert("請選擇顏色與尺寸");
                    return;
                }

                // 發送到後端
                fetch("{{ route('insertCart') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json",
                        "Accept": "application/json" // 確保 Laravel 回傳 JSON 而不是錯誤頁
                    },
                    body: JSON.stringify({
                        product_id: "{{ $product->product_id }}",
                        product_color: isAccessory ? null : selectedColor,
                        product_size: isAccessory ? null : selectedSize,
                        quantity: quantity
                    })
                })
                .then(async res => {
                    if (res.status === 401) {
                        alert("請先登入！");
                        window.location.href = "{{ route('login') }}";
                        return;
                    }

                    if (!res.ok) {
                        const errorData = await res.json();
                        throw new Error(errorData.message || "加入失敗");
                    }

                    const result = await res.json();
                    alert("已加入購物車！");
                })
                .catch(err => {
                    console.error("加入購物車失敗", err);
                    alert("加入失敗，請稍後再試");
                });
            }

            function buyNow() {
                // 檢查必要參數
                if (!isAccessory && (!selectedColor || !selectedSize)) {
                    alert("請選擇顏色與尺寸");
                    return;
                }

                // 發送到後端
                fetch("{{ route('insertCart') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        product_id: "{{ $product->product_id }}",
                        product_color: isAccessory ? null : selectedColor,
                        product_size: isAccessory ? null : selectedSize,
                        quantity: quantity
                    })
                })
                .then(async res => {
                    if (res.status === 401) {
                        alert("請先登入！");
                        window.location.href = "{{ route('login') }}";
                        return;
                    }

                    if (!res.ok) {
                        const errorData = await res.json();
                        throw new Error(errorData.message || "加入失敗");
                    }

                    const result = await res.json();

                    // 寫入成功後導向購物車
                    $("#formProductId").val("{{ $product->product_id }}");
                    $("#formProductSize").val(selectedSize);
                    $("#formProductColor").val(selectedColor);
                    $("#formQuantity").val(quantity);

                    // 使用正確的路由而不是硬編碼路徑
                    $("#quickBuyForm").submit();
                })
                .catch(err => {
                    console.error("加入購物車失敗", err);
                    alert("加入失敗，請稍後再試");
                });
            }

            // 點擊「加入購物車」按鈕 → 留在購物車頁
            $("#addToCartBtn").click(function() {
                addToCart();
            });

            // 點擊「直接購買」按鈕 → 導向結帳頁
            $("#buyNowBtn").click(function () {
                buyNow();
            });




            let quantity = 01
            $("#quantity").text("01");

            // 監聽減少數量按鈕點擊
            $("#decrese").click(function() {
                if (quantity > 1) {
                    quantity--;
                    $("#quantity").text(quantity.toString().padStart(2, '0'));
                    
                    // 只有非飾品才需要處理庫存警告
                    if (!isAccessory) {
                        // 數量減少後，隱藏庫存警告
                        $("#stockWarning").addClass("hidden");
                    }
                }
            })
            // 監聽增加數量按鈕點擊
            $("#add").click(function() {
                // 如果是飾品，檢查總庫存量
                if (isAccessory) {
                    // 飾品通常只有一個規格，找到第一個規格的庫存
                    const accessoryStock = specs.length > 0 ? specs[0].product_stock : 0;
                    
                    if (quantity < accessoryStock) {
                        quantity++;
                        $("#quantity").text(quantity.toString().padStart(2, '0'));
                        $("#stockWarning").addClass("hidden");
                    } else {
                        $("#stockWarning").removeClass("hidden");
                    }
                    return;
                }

                const matched = specs.find(spec =>
                    spec.product_color === selectedColor && spec.product_size === selectedSize
                );

                if (!matched) return; // 還沒選顏色/尺寸就不動作

                if (quantity < matched.product_stock) {
                    quantity++;
                    $("#quantity").text(quantity.toString().padStart(2, '0'));
                    //如果之前有警告，這裡要隱藏
                    $("#stockWarning").addClass("hidden");
                }
                if (quantity >= matched.product_stock) {
                    $("#stockWarning").removeClass("hidden");
                }
            })

            // 監聽產品需知按鈕點擊
            $("#info").click(function() {
                $("#show-img-content").addClass("hidden");
                $("#info-content").removeClass("hidden")
                $("#info-text").addClass("text-brandRed-normal")
                $("#show-img-text").removeClass("text-brandRed-normal")
                $(this).addClass("shadow-[inset_0px_-3px_0px_0px_rgba(220,53,69,1.00)]")
                $("#show-img").removeClass("shadow-[inset_0px_-3px_0px_0px_rgba(220,53,69,1.00)]")
            })

            // 監聽產品展示圖按鈕點擊
            $("#show-img").click(function() {
                $("#info-content").addClass("hidden");
                $("#show-img-content").removeClass("hidden")
                $("#info-text").removeClass("text-brandRed-normal")
                $("#show-img-text").addClass("text-brandRed-normal")
                $(this).addClass("shadow-[inset_0px_-3px_0px_0px_rgba(220,53,69,1.00)]")
                $("#info").removeClass("shadow-[inset_0px_-3px_0px_0px_rgba(220,53,69,1.00)]")
            })
        })
        const specs = @json($product->specs);
    </script>
@endpush
