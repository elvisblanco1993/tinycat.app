<div>
    {{-- Client Card --}}
    @include('partials.client.profile')
    {{-- End | Client Card --}}

    <div class="mt-3 max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        @can('create', \App\Models\Request::class)
            @livewire('upload-request.create', ['client' => $client])
        @endcan
    </div>
</div>
