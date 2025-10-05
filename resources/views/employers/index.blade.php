<x-layouts.app>
    <x-page-heading>All Employers</x-page-heading>

    <x-panel class="mt-8">
        @if ($employers->count())
            <ul class="grid gap-3 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($employers as $employer)
                    @if ($employer->jobs_count > 0)
                        <li>
                            <div
                                class="flex items-center justify-between rounded-md border border-gray-200 px-4 py-2 text-sm font-medium text-gray-800 transition hover:bg-gray-50 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-800"
                            >
                                <a
                                    href="{{ route('employers.show', $employer) }}"
                                    class="flex items-center space-x-2"
                                >
                                    <x-employer-logo :employer="$employer" :width="32" />
                                    <span>{{ $employer->name }}</span>
                                </a>
                                <div class="flex items-center space-x-2">
                                    @can('edit', $employer)
                                        <a
                                            href="{{ route('employers.edit', $employer) }}"
                                            class="text-xs text-blue-600 hover:underline"
                                        >
                                            Edit
                                        </a>
                                    @endcan

                                    <span
                                        class="rounded bg-gray-100 px-2 py-0.5 text-xs text-gray-600 dark:bg-gray-700 dark:text-gray-300"
                                    >
                                        {{ $employer->jobs_count }}
                                    </span>
                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No employers found.</p>
        @endif
    </x-panel>
</x-layouts.app>
