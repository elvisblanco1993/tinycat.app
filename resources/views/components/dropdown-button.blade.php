<button {{ $attributes->merge(['class' => 'flex items-center cursor-pointer w-full px-4 py-2 text-start text-sm leading-5 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 focus:outline-hidden focus:bg-zinc-100 dark:focus:bg-zinc-800 transition duration-150 ease-in-out']) }}>
    {{ $slot }}
</button>
