<div>
    @unless (Auth::user()->is_client)
        @include('partials.client.profile')
    @else
    <h2 class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 font-semibold text-xl text-zinc-800 dark:text-zinc-200">
        {{ __("Files") }}
    </h2>
    @endunless

    <div class="mt-3 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <x-tinycat.search type="search" wire:model.live.debounce.250="search" placeholder="Search..." class="text-sm" />
            @include('partials.client.file-menu')
        </div>
        <div class="mt-3">
            @include('partials.client.file-breadcrumbs')
        </div>
        <ul class="mt-3 space-y-2">
            @forelse ($items as $item)
                <li class="flex items-center justify-between rounded-lg px-3 py-1 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                    @if ($item->is_folder)
                        <a href="{{ route('file.index', ['client' => $client, 'item' => $item]) }}" class="w-full">
                            <div class="flex items-center space-x-3 h-16 ">
                                <img src="{{ asset( config('internal.icons.dir') ) }}">
                                <div class="">
                                    <p class="text-zinc-700 dark:text-white text-sm">{{ $item->name }}</p>
                                    <small class="text-zinc-500 dark:text-zinc-400">{{ __("Last updated on ") . $item->updated_at->format('M d, Y h:i a') }}</small>
                                </div>
                            </div>
                        </a>
                    @elseif ($item->is_external)
                        <a href="{{ $item->path }}" target="_{{ $item->path }}" class="w-full">
                            <div class="flex items-center space-x-3 h-16 ">
                                <div class="size-12 rounded flex items-center justify-center bg-green-100 text-green-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-zinc-700 dark:text-white text-sm">{{ $item->name }}</p>
                                    <small class="text-zinc-500 dark:text-zinc-400">{{ __("Last updated on ") . $item->updated_at->format('M d, Y h:i a') }}</small>
                                </div>
                            </div>
                        </a>
                    @else
                        <button
                            wire:click="$dispatchTo('file.update', 'show-item', { id: {{ $item->id }} })"
                            class="w-full text-left"
                        >
                            <div class="flex items-center space-x-3 h-16 ">
                                @if ($item->thumbnail)
                                    <img src="{{ route('thumbnail', ['item' => $item]) }}" class="size-12 aspect-square rounded object-cover object-center shadow">
                                @else
                                    <img src="{{ asset( config("internal.icons.{$item->mime}") ) }}">
                                @endif
                                <div class="">
                                    <p class="text-zinc-700 dark:text-white text-sm">{{ $item->name }}</p>
                                    <small class="text-zinc-500 dark:text-zinc-400">{{ __("Last updated on ") . $item->updated_at->format('M d, Y h:i a') }}</small>
                                </div>
                            </div>
                        </button>
                    @endif

                    {{-- Options Menu --}}
                    <div>
                        @can('move', \App\Models\Item::class, Auth::user())
                            <x-secondary-button wire:click="$dispatchTo('file.move', 'move-item', { client: {{ $client }}, item: {{ $item }} })">
                                {{ __("Move") }}
                            </x-secondary-link>
                        @endcan
                    </div>
                </li>
            @empty
            @endforelse
        </ul>
    </div>

    <div class="mt-3 w-full px-4 sm:px-6 lg:px-8 text-sm font-medium">
    </div>


    @livewire('file.update')
    @livewire('file.move')
</div>
