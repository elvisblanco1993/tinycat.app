<div>
    @if ($task)
        <x-drawer wire:model="drawer" width="md:w-2/3">
            <x-slot name="title">
                <h2 class="text-xl font-semibold">{{ $title }}</h2>
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-3 h-full md:divide-x divide-zinc-200 dark:divide-zinc-700">
                    <div class="col-span-3 sm:col-span-2 md:col-span-2 md:pr-4">
                        <div x-data="{editDescription: false}">
                            <div x-show="!editDescription" class="flex items-start justify-between">
                                <div class="prose prose-sm dark:prose-invert prose-blue max-w-full">
                                    {!! !empty(strip_tags($description)) ? Str::markdown($description) : "No description provided" !!}
                                </div>
                                <button class="text-sm underline text-zinc-500 hover:text-zinc-600 dark:text-zinc-300 dark:hover:text-zinc-100"
                                    @click="editDescription = ! editDescription">{{ __("Edit") }}</button>
                            </div>
                            <div x-show="editDescription" x-cloak @click.outside="editDescription = false">
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

                                <div class="mt-6 flex items-center justify-end">
                                    <x-action-message on="saved" class="me-3"/>
                                    <x-button wire:click="save">
                                        {{ __("Save") }}
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-3 sm:col-span-2 md:col-span-1 md:pl-4">
                        <div class="grid grid-cols-4 gap-4 items-start">
                            <x-label class="col-span-2" for="update_task_assign_to">{{ __("Assigned to") }}</x-label>
                            <div class="col-span-2">
                                <x-selector id="update_task_assign_to" :options="$clientUsers" wire:model="assign_to"></x-selector>
                                <x-input-error for="assign_to" class="mt-1" />
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-4 gap-4 items-start">
                            <x-label class="col-span-2" for="update_task_notify_when_done">{{ __("When done, notify") }}</x-label>
                            <div class="col-span-2">
                                <x-selector id="update_task_notify_when_done" :options="$teamUsers" wire:model="recipients"></x-selector>
                            </div>
                        </div>
                        <div class="mt-6 grid grid-cols-4 gap-4 items-center">
                            <x-label class="col-span-2" for="update_task_progress">{{ __("Status") }}</x-label>
                            <div class="col-span-2">
                                <div x-data="{ open: false }" class="text-sm">
                                    <button x-ref="button" @click="open = ! open"
                                        class="inline-flex items-center gap-1 p-1 px-2 text-sm rounded-full border border-zinc-300 border-dashed bg-zinc-50 text-zinc-800 dark:bg-zinc-900/60 dark:border-zinc-500 dark:text-zinc-100 hover:text-zinc-800 dark:hover:text-white">
                                        <span style="color:{{ config("internal.task_status_icons.$status.text_color") }}">
                                            {!! config("internal.task_status_icons.$status.icon") !!}
                                        </span>
                                        <span class="ms-2">{{ Str::headline($status) }}</span>
                                    </button>

                                    <div x-show="open" x-anchor.bottom-start.offset.5="$refs.button" @click.outside="open = ! open"
                                        class="rounded-lg shadow-lg ring-1 ring-black/5 dark:ring-white/5 py-1 bg-white dark:bg-zinc-700 text-zinc-700 dark:text-zinc-100">
                                        @foreach (config('internal.task_status_icons') as $option)
                                            <button wire:click="setStatus('{{$option['label']}}')" @click="open = false" class="text-left w-full px-3 py-1 flex items-center hover:bg-zinc-100 dark:hover:bg-zinc-800" >
                                                <span style="color:{{$option['text_color']}}">
                                                    {!! $option['icon'] !!}
                                                </span>
                                                <span class="ms-2">{{ Str::headline($option['label']) }}</span>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                @livewire('task.delete', ['task' => $task])
            </x-slot>
        </x-drawer>
    @endif
</div>
