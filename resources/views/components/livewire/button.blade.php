@props(['action', 'label' => 'Submit'])

<button wire:click="{{ $action }}"
        class="cursor-pointer bg-black hover:bg-black/70 text-white font-semibold px-3 py-2 text-sm rounded-lg w-full transition-colors">
    {{ $label }}
</button>
