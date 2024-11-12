<div>
    @forelse ($tasks as $task)
        <div class="max-w-72 w-full bg-white dark:bg-zinc-900 dark:text-white rounded-lg text-sm p-2 mb-2">
            <div class="flex items-center justify-between">
                <span>{{$task->title}}</span>
                @livewire('task.update', ['task' => $task], key('updateTask'.$task->id))
            </div>
            <small class="block mt-1">By {{ $task->creator->first_name_and_initial }} {{ $task->created_at->diffForHumans() }}</small>
        </div>
    @empty

    @endforelse
</div>
