@component('mail::message')
## Hi {{ $name }},

Click the button below to reset your password.

@component('mail::button', ['url' => $link])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
