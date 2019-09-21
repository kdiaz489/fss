@component('mail::message')
# There has been an update on a Shipment Order.

The following request is {{$data['work_status']}}.
<br>
Please see the following work order for further details.

<strong>work id: </strong> {{$data['id']}}
<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
