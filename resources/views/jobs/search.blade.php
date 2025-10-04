<x-layouts.app>
    <x-page-heading>Search Jobs</x-page-heading>

    <livewire:job-details />

    <livewire:jobs-search :facetMethod="$facetMethod" />
</x-layouts.app>
