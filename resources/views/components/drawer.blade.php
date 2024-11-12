<div
    class="fixed top-0 right-0 z-30 h-screen overflow-y-auto transition-transform w-full md:w-1/2 lg:w-1/4 border border-zinc-200 dark:border-zinc-700 md:rounded-l-2xl shadow-xl"
    aria-labelledby="drawer-label"
    x-data="{ show: @entangle($attributes->wire('model')) }"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    @on.keyup.escape="show = false"
    @click.outside="show = false"
    x-transition:enter="translate-x-full"
    x-transition:leave="translate-x-full"
    x-cloak
>
    <div class="h-full divide-y dark:divide-zinc-700 bg-white dark:bg-zinc-800 overflow-y-auto">
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

        <div class="p-4">
            {{ $content }}
        </div>
    </div>
 </div>
