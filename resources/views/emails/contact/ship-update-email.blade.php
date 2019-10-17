@component('mail::message')
# There has been an update on a shipping request.

The following request has been <strong>{{$data['work_status']}}</strong>.
<br>

Please see the work order for further details.

<strong>Shipment ID: </strong> {{$data['id']}}
<br>


<strong>Shipper Company: </strong> {{$data['orig_company']}}
<br>

<strong>Shipper Pickup Date: </strong> {{$data['orig_pickup_date']}}
<br>

<strong>Receiver Company: </strong> {{$data['dest_company']}}
<br>

<strong>Receiver Delivery Date: </strong> {{$data['dest_pickup_date']}}
<br>

<strong>Total # of Pallets: </strong> {{$data['no_of_pallets']}}
<br>

<strong>Total Weight: </strong> {{$data['tot_load_wt']}}
<br>

<strong>Pallet Width: </strong> {{$data['pallet_width']}}
<br>

<strong>Pallet Length: </strong> {{$data['pallet_length']}}
<br>

<strong>Pallet Height: </strong> {{$data['pallet_height']}}
<br>

<strong>Total Cost: </strong> ${{$data['tot_load_cost']}}
<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
