<div>
    <button wire:click="$toggle('modal')" class="p-1.5 bg-blue-500 text-white rounded-full flex-none my-1">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
            <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
        </svg>
    </button>

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
