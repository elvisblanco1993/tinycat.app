<x-mail::message>
Dear {{ $owner_name }},

We’re pleased to invite you to join the Client Portal provided by {{ $team }}.
This portal is designed to give you secure, anytime access to your financial documents, and other important information — all in one place.

To get started, simply click the link below, and login using the provided credentials:

<x-mail::button :url="route('login')">
{{ __("Access my portal") }}
</x-mail::button>

- Username: Use this email address.

- Password: {{ $password }}

**Make sure you change your password upon login.**

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
