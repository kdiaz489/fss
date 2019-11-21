@extends('layouts.userdashboard')

@section('content')
<div class="container" style="margin-top: 2%">
    <a onclick="history.back()" class="btn btn-link text-frenchblue" style="margin-right:2%"><i
            class="fas fa-long-arrow-alt-left"></i> Go Back</a>

    <br>
    <br>

    <hr>

    <h1>Order ID: #{{$order->id}}</h1>
    <table class="table">

        <tbody>

            <thead class="thead-light">
                <tr>
                    <th>Details</th>
                    <th></th>
                </tr>
            </thead>

            <tr>
                <th scope="row">Order User Id</th>
                <td>{{$order->user_id}}</td>
            </tr>

            <tr>
                <th scope="row">Order Name</th>
                <td>{{$order->name}}</td>
            </tr>

            <tr>
                <th scope="row">Company</th>
                <td>{{$order->company}}</td>
            </tr>

            <tr>
                <th scope="row">Order Type</th>
                <td>{{$order->order_type}}</td>
            </tr>

            <tr>
                <th scope="row">Barcode</th>
                <td>{{$order->barcode}}</td>
            </tr>

            <tr>
                <th scope="row">Description</th>
                <td>{{$order->description}}</td>
            </tr>

            <tr>
                <th scope="row">Unit Quantity</th>
                <td>{{$order->unit_qty}}</td>
            </tr>

            <tr>
                <th scope="row">Units in Order</th>
                <td>
                    @foreach ($order->basic_units as $unit)
                    <a href="/viewunit/{{$unit->id}}"><span
                            class="badge badge-secondary">{{'Unit Sku: ' . $unit->sku}}</span></a>
                    @endforeach

                    @foreach ($order->pallets as $pallet)
                        @if ($pallet->basic_units != null)
                            @foreach($pallet->basic_units as $unit)
                                <a href="/viewbasicunit/{{$unit->id}}"><span class="badge badge-secondary">{{'Unit Sku: ' . $unit->sku}}</span></a>
                            @endforeach
                        @endif

                        @if ($pallet->cases != null)
                            @foreach($pallet->cases as $case)
                                @if ($case->basic_units != null)
                                    @foreach ($case->basic_units as $unit)
                                        <a href="/viewbasicunit/{{$unit->id}}"><span class="badge badge-secondary">{{'Unit Sku: ' . $unit->sku}}</span></a>
                                    @endforeach
                                @endif
                            @endforeach
                        @endif

                    @endforeach

                </td>
            </tr>

            <tr>
                <th scope="row">Kit Quantity</th>
                <td>{{$order->kit_qty}}</td>
            </tr>


            <tr>
                <th scope="row">Kits in Order</th>
                <td>
                    @foreach ($order->kits as $kit)
                    <a href="/viewkit/{{$kit->id}}"><span
                            class="badge badge-secondary">{{'Kit Sku: ' . $kit->sku}}</span></a>
                    @endforeach
                </td>
            </tr>

            <tr>
                <th scope="row">Case Quantity</th>
                <td>{{$order->case_qty}}</td>
            </tr>

            <tr>
                <th scope="row">Cases in Order</th>
                <td>
                    @foreach ($order->pallets as $pallet)
                        @if ($pallet->cases != null)
                            @foreach ($pallet->cases as $case)
                                <a href="/viewcase/{{$case->id}}"><span
                                        class="badge badge-secondary">{{'Case Sku: ' . $case->sku}}</span></a>
                            @endforeach
                        @endif
                    @endforeach
                </td>
            </tr>
            
            <tr>
                <th scope="row">Carton Quantity</th>
                <td>{{$order->carton_qty}}</td>
            </tr>

            <tr>
                <th scope="row">Cartons in Order</th>
                <td>
                    
                        @if ($order->cartibs != null)
                            @foreach ($order->cartons as $carton)
                                <a href="/viewcarton/{{$carton->id}}"><span
                                        class="badge badge-secondary">{{'Sku: ' . $carton->sku}}</span></a>
                            @endforeach
                        @endif
                    
                </td>
            </tr>

            <tr>
                <th scope="row">Pallet Quantity</th>
                <td>{{$order->pallet_qty}}</td>
            </tr>

            <tr>
                <th scope="row">Pallets in Order</th>
                <td>
                    @if ($order->pallets != null)

                        @foreach ($order->pallets as $pallet)

                                <a href="/viewpallet/{{$pallet->id}}"><span
                                        class="badge badge-secondary">{{'Pallet Sku: ' . $pallet->sku}}</span></a>
                            
                        @endforeach
                        
                    @endif
                </td>
            </tr>

        </tbody>
    </table>

</div>

@endsection()