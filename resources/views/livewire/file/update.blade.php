<div>
    @if ($item)
    <x-drawer wire:model="drawer">
        <x-slot name="title"></x-slot>
        <x-slot name="content">
                @unless (str_starts_with($item->mime, 'audio/'))
                    <object data="{{ route('download', ['item' => $item]) }}" type="{{ $item->mime }}"
                        @class([
                            "w-full object-cover rounded-lg drop-shadow mx-auto bg-black",
                            "aspect-auto" => str_starts_with($item->mime, 'image/'),
                            "aspect-video" => str_starts_with($item->mime, 'video/'),
                            "aspect-square" => str_starts_with($item->mime, 'application/'),
                        ])
                    ></object>
                @else
                    <img src="{{ asset( config("internal.icons.{$item->mime}") ) }}" class="h-64 mx-auto">

                    <audio controls class="w-full rounded-lg"
                        x-ref="audioPlayer"
                        preload="none"
                        x-data="{ audioSrc: '' }"
                        @play="if (!audioSrc) { audioSrc = '{{ route('download', ['item' => $item]) }}'; $el.load(); }"
                    >
                        <template x-if="audioSrc">
                            <source :src="audioSrc" type="{{ $item->mime }}">
                        </template>
                    </audio>
                @endunless

                <div class="mt-4">
                    <span class="block font-medium text-sm text-zinc-700 dark:text-zinc-300">{{ __("Type") }}</span>
                    <div class="dark:text-zinc-100">{{ $item->mime }}</div>
                </div>
                <div class="mt-4">
                    <span class="block font-medium text-sm text-zinc-700 dark:text-zinc-300">{{ __("Size") }}</span>
                    <div class="dark:text-zinc-100">{{ $item->formatBytes($item->size) }}</div>
                </div>
                <div class="mt-4">
                    <span class="block font-medium text-sm text-zinc-700 dark:text-zinc-300">{{ __("Location") }}</span>
                    <div class="dark:text-zinc-100">{{ $item->parent?->name ?? '/' }}</div>
                </div>
                <div class="mt-4">
                    <span class="block font-medium text-sm text-zinc-700 dark:text-zinc-300">{{ __("Uploaded") }}</span>
                    <div class="dark:text-zinc-100">{{ $item->created_at->format('M d, Y h:i a') }}</div>
                </div>
                <div class="mt-4">
                    <span class="block font-medium text-sm text-zinc-700 dark:text-zinc-300">{{ __("Modified") }}</span>
                    <div class="dark:text-zinc-100">{{ $item->updated_at->format('M d, Y h:i a') }}</div>
                </div>

                <div class="mt-4 border-t dark:border-t-zinc-700"></div>

                <div class="mt-4">
                    <div class="flex items-center justify-between">
                        <x-label for="item-name">{{ __("Update Name") }}</x-label>
                        <div class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4 animate-spin" wire:loading wire:target="updateName">
                                <path fill-rule="evenodd" d="M13.836 2.477a.75.75 0 0 1 .75.75v3.182a.75.75 0 0 1-.75.75h-3.182a.75.75 0 0 1 0-1.5h1.37l-.84-.841a4.5 4.5 0 0 0-7.08.932.75.75 0 0 1-1.3-.75 6 6 0 0 1 9.44-1.242l.842.84V3.227a.75.75 0 0 1 .75-.75Zm-.911 7.5A.75.75 0 0 1 13.199 11a6 6 0 0 1-9.44 1.241l-.84-.84v1.371a.75.75 0 0 1-1.5 0V9.591a.75.75 0 0 1 .75-.75H5.35a.75.75 0 0 1 0 1.5H3.98l.841.841a4.5 4.5 0 0 0 7.08-.932.75.75 0 0 1 1.025-.273Z" clip-rule="evenodd" />
                            </svg>
                            <x-action-message on="saved-name">
                                {{ __('Saved.') }}
                            </x-action-message>
                        </div>
                    </div>
                    <x-input id="item-name" wire:model="name" wire:keydown.enter="updateName" class="mt-1 w-full" />
                    <small class="text-zinc-600 dark:text-zinc-400 text-xs">Press <kbd class="font-mono font-semibold p-0.5 text-zinc-900 dark:text-zinc-200 border dark:border-zinc-500 rounded">Enter</kbd> to save.</small>
                    <x-input-error for="name" />
                </div>

                <div class="mt-4">
                    <x-secondary-button-link href="{{ route('download', ['item' => $item]) }}" target="_blank" download>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                            <path fill-rule="evenodd" d="M5.5 17a4.5 4.5 0 0 1-1.44-8.765 4.5 4.5 0 0 1 8.302-3.046 3.5 3.5 0 0 1 4.504 4.272A4 4 0 0 1 15 17H5.5Zm5.25-9.25a.75.75 0 0 0-1.5 0v4.59l-1.95-2.1a.75.75 0 1 0-1.1 1.02l3.25 3.5a.75.75 0 0 0 1.1 0l3.25-3.5a.75.75 0 1 0-1.1-1.02l-1.95 2.1V7.75Z" clip-rule="evenodd" />
                        </svg>
                        <span class="ms-2">{{ __("Download") }}</span>
                    </x-secondary-button-link>
                </div>
            </x-slot>
    </x-drawer>
    @endif
</div>
