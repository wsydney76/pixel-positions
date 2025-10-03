@use(Illuminate\Support\Str)

@props([
    'job'
])

<div x-data="{ open: false }" class="relative mt-2">

    <x-pill type="button" @click="open = true">Details</x-pill>

    <!-- Modal Backdrop -->
    <x-modal :caption="'Job Details: ' . Str::limit($job->title, 50)">
        <div class="space-y-4">
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
    </x-modal>
</div>
