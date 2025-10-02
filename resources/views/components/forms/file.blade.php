@props(['label', 'name', 'value' => ''])

@php
    $defaults = [
        'type' => 'file',
        'id' => $name,
        'name' => $name,
        'class' =>
            'file:rounded-full file:border-0 file:bg-black/20 file:mr-4 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-black hover:file:bg-black/30 file:transition-colors cursor-pointer ',

    ];
@endphp

<x-forms.field :$label :$name>
    <div class="flex gap-4 items-center border border-black dark:border-white/10 rounded-xl bg-black/10 dark:bg-white/10 px-5 py-4">
        <div class="my-2">
            {{ $slot }}
        </div>
        <div>
            <input {{ $attributes($defaults) }} />
        </div>
    </div>
</x-forms.field>

