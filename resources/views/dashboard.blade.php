<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 ">
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-xl sm:rounded-lg">
                @if (Auth::user()->is_client)
                    <x-welcome-client />
                @else
                    <x-welcome-provider />
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
