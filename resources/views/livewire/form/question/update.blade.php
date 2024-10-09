<div>
    <div class="rounded-lg px-4 py-3 hover:bg-slate-100 dark:hover:bg-slate-800 group flex items-center transition-all">

        <button x-cloak wire:sortable.handle class="size-6 aspect-square rounded mr-4 text-transparent group-hover:text-slate-700 dark:group-hover:text-slate-300 cursor-move transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
            </svg>
        </button>

        <div class="w-full">

            <x-label-input type="text" wire:model.live.debounce.250="question_text" placeholder="{{__('Write your question here')}}"/>

            @if ($question->type === 'longtext')
                <x-textarea wire:model.live.debounce.250="placeholder" class="mt-2 w-full text-slate-500" />
            @elseif ($question->type === 'select')
                <x-select class="mt-2 w-full text-slate-500">
                    @if ($question->options)
                        @forelse ($question->options as $option)
                            <option>{{$option}}</option>
                        @empty
                        @endforelse
                    @endif
                </x-select>
                <x-textarea wire:model.live.debounce.250="options" rows="4" class="mt-3 w-full text-slate-500" placeholder="{{ __('Insert one option per line.') }}" />
            @elseif ($question->type === 'file')
                <div class="mt-2">
                    <x-file-input />
                </div>
            @else
                <x-input type="text" wire:model.live.debounce.250="placeholder" class="mt-2 w-full text-slate-500" />
            @endif

            <div class="mt-2">
                <div class="flex items-center justify-end space-x-4">
                    <x-switch label="Required" wire:model.live="is_required"/>
                    @livewire('form.question.delete', ['question' => $question])
                </div>
            </div>
        </div>
    </div>
</div>
