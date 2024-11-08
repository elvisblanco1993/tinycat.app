<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-zinc-50 dark:bg-zinc-900">
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
    <body class="font-sans antialiased" x-data="themeSwitcher()" :class="{ 'dark': switchOn }">

        <x-banner />

        <div class="h-screen min-h-screen md:flex items-start">
            @include('navigation-menu')

            <div class="md:ml-72 w-full">
                <div class="w-full max-w-screen-2xl mx-auto py-6">
                    @if (isset($header))
                        <header>
                            <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                                {{ $header }}
                            </div>
                        </header>
                    @endif

                    <!-- Page Content -->
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>

        @stack('modals')
        @livewireScripts
        @persist('app-scripts')
            <script src="https://unpkg.com/@nextapps-be/livewire-sortablejs@0.4.0/dist/livewire-sortable.js"></script>
            <script defer src="https://unpkg.com/@alpinejs/ui@3.13.8-beta.0/dist/cdn.min.js"></script>
        @endpersist
    </body>
</html>
