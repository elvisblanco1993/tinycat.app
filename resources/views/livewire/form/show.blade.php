<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Forms') }}
        </h2>
        @can('update', $form)
            @livewire('form.update')
        @endcan
    </x-slot>
</div>
