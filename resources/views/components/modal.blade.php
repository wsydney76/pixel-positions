@props(['caption' => 'Details'])

<div
    x-show="open"
    x-cloak
    x-transition.opacity.duration.300ms
    class="fixed inset-0 bg-gray-500/50 z-40 flex items-center justify-center"
    @click.self="open = false"
    @keydown.escape.window="open = false"
    tabindex="-1"
    aria-modal="true"
    role="dialog"
>
    <!-- Modal Content -->
    <div
        class="bg-white border border-gray-500 shadow-xl dark:bg-black rounded-md w-64 md:w-[500px] max-h-[80vh] overflow-y-auto relative">
        <div class="bg-black text-white dark:bg-gray-500 flex justify-between items-center px-4 py-1 rounded-t-md">
            <div class="text-sm">
                {{ $caption }}
            </div>
            <button @click="open = false" class="text-white hover:text-gray-300 text-2xl" aria-label="Close">&times;
            </button>
        </div>

        <div class="p-4 text-sm">
            {{ $slot }}
        </div>


    </div>
</div>
