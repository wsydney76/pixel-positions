@use(Illuminate\Support\Str)

@props([
    'job'
])

<div x-data="{ open: false }" class="relative mt-2">
    <x-pill type="button" @click="open = true">Details</x-pill>

    <!-- Modal Backdrop -->
    <div
        x-show="open"
        x-cloak
        x-transition.opacity.duration.300ms
        class="fixed inset-0 bg-black/50 dark:bg-white/50 z-40 flex items-center justify-center"
        @click.self="open = false"
        @keydown.escape.window="open = false"
        tabindex="-1"
        aria-modal="true"
        role="dialog"
    >
        <!-- Modal Content -->
        <div class="bg-white border border-gray-500 shadow-xl dark:bg-black rounded-md w-64 md:w-[500px] max-h-[80vh] overflow-y-auto relative">
            <div class="bg-black text-white dark:bg-gray-500 flex justify-between items-center px-4 py-1 rounded-t-md">
                <div class="text-sm">
                    Details: {{ Str::limit($job->title, 40, '...') }}
                </div>
                <button @click="open = false" class="text-white hover:text-gray-300 text-2xl" aria-label="Close">&times;</button>
            </div>

            <div class="p-4 space-y-4 text-sm">
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
                        <a href="{{ route('jobs.edit', $job) }}" class="text-blue-600 dark:text-blue-200 hover:underline">Edit Job</a>
                    </div>
                @endcan
            </div>
        </div>
    </div>
</div>
