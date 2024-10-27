<nav class="h-12 flex justify-between">
    <div class="flex space-x-3">
        <x-nav-link wire:navigate href="{{ route('file.index', ['client' => $client]) }}" :active="request()->routeIs('file.index*')">
            {{ __("Files") }}
        </x-nav-link>
        <x-nav-link wire:navigate href="{{ route('project.index', ['client' => $client]) }}" :active="request()->routeIs('project.index')">
            {{ __("Projects") }}
        </x-nav-link>
        <x-nav-link wire:navigate href="{{ route('upload-request.index', ['client' => $client]) }}" :active="request()->routeIs('upload-request.*')">
            {{ __("Requests") }}
        </x-nav-link>
    </div>
    <x-nav-link wire:navigate href="{{ route('client.update', ['client' => $client]) }}" :active="request()->routeIs('client.update*')">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
            <path fill-rule="evenodd" d="M6.455 1.45A.5.5 0 0 1 6.952 1h2.096a.5.5 0 0 1 .497.45l.186 1.858a4.996 4.996 0 0 1 1.466.848l1.703-.769a.5.5 0 0 1 .639.206l1.047 1.814a.5.5 0 0 1-.14.656l-1.517 1.09a5.026 5.026 0 0 1 0 1.694l1.516 1.09a.5.5 0 0 1 .141.656l-1.047 1.814a.5.5 0 0 1-.639.206l-1.703-.768c-.433.36-.928.649-1.466.847l-.186 1.858a.5.5 0 0 1-.497.45H6.952a.5.5 0 0 1-.497-.45l-.186-1.858a4.993 4.993 0 0 1-1.466-.848l-1.703.769a.5.5 0 0 1-.639-.206l-1.047-1.814a.5.5 0 0 1 .14-.656l1.517-1.09a5.033 5.033 0 0 1 0-1.694l-1.516-1.09a.5.5 0 0 1-.141-.656L2.46 3.593a.5.5 0 0 1 .639-.206l1.703.769c.433-.36.928-.65 1.466-.848l.186-1.858Zm-.177 7.567-.022-.037a2 2 0 0 1 3.466-1.997l.022.037a2 2 0 0 1-3.466 1.997Z" clip-rule="evenodd" />
        </svg>
        <span class="ms-1">{{__("Edit")}}</span>
    </x-nav-link>
</nav>
