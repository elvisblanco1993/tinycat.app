<x-mail::message>

{{ $task->title }} has been completed.

<x-mail::button :url="route('client.task.index')">
{{ __("View task") }}
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
