<div>
    <select class="rounded-xl bg-black/10 border px-5 py-4 w-full mb-4"
            wire:model.live="employerId">
        <option value="">All employers</option>
        @foreach($employers as $employer)
            <option value="{{ $employer->id }}">{{ $employer->name }}</option>
        @endforeach
    </select>

    <select class="rounded-xl bg-black/10 border px-5 py-4 w-full mb-4" wire:model.live="tagId">
        <option value="">All tags</option>
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}">{{ ucwords($tag->name) }}</option>
        @endforeach
    </select>

    <input class="rounded-xl bg-black/10 bg-border-black/10 bg:bg-white/10 border bg:border-white/10 px-5 py-4 w-full"
           wire:model.live="search"
           type="text"
           placeholder="Search jobs... (min. 3 characters)"/>


    @if($jobs->count())
        <div class="mt-6 space-y-6">
            @foreach($jobs as $job)
                <x-job-card-wide :$job/>
            @endforeach
        </div>
    @else
        <div class="text-gray-500 mt-6">{{ $execSearch ? 'No jobs found' : '' }}</div>
    @endif

</div>
