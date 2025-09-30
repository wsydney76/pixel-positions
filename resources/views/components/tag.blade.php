@props(['tag', 'size' => 'base'])

@php
    $classes = "bg-white hover:bg-black/10 text-black dark:bg-black dark:hover:bg-white/25 dark:text-white rounded-xl font-bold transition-colors";

    if ($size === 'base') {
        $classes .= " px-5 py-1 text-sm";
    }

    if ($size === 'small') {
        $classes .= " px-3 py-1 text-2xs";
    }
@endphp

<a href="/tags/{{ strtolower($tag->name) }}" class="{{ $classes }}">{{ ucwords($tag->name) }}</a>
