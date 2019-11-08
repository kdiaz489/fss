@extends('layouts.app')

@section('content')


<div class="container-fluid bg-whitewash ">
    <div class="container dashboard-container pt-5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs border-1" role="tablist">
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">Shipments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/admin/users">Manage Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/dashboard/admin/inventory">Inventory Requests</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/dashboard/admin/account">Account</a>
            </li>
        </ul>
    </div>

</div>


<div class="container-fluid dashboard-container">
    <div class="jumbotron bg-whitewash mt-5">
        <h1 class="display-4 text-break text-center">Admin Dashboard.</h1>
    </div>

    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

</div>
<div class="container-fluid dashboard-container">


    <div class="row justify-content-center">
        <div class="col-md-12 " style="padding-top: 2%">

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="col-lg-12 col-12">


                <!-- Tab panes -->
                <div class="tab-content">

                        <h1 class="display-4">All Order Requests</h1>

                        @if(count($orders) > 0)
                        <table class="table">
                            <tr>
                                <th>Order ID</th>
                                <th>Update Status</th>
                                <th>Current Status</th>
                                <th>Order Type</th>
                                <th>Submitted On</th>
                                <th>Order Name</th>
                                <th>Description</th>
                                <th>Kits in Order</th>
                                <th>Kit Quantity</th>
                                <th>Units in Order</th>
                                <th>Unit Quantity</th>
                                <th></th>

                            </tr>
                            @foreach($orders as $order)
                            
                            <tr>
                                <td>{{str_pad($order->orderid, 6, '0', STR_PAD_LEFT)}}</td>
                                <td>
                                        <form action=" /order/update/{{$order->id}}" method="POST">
                                            @csrf
                                            {{method_field('PUT')}}
                                            <select name="status" id="" class="">
                                                <option value="" selected disabled>Choose</option>
                                                <option value="Completed">Completed</option>
                                                <option value="In Progress">In Progress</option>
                                                <option value="Cancelled">Cancelled</option>
                                            </select>

                                            <button type="submit" style=" margin-left: 1.25rem;"
                                                class="btn btn-link btn-sm">Update</button>
                                        </form>
                                </td>
                                <td>{{$order->status}}</td>
                                <td>{{$order->order_type}}</td>
                                <td>{{$order->created_at->format('H:i:s m/d/y')}}</td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->description}}</td>
                                <td>
                                    @foreach ($order->kits as $kit)
                                    <a href="/viewkit/{{$kit->id}}"><span
                                            class="badge badge-secondary">{{$kit->kit_sku}}</span></a>
                                    @endforeach
                                </td>
                                <td>{{$order->kit_qty}}</td>
                                <td>
                                    @foreach ($order->basic_units as $unit)

                                    <a href="/viewbasicunit/{{$unit->id}}"><span
                                            class="badge badge-secondary">{{$unit->sku}}</span></a>
                                    @endforeach
                                </td>
                                <td>{{$order->unit_qty}}</td>

                                <td>
                                    <div style="margin-left: 30%">
                                        @if ($order->order_type == 'Transfer In Kits')
                                        <a href="/editorder/kit/{{$order->id}}" class="float-left"
                                            style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                        </a>
                                        @elseif($order->order_type == 'Transfer In Units')
                                        <a href="/editorder/unit/{{$order->id}}" class="float-left"
                                            style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                        </a>
                                        @endif
                                        <a href="/vieworder/{{$order->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">View</button>
                                        </a>
                                        <form action="/order/remove/{{$order->id}}" method="POST" class="float-left">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-link text-danger btn-sm">Remove</button>
                                        </form>
                                    </div>
                                </td>


                            </tr>
                            @endforeach
                        </table>

                        @else
                        <p>You have no orders for your inventory.</p>
                        @endif

                        <h1 class="display-4">All Pallets</h1>

                        @if(count($pallets) > 0)
                        <table class="table">
                            <tr>

                                <th>Pallet Name</th>
                                <th>Sku</th>
                                <th>Description</th>
                                <th>Case Qty</th>
                                <th>Carton Qty</th>
                                <th>Pallet Qty</th>
                                <th>Cases in Pallet</th>
                                

                                <th></th>

                            </tr>
                            @foreach($pallets as $pallet)
                            <tr>
                                <td>{{$pallet->pallet_name}}</td>
                                <td>{{$pallet->sku}}</td>
                                <td>{{$pallet->description}}</td>
                                <td>{{$pallet->case_qty}}</td>
                                <td>{{$pallet->carton_qty}}</td>
                                <td>{{$pallet->pallet_qty}}</td>

                                <td>
                                    @foreach ($pallet->cases as $case)
                                    <a href="/viewcase/{{$case->id}}"><span
                                            class="badge badge-secondary">{{'sku: ' . $case->sku . ' qty: ' . $case->pivot->quantity}}</span></a>


                                    @endforeach
                                </td>
                                
                                <!--
                                <td>{{$pallet->created_at->format('H:i:s m/d/y')}}</td>
                                <td>{{$pallet->updated_at->format('H:i:s m/d/y')}}</td>
                                -->
                                <td>
                                    <div style="margin-left: 30%">

                                        <a href="/editpallet/{{$pallet->id}}" class="float-left"
                                            style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                        </a>

                                        <a href="/viewpallet/{{$pallet->id}}" class="float-left"
                                            style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">View</button>
                                        </a>

                                        <form action="/removepallet/{{$pallet->id}}" method="POST" class="float-left">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-link text-danger btn-sm">Remove</button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>

                        @else
                        <p>You have no pallets in your inventory.</p>
                        @endif

                        <h1 class="display-4">All Cases</h1>
                        @if(count($cases) > 0)
                        <table class="table">
                            <tr>

                                <th>Case Name</th>
                                <th>Case Sku</th>
                                <th>Description</th>
                                <th>Case Qty</th>
                                <th>Carton Qty</th>
                                <th>Pallet Qty</th>
                                <th>Units in Case</th>

                                <th></th>

                            </tr>
                            @foreach($cases as $case)
                            <tr>
                                <td>{{$case->case_name}}</td>
                                <td>{{$case->sku}}</td>
                                <td>{{$case->description}}</td>
                                <td>{{$case->case_qty}}</td>
                                <td>{{$case->carton_qty}}</td>
                                <td>{{$case->pallet_qty}}</td>
                                <td>
                                    @foreach ($case->basic_units as $unit)
                                    <a href="/viewbasicunit/{{$unit->id}}"><span
                                            class="badge badge-secondary">{{'sku: ' . $unit->sku . ' qty: ' . $unit->pivot->quantity}}</span></a>


                                    @endforeach
                                </td>

                                <td>
                                    <div style="margin-left: 30%">
                                        <a href="/editcase/{{$case->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                        </a>
                                        <a href="/viewcase/{{$case->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">View</button>
                                        </a>
                                        <form action="/removecase/{{$case->id}}" method="POST" class="float-left">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-link text-danger btn-sm">Remove</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>

                        @else
                        <p>You have no cases in your inventory.</p>
                        @endif

                        <h1 class="display-4">All Kits</h1>
                        @if(count($kits) > 0)
                        <table class="table">
                            <tr>

                                <th>Kit Name</th>
                                <th>Kit Sku</th>
                                <th>Description</th>
                                <th>Case Qty</th>
                                <th>Pallet Qty</th>
                                <th>Units in Case</th>

                                <th></th>

                            </tr>
                            @foreach($kits as $kit)
                            <tr>
                                <td>{{$kit->kit_name}}</td>
                                <td>{{$kit->sku}}</td>
                                <td>{{$kit->description}}</td>
                                <td>{{$kit->case_qty}}</td>
                                <td>{{$kit->pallet_qty}}</td>
                                <td>
                                    @foreach ($kit->basic_units as $unit)
                                    <a href="/viewbasicunit/{{$unit->id}}"><span
                                            class="badge badge-secondary">{{'sku: ' . $unit->sku . ' qty: ' . $unit->pivot->quantity}}</span></a>


                                    @endforeach
                                </td>

                                <td>
                                    <div style="margin-left: 30%">
                                        <a href="/editkit/{{$kit->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                        </a>
                                        <a href="/viewkit/{{$kit->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">View</button>
                                        </a>
                                        <form action="/removekit/{{$kit->id}}" method="POST" class="float-left">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-link text-danger btn-sm">Remove</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>

                        @else
                        <p>You have no kits in your inventory.</p>
                        @endif

                        <h1 class="display-4">All Units</h1>
                        @if(count($units) > 0)
                        <table class="table">
                            <tr>

                                <th>Unit Name</th>
                                <th>Unit Sku</th>
                                <th>Description</th>
                                <th>Loose Item Qty</th>
                                <th>Case Qty</th>
                                <th>Pallet Qty</th>
                                <th>Total Qty</th>

                                <th></th>

                            </tr>
                            @foreach($units as $unit)
                            <tr>
                                <td>{{$unit->unit_name}}</td>
                                <td>{{$unit->sku}}</td>
                                <td>{{$unit->description}}</td>
                                <td>{{$unit->loose_item_qty}}</td>
                                <td>{{$unit->case_qty}}</td>
                                <td>{{$unit->pallet_qty}}</td>
                                <td>{{$unit->total_qty}}</td>

                                <td>
                                    <div style="margin-left: 30%">
                                        <a href="/editbasicunit/{{$unit->id}}" class="float-left"
                                            style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                        </a>
                                        <a href="/viewbasicunit/{{$unit->id}}" class="float-left"
                                            style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">View</button>
                                        </a>
                                        <form action="/removebasicunit/{{$unit->id}}" method="POST" class="float-left">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-link text-danger btn-sm">Remove</button>
                                        </form>
                                    </div>
                                </td>


                            </tr>
                            @endforeach
                        </table>

                        @else
                        <p>You have no kits in your inventory.</p>
                        @endif
                </div>
            </div>
        </div>
    </div>

    @endsection