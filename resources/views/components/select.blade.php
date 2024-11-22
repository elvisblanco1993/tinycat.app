@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-zinc-300 dark:border-zinc-700 dark:bg-zinc-900 text-black dark:text-zinc-100 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-lg shadow-xs has-[option.placeholder:checked]:text-zinc-400 dark:has-[option.placeholder:checked]:text-zinc-400']) !!}>
    <option value="" disabled="" selected="" class="placeholder">Choose an option...</option>
    {{ $slot }}
</select>

