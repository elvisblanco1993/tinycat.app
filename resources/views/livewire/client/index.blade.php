<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Clients') }}
        </h2>
        @can('create', \App\Models\Client::class)
            @livewire('client.create')
        @endcan
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <x-tinycat.search type="search" wire:model.live.debounce.250="search" placeholder="Search..." class="text-sm" />

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <x-secondary-button x-cloak x-bind:disabled="{{count($selected) < 1}}">{{ __("Bulk actions") }}</x-secondary-button>
                    </x-slot>
                    <x-slot name="content">
                        <livewire:client.export />
                        <livewire:client.delete />
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="mt-3 relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-left rtl:text-right text-slate-500 dark:text-slate-400">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-700 dark:text-slate-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                <x-input type="checkbox" wire:model.live="select_page" />
                            </th>
                            <th scope="col" class="px-6 py-3">{{ __("ID") }}</th>
                            <th scope="col" class="px-6 py-3">{{ __("Client") }}</th>
                            <th scope="col" class="px-6 py-3">{{ __("Contact Person") }}</th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">{{ __("Edit") }}</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @if ($select_page)
                            <tr class="">
                                <td colspan="5" class="px-6 py-2 bg-yellow-100 text-black">
                                    @unless ($select_all)
                                        <span>You have selected <strong>{{ $clients->count() }}</strong> clients. Do you want to select all <strong>{{ $clients->total() }}</strong>?</span>
                                        <button wire:click="selectAll" class="ml-1 text-blue-600">Select all</button>
                                    @else
                                        <span>You have selected all <strong>{{ $clients->total() }}</strong> clients.</span>
                                    @endunless
                                </td>
                            </tr>
                        @endif
                        @forelse ($clients as $client)
                            <tr class="bg-white border-b dark:bg-slate-800 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600">
                                <td class="px-6 py-3">
                                    <x-input type="checkbox" wire:model.live="selected" value="{{ $client->id }}" />
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap dark:text-white">
                                    {{ $client->id }}
                                </th>
                                <td scope="row" class="px-6 py-4">
                                    {{ $client->name }}
                                </td>
                                <td class="px-6 py-4">
                                    <div>{{ $client->owner->name }}</div>
                                    <div class="text-xs">{{ $client->owner->email }}</div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <x-secondary-button-link href="{{ route('client.show', ['client' => $client->id]) }}" wire:navigate>
                                        {{ __("View") }}
                                    </x-secondary-button-link>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white border-b dark:bg-slate-800 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600">
                                <td colspan="5" class="px-6 py-3 text-center">
                                    {{ __("No clients found.") }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6">{!! $clients->links() !!}</div>
        </div>
    </div>
</div>
