<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full px-4 py-2 flex items-center space-x-2 hover:bg-gray-50 dark:hover:bg-gray-600']) }}>
    {{ $slot }}
</button>
