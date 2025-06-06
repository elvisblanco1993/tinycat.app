<button {{ $attributes->merge(['type' => 'button', 'class' => 'cursor-pointer inline-flex items-center px-3 py-2 bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-500 rounded-lg font-semibold text-xs text-zinc-700 dark:text-zinc-300 uppercase tracking-widest shadow-xs hover:bg-zinc-50 dark:hover:bg-zinc-700 focus:outline-hidden focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-800 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
