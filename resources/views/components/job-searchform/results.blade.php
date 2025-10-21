@props([
    /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\Job[] */
    'jobs'
])

@if ($jobs->count())
    <div id="results" class="mt-8 space-y-6">
        <div>
            {{ $jobs->links() }}
        </div>

        @foreach ($jobs as $job)
            <x-job-card-wide :$job/>
        @endforeach

        <div>
            {{ $jobs->links(data: ['scrollTo' => '#filters']) }}
        </div>
    </div>
@else
    <div class="mt-6 text-gray-500">No jobs found</div>
@endif
