@extends('layouts.userdashlte')
@hasrole('user')

@section('main-sidebar')
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar bg-denim elevation-4">
                <!-- Brand Logo -->
                <a href="#" class="brand-link justify-content-center border-0">
                  <img src="{{asset('img/fss-white.svg')}}" alt="AdminLTE Logo" class="brand-image" width="100px" height="80px" style="max-height:27px; width:auto">
                  <span class="brand-text font-weight-light text-white">Dashboard</span>
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
                            <a href="/createfilorder" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Create Manual Order</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/dashboard/user/fulfillment" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Fulfillment Orders</p>
                            </a>
                          </li>
                        </ul>
                      </li>
          
                      <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link text-white shadow-sm" style="background-color: #3b679c">
                          <i class="nav-icon fas fa-warehouse"></i>
                          <p>
                            Storage
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="/dashboard/user/inventory" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>All Inventory</p>
                            </a>
                          </li>
          
                          <li class="nav-item">
                            <a href="/dashboard/user/orders" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Storage Orders</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/basicunit" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Create Unit</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/createkit" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Create Kit</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/createcase" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Create Case</p>
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
                            <a href="/dashboard" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>All Shipments</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/ship" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Get Quote</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/ship/book" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Book Shipment</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white">
                          <i class="nav-icon fas fa-edit"></i>
                          <p>
                            Orders
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="/createtransin" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Create Transfer In</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/createtransout" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Create Transfer Out</p>
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
                            <a href="/dashboard/user/account" class="nav-link text-white">
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
@endhasrole



@hasrole('admin')

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
          
                      <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link text-white shadow-sm" style="background-color: #3b679c">
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
                            <a href="/dashboard" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>All Shipments</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="nav-item has-treeview">
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

@endhasrole


@section('breadcrumb')
Show Order
@endsection

@section('user-name')
{{auth()->user()->name}}
@endsection

@section('content')
<div class="container" style="margin-top: 2%">

    <h2>Order Details</h2>

    <div class="row justify-content-center mt-3">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Order Details</h5>
              <p class="card-text">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th class="font-weight-normal">FSS Order ID #</th>
                      <th class="font-weight-normal">Shopify ID #</th>
                      <th class="font-weight-normal">Company</th>
                      <th class="font-weight-normal">Order Type</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{$order->orderid}}</td>
                      <td>{{$order->cust_order_no}}</td>
                      <td>{{$order->company}}</td>
                    <td>{{$order->order_type}}</td>
                    </tr>
                  </tbody>
                </table>
              </p>
              
            </div>
          </div>
          <div class="row mt-3">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Order Products</h5>
                    <p class="card-text">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th class="font-weight-normal">SKU</th>
                            <th class="font-weight-normal">UPC</th>
                            <th class="font-weight-normal">Description</th>
                            <th class="font-weight-normal">Type</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($order->basic_units->all() as $unit)
                          <tr>
                              <td>{{$unit->sku}}</td>
                              <td>{{$unit->upc}}</td>
                              <td>{{$unit->description}}</td>
                              <td>Unit</td>
                            </tr>
                          @endforeach
    
                          @foreach ($order->kits->all() as $kit)
                          <tr>
                              <td>{{$kit->sku}}</td>
                              <td>{{$kit->upc}}</td>
                              <td>{{$kit->description}}</td>
                              <td>Kit</td>
                            </tr>
                          @endforeach
    
                          @foreach ($order->cases->all() as $case)
                          <tr>
                              <td>{{$case->sku}}</td>
                              <td>{{$case->upc}}</td>
                              <td>{{$case->description}}</td>
                              <td>Case</td>
                            </tr>
                          @endforeach
    
                          @foreach ($order->cartons->all() as $carton)
                          <tr>
                              <td>{{$carton->sku}}</td>
                              <td>{{$carton->upc}}</td>
                              <td>{{$carton->description}}</td>
                              <td>Case</td>
                            </tr>
                          @endforeach
    
                          @foreach ($order->pallets->all() as $pallet)
                          <tr>
                              <td>{{$pallet->sku}}</td>
                              <td>{{$pallet->upc}}</td>
                              <td>{{$pallet->description}}</td>
                              <td>Case</td>
                            </tr>
                          @endforeach
    
                        </tbody>
                      </table>
                    </p>
                    
                  </div>
                </div>
              </div>
              
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Order Counts</h5>
                <p class="card-text">
                  <table class="table table-sm">

                    <tbody>
                      <tr>
                        <th scope="row">Unit Qty</th>
                        <td>{{$order->unit_qty}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Kit Qty</th>
                        <td>{{$order->kit_qty}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Case Qty</th>
                        <td>{{$order->case_qty}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Carton Qty</th>
                        <td>{{$order->carton_qty}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Pallet Qty</th>
                        <td>{{$order->pallet_qty}}</td>
                      </tr>

                    </tbody>
                  </table>
                </p>
                
              </div>
            </div>
          </div>
      </div>


</div>

@endsection()