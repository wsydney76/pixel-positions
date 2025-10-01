@props([
    'label', 'name', 'placeholder' => ''
])

@php
    $id = $name . '-' . uniqid();
@endphp

<div {{ $attributes }}>
    <label for="{{ $id }}" class="block mb-2 font-semibold">{{ $label }}</label>
    <input id="{{ $id }}"
           class="rounded-lg bg-black/10 bg-border-black/10 bg:bg-white/10 border bg:border-white/10 px-3 py-2 text-sm w-full"
           wire:model.live.debounce.500ms="{{ $name }}"
           type="text"
           placeholder="{{ $placeholder }}"/>
</div>
