<div class="flex items-center space-x-1">
    <a href="{{ route('client.files', ['client' => $client]) }}" class="text-indigo-500 hover:text-indigo-600 rounded">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
            <path d="M8.543 2.232a.75.75 0 0 0-1.085 0l-5.25 5.5A.75.75 0 0 0 2.75 9H4v4a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 1 1 2 0v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V9h1.25a.75.75 0 0 0 .543-1.268l-5.25-5.5Z" />
        </svg>
    </a>
    <span class="text-slate-500">/</span>
    @if ($item)
        @forelse ($item->getAncestors() as $ancestor)
            <a href="{{ route('client.files', ['client' => $client, 'item' => $ancestor]) }}" class="text-slate-700 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white hover:underline">{{ $ancestor->name }}</a>
            <span class="text-slate-500">/</span>
        @empty
        @endforelse
        <span class="text-slate-700 dark:text-white">{{ $item->name }}</span>
    @endif
</div>
