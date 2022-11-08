@component('mail::message')
#Hi {{ $organization->name }},
Welcome To GEOIT Valuation App system.This is a auto generated email for your organization credential.please remember the credential and keep it secret for more security.

**Login Details for {{$organization->email}}**
_____________________________________
>email(username):{{$organization->email}}<br>
>Password:{{$organization->password}}<br>

@component('mail::button', ['url' => 'http://testing.geoitlk.com/login'])
    Login Here
@endcomponent
<br><br>
**Your System Services**
_____________________________________
>Maximum Web Users :     {{$organization->webusers}} <br>
>Maximum Mobile Users :  {{$organization->mobusers}}
<br>


If there was any matters regarding to the logging please let us know.<br>

Best Regards,<br>
GEOIT Service Team
@endcomponent
