@props([
    'label' => 'Pick a color', // You can set a default label here
])

<div x-data="{ selectedColor: @entangle($attributes->wire('model')) }">
    <x-label>{{ $label }}</x-label>
    <div class="w-full mt-1 grid grid-cols-12">
        @foreach (config('internal.colors') as $label => $value)
            @php
                // Generate a unique ID for each input-label pair
                $inputId = 'color-' . Str::uuid();
            @endphp
            <label for="{{$inputId}}">
                <input id="{{$inputId}}" type="radio" x-model="selectedColor" value="{{$value}}" class="hidden">
                <div class="size-6 rounded-full border-2 inline-flex items-center justify-center"
                    :class="selectedColor === '{{ $value }}' ? 'ring ring-offset-2 ring-black' : ''"
                    style="background-color: {{ $value }};"
                >
                <svg x-show="selectedColor == '{{ $value }}'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="black" class="size-4">
                    <path fill-rule="evenodd" d="M12.416 3.376a.75.75 0 0 1 .208 1.04l-5 7.5a.75.75 0 0 1-1.154.114l-3-3a.75.75 0 0 1 1.06-1.06l2.353 2.353 4.493-6.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
                </svg>
            </div>
            </label>
        @endforeach
    </div>
</div>
