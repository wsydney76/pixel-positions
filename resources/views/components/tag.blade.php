@props(['tag', 'size' => 'base'])

@php
    $classes = "bg-black/5 whitespace-nowrap hover:bg-black/10 text-black dark:bg-black dark:hover:bg-white/25 dark:text-white rounded-xl font-bold transition-colors";

    $classes .= match ($size) {
        'small' => " px-3 py-1 text-2xs",
        default => " px-5 py-1 text-xs",
    };
@endphp

<a href="{{ route('jobs.search', ['tag' => $tag->name]) }}" class="{{ $classes }}">{{ strtolower($tag->name) }}</a>
