@props(['tag', 'size' => 'base'])

<x-pill href="{{ route('jobs.search', ['tag' => $tag->name]) }}" :size="$size">
    {{ strtolower($tag->name) }}
</x-pill>
