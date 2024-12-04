@props(['width' => 'md:w-1/2 lg:w-1/3'])
<div x-data="{ show: @entangle($attributes->wire('model')) }">
    <div x-show="show"
        x-cloak
        @on.keyup.escape="show = false"
        @click="show = false"
        class="absolute inset-0 bg-zinc-500 dark:bg-zinc-900 opacity-75 transition-all"
    ></div>

    <div
        class="fixed top-0 right-0 z-30 h-screen overflow-y-auto transition-transform w-full {{ $width }} border border-zinc-200 dark:border-zinc-700 md:rounded-l-2xl shadow-xl"
        aria-labelledby="drawer-label"
        x-on:close.stop="show = false"
        x-on:keydown.escape.window="show = false"
        x-show="show"
        @on.keyup.escape="show = false"
        @click.outside="show = false"
        x-transition:enter="translate-x-full"
        x-transition:leave="translate-x-full"
        x-cloak
    >
        <div class="h-full divide-y dark:divide-zinc-700 bg-white dark:bg-zinc-800 flex flex-col">
            <div class="h-16 px-4 flex items-center justify-between">
                <div class="inline-flex items-center dark:text-white">
                    {{ $title }}
                </div>
                <button @click="show = false" type="button" class="text-zinc-500 dark:text-zinc-300 bg-zinc-50 dark:bg-zinc-700 hover:bg-zinc-200 hover:text-zinc-900 rounded-lg text-sm w-8 h-8 flex items-center justify-center dark:hover:bg-zinc-600 dark:hover:text-white" >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                    </svg>
                <span class="sr-only">{{ __("Close menu") }}</span>
                </button>
            </div>

            <div class="px-4 py-6 grow overflow-y-auto">
                {{ $content }}
            </div>

            <div class="px-4 py-2 bg-zinc-100 dark:bg-zinc-700 flex items-center justify-end">
                {{ $footer ?? '' }}
            </div>
        </div>
    </div>
</div>
