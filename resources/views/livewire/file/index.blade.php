<div>
    <div>
        <x-slot name="header">
            @unless (Auth::user()->is_client)
                <div class="flex items-center divide-x dark:divide-zinc-700">
                    <x-tinycat.client-close-button />

                    <div class="pl-2 text-lg font-semibold">
                        <h2>
                            <a href="{{ route('client.show', ['client' => $client]) }}"
                                wire:navigate
                                class="text-blue-500 hover:underline"
                                >{{ $client->name }}</a>
                            <span>/ {{ __("Files") }}</span>
                        </h2>
                    </div>
                </div>
            @else
                <h2 class="text-lg font-semibold">
                    {{ __("Files") }}
                </h2>
            @endunless


            <div class="flex items-center space-x-3">
                <x-tinycat.client-contact-card :phone="$client->phone"/>
                <x-tinycat.client-dropdown-menu :client="$client" />
            </div>
        </x-slot>

        <div class="my-12 max-w-5xl mx-auto">
            <div class="flex items-center justify-between">
                <x-tinycat.search type="search" wire:model.live.debounce.250="search" placeholder="Search..." class="text-sm" />
                @include('partials.client.file-menu')
            </div>
            <div class="mt-6">
                @include('partials.client.file-breadcrumbs')
            </div>
            <ul class="mt-6 space-y-2">
                @forelse ($items as $item)
                    <li class="flex items-center justify-between rounded-lg px-3 py-1 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                        @if ($item->is_folder)
                            <a href="{{ route('client.file.index', ['client' => $client, 'item' => $item]) }}" class="w-full">
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
                                    <div class="size-12 rounded-sm flex items-center justify-center bg-green-100 text-green-700">
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
                                        <img src="{{ route('thumbnail', ['item' => $item]) }}" class="size-12 aspect-square rounded-sm object-cover object-center shadow-sm">
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
    </div>

    @livewire('file.update')
    @livewire('file.move')
</div>
