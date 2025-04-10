@extends('layouts.app')

@section('title', '首頁')
@section('meta_description', '首頁')
@section('meta_keywords', '首頁, home')

@section('content')
<section class="relative mt-[200px] md:mt-[260px] lg:mt-[200px] w-full h-[5800px] md:h-[4200px]">
    <!-- banner 輪播圖 -->
    <section class="w-full h-[415px] md:h-[440px] lg:h-[600px] overflow-hidden border-b-2 shadow-[0_15px_0_0_brandGray-normalLight] flex flex-col mb-[60px]">
        <div class="relative w-full h-[325px] md:h-[350px] lg:h-[600px] overflow-hidden flex justify-center items-start gap-5">
            @foreach ($banners as $index => $banner)
            <div class="banner{{ $index + 1 }} relative w-[390px] md:w-[420px] lg:w-[720px] h-full flex-shrink-0">
                <img src="{{ 'http://localhost:8000/storage/' . $banner->banner_img}}" alt="{{ $banner->banner_title }}" class="w-full h-full min-w-[390px] md:min-w-full max-h-[325px] md:max-h-full object-cover">
                <div class="bannerMask{{ $index + 1 }} hidden lg:visible invisible absolute z-20 top-0 left-0 w-full h-full bg-gradient-to-t from-brandGray-normal opacity-40"></div>
                <div class="bannerMask{{ $index + 1 }} hidden lg:visible invisible absolute z-30 bottom-0 w-full h-[208px] flex flex-col justify-center items-start lg:px-[60px] md:px-[20px] gap-[16px] pb-14">
                    <div class="text-brandGray-lightLight flex flex-col justify-center items-start gap-2">
                        <p class="lg:text-[26px] font-semibold">{{ $banner->banner_title }}</p>
                        <p class="lg:text-[18px] break-words text-wrap px-4">{{ $banner->banner_description }}</p>
                    </div>
                    <a href="{{ $banner->banner_link }}">
                        <div class="w-[140px] h-[50px] flex justify-start items-center ms-3 hover:opacity-80">
                            <div class="md:w-[40px] lg:w-[50px] md:h-[40px] lg:h-[50px] flex justify-center items-center rounded-full bg-brandRed-normal me-3">
                                <span class="w-[9xp] h-[16px] bg-brandGray-lightLight icon-[ep--arrow-right-bold]"></span>
                            </div>
                            <p class="text-brandGray-lightLight font-semibold lg:text-[18px]">了解更多</p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- progress + btn -->
        <div class="w-full h-[90px] lg:h-[136px] flex justify-center items-center px-[60px] md:px-[100px]">
            <div class="w-[50%] h-[50px] flex justify-start items-center hidden md:block">
                <div class="w-full h-full flex justify-start items-center">
                    <div class="progresBar1 w-[120px] h-[1px] bg-brandRed-normal"></div>
                    <div class="progresBar1 w-[12px] h-[12px] bg-brandRed-normal rounded-full"></div>
                    <div class="progresBar2 w-[120px] h-[1px] bg-brandGray-normalLight"></div>
                    <div class="progresBar2 w-[12px] h-[12px] bg-brandGray-normalLight rounded-full"></div>
                    <div class="progresBar3 w-[120px] h-[1px] bg-brandGray-normalLight"></div>
                    <div class="progresBar3 w-[12px] h-[12px] bg-brandGray-normalLight rounded-full"></div>
                </div>
            </div>
            <div class="w-full md:w-[50%] h-[50px] flex justify-end items-center">
                <div class="w-full h-full flex justify-end items-center gap-3">
                    <button type="button" class="preBtn w-[50px] h-[50px] border-2 rounded-full border-brandGray-normalLight flex justify-center items-center"><span class="w-5 h-5 text-brandGray-normalLight icon-[ep--arrow-left-bold]"></span></button>
                    <button type="button" class="nextBtn w-[50px] h-[50px] border-2 rounded-full border-brandRed-normal flex justify-center items-center"><span class="w-5 h-5 text-brandRed-normal icon-[ep--arrow-right-bold]"></span></button>
                </div>
            </div>
        </div>
    </section>

    <!-- 主打商品 -->
    <section class="w-full h-[650px] md:h-[820px] lg:h-[960px] flex md:flex-col lg:flex-row justify-center items-center mb-[60px]">
        <div class="w-[550px] h-full md:w-[550px] lg:w-[50%] flex justify-center items-start lg:ps-[90px]">
            @if ($hitItems->isNotEmpty())
            @php $firstItem = $hitItems->first(); @endphp
            <div class="md:w-[550px] h-full md:h-[820px] flex flex-col justify-center items-center gap-14">
                <div class="w-full h-10 flex justify-start items-center">
                    <p class="text-[32px] font-semibold text-brandGray-normal">主打商品&nbsp;&nbsp;<span class="font-normal">Hit Items</span></p>
                </div>
                <div class="w-full flex justify-between lg:justify-center items-center">
                    <!-- 左邊按鈕 -->
                    <button type="button" class="lg:hidden hit-prev w-[50px] h-[50px] border-2 rounded-full border-brandRed-normal flex justify-center items-center active:opacity-50">
                        <span class="w-5 h-5 text-brandRed-normal icon-[ep--arrow-left-bold]"></span>
                    </button>
                    <!-- 主打商品圖片 -->
                    <div class="flex justify-center items-center w-[300px] md:w-[400px] lg:w-[400px] h-[300px] md:h-[400px] lg:h-[400px]">
                        <img src="{{ 'http://localhost:8000/storage/' . $firstItem->product_img }}" alt="{{ $firstItem->product_name }}" class="targetImg w-full h-full object-cover" loading="lazy">
                    </div>
                    <!-- 右邊按鈕 -->
                    <button type="button" class="lg:hidden hit-next w-[50px] h-[50px] border-2 rounded-full border-brandRed-normal flex justify-center items-center active:opacity-50">
                        <span class="w-5 h-5 text-brandRed-normal icon-[ep--arrow-right-bold]"></span>
                    </button>
                </div>

                <div class="w-full h-full md:h-[266px]">
                    <div class="md:pb-[28px]">
                        <p class="text-brandGray-normal text-[24px] mb-5 targetName">{{ $firstItem->product_name }}</p>
                        <p class="hidden md:block text-brandGray-normalLight text-[16px] targetDesc">{{ $firstItem->product_description }}</p>
                    </div>
                    <div class="pb-[28px] text-[24px]">
                        <p>NT$&nbsp;<span class="targetPrice">{{ $firstItem->product_price }}</span></p>
                    </div>
                    <div class="md:w-full md:h-[50px] flex justify-center md:justify-between items-center md:gap-5">
                        <!-- 顏色 -->
                        <div class="md:h-full hidden md:flex justify-start items-center gap-[20px]">
                            <div class="w-[35px] h-[35px]  bg-brandGray-darker border-2 border-brandGray-normalLight rounded-full"></div>
                            <div class="w-[35px] h-[35px]  bg-brandGray-normal border-2 border-brandGray-normalLight rounded-full"></div>
                            <div class="w-[35px] h-[35px]  bg-brandGray-lightlLight border-2 border-brandGray-normalLight rounded-full"></div>
                        </div>
                        <!-- 尺寸 -->
                        <div class="hidden md:flex text-[24px] text-brandGray-normal justify-center items-center">
                            <div class="w-[50px] h-[50px] flex justify-center items-center">L</div>
                            <div class="w-[50px] h-[50px] flex justify-center items-center">M</div>
                            <div class="w-[50px] h-[50px] flex justify-center items-center">S</div>
                        </div>
                        <!-- 查看商品按鈕 -->
                        <a href="{{ route('product_details', ['id' => $firstItem->product_id]) }}" class="w-full md:w-[250px] h-[50px] text-[20px] text-semibold text-brandGray-lightLight flex justify-center items-center bg-brandRed-normal rounded-md hover:opacity-80">
                            商品詳情&nbsp;<span class="product-detail-link w-[20px] h-[20px] text-brandGray-lightLight icon-[ep--arrow-right-bold]"></span>
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- 轉盤區 -->
        <div class="hidden lg:block relative w-[50%] h-full ps-[55px] overflow-hidden">
            <div class="absolute top-[80px] left-[120px] w-[750px] h-[750px] border-[95px] border-brandRed-light rounded-full"></div>
            @foreach ($hitItems as $index => $item)
            <div class="roulette{{ $index + 1 }} cursor-pointer absolute z-30
            @if ($index == 0) border-brandRed-normal @else border-brandRed-light @endif"
                data-name="{{ $item->product_name }}"
                data-desc="{{ $item->product_description }}"
                data-price="{{ $item->product_price }}"
                data-img="{{ 'http://localhost:8000/storage/' . $item->product_img }}"
                @click="updateTarget({{ $index + 1 }})"
                style="
                @if($index == 0) top: 150px; left: 80px;
                @elseif($index == 1) top: 500px; left: 80px;
                @elseif($index == 2) bottom: 40px; left: 380px;
                @elseif($index == 3) top: 500px; left: 700px;
                @elseif($index == 4) top: 150px; left: 700px;
                @elseif($index == 5) top: 0px; left: 380px;
                @endif
                width: 250px;
                height: 250px;
                background-color: #F8F9FA;
                border-width: 8px;
                border-radius: 50%;
                hover:opacity-80;
                active:opacity-50;
            ">
                <img src="{{ 'http://localhost:8000/storage/' . $item->product_img }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover rounded-full">
            </div>
            @endforeach
        </div>
    </section>


    <!-- 分類卡片區 -->
    <section class="w-full min-h-[1220px] md:min-h-[600px] md:h-[600px] flex justify-center items-center mb-[80px]">
        <div class="w-full h-full flex flex-col md:flex-row justify-center items-center gap-5">
            <!-- 左邊 單張 -->
            <div class="relative w-full md:w-[360px] lg:w-[620px] h-full">
                <img src="{{asset('images/home/card_three1.jpg')}}" alt="銀黏土課程" class="w-full h-full object-cover">
                <!-- 紅色文字區塊 -->
                <div class="absolute left-0 bottom-0 w-full lg:w-[420px] h-[238px] bg-[#DC7881] opacity-80 flex justify-center items-center">
                    <div class="w-[225px] h-[136px] text-brandGray-lightLight">
                        <p class=" font-semibold text-[24px]">銀黏土課程</p>
                        <p class=" font-normal text-[24px] mb-5">Sliver Clay Lessons</p>
                        <a href="{{route('lessons')}}"><button type="button" class="w-[137px] h-[52px] font-semibold border-2 border-brandGray-lightLight rounded-lg hover:bg-brandRed-normal active:opacity-50">了解更多</button></a>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-[620px] h-full flex flex-col justify-start items-center gap-5">
                <!-- 右邊 上面 -->
                <div class="w-full h-[290px] relative flex justify-center items-center">
                    <img src="{{asset('images/home/card_three2.jpg')}}" alt="飾品圖" class="w-full h-full object-cover">
                    <!-- 紅色文字區塊 -->
                    <div class="absolute w-full md:w-[348px] h-[153px] left-0 bottom-0 bg-[#DC7881] opacity-80 flex justify-center items-center pt-[35px]">
                        <div class="w-[225px] h-[136px] text-brandGray-lightLight">
                            <p class="text-[24px] mb-5"><span class="font-semibold">飾品</span>&nbsp;&nbsp;<span class="font-nornal">Accessories</span></p>
                            <a href="{{ route('categories_accessories')}}"><button tpe="button" class="w-[137px] h-[52px] font-semibold  border-2 border-brandGray-lightLight rounded-lg hover:bg-brandRed-normal active:opacity-50">了解更多</button></a>
                        </div>
                    </div>
                </div>
                <!-- 右邊 下面 -->
                <div class="w-full h-[290px] relative flex justify-center items-center">
                    <img src="{{asset('images/home/card_three3.jpg')}}" alt="服飾圖" class="w-full h-full object-cover">
                    <!-- 紅色文字區塊 -->
                    <div class="absolute w-full md:w-[348px] h-[153px] left-0 bottom-0 bg-[#DC7881] opacity-80 flex justify-center items-center pt-[35px]">
                        <div class="w-[225px] h-[136px] text-brandGray-lightLight">
                            <p class="text-[24px] mb-5"><span class="font-semibold">服飾</span>&nbsp;&nbsp;<span class="font-nornal">Clothes</span></p>
                            <a href="{{ route('categories_clothes')}}"><button type="button" class="w-[137px] h-[52px] font-semibold  border-2 border-brandGray-lightLight rounded-lg hover:bg-brandRed-normal active:opacity-50">了解更多</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- slogan -->
    <section class="w-full h-[52px] md:h-[80px] flex justify-center items-center mb-[80px]">
        <div class="w-full h-full flex justify-center items-center gap-6 md:gap-14">
            <div class="w-[28px] md:w-[40px] h-[28px] md:h-[40px]"><span class="w-full h-full bg-brandRed-normal icon-[mage--star-moving-fill]"></span></div>
            <div class="w-[220px] md:w-[380px] h-full text-[18px] md:text-[24px] text-brandGray-dark flex flex-col justify-center items-center">
                <p>你依舊閃閃發亮，</p>
                <p>在非生日的 364 個日子裡</p>
            </div>
            <div class="w-[28px] md:w-[40px] h-[28px] md:h-[40px]"><span class="w-full h-full bg-brandRed-normal icon-[mage--star-moving-fill]"></span></div>
        </div>
    </section>

    <!-- banner -->
    <section class="w-full h-[334px] md:h-[376px] lg:h-[580px] mb-[60px]">
        <div class="w-full h-[108px] md:h-[233px] lg:h-[400px]"><img src="{{asset('images/home/banner_middle.jpg')}}" alt="品牌橫幅" class="w-full h-full object-cover"></div>
        <!-- 小圖示區 -->
        <div class="w-full flex justify-center items-center py-10 shadow-md">
            <div class="md:w-[760px] lg:w-[1066px] grid grid-cols-2 md:grid-cols-4 gap-5 md:gap-[40px] lg:gap-[142px] justify-center items-center">
                <div class="col-span-1 w-[170px] h-[60px] flex justify-center items-center gap-2">
                    <div class="w-[56px] h-[56px] flex justify-center items-center"><span class="w-[42px] h-[42px] bg-brandBlue-normal icon-[ion--gift-outline]"></span></div>
                    <div class="text-brandBlue-normal flex flex-col justify-center items-start">
                        <p>Handmade</p>
                        <p>Craft</p>
                    </div>
                </div>
                <div class="col-span-1 w-[170px] h-[60px] flex justify-center items-center gap-2">
                    <div class="w-[56px] h-[56px] flex justify-center items-center"><span class="w-[42px] h-[42px] bg-brandBlue-normal icon-[hugeicons--honour-star]"></span></div>
                    <div class="text-brandBlue-normal flex flex-col justify-center items-start">
                        <p>Hight</p>
                        <p>Quantity</p>
                    </div>
                </div>
                <div class="col-span-1 w-[170px] h-[60px] flex justify-center items-center gap-2">
                    <div class="w-[56px] h-[56px] flex justify-center items-center"><span class="w-[35px] h-[35px] bg-brandBlue-normal icon-[garden--smiley-stroke-12]"></span></div>
                    <div class="text-brandBlue-normal flex flex-col justify-center items-start">
                        <p>Hight</p>
                        <p>Satsification</p>
                    </div>
                </div>
                <div class="col-span-1 w-[170px] h-[60px] flex justify-center items-center gap-2">
                    <div class="w-[56px] h-[56px] flex justify-center items-center"><span class="w-[42px] h-[42px] bg-brandBlue-normal icon-[la--shipping-fast]"></span></div>
                    <div class="text-brandBlue-normal flex flex-col justify-center items-start">
                        <p>Flexable</p>
                        <p>Shipping</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 商品卡片區 飾品 -->
    <section class="w-full h-[1170px] md:h-[420px] lg:h-[494px] flex flex-col justify-center items-center mb-[60px]">
        <!-- 標題 -->
        <div class="w-[250px] md:w-[770px] lg:w-[1230px] h-[50px] md:h-[56px] flex item-center mb-[28px]">
            <div class="w-full flex justify-start items-center font-semibold text-brandGray-normal text-[28px] md:text-[30px]">
                <p>飾品&nbsp;&nbsp;<span class="hidden md:inline-block">Accessories</span></p>
            </div>
            <a href="{{route('categories_accessories')}}" class="w-full text-[20px] flex justify-end items-center font-normal text-brandGray-normal md:text-[20px] hover:opacity-80 active:opacity-50">
                <p class="hover:text-brandRed-normal flex justify-center items-center">更多商品&nbsp;&nbsp;<span class="w-6 h-6 icon-[ep--arrow-right-bold]"></span></p>
            </a>
        </div>
        <!-- 商品四個 -->
        <div class="w-full md:w-[770px] h-full lg:w-[1230px] lg:h-[418px] grid md:grid-cols-3 lg:grid-cols-4 justify-center items-center gap-5">
            @foreach($accessories as $index => $accessory)
            <a href="{{ route('product_details', ['id' => $accessory->product_id]) }}" class="w-[250px] lg:w-[300px] h-[250px] md:h-full flex flex-col justify-center items-center hover:opacity-80 gap-5 {{$index === 3 ? 'hidden lg:flex' : ''}}">
                <div class="relative w-full h-[250px] lg:w-[300px] lg:h-[300px]">
                    @if($accessory->specs_sum_product_stock == 0)
                    <div class="absolute w-36 h-14 bg-brandGray-light bg-opacity-20 text-[24px] text-brandGray-light flex justify-center items-center top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-30">SOLD OUT</div>
                    <div class="absolute w-full h-full bg-brandGray-normal opacity-60 flex justify-center items-center top-0 left-0"></div>
                    @endif
                    <img src="{{ 'http://localhost:8000/storage/' . $accessory->product_img }}" alt="{{$accessory->product_name}}" class="w-full h-full object-cover">
                </div>
                <div class="w-full h-[74px] flex flex-col justify-center items-start gap-3 text-[20px]">
                    <p class="text-brandGray-darker">{{$accessory->product_name}}</p>
                    <p class="text-brandGray-normal text-[18px]">NT$&nbsp;<span id="price">{{ number_format($accessory->product_price) }}</span></p>
                </div>
            </a>
            @endforeach
        </div>
    </section>


    <!-- 商品卡片區 服飾 -->
    <section class="w-full h-[1170px] md:h-[420px] lg:h-[494px] flex flex-col justify-center items-center mb-[60px]">
        <!-- 標題 -->
        <div class="w-[250px] md:w-[770px] lg:w-[1230px] h-[50px] md:h-[56px] flex item-center mb-[28px]">
            <div class="w-full flex justify-start items-center font-semibold text-brandGray-normal text-[28px] md:text-[30px]">
                <p>服飾&nbsp;&nbsp;<span class="hidden md:inline-block">Clothes</span></p>
            </div>
            <a href="{{route('categories_clothes')}}" class="w-full text-[20px] flex justify-end items-center font-normal text-brandGray-normal md:text-[20px] hover:opacity-80 active:opacity-50">
                <p class="hover:text-brandRed-normal flex justify-center items-center">更多商品&nbsp;&nbsp;<span class="w-6 h-6 icon-[ep--arrow-right-bold]"></span></p>
            </a>
        </div>
        <!-- 商品四個 -->
        <div class="w-full md:w-[770px] h-full lg:w-[1230px] lg:h-[418px] grid md:grid-cols-3 lg:grid-cols-4 justify-center items-center gap-5">
            @foreach($clothes as $index => $cloth)
            <a href="{{ route('product_details', ['id' => $cloth->product_id]) }}" class="w-[250px] lg:w-[300px] h-[250px] md:h-full flex flex-col justify-center items-center hover:opacity-80 gap-5 {{$index === 3 ? 'hidden lg:flex' : ''}}">
                <div class="relative w-full h-[250px] lg:w-[300px] lg:h-[300px]">
                    @if($cloth->specs_sum_product_stock == 0)
                    <div class="absolute w-36 h-14 bg-brandGray-light bg-opacity-20 text-[24px] text-brandGray-light flex justify-center items-center top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-30">SOLD OUT</div>
                    <div class="absolute w-full h-full bg-brandGray-normal opacity-60 flex justify-center items-center top-0 left-0"></div>
                    @endif
                    <img src="{{ 'http://localhost:8000/storage/' . $cloth->product_img }}" alt="{{$cloth->product_name}}" class="w-full h-full object-cover">
                </div>
                <div class="w-full h-[74px] flex flex-col justify-center items-start gap-3 text-[20px]">
                    <p class="text-brandGray-darker">{{$cloth->product_name}}</p>
                    <p class="text-brandGray-normal text-[18px]">NT$&nbsp;<span id="price">{{ number_format($cloth->product_price) }}</span></p>
                </div>
            </a>
            @endforeach
        </div>
    </section>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(() => {
        // banner hover 效果
        $('.banner1, .banner2, .banner3').on('mouseenter mouseleave', function(event) {
            $(this).find('[class^="bannerMask"]').toggleClass('hidden', event.type === 'mouseleave');
        });

        // 點擊按鈕 輪播 banner
        function moveNext() {
            let banners = $(".banner1, .banner2, .banner3");
            banners.first().appendTo(banners.parent());
        }

        function movePrev() {
            let banners = $(".banner1, .banner2, .banner3");
            banners.last().prependTo(banners.parent());
        }

        $(".nextBtn").on("click", moveNext);
        $(".preBtn").on("click", movePrev);

        let progressIndex = 1; // 進度條初始狀態

        function updateProgressBar() {
            // 重置所有進度條顏色
            $(".progresBar1, .progresBar2, .progresBar3").removeClass("bg-brandRed-normal bg-brandGray-normalLight");

            // 設定對應的進度條顏色
            if (progressIndex === 1) {
                $(".progresBar1").addClass("bg-brandRed-normal");
                $(".progresBar2, .progresBar3").addClass("bg-brandGray-normalLight");
            } else if (progressIndex === 2) {
                $(".progresBar1, .progresBar2").addClass("bg-brandRed-normal");
                $(".progresBar3").addClass("bg-brandGray-normalLight");
            } else if (progressIndex === 3) {
                $(".progresBar1, .progresBar2, .progresBar3").addClass("bg-brandRed-normal");
            }
        }

        // 點擊下一步按鈕
        $(".nextBtn").on("click", () => {
            progressIndex = progressIndex === 3 ? 1 : progressIndex + 1; // 1 → 2 → 3 → 1 循環
            updateProgressBar();
        });

        // 點擊上一步按鈕
        $(".preBtn").on("click", () => {
            progressIndex = progressIndex === 1 ? 3 : progressIndex - 1; // 1 ← 3 ← 2 ← 1 循環
            updateProgressBar();
        });

        updateProgressBar(); // 初始化進度條狀態
    });


    // 轉盤順序
    let rouletteOrder = [1, 2, 3, 4, 5, 6];

    function updateRoulette(clickedIndex) {
        let newOrder = [...rouletteOrder];
        let targetIndex = newOrder.indexOf(clickedIndex);
        let rotatedOrder = newOrder.slice(targetIndex).concat(newOrder.slice(0, targetIndex));

        rotatedOrder.forEach((num, index) => {
            let currentRoulette = $(`.roulette${num}`);
            let nextPosition = `.roulette${rouletteOrder[index]}`;
            let nextBorder = index === 0 ? "border-brandRed-normal" : "border-brandRed-light";

            currentRoulette.animate({
                top: $(nextPosition).css("top"),
                left: $(nextPosition).css("left"),
            }, 300, function() {
                currentRoulette.removeClass("border-brandRed-normal border-brandRed-light").addClass(nextBorder);

                if (index === 0) {
                    let newTarget = currentRoulette;
                    $(".targetImg").attr("src", newTarget.attr("data-img"));
                    $(".targetName").text(newTarget.attr("data-name"));
                    $(".targetDesc").text(newTarget.attr("data-desc"));
                    $(".targetPrice").text(newTarget.attr("data-price"));
                }
            });
        });

        rouletteOrder = rotatedOrder;
    }

    // 綁定點擊事件
    $(".roulette1, .roulette2, .roulette3, .roulette4, .roulette5, .roulette6").on("click", function() {
        let clickedNumber = parseInt($(this).attr("class").match(/roulette(\d)/)[1]);
        if (clickedNumber !== rouletteOrder[0]) {
            updateRoulette(clickedNumber);
        }
    });

    // 綁定點擊事件
    $(".roulette1, .roulette2, .roulette3, .roulette4, .roulette5, .roulette6").on("click", function() {
        let clickedNumber = parseInt($(this).attr("class").match(/roulette(\d)/)[1]); // 取得點擊的 roulette 編號
        if (clickedNumber !== rouletteOrder[0]) { // 避免點擊目標位置的 roulette
            updateRoulette(clickedNumber);
        }
    });

    const hitItems = @json($hitItems);
    let currentIndex = 0;

    function updateHitItem(index) {
        const item = hitItems[index];
        if (!item) return;

        $('.targetImg').attr('src', `http://localhost:8000/storage/${item.product_img}`);
        $('.targetImg').attr('alt', item.product_name);
        $('.targetName').text(item.product_name);
        $('.targetDesc').text(item.product_description);
        $('.targetPrice').text(item.product_price);
        $('.product-detail-link').attr('href', `/product-details/${item.product_id}`);
    }

    $('.hit-prev').on('click', function() {
        currentIndex = (currentIndex - 1 + hitItems.length) % hitItems.length;
        updateHitItem(currentIndex);
    });

    $('.hit-next').on('click', function() {
        currentIndex = (currentIndex + 1) % hitItems.length;
        updateHitItem(currentIndex);
    });
</script>
@endpush