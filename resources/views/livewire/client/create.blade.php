<div>
    <x-button wire:click="$toggle('modal')">
        {{__("New client")}}
    </x-button>

    <x-dialog-modal wire:model="modal" maxWidth="lg">
        <x-slot name="title">{{ __("New client") }}</x-slot>
        <x-slot name="content">
            <div>
                <x-label for="name">{{ __("Business name") }}</x-label>
                <x-input id="name" type="text" wire:model="name" wire:keydown.enter="save" placeholder="Acme Inc." class="w-full mt-2" autocomplete="false" />
                <x-input-error for="name" />
                <small class="text-xs text-zinc-700 dark:text-zinc-300">
                    {{ __("Enter the full legal or trade name of the business. This is how the client will be identified in the system.") }}
                </small>
            </div>

            <div class="mt-6">
                <x-label for="business_type">{{ __("Business Entity Type") }}</x-label>
                <x-select id="business_type" wire:model="business_type" class="mt-2 w-full">
                    @forelse (config('internal.business_types') as $key => $type)
                        <option value="{{ $key }}">{{ $type }}</option>
                    @empty
                    @endforelse
                </x-select>
                <x-input-error for="business_type" />
                <small class="text-xs text-zinc-700 dark:text-zinc-300">
                    {{ __("Select the legal structure of the business. This information helps us keep your records accurate.") }}
                </small>
            </div>

            <div class="mt-6">
                <x-label for="owner_name">{{ __("Owner's Full Name") }}</x-label>
                <x-input id="owner_name" type="text" wire:model="owner_name" wire:keydown.enter="save" placeholder="James Johnson" class="w-full mt-2" autocomplete="false" />
                <x-input-error for="owner_name" />
                <small class="text-xs text-zinc-700 dark:text-zinc-300">
                    {{ __("Provide the full name of the primary owner or manager of this business. This will be used for direct communication.") }}
                </small>
            </div>
            <div class="mt-6">
                <x-label for="owner_email">{{ __("Owner's Email Address") }}</x-label>
                <x-input id="owner_email" type="email" wire:model="owner_email" wire:keydown.enter="save" placeholder="email@example.com" class="w-full mt-2" autocomplete="false" />
                <small class="text-xs text-zinc-700 dark:text-zinc-300">{{ __("Enter the email address of the business owner. This is where login credentials and important communications will be sent. Make sure it's correct and active.") }}</small>
                <x-input-error for="owner_email" />
            </div>

            {{-- <div class="mt-6">
                <x-label for="filesystem">{{ __("Select a File Organization Template") }}</x-label>
                <x-select id="filesystem" wire:model="filesystem" class="mt-2 w-full">
                    @forelse ($itemTemplates as $template)
                        <option value="{{ $template->id }}">{{ $template->name }}</option>
                    @empty
                    @endforelse
                </x-select>
                <small class="text-xs text-zinc-700 dark:text-zinc-300">{{ __("Choose from our preset templates to automatically organize folders for this client. Templates can be customized later to fit specific needs.") }}</small>
                <x-input-error for="filesystem" />
            </div> --}}
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">{{ __("Cancel") }}</x-secondary-button>
            <x-button wire:click="save" class="ms-4">{{ __("Create") }}</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
