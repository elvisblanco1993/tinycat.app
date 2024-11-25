<div>
    <x-button wire:click="$toggle('modal')">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
            <path d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
        </svg>
        <span class="ms-1">{{ __("Add Task") }}</span>
    </x-button>

    <x-dialog-modal wire:model="modal">
        <x-slot name="title">{{ __("New task for ") . $project->name }}</x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-4 gap-4 items-center">
                <x-label for="title"><strong>Title</strong></x-label>
                <div class="col-span-3">
                    <x-sm-input id="title" type="text" wire:model="title" class="w-full" placeholder="{{ __('Type a title...') }}" />
                    <x-input-error for="title" class="mt-1" />
                </div>
            </div>

            <div class="mt-6 grid grid-cols-4 gap-4 items-center">
                <x-label for="assign_to"><strong>Assign to</strong></x-label>
                <div class="col-span-3">
                    <x-selector  id="assign_to" :options="$teamUsers" wire:model="assign_to"></x-selector>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-4 gap-4 items-start">
                <x-label><strong>Due on</strong></x-label>
                <div x-data="{showDatePicker: false}" class="col-span-3">
                    <x-label class="flex items-center space-x-2">
                        <x-radio name="showDatePicker" @click="showDatePicker = false" />
                        <span>{{ __("No due date") }}</span>
                    </x-label>
                    <x-label class="mt-2 flex items-center space-x-2">
                        <x-radio name="showDatePicker" @click="showDatePicker = true" />
                        <span x-show="!showDatePicker">{{ __("A specific day") }}</span>
                        <x-sm-input x-show="showDatePicker" id="due_date" type="date" wire:model="due_date" placeholder="Choose date" />
                    </x-label>
                </div>
            </div>

            <div class="mt-6">
                <x-editor wire:model.blur="description"/>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">{{ __("Cancel") }}</x-secondary-button>
            <x-button wire:click="save" class="ms-4">{{ __("Create") }}</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
