<button {{ $attributes->merge(['type' => 'button', 'class' => 'cursor-pointer inline-flex items-center justify-center px-3 py-2 bg-red-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-hidden focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
