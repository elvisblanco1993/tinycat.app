<div>
    <x-secondary-button wire:click="$toggle('modal')">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
            <path d="M2 4a2 2 0 0 1 2-2h8a2 2 0 1 1 0 4H4a2 2 0 0 1-2-2ZM2 9.25a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 9.25ZM2.75 12.5a.75.75 0 0 0 0 1.5h10.5a.75.75 0 0 0 0-1.5H2.75Z" />
        </svg>
        <div class="ms-1">{{ __("Add deck") }}</div>
    </x-secondary-button>

    <x-dialog-modal wire:model="modal">
        <x-slot name="title">{{ __("Create deck") }}</x-slot>
        <x-slot name="content">
            <x-label for="name">{{ __("Name this deck") }}</x-label>
            <x-input id="name" wire:model="name" class="mt-1 w-full" wire:keyup.enter="save" />
            <x-input-error for="name" />
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">{{ __("Cancel") }}</x-secondary-button>
            <x-button wire:click="save" class="ms-4">{{ __("Create") }}</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
