@extends('layouts.app')

@section('content')

<!-- Modal -->
<div class="modal fade editModal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer m-auto">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary">Save</button>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid bg-whitewash ">
    <div class="container dashboard-container pt-5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs border-1" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#allshipments" role="tab" data-toggle="tab">Shipments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#inventoryrequests" role="tab" data-toggle="tab">Inventory</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#account" role="tab" data-toggle="tab">Account</a>
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
                    <div role="tabpanel" class="tab-pane active" id="allshipments">
                        <h1 class="display-4">Shipments</h1>

                        <br>
                        <a href="/ship" class="btn btn-outline-secondary">Quick Quote</a>
                        <a href="/ship/book" class="btn btn-outline-secondary">Book Shipment</a>

                        <br>
                        <br>
                        @if(count($shipments) > 0)
                        <table class="table">
                            <tr>
                                <th>Shipment Destination</th>
                                <th>Submitted On</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            @foreach($shipments as $shipment)
                            <tr>
                                <td>{{$shipment->dest_company}}</td>
                                <td>{{$shipment->created_at->format('H:i:s m/d/y')}}</td>
                                <td>{{$shipment->work_status}}</td>
                                <td>
                                    <div style="margin-left: 40%">
                                        <a href="/ship/{{$shipment->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-secondary btn-sm" type="button">View</button>
                                        </a>
                                        <a href="/pdf/{{$shipment->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">Export PDF</button>
                                        </a>
                                        <form action="/ship/cancel/{{$shipment->id}}" method="POST" class="float-left">
                                            @method('PUT')
                                            @csrf

                                            <button type="submit"
                                                class="btn btn-link text-danger btn-sm">Cancel</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        @else
                        <p>You have no shipments.</p>
                        @endif
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="inventoryrequests">
                        <br>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        <button id="btnGroupDrop1" type="button" class="btn bg-frenchblue text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        <button id="btnGroupDrop1" type="button" class="btn bg-denim text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                <th>Total Unit Quantity</th>
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

                                <td>
                                    <div style="margin-left: 10%">
                                        
                                        <a href="/vieworder/{{$order->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button" >View</button>
                                        </a>
                                        <form action="/order/remove/{{$order->id}}" method="POST" class="float-left">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-link text-danger btn-sm">Remove</button>
                                        </form>
                                    </div>
                                </td>


                            </tr>
                            @endforeach
                        </table>

                        @else
                        <p>You have no orders for your inventory.</p>
                        @endif

                    <h1 class="display-4">Pallets</h1>

                        @if(count($pallets) > 0)
                        <table class="table">
                            <tr>
                                
                                <th>Pallet Name</th>
                                <th>Sku</th>
                                <th>Description</th>
                                <th>Case Qty</th>
                                <th>Carton Qty</th>
                                <th>Pallet Qty</th>
                                <th>Cases per Pallet</th>
                                <th>Submitted On</th>
                                <th>Updated On</th>
                                
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
                                    <a href="/viewbasicunit/{{$case->id}}"><span class="badge badge-secondary">{{'sku: ' . $case->sku . ' qty: ' . $case->pivot->quantity}}</span></a>
                                        
                                        
                                    @endforeach
                                </td>
                                <td>{{$pallet->created_at->format('H:i:s m/d/y')}}</td>
                                <td>{{$pallet->updated_at->format('H:i:s m/d/y')}}</td>

                                <td>
                                    <div style="margin-left: 30%">
                                    
                                        <a href="/editpallet/{{$pallet->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                        </a>
                                    
                                        <a href="/viewpallet/{{$pallet->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">View</button>
                                        </a>
                                        
                                        <form action="/removepallet/{{$pallet->id}}" method="POST" class="float-left">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-link text-danger btn-sm">Remove</button>
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
                                <th>Case Sku</th>
                                <th>Description</th>
                                <th>Case Qty</th>
                                <th>Carton Qty</th>
                                <th>Pallet Qty</th>
                                <th>Units in Case</th>
                                <th>Submitted On</th>
                                <th>Updated On</th>
                                
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
                                    <a href="/viewbasicunit/{{$unit->id}}"><span class="badge badge-secondary">{{'sku: ' . $unit->sku . ' qty: ' . $unit->pivot->quantity}}</span></a>
                                        
                                        
                                    @endforeach
                                </td>
                                <td>{{$case->created_at->format('H:i:s m/d/y')}}</td>
                                <td>{{$case->updated_at->format('H:i:s m/d/y')}}</td>

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
                                            <button type="submit" class="btn btn-link text-danger btn-sm">Remove</button>
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
                                <th>Cartson Qty</th>
                                <th>Units</th>
                                <th>Submitted On</th>
                                <th>Updated On</th>
                                
                                <th></th>

                            </tr>
                            @foreach($kits as $kit)
                            <tr>
                                <td>{{$kit->kit_name}}</td>
                                <td>{{$kit->kit_sku}}</td>
                                <td>{{$kit->kit_desc}}</td>
                                <td>{{$kit->kit_qty}}</td>
                                <td>{{$kit->case_qty}}</td>
                                <td>{{$kit->carton_qty}}</td>
                                
                                <td>
                                    @foreach ($kit->basic_units as $unit)
                                    <a href="/viewbasicunit/{{$unit->id}}"><span class="badge badge-secondary">{{$unit->sku}}</span></a>
                                        
                                        
                                    @endforeach
                                </td>
                                <td>{{$kit->created_at->format('H:i:s m/d/y')}}</td>
                                <td>{{$kit->updated_at->format('H:i:s m/d/y')}}</td>

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
                                            <button type="submit" class="btn btn-link text-danger btn-sm">Remove</button>
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
                                <th>Kit Qty</th>
                                <th>Case Qty</th>
                                <th>Carton Qty</th>
                                <th>Total Quantity</th>
                                
                                
                                
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
                                <td>{{$unit->carton_qty}}</td>
                                <td>{{$unit->total_qty}}</td>
                                <!--
                                <td>{{$unit->created_at->format('H:i:s m/d/y')}}</td>
                                <td>{{$unit->updated_at->format('H:i:s m/d/y')}}</td>
                                -->

                                <td>
                                    <div style="margin-left: 30%">
                                        <a href="/editbasicunit/{{$unit->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                        </a>
                                        <a href="/viewbasicunit/{{$unit->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">View</button>
                                        </a>
                                        
                                        <form action="/removebasicunit/{{$unit->id}}" method="POST" class="float-left">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-link text-danger btn-sm">Remove</button>
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


                        <!--
                        <h1 class="display-4">Orders in Process</h1>
                        <br>
                        
                        
                        @if(count($storagework) > 0)
                         <table class="table table-bordered" style="display: block; overflow-x: auto; white-space: nowrap;">
                            <tr>
                                <th></th>
                                <th>work_status</th>
                                <th>company</th>
                                <th>user_id</th>
                                <th>sku</th>
                                <th>description</th>
                                <th>inb_carton</th>
                                <th>inb_case</th>
                                <th>inb_item</th>
                                <th>inb_tot_qty</th>
                                <th>out_carton</th>
                                <th>out_case</th>
                                <th>out_item</th>
                                <th>out_tot_qty</th>
                                <th>elim_carton</th>
                                <th>elim_case</th>
                                <th>elim_item</th>
                                <th>elim_tot_qty</th>
                                <th>building</th>
                                <th>row_</th>
                                <th>col_</th>
                                <th>created_at</th>
                                <th>updated_at</th>
                                
                            </tr>
                            @foreach($storagework as $item)
                            <tr>
                                <td>
                                    <div>
                                        <a href="/stor/{{$item->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">View</button>
                                        </a>
                                        <form action="/stor/cancel/{{$item->id}}" method="POST" class="float-left">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-link text-danger btn-sm">Cancel</button>
                                        </form>
                                    </div>
                                </td>
                                <td>{{$item->work_status}}</td>
                                <td>{{$item->company}}</td>
                                <td>{{$item->user_id}}</td>
                                <td>{{$item->sku}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->inb_carton}}</td>
                                <td>{{$item->inb_case}}</td>
                                <td>{{$item->inb_item}}</td>
                                <td>{{$item->inb_tot_qty}}</td>
                                <td>{{$item->out_carton}}</td>
                                <td>{{$item->out_case}}</td>
                                <td>{{$item->out_item}}</td>
                                <td>{{$item->out_tot_qty}}</td>
                                <td>{{$item->elim_carton}}</td>
                                <td>{{$item->elim_case}}</td>
                                <td>{{$item->elim_item}}</td>
                                <td>{{$item->elim_tot_qty}}</td>
                                <td>{{$item->building}}</td>
                                <td>{{$item->row_}}</td>
                                <td>{{$item->column_}}</td>
                                <td>{{$item->created_at->format('H:i:s m/d/y')}}</td>
                                <td>{{$item->updated_at->format('H:i:s m/d/y')}}</td>




                            </tr>
                            @endforeach
                        </table>

                        @else
                        <p>You have no inventory requests.</p>
                        @endif
                        -->

                    </div>


                    <div role="tabpanel" class="tab-pane" id="account">
                        <div class="container dashboard-container">

                        

                        
                        <h1 class="display-4">Account Balance</h1>
                        <br>
                        <br>
                        <table class="table">
                            <tr>
                                <th>User</th>
                                <th>Company</th>
                                <th>Remaining Balance</th>
                                <th></th>
                            </tr>
                           
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->company_name}}</td>
                                <td>{{'$' . $user->account_balance}}</td>
                                <td>
                                    <div style="margin-left: 40%">
                                        <a href="/makepayment/{{$user->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-secondary btn-sm" type="button">Make a Payment</button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            
                        </table>
                       

                            <h1 class="display-4">Account Settings</h1>
                            <br>
                            <br>
                            <div class="container-fluid px-5" style="border: solid 1px #dee2e6; border-radius: 10px">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h2 class="mt-4">Profile</h2>
                                    </div>
                                </div>

                                <div class="row py-5 border-bottom">
                                    <div class="col-lg-4">
                                        <h5>Username:</h5>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5>{{auth()->user()->user_name}}</h5>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="" href="" class="editusername" id=""><i
                                                class="fas fa-pencil-alt"></i></a>
                                    </div>

                                </div>

                                <div class="row py-5 border-bottom">
                                    <div class="col-lg-4">
                                        <h5>E-Mail:</h5>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5>{{auth()->user()->email}}</h5>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="" class="editemail" id=""><i class="fas fa-pencil-alt"></i></a>
                                    </div>

                                </div>

                                <div class="row py-5 ">
                                    <div class="col-lg-4">
                                        <h5>Password:</h5>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="password" style="border:none;"
                                            value={{auth()->user()->password}} />
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="" class="editpass" id=""><i class="fas fa-pencil-alt"></i></a>
                                    </div>

                                </div>
                            </div>

                            <div class="container-fluid px-5 mt-4"
                                style="border: solid 1px #dee2e6; border-radius: 10px">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h2 class="mt-4">Contact Info</h2>
                                    </div>
                                </div>
                                <div class="row py-5 border-bottom">
                                    <div class="col-lg-4">
                                        <h5>Company Name:</h5>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5>{{auth()->user()->company_name}}</h5>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="" href="" class="editcompanyname" id=""><i
                                                class="fas fa-pencil-alt"></i></a>
                                    </div>

                                </div>

                                <div class="row py-5 border-bottom">
                                    <div class="col-lg-4">
                                        <h5>Contact Name:</h5>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5>{{auth()->user()->name}}</h5>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="" class="editcontact" id=""><i class="fas fa-pencil-alt"></i></a>
                                    </div>

                                </div>

                                <div class="row py-5 ">
                                    <div class="col-lg-4">
                                        <h5>Address:</h5>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5>{{auth()->user()->street_address.' '.auth()->user()->city.', '.auth()->user()->state. ' '.auth()->user()->zip}}
                                        </h5>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="" class="editaddress" id=""><i class="fas fa-pencil-alt"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>



        </div>
    </div>
</div>
@endsection
