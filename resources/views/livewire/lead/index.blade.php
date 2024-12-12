<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">
            {{ __('Leads') }}
        </h2>
        @can('create', \App\Models\Lead::class)
            <div class="flex items-center space-x-4">
                @livewire('lead.import')
            </div>
        @endcan
    </x-slot>

    <div class="py-6">
        <div class="flex items-center justify-between">
            <x-tinycat.search type="search" wire:model.live.debounce.250="search" placeholder="Search..." class="text-sm" />

            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <x-secondary-button x-cloak x-bind:disabled="{{ count($selected) < 1 }}">{{ __("Bulk actions") }}</x-secondary-button>
                </x-slot>
                <x-slot name="content">
                    @livewire('audience.add-leads')
                    @livewire('lead.delete')
                </x-slot>
            </x-dropdown>
        </div>
        <div class="mt-6 relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
                <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <x-checkbox wire:model.live="select_page" />
                        </th>
                        <th scope="col" class="px-6 py-3">{{ __("ID") }}</th>
                        <th scope="col" class="px-6 py-3">{{ __("Full name") }}</th>
                        <th scope="col" class="px-6 py-3">{{ __("Company name") }}</th>
                        <th scope="col" class="px-6 py-3">{{ __("Email") }}</th>
                        <th scope="col" class="px-6 py-3">{{ __("Phone") }}</th>
                        {{-- <th scope="col" class="px-6 py-3">
                            <span class="sr-only">{{ __("Edit") }}</span>
                        </th> --}}
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @if ($select_page)
                        <tr class="">
                            <td colspan="100%" class="px-6 py-2 bg-yellow-100 dark:bg-zinc-900/50 dark:text-yellow-500">
                                @unless ($select_all)
                                    <span>You have selected <strong>{{ $leads->count() }}</strong> leads. Do you want to select all <strong>{{ $leads->total() }}</strong>?</span>
                                    <button wire:click="selectAll" class="ml-1 text-blue-600">Select all</button>
                                @else
                                    <span>You have selected all <strong>{{ $leads->total() }}</strong> leads.</span>
                                @endunless
                            </td>
                        </tr>
                    @endif
                    @forelse ($leads as $lead)
                        <tr class="bg-white border-b dark:bg-zinc-800 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-600">
                            <td class="px-6 py-4">
                                <x-checkbox wire:model.live="selected" value="{{ $lead->id }}" />
                            </td>
                            <td class="px-6 py-4">
                                {{ $lead->id }}
                            </td>
                            <td class="px-6 py-4">{{ $lead->first_name . ' ' . $lead->last_name}}</td>
                            <td class="px-6 py-4" title="{{ $lead->company_name }}">{{ str($lead->company_name)->limit(30) }}</td>
                            <td class="px-6 py-4">{{ $lead->email }}</td>
                            <td class="px-6 py-4">{{ phone($lead->phone, 'US') }}</td>
                        </tr>
                    @empty
                        <tr class="bg-white border-b dark:bg-zinc-800 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-600">
                            <td colspan="100%" class="px-6 py-3 text-center">
                                {{ __("No leads found.") }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">{!! $leads->links() !!}</div>
    </div>
</div>
