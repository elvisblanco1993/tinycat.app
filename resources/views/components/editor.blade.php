<div x-data="setupEditor(
    $wire.entangle('{{ $attributes->wire('model')->value() }}')
)" x-init="() => init($refs.editor)" wire:ignore {{ $attributes->whereDoesntStartWith('wire:model') }}>

    <div class="flex w-full border border-zinc-300 dark:border-zinc-700 border-b-0 divide-x divide-zinc-300 dark:divide-zinc-700 bg-zinc-100 dark:bg-zinc-900 rounded-t-lg">
        <button type="button" class="flex justify-center p-2 transition hover:bg-zinc-200 dark:hover:bg-zinc-700 w-10 rounded-tl-md"
            @click="toggleBold();">
            <x-svg class="w-4 h-auto" svg="bold" />
        </button>
        <button type="button" class="flex justify-center p-2 transition hover:bg-zinc-200 dark:hover:bg-zinc-700 w-10 dark:bg-zinc-900"
            @click="toggleItalic()">
            <x-svg class="w-4 h-auto" svg="italic" />
        </button>
        <button type="button" class="flex justify-center p-2 transition hover:bg-zinc-200 dark:hover:bg-zinc-700 w-10 dark:bg-zinc-900"
            @click="toggleH2()">
            <x-svg class="w-4 h-auto" svg="h-1" />
        </button>
        <button type="button" class="flex justify-center p-2 transition hover:bg-zinc-200 dark:hover:bg-zinc-700 w-10 dark:bg-zinc-900"
            @click="toggleH3()">
            <x-svg class="w-4 h-auto" svg="h-2" />
        </button>
        <button type="button" class="flex justify-center p-2 transition hover:bg-zinc-200 dark:hover:bg-zinc-700 w-10 dark:bg-zinc-900"
            @click="toggleH4()">
            <x-svg class="w-4 h-auto" svg="h-3" />
        </button>
        <button type="button" class="flex justify-center p-2 transition hover:bg-zinc-200 dark:hover:bg-zinc-700 w-10 dark:bg-zinc-900"
            @click="toggleOrderedList()">
            <x-svg class="w-4 h-auto" svg="list-numbers" />
        </button>
        <button type="button" class="flex justify-center p-2 transition hover:bg-zinc-200 dark:hover:bg-zinc-700 w-10 dark:bg-zinc-900"
            @click="toggleBulletList()">
            <x-svg class="w-4 h-auto" svg="list" />
        </button>
    </div>
    <div x-ref="editor" autofocus class="min-h-24 prose prose-sm dark:prose-invert prose-h2:my-0 prose-p:my-0 max-w-7xl border border-zinc-300 shadow-xs rounded-b-lg dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300"></div>
</div>
