<div>
    <x-dropdown-button wire:click="$toggle('modal')">
        {{ __("File request") }}
    </x-dropdown-link>

    <x-dialog-modal wire:model="modal" maxWidth="2xl">
        <x-slot name="title">{{ __("File request") }}</x-slot>
        <x-slot name="content">
            <x-trix-editor :placeholder="__('Please specify what information or files you need from the customer.')"/>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">{{ __("Cancel") }}</x-secondary-button>
            <x-button wire:click="save" class="ms-4">{{ __("Send request") }}</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
