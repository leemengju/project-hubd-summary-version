@php
$classes = match ($type) {
    'sky-600' => 'bg-sky-600 hover:opacity-50 text-white',
    'sky-500' => 'bg-sky-500 hover:opacity-50 text-white',
    'sky-400' => 'bg-sky-400 hover:opacity-50 text-white',
    'sky-300' => 'bg-sky-300 hover:opacity-50 text-white',
    default => 'bg-sky-200 hover:opacity-50 text-white'
};
@endphp

<button {{ $attributes->merge(['class' => "px-4 py-2 rounded-md $classes"]) }}>
    {{ $slot }}
</button>