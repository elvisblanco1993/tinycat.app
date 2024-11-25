<div>
    @unless (Auth::user()->is_client)
        @include('partials.client.profile')
    @else
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200">
            {{ __("Tasks") }}
        </h2>
    @endunless

    <div class="mt-6">
        <div class="flex items-center justify-between">
            <x-tinycat.search type="search" wire:model.live.debounce.250="search" placeholder="Search tasks..." class="text-sm placeholder:italic" />
            @can('create', \App\Models\Task::class)
                @livewire('task.create', ['client' => $client])
            @endcan
        </div>
    </div>
</div>
