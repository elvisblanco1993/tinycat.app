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
                {{ $audience->leads_count . __(" leads") }}
            </x-badge>
        </div>
    </x-slot>

    <div class="py-6">
        <ul class="divide-y dark:divide-zinc-700">
            @forelse ($leads as $lead)
                <li class="flex items-center justify-between p-2 hover:bg-zinc-50 dark:hover:bg-zinc-800">
                    <div class="flex items-center">
                        <div class="text-zinc-700 dark:text-zinc-300">{{ $lead->full_name }}</div>
                        <x-badge class="ms-3">
                            {{ $audience->leads_count . __(" leads") }}
                        </x-badge>
                    </div>
                </li>
            @empty
                <li class="dark:text-white bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg w-full px-4 py-16">
                    <div class="max-w-xl mx-auto text-center prose">
                        <h3>{{ __("This audience currently has no leads") }}</h3>
                        <p>{{ __("Add leads to organize and engage with this audience effectively.") }}</p>
                    </div>
                </li>
            @endforelse
        </ul>
    </div>
</div>
