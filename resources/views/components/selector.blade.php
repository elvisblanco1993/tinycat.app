{{--
How to use:
    <x-selector :options="<array> $options" wire:model="your_model"></x-selector>

$ptions sample:
    $options = User::select('id', 'name', 'profile_photo_path')
        ->get()
        ->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'profile_photo_url' => $user->profile_photo_url,
                'disabled' => false,
            ];
        })
        ->toArray();
--}}

@assets
<script defer src="https://unpkg.com/@alpinejs/focus@3.14.3/dist/cdn.min.js"></script>
@endassets

<div
    x-data="{
        query: '',
        selected: @entangle($attributes->wire('model')),
        options: {{ json_encode($options) }},
        get filteredOptions() {
            return this.query === ''
                ? this.options
                : this.options.filter((option) => {
                    return option.name.toLowerCase().includes(this.query.toLowerCase())
                })
        },
        remove(option) {
            this.selected = this.selected.filter((i) => i !== option)
        }
    }"
    class="w-full"
>
    <div x-combobox x-model="selected" multiple by="id" class="bg-transparent border-none !p-0 text-sm">
        <div x-show="selected.length" class="mt-1 mb-2 flex flex-wrap items-center gap-1.5">
            <template x-for="selectedOption in selected" :key="selectedOption.id">
                <button x-on:click.prevent="remove(selectedOption)" class="inline-flex items-center gap-1 p-1 px-2 text-xs rounded-full bg-zinc-100 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-100 hover:text-zinc-800 dark:hover:text-white">
                    <img :src="selectedOption.profile_photo_url" class="w-5 h-5 rounded-full mr-1">
                    <span x-text="selectedOption.name"></span>
                    <!-- Heroicons mini x-mark -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" /></svg>
                </button>
            </template>
        </div>

        <div class="mt-1 relative rounded-lg border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-900 text-black dark:text-zinc-100 focus-within:ring-0 focus-within:border-blue-500">
            <div class="flex items-center justify-between gap-2 w-full px-3 py-2 rounded-lg shadow-sm">
                <input
                    x-combobox:input
                    @change="query = $event.target.value;"
                    class="border-none p-0 focus:outline-none focus:ring-0 !text-sm bg-inherit"
                    placeholder="Start typing..."
                />
                <button x-combobox:button class="absolute inset-y-0 right-0 flex items-center pr-2">
                    <!-- Heroicons up/down -->
                    <svg class="shrink-0 w-5 h-5 text-zinc-500" viewBox="0 0 20 20" fill="none" stroke="currentColor"><path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>
                </button>
            </div>

            <div x-combobox:options x-cloak class="absolute left-0 w-full max-h-60 mt-2 z-10 origin-top-right overflow-auto border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-black dark:text-zinc-100 rounded-lg shadow-md outline-none" x-transition.out.opacity>
                <ul class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    <template
                        x-for="option in filteredOptions"
                        :key="option.id"
                        hidden
                    >
                        <li
                            x-combobox:option
                            :value="option"
                            :disabled="option.disabled"
                            :class="{
                                'bg-zinc-500/10': $comboboxOption.isActive,
                                'text-zinc-600 dark:text-zinc-400': ! $comboboxOption.isActive,
                                'opacity-50 cursor-not-allowed': $comboboxOption.isDisabled,
                            }"
                            class="flex items-center cursor-default justify-between gap-2 w-full px-4 py-2 text-sm"
                        >
                            <div class="flex items-center">
                                <img :src="option.profile_photo_url" class="w-5 h-5 rounded-full mr-2">
                                <span x-text="option.name"></span>
                            </div>
                            <span x-show="$comboboxOption.isSelected" class="text-green-600 font-bold">&check;</span>
                        </li>
                    </template>
                </ul>

                <p x-show="filteredOptions.length == 0" class="px-4 py-2 text-sm text-zinc-600">No options match your query.</p>
            </div>
        </div>
    </div>
</div>
