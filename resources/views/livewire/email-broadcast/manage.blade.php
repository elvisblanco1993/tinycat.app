<div>
    <header class="header-container">
        <div class="header">
            <input type="text" wire:model.blur="name" class="!appearance-none font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight w-1/2 bg-transparent border-none ring-0" />
            @can('create', \App\Models\EmailBroadcast::class)
                <div class="flex items-center space-x-4">
                    <x-button wire:click="send">
                        <span class="{{ $send_at ? 'hidden' : 'block' }}">{{ __("Send") }}</span>
                        <span class="{{ !$send_at ? 'hidden' : 'block' }}">{{ __("Schedule") }}</span>
                    </x-button>
                </div>
            @endcan
        </div>
    </header>

    <div class="py-6 dark:text-white gap-1">
        <div class="flex items-center gap-2 border-b border-b-zinc-200 dark:border-b-zinc-700">
            <x-label for="" class="w-16">{{ __("Reply-To") }}</x-label>
            <input type="text" placeholder="mail@example.com" class="!appearance-none bg-none bg-transparent border-none ring-0 text-sm">
        </div>
        <div class="mt-2 flex items-center gap-2 border-b border-b-zinc-200 dark:border-b-zinc-700">
            <x-label for="" class="w-16">{{ __("To") }}</x-label>
            <select wire:model.live="audience" name="" id=""
            @class([
                'appearance-none bg-none bg-transparent min-w-44 border-none ring-0 text-sm',
                'text-gray-500' => !$audience
            ])>
                <option value="" selected>{{ __("Select an audience") }}</option>
                @forelse ($audience_list as $option)
                    <option value="{{$option->id}}">{{ $option->name }}</option>
                @empty
                @endforelse
            </select>
        </div>

        <div class="mt-2 flex items-center gap-2 border-b border-b-zinc-200 dark:border-b-zinc-700">
            <x-label for="" class="w-16">{{ __("When") }}</x-label>
            <input type="datetime-local" wire:model.live.debounce.250="send_at" @class(['!appearance-none bg-none bg-transparent border-none ring-0 text-sm', 'text-gray-500' => !$send_at])>
        </div>

        <div class="mt-2 flex items-center gap-2 border-b border-b-zinc-200 dark:border-b-zinc-700">
            <x-label for="preview" class="w-16">{{ __("Preview") }}</x-label>
            <input id="preview" type="text" wire:model.live.debounce.250="preview" class="!appearance-none w-full bg-none bg-transparent border-none ring-0 text-sm">
        </div>

        <div class="mt-2 flex items-center gap-2 border-b border-b-zinc-200 dark:border-b-zinc-700">
            <x-label for="subject" class="w-16">{{ __("Subject") }}</x-label>
            <input id="subject" type="text" wire:model.live.debounce.250="subject" class="!appearance-none w-full bg-none bg-transparent border-none ring-0 text-sm">
        </div>

        <div class="mt-4">
            <x-editor wire:model.blur="message" />
        </div>
    </div>
</div>
