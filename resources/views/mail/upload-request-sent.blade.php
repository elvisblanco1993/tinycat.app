<x-mail::message>
<div class="prose">
    {!! $message !!}
</div>

<x-mail::button :url="$request_url">
{{ __("Complete request") }}
</x-mail::button>

{{ __("Thanks") }},<br>
{{ $requestor }}
</x-mail::message>
