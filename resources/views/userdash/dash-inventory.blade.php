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
                        <button id="btnGroupDrop1" type="button" class="btn bg-frenchblue text-white dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                    <table class="table orders">
                        <tr>
                            <th></th>
                            <th>Order ID</th>
                            <th>Customer ID</th>
                            <th>Status</th>
                            <th>Submitted On</th>
                            <th>Updated On</th>
                            <th colspan="0"></th>

                        </tr>
                        @foreach($orders as $order)
                        @if ($order->status != 'Completed')

                        <tr class="">
                            <td><button type="button" class="btn text-denim toggle-{{$order->id}}" id="toggle-details{{$order->id}}" data-toggle="collapse" data-target="#details{{$order->id}}" aria-expanded="false" aria-controls="details" data-delay="0"><i class="fas fa-plus"></i></button></td>
                            <td>
                                <a href="/vieworder/{{$order->id}}">
                                    <button class="btn btn-link text-denim btn-sm px-0 "
                                        type="button">{{str_pad($order->orderid, 6, '0', STR_PAD_LEFT)}}</button>
                                </a></td>
                            <td>{{$order->user_id}}</td>
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
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ><i class="fas fa-angle-right text-gunmetal"></i></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse px-0" >{{$unit->unit_name}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapsepy-0" >Quantity: {{$unit->pivot->quantity}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapsepy-0" ><a href="/viewbasicunit/{{$unit->id}}" class="text-success">View</a></div></td>
                                    
                                    
                                    </tr>
                                @endforeach
                            @endif

                            @if($order->kits->all())
                                @foreach ($order->kits->all() as $kit)
                                    <tr class="bg-whitewash">
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ><i class="fas fa-angle-right text-gunmetal"></i></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse text-wrap" >{{$kit->kit_name}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse text-wrap" >Quantity: {{$kit->pivot->quantity}}</div></td>
                                    <td class="py-0 border-0 "><div  id="details{{$order->id}}" class="accordion-body details collapse" ><a href="/viewkit/{{$kit->id}}" class="text-success">View</a></div></td>
                                    </tr>
                                @endforeach
                            @endif


                            @if($order->cases->all())
                                @foreach ($order->cases->all() as $case)
                                    <tr class="bg-whitewash">
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ><i class="fas fa-angle-right text-gunmetal"></i></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse " >{{$case->case_name}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" >Quantity: {{$case->pivot->quantity}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ><a href="/viewcase/{{$case->id}}" class="text-success">View</a></div></td>
                                    </tr>
                                @endforeach
                            @endif

                            @if($order->pallets->all())
                                @foreach ($order->pallets->all() as $pallet)
                                    <tr class="bg-whitewash">
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ><i class="fas fa-angle-right text-gunmetal"></i></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" >{{$pallet->pallet_name}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" >Quantity: {{$pallet->pivot->quantity}}</div></td>
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ><a href="/viewpallet/{{$pallet->id}}" class="text-success">View</a></div></td>
                                @endforeach
                            @endif


                        @endif
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
                            
                            <th>Carton Qty</th>
                            <th>Case Qty</th>
                            <th>Kit Qty</th>
                            <th>Total Qty</th>
                            <th></th>

                        </tr>
                        @foreach($pallets as $pallet)
                        <tr>
                            <td>{{$pallet->pallet_name}}</td>
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
                            <th>Pallet Qty</th>
                            <th>Carton Qty</th>
                            
                            <th>Kit Qty</th>
                            <th>Total Qty</th>
                            <th></th>

                        </tr>
                        @foreach($cases as $case)
                        <tr>
                            <td>{{$case->case_name}}</td>
                            <td>{{$case->sku}}</td>
                            <td>{{$case->description}}</td>
                            <td>{{$case->pallet_qty}}</td>
                            <td>{{$case->carton_qty}}</td>
                            
                            <td>{{$case->kit_qty}}</td>
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
                        @endforeach
                    </table>

                    @else
                    <p>You have no cases in your inventory.</p>
                    @endif


                    <h1 class="display-4">Kits</h1>

                    @if(count($kits) > 0)
                    <table class="table">
                        <tr>
                            <th>Case Name</th>
                            <th>Sku</th>
                            <th>Description</th>
                            <th>Pallet Qty</th>
                            <th>Carton Qty</th>
                            <th>Case Qty</th>
                            
                            <th>Total Qty</th>
                            <th></th>
                        </tr>
                        @foreach($kits as $kit)
                        <tr>
                            <td>{{$kit->kit_name}}</td>
                            <td>{{$kit->sku}}</td>
                            <td>{{$kit->description}}</td>
                            <td>{{$kit->pallet_qty}}</td>
                            <td>{{$kit->carton_qty}}</td>
                            <td>{{$kit->case_qty}}</td>
                            
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
                        @endforeach
                    </table>

                    @else
                    <p>You have no kits in your inventory.</p>
                    @endif



                    <h1 class="display-4">Units</h1>
                    @if(count($basic_units) > 0)
                    <table class="table">
                        <tr>
                            <th>Case Name</th>
                            <th>Sku</th>
                            <th>Description</th>
                            <th>Pallet Qty</th>
                            <th>Carton Qty</th>
                            <th>Case Qty</th>
                            <th>Kit Qty</th>
                            <th>Total Qty</th>
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

<script>

$('td').on('show.bs.collapse', function () {
    $(this).addClass('p-2');
    var toggle = $(this).children().attr('id');
    $('#toggle-' + toggle).empty();
    $('#toggle-' + toggle).append('<i class="fas fa-minus"></i>');
    $('#toggle-' + toggle).removeClass('text-denim');
    $('#toggle-' + toggle).addClass('text-danger');
    
});




$('td').on('hide.bs.collapse', function () {
    $(this).removeClass('p-2');
    var toggle = $(this).children().attr('id');
    $('#toggle-' + toggle).empty();
    $('#toggle-' + toggle).append('<i class="fas fa-plus"></i>');
    $('#toggle-' + toggle).removeClass('text-danger');
    $('#toggle-' + toggle).addClass('text-denim');
    
});





    /*
    $(document).ready(function(){
        var count=1;

        $(document).on('click', '.expand', function(){
            count++;

            $(this).closest("table").find('tr.details').show();

        });

        $(document).on('click', '.remove', function(){
        count--;
        $(this).closest("table").find('tr.details').hide();
        
        });

});
*/
</script>
@endsection