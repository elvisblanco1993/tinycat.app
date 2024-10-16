<div>
    <x-dropdown-button wire:click="$toggle('modal')">
        {{ __("Upload files") }}
    </x-dropdown-link>

    <x-dialog-modal wire:model="modal">
        <x-slot name="title">{{ __("Upload Files") }}</x-slot>
        <x-slot name="content">
            <x-file-input wire:model="files"
                multiple
                allowImagePreview
                imagePreviewMaxHeight="200"
                allowFileTypeValidation
                acceptedFileTypes="{{ $supported }}"
                allowFileSizeValidation
                maxFileSize="25mb"
            />
            <x-input-error for="files" />
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">{{ __("Cancel") }}</x-secondary-button>
            <x-button wire:click="save" class="ms-4">{{ __("Upload") }}</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
