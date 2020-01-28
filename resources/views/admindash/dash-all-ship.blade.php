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
                            <a href="/dashboard" class="nav-link text-gunmetal bg-whitewash" >
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



    
        <div class="col-lg-12 ">

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="col-lg-12 col-12">

                    <h3 class="font-weight-light mb-0">Active Shipments</h3>


                    @if(count($shipments) > 0)
                    <div class="table-responsive-md">
                        <table class="table table-sm shipment-table">
                            <thead>
                            <tr>
                                <th class="fit">Status</th>
                                <th class="fit">Order #</th>
                                <th class="fit">Booked</th>
                                <th class="fit">Status</th>
                                <th class="fit">Sender</th>
                                <th class="fit">Receiver</th>
                                <th class="fit">Pickup</th>
                                <th class="fit">Delivery</th>
                                <th class="fit">Contact</th>
                                <th class="fit">Email</th>
                                <th class="fit">Phone</th>
                                <th class="fit">Dock</th>
                                <th class="fit">Fork Lift</th>
                                <th class="fit">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shipments as $shipment)
                            <tr>
                                <td class="fit">
                                    <div class="input-group">
                                        <form action="/ship/admin/update/{{$shipment->id}}" id="update-ship-{{$shipment->id}}" method="POST">
                                
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
                                
                                            <button type="submit" form="update-ship-{{$shipment->id}}"
                                                class="btn btn-secondary bg-denim btn-sm border-0 form-control form-control-sm"><small>Update</small></button>
                                        </div>
                                    </div>
                                </td>
                                <td class="fit">
                                  <a href="/ship/{{$shipment->id}}" class="float-left">
                                    <button class="btn btn-link text-denim btn-sm px-0"
                                      type="button">{{str_pad($shipment->id, 6, '0', STR_PAD_LEFT)}}</button>
                                  </a>
                                </td>
                                <td class="fit">{{$shipment->created_at->format(' m/d/y')}}</td>
                                <td class="fit">{{$shipment->work_status}}</td>
                                <td class="fit">{{$shipment->orig_company}}</td>
                                <td class="fit">{{$shipment->dest_company}}</td>
                                <td class="fit">{{date('m/d/y', strtotime($shipment->orig_pickup_date))}}</td>
                                <td class="fit">{{date('m/d/y', strtotime($shipment->dest_pickup_date))}}</td>
                                <td class="fit">{{$shipment->dest_cont_name}}</td>
                                <td class="fit">{{$shipment->dest_cont_email}}</td>
                                <td class="fit">{{$shipment->dest_cont_phone}}</td>
                                <td class="fit">{{$shipment->dest_dock}}</td>
                                <td class="fit">{{$shipment->dest_frklft}}</td>
                                <td class="fit">
                                    <div>
                                        <a href="/pdf/{{$shipment->id}}" class="float-left">
                                            <button class="btn btn-link text-denim btn-sm p-0 m-0" type="button"><small>PDF</small></button>
                                        </a>
                                        <form action="/ship/{{$shipment->id}}" method="POST" class="float-left">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-link text-danger btn-sm p-0 m-0"><small>Remove</small></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                        @else
                        <p>You have no requests.</p>
                        @endif
                    
            </div>
            <div class="col-lg-12 col-12 mt-3">

                    <h3 class="font-weight-light mb-0">Shipment History</h3>

                    @if(count($shipmentshistory) > 0)
                    <div class="table-responsive-md">
                        <table class="table table-sm shipment-history">
                            <thead>
                            <tr>
                                <th class="fit">Status</th>
                                <th class="fit">Order #</th>
                                <th class="fit">Booked</th>
                                <th class="fit">Status</th>
                                <th class="fit">Sender</th>
                                <th class="fit">Receiver</th>
                                <th class="fit">Pickup</th>
                                <th class="fit">Delivery</th>
                                <th class="fit">Contact</th>
                                <th class="fit">Email</th>
                                <th class="fit">Phone</th>
                                <th class="fit">Dock</th>
                                <th class="fit">Fork Lift</th>
                                <th class="fit">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shipmentshistory as $shipment)
                            
                            <tr>
                                <td>
                                    <div class="input-group">
                                        <form action="/ship/admin/update/{{$shipment->id}}" id="update-ship-{{$shipment->id}}" method="POST">
                                
                                            {{method_field('PUT')}}
                                            <select name="status" class="custom-select custom-select-sm rounded-0">
                                                <option value="" selected disabled>Choose</option>
                                                <option value="Approved">Approved</option>
                                                <option value="In Progress">In Progress</option>
                                                <option value="Picked">Picked</option>
                                                <option value="Boxed">Boxed</option>
                                                <option value="Rejected">Rejected</option>
                                            </select>
                                            @csrf
                                        </form>
                                
                                        <div class="input-group-append">
                                
                                            <button type="submit" form="update-ship-{{$shipment->id}}"
                                                class="btn btn-secondary bg-denim btn-sm border-0 form-control form-control-sm"><small>Update</small></button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="/ship/{{$shipment->id}}" class="float-left">
                                      <button class="btn btn-link text-denim btn-sm px-0"
                                        type="button">{{str_pad($shipment->id, 6, '0', STR_PAD_LEFT)}}</button>
                                    </a>
                                </td>
                                <td>{{$shipment->created_at->format(' m/d/y')}}</td>
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

                                            <a href="/pdf/{{$shipment->id}}" class="float-left">
                                                <button class="btn btn-link text-success btn-sm px-0" type="button"><small>PDF</small></button>
                                            </a>
                                            <form action="/ship/{{$shipment->id}}" method="POST" class="float-left">
                                                @method('DELETE')
                                                @csrf
    
                                                <button type="submit"
                                                    class="btn btn-link text-danger btn-sm px-0"><small>Remove</small></button>
                                            </form>
                                        </div>
                                </td>
                            </tr>
                            @endforeach
                            <tbody>
                        </table>
                        @else
                        <p>You have no requests.</p>
                        @endif
                    </div>
            </div>
        </div>

        @endsection