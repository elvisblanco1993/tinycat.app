<div x-data="setupEditor(
    $wire.entangle('{{ $attributes->wire('model')->value() }}')
)" x-init="() => init($refs.editor)" wire:ignore {{ $attributes->whereDoesntStartWith('wire:model') }}>

    <div class="flex w-full border border-slate-300 border-b-0 divide-x divide-slate-300 bg-slate-100 dark:bg-slate-900 rounded-t-lg">
        <button type="button" class="flex justify-center p-2 transition dark:hover:bg-slate-700 w-14 rounded-tl-md"
            @click="toggleBold();">
            <x-svg class="w-5 h-auto" svg="bold" />
        </button>
        <button type="button" class="flex justify-center p-2 transition dark:hover:bg-slate-700 w-14 dark:bg-slate-900"
            @click="toggleItalic()">
            <x-svg class="w-5 h-auto" svg="italic" />
        </button>
        <button type="button" class="flex justify-center p-2 transition dark:hover:bg-slate-700 w-14 dark:bg-slate-900"
            @click="toggleH2()">
            <x-svg class="w-5 h-auto" svg="h-1" />
        </button>
        <button type="button" class="flex justify-center p-2 transition dark:hover:bg-slate-700 w-14 dark:bg-slate-900"
            @click="toggleH3()">
            <x-svg class="w-5 h-auto" svg="h-2" />
        </button>
        <button type="button" class="flex justify-center p-2 transition dark:hover:bg-slate-700 w-14 dark:bg-slate-900"
            @click="toggleH4()">
            <x-svg class="w-5 h-auto" svg="h-3" />
        </button>
        <button type="button" class="flex justify-center p-2 transition dark:hover:bg-slate-700 w-14 dark:bg-slate-900"
            @click="toggleOrderedList()">
            <x-svg class="w-5 h-auto" svg="list-numbers" />
        </button>
        <button type="button" class="flex justify-center p-2 transition dark:hover:bg-slate-700 w-14 dark:bg-slate-900"
            @click="toggleBulletList()">
            <x-svg class="w-5 h-auto" svg="list" />
        </button>
    </div>
    <div x-ref="editor" autofocus class="border border-slate-300 shadow-sm rounded-b-lg dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300"></div>
</div>
