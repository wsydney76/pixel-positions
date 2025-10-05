<x-layouts.app>
    <x-page-heading>Tag: {{ strtolower($tag->name) }}</x-page-heading>

    <livewire:job-details />

    <x-pill href="{{ route('jobs.search', ['tag' => $tag->name]) }}">
        Search for tag "{{ $tag->name }}" in job listings
    </x-pill>

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
</x-layouts.app>
