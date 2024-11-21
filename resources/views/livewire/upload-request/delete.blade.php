<div>
    <x-danger-button wire:click="delete" wire:confirm="Are you sure you want to delete this request?\nThis will break any links sent to the client.\nClick OK to confirm deletion.">
        {{ __("Delete") }}
    </x-danger-button>
</div>
