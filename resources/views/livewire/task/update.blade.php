<div>
    @if ($projectUsers)
        <x-drawer wire:model="drawer">
            <x-slot name="title">
                <h2 class="text-xl font-bold">{{ $task->title }}</h2>
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-4 gap-4 items-center">
                    <x-label for="update_task_title">{{ __("Title") }}</x-label>
                    <div class="col-span-3">
                        <x-sm-input id="update_task_title" type="text" wire:model="title" class="w-full" placeholder="{{ __('Type a title...') }}" />
                        <x-input-error for="title" class="mt-1" />
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-4 gap-4 items-start">
                    <x-label for="update_task_description">{{ __("Details") }}</x-label>
                    <div class="col-span-3">
                        <x-editor wire:model.blur="description" id="update_task_description"/>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-4 gap-4 items-center">
                    <x-label for="update-deck">{{ __("Move along to") }}</x-label>
                    <div class="col-span-3">
                        <x-select id="update-deck" wire:model.live="selected_deck" class="text-sm">
                            @forelse ($decks as $deck)
                                <option value="{{ $deck->id }}">{{ $deck->name }}</option>
                            @empty
                            @endforelse
                        </x-select>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-4 gap-4 items-start">
                    <x-label for="update_task_assign_to">{{ __("Assigned to") }}</x-label>
                    <div class="col-span-3">
                        <x-selector id="update_task_assign_to" :options="$projectUsers" wire:model.live="assign_to"></x-selector>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-4 gap-4 items-start">
                    <x-label for="update_task_notify_when_done">{{ __("When done, notify") }}</x-label>
                    <div class="col-span-3">
                        <x-selector id="update_task_notify_when_done" :options="$projectUsers" wire:model.live="recipients"></x-selector>
                    </div>
                </div>
            </x-slot>
        </x-drawer>
    @endif
</div>
