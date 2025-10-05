@props([
    'employer',
])

<x-pill href="{{ route('employers.show', $employer) }}">
    {{ $employer->name }}
</x-pill>
