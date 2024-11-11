<div>
    <x-slot name="header">
        <x-secondary-button-link href="{{ route('project.show', ['project' => $project]) }}" wire:navigate>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                <path fill-rule="evenodd" d="M14 8a.75.75 0 0 1-.75.75H4.56l3.22 3.22a.75.75 0 1 1-1.06 1.06l-4.5-4.5a.75.75 0 0 1 0-1.06l4.5-4.5a.75.75 0 0 1 1.06 1.06L4.56 7.25h8.69A.75.75 0 0 1 14 8Z" clip-rule="evenodd" />
            </svg>
            <span class="ms-2">{{__("Back")}}</span>
        </x-secondary-button-link>
    </x-slot>
    <div class="mt-3 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between">
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">{{ $project->name }}</h2>
        <a href="{{ route('project.update', ['project' => $project]) }}">
            Edit
        </a>
    </div>

    <div class="mt-3 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-end">
        @livewire('task.create', ['project' => $project])
    </div>
    <div class="mt-3 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        @livewire('milestone.index', ['project' => $project])
    </div>
</div>
