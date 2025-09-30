<x-layout>
    <x-page-heading>Job Details</x-page-heading>

    <x-panel>
        <div class="mb-2 flex items-center gap-4">
            <div>
                <x-employer-logo width="60" :employer="$job->employer"/>
            </div>
            <div class="text-gray-600 text-lg">{{ $job->employer->name ?? 'N/A' }}</div>
        </div>

        <h1 class="text-3xl font-bold mt-6 mb-4">{{ $job->title }}</h1>
        <div class="mb-2 text-gray-600">Location: {{ $job->location }}</div>
        <div class="mb-2 text-gray-600">Salary: {{ $job->salary }}</div>
        <div class="mb-2 text-gray-600">Schedule: {{ $job->schedule }}</div>
        <div class="mb-2 text-gray-600">Employer: {{ $job->employer->name ?? 'N/A' }}</div>
        <div class="mb-4">
            <a href="{{ $job->url }}" class="text-blue-600 underline" target="_blank">Job Posting</a>
        </div>
        @if($job->description)
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Description</h2>
                <div class="prose">{!! nl2br(e($job->description)) !!}</div>
            </div>
        @endif
        @if($job->tags->count())
            <div class="mb-4">
                @foreach($job->tags as $tag)
                    <x-tag :$tag/>
                @endforeach
            </div>
        @endif
    </x-panel>

    <div class="space-x-4">
        <a href="{{ route('employers.show', $job->employer) }}" class="text-blue-600 underline mt-4 inline-block">All jobs by {{ $job->employer->name }}</a>
        @can('edit', $job)
            <a href="{{ route('jobs.edit', $job) }}" class="text-blue-600 underline mt-4 inline-block">Edit</a>
            <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this job?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="cursor-pointer text-red-600 underline mt-4 inline-block">Delete</button>
            </form>
        @endcan
        <a href="{{ route('jobs.index') }}" class="text-blue-600 underline mt-4 inline-block">Back to Job Listings</a>
    </div>
</x-layout>
