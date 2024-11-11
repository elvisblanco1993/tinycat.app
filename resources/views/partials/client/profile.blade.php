<x-slot name="header">
    <x-secondary-button-link href="{{ route('client.index') }}" wire:navigate>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
            <path fill-rule="evenodd" d="M14 8a.75.75 0 0 1-.75.75H4.56l3.22 3.22a.75.75 0 1 1-1.06 1.06l-4.5-4.5a.75.75 0 0 1 0-1.06l4.5-4.5a.75.75 0 0 1 1.06 1.06L4.56 7.25h8.69A.75.75 0 0 1 14 8Z" clip-rule="evenodd" />
        </svg>
        <span class="ms-2">{{__("Back")}}</span>
    </x-secondary-button-link>
</x-slot>

<div class="py-6 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-zinc-800 dark:text-white rounded-lg shadow overflow-hidden">
        <div class="p-4">
            <div class="font-semibold text-lg">{{ $client->name }}</div>

            <div @class(["mt-2 text-zinc-500 dark:text-zinc-300 flex items-center space-x-4 text-sm" => ($client->phone || $client->billing_email)])>
                @if ($client->phone)
                    <a href="tel:{{$client->phone}}" class="flex items-center space-x-1 hover:text-blue-600 dark:hover:text-white transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                            <path fill-rule="evenodd" d="m3.855 7.286 1.067-.534a1 1 0 0 0 .542-1.046l-.44-2.858A1 1 0 0 0 4.036 2H3a1 1 0 0 0-1 1v2c0 .709.082 1.4.238 2.062a9.012 9.012 0 0 0 6.7 6.7A9.024 9.024 0 0 0 11 14h2a1 1 0 0 0 1-1v-1.036a1 1 0 0 0-.848-.988l-2.858-.44a1 1 0 0 0-1.046.542l-.534 1.067a7.52 7.52 0 0 1-4.86-4.859Z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ $client->phone }}</span>
                    </a>
                @endif
                @if ($client->email)
                    <a href="mailto:{{$client->billing_email}}" class="flex items-center space-x-1 hover:text-blue-600 dark:hover:text-white transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                            <path d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                            <path d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                        </svg>
                        <span>{{ $client->email }}</span>
                    </a>
                @endif
            </div>
        </div>

        <div class="px-4 border-t-2 border-zinc-100 dark:border-zinc-700">
            @include('partials.client.nav')
        </div>
    </div>
</div>
