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
          
          
                      <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white">
          
                          <i class="nav-icon fas fa-box-open"></i>
                          <p>
                            Fulfilment
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
          
                          <li class="nav-item">
                            <a href="/dashboard/admin/fulfillment" class="nav-link text-white">
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
                        <a href="#" class="nav-link text-white shadow-sm" style="background-color: #3b679c">
                          <i class="nav-icon fas fa-edit"></i>
                          <p>
                            Orders
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="/dashboard/admin/orders" class="nav-link text-gunmetal bg-whitewash">
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
                                    <form action="/order/update/{{$order->id}}" method="POST">
                                        @csrf
                                        {{method_field('PUT')}}
                                        <select name="status" id="" class=" form-control form-control-sm">
                                            <option value="" selected disabled>Choose</option>
                                            <option value="Completed">Completed</option>
                                            <option value="Approved">Approved</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Rejected">Rejected</option>
                                        </select>

                                        <button type="submit" style=" margin-left: 1.25rem;"
                                            class="btn btn-link btn-sm m-0"><small>Update</small></button>
                                    </form>
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
                                                    <th width="10%">UPC</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$unit->sku}}</td>
                                                    <td>{{$unit->description}}</td>
                                                    <td>{{$unit->upc}}</td>
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
                                                    <th width="10%">UPC</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
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
                                                    <th width="10%">SKU</th>
                                                    <th width="10%">Description</th>
                                                    <th width="10%">UPC</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
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
                                                    <th width="10%">SKU</th>
                                                    <th width="10%">Description</th>
                                                    <th width="10%">UPC</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
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
                                                    <th width="10%">SKU</th>
                                                    <th width="10%">Description</th>
                                                    <th width="10%">UPC</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$pallet->sku}}</td>
                                                    <td>{{$pallet->description}}</td>
                                                    <td>{{$pallet->upc}}</td>
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
                                                    <th width="10%">UPC</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$unit->sku}}</td>
                                                    <td>{{$unit->description}}</td>
                                                    <td>{{$unit->upc}}</td>
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
                                                    <th width="10%">UPC</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
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
                                                    <th width="10%">SKU</th>
                                                    <th width="10%">Description</th>
                                                    <th width="10%">UPC</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
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
                                                    <th width="10%">SKU</th>
                                                    <th width="10%">Description</th>
                                                    <th width="10%">UPC</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
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
                                                    <th width="10%">SKU</th>
                                                    <th width="10%">Description</th>
                                                    <th width="10%">UPC</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$pallet->sku}}</td>
                                                    <td>{{$pallet->description}}</td>
                                                    <td>{{$pallet->upc}}</td>
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