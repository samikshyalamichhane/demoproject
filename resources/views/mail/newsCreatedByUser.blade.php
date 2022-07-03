@component('mail::message')
## Hi Admin,

News titled <strong> {{  $maildata['news_title'] }} </strong> has been created by the user {{ $maildata['user'] }}.

Click the button below to view news.

@component('mail::button', ['url' => route('news.index')])
View News
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent