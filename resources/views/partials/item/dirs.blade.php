@foreach ($items as $item)
        <li class="flex items-center justify-between py-1 px-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700">
            <div class="flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path d="M19.5 21a3 3 0 0 0 3-3v-4.5a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3V18a3 3 0 0 0 3 3h15ZM1.5 10.146V6a3 3 0 0 1 3-3h5.379a2.25 2.25 0 0 1 1.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 0 1 3 3v1.146A4.483 4.483 0 0 0 19.5 9h-15a4.483 4.483 0 0 0-3 1.146Z" />
                </svg>
                <span class="ms-1">{{ $item->name }}</span>
            </div>
            @unless ($item->id === $currentItem->id || $currentItem->parent_id === $item->id || $item->parent_id === $currentItem->id)
                <button wire:confirm="You are moving: 🗎 \n\n{{$currentItem->name}} => 📁 {{ $item->name }}\n\nClick OK to proceed." wire:click="move({{$item->id}})" class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium uppercase bg-indigo-100 dark:bg-indigo-900 text-indigo-900 dark:text-indigo-300 dark:hover:text-white hover:bg-indigo-200 dark:hover:bg-indigo-800">
                    <span class="me-1">{{ __("Move") }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                        <path d="M11.25 2A2.75 2.75 0 0 1 14 4.75v6.5A2.75 2.75 0 0 1 11.25 14h-3a2.75 2.75 0 0 1-2.75-2.75v-.5a.75.75 0 0 1 1.5 0v.5c0 .69.56 1.25 1.25 1.25h3c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25h-3C7.56 3.5 7 4.06 7 4.75v.5a.75.75 0 0 1-1.5 0v-.5A2.75 2.75 0 0 1 8.25 2h3Z" />
                        <path d="M7.97 6.28a.75.75 0 0 1 1.06-1.06l2.25 2.25a.75.75 0 0 1 0 1.06l-2.25 2.25a.75.75 0 1 1-1.06-1.06l.97-.97H1.75a.75.75 0 0 1 0-1.5h7.19l-.97-.97Z" />
                    </svg>
                </button>
            @endunless
        </li>

    @if ($item->subdirectories->isNotEmpty())
        <ul class="pl-4">
            @include('partials.item.dirs', ['items' => $item->subdirectories])
        </ul>
    @endif
@endforeach
