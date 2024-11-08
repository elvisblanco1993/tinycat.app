{{-- This component requires the AlpineJS UI Library. --}}

@props([
    'label' => 'Switch', // You can set a default label here
])

<div x-data="{ label: '{{ $label }}', isChecked: @entangle($attributes->wire('model')) }" x-switch:group class="flex items-center">
    <!-- Button -->
    <button x-cloak x-switch x-model="isChecked" :class="isChecked ? 'bg-blue-500 dark:bg-blue-500' : 'bg-zinc-300 dark:bg-zinc-500'"
            class="relative inline-flex w-8 rounded-full py-1 transition outline-none">
        <span :class="isChecked ? 'translate-x-4' : 'translate-x-1'"
              class="bg-white dark:bg-zinc-200 h-3 w-3 rounded-full transition shadow-md"></span>
    </button>
    <!-- Label -->
    <label x-switch:label class="ml-2 text-sm text-zinc-600 dark:text-zinc-200 font-normal" x-text="label"></label>
</div>
