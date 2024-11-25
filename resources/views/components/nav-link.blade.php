@props(['active'])

@php
$classes = ($active ?? false)
            ? 'cursor-pointer inline-flex items-center space-x-1 text-sm font-semibold leading-5 text-blue-600 dark:text-zinc-100 focus:outline-hidden focus:border-blue-600 transition duration-150 ease-in-out'
            : 'cursor-pointer inline-flex items-center space-x-1 text-sm font-semibold leading-5 text-zinc-500 dark:text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-300 dark:hover:border-zinc-700 focus:outline-hidden focus:text-zinc-700 dark:focus:text-zinc-300 focus:border-zinc-300 dark:focus:border-zinc-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
