@component('mail::message')
# This company has applied for Shipping Credit with FillStorShip.

The following application was submitted.

<strong>Quote: </strong> {{$data['quote']}}
<br>
<strong>Legal Name of Business: </strong> {{$data['name']}}
<br>
<strong>Business Mailing Address: </strong> {{$data['billingaddress']}}
<br>
<strong>City: </strong> {{$data['city']}}
<br>
<strong>State: </strong> {{$data['state']}}
<br>
<strong>Zip: </strong> {{$data['zip']}}
<br>
<strong>Business Type: </strong> {{$data['biz-type']}}
<br>
<strong>Business Phone: </strong> {{$data['biz-phone']}}
<br>
<strong>Tax Identification Number: </strong> {{$data['id-num']}}
<br>
<strong>Number of Employees: </strong> {{$data['num-employees']}}
<br>
<strong>Annual business revenue/sales: </strong> {{$data['biz-rev']}}
<br>
<strong>Years in Business: </strong> {{$data['biz-years']}}
<br>
<strong>General Industry: </strong> {{$data['biz-industry']}}
<br>
<strong>Category: </strong> {{$data['biz-category']}}
<br>
<strong>Specific Type: </strong> {{$data['biz-specific']}}
<br>



Thanks,<br>
{{ config('app.name') }}
@endcomponent
