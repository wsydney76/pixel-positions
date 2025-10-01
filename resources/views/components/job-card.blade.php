@props(['job'])

<x-panel class="flex flex-col text-center">
    <div class="self-start text-sm text-black dark:text-white hover:text-blue-600 ">
        <x-employer :employer="$job->employer"></x-employer>
    </div>

    <a  href="{{ route('jobs.show', $job) }}" class="group py-8">
        <h3 class="group-hover:text-blue-600 text-xl font-bold transition-colors text-black dark:text-white">

                {{ $job->title }}

        </h3>
        <p class="text-sm mt-4 text-black dark:text-white">{{ $job->salary }}</p>
    </a>

    <div class="flex justify-between items-center mt-auto">
        <div class="flex flex-wrap gap-1">
            @foreach($job->tags as $tag)
                <div>
                    <x-tag :$tag size="small" />
                </div>
            @endforeach
        </div>

        <x-employer-logo :employer="$job->employer" :width="42" />
    </div>
</x-panel>
