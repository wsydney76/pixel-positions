@props([
    'job',
])

<x-panel class="flex flex-col text-center" x-data>
    <div class="self-start text-sm text-black hover:text-blue-600 dark:text-white">
        <x-employer :employer="$job->employer"></x-employer>
    </div>

    <a href="{{ route('jobs.show', $job) }}" class="group py-8">
        <h3
            class="text-xl font-bold text-black transition-colors group-hover:text-blue-600 dark:text-white"
        >
            {{ $job->title }}
        </h3>
        <p class="mt-4 text-sm text-black dark:text-white">{{ $job->salary }}</p>
    </a>

    <div class="mb-2">
        <x-jobs.details-button :job="$job" />
    </div>

    <div class="mt-auto flex items-center justify-between">
        <div class="flex flex-wrap gap-1">
            @foreach ($job->tags as $tag)
                <div>
                    <x-tag :$tag size="small" />
                </div>
            @endforeach
        </div>

        <x-employer-logo :employer="$job->employer" :width="42" />
    </div>
</x-panel>
