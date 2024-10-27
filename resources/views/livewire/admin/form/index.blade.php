<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Forms') }}
        </h2>
        @can('create', \App\Models\Form::class)
            @livewire('admin.form.create')
        @endcan
    </x-slot>

    <div class="py-6">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <x-tinycat.search type="search" wire:model.live.debounce.250="search" placeholder="Search..." class="text-sm" />
            </div>

            <div class="mt-3 relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-left rtl:text-right text-slate-500 dark:text-slate-400">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-700 dark:text-slate-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">{{ __("ID") }}</th>
                            <th scope="col" class="px-6 py-3">{{ __("Form") }}</th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">{{ __("Edit") }}</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse ($forms as $form)
                            <tr class="bg-white border-b dark:bg-slate-800 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600">
                                <th scope="row" class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap dark:text-white">
                                    {{ $form->id }}
                                </th>
                                <th class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap dark:text-white">
                                    {{ $form->title }}
                                </th>
                                <td class="px-6 py-4 text-right">
                                    <x-secondary-button-link href="{{ route('form.show', ['form' => $form->id]) }}" wire:navigate>
                                        {{ __("View") }}
                                    </x-secondary-button-link>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white border-b dark:bg-slate-800 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600">
                                <td colspan="5" class="px-6 py-3 text-center">
                                    {{ __("No forms have been added yet.") }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
