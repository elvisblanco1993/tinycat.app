<div>
    <form wire:submit.prevent="save">
        @csrf
        <x-label for="file-upload-box">{{ __("Upload files here") }}</x-label>
        <div class="mt-1">
            <x-file-input id="file-upload-box"
                wire:model="files"
                multiple
                allowImagePreview
                imagePreviewMaxHeight="200"
                allowFileTypeValidation
                acceptedFileTypes="{{ $supported }}"
                allowFileSizeValidation
                {{-- maxFileSize="200mb" --}}
            />
            <x-input-error for="files" />
        </div>

        <div class="mt-3">
            <x-button>
                <span wire:loading.remove wire:target="save">{{ __("Upload files") }}</span>

                <span wire:loading wire:target="save">{{ __("Uploading") }}</span>
                <svg wire:loading wire:target="save" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="ms-1 size-4 animate-spin">
                    <path fill-rule="evenodd" d="M13.836 2.477a.75.75 0 0 1 .75.75v3.182a.75.75 0 0 1-.75.75h-3.182a.75.75 0 0 1 0-1.5h1.37l-.84-.841a4.5 4.5 0 0 0-7.08.932.75.75 0 0 1-1.3-.75 6 6 0 0 1 9.44-1.242l.842.84V3.227a.75.75 0 0 1 .75-.75Zm-.911 7.5A.75.75 0 0 1 13.199 11a6 6 0 0 1-9.44 1.241l-.84-.84v1.371a.75.75 0 0 1-1.5 0V9.591a.75.75 0 0 1 .75-.75H5.35a.75.75 0 0 1 0 1.5H3.98l.841.841a4.5 4.5 0 0 0 7.08-.932.75.75 0 0 1 1.025-.273Z" clip-rule="evenodd" />
                </svg>
            </x-button>
        </div>
    </form>
</div>
