<x-layouts.app>
    <x-page-heading>All Tags</x-page-heading>

    <x-panel class="mt-8">
        @if ($tags->count())
            <ul class="grid gap-3 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($tags as $tag)
                    @if ($tag->jobs_count > 0)
                        <li>
                            <a
                                href="{{ route('tags.show', $tag) }}"
                                class="flex items-center justify-between rounded-md border border-gray-200 px-4 py-2 text-sm font-medium text-gray-800 transition hover:bg-gray-50 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-800"
                            >
                                <span>{{ strtolower($tag->name) }}</span>
                                <span
                                    class="rounded bg-gray-100 px-2 py-0.5 text-xs text-gray-600 dark:bg-gray-700 dark:text-gray-300"
                                >
                                    {{ $tag->jobs_count }}
                                </span>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No tags found.</p>
        @endif
    </x-panel>
</x-layouts.app>
