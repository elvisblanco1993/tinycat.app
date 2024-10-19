@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center space-x-1 rounded-lg p-2 transition-all text-sm text-indigo-900 dark:text-white bg-indigo-100 dark:bg-indigo-800'
            : 'flex items-center space-x-1 rounded-lg p-2 transition-all text-sm text-slate-600 dark:text-slate-400 hover:text-indigo-900 dark:hover:text-white';
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
