<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">
            {{ $form->title }}
        </h2>
        @can('update', $form)
            @livewire('admin.form.update', ['form' => $form])
        @endcan
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4 ">
        @livewire('admin.form.question.index', ['form' => $form])
    </div>
</div>
