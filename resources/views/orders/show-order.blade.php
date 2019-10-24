@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 2%">
    <a href="/dashboard#inventoryrequests" class="btn btn-link text-frenchblue" style="margin-right:2%"><i
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

                    @foreach ($order->kits as $kit)
                        @if ($kit->basic_units != null)
                            @foreach($kit->basic_units as $unit)
                                <a href="/viewbasicunit/{{$unit->id}}"><span class="badge badge-secondary">{{'Unit Sku: ' . $unit->sku}}</span></a>
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
                            class="badge badge-secondary">{{'Kit Sku: ' . $kit->kit_sku}}</span></a>
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
                    @foreach ($order->cases as $case)
                    <a href="/viewcase/{{$case->id}}"><span
                            class="badge badge-secondary">{{'Case Sku: ' . $case->sku}}</span></a>
                    @endforeach
                </td>
            </tr>

            <tr>
                <th scope="row">Carton Quantity</th>
                <td>{{$order->carton_qty}}</td>
            </tr>
        </tbody>
    </table>

</div>

@endsection()