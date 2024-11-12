<div>
    @unless (Auth::user()->is_client)
        @include('partials.client.profile')
    @else
    <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200">
        {{ __("Upload requests") }}
    </h2>
    @endunless

    <div class="mt-6 flex justify-between">
        <x-tinycat.search type="search" wire:model.live.debounce.250="search" placeholder="Search..." class="text-sm" />
        @can('create', \App\Models\Request::class)
            @livewire('upload-request.create', ['client' => $client])
        @endcan
    </div>

    <div class="mt-6">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
                <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">{{ __("ID") }}</th>
                        <th scope="col" class="px-6 py-3">{{ __("Due date") }}</th>
                        <th scope="col" class="px-6 py-3">{{ __("Completed on") }}</th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">{{ __("Edit") }}</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse ($requests as $req)
                        <tr class="bg-white border-b dark:bg-zinc-800 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-600">
                            <th scope="row" class="px-6 py-4 font-normal whitespace-nowrap">
                                {{ $req->ulid }}
                            </th>
                            <td class="px-6 py-4">
                                <span @class(['px-3 py-1 rounded-full', 'bg-red-100 text-red-900' => $req->due_at && $req->due_at <= today()])>
                                    {{ $req->due_at?->format('M d Y') ?? 'No due date' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span @class([
                                    'px-3 py-1 rounded-full bg-zinc-100 text-zinc-900' => !$req->completed_at,
                                    'px-3 py-1 rounded-full bg-green-100 text-green-900' => $req->completed_at,
                                ])>
                                    {{ $req->completed_at?->format('M d Y') ?? __('Pending') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <x-secondary-button-link href="{{ route('upload-request.show', ['client' => $client, 'request' => $req]) }}" wire:navigate>
                                    {{ __("View") }}
                                </x-secondary-button-link>
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-white border-b dark:bg-zinc-800 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-600">
                            <td colspan="4" class="px-6 py-3 text-center">
                                {{ __("No requests found at this time.") }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $requests->links() }}
        </div>
    </div>
</div>
