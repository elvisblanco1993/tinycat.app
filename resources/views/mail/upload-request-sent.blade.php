<x-mail::message>
{{ __("You have a new request below:") }}

<div class="prose">
    {!! $message !!}
</div>

<x-mail::button :url="$request_url">
{{ __("Complete request") }}
</x-mail::button>

{{ __("Thanks") }},<br>
{{ $requestor }}
</x-mail::message>
