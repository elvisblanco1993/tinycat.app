@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'appearance-none border-none max-w-1/2 font-medium text-zinc-700 dark:text-zinc-400 p-0 focus:ring-0 bg-transparent']) !!}>
