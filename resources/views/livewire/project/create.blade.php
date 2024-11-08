<div>
    <x-button wire:click="$toggle('modal')">
        {{__("New Project")}}
    </x-button>

    <x-dialog-modal wire:model="modal" maxWidth="lg">
        <x-slot name="title">{{ __("New project") }}</x-slot>
        <x-slot name="content">
            <div>
                <x-label for="name">{{ __("Name this project") }}</x-label>
                <x-input id="name" type="text" wire:model="name" placeholder="e.g: Tax Season Readiness" class="w-full mt-1" autocomplete="false" />
                <x-input-error for="name" />
            </div>
            <div class="mt-6">
                <x-label for="description">{{ __("Add a description (optional)") }}</x-label>
                <x-textarea id="description" type="text" wire:model="description" rows="4" placeholder="e.g: Plans and scheduling for the upcoming tax season." class="w-full mt-1" autocomplete="false" />
                <x-input-error for="description" />
            </div>

            <div class="mt-6">
                <div class="block font-semibold text-zinc-800 dark:text-zinc-300">
                    {{ __("Set a schedule (optional)") }}
                </div>
                <div class="mt-3 md:flex items-center gap-8">
                    <div class="w-full md:w-1/2">
                        <x-label for="start_date">{{ __("Start date") }}</x-label>
                        <x-input id="start_date" type="date" wire:model="start_date" class="mt-1 w-full"/>
                    </div>
                    <div class="w-full md:w-1/2">
                        <x-label for="end_date">{{ __("End date") }}</x-label>
                        <x-input id="end_date" type="date" wire:model="end_date" class="mt-1 w-full"/>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">{{ __("Cancel") }}</x-secondary-button>
            <x-button wire:click="save" class="ms-4">{{ __("Create") }}</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
