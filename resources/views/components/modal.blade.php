@props(['caption' => 'Details', 'trigger' => ''])

<div
    {{ $attributes }}
    x-data="{
        modalOpen: false,
        open() {
            this.modalOpen = true
        },
        close() {
            this.modalOpen = false
        },
        isOpen() {
            return this.modalOpen
        },
    }"
>
    {{-- Trigger slot, must call open() --}}
    {{ $trigger }}

    <div
        class="fixed inset-0 z-40 flex items-center justify-center bg-gray-500/50"
        x-show="isOpen"
        x-cloak
        x-transition.opacity.duration.300ms
        x-trap.inert.noscroll="isOpen"
        @click.self="close()"
        @keydown.escape.window="close()"
        tabindex="-1"
        aria-modal="true"
        role="dialog"
    >
        <!-- Modal Content -->
        <div
            class="relative max-h-[80vh] w-64 overflow-y-auto rounded-md border border-gray-500 bg-white shadow-xl md:w-[500px] dark:bg-black"
        >
            <div
                class="sticky top-0 z-10 flex items-center justify-between rounded-t-md bg-black px-4 py-1 text-white dark:bg-gray-500"
            >
                <div class="truncate pr-4 text-sm">
                    {{ $caption }}
                </div>
                <button
                    @click="close()"
                    class="text-2xl text-white hover:text-gray-300"
                    aria-label="Close"
                >
                    &times;
                </button>
            </div>

            <div class="p-4 text-sm">
                {{ $panel }}
            </div>
        </div>
    </div>
</div>
