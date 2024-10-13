<nav class="h-12 flex space-x-3">
    <x-nav-link href="{{ route('client.files', ['client' => $client]) }}" :active="request()->routeIs('client.files')">
        {{ __("Files") }}
    </x-nav-link>
    <x-nav-link href="{{ route('client.forms', ['client' => $client]) }}" :active="request()->routeIs('client.forms')">
        {{ __("Forms") }}
    </x-nav-link>
    <x-nav-link href="{{ route('client.tasks', ['client' => $client]) }}" :active="request()->routeIs('client.tasks')">
        {{ __("Tasks") }}
    </x-nav-link>
    <x-nav-link href="{{ route('client.reminders', ['client' => $client]) }}" :active="request()->routeIs('client.reminders')">
        {{ __("Reminders") }}
    </x-nav-link>
</nav>
