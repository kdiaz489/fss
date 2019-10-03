@component('mail::message')
# Contact email from FillStorShip.com

<strong>Name</strong> 
<br>
{{$data['name']}}
<br>
<strong>E-mail</strong>
<br>
{{$data['email']}}
<br>
<strong>Message</strong> 
<br>
{{$data['message']}}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
