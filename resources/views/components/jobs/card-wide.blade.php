@props([
    'job',
    'context' => null,
])

<x-panel class="flex items-start gap-x-6">
    <x-employer-logo :employer="$job->employer"/>

    <div class="flex flex-1 flex-col">
        @if ($context !== 'employer')
            <div>
                <x-employer :employer="$job->employer"/>
            </div>
        @endif

        <h3
            class="mt-3 text-xl font-bold text-black transition-colors hover:text-blue-600 dark:text-white"
        >
            <a href="{{ route('jobs.show', $job) }}">
                {{ $job->title }}
            </a>
        </h3>

        <p class="mt-auto text-sm text-gray-900 dark:text-gray-400">{{ $job->salary }}</p>

        @if($context !== 'demo')
            <x-jobs.details-button :job="$job"/>
        @endif
    </div>

    <div class="flex flex-wrap gap-2">
        @foreach ($job->tags as $tag)
            <div>
                <x-tag :$tag/>
            </div>
        @endforeach
    </div>
</x-panel>
