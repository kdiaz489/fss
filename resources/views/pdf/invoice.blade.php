<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- Styles -->
  
  <link href="{{ asset('css/master.css') }}" rel="stylesheet">
  <link href="{{ asset('css/landingpage.css') }}" rel="stylesheet">

  <style>
    body {
      margin-bottom: 0px;
    }

    .text-white {
      color: white;
    }

    .no-padding-margin {
      margin: 0px;
      padding: 0px;
    }

    .col-xs-12 {
      padding: 0px;
    }

    .m-0 {
      margin: 0 !important;
    }

    .mt-0,
    .my-0 {
      margin-top: 0 !important;
    }

    .mr-0,
    .mx-0 {
      margin-right: 0 !important;
    }

    .mb-0,
    .my-0 {
      margin-bottom: 0 !important;
    }

    .ml-0,
    .mx-0 {
      margin-left: 0 !important;
    }

    .m-1 {
      margin: 0.25rem !important;
    }

    .mt-1,
    .my-1 {
      margin-top: 0.25rem !important;
    }

    .mr-1,
    .mx-1 {
      margin-right: 0.25rem !important;
    }

    .mb-1,
    .my-1 {
      margin-bottom: 0.25rem !important;
    }

    .ml-1,
    .mx-1 {
      margin-left: 0.25rem !important;
    }

    .m-2 {
      margin: 0.5rem !important;
    }

    .mt-2,
    .my-2 {
      margin-top: 0.5rem !important;
    }

    .mr-2,
    .mx-2 {
      margin-right: 0.5rem !important;
    }

    .mb-2,
    .my-2 {
      margin-bottom: 0.5rem !important;
    }

    .ml-2,
    .mx-2 {
      margin-left: 0.5rem !important;
    }

    .m-3 {
      margin: 1rem !important;
    }

    .mt-3,
    .my-3 {
      margin-top: 1rem !important;
    }

    .mr-3,
    .mx-3 {
      margin-right: 1rem !important;
    }

    .mb-3,
    .my-3 {
      margin-bottom: 1rem !important;
    }

    .ml-3,
    .mx-3 {
      margin-left: 1rem !important;
    }

    .m-4 {
      margin: 1.5rem !important;
    }

    .mt-4,
    .my-4 {
      margin-top: 1.5rem !important;
    }

    .mr-4,
    .mx-4 {
      margin-right: 1.5rem !important;
    }

    .mb-4,
    .my-4 {
      margin-bottom: 1.5rem !important;
    }

    .ml-4,
    .mx-4 {
      margin-left: 1.5rem !important;
    }

    .m-5 {
      margin: 3rem !important;
    }

    .mt-5,
    .my-5 {
      margin-top: 3rem !important;
    }

    .mr-5,
    .mx-5 {
      margin-right: 3rem !important;
    }

    .mb-5,
    .my-5 {
      margin-bottom: 3rem !important;
    }

    .ml-5,
    .mx-5 {
      margin-left: 3rem !important;
    }

    .p-0 {
      padding: 0 !important;
    }

    .pt-0,
    .py-0 {
      padding-top: 0 !important;
    }

    .pr-0,
    .px-0 {
      padding-right: 0 !important;
    }

    .pb-0,
    .py-0 {
      padding-bottom: 0 !important;
    }

    .pl-0,
    .px-0 {
      padding-left: 0 !important;
    }

    .p-1 {
      padding: 0.25rem !important;
    }

    .pt-1,
    .py-1 {
      padding-top: 0.25rem !important;
    }

    .pr-1,
    .px-1 {
      padding-right: 0.25rem !important;
    }

    .pb-1,
    .py-1 {
      padding-bottom: 0.25rem !important;
    }

    .pl-1,
    .px-1 {
      padding-left: 0.25rem !important;
    }

    .p-2 {
      padding: 0.5rem !important;
    }

    .pt-2,
    .py-2 {
      padding-top: 0.5rem !important;
    }

    .pr-2,
    .px-2 {
      padding-right: 0.5rem !important;
    }

    .pb-2,
    .py-2 {
      padding-bottom: 0.5rem !important;
    }

    .pl-2,
    .px-2 {
      padding-left: 0.5rem !important;
    }

    .p-3 {
      padding: 1rem !important;
    }

    .pt-3,
    .py-3 {
      padding-top: 1rem !important;
    }

    .pr-3,
    .px-3 {
      padding-right: 1rem !important;
    }

    .pb-3,
    .py-3 {
      padding-bottom: 1rem !important;
    }

    .pl-3,
    .px-3 {
      padding-left: 1rem !important;
    }

    .p-4 {
      padding: 1.5rem !important;
    }

    .pt-4,
    .py-4 {
      padding-top: 1.5rem !important;
    }

    .pr-4,
    .px-4 {
      padding-right: 1.5rem !important;
    }

    .pb-4,
    .py-4 {
      padding-bottom: 1.5rem !important;
    }

    .pl-4,
    .px-4 {
      padding-left: 1.5rem !important;
    }

    .p-5 {
      padding: 3rem !important;
    }

    .pt-5,
    .py-5 {
      padding-top: 3rem !important;
    }

    .pr-5,
    .px-5 {
      padding-right: 3rem !important;
    }

    .pb-5,
    .py-5 {
      padding-bottom: 3rem !important;
    }

    .pl-5,
    .px-5 {
      padding-left: 3rem !important;
    }

    .m-n1 {
      margin: -0.25rem !important;
    }

    .mt-n1,
    .my-n1 {
      margin-top: -0.25rem !important;
    }

    .mr-n1,
    .mx-n1 {
      margin-right: -0.25rem !important;
    }

    .mb-n1,
    .my-n1 {
      margin-bottom: -0.25rem !important;
    }

    .ml-n1,
    .mx-n1 {
      margin-left: -0.25rem !important;
    }

    .m-n2 {
      margin: -0.5rem !important;
    }

    .mt-n2,
    .my-n2 {
      margin-top: -0.5rem !important;
    }

    .mr-n2,
    .mx-n2 {
      margin-right: -0.5rem !important;
    }

    .mb-n2,
    .my-n2 {
      margin-bottom: -0.5rem !important;
    }

    .ml-n2,
    .mx-n2 {
      margin-left: -0.5rem !important;
    }

    .m-n3 {
      margin: -1rem !important;
    }

    .mt-n3,
    .my-n3 {
      margin-top: -1rem !important;
    }

    .mr-n3,
    .mx-n3 {
      margin-right: -1rem !important;
    }

    .mb-n3,
    .my-n3 {
      margin-bottom: -1rem !important;
    }

    .ml-n3,
    .mx-n3 {
      margin-left: -1rem !important;
    }

    .m-n4 {
      margin: -1.5rem !important;
    }

    .mt-n4,
    .my-n4 {
      margin-top: -1.5rem !important;
    }

    .mr-n4,
    .mx-n4 {
      margin-right: -1.5rem !important;
    }

    .mb-n4,
    .my-n4 {
      margin-bottom: -1.5rem !important;
    }

    .ml-n4,
    .mx-n4 {
      margin-left: -1.5rem !important;
    }

    .m-n5 {
      margin: -3rem !important;
    }

    .mt-n5,
    .my-n5 {
      margin-top: -3rem !important;
    }

    .mr-n5,
    .mx-n5 {
      margin-right: -3rem !important;
    }

    .mb-n5,
    .my-n5 {
      margin-bottom: -3rem !important;
    }

    .ml-n5,
    .mx-n5 {
      margin-left: -3rem !important;
    }

    .m-auto {
      margin: auto !important;
    }

    .mt-auto,
    .my-auto {
      margin-top: auto !important;
    }

    .mr-auto,
    .mx-auto {
      margin-right: auto !important;
    }

    .mb-auto,
    .my-auto {
      margin-bottom: auto !important;
    }

    .ml-auto,
    .mx-auto {
      margin-left: auto !important;
    }

    .border {
      border: 1px solid #A2AAB0 !important;
    }

    .border-top {
      border-top: 1px solid #A2AAB0 !important;
    }

    .border-right {
      border-right: 1px solid #A2AAB0 !important;
    }

    .border-bottom {
      border-bottom: 1px solid #A2AAB0 !important;
    }

    .border-left {
      border-left: 1px solid #A2AAB0 !important;
    }

    .bold-text {
      font-weight: 600;
    }

    .sm-font {
      font-size: 12px;
    }

    .sm-lineheight{
      line-height: 2rem;
    }

    .table-bordered{
      border: 2px solid black;
    }
  </style>

</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-xs-4 text-center mt-0">
        <img src="file:///var/www/html/fillstorship/public/img/logo.png" width="110px" height="auto" style="margin-top:0px">
      </div>
      <div class="col-xs-4 text-center">
        <p class="p-0 my-0"><strong>Bill of Lading</strong></p>
        <p class="p-0 m-0 sm-font sm-lineheight">FillStorShip</p>
        <p class="p-0 m-0 sm-font sm-lineheight">2356 1st Street</p>
        <p class="p-0 m-0 sm-font sm-lineheight">La Verne, Ca    91750</p>
      </div>
      <div class="col-xs-4 m-0" style="font-size: 12px">
        <div class="row">
          <div class="col-xs-3">
            <p class="py-0 my-0">Bill To:</p>
          </div>
          <div class="col-xs-9">
            <p class="py-0 my-0">{{$shipment->orig_company}}</p>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-4">
            <p class="py-0 my-0">Invoice #:</p>
          </div>
          <div class="col-xs-8">
            <p class="py-0 my-0">{{$shipment->id}}</p>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-2">
            <p class="py-0 my-0">Date:</p>
          </div>
          <div class="col-xs-10">
            <p class="py-0 my-0">{{$shipment->created_at}}</p>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-5">
            <p class="py-0 my-0">Customer ID:</p>
          </div>
          <div class="col-xs-7 px-0">
            <p class="px-0 my-0">{{$shipment->user_id}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="container border border-dark">
    <div class="row">
      <div class="col col-xs-6 border-dark p-0" style="font-size:12px">
        <h3 class="text-center m-0 text-white border-right border-dark" style="background-color: #4F81BD;">Shipper</h3>
        <div class="row m-0 border-bottom">
          <div class="col-xs-4 bold-text">
            <p class="py-0 my-0">PU #:</p>
          </div>
          <div class="col-xs-8">
            <p class="py-0 my-0"></p>
          </div>
        </div>

        <div class="row m-0 border-bottom">
          <div class="col-xs-4 bold-text">
            <p class="py-0 my-0">Date:</p>
          </div>
          <div class="col-xs-8">
            <p class="py-0 my-0">{{$shipment->orig_pickup_date}}</p>
          </div>
        </div>

        <div class="row m-0 border-bottom">
          <div class="col-xs-4 bold-text">
            <p class="py-0 my-0">Time:</p>
          </div>
          <div class="col-xs-8">
            <p class="orig_time"></p>
          </div>
        </div>

        <div class="row m-0 border-bottom">
          <div class="col-xs-4 bold-text">
            <p class="py-0 my-0">Company:</p>
          </div>
          <div class="col-xs-8">
            <p class="py-0 my-0">{{$shipment->orig_company}}</p>
          </div>
        </div>

        <div class="row m-0 border-bottom">
          <div class="col-xs-4 bold-text">
            <p class="py-0 my-0">Address:</p>
          </div>
          <div class="col-xs-8">
            <p class="py-0 my-0">
              {{$shipment->orig_address_01 . ' ' . $shipment->orig_address_02 . ' ' . $shipment->orig_city . ' ' . $shipment->oriz_zip}}
            </p>
          </div>
        </div>

        <div class="row m-0 border-bottom">
          <div class="col-xs-4 bold-text">
            <p class="py-0 my-0">Contact:</p>
          </div>
          <div class="col-xs-8">
            <p class="py-0 my-0">{{$shipment->orig_cont_name}}</p>
          </div>
        </div>

        <div class="row m-0 border-bottom">
          <div class="col-xs-4 bold-text">
            <p class="py-0 my-0">Telephone:</p>
          </div>
          <div class="col-xs-8">
            <p class="py-0 my-0">{{$shipment->orig_cont_phone}}</p>
          </div>
        </div>

        <div class="row m-0 border-bottom">
          <div class="col-xs-4 bold-text">
            <p class="py-0 my-0">E-mail:</p>
          </div>
          <div class="col-xs-8">
            <p class="py-0 my-0">{{$shipment->orig_cont_email}}</p>
          </div>
        </div>
        <div class="row m-0 border-dark">
          <div class="col-xs-3 pl-2">
            @if($shipment->orig_inside == 'Yes')
            <p><input type="checkbox" name="orig_inside_pickup" value="Yes" checked>Inside Pickup</p>
            @else
            <p><input type="checkbox" name="orig_inside_pickup" value="Yes">Inside Pickup</p>
            @endif
            <p><input type="checkbox" name="orig_load_to_ride" value="Yes">Load to Ride</p>

          </div>
          <div class="col-xs-3 pl-2">
            @if($shipment->orig_lfgt == 'Yes')
            <p><input type="checkbox" name="orig_liftgate" value="Yes" checked>Liftgate</p>
            @else
            <p><input type="checkbox" name="orig_liftgate" value="Yes">Liftgate</p>
            @endif

            <p><input type="checkbox" name="orig_excl_use" value="Yes">Exclusive</p>

          </div>
          <div class="col-xs-3 pl-2">
            <p><input type="checkbox" name="orig_load_bars" value="Yes">Load Bars</p>

            <p><input type="checkbox" name="orig_docs_req" value="Yes">Docs Req</p>

          </div>
          <div class="col-xs-3 pl-2">
            <p><input type="checkbox" name="orig_block" value="Yes">Block/Brace</p>
            @if($shipment->load_strap)
            <p><input type="checkbox" name="orig_straps" value="Yes" checked>Straps</p>
            @else
            <p><input type="checkbox" name="orig_straps" value="Yes">Straps</p>
            @endif
          </div>
        </div>
      </div>


      <div class="col-xs-6 border-left border-dark p-0" style="font-size: 12px">
        <h3 class="text-center m-0 text-white" style="background-color: #4F81BD;">Receiver</h3>

        <div class="row m-0 border-bottom">
          <div class="col-xs-4 bold-text">
            <p class="py-0 my-0">PU #:</p>
          </div>
          <div class="col-xs-8">
            <p class="py-0 my-0"></p>
          </div>
        </div>

        <div class="row m-0 border-bottom">
          <div class="col-xs-4 bold-text">
            <p class="py-0 my-0">Date:</p>
          </div>
          <div class="col-xs-8">
            <p class="py-0 my-0">{{$shipment->dest_pickup_date}}</p>
          </div>
        </div>

        <div class="row m-0 border-bottom">
          <div class="col-xs-4 bold-text">
            <p class="py-0 my-0">Time:</p>
          </div>
          <div class="col-xs-8">
            <p class="py-0 my-0"></p>
          </div>
        </div>

        <div class="row m-0 border-bottom">
          <div class="col-xs-4 bold-text">
            <p class="py-0 my-0">Company:</p>
          </div>
          <div class="col-xs-8">
            <p class="py-0 my-0">{{$shipment->dest_company}}</p>
          </div>
        </div>

        <div class="row m-0 border-bottom">
          <div class="col-xs-4 bold-text">
            <p class="py-0 my-0">Address:</p>
          </div>
          <div class="col-xs-8">
            <p class="py-0 my-0">
              {{$shipment->dest_address_01 . ' ' . $shipment->dest_address_02 . ' ' . $shipment->dest_city . ' ' . $shipment->dest_zip}}
            </p>
          </div>
        </div>

        <div class="row m-0 border-bottom">
          <div class="col-xs-4 bold-text">
            <p class="py-0 my-0">Contact:</p>
          </div>
          <div class="col-xs-8">
            <p class="py-0 my-0">{{$shipment->dest_cont_name}}</p>
          </div>
        </div>

        <div class="row m-0 border-bottom">
          <div class="col-xs-4 bold-text">
            <p class="py-0 my-0">Telephone:</p>
          </div>
          <div class="col-xs-8">
            <p class="py-0 my-0">{{$shipment->dest_cont_phone}}</p>
          </div>
        </div>

        <div class="row m-0 border-bottom">
          <div class="col-xs-4 bold-text">
            <p class="py-0 my-0">E-mail:</p>
          </div>
          <div class="col-xs-8">
            <p class="py-0 my-0">{{$shipment->dest_cont_email}}</p>
          </div>
        </div>

        <div class="row m-0 border-dark">
          <div class="col-xs-3 pl-2">
            @if($shipment->dest_inside == 'Yes')
            <p><input type="checkbox" name="dest_inside_pickup" value="Yes" checked>Inside Pickup</p>
            @else
            <p><input type="checkbox" name="dest_inside_pickup" value="Yes">Inside Pickup</p>
            @endif

            <p><input type="checkbox" name="dest_load_to_ride" value="Yes">Load to Ride</p>

          </div>
          <div class="col-xs-3 pl-2">
            @if($shipment->dest_lfgt == 'Yes')
            <p><input type="checkbox" name="dest_liftgate" value="Yes" checked>Liftgate</p>
            @else
            <p><input type="checkbox" name="dest_liftgate" value="Yes">Liftgate</p>
            @endif

            <p><input type="checkbox" name="dest_excl_use" value="Yes">Exclusive</p>

          </div>
          <div class="col-xs-3 pl-2">
            <p><input type="checkbox" name="dest_load_bars" value="Yes">Load Bars</p>

            <p><input type="checkbox" name="dest_docs_req" value="Yes">Docs Req</p>

          </div>
          <div class="col-xs-3 pl-2">
            <p><input type="checkbox" name="dest_block" value="Yes">Block/Brace</p>
            @if($shipment->load_strap == 'Yes')
            <p><input type="checkbox" name="dest_straps" value="Yes" checked>Straps</p>
            @else
            <p><input type="checkbox" name="dest_straps" value="Yes">Straps</p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container border border-dark">
    <div class="row">
      <h3 class="text-center m-0 text-white" style="background-color: #4F81BD;">Commodities</h3>
      <div class="col-xs-12 p-2">
        <table class="table table-bordered m-0 p-0 sm-font">
          <tbody>
            <thead>
              <tr>
                <th class="text-center">Product Description</th>
                <th class="text-center"># of Pallets</th>
                <th class="text-center"># of Units</th>
                <th class="text-center">Total Weight</th>
                <th class="text-center">L</th>
                <th class="text-center">W</th>
                <th class="text-center">H</th>
                <th class="text-center">Class</th>
                <th class="text-center">Notes</th>
                <th class="text-center">Rate</th>
              </tr>
            </thead>
            <tr class="text-center">
              <td class="m-0 p-0">{{$shipment->prod_desc}}</td>
              <td class="m-0 p-0">{{$shipment->no_of_pallets}}</td>
              <td class="m-0 p-0">{{$shipment->no_of_pallets}}</td>
              <td class="m-0 p-0">{{$shipment->tot_load_wt}}</td>
              <td class="m-0 p-0">{{$shipment->pallet_length}}</td>
              <td class="m-0 p-0">{{$shipment->pallet_width}}</td>
              <td class="m-0 p-0">{{$shipment->pallet_height}}</td>
              <td class="m-0 p-0">{{$shipment->freight_class}}</td>
              <td class="m-0 p-0">{{$shipment->prod_desc}}</td>
              <td class="m-0 p-0">${{$shipment->tot_load_cost}}</td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </tbody>

        </table>
      </div>
    </div>
  </div>


  <div class="container border border-dark mt-1">
    <div class="row">
      <div class="col col-xs-6 py-0 my-0 border-right border-dark">
        <h4>Shipper</h4>
        <p style="font-size:12px">This is to certify that the above names materials are properly classified, described,
          packaged, marked and
          labeled, and are in proper condition for transportation, according to the applicable regulations of the
          Department of Transportation</p>
      </div>
      <div class="col-xs-4 p-3">
        <input type="text" class="signature" value="X">
        <p style="font-size:12px">Shipper Signature</p>
        <input type="text" class="signature" value="X">
        <p style="font-size:12px">Shipper Printed Name</p>
      </div>
      <div class="col-xs-2 py-3">
        <input style="width:90%" type="text" class="signature" value="">
        <p style="font-size:12px">Date</p>
      </div>
    </div>
  </div>

  <div class="container mt-1 border border-dark">
    <div class="row">

      <div class="col-xs-6 py-0">
        <h4>Consignee</h4>
        <p style="font-size:12px">Received, subject to individually determined rates or contracts that have
          been agreed upon in writing between the carrier and, as applicable,
          shipper or consignee. The property described above, in apparent good
          order, except as noted, every service to be performed hereunder shall be
          subject to all the terms and conditions of the Uniform Bill of Lading set
          forth in the National Motor Freight Classification 100-X and successive
          issues. The shipper or consignee hereby certifies that he is familiar with
          all the terms and conditions of the said bill of lading and the said terms
          and conditions are hereby agreed to by the shipper and accepted.
        </p>
      </div>

      <div class="col col-xs-6 border-left border-dark">
        <div class="row py-3">
          <div class="col-xs-8 my-1">
            <input type="text" class="signature" value="X">
            <p style="font-size:12px">Carrier Signature</p>
            <input type="text" class="signature" value="X">
            <p style="font-size:12px">Carrier Printed Name</p>
          </div>
          <div class="col-xs-4 my-1">
            <input style="width:100%" type="text" class="signature" value="">
            <p style="font-size:12px">Date</p>
          </div>
        </div>

        <div class="row px-3 my-0 border-top border-dark">
          <div class="col-xs-8 p-1">
            <input type="text" class="signature" value="X">
            <p style="font-size:12px">Receiver Signature</p>

            <input type="text" class="signature" value="X">
            <p style="font-size:12px">Receiver Printed Name</p>
          </div>
          <div class="col-xs-4 my-0">
            <input style="width:100%" type="text" class="signature" value="">
            <p style="font-size:12px">Date</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-2 mb-0 p-0">
    <h3 class="text-center text-white m-0 p-2" style="width:100%; background-color: #4F81BD;">Thank you for choosing
      FillStorShip!</h3>
  </div>

</body>

</html>
