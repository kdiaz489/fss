@component('mail::message')
# The following Shipment Request was submitted with FillStorShip.


<strong>orig_company: </strong> {{$data['orig_company']}}
<br>
<strong>orig_address_01: </strong> {{$data['orig_address_01']}}
<br>
<strong>origAddress02: </strong> {{$data['orig_address_02']}}
<br>
<strong>orig_city: </strong> {{$data['orig_city']}}
<br>
<strong>orig_zip: </strong> {{$data['orig_zip']}}
<br>
<strong>orig_state: </strong> {{$data['orig_state']}}
<br>
<strong>orig_cont_name: </strong> {{$data['orig_cont_name']}}
<br>
<strong>orig_cont_phone: </strong> {{$data['orig_cont_phone']}}
<br>
<strong>orig_cont_email: </strong> {{$data['orig_cont_email']}}
<br>
<strong>orig_pickup_date: </strong> {{$data['orig_pickup_date']}}
<br>
<strong>orig_type: </strong> {{$data['orig_type']}}
<br>
<strong>orig_dock: </strong> {{$data['orig_dock']}}
<br>
<strong>orig_frklft: </strong> {{$data['orig_frklft']}}
<br>
<strong>orig_flrstk: </strong> {{$data['orig_flrstk']}}
<br>
<strong>orig_inside: </strong> {{$data['orig_inside']}}
<br>
<strong>orig_lfgt: </strong> {{$data['orig_lfgt']}}
<br>
<strong>orig_notes: </strong> {{$data['orig_notes']}}


<br>
<strong>dest_company: </strong> {{$data['dest_company']}}
<br>
<strong>dest_address_01: </strong> {{$data['dest_address_01']}}
<br>
<strong>destAddress02: </strong> {{$data['dest_address_02']}}
<br>
<strong>dest_city: </strong> {{$data['dest_city']}}
<br>
<strong>dest_zip: </strong> {{$data['dest_zip']}}
<br>
<strong>dest_state: </strong> {{$data['dest_state']}}
<br>
<strong>dest_cont_name: </strong> {{$data['dest_cont_name']}}
<br>
<strong>dest_cont_phone: </strong> {{$data['dest_cont_phone']}}
<br>
<strong>dest_cont_email: </strong> {{$data['dest_cont_email']}}
<br>
<strong>dest_pickup_date: </strong> {{$data['dest_pickup_date']}}
<br>
<strong>dest_type: </strong> {{$data['dest_type']}}
<br>
<strong>dest_frklft: </strong> {{$data['dest_frklft']}}
<br>
<strong>dest_dock: </strong> {{$data['dest_dock']}}
<br>
<strong>dest_inside: </strong> {{$data['dest_inside']}}
<br>
<strong>dest_app_req: </strong> {{$data['dest_app_req']}}
<br>
<strong>dest_notes: </strong> {{$data['dest_notes']}}

<br>
<strong>prod_type: </strong> {{$data['prod_type']}}
<br>
<strong>prod_desc: </strong> {{$data['prod_desc']}}
<br>
<strong>prod_value: </strong> {{$data['prod_value']}}
<br>
<strong>prod_hazard: </strong> {{$data['prod_hazard']}}
<br>
<strong>prod_stackable: </strong> {{$data['prod_stackable']}}
<br>
<strong>no_of_pallets: </strong> {{$data['no_of_pallets']}}
<br>
<strong>weight_per_pallet: </strong> {{$data['weight_per_pallet']}}
<br>
<strong>tot_load_wt: </strong> {{$data['tot_load_wt']}}
<br>
<strong>pallet_width: </strong> {{$data['pallet_width']}}
<br>
<strong>pallet_length: </strong> {{$data['pallet_length']}}
<br>
<strong>pallet_height: </strong> {{$data['pallet_height']}}
<br>
<strong>freight_class: </strong> {{$data['freight_class']}}
<br>
<strong>load_strap: </strong> {{$data['load_strap']}}
<br>
<strong>load_blck: </strong> {{$data['load_blck']}}
<br>



Thanks,<br>
{{ config('app.name') }}
@endcomponent
