<div class="p-6 lg:p-8 bg-white dark:bg-zinc-800 dark:bg-linear-to-bl dark:from-zinc-700/50 dark:via-transparent border-b border-zinc-200 dark:border-zinc-700">
    <h1 class="text-2xl font-medium text-zinc-900 dark:text-white">
        Welcome to your new portal.
    </h1>

    <p class="mt-6 text-zinc-700 dark:text-zinc-400 leading-relaxed">
        Here you can securely share information and collaborate with {{ Auth::user()->ownedClient->team->name }}.
    </p>
</div>

<div class="bg-white dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 bg-opacity-25 p-6 lg:p-8">
    <a wire:navigate href="{{ route('file.index', ['client' => Auth::user()->ownedClient]) }}" class="flex items-center hover:text-blue-500 transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
            <path d="M3.75 3A1.75 1.75 0 0 0 2 4.75v3.26a3.235 3.235 0 0 1 1.75-.51h12.5c.644 0 1.245.188 1.75.51V6.75A1.75 1.75 0 0 0 16.25 5h-4.836a.25.25 0 0 1-.177-.073L9.823 3.513A1.75 1.75 0 0 0 8.586 3H3.75ZM3.75 9A1.75 1.75 0 0 0 2 10.75v4.5c0 .966.784 1.75 1.75 1.75h12.5A1.75 1.75 0 0 0 18 15.25v-4.5A1.75 1.75 0 0 0 16.25 9H3.75Z" />
        </svg>
        <span class="ms-2">{{ __("View my files") }}</span>
    </a>
    <a wire:navigate href="{{ route('upload-request.index', ['client' => Auth::user()->ownedClient]) }}" class="mt-2 flex items-center hover:text-blue-500 transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
            <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 0 0-4.242 0l-7 7a3 3 0 0 0 4.241 4.243h.001l.497-.5a.75.75 0 0 1 1.064 1.057l-.498.501-.002.002a4.5 4.5 0 0 1-6.364-6.364l7-7a4.5 4.5 0 0 1 6.368 6.36l-3.455 3.553A2.625 2.625 0 1 1 9.52 9.52l3.45-3.451a.75.75 0 1 1 1.061 1.06l-3.45 3.451a1.125 1.125 0 0 0 1.587 1.595l3.454-3.553a3 3 0 0 0 0-4.242Z" clip-rule="evenodd" />
        </svg>
        <span class="ms-2">{{ __("Upload requests") }}</span>
    </a>
    <a wire:navigate href="{{ route('my.task.index') }}" class="mt-2 flex items-center hover:text-blue-500 transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
            <path d="M5.127 3.502 5.25 3.5h9.5c.041 0 .082 0 .123.002A2.251 2.251 0 0 0 12.75 2h-5.5a2.25 2.25 0 0 0-2.123 1.502ZM1 10.25A2.25 2.25 0 0 1 3.25 8h13.5A2.25 2.25 0 0 1 19 10.25v5.5A2.25 2.25 0 0 1 16.75 18H3.25A2.25 2.25 0 0 1 1 15.75v-5.5ZM3.25 6.5c-.04 0-.082 0-.123.002A2.25 2.25 0 0 1 5.25 5h9.5c.98 0 1.814.627 2.123 1.502a3.819 3.819 0 0 0-.123-.002H3.25Z" />
        </svg>
        <span class="ms-2">{{ __("My tasks") }}</span>
    </a>
</div>
