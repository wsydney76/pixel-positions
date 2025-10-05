<x-layouts.app>
    <x-page-heading>Tag: {{ strtolower($tag->name) }}</x-page-heading>

    <livewire:job-details />

    <section class="mt-8" x-data>
        <x-section-heading>Jobs tagged "{{ strtolower($tag->name) }}"</x-section-heading>
        @if ($jobs->count())
            <div class="mt-6 space-y-6">
                @foreach ($jobs as $job)
                    <x-job-card-wide :$job />
                @endforeach
            </div>
        @else
            <p class="mt-6 text-gray-500">No jobs currently use this tag.</p>
        @endif
    </section>

    <div class="mt-8">
        <x-pill href="{{ route('jobs.search', ['tag' => $tag->name]) }}">
            Search for tag "{{ $tag->name }}" in job listings
        </x-pill>
    </div>
</x-layouts.app>
