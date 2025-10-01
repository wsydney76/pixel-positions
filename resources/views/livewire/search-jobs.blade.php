<div>

    {{--{{ $sql }}--}}

    <div wire:ignore class="grid grid-cols-12 gap-4 mb-4 items-end">
        <div class="col-span-2">
            <label for="employerName" class="block mb-2 font-semibold">Employer</label>
            <select id="employerName" class="rounded-lg bg-black/10 border px-3 py-2 text-sm w-full"
                    wire:model.live="employerName">
                <option value="">All employers</option>
                @foreach($employers as $employer)
                    <option value="{{ $employer->name }}">{{ $employer->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-2">
            <label for="tagName" class="block mb-2 font-semibold">Tag</label>
            <select id="tagName" class="rounded-lg bg-black/10 border px-3 py-2 text-sm w-full"
                    wire:model.live="tagName">
                <option value="">All tags</option>
                @foreach($tags as $tag)
                    <option value="{{ $tag->name }}">{{ ucwords($tag->name) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-4">
            <label for="search" class="block mb-2 font-semibold">Search title/description</label>
            <input id="search"
                   class="rounded-lg bg-black/10 bg-border-black/10 bg:bg-white/10 border bg:border-white/10 px-3 py-2 text-sm w-full"
                   wire:model.live.debounce.500ms="search"
                   type="text"
                   placeholder="Search jobs... (min. 3 characters)"/>
        </div>
        <div class="col-span-2">
            <label for="sort" class="block mb-2 font-semibold">Sort</label>
            <select id="sort"
                    class="rounded-lg bg-black/10 border px-3 py-2 text-sm w-full"
                    wire:model.live="sort">
                <option value="title">Title (A-Z)</option>
                <option value="latest">Latest</option>
            </select>
        </div>
        <div class="col-span-2">
            <button wire:click="resetFilters"
                    class="cursor-pointer bg-black hover:bg-black/70 text-white font-semibold px-3 py-2 text-sm rounded-lg w-full transition-colors">
                Reset
            </button>
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
