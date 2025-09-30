@props(['employer', 'width' => 90])

<img src="{{ asset($employer->logo) }}" alt="" class="rounded-xl bg-white dark:bg-black" width="{{ $width }}">
