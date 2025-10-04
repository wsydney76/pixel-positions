@props([
    'employer',
    'width' => 90,
])

<img
    src="{{ asset($employer->logo) }}"
    alt=""
    class="aspect-square rounded-xl bg-transparent object-contain dark:bg-black"
    width="{{ $width }}"
/>
