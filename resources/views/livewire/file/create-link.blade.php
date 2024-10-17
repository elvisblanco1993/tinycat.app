<div>
    <x-dropdown-button wire:click="$toggle('modal')">
        {{ __("External resource") }}
    </x-dropdown-link>

    <x-dialog-modal wire:model="modal">
        <x-slot name="title">{{ __("Add External Resource") }}</x-slot>
        <x-slot name="content">
            <div>
                <x-label for="name">{{ __("Resource name") }}</x-label>
                <x-input
                    id="name"
                    type="text"
                    wire:model="name"
                    wire:keydown.enter="save"
                    class="mt-1 w-full"
                    placeholder="Sample Doc"
                />
            </div>
            <div class="mt-4">
                <x-label for="path">{{ __("Resource URL") }}</x-label>
                <x-input
                    id="path"
                    type="url"
                    wire:model="path"
                    wire:keydown.enter="save"
                    class="mt-1 w-full"
                    placeholder="https://example.com/sampledoc.pdf"
                />
                <x-input-error for="path" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">{{ __("Cancel") }}</x-secondary-button>
            <x-button wire:click="save" class="ms-4">{{ __("Save") }}</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
