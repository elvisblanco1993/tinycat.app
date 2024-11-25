<div>
    <x-secondary-button wire:click="$toggle('modal')">
        {{ __("Settings") }}
    </x-secondary-button>

    <x-drawer wire:model="modal">
        <x-slot name="title">{{ __("Project settings") }}</x-slot>
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
                <div class="md:grid grid-cols-2 gap-4">
                    <div class="col-span-2 md:col-span-1">
                        <x-label for="start_date">{{ __("Start date") }}</x-label>
                        <x-input id="start_date" type="date" wire:model="start_date" class="mt-1 w-full"/>
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <x-label for="end_date">{{ __("End date") }}</x-label>
                        <x-input id="end_date" type="date" wire:model="end_date" class="mt-1 w-full"/>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <x-label for="projectPeople">{{ __("People in this project") }}</x-label>
                <x-selector id="projectPeople" :options="$teamUsers" wire:model="assign_to"></x-selector>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">{{ __("Cancel") }}</x-secondary-button>
            <x-button wire:click="save" class="ms-4">{{ __("Save changes") }}</x-button>
        </x-slot>
    </x-drawer>
</div>
