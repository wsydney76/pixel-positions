<div>
    <input class="rounded-xl bg-black/10 bg-border-black/10 bg:bg-white/10 border bg:border-white/10 px-5 py-4 w-full"
           wire:model.live="search" type="text" placeholder="Search jobs... (min. 3 characters)"/>


    @if($jobs->count())
        @foreach($jobs as $job)
            <div class="mt-6 space-y-6">
                @foreach($jobs as $job)
                    <x-job-card-wide :$job/>
                @endforeach
            </div>
        @endforeach
    @else
        <div class="text-gray-500 mt-6">{{ $execSearch ? 'No jobs found' : '' }}</div>
    @endif

</div>
