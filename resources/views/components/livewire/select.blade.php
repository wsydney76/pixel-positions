@props([
    'options', 'label', 'name'
])

@php
    $id = $name . '-' . uniqid();
@endphp

<div {{ $attributes }}>
    @if($options)
        <label for="{{ $id }}" class="block mb-2 font-semibold">{{ $label }}</label>
        <select id="{{ $id }}"
                class="rounded-lg bg-black/10 border px-3 py-2 text-sm w-full dark:bg-gray-800 dark:border-gray-700 dark:text-white"
                wire:model.live="{{ $name }}">
            @foreach($options as $option)
                <option value="{{ $option['value'] }}"
                        class="bg-white text-black dark:bg-gray-900 dark:text-white">{{ $option['label'] }}</option>
            @endforeach
        </select>
    @endif
</div>
