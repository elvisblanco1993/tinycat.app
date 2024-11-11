<div class="flex items-center">
    <button wire:click="$toggle('modal')" class="inline-flex items-center text-zinc-500 dark:text-zinc-600">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
            <path d="M13.488 2.513a1.75 1.75 0 0 0-2.475 0L6.75 6.774a2.75 2.75 0 0 0-.596.892l-.848 2.047a.75.75 0 0 0 .98.98l2.047-.848a2.75 2.75 0 0 0 .892-.596l4.261-4.262a1.75 1.75 0 0 0 0-2.474Z" />
            <path d="M4.75 3.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h6.5c.69 0 1.25-.56 1.25-1.25V9A.75.75 0 0 1 14 9v2.25A2.75 2.75 0 0 1 11.25 14h-6.5A2.75 2.75 0 0 1 2 11.25v-6.5A2.75 2.75 0 0 1 4.75 2H7a.75.75 0 0 1 0 1.5H4.75Z" />
        </svg>
    </button>

    <x-dialog-modal wire:model="modal">
        <x-slot name="title">{{ __("Update deck") }}</x-slot>
        <x-slot name="content">
            <x-label for="name">{{ __("Name") }}</x-label>
            <x-input id="name" wire:model="name" class="mt-1 w-full" wire:keyup.enter="save" />
            <x-input-error for="name" />

            <div class="mt-4">
                <x-label for="color">{{ __("Background color") }}</x-label>
                <x-input type="color" id="color" wire:model="color" class="mt-1" wire:keyup.enter="save" />
                <x-input-error for="color" />
            </div>

            <div class="mt-4">
                <x-switch wire:model="is_expanded" label="Expand"/>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">{{ __("Cancel") }}</x-secondary-button>
            <x-button wire:click="save" class="ms-4">{{ __("Save changes") }}</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
