<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">
            {{ __('Audiences') }}
        </h2>
        @can('create', \App\Models\Audience::class)
            <div class="flex items-center space-x-4">
                @livewire('audience.create')
            </div>
        @endcan
    </x-slot>

    <div class="py-6">
        <ul class="divide-y dark:divide-zinc-700">
            @forelse ($audiences as $audience)
                <li>
                    <a wire:navigate href="{{ route('audience.show', ['audience' => $audience]) }}">
                        <div class="flex items-center justify-between p-2 hover:bg-zinc-50 dark:hover:bg-zinc-800">
                            <div class="flex items-center">
                                <div class="text-zinc-700 dark:text-zinc-300">{{ $audience->name }}</div>
                                <x-badge class="ms-3">
                                    {{ $audience->leads_count . __(" leads") }}
                                </x-badge>
                            </div>
                        </div>
                    </a>
                </li>
            @empty
                <li class="dark:text-white bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg w-full px-4 py-16">
                    <div class="max-w-xl mx-auto text-center prose">
                        <h3>{{ __("You don't have any audiences yet") }}</h3>
                        <p>{{ __("Audiences let you organize similar contacts into groups, making it easier to send them messages that are more relevant.") }}</p>
                    </div>
                </li>
            @endforelse
        </ul>
    </div>
</div>
