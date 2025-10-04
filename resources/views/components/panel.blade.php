@php
    $classes =
        'rounded-xl border border-black/10 bg-black/5 p-4 shadow-lg transition-colors hover:border-blue-600 dark:border-white/10 dark:bg-white/20';
@endphp

<div {{ $attributes(['class' => $classes]) }}>
    {{ $slot }}
</div>
