@props(['label', 'name'])

@php
    $defaults = [
        'type' => 'checkbox',
        'id' => $name,
        'name' => $name,
        'value' => old($name)
    ];
@endphp

<x-forms.field :$label :$name>
    <div class="rounded-xl  bg-black/10 dark:bg-white/10 border border-black/10 dark:border-white/10 px-5 py-4 w-full">
        <input {{ $attributes($defaults) }}>
        <span class="pl-1">{{ $label }}</span>
    </div>
</x-forms.field>

