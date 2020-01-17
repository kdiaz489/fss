@extends('layouts.admindashlte')

@section('main-sidebar')
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar bg-denim elevation-4">
                <!-- Brand Logo -->
                <a href="#" class="brand-link justify-content-center border-0">
                  <img src="{{asset('img/fss-white.svg')}}" alt="AdminLTE Logo" class="brand-image" width="100px" height="80px" style="max-height:27px; width:auto">
                  <span class="brand-text font-weight-light text-white">Admin Dashboard</span>
                </a>
          
                <!-- Sidebar -->
                <div class="sidebar">
          
          
                  <!-- Sidebar Menu -->
                  <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                      <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
          
          
                      <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link text-white shadow-sm" style="background-color: #3b679c">
          
                          <i class="nav-icon fas fa-box-open"></i>
                          <p>
                            Fulfilment
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
          
                          <li class="nav-item">
                            <a href="/dashboard/admin/fulfillment" class="nav-link text-gunmetal bg-whitewash">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Fulfillment Orders</p>
                            </a>
                          </li>
                        </ul>
                      </li>
          
                      <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white">
                          <i class="nav-icon fas fa-warehouse"></i>
                          <p>
                            Storage
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="/dashboard/admin/inventory" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>All Inventory</p>
                            </a>
                          </li>
          
                        </ul>
                      </li>
                      <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white">
                          <i class="nav-icon fas fa-shipping-fast"></i>
                          <p>
                            Shipments
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="/dashboard" class="nav-link text-gunmetal bg-whitewash" >
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>All Shipments</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link text-white">
                          <i class="nav-icon fas fa-edit"></i>
                          <p>
                            Orders
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="/dashboard/admin/orders" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Storage Orders</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="nav-item has-treeview">
                            <a href="#" class="nav-link text-white">
                              <i class="nav-icon fas fa-users"></i>
                              <p>
                                Users
                                <i class="fas fa-angle-left right"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="/dashboard/admin/users" class="nav-link text-white">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                  <p>Manage Users</p>
                                </a>
                              </li>
                            </ul>
                          </li>
                      <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white">
          
                          <i class="nav-icon fas fa-user-alt"></i>
                          <p>
                            {{auth()->user()->name}} 
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="/dashboard/admin/account" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Account Details</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('logout') }}" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                              <i class="fas fa-angle-right nav-icon"></i>
                              {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                            </form>
                          </li>
          
          
                        </ul>
                      </li>
          
          
          
                    </ul>
                  </nav>
                  <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
              </aside>
@endsection

@section('content')


<!-- Modal -->
<div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content h-100">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary bg-denim import-orders">Import Orders</button>
        </div>
        </div>
    </div>
</div>


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
                        
                        <h3 class="font-weight-light d-inline-block">Active Fulfillment Requests</h3>
                        <button class="btn btn-secondary btn-sm border-0 bg-denim m-0 d-inline-block circle shopify-refresh"><i class="fas fa-sync"></i></button>

                        <br>

                        @if(count($orders) > 0)
                        <div class="table-responsive">
                            <table class="table table-sm" id="">
                                <thead>
                                    <tr>
                                        <th width="2%">Expand</th>
                                        <th width="10%%">Update</th>
                                        <th width="7%">Order ID</th>
                                        <th width="10%">Customer</th>
                                        <th width="10%">Payment</th>
                                        <th width="10%">Status</th>
                                        <th width="10%">Created</th>
                                        <th width="10%"></th>
    
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
    
    
                                <tr>
                                    <td><button type="button" class="btn text-denim toggle-{{$order->id}}"
                                            id="toggle-details{{$order->id}}" data-toggle="collapse"
                                            data-target="#details{{$order->id}}" aria-expanded="false"
                                            aria-controls="details" data-delay="0"><i class="fas fa-plus"></i></button></td>
                                    <td>
                                        
                                            <div class="input-group">
                                            <form action="/order/update/{{$order->id}}" id="update-order-{{$order->id}}" method="POST">
                                                    
                                                        {{method_field('PUT')}}
                                                        <select name="status" class="custom-select custom-select-sm rounded-0">
                                                            <option value="" selected disabled>Choose</option>
                                                            <option value="Approved">Approved</option>
                                                            <option value="Picked">Picked</option>
                                                            <option value="Boxed">Boxed</option>
                                                            <option value="Rejected">Rejected</option>
                                                        </select>
                                                        @csrf 
                                                    </form>    
                                                                                              
                                                    <div class="input-group-append">
                                                             
                                                        <button type="submit" form="update-order-{{$order->id}}" class="btn btn-secondary bg-denim btn-sm border-0 form-control form-control-sm"><small>Update</small></button>
                                                    </div>
                                            </div>

                                    </td>
                                    <td class="order-id" id = 'order-{{$order->id}}'>
                                        <a href="/vieworder/{{$order->id}}">
                                            <button class="btn btn-link text-denim btn-sm px-0 "
                                                type="button">{{str_pad($order->cust_order_no, 6, '0', STR_PAD_LEFT)}}</button>
                                        </a></td>
                                    <td>{{$order->cust_name}}</td>
                                    <td>{{$order->financial_status}}</td>
                                    <td class="status">{{$order->status}}</td>
                                    <td>{{$order->created_at->format('H:i:s m/d/y')}}</td>
                                    
    
    
                                    <td>
                                        <div style="margin-left: 10%">
    
                                            <a class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-info btn-sm pick-order" id="order-{{$order->id}}" type="button">Pick</button>
                                            </a>
                                            <a class="float-left fulfill-order" style="margin-right:1%">
                                                <button class="btn btn-link text-success btn-sm" type="button">Fulfill</button>
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
    
                                @if($order->basic_units->all())
                                @foreach ($order->basic_units->all() as $unit)
    
                                <tr>
                                    <td class="py-0 border-0"></td>
                                    <td class="py-0 border-0" colspan="12">
                                        <div id="details{{$order->id}}" class="accordion-body details collapse">
                                            <table class="table table-sm bg-whitewash">
                                                <thead>
                                                    <tr>
                                                        <th width="20%">SKU</th>
                                                        <th width="20%">Description</th>
                                                        <th width="20%">Barcode</th>
                                                        <th width="20%">Container Type</th>
                                                        <th width="20%">Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{$unit->sku}}</td>
                                                        <td>{{$unit->description}}</td>
                                                        <td>{{$unit->upc}}</td>
                                                        <td>Individual Unit</td>
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
                                                        <th width="20%">SKU</th>
                                                        <th width="20%">Description</th>
                                                        <th width="20%">Barcode</th>
                                                        <th width="20%">Container Type</th>
                                                        <th width="20%">Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{$kit->sku}}</td>
                                                        <td>{{$kit->description}}</td>
                                                        <td>{{$kit->upc}}</td>
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
                                                        <th width="20%">SKU</th>
                                                        <th width="20%">Description</th>
                                                        <th width="20%">Barcode</th>
                                                        <th width="20%">Container Type</th>
                                                        <th width="20%">Quantity</th>
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
                                                        <th width="20%">SKU</th>
                                                        <th width="20%">Description</th>
                                                        <th width="20%">Barcode</th>
                                                        <th width="20%">Container Type</th>
                                                        <th width="20%">Quantity</th>
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
                                                        <th width="20%">SKU</th>
                                                        <th width="20%">Description</th>
                                                        <th width="20%">Barcode</th>
                                                        <th width="20%">Container Type</th>
                                                        <th width="20%">Quantity</th>
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
                                </tr>
                            </tbody>
                                    @endforeach
                                    @endif
                                    @endforeach
                            </table>
                        </div>
                        @else
                        <p>You have 0 pending orders.</p>
                        @endif
            </div>

            <div class="col-lg-12 col-12">

              <h3 class="font-weight-light">Fulfillment Requests History</h3>

              <br>

              @if(count($ordershistory) > 0)
              <div class="table-responsive">
                  <table class="table table-sm" id="">
                      <thead>
                          <tr>
                              <th width="2%">Expand</th>
                              <th width="10%">Order ID</th>
                              <th width="20%">Customer</th>
                              <th width="20%">Status</th>
                              <th width="20%">Submitted On</th>
                              <th width="20%">Updated On</th>
                              <th width="20%">Actions</th>

                          </tr>
                      </thead>
                      <tbody>
                      @foreach($ordershistory as $order)


                      <tr>
                          <td><button type="button" class="btn text-denim toggle-{{$order->id}}"
                                  id="toggle-details{{$order->id}}" data-toggle="collapse"
                                  data-target="#details{{$order->id}}" aria-expanded="false"
                                  aria-controls="details" data-delay="0"><i class="fas fa-plus"></i></button></td>
                       
                          <td>
                              <a href="/vieworder/{{$order->id}}">
                                  <button class="btn btn-link text-denim btn-sm px-0 "
                                      type="button">{{str_pad($order->orderid, 6, '0', STR_PAD_LEFT)}}</button>
                              </a></td>
                          <td>{{$order->cust_name}}</td>
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
                                      <button type="submit"
                                          class="btn btn-link text-danger btn-sm">Remove</button>
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
                                              <th width="20%">SKU</th>
                                              <th width="20%">Description</th>
                                              <th width="20%">Barcode</th>
                                              <th width="20%">Container Type</th>
                                              <th width="20%">Quantity</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td>{{$unit->sku}}</td>
                                              <td>{{$unit->description}}</td>
                                              <td>{{$unit->upc}}</td>
                                              <td>Individual Unit</td>
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
                                              <th width="20%">SKU</th>
                                              <th width="20%">Description</th>
                                              <th width="20%">Barcode</th>
                                              <th width="20%">Container Type</th>
                                              <th width="20%">Quantity</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td>{{$kit->sku}}</td>
                                              <td>{{$kit->description}}</td>
                                              <td>{{$kit->upc}}</td>
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
                                              <th width="20%">SKU</th>
                                              <th width="20%">Description</th>
                                              <th width="20%">Barcode</th>
                                              <th width="20%">Container Type</th>
                                              <th width="20%">Quantity</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td>{{$case->sku}}</td>
                                              <td>{{$case->description}}</td>
                                              <td>{{$case->upc}}</td>
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
                                              <th width="20%">SKU</th>
                                              <th width="20%">Description</th>
                                              <th width="20%">Barcode</th>
                                              <th width="20%">Container Type</th>
                                              <th width="20%">Quantity</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td>{{$carton->sku}}</td>
                                              <td>{{$carton->description}}</td>
                                              <td>{{$carton->upc}}</td>
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
                                              <th width="20%">SKU</th>
                                              <th width="20%">Description</th>
                                              <th width="20%">Barcode</th>
                                              <th width="20%">Container Type</th>
                                              <th width="20%">Quantity</th>
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
                      </tr>
                  </tbody>
                          @endforeach
                          @endif
                          @endforeach
                  </table>
              </div>
              @else
              <p>You have 0 pending orders.</p>
              @endif
  </div>

        </div>
    </div>

    @endsection

    @section('scripts')
    <script>
    $(document).ready(function(){

    var currentRow = '';
    $(document).on('click', '.pick-order', function(e){
        e.preventDefault();
        var id = $(this).attr('id').slice(6);
        currentRow = $(this).closest('tr').find('.status');
        var status = $(this).closest('tr').find('.status').text();
        console.log(status);
        if(status != 'Picked'){
            $.ajax({
                type: 'GET',
                url: '/getorder/' + id
            })
            .done(function(result){
                console.log(result.order);
                var order = result.order;
                var html = '<div class="container" id=" order-' + id + '">';
                for(var i = 0; i < order.basic_units.length; i++){
                    var unit = order.basic_units[i];
                    html += '<div class="row border-top py-4 border-bottom my-3">';
                    html += '<div class="col-md-3"><p class="product_sku unit">' + unit.sku + '</p></div>';
                    html += '<div class="col-md-3"><p> x' + unit.pivot.quantity + '</p></div>';
                    html += '<div class="col-md-6"><div class="input-group w-100"><input type="text" class="form-control scan" placeholder="Scan Product">\
                            <div class="input-group-append"><button type="button" class="btn btn-sm btn-secondary bg-denim border-denim text-white verify_sku">Verify</button></div></div></div>';
                    html += '</div>';
                    
                }
                html += '</div>';

                var footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary bg-denim submit-pick">Pick Order</button>'
                
                $('.modal-body').html(html);
                $('.modal-footer').html(footer);
                $('.modal').modal('show');
            })
            .fail(function(result){
                console.log('fail');
            });
        }
        else if(status == 'Picked'){
            $('.modal-body').html('<p class="p-5 font-weight-bold border border-secondary text-success text-center">Your order is already picked. Please proceed to boxing the products. <br> <br> <i class="border p-4 rounded-circle border-success bg-success text-white fas fa-3x fa-box"></i></p>');
            $('.modal-footer').html('');
            $('.modal').modal('show');
        }
    });

    $('.modal').on('click', '.submit-pick', function(e){
        e.preventDefault();
        
        var id = $(this).parent().prev().find('.container').attr('id').slice(7);
        var status = $(currentRow).find('.status');
        console.log(status);

        var formData = new FormData();
        formData.append('status', 'Picked');
        formData.append('_method', 'PUT');
        formData.append('_token', '{{csrf_token()}}');
        
        $.ajax({
        type: 'POST',
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        url: '/order/update/' + id,
        data: formData,
        processData: false,
        contentType: false,
        })
        .done(function (result) {
            $(currentRow).html('Picked');
            $('.modal-body').html('<p class="p-5 font-weight-bold border border-secondary text-success text-center">Your order has been successfully picked. <br> <br> <i class="border p-4 rounded-circle border-success bg-success text-white fas fa-3x fa-thumbs-up"></i></p>');
            $('.modal-footer').html('');
            $('.modal').modal('show');

            
        })

        .fail(function (jqXHR, textStatus, error) {
            $('.modal-body').html('<p class="p-5 font-weight-bold border border-secondary text-danger text-center">Your order has not been successfully picked. Please try again. <br> <br> <i class=" border p-4 rounded-circle border-danger fas fa-3x fa-thumbs-down"></i></p>');
            $('.modal-footer').html('');
            $('.modal').modal('show');

            
        });

    });

    $(document).on('focus', '.verify_sku', function(e){
        e.preventDefault();
        $(this).click();
    });

    $(document).on('click', '.verify_sku', function(e){
        
        var button = $(this);
        var sku = '';
        var barcode = '';
        var type = '';
        sku = $(this).closest('.row').find('.product_sku').text();
        barcode = $(this).closest('.input-group').find('input[type=text]').val();
        if($(this).closest('.row').find('.product_sku').hasClass('unit')){
            type = 'Unit';
        }
        $.ajax({
        type: 'POST',
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        url: '/verifyorderskus/{{$order->id}}',
        data: {
            sku: sku,
            barcode: barcode,
            type: type,
            _token: $(this).next("input[name=_token]").val()
        },
        })
        .done(function (result) {
            $(button).removeClass('bg-danger border-danger');
            $(button).addClass('bg-success border-success');
            $(button).html('<i class="fas fa-check-circle"></i>');
            $(button).closest('input').removeClass('invalid');
            $(button).parent().prev('input').removeClass('invalid');
            
        })

        .fail(function (jqXHR, textStatus, error) {
            $(button).removeClass('bg-success border-success');
            $(button).addClass('bg-danger border-danger');
            $(button).html('<i class="fas fa-times-circle"></i>');
            
            $(button).parent().prev('input').addClass('invalid');
        });
    });

    $(document).on('click', '.fulfill-order', function(e){
        e.preventDefault();
        currentRow = $(this).closest('tr');
        var status = $(currentRow).find('.status').text();
        if(status == 'Completed'){
            $('.modal-body').html('<p class="p-5 font-weight-bold border border-secondary text-success text-center">This order has aready been fulfilled by FillStorShip. Please proceed to the next order. <br> <br> <i class="border p-4 rounded-circle border-success bg-success text-white fas fa-3x fa-check"></i></p>');
            $('.modal-footer').html('');
            $('.modal').modal('show');
        }
        else if(status == 'Pending Approval'){
            $('.modal-body').html('<p class="p-5 font-weight-bold border border-secondary text-secondary text-center">This order has not been picked by FillStorShip. Please pick the products before finalizing Fulfillment. <br> <br> <i class="border p-4 rounded-circle border-warning bg-warning text-white fas fa-3x fa-exclamation-triangle"></i></p>');
            $('.modal-footer').html('');
            $('.modal').modal('show');
        }
        else if(status != 'Completed'){
            var html = '';
            var footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary bg-denim submit-fulfillment">Fulfill</button>'
            html += '<div class="row justify-content-center"><h2>Is this order Boxed and Labeled?</h2><div class="checkbox-wrapper"> <input type="checkbox" id="check" hidden><label for="check" class="checkmark"></label></div></div>';
            $('.modal-body').css('height', 'auto');
            $('.modal-body').html(html);
            $('.modal-footer').html(footer);
            $('.modal').modal('show')
        }

    });

    $(document).on('click', '.submit-fulfillment', function(e){

        if($(this).parent().prev().find('input[type="checkbox"]').prop('checked') == false){
            $(this).parent().prev().find('input[type="checkbox"]').parent().addClass('invalid');
           
        }

        else if($(this).parent().prev().find('input[type="checkbox"]').prop('checked') == true){
            $(this).parent().prev().find('input[type="checkbox"]').parent().removeClass('invalid');
            var id = currentRow.find('.order-id').attr('id').slice(6);
            console.log(id);
            $.ajax({
            type: 'POST',
            url: '/order/update/' + id,
            data: {
                status: 'Completed',
                _method: 'PUT',
                _token: '{{csrf_token()}}'
            },
            })
            .done(function (result) {
                var success = '<div class="border border-secondary text-center p-4"><h4 class="text-success">You have successfully fulfilled this order.</h4> <br> <br> <i class=" border p-4 rounded-circle text-white bg-success border-success fas fa-3x fa-thumbs-up"></i><div>';
                $(currentRow).find('.status').html('Completed');
                $('.modal-body').html(success);
                $('.modal-footer').html('');
                $('.modal').modal('show');
                
            })

            .fail(function (jqXHR, textStatus, error) {
                var fail = '<div class="border border-secondary text-center p-4"><h4 class="text-danger">You have not successfully fulfilled this order. Please try again.</h4> <br> <i class=" border p-4 rounded-circle text-white bg-danger border-danger fas fa-3x fa-thumbs-down"></i><div>'
                $('.modal-body').html(fail);
                $('.modal-footer').html('');
                $('.modal').modal('show');
                
            });
        }
    });


    $(document).on('click', '.shopify-refresh', function(e){
        e.preventDefault();
        $.ajax({
                type: 'GET',
                url: '/scanshopifyorders',
                
            })
                .done(function (result) {
                    
                    //
                    console.log(result);
                    var html = '';
                    
                    if(result.doesntExist.length != 0){
                        html += '<div class=" alert alert-danger"> <h5 class="alert-heading">Item(s) does not exist. Please create in storage tab.</h5>';
                        for(var i = 0; i < result.doesntExist.length; i++){
                            html += '<p>' + result.doesntExist[i] + '</p>'
                        }
                        html += '</div>';
                        html +='<p><strong>*Item Conflict Message:</strong> If you wish to continue importing orders from Shopify, the following items that are listed as non-existing may not be accounted for. Please confirm that all items have been created in the FillStorShip Storage tab to reflect accurate inventory counts.</p>'

                    }
                    else{
                        html += '<div class=" alert alert-secondary> <h5 class="alert-heading"> Inventory scanned. Ready to import. Continue?';
                    }

                    $('.modal-body').html(html);
                    $('.modal').modal('show');
                    //location.reload();
                })

                .fail(function (jqXHR, textStatus, error) {
                    console.log(error);
                });
        
        $('.modal').on('click', '.import-orders', function(e){
        $.ajax({
                type: 'GET',
                url: '/getallproducts',
                
            })
                .done(function (result) {
                    
                    //
                    console.log('success');
                    location.reload();
                })

                .fail(function (jqXHR, textStatus, error) {
                    console.log('error');
                });

        
        });
    });
});
    </script>
    @endsection