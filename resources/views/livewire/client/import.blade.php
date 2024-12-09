<div>
    <x-secondary-button wire:click="$toggle('modal')">
        {{ __("Import") }}
    </x-secondary-button>

    <x-dialog-modal wire:model="modal">
        <x-slot name="title">{{ __("Import clients") }}</x-slot>
        <x-slot name="content">
            <x-file-input wire:model="file"
                allowImagePreview
                imagePreviewMaxHeight="200"
                allowFileTypeValidation
                acceptedFileTypes="['text/csv']"
                allowFileSizeValidation
                maxFileSize="25mb"
            />
            <small class="text-xs text-zinc-700 dark:text-zinc-300">{{ __("Only CSV files allowed.") }}</small>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">{{ __("Cancel") }}</x-secondary-button>
            <x-button wire:click="import" wire:loading.attr.="disabled" wire:target="import" class="ms-4" :disabled="!$file">{{ __("Import") }}</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
