<div>
    <x-button wire:click="$toggle('modal')">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
            <path d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
        </svg>
        <span class="ms-1">{{ __("Add Task") }}</span>
    </x-button>

    <x-dialog-modal>
        <x-slot name="title">{{ __("New task for ") . $project->name }}</x-slot>
        <x-slot name="content">
            <div class=" grid grid-cols-4 gap-4 items-center">
                <x-label for=""><strong>Title</strong></x-label>
                <x-sm-input id="" type="text" wire:model="" class="col-span-3" placeholder="{{ __('Type a title...') }}" />
            </div>

            <div class="mt-6 grid grid-cols-4 gap-4 items-center">
                <x-label for=""><strong>Assign to</strong></x-label>
                <x-sm-input id="" type="text" wire:model="" class="col-span-3" />
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
                        <x-sm-input x-show="showDatePicker" id="" type="date" wire:model="" placeholder="Choose date" />
                    </x-label>
                </div>
            </div>

            <div class="mt-6">
                <x-editor wire:model="description"/>
            </div>
        </x-slot>

        <x-slot name="footer"></x-slot>
    </x-dialog-modal>
</div>
