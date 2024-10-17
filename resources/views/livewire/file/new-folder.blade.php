<div>
    <x-dropdown-button wire:click="$toggle('modal')">
        {{ __("New folder") }}
    </x-dropdown-link>

    <x-dialog-modal wire:model="modal">
        <x-slot name="title">{{ __("New Folder") }}</x-slot>
        <x-slot name="content">
            <x-label for="name">{{ __("Folder name") }}</x-label>
            <x-input type="text" wire:model="name" wire:keydown.enter="save" id="name" class="mt-2 w-full" />
            <x-input-error for="name" />
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">{{ __("Cancel") }}</x-secondary-button>
            <x-button wire:click="save" class="ms-4">{{ __("Create") }}</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
