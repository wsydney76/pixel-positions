@props(['action', 'label' => 'Submit', 'disabled' => 'false'])

<div {{ $attributes }}>
    <button wire:click="{{ $action }}"
            x-bind:disabled="{{ $disabled }}"
            class="cursor-pointer bg-black hover:bg-black/70 disabled:bg-black/30 text-white dark:bg-sky-800 dark:hover:bg-sky-700 dark:disabled:bg-gray-600 dark:text-gray-200 font-semibold px-3 py-2 text-sm rounded-lg w-full transition-colors">
        {{ $label }}
    </button>
</div>
