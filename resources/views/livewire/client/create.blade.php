<div>
    <x-button wire:click="$toggle('modal')">
        New client
    </x-button>

    <x-dialog-modal wire:model="modal" maxWidth="sm">
        <x-slot name="title">{{ __("Create Client") }}</x-slot>
        <x-slot name="content">
            <div>
                <x-label for="name">{{ __("Organization Name") }}</x-label>
                <x-input
                    id="name"
                    type="text"
                    wire:model="name"
                    wire:keydown.enter="save"
                    placeholder="Acme Inc."
                    class="w-full mt-1"
                    autocomplete="false"
                />
                <x-input-error for="name" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">{{ __("Cancel") }}</x-secondary-button>
            <x-button wire:click="save" class="ms-4">{{ __("Create") }}</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
