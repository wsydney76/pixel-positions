<div>

    {{--{{ $sql }}--}}

    <div wire:ignore class="grid grid-cols-12 gap-4 mb-4 items-end">
        <div class="col-span-2">
            <x-livewire.select
                label="Employer"
                name="employer"
                :options="$employers"/>
        </div>

        <div class="col-span-2">
            <x-livewire.select
                label="Tag"
                name="tag"
                :options="$tags"/>
        </div>

        <div class="col-span-4">
            <x-livewire.input
                label="Search title/description"
                name="search"
                placeholder="Search jobs... (min. 3 char.)"/>
        </div>

        <div class="col-span-2">
            <x-livewire.select
                label="Sort"
                name="sort"
                :options="[
                    ['label' => 'Title (A-Z)', 'value' => 'title'],
                    ['label' => 'Latest', 'value' => 'latest']
                ]"/>
        </div>

        <div class="col-span-2">
            <x-livewire.button
                label="Reset"
                action="resetFilters"
            />
        </div>
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
