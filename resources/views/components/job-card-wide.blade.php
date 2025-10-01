@props(['job'])

<x-panel class="flex gap-x-6">
    <a href="{{ route('jobs.show', $job) }}">
        <x-employer-logo :employer="$job->employer" />
    </a>

    <div class="flex-1 flex flex-col">
        <div>
            <x-employer :employer="$job->employer"></x-employer>
        </div>

        <h3 class="font-bold text-xl mt-3 hover:text-blue-600 transition-colors text-black dark:text-white">
            <a href="{{ route('jobs.show', $job) }}">
                {{ $job->title }}
            </a>
        </h3>

        <p class="text-sm text-gray-900 dark:text-gray-400 mt-auto">{{ $job->salary }}</p>
    </div>

    <div class="flex flex-wrap gap-2">
        @foreach($job->tags as $tag)
            <div>
                <x-tag :$tag />
            </div>
        @endforeach
    </div>
</x-panel>
