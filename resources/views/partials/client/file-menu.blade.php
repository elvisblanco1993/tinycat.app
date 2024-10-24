<x-action-menu>
    <x-slot name="trigger">
        <x-secondary-button>
            {{ __("New") }}
        </x-secondary-button>
    </x-slot>
    <x-slot name="content">
        @livewire('file.new-folder', ['client' => $client, 'parent' => $item])
        <div class="border-t border-slate-200 dark:border-slate-600"></div>
        @livewire('file.upload', ['client' => $client, 'parent' => $item])
        @livewire('file.create-link', ['client' => $client, 'parent' => $item])
    </x-slot>
</x-action-menu>
