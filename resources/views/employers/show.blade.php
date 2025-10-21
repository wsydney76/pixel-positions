<x-layouts.app>
    <livewire:job-details />

    <x-page-heading>{{ $employer->name }}</x-page-heading>

    <section class="mt-10" x-data>
        <x-section-heading>Jobs at {{ $employer->name }}</x-section-heading>
        @if ($jobs->count())
            <div class="mt-6 mb-8 space-y-6">
                @foreach ($jobs as $job)
                    <x-jobs.card-wide :$job context="employer" />
                @endforeach
            </div>
        @else
            <div class="mt-6 text-gray-500">No jobs found for this employer.</div>
        @endif
    </section>

    <div>
        <x-pill href="{{ route('jobs.search', ['employer' => $employer->name]) }}">
            Search for employer "{{ $employer->name }}" in job listings
        </x-pill>

        @can('edit', $employer)
            <x-pill
                href="{{ route('employers.edit', $employer) }}"
                class="text-sm text-blue-600 underline"
            >
                Edit
            </x-pill>
        @endcan
    </div>
</x-layouts.app>
