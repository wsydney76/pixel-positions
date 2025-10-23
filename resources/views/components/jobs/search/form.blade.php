@use('Illuminate\Support\Collection')

@props([
    'facetMethod',
    /** @var Collection */
    'employers',
    /** @var Collection */
    'tags',
    /** @var \string[][] */
    'sortOptions',
    'minSearchLength'
])

<div id="filters"
     {{ $facetMethod == 'all' ? 'wire:ignore' : '' }}
     class="mb-4 grid items-end gap-4 sm:grid-cols-12"
>
    <x-jobs.search.inputs.select
        class="col-span-4 md:col-span-2"
        label="Employer"
        name="employer"
        :options="$employers"
    />

    <x-jobs.search.inputs.select
        class="col-span-4 md:col-span-2"
        label="Tag"
        name="tag"
        :options="$tags"
    />

    <x-jobs.search.inputs.input
        class="col-span-4"
        label="Search title/description"
        wire:ignore
        name="search"
        placeholder="Search jobs... (min. 3 char.)"
    />

    <x-jobs.search.inputs.select
        class="col-span-4 md:col-span-2"
        label="Sort"
        name="sort"
        :options="$sortOptions"
    />

    <x-jobs.search.inputs.button
        class="col-span-4 mt-4 md:col-span-2"
        disabled="$wire.search.length < {{ $minSearchLength }} &&
            !$wire.employer &&
            !$wire.tag &&
            $wire.sort == 'title'"
        label="Reset"
        action="resetFilters"
    />
</div>
