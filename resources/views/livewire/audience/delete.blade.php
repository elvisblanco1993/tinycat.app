<div>
    <x-dropdown-button
        wire:click="delete"
        wire:confirm.prompt="Are you sure you want to delete this audience?\n\nType DELETE to confirm|DELETE"
    >{{ __("Delete") }}</x-dropdown-button>
</div>
