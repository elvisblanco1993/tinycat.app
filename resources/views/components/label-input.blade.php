@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'appearance-none border-none max-w-1/2 font-medium text-slate-700 dark:text-slate-400 p-0 focus:ring-0 bg-transparent']) !!}>
