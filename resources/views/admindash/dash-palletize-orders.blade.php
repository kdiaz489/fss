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
                                    <a href="/dashboard/admin/orders" class="nav-link text-white">
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
                                    <a href="/dashboard/admin/palletizeorders" class="nav-link text-gunmetal bg-whitewash">
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

<!-- Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
        </div>
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
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
                                <th class="fit">Carrier ID</th>
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
                                <td class="order-id fit" id = "order-{{$order->id}}">
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
                                <td class="status fit">{{$order->status}}</td>
                                <td class="fit">
                                    <div>

                                        <button class="btn btn-link text-success btn-sm float-left pick-order" id="pick-pallet-order-{{$order->id}}">Pick</button>
                                        <button class="btn btn-link text-denim btn-sm float-left fulfill-order" id="fulfill-pallet-order-{{$order->id}}">Fulfill</button>
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
                                                    <th class="fit">SKU</th>
                                                    <th class="fit">Description</th>
                                                    <th class="fit">UPC</th>
                                                    <th class="fit">Container Type</th>
                                                    <th class="fit">Quantity</th>
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
                                                    <th class="fit">SKU</th>
                                                    <th class="fit">Description</th>
                                                    <th class="fit">UPC</th>
                                                    <th class="fit">Container Type</th>
                                                    <th class="fit">Quantity</th>
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
                                                    <th class="fit">SKU</th>
                                                    <th class="fit">Description</th>
                                                    <th class="fit">UPC</th>
                                                    <th class="fit">Container Type</th>
                                                    <th class="fit">Quantity</th>
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
                                                    <th class="fit">SKU</th>
                                                    <th class="fit">Description</th>
                                                    <th class="fit">UPC</th>
                                                    <th class="fit">Container Type</th>
                                                    <th class="fit">Quantity</th>
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
                                                    <th class="fit">SKU</th>
                                                    <th class="fit">Description</th>
                                                    <th class="fit">UPC</th>
                                                    <th class="fit">Container Type</th>
                                                    <th class="fit">Quantity</th>
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
                                <th class="fit">Carrier ID</th>
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
                                                    <th class="fit">SKU</th>
                                                    <th class="fit">Description</th>
                                                    <th class="fit">UPC</th>
                                                    <th class="fit">Container Type</th>
                                                    <th class="fit">Quantity</th>
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
                                                    <th class="fit">SKU</th>
                                                    <th class="fit">Description</th>
                                                    <th class="fit">UPC</th>
                                                    <th class="fit">Container Type</th>
                                                    <th class="fit">Quantity</th>
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
                                                    <th class="fit">SKU</th>
                                                    <th class="fit">Description</th>
                                                    <th class="fit">UPC</th>
                                                    <th class="fit">Container Type</th>
                                                    <th class="fit">Quantity</th>
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
                                                    <th class="fit">SKU</th>
                                                    <th class="fit">Description</th>
                                                    <th class="fit">UPC</th>
                                                    <th class="fit">Container Type</th>
                                                    <th class="fit">Quantity</th>
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
                                                    <th class="fit">SKU</th>
                                                    <th class="fit">Description</th>
                                                    <th class="fit">UPC</th>
                                                    <th class="fit">Container Type</th>
                                                    <th class="fit">Quantity</th>
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

    @section('scripts')
    <script>
        function validatePick() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = $(document).find('.modal-body');
        y = $(x).find('.qty').toArray();
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            
            
            if ($(y[i]).hasClass('counting') || !($(y[i]).hasClass('picked'))) {
                // add an "invalid" class to the field:
                $(y[i]).addClass('invalid');
                // and set the current valid status to false
                valid = false;
                }
                else{
                $(y[i]).removeClass('invalid');
            }
            
        }
        return valid; // return the valid status
        }

        $(document).ready(function(){
            let currentRow = '';

            $('.pick-order').on('click', function(e){
                e.preventDefault();
                currentRow = $(this).closest('tr');
                let id = $(this).attr('id').slice(18);
                let status = $(currentRow).find('.status').text();
                if(status != 'Picked'){
                    $.ajax({
                        type: 'GET',
                        url: '/getpalletizedorder/' + id
                    })
                    .done(function(result){
                        
                        let order = result.order;
                        let pallets = order.pallets;
                        let cases = pallets.cases;
                        

                        let html = '<div class="container" id=" order-' + id + '">';
                        for(let i = 0; i < pallets.length; i++){
                            for(let x = 0; x < pallets[i].cases.length; x++){
                                let pallet_case = pallets[i].cases[x];

                                html += '<div class="row border-top py-0 border-bottom my-3">';
                                html += '<div class="col-md-4 border-bottom bg-ghostwhite"><p class="my-0">Case SKU</p></div>';
                                html += '<div class="col-md-4 border-bottom bg-ghostwhite"><p class="my-0">Quantity</p></div>';
                                html += '<div class="col-md-4 border-bottom bg-ghostwhite"><p class="my-0">Picked</p></div>';
                                html += '<div class="col-md-4"><p class="case_sku case">' + pallet_case.sku + '</p></div>';
                                html += '<div class="col-md-4 case-qty"><p> x' + pallet_case.pivot.quantity + '</p></div>';
                                html += '<div class="col-md-4 qty"><p>0</p></div>';
                                html += '</div>';

                            }
                            html += '</div>';
                        }
                            
                        var footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary bg-denim submit-pick">Pick Order</button>'
                        $('.modal-header').prepend('<h5>#' + id + '</h5>');
                        $('.modal-body').html(html);
                        $('.modal-footer').html(footer);
                        $('.modal').modal('show');
                    })
                    .fail(function(result){
                        console.log('fail');
                    });
            }
            else if(status == 'Picked' || status == 'Completed'){
                
                $('.modal-body').html('<p class="p-5 font-weight-bold border border-secondary text-success text-center">Your order is already picked. Please proceed to boxing the products. <br> <br> <i class="border p-4 rounded-circle border-success bg-success text-white fas fa-3x fa-box"></i></p>');
                $('.modal-footer').html('');
                $('.modal').modal('show');
            }
            });


        function verify_sku(sku, barcode, type, id){
            var valid = false;
            console.log( 'verify id = ' + id);
            $.ajax({
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                        url: '/verifyorderskus/' + id,
                        async:false,
                        data: {
                            sku: sku,
                            barcode: barcode,
                            type: type
                        },
                        success: function(data){
                            console.log('success');
                            valid = true; 
                        },
                        fail: function(e){
                            console.log('fail');
                        }
                        });

            return valid;
        }

    $('.modal').scannerDetection({
            onComplete: function(barcode, qty){
                
                var modal_body = $(document).find('.modal-body');
                var id = $(document).find('.modal-header').find('h5').text().slice(1);
                var input_list = modal_body.find('.case_sku').toArray();
                console.log('input list = ' + input_list);
                var valid = "";
                
                for(var i = 0; i < input_list.length; i++){
                    var sku = $(input_list[i]).text();
                    var type = 'Case';
                    var qty = parseInt($(input_list[i]).closest('.row').find('.case-qty').find('p').text().slice(2),10);
                    valid = verify_sku(sku, barcode, type, id);
                    
                    if(valid === true){

                        var current_count = parseInt($(input_list[i]).closest('.row').find('.qty').text(), 10);
                        current_count++;

                        if(current_count == qty){
                            $(input_list[i]).closest('.row').find('.qty').text(current_count);
                            $(input_list[i]).closest('.row').find('.qty').addClass('bg-success picked');
                            $(input_list[i]).closest('.row').find('.qty').removeClass('invalid');
                            $(input_list[i]).closest('.row').find('.qty').append('<i class=" ml-2 fas fa-check d-inline"></i>'); 
                            $(input_list[i]).addClass('picked');
                            console.log($(input_list[i]));
                            
                            
                        }
                        else if(current_count < qty){
                            $(input_list[i]).closest('.row').find('.qty').text(current_count);
                            $('div.alert:contains(' + barcode + ')').css('display', 'none');  
                        }
                        else{
                            
                        }
                        break;

                    }                
                }
                if(valid === false){
                    console.log('valid === false ... ' + valid);
                    if(!$('div.alert:contains(' + barcode + ')').length){
                        $('.modal-body').prepend('<div class="alert alert-danger alert-dismissable fade show" role ="alert">' + barcode + ' not found <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

                    }
                    
                    }

            }
            });

            $('.modal').on('click', '.submit-pick', function(e){
            e.preventDefault();
            
            var id = $(this).parent().prev().find('.container').attr('id').slice(7);
            var status = $(currentRow).find('.status');
            var button = $(this);
            

            var formData = new FormData();
            formData.append('status', 'Picked');
            formData.append('_method', 'PUT');
            formData.append('_token', '{{csrf_token()}}');

            if(validatePick()){
                $.ajax({
                type: 'POST',
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                url: '/order/update/' + id,
                data: formData,
                processData: false,
                contentType: false,
                beforeSend:function(){
                    
                    $(button).attr('disabled','disabled');
                    }
                })
                .done(function (result) {
                    $(currentRow).find('.status').html('Picked');
                    $('.modal-body').html('<p class="p-5 font-weight-bold border border-secondary text-success text-center">Your order has been successfully picked. <br> <br> <i class="border p-4 rounded-circle border-success bg-success text-white fas fa-3x fa-thumbs-up"></i></p>');
                    $('.modal-footer').html('');
                    $('.modal').modal('show');

                    
                })

                .fail(function (jqXHR, textStatus, error) {
                    $('.modal-body').html('<p class="p-5 font-weight-bold border border-secondary text-danger text-center">Your order has not been successfully picked. Please try again. <br> <br> <i class=" border p-4 rounded-circle border-danger fas fa-3x fa-thumbs-down"></i></p>');
                    $('.modal-footer').html('');
                    $('.modal').modal('show');

                    
                });
            }
            else if(!validatePick()){
                console.log(validatePick() + ' ... Form has not been validated.');
                return false;
            }

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
                var button = $(this);
                $.ajax({
                type: 'POST',
                url: '/order/update/' + id,
                data: {
                    status: 'Completed',
                    _method: 'PUT',
                    _token: '{{csrf_token()}}'
                },
                beforeSend:function(){
                $(button).attr('disabled','disabled');
                }
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
    });
    </script>
    @endsection