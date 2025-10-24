<?php
use function Laravel\Folio\name;
name('experiments');
?>

<x-layouts.app>
    <x-page-heading>Experiments</x-page-heading>

    <p class="mb-6 text-gray-600 dark:text-gray-400">
        This is a page for experimenting with new ideas and concepts.
    </p>

    @php
        $experiments = [
            'demo' => 'Simple search as fullpage Livewire component',
            'volt' => 'Simple search as Livewire Volt component',
            'folio-demo' => 'Simple search as Laravel Folio + inline Livewire Volt component',
        ];
    @endphp

    <ul class="list-inside list-disc space-y-2">
        @foreach ($experiments as $route => $label)
            <li>
                <a
                    href="{{ route($route) }}"
                    class="text-blue-600 hover:underline dark:text-blue-400"
                >
                    {{ $label }}
                </a>
            </li>
        @endforeach
    </ul>
</x-layouts.app>
