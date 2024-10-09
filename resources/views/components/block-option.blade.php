<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full px-4 py-2 flex items-center space-x-2 hover:bg-slate-50 dark:hover:bg-slate-600']) }}>
    {{ $slot }}
</button>
