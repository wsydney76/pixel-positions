<div>
    @if($jobs->count())
        <div class="mt-6 space-y-6">
            @foreach($jobs as $job)
                <x-job-card-wide :$job />
            @endforeach
        </div>
        <div class="mt-6">
            {{ $jobs->links() }}
        </div>
    @else
        <div class="text-gray-500">No jobs found.</div>
    @endif

</div>
