<div>
    <x-slot name="header">
        <div class="flex items-center divide-x dark:divide-zinc-700">
            <x-tinycat.close-button href="{{ route('audience.index') }}"/>

            <div class="pl-2 text-lg font-semibold flex items-center gap-2">
                <h2>{{ $audience->name }}</h2>
                <x-dropdown>
                    <x-slot name="trigger">
                        <x-trigger-button>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>
                        </x-trigger-button>
                    </x-slot>
                    <x-slot name="content">
                        @livewire('audience.update', ['audience' => $audience])
                        @livewire('audience.delete', ['audience' => $audience])
                    </x-slot>
                </x-dropdown>
            </div>
        </div>

        <div class="">
            <x-badge class="ms-3">
                {{ $audience->leads->count() . __(" leads") }}
            </x-badge>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="flex items-center justify-between">
            <x-tinycat.search type="search" wire:model.live.debounce.250="search" placeholder="Search..." class="text-sm" />
        </div>
        @if ($audience->leads->count() > 0)
            <div class="mt-6 relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
                    <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">{{ __("Name") }}</th>
                            <th scope="col" class="px-6 py-3">{{ __("Email") }}</th>
                            <th scope="col" class="px-6 py-3">{{ __("Company") }}</th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">{{ __("Edit") }}</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse ($leads as $lead)
                            <tr class="bg-white border-b dark:bg-zinc-800 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-600">
                                <td scope="row" class="px-6 py-4">
                                    {{ $lead->full_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $lead->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ str($lead->company_name)->limit(30) }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    {{--  --}}
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6">{!! $leads->links() !!}</div>
        @else
            <div class="my-6 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg w-full px-4 py-16">
                <div class="max-w-xl mx-auto text-center prose dark:prose-invert">
                    <h3>{{ __("This audience currently has no leads") }}</h3>
                    <p>{{ __("Add leads to organize and engage with this audience effectively.") }}</p>
                </div>
            </div>
        @endif
    </div>
</div>
