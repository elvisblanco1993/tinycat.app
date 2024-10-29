<div>
    @unless (Auth::user()->is_client)
        @include('partials.client.profile')
    @else
        <x-slot name="header">
            <x-secondary-button-link href="{{ route('upload-request.index') }}" wire:navigate>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                    <path fill-rule="evenodd" d="M14 8a.75.75 0 0 1-.75.75H4.56l3.22 3.22a.75.75 0 1 1-1.06 1.06l-4.5-4.5a.75.75 0 0 1 0-1.06l4.5-4.5a.75.75 0 0 1 1.06 1.06L4.56 7.25h8.69A.75.75 0 0 1 14 8Z" clip-rule="evenodd" />
                </svg>
                <span class="ms-2">{{__("Back")}}</span>
            </x-secondary-button-link>
        </x-slot>
    @endunless
    {{-- End | Client Card --}}

    <div class="mt-3 max-w-full mx-auto px-4 sm:px-6 lg:px-8 sm:flex items-center justify-between">
        <div class="font-medium text-zinc-700 dark:text-white">{{ $request->ulid }}</div>

        <div class="mt-3 sm:mt-0 flex items-center space-x-3">
            <div class="inline-flex items-center px-2 py-1 bg-zinc-100 dark:bg-zinc-700 rounded-full text-xs dark:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4 flex-none">
                    <path d="M2.87 2.298a.75.75 0 0 0-.812 1.021L3.39 6.624a1 1 0 0 0 .928.626H8.25a.75.75 0 0 1 0 1.5H4.318a1 1 0 0 0-.927.626l-1.333 3.305a.75.75 0 0 0 .811 1.022 24.89 24.89 0 0 0 11.668-5.115.75.75 0 0 0 0-1.175A24.89 24.89 0 0 0 2.869 2.298Z" />
                </svg>
                <span class="ms-1">{{ $request->created_at->format('M d, Y') }}</span>
            </div>
            @if ($request->due_at)
                <div class="inline-flex items-center px-2 py-1 bg-zinc-100 dark:bg-zinc-700 rounded-full text-xs dark:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4 flex-none">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 1 14 0A7 7 0 0 1 1 8Zm7.75-4.25a.75.75 0 0 0-1.5 0V8c0 .414.336.75.75.75h3.25a.75.75 0 0 0 0-1.5h-2.5v-3.5Z" clip-rule="evenodd" />
                    </svg>
                    <span class="ms-1">{{ $request->due_at->format('M d, Y') }}</span>
                </div>
            @endif
            @if ($request->completed_at)
                <div class="inline-flex items-center px-2 py-1 bg-green-100 text-green-900 dark:bg-green-700 rounded-full text-xs dark:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4 flex-none">
                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z" clip-rule="evenodd" />
                    </svg>
                    <span class="ms-1">{{ $request->completed_at->format('M d, Y') }}</span>
                </div>
            @endif
        </div>
    </div>

    <div class="block mt-3 max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-zinc-800 px-4 py-6 rounded-lg shadow overflow-hidden">
            <div class="prose dark:prose-invert max-w-full">
                {!! $request->message !!}
            </div>
        </div>
    </div>

    @if ($request->completed_at)
        <div class="block mt-6 max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="mb-6 text-lg font-medium dark:text-zinc-300">{{ __("Uploaded files") }}</h3>
            @forelse ($request->files as $file)
                <button wire:click="$dispatchTo('file.update', 'show-item', { id: {{ $file->id }} })" class="flex items-center justify-between w-full text-left rounded-lg p-3 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                    <div class="flex items-center space-x-3">
                        @if ($file->thumbnail)
                            <img src="{{ route('thumbnail', ['item' => $file]) }}" class="size-8 aspect-square rounded object-cover object-center shadow">
                        @else
                            <img src="{{ asset( config("internal.icons.{$file->mime}") ) }}">
                        @endif
                        <p class="text-zinc-700 dark:text-white text-sm">{{ $file->name }}</p>
                    </div>
                </button>
                @can('move', \App\Models\Item::class, Auth::user())
                    @if ($file->parent_id === $request->item_id)
                        <x-secondary-button wire:click="$dispatchTo('file.move', 'move-item', { client: {{ $client }}, item: {{ $file }} })">
                            {{ __("Move") }}
                        </x-secondary-link>
                    @endif
                @endcan
            @empty
            @endforelse
        </div>
    @endif

    @can ('complete', $request)
        <div class="block mt-6 max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            @livewire('upload-request.complete', ['request' => $request])
        </div>
    @endcan

    @can('delete', $request)
        <div class="block mt-6 max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            @livewire('upload-request.delete', ['request' => $request, 'client' => $client])
        </div>
    @endcan

    @livewire('file.update')

    @can('move', \App\Models\Item::class, Auth::user())
        @if ($file->parent_id === $request->item_id)
            @livewire('file.move')
        @endif
    @endcan
</div>
