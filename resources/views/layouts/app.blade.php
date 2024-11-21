<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-zinc-100 dark:bg-zinc-900">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:100,200,300,400,500,600,700,800,900" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased min-h-screen w-full flex flex-col" x-data="themeSwitcher()" :class="{ 'dark': switchOn }">

        <x-banner />

        @include('navigation-menu')

        <div>
            @if (isset($header))
                <header class="z-10 px-4 sticky top-2">
                    <div class="bg-white dark:bg-zinc-900 h-16 rounded-lg border dark:border-zinc-700 max-w-7xl mx-auto px-4 flex items-center justify-between">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="h-full min-h-full max-w-7xl w-full mx-auto px-4">
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        @livewireScripts
        @persist('app-scripts')
            <script src="https://unpkg.com/@wotz/livewire-sortablejs@1.0.0/dist/livewire-sortable.js"></script>
            <script defer src="https://unpkg.com/@alpinejs/ui@3.13.8-beta.0/dist/cdn.min.js"></script>
        @endpersist
    </body>
</html>
