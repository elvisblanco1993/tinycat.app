<div>
    <x-button wire:click="$toggle('modal')">
        {{__("New client")}}
    </x-button>

    <x-dialog-modal wire:model="modal" maxWidth="lg">
        <x-slot name="title">{{ __("New client") }}</x-slot>
        <x-slot name="content">
            <div>
                <x-label for="name">{{ __("Organization name") }}</x-label>
                <x-input id="name" type="text" wire:model="name" wire:keydown.enter="save" placeholder="Acme Inc." class="w-full mt-1" autocomplete="false" />
                <x-input-error for="name" />
            </div>

            <div class="mt-4">
                <x-label for="business_type">{{ __("Select business type") }}</x-label>
                <x-select id="business_type" wire:model="business_type" class="mt-1 w-full">
                    @forelse (config('internal.business_types') as $key => $type)
                        <option value="{{ $key }}">{{ $type }}</option>
                    @empty
                    @endforelse
                </x-select>
                <x-input-error for="business_type" />
            </div>

            <div class="mt-4">
                <x-label for="owner_name">{{ __("Owner's name") }}</x-label>
                <x-input id="owner_name" type="text" wire:model="owner_name" wire:keydown.enter="save" placeholder="James Johnson" class="w-full mt-1" autocomplete="false" />
                <x-input-error for="owner_name" />
            </div>
            <div class="mt-4">
                <x-label for="owner_email">{{ __("Owner's email") }}</x-label>
                <x-input id="owner_email" type="email" wire:model="owner_email" wire:keydown.enter="save" placeholder="email@example.com" class="w-full mt-1" autocomplete="false" />
                <small class="text-xs text-slate-700 dark:text-slate-300">{{ __("Login credentials will be sent to this email address.") }}</small>
                <x-input-error for="owner_email" />
            </div>

            <div class="mt-4">
                <x-label for="filesystem">{{ __("Select File Organization Template") }}</x-label>
                <x-select id="filesystem" wire:model="filesystem" class="mt-1 w-full">
                    @forelse ($itemTemplates as $template)
                        <option value="{{ $template->id }}">{{ $template->name }}</option>
                    @empty
                    @endforelse
                </x-select>
                <small class="text-xs text-slate-700 dark:text-slate-300">{{ __("Choose a template, and we'll automatically set up all the folders for you.") }}</small>
                <x-input-error for="filesystem" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">{{ __("Cancel") }}</x-secondary-button>
            <x-button wire:click="save" class="ms-4">{{ __("Create") }}</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
