<div>
    <div wire:sortable="updateDeckOrder" wire:sortable-group="updateTaskDeck" wire:sortable.options="{ animation: 50 }" class="min-h-96 max-w-7xl flex flex-row items-start gap-2 overflow-x-auto">
        @forelse ($decks as $deck)
            <div @class([
                "min-w-72 w-auto px-2 py-3 rounded-lg",
                'bg-zinc-200/60 dark:bg-zinc-800' => !$deck->color,
            ])
                style="background-color: {{ $deck->color }};"
                wire:sortable.item="{{ $deck->id }}"
                wire:key="deck-{{ $deck->id }}"
            >
                <div wire:sortable.handle class="flex items-center justify-between">
                    <div @class(['text-sm font-semibold text-zinc-900', 'dark:text-zinc-300' => !$deck->color])>
                        {{ $deck->name }} <span @class(['font-light text-zinc-700', 'dark:text-zinc-400' => !$deck->color])>({{ $deck->tasks->count() }})</span>
                    </div>
                    @can('update', $deck)
                        @livewire('deck.update', ['deck' => $deck], key('update-deck-'.$deck->id))
                    @endcan
                </div>

                <div class="mt-6"
                    wire:sortable-group.item-group="{{ $deck->id }}" wire:sortable-group.options="{ animation: 100 }"
                >
                    {{-- Tasks --}}
                    @forelse ($deck->tasks as $task)
                        <div wire:sortable-group.item="{{ $task->id }}" wire:key="task-{{ $task->id }}" wire:sortable-group.handle
                            class="max-w-72 w-full bg-white/90 hover:bg-white dark:bg-zinc-900/90 dark:hover:bg-zinc-900 dark:text-white rounded-lg text-sm p-2 mb-2"
                        >
                            <div class="flex items-center justify-between">
                                <button @click="$dispatch('update-task', { task: {{$task->id}} })">{{ $task->title }}</button>
                                @livewire('task.self-assign', ['task' => $task], key('selfassignTask'.$task->id))
                            </div>
                            <small class="block mt-1">By {{ $task->creator->first_name_and_initial }} {{ $task->created_at->diffForHumans() }}</small>
                        </div>
                    @empty
                    @endforelse
                    {{-- End - Tasks --}}
                </div>
            </div>
        @empty
        @endforelse
    </div>

    @if ($task)
        @livewire('task.update', ['task' => $task, 'projectUsers' => $projectUsers], key('updateTask'.$task->id))
    @endif
</div>
