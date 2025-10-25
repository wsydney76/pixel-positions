<div>
    <x-page-heading>Livewire Demo</x-page-heading>

    <label for="search" class="mb-2 block font-semibold">
        Search in title/description (press enter to perform search)
    </label>

    {{--
        Search input:
        - wire:model="search" keeps the input value in sync with the Livewire $search property
        - wire:keydown.enter="performSearch" triggers performSearch() on the server to refresh results
    --}}
    <input
        class="bg-border-black/10 w-full rounded-lg border bg-black/10 px-3 py-2 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white"
        id="search"
        type="search"
        autofocus
        wire:model="search"
        wire:keydown.enter="performSearch"
    />

    {{-- Small helper/tips component for searching --}}
    <x-search-tips class="mt-4"/>

    @if ($jobs->count())
        <div class="mt-8 space-y-6">
            @foreach ($jobs as $job)
                <x-jobs.card-wide :$job context="demo"/>
            @endforeach

            {{-- Pagination links (Livewire-compatible) --}}
            <div>
                {{ $jobs->links() }}
            </div>
        </div>
    @else
        {{-- Empty state: show message depending on whether a search term exists --}}
        <div class="mt-6 text-gray-500">
            {{ $search ? "No jobs found for $search" : 'Enter a search term' }}
        </div>
    @endif
</div>
