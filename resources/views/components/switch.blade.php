{{-- This component requires the AlpineJS UI Library. --}}

@props([
    'label' => 'Switch', // You can set a default label here
])

<div x-data="{ label: '{{ $label }}', isChecked: @entangle($attributes->wire('model')) }" x-switch:group class="flex items-center">
    <!-- Button -->
    <button x-cloak x-switch x-model="isChecked" :class="isChecked ? 'bg-indigo-500 dark:bg-indigo-500' : 'bg-slate-300 dark:bg-slate-500'"
            class="relative inline-flex w-8 rounded-full py-1 transition outline-none">
        <span :class="isChecked ? 'translate-x-4' : 'translate-x-1'"
              class="bg-white dark:bg-slate-200 h-3 w-3 rounded-full transition shadow-md"></span>
    </button>
    <!-- Label -->
    <label x-switch:label class="ml-2 text-sm text-slate-600 dark:text-slate-200 font-normal" x-text="label"></label>
</div>
