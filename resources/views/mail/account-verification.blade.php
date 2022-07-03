@component('mail::message')
## Hi {{ $name }},

You have successfully registered in Hamro Dristi. So as to login, account activation is required.

Click the button below to activate your account.

@component('mail::button', ['url' => $link])
Activate Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent