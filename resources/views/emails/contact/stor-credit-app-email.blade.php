@component('mail::message')
# This company has applied for Storage Credit with FillStorShip.

The following application was submitted.

<strong>Quote: </strong> {{$data['quote']}}
<br>
<strong>Name: </strong> {{$data['name']}}
<br>
<strong>E-mail: </strong> {{$data['email']}}
<br>
<strong>Billing Address: </strong> {{$data['billingaddress']}}
<br>
<strong>City: </strong> {{$data['city']}}
<br>
<strong>State: </strong> {{$data['state']}}
<br>
<strong>Account Number: </strong> {{$data['acc']}}
<br>
<strong>Exp Date: </strong> {{$data['date']}}
<br>
<strong>Card Type: </strong> {{$data['card-type']}}
<br>
<strong>CVC: </strong> {{$data['cvc']}}
<br>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
