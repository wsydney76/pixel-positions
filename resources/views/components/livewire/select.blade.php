@props([
    'options', 'label', 'name'
])

<div>
    <label for="{{ $name }}" class="block mb-2 font-semibold">{{ $label }}</label>
    <select id="{{ $name }}" class="rounded-lg bg-black/10 border px-3 py-2 text-sm w-full"
            wire:model.live="{{ $name }}">
        @foreach($options as $option)
            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
        @endforeach
    </select>
</div>
