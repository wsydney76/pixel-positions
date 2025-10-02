@props(['job'])

<x-panel class="flex items-start gap-x-6">

    <x-employer-logo :employer="$job->employer"/>

    <div class="flex-1 flex flex-col">
        <div>
            <x-employer :employer="$job->employer"/>
        </div>

        <h3 class="font-bold text-xl mt-3 hover:text-blue-600 transition-colors text-black dark:text-white">
            <a href="{{ route('jobs.show', $job) }}">
                {{ $job->title }}
            </a>
        </h3>

        <p class="text-sm text-gray-900 dark:text-gray-400 mt-auto">{{ $job->salary }}</p>


        <div x-data="{ open: false }" class="mt-2 text-sm">
            <button x-show="!open" @click="open = true">More Details</button>
            <button x-show="open" @click="open = false">Hide Details</button>

            <div class="mt-2 p-2 bg-black/10 rounded-sm border border-gray-400 space-y-2"
                 x-show="open"
                 @click.outside="open = false">

                <div>
                    {{ $job->location }}
                </div>
                <div>
                    {{ $job->schedule }}
                </div>
                <div>
                    {!! nl2br(e($job->description)) !!}
                </div>
                <div>
                    Posted {{ $job->created_at->diffForHumans() }}<br>
                </div>
            </div>
        </div>

    </div>

    <div class="flex flex-wrap gap-2">
        @foreach($job->tags as $tag)
            <div>
                <x-tag :$tag/>
            </div>
        @endforeach
    </div>
</x-panel>
