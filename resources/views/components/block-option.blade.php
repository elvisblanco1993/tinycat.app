<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full px-4 py-2 flex items-center space-x-2 hover:bg-zinc-50 dark:hover:bg-zinc-600']) }}>
    {{ $slot }}
</button>
