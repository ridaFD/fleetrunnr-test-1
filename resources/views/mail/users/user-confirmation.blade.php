@component('mail::message')
# Hello {{ $name }}

Please confirm your account to continue

<a href="{{ route('confirm_email', $token) }}" class="button" target="_blank" rel="noopener">
    <button>Confirm</button>
</a>

Thank you,<br>
The {{ config('app.name') }} Team
@endcomponent
