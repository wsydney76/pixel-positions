@props([
    'size' => 'base',
    'type' => 'link',
])

@php
    $classes = 'rounded-xl bg-black/5 font-bold whitespace-nowrap text-black transition-colors hover:bg-black/10 dark:bg-black dark:text-white dark:hover:bg-white/25';

    $classes .= match ($size) {
        'small' => ' px-3 py-1 text-2xs',
        default => ' px-5 py-1 text-xs',
    };

    if ($type == 'button') {
        $classes .= ' cursor-pointer';
    }
@endphp

@if ($type == 'link')
    <a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button type="button" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif
