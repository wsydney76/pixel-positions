@props(['label', 'name', 'value' => ''])

@php
    $defaults = [
        'type' => 'text',
        'id' => $name,
        'name' => $name,
        'class' => ($attributes->get('type') === 'file' ?
            'file:rounded-full file:border-0 file:bg-black/20 file:mr-4 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-black hover:file:bg-black/30 file:transition-colors ' : '') .
            'cursor-pointer rounded-xl bg-black/10 bg-border-black/10 bg:bg-white/10 border bg:border-white/10 px-5 py-4 w-full',
        'value' => old($name, $value)
    ];
@endphp

<x-forms.field :$label :$name>
    <input {{ $attributes($defaults) }} />
</x-forms.field>

