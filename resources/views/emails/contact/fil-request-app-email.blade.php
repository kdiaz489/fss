@component('mail::message')
# This company has sent a Fulfillment Request for FillStorShip.

The following request was submitted.

<strong>Company Name: </strong> {{$data['co-name']}}
<br>
<strong>Contact Name: </strong> {{$data['contact-name']}}
<br>
<strong>Contact E-mail: </strong> {{$data['contact-email']}}
<br>
<strong>Contact Phone: </strong> {{$data['contact-phone']}}
<br>
<strong>Kit or Product Name: </strong> {{$data['product-name']}}
<br>
<strong>Product Type: </strong> {{$data['product-type']}}
<br>
<strong>Quantity: </strong> {{$data['quantity']}}
<br>
<strong>Description: </strong> {{$data['desc']}}
<br>


@endcomponent
