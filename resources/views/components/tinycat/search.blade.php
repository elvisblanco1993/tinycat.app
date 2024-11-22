@props(['disabled' => false])

<div class="relative flex items-center">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 absolute ms-2 fill-zinc-400">
        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
    </svg>
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'ps-8 border-zinc-300 dark:border-zinc-700 dark:bg-zinc-900 text-black dark:text-zinc-100 focus:outline-hidden focus:ring-0 focus:border-blue-500 dark:focus:border-blue-600 rounded-lg shadow-xs disabled:opacity-25 transition ease-in-out']) !!}>
</div>
