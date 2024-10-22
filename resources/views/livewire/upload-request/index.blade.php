<div>
    {{-- Client Card --}}
    @include('partials.client.profile')
    {{-- End | Client Card --}}

    <div class="mt-3 max-w-full mx-auto px-4 sm:px-6 lg:px-8 flex justify-end">
        @can('create', \App\Models\Request::class)
            @livewire('upload-request.create', ['client' => $client])
        @endcan
    </div>

    <div class="mt-3 max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">{{ __("ID") }}</th>
                        <th scope="col" class="px-6 py-3">{{ __("Completed at") }}</th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">{{ __("Edit") }}</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse ($requests as $req)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-normal whitespace-nowrap">
                                {{ $req->ulid }}
                            </th>
                            <th class="px-6 py-4 font-normal">
                                <span @class([
                                    'px-3 py-1 rounded-full bg-amber-100 text-amber-900' => !$req->completed_at,
                                    'px-3 py-1 rounded-full bg-green-100 text-green-900' => $req->completed_at,
                                ])>
                                    {{ $req->completed_at?->format('M d Y') ?? __('Pending') }}
                                </span>
                            </th>
                            <td class="px-6 py-4 text-right">
                                <x-secondary-button-link href="" wire:navigate>
                                    {{ __("View") }}
                                </x-secondary-button-link>
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td colspan="3" class="px-6 py-3 text-center">
                                {{ __("No requests found.") }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
