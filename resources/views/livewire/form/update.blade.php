<div>
    <x-secondary-button wire:click="$toggle('modal')">
        {{ __("Form settings") }}
    </x-secondary-button>

    <x-dialog-modal wire:model="modal" maxWidth="md">
        <x-slot name="title">
            {{__("Forms settings")}}
        </x-slot>
        <x-slot name="content"></x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">{{ __("Cancel") }}</x-secondary-button>
            <x-button wire:click="save" class="ms-4">{{ __("save") }}</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
