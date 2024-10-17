<div>
    {{-- Client Card --}}
    @include('partials.client.profile')
    {{-- End | Client Card --}}

    <div class="mt-3 max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <x-tinycat.search type="search" wire:model.live.debounce.250="search" placeholder="Search..." class="text-sm" />
            @include('partials.client.file-menu')
        </div>
    </div>

    <div class="mt-3 w-full px-4 sm:px-6 lg:px-8 text-sm font-medium">
        @include('partials.client.file-breadcrumbs')
    </div>

    <ul class="mt-3 w-full px-4 sm:px-6 lg:px-8 space-y-2">
        @forelse ($items as $item)
            <li class="flex items-center justify-between">
                @if ($item->is_folder)
                    <a href="{{ route('client.files', ['client' => $client, 'item' => $item]) }}" class="w-full rounded-lg overflow-hidden">
                        <div class="flex items-center space-x-3 h-16 px-2 hover:bg-slate-100 dark:hover:bg-slate-800">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-12 fill-indigo-500">
                                <path d="M19.5 21a3 3 0 0 0 3-3v-4.5a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3V18a3 3 0 0 0 3 3h15ZM1.5 10.146V6a3 3 0 0 1 3-3h5.379a2.25 2.25 0 0 1 1.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 0 1 3 3v1.146A4.483 4.483 0 0 0 19.5 9h-15a4.483 4.483 0 0 0-3 1.146Z" />
                            </svg>
                            <div class="">
                                <p class="text-slate-700 dark:text-white text-sm">{{ $item->name }}</p>
                                <small class="text-slate-500 dark:text-slate-400">{{ __("Last updated on ") . $item->updated_at->format('M d, Y h:i a') }}</small>
                            </div>
                        </div>
                    </a>
                @elseif ($item->is_external)
                    <a href="{{ $item->path }}" target="_{{ $item->path }}" class="w-full rounded-lg overflow-hidden">
                        <div class="flex items-center space-x-3 h-16 px-2 hover:bg-slate-100 dark:hover:bg-slate-800">
                            <div class="size-12 rounded flex items-center justify-center bg-green-100 text-green-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-slate-700 dark:text-white text-sm">{{ $item->name }}</p>
                                <small class="text-slate-500 dark:text-slate-400">{{ __("Last updated on ") . $item->updated_at->format('M d, Y h:i a') }}</small>
                            </div>
                        </div>
                    </a>
                @else
                    <button class="w-full rounded-lg overflow-hidden text-left">
                        <div class="flex items-center space-x-3 h-16 px-2 hover:bg-slate-100 dark:hover:bg-slate-800">
                            @if ($item->thumbnail)
                                <img src="{{ route('thumbnail', ['item' => $item]) }}" class="size-12 aspect-square rounded object-cover object-center shadow">
                            @else
                                <svg class="h-full text-slate-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                            <div class="">
                                <p class="text-slate-700 dark:text-white text-sm">{{ $item->name }}</p>
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
