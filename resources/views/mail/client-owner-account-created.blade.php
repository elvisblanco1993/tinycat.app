<x-mail::message>
Dear {{ $owner_name }},

We’re pleased to invite you to join the Client Portal provided by {{ $team }}.

This portal is designed to give you secure, anytime access to your financial documents, and other important information — all in one place.

To get started, simply click the link below, and create a secure password:

<x-mail::button :url="route('password.request')">
{{ __("Create my password") }}
</x-mail::button>

- Username: Use this email address.

**Make sure you change your password upon login.**

Thanks,<br>
{{ $team }}
</x-mail::message>
