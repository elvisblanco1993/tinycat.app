<div>
    <x-dropdown-button wire:click="$toggle('modal')">
        {{ __("Add to audience") }}
    </x-dropdown-button>

    @teleport('body')
    <x-dialog-modal wire:model="modal">
        <x-slot name="title">{{ __("Adding leads to audience") }}</x-slot>
        <x-slot name="content">
            @if ($audiences)
                <x-label for="audiences">{{ __("Select an audience") }}</x-label>
                <x-select id="audiences" wire:model="audience" class="mt-1 text-sm w-full">
                    <option>{{ __("Select an option") }}</option>
                    @forelse ($audiences as $audience)
                        <option value="{{ $audience->id }}">{{ $audience->name }}</option>
                    @empty
                        <option disabled>{{ __("No audiences yet. Create an audience to begin.") }}</option>
                    @endforelse
                </x-select>
                <x-input-error for="audience"/>
            @endif
            @if ($leads)
                <div class="mt-6">
                    <div class="block font-medium text-sm text-zinc-800 dark:text-zinc-300">
                        {{ __("The following leads will be added to the selected audience.")}}
                    </div>
                    <ul class="mt-1 px-2 py-0.5 border border-zinc-100 dark:border-zinc-700 rounded-lg max-h-40 overflow-y-auto">
                        @foreach ($leads as $lead)
                            <li class="py-1">{{ $lead->first_name . ' ' . $lead->last_name }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">{{ __("Cancel") }}</x-secondary-button>
            <x-button wire:click="save" wire:loading.attr.="disabled" wire:target="save" class="ms-4">
                <span wire:loading.remove wire:target="save">{{ __("Add leads") }}</span>
                <span wire:loading wire:target="save">{{ __("Adding...") }}</span>
            </x-button>
        </x-slot>
    </x-dialog-modal>
    @endteleport
</div>
