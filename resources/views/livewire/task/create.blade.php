<div>
    <x-button wire:click="$toggle('modal')">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
            <path d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
        </svg>
        <span class="ms-1">{{ __("Add Task") }}</span>
    </x-button>

    <x-dialog-modal wire:model="modal">
        <x-slot name="title">{{ __("New task ") }}</x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-4 gap-4 items-center">
                <x-label for="title">Title</x-label>
                <div class="col-span-3">
                    <x-sm-input id="title" type="text" wire:model="title" class="w-full" placeholder="{{ __('Type a title...') }}" />
                    <x-input-error for="title" class="mt-1" />
                </div>
            </div>

            <div class="mt-6 grid grid-cols-4 gap-4 items-center">
                <x-label for="assign_to">Assign to</x-label>
                <div class="col-span-3">
                    <x-selector  id="assign_to" :options="$clientUsers" wire:model="assign_to"></x-selector>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-4 gap-4 items-start">
                <x-label>Due on</x-label>
                <div x-data="{showDatePicker: false}" class="col-span-3">
                    <x-label class="flex items-center">
                        <x-radio name="showDatePicker" @click="showDatePicker = false" />
                        <span class="ml-2 text-sm text-zinc-600 dark:text-zinc-200 font-normal">{{ __("No due date") }}</span>
                    </x-label>
                    <x-label class="mt-2 flex items-center">
                        <x-radio name="showDatePicker" @click="showDatePicker = true" />
                        <span x-show="!showDatePicker" class="ml-2 text-sm text-zinc-600 dark:text-zinc-200 font-normal">{{ __("A specific day") }}</span>
                        <x-sm-input x-show="showDatePicker" id="due_date" type="date" wire:model="due_date" placeholder="Choose date" class="ml-2"/>
                    </x-label>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-4 gap-4 items-start">
                <x-label>{{__("Recurrence")}}</x-label>
                <div class="col-span-3">
                    <x-switch id="repeat" type="checkbox" wire:model.live="repeat" label="Repeat task"/>

                    @if ($repeat)
                        <div class="mt-3 w-full flex items-center gap-2">
                            <x-label class="flex-none w-1/3">{{ __("Repeat every") }}</x-label>
                            <x-input type="number" wire:model="interval" min="1" class="w-1/3 text-sm"/>
                            <x-select id="frequency" wire:model="frequency" class="w-1/3 text-sm">
                                <option value="day">day</option>
                                <option value="week">week</option>
                                <option value="month">month</option>
                                <option value="year">year</option>
                            </x-select>
                        </div>

                        <div class="mt-3 w-full flex items-center gap-2">
                            <x-label class="flex-none w-1/3" for="end_date">{{ __("Ends") }}</x-label>
                            <x-input type="date" id="end_date" wire:model="end_date" class="w-2/3 text-sm"/>
                        </div>
                    @endif
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
