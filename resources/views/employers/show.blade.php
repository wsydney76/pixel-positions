<x-layouts.app>
    <livewire:job-details />

    <x-page-heading>{{ $employer->name }}</x-page-heading>

    <x-panel class="mt-6 flex items-center gap-4">
        <x-employer-logo width="80" :employer="$employer" />
        <div class="text-2xl font-semibold">{{ $employer->name }}</div>
        <div>
            <x-pill href="{{ route('jobs.search', ['employer' => $employer->name]) }}">
                Search for employer "{{ $employer->name }}" in job listings
            </x-pill>
        </div>
        @can('edit', $employer)
            <a
                href="{{ route('employers.edit', $employer) }}"
                class="text-sm text-blue-600 underline"
            >
                Edit
            </a>
        @endcan
    </x-panel>

    <section class="mt-10" x-data>
        <x-section-heading>Jobs at {{ $employer->name }}</x-section-heading>
        @if ($jobs->count())
            <div class="mt-6 space-y-6">
                @foreach ($jobs as $job)
                    <x-job-card-wide :$job />
                @endforeach
            </div>
        @else
            <div class="mt-6 text-gray-500">No jobs found for this employer.</div>
        @endif
    </section>
</x-layouts.app>
