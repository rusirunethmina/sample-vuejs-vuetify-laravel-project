@component('mail::message')
#Hi {{ $user->name }},
You Are Selected As {{ $user->role }} By National Housing development Authority.Following details are confidential and keep it with your own risk.
**Login Details for {{$user->email}}**
_____________________________________
>email(username):{{$user->email}}<br>
>Password:{{$user->password}}<br>

<br><br>

**Your Details**
_____________________________________
>Name : {{$user->name}}<br>
>Mobile : {{$user->name}}<br>





If there was any matters regarding to the logging please let us know.<br>

Best Regards,<br>
Celata Service Team
@endcomponent
