<div x-data="{ open: false }"
    @click.away="open = false"
    @close.stop="open = false"
    @click.outside="open = false"
>
    <div class=""x-ref="addbtn" @click="open = !open">
        {{ $trigger }}
    </div>

    <div
        x-cloak
        x-show="open"
        @click.outside="open = false"
        @click.away="open = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        x-anchor.bottom-end.offset.10="$refs.addbtn"
        class="z-50 w-48 text-sm text-zinc-700 dark:text-zinc-200 bg-white dark:bg-zinc-700 rounded-lg overflow-hidden border border-zinc-200 dark:border-zinc-700 shadow-lg"
    >
        {{ $content }}
    </div>
</div>
