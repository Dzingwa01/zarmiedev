@component('mail::message')
Zarmie Registration - Account Verification

Hi {{$name .'  '. $surname}},

You have been successfully registered with Zarmie.
Please verify your account by clinking the link below.

@component('mail::button', ['url' => $url,'color'=>'green'])
Verify Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
