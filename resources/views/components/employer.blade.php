@props([
    'employer',
])

<x-pill href="{{ route('jobs.search', ['employer' => $employer->name]) }}">
    {{ $employer->name }}
</x-pill>
