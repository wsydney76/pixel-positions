@props(['caption' => 'Details', 'trigger' =>''])

<div {{ $attributes }}
     x-data="{
        modalOpen: false,
        open() { this.modalOpen = true; },
        close() { this.modalOpen = false;},
        isOpen() { return this.modalOpen; }
    }"
>

    {{-- Trigger slot, must call open() --}}
    {{ $trigger }}

    <div
        x-show="isOpen"
        x-cloak
        x-transition.opacity.duration.300ms
        x-trap.inert.noscroll="isOpen"
        class="fixed inset-0 bg-gray-500/50 z-40 flex items-center justify-center"
        @click.self="close()"
        @keydown.escape.window="close()"
        tabindex="-1"
        aria-modal="true"
        role="dialog"
    >
        <!-- Modal Content -->
        <div
            class="bg-white border border-gray-500 shadow-xl dark:bg-black rounded-md w-64 md:w-[500px] max-h-[80vh] overflow-y-auto relative">
            <div
                class="sticky top-0 z-10 bg-black text-white dark:bg-gray-500 flex justify-between items-center px-4 py-1 rounded-t-md">
                <div class="text-sm truncate pr-4">
                    {{ $caption }}
                </div>
                <button @click="close()" class="text-white hover:text-gray-300 text-2xl" aria-label="Close">
                    &times;
                </button>
            </div>

            <div class="p-4 text-sm">
                {{ $panel }}
            </div>

        </div>
    </div>
</div>
