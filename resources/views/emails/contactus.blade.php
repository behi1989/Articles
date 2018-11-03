@component('mail::message')
# پیام از طرف ادمین سایت ارسال شده است

{{$body}}

با تشکر از همراهی شما,<br>

@component('mail::button', ['url' => 'localhost:8000'])
    بازگشت به سایت
@endcomponent

@endcomponent
