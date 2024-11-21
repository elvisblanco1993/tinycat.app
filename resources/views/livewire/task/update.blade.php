<div>
    @if ($teamUsers)
        <x-drawer wire:model="drawer" width="md:w-1/2">
            <x-slot name="title">
                <x-secondary-button wire:click="save">Save</x-secondary-button>
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-3 md:col-span-2">
                        <div class="grid grid-cols-4 gap-4 items-center">
                            <x-label for="update_task_title"><strong>{{ __("Title") }}</strong></x-label>
                            <x-sm-input id="update_task_title" type="text" wire:model.live="title" class="col-span-3" placeholder="{{ __('Type a title...') }}" />
                        </div>
                        <div class="mt-6 grid grid-cols-4 gap-4 items-start">
                            <x-label for="update_task_assign_to"><strong>{{ __("Assigned to") }}</strong></x-label>
                            <div class="col-span-3">
                                <x-selector id="update_task_assign_to" :options="$teamUsers" wire:model.live="assign_to"></x-selector>
                            </div>
                        </div>
                        <div class="mt-6 grid grid-cols-4 gap-4 items-center">
                            <x-label for="update-deck"><strong>{{ __("Move along to") }}</strong></x-label>
                            <div class="col-span-3">
                                <x-select id="update-deck" wire:model.live="selected_deck" class="text-sm">
                                    @forelse ($decks as $deck)
                                        <option value="{{ $deck->id }}">{{ $deck->name }}</option>
                                    @empty
                                    @endforelse
                                </x-select>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-3 md:col-span-1"></div>
                </div>
            </x-slot>
        </x-drawer>
    @endif
</div>
