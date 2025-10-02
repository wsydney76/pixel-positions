@props([
    'job'
])

<div x-data="{ open: false }" class="mt-2 text-sm">
    <button
        class="cursor-pointer px-5 py-1 text-xs bg-black/5 whitespace-nowrap hover:bg-black/10 text-black dark:bg-black dark:hover:bg-white/25 dark:text-white dark:border dark:border-white/20 rounded-xl font-bold transition-colors"
        @click="open = !open"
    >Details</button>

    <div class="mt-2 p-2 bg-black/5 dark:bg-black/40 rounded-md space-y-2"
         x-show="open"
         @click.outside="open = false">

        @if($job->location)
            <div>
                {{ $job->location }}
            </div>
        @endif

        @if($job->schedule)
            <div>
                {{ $job->schedule }}
            </div>
        @endif

        @if($job->description)
            <div>
                {!! nl2br(e($job->description)) !!}
            </div>
        @endif

        <div>
            Posted {{ $job->created_at->diffForHumans() }}<br>
        </div>

        @can('edit', $job)
            <div>
                <a href="{{ route('jobs.edit', $job) }}" class="text-blue-600 hover:underline">Edit Job</a>
            </div>
        @endcan
    </div>
</div>
