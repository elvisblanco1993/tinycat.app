<div>
    <x-slot name="header">
        <div class="flex items-center divide-x dark:divide-zinc-700">
            <x-tinycat.close-button href="{{ route('client.index') }}"/>

            <div class="pl-2 text-lg font-semibold">
                <h2>{{ $client->name }}</h2>
            </div>
        </div>

        <div class="flex items-center space-x-3">
            <x-tinycat.client-contact-card :phone="$client->phone"/>
            <x-tinycat.client-dropdown-menu :client="$client" />
        </div>
    </x-slot>

    <div class="my-12 max-w-5xl mx-auto">
        <div class="grid grid-cols-3 gap-8">
            <x-tinycat.client-files-button :client="$client" />
            <x-tinycat.client-tasks-button :client="$client" />
            <x-tinycat.client-messages-button :client="$client" />
        </div>
    </div>
</div>
