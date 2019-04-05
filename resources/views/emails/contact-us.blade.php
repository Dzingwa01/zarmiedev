@component('mail::message')
Good day,<br/>
You have received a message from {{$full_name}} with contact number {{$phone_number}} and email address {{$email}}<br/>
The message is as follows:<br>
{{$message}} <br/>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
