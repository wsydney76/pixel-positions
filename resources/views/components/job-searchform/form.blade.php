@props([
    'facetMethod',
    /** @var \Illuminate\Support\Collection */
    'employers',
    /** @var \Illuminate\Support\Collection */
    'tags',
    /** @var \string[][] */
    'sortOptions',
    'minSearchLength'
])

<div
        id="filters"
        {{ $facetMethod == 'all' ? 'wire:ignore' : '' }}
        class="mb-4 grid items-end gap-4 sm:grid-cols-12"
>
    <x-job-searchform.select
            class="col-span-4 md:col-span-2"
            label="Employer"
            name="employer"
            :options="$employers"
    />

    <x-job-searchform.select
            class="col-span-4 md:col-span-2"
            label="Tag"
            name="tag"
            :options="$tags"
    />

    <x-job-searchform.input
            class="col-span-4"
            label="Search title/description"
            name="search"
            placeholder="Search jobs... (min. 3 char.)"
    />

    <x-job-searchform.select
            class="col-span-4 md:col-span-2"
            label="Sort"
            name="sort"
            :options="$sortOptions"
    />

    <x-job-searchform.button
            class="col-span-4 mt-4 md:col-span-2"
            disabled="$wire.search.length < {{ $minSearchLength }} && !$wire.employer && !$wire.tag && $wire.sort == 'title'"
            label="Reset"
            action="resetFilters"
    />
</div>
