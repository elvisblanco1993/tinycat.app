<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">
            {{ __('Create Team') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-5xl mx-auto py-10 ">
            @livewire('teams.create-team-form')
        </div>
    </div>
</x-app-layout>
