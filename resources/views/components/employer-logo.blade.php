@props(['employer', 'width' => 90])

<img src="{{ asset($employer->logo) }}" alt="" class="rounded-xl bg-transparent dark:bg-black object-contain aspect-square" width="{{ $width }}">
