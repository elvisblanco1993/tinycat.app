@props(['active'])

@php
$classes = ($active ?? false)
            ? 'cursor-pointer inline-flex items-center px-1 pt-1 border-b-2 border-blue-400 dark:border-blue-600 text-sm font-medium leading-5 text-zinc-900 dark:text-zinc-100 focus:outline-hidden focus:border-blue-700 transition duration-150 ease-in-out'
            : 'cursor-pointer inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-zinc-500 dark:text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-300 hover:border-zinc-300 dark:hover:border-zinc-700 focus:outline-hidden focus:text-zinc-700 dark:focus:text-zinc-300 focus:border-zinc-300 dark:focus:border-zinc-700 transition duration-150 ease-in-out';
@endphp

<button type="button" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
