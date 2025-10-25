<?php
use App\Models\Job;
use function Livewire\Volt\{computed, state, updating, usesPagination};

usesPagination();

state('search')->url(history: true);

$jobs = computed(function () {
    $query = $this->search
        ? Job::whereFullText(['title', 'description'], $this->search, ['mode' => 'boolean'])
        : Job::orderBy('created_at', 'desc');
    return $query->with(['employer', 'tags'])->paginate(6);
});

updating(['search' => fn () => $this->resetPage()]);
?>

<div>
    <x-page-heading>Livewire Volt Demo</x-page-heading>

    <x-search-tips class="mb-4"/>

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
        <div class="mt-6 text-gray-500">No jobs found</div>
    @endif
</div>
