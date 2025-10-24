<?php

use App\Models\Job;
use function Laravel\Folio\name;
use function Livewire\Volt\{computed, state, updating, usesPagination};

name('experiments.folio-volt-inline');

usesPagination();

state('search')->url(history: true);

$jobs = computed(function () {
    return Job::whereFullText(['title', 'description'], $this->search, ['mode' => 'boolean'])
        ->with(['employer', 'tags'])
        ->paginate(6);
});

updating(['search' => fn () => $this->resetPage()]);
?>

<x-layouts.app>
    <x-page-heading>Folio and Livewire and Volt...</x-page-heading>

    <p class="mb-6 text-gray-600 dark:text-gray-400">
        This is a demo page showing how to use Laravel Folio with Livewire Volt to build a simple
        job search page in just one file.
    </p>



    @volt
        <div>
            <x-search-tips wire:ignore/>

            <label for="search" class="mb-2 block font-semibold">Search title/description</label>
            <input
                class="bg-border-black/10 bg:bg-white/10 bg:border-white/10 w-full rounded-lg border bg-black/10 px-3 py-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                type="search"
                wire:model.live.debounce.500ms="search"
            />

            @if ($this->jobs->count())
                <div class="mt-8 space-y-6">
                    @foreach ($this->jobs as $job)
                        <x-jobs.card-wide :$job context="demo" />
                    @endforeach

                    <div>
                        {{ $this->jobs->links() }}
                    </div>
                </div>
            @else
                <div class="mt-6 text-gray-500">
                    {{ $search ? 'No job found' : 'Enter search criteria' }}
                </div>
            @endif
        </div>
    @endvolt

    <p class="mt-8">
        <a
            href="{{ route('jobs.search') }}"
            class="text-blue-600 hover:underline dark:text-blue-400"
        >
            View full featured job search page implemented with Livewire class and separate Blade
            view.
        </a>
    </p>
</x-layouts.app>
