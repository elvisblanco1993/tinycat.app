<div>
    @unless ($task->users->count() > 0)
    <button wire:click="assign" class="size-6 flex items-center justify-center rounded-full border border-dashed border-zinc-300">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" class="size-4 fill-zinc-600 dark:fill-zinc-300 flex-none">
            <path d="M8.5 4.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 13c.552 0 1.01-.452.9-.994a5.002 5.002 0 0 0-9.802 0c-.109.542.35.994.902.994h8ZM12.5 3.5a.75.75 0 0 1 .75.75v1h1a.75.75 0 0 1 0 1.5h-1v1a.75.75 0 0 1-1.5 0v-1h-1a.75.75 0 0 1 0-1.5h1v-1a.75.75 0 0 1 .75-.75Z" />
        </svg>
    </button>
    @else
        <img src="{{ $task->users[0]->profile_photo_url }}" alt="{{ $task->users[0]->name }}" class="size-6 rounded-full object-cover object-center">
    @endunless
</div>
