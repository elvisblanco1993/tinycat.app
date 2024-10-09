<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ $form->title }}
        </h2>
        @can('update', $form)
            @livewire('form.update', ['form' => $form])
        @endcan
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto">
            @livewire('form.question.index', ['form' => $form])
        </div>
    </div>
</div>
