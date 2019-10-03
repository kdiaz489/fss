@component('mail::message')
# There has been a Storage Work Order Request.
<br>
See request details below. 

<strong>work id: </strong> {{$data['id']}}
<br>

<strong>user id: </strong> {{$data['user_id']}}
<br>

<strong>pro no: </strong> {{$data['pro_no']}}
<br>

<strong>pu no: </strong> {{$data['pu_no']}}
<br>

<strong>po no: </strong> {{$data['po_no']}}
<br>

<strong>barcode: </strong> {{$data['barcode']}}
<br>

<strong>sku: </strong> {{$data['sku']}}
<br>

<strong>description: </strong> {{$data['description']}}
<br>

<strong>inb carton: </strong> {{$data['inb_carton']}}
<br>

<strong>inb case: </strong> {{$data['inb_case']}}
<br>

<strong>inb item: </strong> {{$data['inb_item']}}
<br>

<strong>inb total quantity: </strong> {{$data['inb_tot_qty']}}
<br>

<strong>out bound carton: </strong> {{$data['out_carton']}}
<br>

<strong>out bound case: </strong> {{$data['out_case']}}
<br>

<strong>outbound item: </strong> {{$data['out_item']}}
<br>

<strong>outbound total quantity: </strong> {{$data['out_tot_qty']}}
<br>

<strong>eliminate carton: </strong> {{$data['elim_carton']}}
<br>

<strong>eliminate case: </strong> {{$data['elim_case']}}
<br>

<strong>eliminate item: </strong> {{$data['elim_item']}}
<br>

<strong>eliminate total quantity: </strong> {{$data['elim_tot_qty']}}
<br>

<strong>building: </strong> {{$data['building']}}
<br>

<strong>row: </strong> {{$data['row_']}}
<br>

<strong>column: </strong> {{$data['column_']}}
<br>

<strong>created at: </strong> {{$data['created_at']}}
<br>

<strong>updated at: </strong> {{$data['updated_at']}}
<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
