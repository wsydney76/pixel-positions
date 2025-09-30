<x-layout>
    <x-page-heading>{{ $employer->name }}</x-page-heading>
    <div class="container mx-auto max-w-3xl py-8">
        {{--<div class="flex items-center mb-8 space-x-4">
            --}}{{--<x-employer-logo :employer="$employer" :width="64"/>--}}{{--
            <h1 class="text-4xl font-bold">{{ $employer->name }}</h1>
        </div>--}}

        <x-section-heading>Job Listings</x-section-heading>
        @if($employer->jobs->count())
            <div class="mt-6 space-y-6">
                @foreach($employer->jobs as $job)
                    <x-job-card-wide :$job />
                @endforeach
            </div>
        @else
            <div class="text-gray-500">No jobs found for this employer.</div>
        @endif
    </div>
</x-layout>>

