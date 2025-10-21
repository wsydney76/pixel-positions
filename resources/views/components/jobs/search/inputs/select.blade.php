@props([
    'options',
    'label',
    'name',
])

@php
    $id = $name . '-' . uniqid();
@endphp

<div {{ $attributes }}>
    @if ($options)
        <label for="{{ $id }}" class="mb-2 block font-semibold">{{ $label }}</label>
        <select
            id="{{ $id }}"
            class="w-full rounded-lg border bg-black/10 px-3 py-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white"
            wire:model.live="{{ $name }}"
        >
            @foreach ($options as $option)
                <option
                    value="{{ $option['value'] }}"
                    class="bg-white text-black dark:bg-gray-900 dark:text-white"
                >
                    {{ $option['label'] }}
                </option>
            @endforeach
        </select>
    @endif
</div>
