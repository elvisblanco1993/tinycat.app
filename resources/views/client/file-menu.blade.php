<div x-data="{ open: false }"
    @click.away="open = false"
    @close.stop="open = false"
    @click.outside="open = false"
>
    <x-secondary-button class="mx-auto" x-ref="addbtn" @click="open = !open">
        {{ __("New") }}
    </x-secondary-button>

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
        class="w-48 text-sm text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 shadow-lg"
    >
        @livewire('file.new-folder', ['client' => $client, 'parent' => $item])
        <div class="border-t border-gray-200 dark:border-gray-600"></div>
        @livewire('file.upload', ['client' => $client, 'parent' => $item])
        @livewire('file.create', ['client' => $client, 'parent' => $item])
        <div class="border-t border-gray-200 dark:border-gray-600"></div>
        @livewire('file.request', ['client' => $client, 'parent' => $item])
    </div>
</div>
