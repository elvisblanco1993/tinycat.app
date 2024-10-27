<div>
    <div wire:sortable="updateOrder">
        @forelse ($questions as $key => $question)
            <div class="mb-4"
                wire:sortable.item="{{ $question->id }}"
                wire:key="question-{{ $question->id }}"
            >
                @livewire('admin.form.question.update', ['question' => $question], key('update-'.$key))
            </div>
        @empty
        @endforelse
    </div>

    @can('update', $form)
        @livewire('admin.form.question.create', ['form' => $form])
    @endcan
</div>
