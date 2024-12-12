<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">
            {{ __('Broadcasts') }}
        </h2>
        @can('create', \App\Models\EmailBroadcast::class)
            <div class="flex items-center space-x-4">
                {{--  --}}
            </div>
        @endcan
    </x-slot>
</div>
