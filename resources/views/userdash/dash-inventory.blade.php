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


                    <a href="/createtransin" class="btn btn-outline-secondary">Transfer In</a>
                    <a href="/createtransout" class="btn btn-secondary">Transfer Out</a>

                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn bg-denim text-white dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-plus"></i> Create
                        </button>
                        <div class="dropdown-menu bg-whitewash" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="/basicunit">Units</a>
                            <a class="dropdown-item" href="/createkit">Kits</a>
                            <a class="dropdown-item" href="/createcase">Cases</a>
                        </div>
                    </div>

                    <br>
                    <br>

                    <h1 class="display-4">Orders</h1>

                    @if(count($orders) > 0)
                    <div class="table-responsive">
                    <table class="table orders">
                        <tr>
                            <th></th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Submitted On</th>
                            <th>Updated On</th>
                            <th></th>

                        </tr>
                        @foreach($orders as $order)
                        @if ($order->status != 'Completed')

                        <tr>
                            <td><button type="button" class="btn text-denim toggle-{{$order->id}}" id="toggle-details{{$order->id}}" data-toggle="collapse" data-target="#details{{$order->id}}" aria-expanded="false" aria-controls="details" data-delay="0"><i class="fas fa-plus"></i></button></td>
                            <td>
                                <a href="/vieworder/{{$order->id}}">
                                    <button class="btn btn-link text-denim btn-sm px-0 "
                                        type="button">{{str_pad($order->orderid, 6, '0', STR_PAD_LEFT)}}</button>
                                </a></td>
                            <td>{{$order->company}}</td>
                            <td>{{$order->status}}</td>
                            <td>{{$order->created_at->format('H:i:s m/d/y')}}</td>
                            <td>{{$order->updated_at->format('H:i:s m/d/y')}}</td>
                            

                            <td>
                                <div style="margin-left: 10%">

                                    <a href="/vieworder/{{$order->id}}" class="float-left" style="margin-right:1%">
                                        <button class="btn btn-link text-denim btn-sm" type="button">View</button>
                                    </a>
                                    <form action="/order/remove/{{$order->id}}" method="POST" class="float-left">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-link text-danger btn-sm">Remove</button>
                                    </form>
                                </div>
                            </td>
                            </tr>

                            @if($order->basic_units->all())
                                @foreach ($order->basic_units->all() as $unit)
                                    
                                    <tr class="bg-whitewash">
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse text-wrap" ><i class="fas fa-angle-right text-gunmetal"></i> {{$unit->sku}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" >Quantity: {{$unit->pivot->quantity}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 px-5 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ><a class="btn btn-link text-success float-right" href="/viewbasicunit/{{$unit->id}}">View</a></div></td>
                                    
                                    
                                    </tr>
                                @endforeach
                            @endif

                            @if($order->kits->all())
                                @foreach ($order->kits->all() as $kit)
                                    <tr class="bg-whitewash">
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ><i class="fas fa-angle-right text-gunmetal"></i>  {{$kit->sku}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" >Quantity: {{$kit->pivot->quantity}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 px-5 border-0 "><div  id="details{{$order->id}}" class="accordion-body details collapse" ><a href="/viewkit/{{$kit->id}}" class="btn btn-link text-success float-right">View</a></div></td>
                                    </tr>
                                @endforeach
                            @endif


                            @if($order->cases->all())
                                @foreach ($order->cases->all() as $case)
                                    <tr class="bg-whitewash">
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ><i class="fas fa-angle-right text-gunmetal"></i>  {{$case->sku}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" >Quantity: {{$case->pivot->quantity}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 px-5 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ><a href="/viewcase/{{$case->id}}" class="btn btn-link text-success float-right">View</a></div></td>
                                    </tr>
                                @endforeach
                            @endif

                            @if($order->cartons->all())
                                @foreach ($order->cartons->all() as $carton)
                                    <tr class="bg-whitewash">
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ><i class="fas fa-angle-right text-gunmetal"></i>  {{$carton->sku}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" >Quantity: {{$carton->pivot->quantity}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 px-5 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" style="margin-left: 30%"><a href="/viewcarton/{{$carton->id}}" class="btn btn-link text-success float-left">View</a></div></td>
                                    </tr>
                                @endforeach
                            @endif

                            @if($order->pallets->all())
                                @foreach ($order->pallets->all() as $pallet)
                                    <tr class="bg-whitewash">
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ><i class="fas fa-angle-right text-gunmetal"></i>  {{$pallet->sku}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" >Quantity: {{$pallet->pivot->quantity}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 px-5 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ><a href="/viewpallet/{{$pallet->id}}" class="btn btn-link text-success float-right">View</a></div></td>
                                @endforeach
                            @endif


                        @endif
                        @endforeach
                    </table>
                    </div>
                    @else
                    <p>You have 0 pending orders.</p>
                    @endif

                    <h1 class="display-4">Pallets</h1>

                    @if(count($pallets) > 0)
                    <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th></th>
                            <th>Sku</th>
                            <th>Description</th>
                            <th>Cartons per Pallet</th>
                            <th>Cases per Pallet</th>
                            <th>Kits per Pallet</th>
                            <th>Total # Pallets</th>
                            <th></th>

                        </tr>
                        @foreach($pallets as $pallet)
                        <tr>
                            <td><button type="button" class="btn text-denim toggle-{{$pallet->id}}" id="toggle-details{{$pallet->id}}" data-toggle="collapse" data-target="#details{{$pallet->id}}" aria-expanded="false" aria-controls="details" data-delay="0"><i class="fas fa-plus"></i></button></td>
                            
                            <td>{{$pallet->sku}}</td>
                            <td>{{$pallet->description}}</td>
                            
                            <td>{{$pallet->carton_qty}}</td>
                            <td>{{$pallet->case_qty}}</td>
                            <td>{{$pallet->kit_qty}}</td>
                            <td>{{$pallet->total_qty}}</td>
                            <td>
                                <div style="margin-left: 30%">
                                    <!--
                                        <a href="/editpallet/{{$pallet->id}}" class="float-left"
                                            style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                        </a>
                                        -->

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
                            @if($pallet->basic_units->all())
                                @foreach ($pallet->basic_units->all() as $unit)
                                    
                                    <tr class="bg-whitewash">
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ><i class="fas fa-angle-right text-gunmetal"></i>  {{$unit->sku}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" >Quantity: {{$unit->pivot->quantity}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ></div></td>
                                    
                                    
                                    <td class="py-0 px-5 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ><a href="/viewbasicunit/{{$unit->id}}" class="btn btn-link text-success float-right">View</a></div></td>
                                    </tr>
                                @endforeach
                            @endif

                            @if($pallet->cartons->all())
                                @foreach ($pallet->cartons->all() as $carton)
                                    
                                    <tr class="bg-whitewash">
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ><i class="fas fa-angle-right text-gunmetal"></i>  {{$carton->sku}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" >Quantity: {{$carton->pivot->quantity}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ></div></td>
                                    
                                    
                                    <td class="py-0 px-5 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" style="margin-left: 30%"><a href="/viewcarton/{{$carton->id}}" class="btn btn-link text-success float-left" style="margin-left: 1%">View</a></div></td>
                                    </tr>
                                @endforeach
                            @endif

                            @if($pallet->kits->all())
                                @foreach ($pallet->kits->all() as $kit)
                                    <tr class="bg-whitewash">
                                    <td class="py-0 border-0 "><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ><i class="fas fa-angle-right text-gunmetal"></i>  {{$kit->sku}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" >Quantity: {{$kit->pivot->quantity}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ></div></td>
                                    
                                    
                                    <td class="py-0 px-5 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ><a href="/viewkit/{{$kit->id}}" class="btn btn-link text-success float-right">View</a></div></td>
                                    </tr>
                                @endforeach
                            @endif


                            @if($pallet->cases->all())
                                @foreach ($pallet->cases->all() as $case)
                                    <tr class="bg-whitewash">
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ><i class="fas fa-angle-right text-gunmetal"></i>  {{$case->sku}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse " >Quantity: {{$case->pivot->quantity}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ></div></td>
                                    
                                    <td class="py-0 px-5 border-0"><div  id="details{{$pallet->id}}" class="accordion-body details collapse" ><a href="/viewcase/{{$case->id}}" class="btn btn-link text-success float-right">View</a></div></td>
                                    </tr>
                                @endforeach
                            @endif

                        @endforeach
                    </table>
                    </div>
                    @else
                    <p>You have 0 pallets.</p>
                    @endif

                    <h1 class="display-4">Cartons</h1>

                    @if(count($cartons) > 0)
                    <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th></th>
                            
                            <th>Sku</th>
                            <th>Description</th>
                            <th>Cases per Carton</th>
                            <th>Kits per Carton</th>
                            <th>Units per Carton</th>
                            <th>Total # Cartons</th>
                            <th></th>

                        </tr>
                        @foreach($cartons as $carton)
                        <tr>
                            <td><button type="button" class="btn text-denim toggle-{{$carton->id}}" id="toggle-details{{$carton->id}}" data-toggle="collapse" data-target="#details{{$carton->id}}" aria-expanded="false" aria-controls="details" data-delay="0"><i class="fas fa-plus"></i></button></td>
                            
                            <td>{{$carton->sku}}</td>
                            <td>{{$carton->description}}</td>
                            <td>{{$carton->case_qty}}</td>
                            <td>{{$carton->kit_qty}}</td>
                            <td>{{$carton->basic_unit_qty}}</td>
                            <td>{{$carton->total_qty}}</td>
                            <td>
                                <div style="margin-left: 30%">
                                    <!--
                                        <a href="/editcarton/{{$carton->id}}" class="float-left"
                                            style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                        </a>
                                        -->

                                    <a href="/viewcarton/{{$carton->id}}" class="float-left" style="margin-right:1%">
                                        <button class="btn btn-link text-denim btn-sm" type="button">View</button>
                                    </a>

                                    <form action="/removecarton/{{$carton->id}}" method="POST" class="float-left">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-link text-danger btn-sm">Remove</button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                            @if($carton->basic_units->all())
                                @foreach ($carton->basic_units->all() as $unit)
                                    
                                    <tr class="bg-whitewash">
                                        
                                    <td class="py-0 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" ><i class="fas fa-angle-right text-gunmetal"></i>  {{$unit->sku}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" >Quantity: {{$unit->pivot->quantity}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" ></div></td>
                                    
                                    <td class="py-0 px-5 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" ><a href="/viewbasicunit/{{$unit->id}}" class="btn btn-link text-success float-right">View</a></div></td>
                                    </tr>
                                @endforeach
                            @endif

                            @if($carton->kits->all())
                                @foreach ($carton->kits->all() as $kit)
                                    <tr class="bg-whitewash">
                                        
                                    <td class="py-0 border-0 "><div  id="details{{$carton->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" ><i class="fas fa-angle-right text-gunmetal"></i>  {{$kit->sku}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" >Quantity: {{$kit->pivot->quantity}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 px-5 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" ><a href="/viewkit/{{$kit->id}}" class="btn btn-link text-success float-right">View</a></div></td>
                                    </tr>
                                @endforeach
                            @endif


                            @if($carton->cases->all())
                                @foreach ($carton->cases->all() as $case)
                                    <tr class="bg-whitewash">
                                        
                                    <td class="py-0 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" ><i class="fas fa-angle-right text-gunmetal"></i>  {{$case->sku}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse " >Quantity: {{$case->pivot->quantity}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 px-5 border-0"><div  id="details{{$carton->id}}" class="accordion-body details collapse" ><a href="/viewcase/{{$case->id}}" class="btn btn-link text-success float-right">View</a></div></td>
                                    </tr>
                                @endforeach
                            @endif

                        @endforeach
                    </table>
                    </div>
                    @else
                    <p>You have 0 cartons.</p>
                    @endif


                    <h1 class="display-4">Cases</h1>

                    @if(count($cases) > 0)
                    <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th></th>
                            
                            <th>Sku</th>
                            <th>Description</th>
                            <th>Kits per Case</th>
                            <th>Units per Case</th>
                            <th>Total # Cases</th>
                            <th></th>

                        </tr>
                        @foreach($cases as $case)
                        <tr>
                            <td><button type="button" class="btn text-denim toggle-{{$case->id}}" id="toggle-details{{$case->id}}" data-toggle="collapse" data-target="#details{{$case->id}}" aria-expanded="false" aria-controls="details" data-delay="0"><i class="fas fa-plus"></i></button></td>
                            <td>{{$case->sku}}</td>
                            <td>{{$case->description}}</td>
                            <td>{{$case->kit_qty}}</td>
                            <td>{{$case->}}</td>
                            <td>{{$case->total_qty}}</td>
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

                                    <form action="/removecase/{{$case->id}}" method="POST" class="float-left"
                                        style="margin-right:1%">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-link text-danger btn-sm">Remove</button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                            @if($case->basic_units->all())
                                @foreach ($case->basic_units->all() as $unit)
                                    
                                    <tr class="bg-whitewash">
                                        
                                    <td class="py-0 border-0"><div  id="details{{$case->id}}" class="details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$case->id}}" class="details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$case->id}}" class="details collapse"><i class="fas fa-angle-right text-gunmetal"></i>  {{$unit->sku}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$case->id}}" class="details collapse" >Quantity: {{$unit->pivot->quantity}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$case->id}}" class="details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$case->id}}" class="details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$case->id}}" class="details collapse" ></div></td>
                                    <td class="py-0 px-5 border-0"><div  id="details{{$case->id}}" class="details collapse" ><a href="/viewbasicunit/{{$unit->id}}" class="btn btn-link text-success float-right">View</a></div></td>
                                    
                                    
                                    </tr>
                                @endforeach
                            @endif

                            @if($case->kits->all())
                                @foreach ($case->kits->all() as $kit)
                                    <tr class="bg-whitewash">
                                        
                                    <td class="py-0 border-0"><div  id="details{{$case->id}}" class="details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$case->id}}" class="details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$case->id}}" class="details collapse" ><i class="fas fa-angle-right text-gunmetal"></i>  {{$kit->sku}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$case->id}}" class="details collapse" >Quantity: {{$kit->pivot->quantity}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$case->id}}" class="details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$case->id}}" class="details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$case->id}}" class="details collapse" ></div></td>
                                    <td class="py-0 px-5 border-0"><div  id="details{{$case->id}}" class="details collapse" ><a href="/viewkit/{{$kit->id}}" class="btn btn-link text-success float-right">View</a></div></td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </table>
                    </div>
                    @else
                    <p>You have 0 cases.</p>
                    @endif


                    <h1 class="display-4">Kits</h1>

                    @if(count($kits) > 0)
                    <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th></th>
                            <th>Sku</th>
                            <th>Description</th>
                            <th>Pallet Qty</th>
                            <th>Carton Qty</th>
                            <th>Units per Kit</th>
                            <th>Total # Kits</th>
                            <th></th>
                        </tr>
                        @foreach($kits as $kit)
                        <tr>
                            <td><button type="button" class="btn text-denim toggle-{{$kit->id}}" id="toggle-details{{$kit->id}}" data-toggle="collapse" data-target="#details{{$kit->id}}" aria-expanded="false" aria-controls="details" data-delay="0"><i class="fas fa-plus"></i></button></td>
                            <td>{{$kit->sku}}</td>
                            <td>{{$kit->description}}</td>
                            <td>{{$kit->pallet_qty}}</td>
                            <td>{{$kit->carton_qty}}</td>
                            <td>{{$kit->basic_unit_qty}}</td>
                            
                            <td>{{$kit->total_qty}}</td>
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
                                        <button type="submit" class="btn btn-link text-danger btn-sm">Remove</button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                            @if($kit->basic_units->all())
                                @foreach ($kit->basic_units->all() as $unit)
                                    
                                    <tr class="bg-whitewash">
                                        
                                    <td class="py-0 border-0"><div  id="details{{$kit->id}}" class="details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$kit->id}}" class="details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$kit->id}}" class="details collapse" ><i class="fas fa-angle-right text-gunmetal"></i>  {{$unit->sku}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$kit->id}}" class="details collapse" >Quantity: {{$unit->pivot->quantity}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$kit->id}}" class="details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$kit->id}}" class="details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$kit->id}}" class="details collapse" ></div></td>
                                    <td class="py-0 px-5 border-0"><div  id="details{{$kit->id}}" class="details collapse" ><a href="/viewbasicunit/{{$unit->id}}" class=" btn btn-link text-success float-right">View</a></div></td>
                                    
                                    
                                    </tr>
                                @endforeach
                            @endif

                        @endforeach
                    </table>
                    </div>
                    @else
                    <p>You have 0 kits.</p>
                    @endif



                    <h1 class="display-4">Units</h1>
                    @if(count($basic_units) > 0)
                    <div class="table-responsive">
                    <table class="table">
                        <tr>

                            <th>Sku</th>
                            <th>Description</th>
                            <th>Pallet Qty</th>
                            <th>Carton Qty</th>
                            <th>Case Qty</th>
                            <th>Kit Qty</th>
                            <th>Total # Units</th>
                            <th></th>

                        </tr>
                        @foreach($basic_units as $unit)
                        <tr>
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
                                    <a href="/viewbasicunit/{{$unit->id}}" class="float-left" style="margin-right:1%">
                                        <button class="btn btn-link text-denim btn-sm" type="button">View</button>
                                    </a>

                                    <form action="/removebasicunit/{{$unit->id}}" method="POST" class="float-left"
                                        style="margin-right:1%">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-link text-danger btn-sm">Remove</button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </table>
                    </div>
                    @else
                    <p>You have 0 units.</p>
                    @endif

                    <br>
                    <br>



                </div>
            </div>
        </div>
    </div>
</div>

@endsection