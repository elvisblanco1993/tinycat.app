<x-app-layout>
    <div class="py-6">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-xl sm:rounded-lg">
                @if (Auth::user()->is_client)
                    <x-welcome-client />
                @else
                    <x-welcome-provider />
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
