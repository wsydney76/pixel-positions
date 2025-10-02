@use(Illuminate\Support\Str)

@props([
    'job'
])

<div x-data="{ open: false }" class="relative mt-2">
    <button
        class="cursor-pointer px-5 py-1 text-xs bg-black/5 whitespace-nowrap hover:bg-black/10 text-black dark:bg-black dark:hover:bg-white/25 dark:text-white dark:border dark:border-white/20 rounded-xl font-bold transition-colors"
        @click="open = !open">
        Details
    </button>

    <div
        class="absolute md:left-20 md:-top-20 w-64 md:w-[500px] z-40 bg-white border border-gray-500 shadow-xl dark:bg-black rounded-md"
        x-show="open"
        x-cloak
        x-transition.origin.top.left.duration.300ms
        @click.outside="open = false">

        <div class="bg-black text-white dark:bg-gray-500 flex justify-between items-center px-4 py-2 rounded-t-md">
            <div>
                Details: {{ Str::limit($job->title, 40, '...') }}
            </div>
            <button @click="open = false" class="text-white hover:text-gray-300 text-2xl">&times;</button>
        </div>

        <div class="p-4 space-y-4">
            @if($job->featured)
                <div>
                    Featured Job
                </div>
            @endif

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
                    <a href="{{ route('jobs.edit', $job) }}" class="text-blue-600 dark:text-blue-200 hover:underline">Edit
                        Job</a>
                </div>
            @endcan
        </div>
    </div>
</div>
