<div>

    {{--{{ $sql }}--}}

    <div wire:ignore class="grid grid-cols-12 gap-4 mb-4 items-end">


        <x-livewire.select
            class="col-span-2"
            label="Employer"
            name="employer"
            :options="$employers"/>

        <x-livewire.select
            class="col-span-2"
            label="Tag"
            name="tag"
            :options="$tags"/>

        <x-livewire.input
            class="col-span-4"
            label="Search title/description"
            name="search"
            placeholder="Search jobs... (min. 3 char.)"/>

        <x-livewire.select
            class="col-span-2"
            label="Sort"
            name="sort"
            :options="[
                    ['label' => 'Title (A-Z)', 'value' => 'title'],
                    ['label' => 'Latest', 'value' => 'latest']
                ]"/>

        <x-livewire.button
            class="col-span-2"
            label="Reset"
            action="resetFilters"
        />

    </div>


    @if($jobs->count())
        <div class="mt-6 space-y-6">
            @foreach($jobs as $job)
                <x-job-card-wide :$job/>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $jobs->links() }}
        </div>
    @else
        <div class="text-gray-500 mt-6">No jobs found</div>
    @endif

</div>
