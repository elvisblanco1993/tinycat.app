<div>
    <x-slot name="header">
        <x-secondary-button-link href="{{ route('project.show', ['project' => $project]) }}" wire:navigate>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                <path fill-rule="evenodd" d="M14 8a.75.75 0 0 1-.75.75H4.56l3.22 3.22a.75.75 0 1 1-1.06 1.06l-4.5-4.5a.75.75 0 0 1 0-1.06l4.5-4.5a.75.75 0 0 1 1.06 1.06L4.56 7.25h8.69A.75.75 0 0 1 14 8Z" clip-rule="evenodd" />
            </svg>
            <span class="ms-2">{{__("Back")}}</span>
        </x-secondary-button-link>
    </x-slot>
    <div class="py-6 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-form-section submit="save">
            <x-slot name="title">
                {{ __("Project settings") }}
            </x-slot>

            <x-slot name="description">
                {{ __("Manage details about the project.") }}
            </x-slot>

            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="name">{{ __("Project name") }}</x-label>
                    <x-input id="name" type="text" wire:model="name" class="mt-1 w-full" />
                    <x-input-error for="name" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="description">{{ __("Description") }}</x-label>
                    <x-textarea id="description" wire:model="description" class="mt-1 w-full"></x-textarea>
                    <x-input-error for="description" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="start_date">{{ __("Start date") }}</x-label>
                    <x-input type="date" id="start_date" wire:model="start_date" class="mt-1 w-full"/>
                    <x-input-error for="start_date" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="end_date">{{ __("End date") }}</x-label>
                    <x-input type="date" id="end_date" wire:model="end_date" class="mt-1 w-full"/>
                    <x-input-error for="end_date" />
                </div>
            </x-slot>

            <x-slot name="actions">
                <x-action-message class="me-3" on="saved">
                    {{ __('Saved.') }}
                </x-action-message>

                <x-button wire:loading.attr="disabled" wire:target="photo">
                    {{ __('Save') }}
                </x-button>
            </x-slot>
        </x-form-section>
    </div>
    {{-- <div class="py-6 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-zinc-800 dark:text-white rounded-lg shadow overflow-hidden">
            <form wire:submit.prevent="save">
                @csrf
                <div class="px-4 py-6">
                    <div class="block md:flex items-center gap-8">

                    </div>
                    <div class="mt-6 block md:flex items-start gap-8">

                    </div>
                    <div class="mt-6 block md:flex items-center gap-8">
                        <x-label for="itin" class="w-full md:w-1/6">{{ __("Dates") }}</x-label>
                        <div class="flex items-center space-x-3 w-full md:w-1/2">
                            <x-input type="date" id="start_date" wire:model="start_date"/>
                            <span>To</span>
                            <x-input type="date" id="end_date" wire:model="end_date"/>
                        </div>
                        <x-input-error for="start_date" />
                        <x-input-error for="end_date" />
                    </div>
                </div>

                <div class="p-4 bg-zinc-100 dark:bg-zinc-700 flex items-center justify-end">
                    <x-action-message class="me-3" on="saved">
                        {{ __('Saved.') }}
                    </x-action-message>
                    <x-button>
                        {{ __("Save changes") }}
                    </x-button>
                </div>
            </form>
        </div>
    </div> --}}
</div>
