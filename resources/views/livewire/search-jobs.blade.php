<div>
    <input class="rounded-xl bg-black/10 bg-border-black/10 bg:bg-white/10 border bg:border-white/10 px-5 py-4 w-full"
        wire:model.live="search" type="text" placeholder="Search jobs..."/>

    <ul class="mt-6 space-y-2">
        @foreach($jobs as $job)
            <li>
                <a href="{{ route('jobs.show', $job) }}" class="">
                    {{ $job->title }}
                </a>
            </li>
        @endforeach
    </ul>

</div>
