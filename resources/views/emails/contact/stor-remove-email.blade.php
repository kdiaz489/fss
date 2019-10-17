@component('mail::message')
# A Storage Work Order for {{$data['company']}} had been cancelled.
<br>
See details below. 


<strong>User iD: </strong> {{$data['user_id']}}
<br>

<strong>Company: </strong> {{$data['company']}}
<br>

<strong>Order Name: </strong> {{$data['name']}}
<br>

<strong>Order Type: </strong> {{$data['order_type']}}
<br>

<strong>Barcode: </strong> {{$data['barcode']}}
<br>

<strong>Carton Quantity: </strong> {{$data['carton_qty']}}
<br>

<strong>Case Quantity: </strong> {{$data['case_qty']}}
<br>

<strong>Kit Quantity: </strong> {{$data['kit_qty']}}
<br>

<strong>Unit Quantity: </strong> {{$data['unit_qty']}}
<br>

<strong>Total Quantity: </strong> {{$data['tot_qty']}}
<br>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
