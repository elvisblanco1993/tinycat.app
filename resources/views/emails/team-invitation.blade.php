<x-mail::message>
{{ __('You have been invited to join the :team team!', ['team' => $invitation->team->name]) }}

{{ __('You may accept this invitation by clicking the button below:') }}

<x-mail::button :url="$acceptUrl">
{{ __('Accept Invitation') }}
</x-mail::button>

{{ __('If you did not expect to receive an invitation to this team, you may discard this email.') }}

</x-mail::message>
