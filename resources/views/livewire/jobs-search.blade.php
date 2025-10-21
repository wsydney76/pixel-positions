<div>

    <x-page-heading>Search Jobs</x-page-heading>

    {{-- {{ $sql }} --}}

    <div wire:loading.delay.class="bg-black/20 rounded-xl">
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

        @if ($jobs->count())
            <div id="results" class="mt-8 space-y-6">
                <div>
                    {{ $jobs->links() }}
                </div>

                @foreach ($jobs as $job)
                    <x-job-card-wide :$job />
                @endforeach

                <div>
                    {{ $jobs->links(data: ['scrollTo' => '#filters']) }}
                </div>
            </div>
        @else
            <div class="mt-6 text-gray-500">No jobs found</div>
        @endif
    </div>
</div>
