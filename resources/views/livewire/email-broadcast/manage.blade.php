<div>
    <header class="header-container">
        <div class="header">
            <input type="text" wire:model="title" class="!appearance-none font-semibold text-lg pl-0 text-zinc-800 dark:text-zinc-200 leading-tight w-1/2 bg-transparent border-none ring-0" />
            @can('create', \App\Models\EmailBroadcast::class)
                <div class="flex items-center space-x-4">
                    <x-action-message on="saved">{{ __("Saved!") }}</x-action-message>
                    <x-secondary-button wire:click="save">{{ __("Save draft") }}</x-secondary-button>
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
            <input type="text" wire:model="reply_to" placeholder="mail@example.com" class="!appearance-none bg-none bg-transparent border-none ring-0 text-sm">
        </div>
        <div class="mt-2 flex items-center gap-2 border-b border-b-zinc-200 dark:border-b-zinc-700">
            <x-label for="" class="w-16">{{ __("To") }}</x-label>
            <select wire:model="audience_id"
                @class([
                    'appearance-none bg-none bg-transparent min-w-44 border-none ring-0 text-sm',
                    'text-gray-500' => !$audience_id
                ])>
                <option value="" selected>
                    @if (count($audience_list) > 0)
                        {{ __("Select an audience") }}
                    @else
                        {{ __("You have no audiences yet") }}
                    @endif
                </option>
                @forelse ($audience_list as $option)
                    <option value="{{$option->id}}">{{ $option->name }}</option>
                @empty
                @endforelse
            </select>
            <x-input-error for="audience_id" />
        </div>

        <div class="mt-2 flex items-center gap-2 border-b border-b-zinc-200 dark:border-b-zinc-700">
            <x-label for="" class="w-16">{{ __("When") }}</x-label>
            <input type="datetime-local" min="{{now()->toDateTimeLocalString()}}" wire:model="send_at" @class(['!appearance-none bg-none bg-transparent border-none ring-0 text-sm', 'text-gray-500' => !$send_at])>
        </div>

        <div class="mt-2 flex items-center gap-2 border-b border-b-zinc-200 dark:border-b-zinc-700">
            <x-label for="preview" class="w-16">{{ __("Preview") }}</x-label>
            <input id="preview" type="text" wire:model="preview" class="!appearance-none w-full bg-none bg-transparent border-none ring-0 text-sm">
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
