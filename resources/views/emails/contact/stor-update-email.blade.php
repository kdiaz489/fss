@component('mail::message')
#There has been an update on your Inventory Request.
<br>
See details below. 

<br>
<strong>Order ID #: </strong> {{$data['orderid']}}
<br>

<strong>Company: </strong> {{$data['company']}}
<br>

<strong>Order Type: </strong> {{$data['order_type']}}
<br>

<strong>Barcode: </strong> {{$data['barcode']}}
<br>

<strong>Status: </strong> {{$data['status']}}
<br>

<br>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
