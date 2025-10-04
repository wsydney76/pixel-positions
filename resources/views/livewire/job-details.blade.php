<div class="mt-6">
    @if ($job)
        <h2 class="text-xl font-semibold">{{ $job->title }}</h2>
        <p class="text-gray-600">{{ $job->salary }}</p>
    @else
        <em>Select an item to see details.</em>
    @endif
</div>
