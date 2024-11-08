<div>
    <x-slot name="header">
        <x-secondary-button-link href="{{ route('project.index') }}" wire:navigate>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                <path d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
            </svg>
        </x-secondary-button-link>

        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">{{ $project->name }}</h2>

        @livewire('project.update', ['project' => $project])
    </x-slot>

    <div class="mt-3 max-w-full mx-auto px-4 sm:px-6 lg:px-8 flex justify-end">
        {{-- @livewire('task.create', ['project' => $project]) --}}
    </div>
    <div class="mt-3 max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        @livewire('deck.index', ['project' => $project])
    </div>
</div>
