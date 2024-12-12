@php
    $classes = 'inline-flex items-center text-xs text-blue-900 dark:text-blue-100 font-medium px-1.5 py-0.5 rounded-full bg-blue-100 dark:bg-blue-900';
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
