@component('mail::message')
# Email Verification Code

Use this code to verify your email.

@component('mail::button', ['url' => ''])
{{ $code }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
