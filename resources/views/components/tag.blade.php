@props([
    'tag',
    'size' => 'base',
])

<x-pill href="{{ route('tags.show', $tag) }}" :size="$size">
    {{ strtolower($tag->name) }}
</x-pill>
