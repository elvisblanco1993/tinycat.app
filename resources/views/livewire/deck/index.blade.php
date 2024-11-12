<div>
    <div wire:sortable="updateOrder" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
        @forelse ($decks as $deck)
            <div @class([
                "px-4 py-3 rounded-lg",
                'border dark:border-zinc-600' => !$deck->color,
                'md:col-span-2 lg:col-span-4' => $deck->is_expanded
            ])
                style="background-color: {{ $deck->color }}"
                wire:sortable.item="{{ $deck->id }}"
                wire:key="deck-{{ $deck->id }}"
                wire:sortable.handle
            >
                <div class="flex items-center justify-between">
                    <div @class(['text-sm font-semibold text-zinc-900', 'dark:text-zinc-300' => !$deck->color])>
                        {{ $deck->name }} <span @class(['font-light text-zinc-700', 'dark:text-zinc-400' => !$deck->color])>({{ $deck->tasks->count() }})</span>
                    </div>
                    @livewire('deck.update', ['deck' => $deck], key('update-deck-'.$deck->id))
                </div>
            </div>
        @empty
        @endforelse
    </div>
</div>
