<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Clients') }}
        </h2>
        @can('create', \App\Models\Client::class)
            @livewire('client.create')
        @endcan
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <x-tinycat.search type="search" wire:model.live.debounce.250="search" placeholder="Search..." />
            </div>
            <div class="mt-3 relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                <x-input type="checkbox" wire:model.live="selectPage" />
                            </th>
                            <th scope="col" class="px-6 py-3">{{ __("ID") }}</th>
                            <th scope="col" class="px-6 py-3">{{ __("Name") }}</th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">{{ __("Edit") }}</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clients as $client)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-3">
                                    <x-input type="checkbox" wire:model.live="selected" value="{{ $client->id }}" />
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $client->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $client->name }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td colspan="3" class="px-6 py-3 text-center">
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
