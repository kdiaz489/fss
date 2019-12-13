@extends('layouts.userdashlte')


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
                      <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link text-white shadow-sm" style="background-color: #3b679c">
                          <i class="nav-icon fas fa-shipping-fast"></i>
                          <p>
                            Shipments
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="/dashboard" class="nav-link text-gunmetal bg-whitewash">
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


@section('breadcrumb')
Shipments
@endsection

@section('content')


<div class="container-fluid dashboard-container">
    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

</div>
<div class="container-fluid dashboard-container">


    <div class="row justify-content-center">
        <div class="col-md-12">

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="col-lg-12 col-12 mb-5">
                        <p class="h1 font-weight-light">Active Shipments</p>

                        <!--
                        <a href="/ship" class="btn btn-outline-secondary">Quick Quote</a>
                        <a href="/ship/book" class="btn btn-outline-secondary">Book Shipment</a>
                        -->

                        @if(count($shipments) > 0)
                        <div class="table-responsive">

                        
                            <table class="table table-sm shipment-table">
                                <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Booked On</th>
                                    <th>Status</th>
                                    <th>Org Info</th>
                                    <th>Dest Info</th>
                                    <th>Pick Date</th>
                                    <th>Delivery Date</th>
                                    <th>Contact Name</th>
                                    <th>Contact Email</th>
                                    <th>Contact Phone</th>
                                    <th>Dock</th>
                                    <th>Fork Lift</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shipments as $shipment)
                                <tr>
                                    <td>{{str_pad($shipment->id, 6, '0', STR_PAD_LEFT)}}</td>
                                    <td>{{$shipment->created_at->format('m/d/y')}}</td>
                                    <td>{{$shipment->work_status}}</td>
                                    <td>{{$shipment->orig_company}}</td>
                                    <td>{{$shipment->dest_company}}</td>
                                    <td>{{date('m/d/y', strtotime($shipment->orig_pickup_date))}}</td>
                                    <td>{{date('m/d/y', strtotime($shipment->dest_pickup_date))}}</td>
                                    <td>{{$shipment->dest_cont_name}}</td>
                                    <td>{{$shipment->dest_cont_email}}</td>
                                    <td>{{$shipment->dest_cont_phone}}</td>
                                    <td>{{$shipment->dest_dock}}</td>
                                    <td>{{$shipment->dest_frklft}}</td>
                                    <td>
                                        <div>
                                            <a href="/ship/{{$shipment->id}}" class="float-left">
                                                <button class="btn btn-link text-success btn-sm px-0 pr-1"
                                                    type="button"><small>View</small></button>
                                            </a>
                                            <a href="/pdf/{{$shipment->id}}" class="float-left">
                                                <button class="btn btn-link text-denim btn-sm px-0 pr-1" type="button"><small>PDF</small></button>
                                            </a>
                                            <form action="/ship/cancel/{{$shipment->id}}" method="POST" class="float-left">
                                                @method('PUT')
                                                @csrf

                                                <button type="submit"
                                                    class="btn btn-link text-danger btn-sm px-0 pr-1"><small>Cancel</small></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                        @else
                        <p>You have no active shipments.</p>
                        @endif
            </div>

            <div class="col-lg-12 col-12">
                    <p class="h1 font-weight-light">Shipment History</p>

                    <!--
                    <a href="/ship" class="btn btn-outline-secondary">Quick Quote</a>
                    <a href="/ship/book" class="btn btn-outline-secondary">Book Shipment</a>
                    -->

                    @if(count($shipmentshistory) > 0)
                    <div class="table-responsive">

                    
                        <table class="table table-sm shipment-history shipments">
                            <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Booked On</th>
                                <th>Status</th>
                                <th>Org Info</th>
                                <th>Dest Info</th>
                                <th>Pick Date</th>
                                <th>Delivery Date</th>
                                <th>Contact Name</th>
                                <th>Contact Email</th>
                                <th>Contact Phone</th>
                                <th>Dock</th>
                                <th>Fork Lift</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shipmentshistory as $shipment)
                            <tr>
                                <td>{{str_pad($shipment->id, 6, '0', STR_PAD_LEFT)}}</td>
                                <td>{{$shipment->created_at->format('m/d/y')}}</td>
                                <td>{{$shipment->work_status}}</td>
                                <td>{{$shipment->orig_company}}</td>
                                <td>{{$shipment->dest_company}}</td>
                                <td>{{date('m/d/y', strtotime($shipment->orig_pickup_date))}}</td>
                                <td>{{date('m/d/y', strtotime($shipment->dest_pickup_date))}}</td>
                                <td>{{$shipment->dest_cont_name}}</td>
                                <td>{{$shipment->dest_cont_email}}</td>
                                <td>{{$shipment->dest_cont_phone}}</td>
                                <td>{{$shipment->dest_dock}}</td>
                                <td>{{$shipment->dest_frklft}}</td>
                                <td>
                                    <div>
                                        <a href="/ship/{{$shipment->id}}" class="float-left">
                                            <button class="btn btn-link text-success btn-sm px-0 pr-1"
                                                type="button"><small>View</small></button>
                                        </a>
                                        <a href="/pdf/{{$shipment->id}}" class="float-left">
                                            <button class="btn btn-link text-denim btn-sm px-0 pr-1" type="button"><small>PDF</small></button>
                                        </a>
                                        <form action="/ship/cancel/{{$shipment->id}}" method="POST" class="float-left">
                                            @method('PUT')
                                            @csrf

                                            <button type="submit"
                                                class="btn btn-link text-danger btn-sm px-0 pr-1"><small>Cancel</small></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                    @else
                    <p>You have no shipment history.</p>
                    @endif
        </div>

        </div>
    </div>
</div>
@endsection
