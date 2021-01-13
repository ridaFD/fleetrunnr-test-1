@component('mail::message')
# Hello {{ $name }}

Please confirm your account to continue

@component('mail::button', ['url' => ''])
Confirm
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
