@component('mail::message')
# Password Reset Code

Use this code to reset your password.

@component('mail::button', ['url' => ''])
{{ $code }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
