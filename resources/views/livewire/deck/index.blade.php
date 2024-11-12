<div>
    <div wire:sortable="updateOrder" class="max-w-7xl flex flex-row items-stretch gap-2 overflow-x-auto scroll-mb-6">
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
                    @livewire('deck.update', ['deck' => $deck], key('update-deck-'.$deck->id))
                </div>

                <div class="mt-6">
                    @livewire('task.by-deck', ['tasks' => $deck->tasks], key('tasksForDeck'.$deck->id))
                </div>
            </div>
        @empty
        @endforelse
    </div>
</div>
