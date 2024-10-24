<div>
    <x-button wire:click="$toggle('modal')">
        {{ __("New request") }}
    </x-link>

    <x-dialog-modal wire:model="modal" maxWidth="2xl">
        <x-slot name="title">{{ __("File request") }}</x-slot>
        <x-slot name="content">
            <x-label for="message">{{__("Provide the client with clear instructions")}}</x-label>
            <div class="mt-1">
                <x-editor id="message" wire:model.blur="message"></x-editor>
            </div>

            <div class="mt-4">
                <x-label for="due_at">{{ __("Due date") }}</x-label>
                <x-input id="due_at" type="date" wire:model="due_at" class="mt-1" min="{{ today()->toDateString() }}"/>
            </div>
            <div class="mt-4">
                <p>{{ __("You can find all uploaded files in the /Uploads directory.") }}</p>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">{{ __("Cancel") }}</x-secondary-button>
            <x-button wire:click="save" class="ms-4">{{ __("Send request") }}</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
