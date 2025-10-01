<div>
    <div wire:ignore class="grid grid-cols-4 gap-4 mb-4 items-end">
        <div>
            <label for="employerId" class="block mb-2 font-semibold">Employer</label>
            <select id="employerId" class="rounded-xl bg-black/10 border px-5 py-4 w-full"
                    wire:model.live="employerId">
                <option value="">All employers</option>
                @foreach($employers as $employer)
                    <option value="{{ $employer->id }}">{{ $employer->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="tagId" class="block mb-2 font-semibold">Tag</label>
            <select id="tagId" class="rounded-xl bg-black/10 border px-5 py-4 w-full"
                    wire:model.live="tagId">
                <option value="">All tags</option>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ ucwords($tag->name) }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="search" class="block mb-2 font-semibold">Search</label>
            <input id="search"
                   class="rounded-xl bg-black/10 bg-border-black/10 bg:bg-white/10 border bg:border-white/10 px-5 py-4 w-full"
                   wire:model.live.debounce.500ms="search"
                   type="text"
                   placeholder="Search jobs... (min. 3 characters)"/>
        </div>
        <div>
            <button wire:click="resetFilters"
                    class="cursor-pointer bg-black hover:bg-black/70 text-white font-semibold px-6 py-4 rounded-xl w-full transition-colors">
                Clear
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
        <div class="text-gray-500 mt-6">{{ $execSearch ? 'No jobs found' : '' }}</div>
    @endif

</div>
