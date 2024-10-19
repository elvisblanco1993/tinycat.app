<nav class="h-12 flex space-x-3">
    <x-nav-link wire:navigate href="{{ route('client.files', ['client' => $client]) }}" :active="request()->routeIs('client.files*')">
        {{ __("Files") }}
    </x-nav-link>
    <x-nav-link wire:navigate href="{{ route('client.projects', ['client' => $client]) }}" :active="request()->routeIs('client.projects')">
        {{ __("Projects") }}
    </x-nav-link>
    <x-nav-link wire:navigate href="{{ route('client.requests', ['client' => $client]) }}" :active="request()->routeIs('client.requests')">
        {{ __("Requests") }}
    </x-nav-link>
</nav>
