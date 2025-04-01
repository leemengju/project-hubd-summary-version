<div class="py-10">
    @if(session('error'))
        <div class="p-2 mb-2 text-red-700 bg-red-100 rounded text-center">
            {{ session('error') }}
        </div>
    @endif

    @if ($wishlistItems->isEmpty())
        <div class="flex flex-col items-center justify-center h-[400px] text-center">
            <p class="text-3xl font-semibold text-neutral-700">目前沒有收藏的商品</p>
            <a href="{{ route('home') }}"
                class="mt-6 px-6 py-3 text-lg text-white bg-[#d40404] rounded-lg hover:bg-red-800 transition">
                回到商店
            </a>
        </div>
    @else
        <div class="grid grid-cols-2 gap-6 max-md:grid-cols-1">
            @foreach ($wishlistItems as $item)
                <article class="flex px-8 py-4 bg-white rounded-lg shadow-md">
                    <a href="{{ route('product_details', $item->product->product_id) }}" class="flex flex-1 items-center">
                        <div class="mr-6 bg-gray-300 h-[104px] w-[104px] rounded-lg overflow-hidden">
                            <img src="{{ 'http://localhost:8000/storage/' . $item->product->product_img }}" alt="{{ $item->product->product_name }}"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <h2 class="mb-3 text-xl font-medium text-neutral-800">{{ $item->product->product_name }}</h2>
                            <p class="text-lg text-[#d40404]">${{ $item->product->product_price }}</p>
                        </div>
                    </a>
                    <div class="flex items-center">
                        <button class="remove-wishlist-btn ml-4 px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-600 transition" 
                                data-product-id="{{ $item->product->product_id }}">
                            移除
                        </button>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</div>