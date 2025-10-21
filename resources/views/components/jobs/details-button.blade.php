@props([
    'job',
])

<x-pill type="button" @click="$dispatch('load-job-details', { id: {{ $job->id }} })">
    Details
</x-pill>
