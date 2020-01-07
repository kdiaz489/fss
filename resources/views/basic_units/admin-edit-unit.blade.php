@extends('layouts.userdashlte')

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
Edit Unit
@endsection

@section('content')

<div class="container mt-5">
        <h1 class="display-4 text-center mb-4">Edit Unit</h1>
        <div class="form-row justify-content-center">
            <div class="col-md-6">
                <!-- Flash Alerts Begin -->
    
                @include('partials.alerts')
    
                <!-- Flash Alerts Ends -->
            </div>
        </div>
</div>

<div class="container w-50">

    <form action="/admin/updatebasicunit/{{$basic_unit->id}}" class="" method="POST">
    {{method_field('PUT')}} 
        <div class="form-row justify-content-center mb-3">

            <div class="col-md-6">
                <label for="sku">Sku</label>
                <input type="text" name="sku" class="form-control form-control-sm" value="{{$basic_unit->sku}}" placeholder="Sku #">
                <div style="font-weight: 700; color:red">{{$errors->first('sku')}}</div>
            </div>

            <div class="col-md-6">
                    <label for="upc">UPC/Barcode</label>
                    <input type="text" name="upc" class="form-control form-control-sm" value="{{$basic_unit->upc}}" placeholder="Sku #">
                    <div style="font-weight: 700; color:red">{{$errors->first('upc')}}</div>
                </div>

        </div>

        <div class="form-row justify-content-center mb-3">
            <div class="col-md-12">
                <label for="desc">Description</label>
                <textarea name="desc" id="desc" cols="30" rows="3" class="form-control form-control-sm" placeholder="Product Description">{{$basic_unit->description}}</textarea>
            </div>
        </div>

        <div class="form-row justify-content-center mb-3">
            <div class="col-md-3">
                <label for="total_qty">Total Qty</label>
                <input type="text" name="total_qty" class="form-control form-control-sm" value="{{$basic_unit->total_qty}}" placeholder="#">
            </div>
            <div class="col-md-3">
                <label for="loose_item_qty">Loose Item Qty</label>
                <input type="text" name="loose_item_qty" class="form-control form-control-sm" value="{{$basic_unit->loose_item_qty}}" placeholder="#">
            </div>
            <div class="col-md-3">
                <label for="basic_unit_qty">Basic Unit Qty</label>
                <input type="text" name="basic_unit_qty" class="form-control form-control-sm" value="{{$basic_unit->basic_unit_qty}}" placeholder="#">
            </div>
            <div class="col-md-3">
                <label for="kit_qty">Kit Qty</label>
                <input type="text" name="kit_qty" class="form-control form-control-sm" value="{{$basic_unit->kit_qty}}" placeholder="#">
            </div>

        </div>

        <div class="form-row justify-content-center mb-3">

            <div class="col-md-4">
                <label for="case_qty">Case Qty</label>
                <input type="text" name="case_qty" class="form-control form-control-sm" value="{{$basic_unit->case_qty}}" placeholder="#">
            </div>
            <div class="col-md-4">
                <label for="carton_qty">Carton Qty</label>
                <input type="text" name="carton_qty" class="form-control form-control-sm" value="{{$basic_unit->carton_qty}}" placeholder="#">
            </div>
            <div class="col-md-4">
                <label for="pallet_qty">Pallet Qty</label>
                <input type="text" name="pallet_qty" class="form-control form-control-sm" value="{{$basic_unit->pallet_qty}}" placeholder="#">
            </div>

        </div>

        <div class="form-row justify-content-center mb-3">
                
                <div class="col-md-12">
                    <label for="location">Location</label>
                    <input type="text" name="location" class="form-control form-control-sm" value="{{$basic_unit->location}}" placeholder="location name">
                </div>
            </div>

        <div class="form-row justify-content-center">
            <button type="submit" class="btn btn-primary bg-denim border-0">Submit Update</button>
        </div>
        @csrf
    </form>

</div>


@endsection
