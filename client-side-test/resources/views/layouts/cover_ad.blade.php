<section id="coverAd" class="fixed animate__animated animate__fadeIn animate__slow animate__delay-1s flex justify-center z-[60]">
    <div class="relative w-[350px] h-[450px] md:w-[700px] md:h-[500px]">
        <!-- 關閉按鈕 -->
        <button type="button" id="closeBtn" class="absolute md:right-8 right-5 top-5 md:top-8 w-6 h-6 hover:opacity-70 active:opacity-50">
            <span class="w-full h-full icon-[gridicons--cross]"></span>
        </button>

        <!-- 文字區塊 -->
        <div class="w-full flex justify-center items-center text-2xl md:text-4xl font-semibold absolute bottom-10 md:bottom-20 text-brandRed-lightActive gap-5">
            <div class="flex justify-center items-center">
                <span class="hidden md:block icon-[iconoir--heart-solid]"></span>&nbsp;&nbsp;
                <p>Happy 2nd Anniversary</p>&nbsp;&nbsp;
                <span class="hidden md:block icon-[iconoir--heart-solid]"></span>
            </div>
        </div>

        <!-- 圖片 -->
        <img src="{{ asset('images/home/cover_ad.jpg') }}" alt="" class="w-full h-full object-cover rounded-lg">
    </div>
</section>


