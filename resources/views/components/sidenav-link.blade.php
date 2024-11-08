@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center space-x-1 rounded-lg p-2 transition-all text-sm text-blue-900 dark:text-white bg-blue-100 dark:bg-blue-800'
            : 'flex items-center space-x-1 rounded-lg p-2 transition-all text-sm text-zinc-600 dark:text-zinc-400 hover:text-blue-900 dark:hover:text-white';
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
