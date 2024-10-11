@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center space-x-1 rounded-lg p-2 transition-all text-indigo-900 dark:text-white bg-indigo-100 dark:bg-indigo-900/50'
            : 'flex items-center space-x-1 rounded-lg p-2 transition-all';
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
