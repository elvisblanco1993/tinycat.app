<div>
    <x-section-border />
    <div class="mt-10 sm:mt-0">
        <x-action-section>
            <x-slot name="title">
                {{ __("File Templates") }}
            </x-slot>
            <x-slot name="description">
                {{ __("Create templates to quickly set up folder structures, saving time and staying organized for future clients onboarding.") }}
            </x-slot>
            <x-slot name="content">
                @can('create', \App\Models\ItemTemplate::class)
                    @livewire('item-template.create')
                @endcan
            </x-slot>
        </x-action-section>
    </div>
</div>
