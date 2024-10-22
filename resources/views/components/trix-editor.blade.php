{{--
    This is a rich text editor that's been used all throughout the application.
    It is powered by Trix, and functionality is enabled by AlpinejS
    and Laravel Livewire. Whenever the content in Trix is updated,
    an event 'editorContentUpdated' is globally dispatched,
    Then a listener will catch the 'content', which
    can be saved to the database.
--}}
@props(['placeholder' => $placeholder])
@assets
    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.0-alpha.1/dist/trix.css">
    <script src="https://unpkg.com/trix@2.0.0-alpha.1/dist/trix.umd.js"></script>
    <style>[data-trix-button-group="file-tools"] { display: none !important; }</style>
@endassets
<div>
    <div
        x-data="{ value: @entangle('content') }"
        x-init="$refs.trix.editor.loadHTML(value)"
        x-id="['trix']"
        class="w-full"
        @trix-change="$wire.dispatch('editorContentUpdated', {content: $refs.input.value})"
        @trix-file-accept.prevent
        wire:ignore
    >
        <input :id="$id('trix')" type="text" class="sr-only" x-ref="input">
        <trix-editor x-ref="trix" :input="$id('trix')" placeholder="{{$placeholder}}"
            class="-mt-1 prose prose-blue outline-none text-base border border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-2 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm w-full max-w-full"
            autofocus
        ></trix-editor>
    </div>
</div>
