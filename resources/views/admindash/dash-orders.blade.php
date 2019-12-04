@extends('layouts.admindashlte')

@section('user-name')
 {{auth()->user()->name}}   
@endsection

@section('content')


<div class="container-fluid dashboard-container">


    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

</div>
<div class="container-fluid dashboard-container">


        <div class="row justify-content-center">
            <div class="col-md-12 ">
    
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
    
                <div class="col-lg-12 col-12">
                    <!--
                        <a href="/createtransin" class="btn btn-outline-secondary">Transfer In</a>
                        <a href="/createtransout" class="btn btn-secondary">Transfer Out</a>
                        <br>
                        <br>
                        -->
                    <p class="h1 font-weight-light">Active Orders</p>
                    @if(count($orders) > 0)
                    <div class="table-responsive">
                        <table class="table table-sm orders">
                            <tr>
                                <th width="10%"></th>
                                <th width="10%">Order #</th>
                                <th width="10%">Originator</th>
                                <th width="10%">In Care Of</th>
                                <th width="10%">PO #</th>
                                <th width="10%">SO #</th>
                                <th width="10%">Job #</th>
                                <th width="10%">Carrier</th>
                                <th width="10%">Carrier ID#</th>
                                <th width="10%">Create Date</th>
                                <th width="10%">Status</th>
                                <th width="10%"></th>
    
                            </tr>
                            @foreach($orders as $order)
    
    
                            <tr>
                                <td>
                                    <button type="button" class="btn text-denim toggle-{{$order->id}}"
                                        id="toggle-details{{$order->id}}" data-toggle="collapse"
                                        data-target="#details{{$order->id}}" aria-expanded="false" aria-controls="details"
                                        data-delay="0"><i class="fas fa-plus"></i></button>
                                </td>
                                <td>
                                    <a href="/vieworder/{{$order->id}}">
                                        <button class="btn btn-link text-denim btn-sm px-0 "
                                            type="button">{{str_pad($order->orderid, 6, '0', STR_PAD_LEFT)}}</button>
                                    </a>
                                </td>
                                <td>{{$order->originator}}</td>
                                <td>{{$order->in_care_of}}</td>
                                <td>{{$order->po_num}}</td>
                                <td>{{$order->so_num}}</td>
                                <td>{{$order->job_num}}</td>
                                <td>{{$order->carrier}}</td>
                                <td>{{$order->carrier_id}}</td>
                                <td>{{$order->created_at->format('H:i:s m/d/y')}}</td>
                                <td>{{$order->status}}</td>
                                
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
    
                            <tr>
                                <td class="py-0 border-0"></td>
                                <td class="py-0 border-0" colspan="12">
                                    <div id="details{{$order->id}}" class="accordion-body details collapse">
                                        <table class="table table-sm bg-whitewash">
                                            <thead>
                                                <tr>
                                                    <th width="10%">SKU</th>
                                                    <th width="10%">Description</th>
                                                    <th width="10%">Barcode</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$unit->sku}}</td>
                                                    <td>{{$unit->description}}</td>
                                                    <td></td>
                                                    <td>Loose Item</td>
                                                    <td>{{$unit->pivot->quantity}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
    
                            @if($order->kits->all())
                            @foreach ($order->kits->all() as $kit)
                            <tr>
                                <td class="py-0 border-0"></td>
                                <td class="py-0 border-0" colspan="12">
                                    <div id="details{{$order->id}}" class="accordion-body details collapse">
                                        <table class="table table-sm bg-whitewash">
                                            <thead>
                                                <tr>
                                                    <th width="10%">SKU</th>
                                                    <th width="10%">Description</th>
                                                    <th width="10%">Barcode</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$kit->sku}}</td>
                                                    <td>{{$kit->description}}</td>
                                                    <td></td>
                                                    <td>Kit</td>
                                                    <td>{{$kit->pivot->quantity}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
    
    
                            @if($order->cases->all())
                            @foreach ($order->cases->all() as $case)
                            <tr>
                                <td class="py-0 border-0"></td>
                                <td class="py-0 border-0" colspan="12">
                                    <div id="details{{$order->id}}" class="accordion-body details collapse">
                                        <table class="table table-sm bg-whitewash">
                                            <thead>
                                                <tr>
                                                    <th width="10%">SKU</th>
                                                    <th width="10%">Description</th>
                                                    <th width="10%">Barcode</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$case->sku}}</td>
                                                    <td>{{$case->description}}</td>
                                                    <td></td>
                                                    <td>Case</td>
                                                    <td>{{$case->pivot->quantity}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
    
                            @if($order->cartons->all())
                            @foreach ($order->cartons->all() as $carton)
                            <tr>
                                <td class="py-0 border-0"></td>
                                <td class="py-0 border-0" colspan="12">
                                    <div id="details{{$order->id}}" class="accordion-body details collapse">
                                        <table class="table table-sm bg-whitewash">
                                            <thead>
                                                <tr>
                                                    <th width="10%">SKU</th>
                                                    <th width="10%">Description</th>
                                                    <th width="10%">Barcode</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$carton->sku}}</td>
                                                    <td>{{$carton->description}}</td>
                                                    <td>{{$carton->barcode}}</td>
                                                    <td>Carton</td>
                                                    <td>{{$carton->pivot->quantity}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
    
                            @if($order->pallets->all())
                            @foreach ($order->pallets->all() as $pallet)
                            <tr>
                                <td class="py-0 border-0"></td>
                                <td class="py-0 border-0" colspan="12">
                                    <div id="details{{$order->id}}" class="accordion-body details collapse">
                                        <table class="table table-sm bg-whitewash">
                                            <thead>
                                                <tr>
                                                    <th width="10%">SKU</th>
                                                    <th width="10%">Description</th>
                                                    <th width="10%">Barcode</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$pallet->sku}}</td>
                                                    <td>{{$pallet->description}}</td>
                                                    <td>{{$pallet->barcode}}</td>
                                                    <td>Pallet</td>
                                                    <td>{{$pallet->pivot->quantity}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                                @endforeach
                                @endif
                                @endforeach
                        </table>
                    </div>
                    @else
                    <p>You have no active orders.</p>
                    @endif
                </div>
    
                <div class="col-lg-12 col-12">
                    <!--
                        <a href="/createtransin" class="btn btn-outline-secondary">Transfer In</a>
                        <a href="/createtransout" class="btn btn-secondary">Transfer Out</a>
                        <br>
                        <br>
                        -->
                    <p class="h1 font-weight-light">Order History</p>
                    @if(count($ordershistory) > 0)
                    <div class="table-responsive">
                        <table class="table table-sm orders">
                            <tr>
                                <th width="10%"></th>
                                <th width="10%">Order #</th>
                                <th width="10%">Originator</th>
                                <th width="10%">In Care Of</th>
                                <th width="10%">PO #</th>
                                <th width="10%">SO #</th>
                                <th width="10%">Job #</th>
                                <th width="10%">Carrier</th>
                                <th width="10%">Carrier ID#</th>
                                <th width="10%">Create Date</th>
                                <th width="10%">Status</th>
                                <th width="10%"></th>
    
                            </tr>
                            @foreach($ordershistory as $order)
    
    
                            <tr>
                                <td>
                                    <button type="button" class="btn text-denim toggle-{{$order->id}}"
                                        id="toggle-details{{$order->id}}" data-toggle="collapse"
                                        data-target="#details{{$order->id}}" aria-expanded="false" aria-controls="details"
                                        data-delay="0"><i class="fas fa-plus"></i></button>
                                </td>
                                <td>
                                    <a href="/vieworder/{{$order->id}}">
                                        <button class="btn btn-link text-denim btn-sm px-0 "
                                            type="button">{{str_pad($order->orderid, 6, '0', STR_PAD_LEFT)}}</button>
                                    </a>
                                </td>
                                <td>{{$order->originator}}</td>
                                <td>{{$order->in_care_of}}</td>
                                <td>{{$order->po_num}}</td>
                                <td>{{$order->so_num}}</td>
                                <td>{{$order->job_num}}</td>
                                <td>{{$order->carrier}}</td>
                                <td>{{$order->carrier_id}}</td>
                                <td>{{$order->created_at->format('H:i:s m/d/y')}}</td>
                                <td>{{$order->status}}</td>
    
    
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
    
                            <tr>
                                <td class="py-0 border-0"></td>
                                <td class="py-0 border-0" colspan="12">
                                    <div id="details{{$order->id}}" class="accordion-body details collapse">
                                        <table class="table table-sm bg-whitewash">
                                            <thead>
                                                <tr>
                                                    <th width="10%">SKU</th>
                                                    <th width="10%">Description</th>
                                                    <th width="10%">Barcode</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$unit->sku}}</td>
                                                    <td>{{$unit->description}}</td>
                                                    <td></td>
                                                    <td>Loose Item</td>
                                                    <td>{{$unit->pivot->quantity}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
    
                            @if($order->kits->all())
                            @foreach ($order->kits->all() as $kit)
                            <tr>
                                <td class="py-0 border-0"></td>
                                <td class="py-0 border-0" colspan="12">
                                    <div id="details{{$order->id}}" class="accordion-body details collapse">
                                        <table class="table table-sm bg-whitewash">
                                            <thead>
                                                <tr>
                                                    <th width="10%">SKU</th>
                                                    <th width="10%">Description</th>
                                                    <th width="10%">Barcode</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$kit->sku}}</td>
                                                    <td>{{$kit->description}}</td>
                                                    <td></td>
                                                    <td>Kit</td>
                                                    <td>{{$kit->pivot->quantity}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
    
    
                            @if($order->cases->all())
                            @foreach ($order->cases->all() as $case)
                            <tr>
                                <td class="py-0 border-0"></td>
                                <td class="py-0 border-0" colspan="12">
                                    <div id="details{{$order->id}}" class="accordion-body details collapse">
                                        <table class="table table-sm bg-whitewash">
                                            <thead>
                                                <tr>
                                                    <th width="10%">SKU</th>
                                                    <th width="10%">Description</th>
                                                    <th width="10%">Barcode</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$case->sku}}</td>
                                                    <td>{{$case->description}}</td>
                                                    <td></td>
                                                    <td>Case</td>
                                                    <td>{{$case->pivot->quantity}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
    
                            @if($order->cartons->all())
                            @foreach ($order->cartons->all() as $carton)
                            <tr>
                                <td class="py-0 border-0"></td>
                                <td class="py-0 border-0" colspan="12">
                                    <div id="details{{$order->id}}" class="accordion-body details collapse">
                                        <table class="table table-sm bg-whitewash">
                                            <thead>
                                                <tr>
                                                    <th width="10%">SKU</th>
                                                    <th width="10%">Description</th>
                                                    <th width="10%">Barcode</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$carton->sku}}</td>
                                                    <td>{{$carton->description}}</td>
                                                    <td></td>
                                                    <td>Carton</td>
                                                    <td>{{$carton->pivot->quantity}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
    
                            @if($order->pallets->all())
                            @foreach ($order->pallets->all() as $pallet)
                            <tr>
                                <td class="py-0 border-0"></td>
                                <td class="py-0 border-0" colspan="12">
                                    <div id="details{{$order->id}}" class="accordion-body details collapse">
                                        <table class="table table-sm bg-whitewash">
                                            <thead>
                                                <tr>
                                                    <th width="10%">SKU</th>
                                                    <th width="10%">Description</th>
                                                    <th width="10%">Barcode</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$pallet->sku}}</td>
                                                    <td>{{$pallet->description}}</td>
                                                    <td></td>
                                                    <td>Pallet</td>
                                                    <td>{{$pallet->pivot->quantity}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                                @endforeach
                                @endif
                                @endforeach
                        </table>
                    </div>
                    @else
                    <p>You have no order history.</p>
                    @endif
                </div>
    
            </div>
        </div>
    </div>
    @endsection