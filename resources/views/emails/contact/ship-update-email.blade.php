@component('mail::message')
# There has been an update on a Storage Work Order.

The following update is {{$data['work_status']}}.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
