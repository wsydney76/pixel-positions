<x-layouts.app>
    <x-page-heading>Employers</x-page-heading>
    <div class="container mx-auto max-w-3xl py-8">
        <h1 class="mb-6 text-3xl font-bold">Employers</h1>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            @forelse ($employers as $employer)
                <x-panel>
                    <div class="flex items-center space-x-4">
                        <x-employer-logo :employer="$employer" :width="64" />
                        <a
                            href="{{ route('jobs.search', ['employer' => $employer->name]) }}"
                            class="text-lg font-semibold"
                        >
                            {{ $employer->name }}
                        </a>
                        @can('edit', $employer)
                            <a
                                href="{{ route('employers.edit', $employer) }}"
                                class="ml-2 text-sm text-blue-500 underline"
                            >
                                Edit
                            </a>
                        @endcan
                    </div>
                </x-panel>
            @empty
                <div class="col-span-2 text-gray-500">No employers found.</div>
            @endforelse
        </div>
    </div>
</x-layouts.app>
>
