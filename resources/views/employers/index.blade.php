<x-layout>
    <x-page-heading>Employers</x-page-heading>
    <div class="container mx-auto max-w-3xl py-8">
        <h1 class="text-3xl font-bold mb-6">Employers</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($employers as $employer)
                <x-panel>
                    <div class="flex space-x-4 items-center">
                        <x-employer-logo :employer="$employer" :width="64"/>
                        <a href="{{ route('jobs.search', ['employer' => $employer->name]) }}" class="text-lg font-semibold">{{ $employer->name }}</a>
                        @if($employer->user_id === auth()->id())
                            <a href="{{ route('employers.edit', $employer) }}" class="ml-2 text-blue-500 underline text-sm">Edit</a>
                        @endif
                    </div>
                </x-panel>
            @empty
                <div class="col-span-2 text-gray-500">No employers found.</div>
            @endforelse
        </div>
    </div>
</x-layout>>

