@props(['label', 'name', 'value' => ''])

@php
    $defaults = [
        'type' => 'text',
        'id' => $name,
        'name' => $name,
        'class' => 'cursor-pointer rounded-xl bg-black/10 bg-border-black/10 bg:bg-white/10 border  px-5 py-4 w-full',
        'value' => old($name, $value)
    ];
@endphp

<x-forms.field :$label :$name>
    <input {{ $attributes($defaults) }} />
</x-forms.field>

