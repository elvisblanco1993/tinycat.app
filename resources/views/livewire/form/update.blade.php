<div>
    <x-secondary-button wire:click="$toggle('modal')">
        {{ __("Form settings") }}
    </x-secondary-button>

    <x-dialog-modal wire:model="modal" maxWidth="md">
        <x-slot name="title">
            {{__("Forms settings")}}
        </x-slot>
        <x-slot name="content">
            <div>
                <x-label for='title'>{{ __("Title") }}</x-label>
                <x-input id="title" type="text" wire:model="title" class="mt-2 w-full" />
                <x-input-error for="title" />
            </div>
            <div class="mt-4">
                <x-label for='slug'>{{ __("Slug") }}</x-label>
                <x-input id="slug" type="text" wire:model.live.debounce.250="slug" class="mt-2 w-full" />
                <small class="block mt-1 text-gray-500 dark:text-gray-400">{{ config('app.url') }}/{{ Auth::user()->currentTeam->id }}/{{ $slug }}</small>
                <small class="block mt-1 text-gray-500 dark:text-gray-400">{{ __("You can update your team URL slug in") }} <a href="{{ route('teams.show', ['team' => Auth::user()->currentTeam]) }}" class="underline text-indigo-600 dark:text-indigo-500">Team Settings</a></small>
                <x-input-error for="slug" />
            </div>
            <div class="mt-4">
                <x-label for='status'>{{ __("Status") }}</x-label>
                <x-select id="status" wire:model="status" class="mt-2 w-full">
                    <option value="DRAFT">{{ __("Draft")}}</option>
                    <option value="PUBLISHED">{{ __("Published")}}</option>
                    <option value="CLOSED">{{ __("Closed")}}</option>
                </x-select>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">{{ __("Discard") }}</x-secondary-button>
            <x-button wire:click="save" class="ms-4">{{ __("Save changes") }}</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
