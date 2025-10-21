<div>
    <x-page-heading>Search Jobs</x-page-heading>

    {{-- {{ $sql }} --}}

    <div wire:loading.delay.class="bg-black/20 rounded-xl">
        <x-jobs.search.form
            :facetMethod="$facetMethod"
            :employers="$employers"
            :tags="$tags"
            :sortOptions="$sortOptions"
            :minSearchLength="$minSearchLength"
        />

        <x-jobs.search.results :jobs="$jobs" />
    </div>
</div>
