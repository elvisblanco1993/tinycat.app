<div>
    <x-slot name="header">
        @unless (Auth::user()->is_client)
            <div class="flex items-center divide-x dark:divide-zinc-700">
                <x-tinycat.close-button href="{{ route('client.index') }}"/>

                <div class="pl-2 text-lg font-semibold">
                    <h2>
                        <a href="{{ route('client.show', ['client' => $client]) }}"
                            wire:navigate
                            class="text-blue-500 hover:underline"
                            >{{ $client->name }}</a>
                        <span>/ {{ __("Update details") }}</span>
                    </h2>
                </div>
            </div>
        @else
            <h2 class="text-lg font-semibold">
                {{ __("Update details") }}
            </h2>
        @endunless

        <div class="flex items-center space-x-3">
            <x-tinycat.client-contact-card :phone="$client->phone"/>
            <x-tinycat.client-dropdown-menu :client="$client" />
        </div>
    </x-slot>

    <div class="my-12 max-w-5xl mx-auto">
        <div class="bg-white dark:bg-zinc-800 dark:text-white rounded-lg shadow-sm overflow-hidden">
            <div class="px-4 border-b dark:border-b-zinc-700 h-12 flex space-x-3">
                <x-nav-button wire:click="$set('navigate', 'business-details')" :active="$navigate === 'business-details'">
                    {{ __("Business") }}
                </x-nav-button>
                <x-nav-button wire:click="$set('navigate', 'address')" :active="$navigate === 'address'">
                    {{ __("Address") }}
                </x-nav-button>
            </div>
            <form wire:submit.prevent="save">
                @csrf
                <div class="px-4 py-6">
                    @if ($navigate === 'business-details')
                        <div class="block md:flex items-center gap-8">
                            <x-label for="name" class="md:mt-1 w-full md:w-1/6">{{ __("Business name") }}</x-label>
                            <x-input id="name" type="text" wire:model="name" class="md:mt-1 w-full md:w-1/2" />
                            <x-input-error for="name" />
                        </div>
                        <div class="mt-6 block md:flex items-center gap-8">
                            <x-label for="dba" class="md:mt-1 w-full md:w-1/6">{{ __("DBA (optional)") }}</x-label>
                            <x-input id="dba" type="text" wire:model="dba" class="md:mt-1 w-full md:w-1/2" />
                            <x-input-error for="dba" />
                        </div>
                        <div class="mt-6 block md:flex items-center gap-8">
                            <x-label for="itin" class="md:mt-1 w-full md:w-1/6">{{ __("ITIN") }}</x-label>
                            <x-input id="itin" type="text" wire:model="itin" class="md:mt-1 w-full md:w-1/2" />
                            <x-input-error for="itin" />
                        </div>
                        <div class="mt-6 block md:flex items-center gap-8">
                            <x-label for="business_type" class="md:mt-1 w-full md:w-1/6">{{ __("Business type") }}</x-label>
                            <x-select id="business_type" wire:model="business_type" class="md:mt-1 w-full md:w-1/2">
                                @forelse (config('internal.business_types') as $key => $type)
                                    <option value="{{ $key }}">{{ $type }}</option>
                                @empty
                                @endforelse
                            </x-select>
                            <x-input-error for="business_type" />
                        </div>
                        <div class="mt-6 block md:flex items-center gap-8">
                            <x-label for="phone" class="md:mt-1 w-full md:w-1/6">{{ __("Main phone") }}</x-label>
                            <x-input id="phone" type="tel" wire:model="phone" class="md:mt-1 w-full md:w-1/2" />
                            <x-input-error for="phone" />
                        </div>
                        <div class="mt-6 block md:flex items-center gap-8">
                            <x-label for="email" class="md:mt-1 w-full md:w-1/6">{{ __("Main email") }}</x-label>
                            <x-input id="email" type="email" wire:model="email" class="md:mt-1 w-full md:w-1/2" />
                            <x-input-error for="email" />
                        </div>
                    @endif
                    @if ($navigate === 'address')
                        <div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-3 md:col-span-2">
                                    <x-label for="address">{{ __("Postal address") }}</x-label>
                                    <x-input id="address" type="text" wire:model="address" class="mt-1 w-full"/>
                                    <x-input-error for="address" />
                                </div>
                                <div class="col-span-3 md:col-span-1">
                                    <x-label for="address_ext">{{ __("Postal address ext.") }}</x-label>
                                    <x-input id="address_ext" type="text" wire:model="address_ext" class="mt-1 w-full"/>
                                    <x-input-error for="address_ext" />
                                </div>
                                <div class="col-span-3 md:col-span-1">
                                    <x-label for="city">{{ __("City") }}</x-label>
                                    <x-input id="city" type="text" wire:model="city" class="mt-1 w-full"/>
                                    <x-input-error for="city" />
                                </div>
                                <div class="col-span-3 md:col-span-1">
                                    <x-label for="state">{{ __("State") }}</x-label>
                                    <x-input id="state" type="text" wire:model="state" class="mt-1 w-full"/>
                                    <x-input-error for="state" />
                                </div>
                                <div class="col-span-3 md:col-span-1">
                                    <x-label for="zip">{{ __("Postal code (Zip)") }}</x-label>
                                    <x-input id="zip" type="text" wire:model="zip" class="mt-1 w-full"/>
                                    <x-input-error for="zip" />
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="p-4 bg-zinc-100 dark:bg-zinc-700 flex items-center justify-end">
                    <x-action-message class="me-3" on="saved">
                        {{ __('Saved.') }}
                    </x-action-message>
                    <x-button>
                        {{ __("Save changes") }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
