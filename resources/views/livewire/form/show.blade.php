<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ $form->title }}
        </h2>
        @can('update', $form)
            @livewire('form.update', ['form' => $form])
        @endcan
    </x-slot>

    <div class="py-6 max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        @livewire('form.question.index', ['form' => $form])
    </div>
</div>
