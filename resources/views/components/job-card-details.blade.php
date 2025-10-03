@props([
    'job'
])

<!-- Modal Backdrop -->
<x-modal class="mt-2"
         :caption="'Job Details: ' . $job->title">

    <x-slot name="trigger">
        <x-pill type="button" @click="open()">Details</x-pill>
    </x-slot>

    <x-slot name="panel">
        <div class="space-y-4">

            <div>
                <x-employer :employer="$job->employer"></x-employer>
            </div>

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

            @if($job->url)
                <div>
                    <x-pill class="text-blue-500" href="{{ $job->url }}" size="small">
                        Apply Here
                    </x-pill>
                </div>
            @endif


            <div>
                Posted {{ $job->created_at->diffForHumans() }}<br>
            </div>


            <div class="flex flex-wrap gap-1">
                @foreach($job->tags as $tag)
                    <div>
                        <x-tag :$tag size="small" />
                    </div>
                @endforeach
            </div>



            @can('edit', $job)
                <div>
                    <x-pill class="text-blue-500" href="{{ route('jobs.edit', $job)  }}" size="small">
                        Edit Job
                    </x-pill>
                </div>
            @endcan
        </div>
    </x-slot>
</x-modal>
