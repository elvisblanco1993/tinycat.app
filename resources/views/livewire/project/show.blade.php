<div>
    <x-slot name="header">
        <x-secondary-button-link href="{{ route('project.index') }}" wire:navigate>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                <path fill-rule="evenodd" d="M14 8a.75.75 0 0 1-.75.75H4.56l3.22 3.22a.75.75 0 1 1-1.06 1.06l-4.5-4.5a.75.75 0 0 1 0-1.06l4.5-4.5a.75.75 0 0 1 1.06 1.06L4.56 7.25h8.69A.75.75 0 0 1 14 8Z" clip-rule="evenodd" />
            </svg>
            <span class="ms-2">{{__("Back")}}</span>
        </x-secondary-button-link>
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">{{ $project->name }}</h2>
        @livewire('project.update', ['project' => $project, 'teamUsers' => $teamUsers, 'projectUsers' => $projectUsers])
    </x-slot>

    <div class="mt-6 flex justify-between">
        <div class="flex items-center space-x-2">
            <span class="text-sm text-zinc-700 dark:text-zinc-400 ">People:</span>
            <div class="flex -space-x-4 rtl:space-x-reverse">
                @forelse ($projectUsers as $user)
                    <img class="size-8 shadow-xs rounded-full dark:border-zinc-800" src="{{ $user['profile_photo_url'] }}" alt="">
                @empty
                @endforelse
            </div>
        </div>

        <div class="flex items-center space-x-3">
            @livewire('deck.create', ['project' => $project])
            @if ($project->decks->count() > 0)
                @can('create', \App\Models\Task::class)
                    @livewire('task.create', ['project' => $project, 'teamUsers' => $teamUsers, 'projectUsers' => $projectUsers])
                @endcan
            @endif
        </div>
    </div>

    <div class="mt-6">
        @livewire('deck.index', ['project' => $project, 'teamUsers' => $teamUsers, 'projectUsers' => $projectUsers])
    </div>
</div>
