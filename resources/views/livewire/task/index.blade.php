<div>
    @unless (Auth::user()->is_client)
        @include('partials.client.profile')
    @else
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200">
            {{ __("Tasks") }}
        </h2>
    @endunless

    <div class="mt-6">
        <div class="flex items-center justify-between">
            <x-tinycat.search type="search" wire:model.live.debounce.250="search" placeholder="Search tasks..." class="text-sm placeholder:italic" />
            @can('create', \App\Models\Task::class)
                @livewire('task.create', ['client' => $client, 'clientUsers' => $clientUsers])
            @endcan
        </div>
    </div>

    <div class="my-6">
        <div class=" dark:text-white divide-y dark:divide-zinc-700">
            @forelse ($tasks as $task)
                <div wire:click="$dispatchTo('task.update', 'update-task', { task: {{ $task->id }}})"
                    class="px-3 py-2 flex items-center justify-between cursor-pointer hover:bg-zinc-100 dark:hover:bg-zinc-800">
                    <div class="flex items-center">
                        <div class="size-8 flex items-center justify-center rounded-md"
                            style="
                                background-color: {{ config("internal.task_status_icons.$task->status.bg_color") }};
                                color: {{ config("internal.task_status_icons.$task->status.text_color") }};
                            ">
                            {!! config("internal.task_status_icons.$task->status.icon") !!}
                        </div>
                        <div class="ms-3">{{ $task->title }}</div>
                    </div>

                    <div class="hidden sm:block w-64 bg-gray-200 rounded-full dark:bg-gray-700">
                        <div class="bg-blue-600 h-1 rounded-full" style="width: {{ $task->progress }}%"></div>
                    </div>
                    <div class="block sm:hidden text-xs text-white bg-blue-600 font-medium py-0.5 px-1 rounded-md">{{ $task->progress }}%</div>
                </div>
            @empty
            @endforelse
        </div>
    </div>

    @livewire('task.update', ['clientUsers' => $clientUsers])
</div>
