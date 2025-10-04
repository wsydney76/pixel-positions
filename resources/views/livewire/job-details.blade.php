<div>
    @if ($job)
        Loaded job ID: {{ $job->title }}
        <x-modal :caption="$job->title">
            <x-slot name="trigger">
                <x-pill type="button" @click="open()">Open</x-pill>
            </x-slot>

            <x-slot name="panel">
                <h2 class="text-xl font-semibold">{{ $job->title }}</h2>
                <p class="text-gray-600">{{ $job->salary }}</p>
            </x-slot>
        </x-modal>
    @endif
</div>
