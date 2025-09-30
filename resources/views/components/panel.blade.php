@php
    $classes = 'p-4 bg-black/5 dark:bg-white/20 rounded-xl border border-black/10 dark:border-white/10 hover:border-blue-600 group transition-colors';
@endphp

<div {{ $attributes(['class' => $classes]) }}>
    {{ $slot }}
</div>
