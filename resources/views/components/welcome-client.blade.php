<div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <h1 class="text-2xl font-medium text-gray-900 dark:text-white">
        Welcome to your new portal.
    </h1>

    <p class="mt-3 text-gray-500 dark:text-gray-400 leading-relaxed">
        Here you can securely share information and collaborate with {{ Auth::user()->ownedClient->team->name }}.
    </p>
</div>

<div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
    {{-- @todo:
        Add 4 links to get started and docs.
    --}}
</div>
