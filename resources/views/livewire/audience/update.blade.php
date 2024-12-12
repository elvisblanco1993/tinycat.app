<div>
    <x-dropdown-button wire:click="$toggle('modal')">
        {{__("Edit")}}
    </x-dropdown-button>

    @teleport('body')
    <x-dialog-modal wire:model="modal" maxWidth="lg">
        <x-slot name="title">{{ __("New audience") }}</x-slot>
        <x-slot name="content">
            <div>
                <x-label for="name">{{ __("Audience name") }}</x-label>
                <x-input id="name" type="text" wire:model="name" wire:keydown.enter="save" placeholder="Acme Inc." class="w-full mt-2" autocomplete="false" />
                <x-input-error for="name" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">{{ __("Cancel") }}</x-secondary-button>
            <x-button wire:click="save" class="ms-4">{{ __("Save") }}</x-button>
        </x-slot>
    </x-dialog-modal>
    @endteleport
</div>
