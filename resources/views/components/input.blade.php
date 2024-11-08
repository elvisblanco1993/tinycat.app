@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-zinc-300 dark:border-zinc-700 dark:bg-zinc-900 text-black dark:text-zinc-100 focus:outline-none focus:ring-0 focus:border-blue-500 dark:focus:border-blue-600 rounded-lg shadow-sm disabled:opacity-25 transition ease-in-out']) !!}>
