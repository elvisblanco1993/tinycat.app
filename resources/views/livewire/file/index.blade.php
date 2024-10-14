<div>
    {{-- Client Card --}}
    @include('client.profile')
    {{-- End | Client Card --}}

    <div class="mt-3 max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <x-tinycat.search type="search" wire:model.live.debounce.250="search" placeholder="Search..." class="text-sm" />
            @include('client.file-menu')
        </div>
    </div>

    <div class="mt-3 w-full px-4 sm:px-6 lg:px-8 text-sm font-medium">
        @include('client/file-breadcrumbs')
    </div>

    <ul class="mt-3 w-full px-4 sm:px-6 lg:px-8">
        @forelse ($items as $item)
            <li class="flex items-center justify-between">
                @if ($item->is_folder)
                    <a href="{{ route('client.files', ['client' => $client, 'item' => $item]) }}" class="w-full rounded-lg overflow-hidden">
                        <div class="flex items-center space-x-3 h-16 hover:bg-slate-100 dark:hover:bg-slate-800">
                            <svg class="h-full text-slate-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M3 6a2 2 0 0 1 2-2h5.532a2 2 0 0 1 1.536.72l1.9 2.28H3V6Zm0 3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9H3Z" clip-rule="evenodd"/>
                            </svg>
                            <div class="">
                                <p class="text-slate-700 dark:text-white">{{ $item->name }}</p>
                                <small class="text-slate-500 dark:text-slate-400">{{ __("Last updated on ") . $item->updated_at->format('M d, Y h:i a') }}</small>
                            </div>
                        </div>
                    </a>
                @else
                    <button class="w-full rounded-lg overflow-hidden text-left">
                        <div class="flex items-center space-x-3 h-16 hover:bg-slate-100 dark:hover:bg-slate-800">
                            <svg class="h-full text-slate-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z" clip-rule="evenodd"/>
                            </svg>
                            <div class="">
                                <p class="text-slate-700 dark:text-white">{{ $item->name }}</p>
                                <small class="text-slate-500 dark:text-slate-400">{{ __("Last updated on ") . $item->updated_at->format('M d, Y h:i a') }}</small>
                            </div>
                        </div>
                    </button>
                @endif
            </li>
        @empty

        @endforelse
    </ul>
</div>
