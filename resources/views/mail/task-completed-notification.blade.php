<x-mail::message>

{{ $task->client->name }} completed the following task:

- {{ $task->title }}

<x-mail::button :url="route('client.task.index', ['client' => $task->client->id])">
{{ __("View client tasks") }}
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
