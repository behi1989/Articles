@component('mail::message')
نظر شما با موفقیت ارسال شد.

@component('mail::button', ['url' => 'localhost:8000'])
ورود به سایت
@endcomponent

با تشکر از شما,<br>
{{ config('app.name') }}
@endcomponent
