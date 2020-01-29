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
                            <a href="/dashboard/admin/createpalletize" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Create Palletized</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/dashboard/admin/createcartonize" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Create Cartonized</p>
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
                          <li class="nav-item">
                            <a href="/dashboard/admin/createtransin" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Create Transfer In</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/dashboard/admin/createtransout" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Create Transfer Out</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/dashboard/admin/createpallet" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Create Pallet</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/dashboard/admin/createcase" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Create Case</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/dashboard/admin/createunit" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Create Unit</p>
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
                            <a href="/dashboard" class="nav-link text-white" >
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
                                    <a href="/dashboard/admin/fulfillment" class="nav-link text-white">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Fulfillment Orders</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/dashboard/admin/orders" class="nav-link text-gunmetal bg-whitewash">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Storage Orders</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/dashboard/admin/cartonizeorders" class="nav-link text-white">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Cartonized Orders</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/dashboard/admin/palletizeorders" class="nav-link text-white">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Palletized Orders</p>
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
                    <h3 class="font-weight-light">Active Orders</h3>
                    @if(count($orders) > 0)
                    <div class="table-responsive-md">
                        <table class="table table-sm orders">
                            <thead>
                            <tr>
                                <th class="fit"></th>
                                <th class="fit"></th>
                                <th class="fit">Order #</th>
                                <th class="fit">Originator</th>
                                <th class="fit">In Care Of</th>
                                <th class="fit">PO #</th>
                                <th class="fit">SO #</th>
                                <th class="fit">Job #</th>
                                <th class="fit">Carrier</th>
                                <th class="fit">Carrier ID#</th>
                                <th class="fit">Created</th>
                                <th class="fit">Status</th>
                                <th class="fit"></th>
    
                            </tr>
                            </thead>
                            @foreach($orders as $order)
    
    
                            <tr>
                                <td class="fit">
                                    <button type="button" class="btn text-denim toggle-{{$order->id}}"
                                        id="toggle-details{{$order->id}}" data-toggle="collapse"
                                        data-target="#details{{$order->id}}" aria-expanded="false" aria-controls="details"
                                        data-delay="0"><i class="fas fa-plus"></i></button>
                                </td>
                                <td class="fit">                         
                                    <div class="input-group">
                                            <form action="/order/update/{{$order->id}}" id="update-order-{{$order->id}}" method="POST">
                                    
                                                {{method_field('PUT')}}
                                                <select name="status" class="custom-select custom-select-sm rounded-0">
                                                    <option value="" selected disabled>Choose</option>
                                                    <option value="Approved">Approved</option>
                                                    <option value="In Progress">In Progress</option>
                                                    <option value="Completed">Completed</option>
                                                    <option value="Rejected">Rejected</option>
                                                </select>
                                                @csrf
                                            </form>
                                    
                                            <div class="input-group-append">
                                    
                                                <button type="submit" form="update-order-{{$order->id}}"
                                                    class="btn btn-secondary bg-denim btn-sm border-0 form-control form-control-sm"><small>Update</small></button>
                                            </div>
                                        </div>

                                </td>
                                <td class="fit">
                                    <a href="/vieworder/{{$order->id}}">
                                        <button class="btn btn-link text-denim btn-sm px-0 "
                                            type="button">{{str_pad($order->orderid, 6, '0', STR_PAD_LEFT)}}</button>
                                    </a>
                                </td>
                                <td class="fit">{{$order->originator}}</td>
                                <td class="fit">{{$order->in_care_of}}</td>
                                <td class="fit">{{$order->po_num}}</td>
                                <td class="fit">{{$order->so_num}}</td>
                                <td class="fit">{{$order->job_num}}</td>
                                <td class="fit">{{$order->carrier}}</td>
                                <td class="fit">{{$order->carrier_id}}</td>
                                <td class="fit">{{date('m/d/y', strtotime($order->created_at))}}</td>
                                <td class="fit">{{$order->status}}</td>
                                
                                <td class="fit">
                                    <div>
                                        <a href="/vieworder/{{$order->id}}" class="float-left">
                                            <button class="btn btn-link text-denim btn-sm px-1" type="button">View</button>
                                        </a>
                                        <form action="/order/remove/{{$order->id}}" method="POST" class="float-left">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-link text-danger btn-sm px-1">Remove</button>
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
                    <h3 class="font-weight-light">Order History</h3>
                    @if(count($ordershistory) > 0)
                    <div class="table-responsive-md">
                        <table class="table table-sm orders">
                            <thead>
                            <tr>
                                <th class="fit"></th>
                                <th class="fit">Order #</th>
                                <th class="fit">Originator</th>
                                <th class="fit">In Care Of</th>
                                <th class="fit">PO #</th>
                                <th class="fit">SO #</th>
                                <th class="fit">Job #</th>
                                <th class="fit">Carrier</th>
                                <th class="fit">Carrier ID#</th>
                                <th class="fit">Created</th>
                                <th class="fit">Status</th>
                                <th class="fit"></th>
    
                            </tr>
                            </thead>
                            @foreach($ordershistory as $order)
    
    
                            <tr>
                                <td class="fit">
                                    <button type="button" class="btn text-denim toggle-{{$order->id}}"
                                        id="toggle-details{{$order->id}}" data-toggle="collapse"
                                        data-target="#details{{$order->id}}" aria-expanded="false" aria-controls="details"
                                        data-delay="0"><i class="fas fa-plus"></i></button>
                                </td>
                                <td class="fit">
                                    <a href="/vieworder/{{$order->id}}">
                                        <button class="btn btn-link text-denim btn-sm px-0 "
                                            type="button">{{str_pad($order->orderid, 6, '0', STR_PAD_LEFT)}}</button>
                                    </a>
                                </td>
                                <td class="fit">{{$order->originator}}</td>
                                <td class="fit">{{$order->in_care_of}}</td>
                                <td class="fit">{{$order->po_num}}</td>
                                <td class="fit">{{$order->so_num}}</td>
                                <td class="fit">{{$order->job_num}}</td>
                                <td class="fit">{{$order->carrier}}</td>
                                <td class="fit">{{$order->carrier_id}}</td>
                                <td class="fit">{{date('m/d/y', strtotime($order->created_at))}}</td>
                                <td class="fit">{{$order->status}}</td>
    
    
                                <td class="fit">
                                    <div>
    
                                        <a href="/vieworder/{{$order->id}}" class="float-left">
                                            <button class="btn btn-link text-denim btn-sm px-1" type="button">View</button>
                                        </a>
                                        <form action="/order/remove/{{$order->id}}" method="POST" class="float-left">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-link text-danger btn-sm px-1">Remove</button>
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