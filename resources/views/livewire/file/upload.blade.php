<div>
    <x-dropdown-button wire:click="$toggle('modal')">
        {{ __("Upload files") }}
    </x-dropdown-link>

    <x-dialog-modal wire:model="modal">
        <x-slot name="title"></x-slot>
        <x-slot name="content"></x-slot>
        <x-slot name="footer"></x-slot>
    </x-dialog-modal>
</div>
