<div>
    <div class="rounded-lg overflow-hidden hover:bg-gray-100 dark:hover:bg-gray-800 group transition-all">

        <button x-cloak wire:sortable.handle class="w-full text-transparent group-hover:text-gray-700 dark:group-hover:text-gray-300">
            <div class="block w-full px-4 py-1 hover:bg-indigo-100 hover:text-indigo-700 dark:hover:bg-indigo-700 dark:hover:text-white transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4 mx-auto">
                    <path fill-rule="evenodd" d="M13.78 10.47a.75.75 0 0 1 0 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 1 1 1.06-1.06l.97.97V5.75a.75.75 0 0 1 1.5 0v5.69l.97-.97a.75.75 0 0 1 1.06 0ZM2.22 5.53a.75.75 0 0 1 0-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1-1.06 1.06l-.97-.97v5.69a.75.75 0 0 1-1.5 0V4.56l-.97.97a.75.75 0 0 1-1.06 0Z" clip-rule="evenodd" />
                </svg>
            </div>
        </button>

        <div class="w-full px-4 pb-3">

            <x-label-input type="text" wire:model.live.debounce.250="question_text" placeholder="{{__('Write your question here')}}"/>

            @if ($question->type === 'longtext')
                <x-textarea wire:model.live.debounce.250="placeholder" class="mt-2 w-full text-gray-500" />
            @elseif ($question->type === 'select')
                <x-select class="mt-2 w-full text-gray-500">
                    @if ($question->options)
                        @forelse ($question->options as $option)
                            <option>{{$option}}</option>
                        @empty
                        @endforelse
                    @endif
                </x-select>
                <x-textarea wire:model.live.debounce.250="options" rows="4" class="mt-3 w-full text-gray-500" placeholder="{{ __('Insert one option per line.') }}" />
            @elseif ($question->type === 'file')
                <div class="mt-2">
                    <x-file-input wire:model="dummyfile" />
                </div>
            @else
                <x-input type="text" wire:model.live.debounce.250="placeholder" class="mt-2 w-full text-gray-500" />
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
