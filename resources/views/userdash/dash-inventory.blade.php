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
                <a class="nav-link active" href="/dashboard/user/inventory">Inventory</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/dashboard/user/account">Account</a>
            </li>

        </ul>
    </div>

</div>


<div class="container-fluid dashboard-container">
    <div class="jumbotron bg-whitewash mt-5">
        <h1 class="display-4 text-break text-center">Welcome to your Dashboard, {{ Auth::user()->name }}.</h1>
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
                    <br>
                    
                        <br>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Transfer In
                            </button>
                            <div class="dropdown-menu bg-whitewash" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="/transinunit">Units</a>
                                <a class="dropdown-item" href="/transinkit">Kits</a>
                                <a class="dropdown-item" href="/transincase">Cases</a>
                                <a class="dropdown-item" href="/transinpallet">Pallets</a>
                            </div>
                        </div>


                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button"
                                class="btn bg-frenchblue text-white dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Transfer Out
                            </button>
                            <div class="dropdown-menu bg-whitewash" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="/transoutunit">Units</a>
                                <a class="dropdown-item" href="/transoutkit">Kits</a>
                                <a class="dropdown-item" href="/transoutcase">Cases</a>
                                <a class="dropdown-item" href="/transoutpallet">Pallets</a>
                            </div>
                        </div>


                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn bg-denim text-white dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-plus"></i> Create
                            </button>
                            <div class="dropdown-menu bg-whitewash" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="/basicunit">Units</a>
                                <a class="dropdown-item" href="/createkit">Kits</a>
                                <a class="dropdown-item" href="/createcase">Cases</a>
                                <a class="dropdown-item" href="/createpallet">Pallet</a>
                            </div>
                        </div>

                        <br>
                        <br>

                        <h1 class="display-4">Orders</h1>

                        @if(count($orders) > 0)
                        <table class="table">
                            <tr>
                                <th>Order ID</th>
                                <th>Order Type</th>
                                <th>Submitted On</th>
                                <th>Order Name</th>
                                <th>Description</th>
                                <th>Unit Quantity</th>
                                <th>Case Quantity</th>
                                <th>Pallet Quantity</th>
                                <th></th>

                            </tr>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{str_pad($order->id, 6, '0', STR_PAD_LEFT)}}</td>
                                <td>{{$order->order_type}}</td>
                                <td>{{$order->created_at->format('H:i:s m/d/y')}}</td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->description}}</td>
                                <td>{{$order->unit_qty}}</td>
                                <td>{{$order->case_qty}}</td>
                                <td>{{$order->pallet_qty}}</td>

                                <td>
                                    <div style="margin-left: 10%">

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
                        <p>You have no pending orders.</p>
                        @endif

                        <h1 class="display-4">Pallets</h1>

                        @if(count($pallets) > 0)
                        <table class="table">
                            <tr>

                                <th>Pallet Name</th>
                                <th>Sku</th>
                                <th>Description</th>
                                <th>Pallet Qty</th>
                                <th>Units per Pallet</th>
                                <th>Kits per Pallet</th>
                                <th>Cases per Pallet</th>
                                
                                

                                <th></th>

                            </tr>
                            @foreach($pallets as $pallet)
                            <tr>
                                <td>{{$pallet->pallet_name}}</td>
                                <td>{{$pallet->sku}}</td>
                                <td>{{$pallet->description}}</td>
                                <td>{{$pallet->pallet_qty}}</td>
                                <td>
                                    @foreach ($pallet->basic_units as $unit)
                                    <a href="/viewbasicunit/{{$unit->id}}"><span
                                            class="badge badge-secondary">{{'sku: ' . $unit->sku . ' qty: ' . $unit->pivot->quantity}}</span></a>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($pallet->kits as $kit)
                                    <a href="/viewkit/{{$kit->id}}"><span
                                            class="badge badge-secondary">{{'sku: ' . $kit->sku . ' qty: ' . $kit->pivot->quantity}}</span></a>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($pallet->cases as $case)
                                    <a href="/viewcase/{{$case->id}}"><span
                                            class="badge badge-secondary">{{'sku: ' . $case->sku . ' qty: ' . $case->pivot->quantity}}</span></a>
                                    @endforeach
                                </td>
                                
                                <td>
                                    <div style="margin-left: 30%">
                                        <!--
                                        <a href="/editpallet/{{$pallet->id}}" class="float-left"
                                            style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                        </a>
                                        -->

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

                        <h1 class="display-4">Cases</h1>

                        @if(count($cases) > 0)
                        <table class="table">
                            <tr>

                                <th>Case Name</th>
                                <th>Sku</th>
                                <th>Description</th>
                                <th>Case Qty</th>
                                <th>Pallet Qty</th>
                                <th>Total Qty</th>
                                <th>Units per Case</th>
                                <th>Kits per Case</th>
                                

                                <th></th>

                            </tr>
                            @foreach($cases as $case)
                            <tr>
                                <td>{{$case->case_name}}</td>
                                <td>{{$case->sku}}</td>
                                <td>{{$case->description}}</td>
                                <td>{{$case->case_qty}}</td>
                                <td>{{$case->pallet_qty}}</td>
                                <td>{{$case->total_qty}}</td>

                                <td>
                                    @foreach ($case->basic_units as $unit)
                                    <a href="/viewbasicunit/{{$unit->id}}" ><span
                                            class="badge badge-secondary">{{'sku: ' . $unit->sku . ' qty: ' . $unit->pivot->quantity}}</span></a>


                                    @endforeach
                                </td>

                                <td>
                                    @foreach ($case->kits as $kit)
                                    <a href="/viewkit/{{$kit->id}}" ><span
                                            class="badge badge-secondary">{{'sku: ' . $kit->sku . ' qty: ' . $kit->pivot->quantity}}</span></a>


                                    @endforeach
                                </td>
                                

                                <td>
                                    <div style="margin-left: 30%">
                                        <!--
                                        <a href="/editcase/{{$case->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                        </a>
                                        -->

                                        <a href="/viewcase/{{$case->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">View</button>
                                        </a>

                                        <form action="/removecase/{{$case->id}}" method="POST" class="float-left" style="margin-right:1%">
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

                        
                        <h1 class="display-4">Kits</h1>

                        @if(count($kits) > 0)
                        <table class="table">
                            <tr>

                                <th>Kit Name</th>
                                <th>Kit Sku</th>
                                <th>Description</th>
                                <th>Kit Qty</th>
                                <th>Case Qty</th>
                                <th>Carton Qty</th>
                                <th>Units</th>
                                <th>Submitted On</th>
                                

                                <th></th>

                            </tr>
                            @foreach($kits as $kit)
                            <tr>
                                <td>{{$kit->kit_name}}</td>
                                <td>{{$kit->sku}}</td>
                                <td>{{$kit->description}}</td>
                                <td>{{$kit->kit_qty}}</td>
                                <td>{{$kit->case_qty}}</td>
                                <td>{{$kit->carton_qty}}</td>

                                <td>
                                    @foreach ($kit->basic_units as $unit)
                                    <a href="/viewbasicunit/{{$unit->id}}"><span
                                            class="badge badge-secondary">{{ 'sku: ' . $unit->sku . ' qty: ' . $unit->pivot->quantity}}</span></a>


                                    @endforeach
                                </td>
                                <td>{{$kit->created_at->format('H:i:s m/d/y')}}</td>
                               

                                <td>
                                    
                                    <div style="margin-left: 30%">
                                        <!--
                                        <a href="/editkit/{{$kit->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                        </a>
                                        -->
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
                        


                        <h1 class="display-4">Units</h1>
                        @if(count($basic_units) > 0)
                        <table class="table">
                            <tr>

                                <th>Unit Name</th>
                                <th>Unit Sku</th>
                                <th>Description</th>
                                <th>Loose Item Qty</th>
                                <th>Kit Quantity</th>
                                <th>Case Qty</th>
                                <th>Pallet Qty</th>
                                <th>Total</th>



                                <th></th>

                            </tr>
                            @foreach($basic_units as $unit)
                            <tr>
                                <td>{{$unit->unit_name}}</td>
                                <td>{{$unit->sku}}</td>
                                <td>{{$unit->desc}}</td>
                                <td>{{$unit->loose_item_qty}}</td>
                                <td>{{$unit->kit_qty}}</td>
                                <td>{{$unit->case_qty}}</td>
                                
                                <td>{{$unit->pallet_qty}}</td>
                                <td>{{$unit->total_qty}}</td>
                                <td>
                                    <div style="margin-left: 30%">
                                        <!--
                                        <a href="/editbasicunit/{{$unit->id}}" class="float-left"
                                            style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                        </a>
                                        -->
                                        <a href="/viewbasicunit/{{$unit->id}}" class="float-left"
                                            style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">View</button>
                                        </a>

                                        <form action="/removebasicunit/{{$unit->id}}" method="POST" class="float-left" style="margin-right:1%">
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
                        <p>You have no units in your inventory.</p>
                        @endif

                        <br>
                        <br>


                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection