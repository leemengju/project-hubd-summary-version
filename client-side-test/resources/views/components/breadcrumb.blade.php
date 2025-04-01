<div class="hidden md:block w-full h-[121px] px-[120px] pt-14 pb-5 flex-col justify-start items-start gap-1 inline-flex">
    <div class="justify-start items-center gap-3 inline-flex">
        @foreach ($items as $index => $item)
            @if ($index > 0)
                <span>/</span>
            @endif
            @if (isset($item['url']))
                <a href="{{ $item['url'] }}" class="opacity-50 text-brandGray text-sm">
                    {{ $item['name'] }}
                </a>
            @else
                <div class="text-brandGray text-sm">{{ $item['name'] }}</div>
            @endif
        @endforeach
    </div>
</div>
