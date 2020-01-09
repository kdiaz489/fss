@component('mail::message')


#The following order has been fulfilled.

@component('mail::table')
| Shopify Order ID | Customer Name | Shipping Address | Company |
|:--------------------:|:-------------:|:-------------:|:--------:|
| {{$data['cust_order_no']}} | {{$data['cust_name']}} | {{$data['street_address']}} <br> {{$data['city'] . ', ' . $data['state'] . ' ' . $data['zip']}} | {{$data['company']}} |

@endcomponent

Thanks,<br>
FillStorShip
@endcomponent
