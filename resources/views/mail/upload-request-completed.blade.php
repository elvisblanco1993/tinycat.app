<x-mail::message>
{{ __("New documents have been uploaded by ") . $clientName }}.

{{ __("Click the button below to view the request and access the files.") }}

<x-mail::button :url="$request_url">
{{ __("View request") }}
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
