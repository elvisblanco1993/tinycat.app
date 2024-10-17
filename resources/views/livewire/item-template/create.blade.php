<div>
    <x-button wire:click="$toggle('modal')">
        {{ __("Create template") }}
    </x-button>

    <x-dialog-modal wire:model="modal" maxWidth="2xl">
        <x-slot name="title">{{ __("Create File Template") }}</x-slot>
        <x-slot name="content">
            <div>
                <x-label for="root_name" value="{{ __('Root Directory Name') }}" />
                <x-input id="root_name" class="block mt-1 w-full" type="text" name="root_name" wire:model="root_name" :value="old('root_name')" required autofocus autocomplete="root_name" placeholder="Taxes" />
                <x-input-error for="root_name" />
            </div>
            @forelse ($inputs as $key => $input)
                    <div class="flex items-center gap-4">
                        <x-input type="text" wire:model.defer="inputs.{{$key}}.text" class="block mt-1 w-full"/>
                        <button wire:click="removeInput({{$key}})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 hover:text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    @error('inputs.'.$key.'.text') <span class="text-sm text-red-600">{{ __("This field is required") }}</span> @enderror
                    <div class="mt-3"></div>
                @empty
                @endforelse
                <x-secondary-button wire:click="addInput" class="mt-4">Add subdirectory</x-secondary-button>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">{{ __("Cancel") }}</x-secondary-button>
            <x-button wire:click="save" class="ms-4">{{ __("Create") }}</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
