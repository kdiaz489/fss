@extends('layouts.admindashboard')

@section('content')


<div class="container-fluid bg-whitewash ">
    <div class="container dashboard-container pt-5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs border-1" role="tablist">
                <ul class="nav nav-tabs border-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard/admin/fulfillment">Fulfillment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard/admin/inventory">Storage</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">Shipments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard/admin/users">Manage Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/dashboard/admin/orders">Orders</a>
                        </li>
            
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard/admin/account">Account</a>
                        </li>
                    </ul>
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
                        <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th></th>
                                <th>Update</th>
                                <th>Order ID</th>
                                <th>Company</th>
                                <th>Status</th>
                                <th>Type</th>
                                <th>Submitted</th>
                                <th></th>

                            </tr>
                            @foreach($orders as $order)
                            
                            <tr>
                                <td><button type="button" class="btn text-denim toggle-{{$order->id}}" id="toggle-details{{$order->id}}" data-toggle="collapse" data-target="#details{{$order->id}}" aria-expanded="false" aria-controls="details" data-delay="0"><i class="fas fa-plus"></i></button></td>

                                <td>
                                        <form action=" /order/update/{{$order->id}}" method="POST">
                                            @csrf
                                            {{method_field('PUT')}}
                                            <select name="status" id="" class="">
                                                <option value="" selected disabled>Choose</option>
                                                <option value="Completed">Completed</option>
                                                <option value="Approved">Approved</option>
                                                <option value="In Progress">In Progress</option>
                                                <option value="Rejected">Rejected</option>
                                            </select>

                                            <button type="submit" style=" margin-left: 1.25rem;"
                                                class="btn btn-link btn-sm">Update</button>
                                        </form>
                                </td>
                                <td>{{str_pad($order->orderid, 6, '0', STR_PAD_LEFT)}}</td>
                                <td>{{$order->company}}</td>
                                <td>{{$order->status}}</td>
                                <td>{{$order->order_type}}</td>
                                <td>{{$order->created_at->format('H:i:s m/d/y')}}</td>
                                
                                
                                <td>
                                    <div style="margin-left: 30%">
                                    <!--
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
                                        -->
                                        <a href="/vieworder/{{$order->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">View</button>
                                        </a>
                                        <form action="/order/remove/{{$order->id}}" method="POST" class="float-left" >
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-link text-danger btn-sm">Remove</button>
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
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 px-5 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" style="margin-left:25%"><a class="btn btn-link text-success float-left" href="/viewbasicunit/{{$unit->id}}">View</a></div></td>
                                    
                                    
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
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 px-5 border-0 "><div  id="details{{$order->id}}" class="accordion-body details collapse" style="margin-left:25%"><a href="/viewkit/{{$kit->id}}" class="btn btn-link text-success float-left">View</a></div></td>
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
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 px-5 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" style="margin-left:25%"><a href="/viewcase/{{$case->id}}" class="btn btn-link text-success float-left">View</a></div></td>
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
                                    <td class="py-0 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" ></div></td>
                                    <td class="py-0 px-5 border-0"><div  id="details{{$order->id}}" class="accordion-body details collapse" style="margin-left:25%"><a href="/viewpallet/{{$pallet->id}}" class="btn btn-link text-success float-left">View</a></div></td>
                                @endforeach
                            @endif

                            @endforeach
                        </table>
                        </div>
                        @else
                        <p>You have no orders for your inventory.</p>
                        @endif

                    
                </div>
            </div>
        </div>
    </div>

    @endsection