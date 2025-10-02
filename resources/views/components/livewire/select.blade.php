@props([
    'options', 'label', 'name'
])

@php
    $id = $name . '-' . uniqid();
@endphp

<div {{ $attributes }}>
    @if($options)
        <label for="{{ $id }}" class="block mb-2 font-semibold">{{ $label }}</label>
        <select id="{{ $id }}" class="rounded-lg bg-black/10 border px-3 py-2 text-sm w-full"
                wire:model.live="{{ $name }}">
            @foreach($options as $option)
                <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
            @endforeach
        </select>
    @endif
</div>
