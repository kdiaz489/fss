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
                      <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link text-white shadow-sm" style="background-color: #3b679c">
          
                          <i class="nav-icon fas fa-user-alt"></i>
                          <p>
                            {{auth()->user()->name}} 
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="/dashboard/admin/account" class="nav-link text-gunmetal bg-whitewash">
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

<div class="modal fade editAdminModal" id="editAdminModal" tabindex="-1" role="dialog"
    aria-labelledby="editAdminModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer m-auto">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary">Save</button>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid dashboard-container">

    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

</div>
<div class="container-fluid dashboard-container mb-5">


    <div class="row justify-content-center">
        <div class="col-md-12 " style="padding-top: 2%">

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="col-lg-12 col-12">

                        <div class="container dashboard-container">
                            <h3 class="font-weight-light">Account Settings</h3>

                            <br>
                            <div class="container-fluid px-5" style="border: solid 1px #dee2e6; border-radius: 10px">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h4 class="mt-4 font-weight-light">Profile</h4>
                                    </div>
                                </div>

                                <div class="row py-1 border-top border-bottom">
                                    <div class="col-lg-4">
                                        <p>Username:</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>{{auth()->user()->user_name}}</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="" href="" class="editusername" id=""><i
                                                class="fas fa-pencil-alt"></i></a>
                                    </div>

                                </div>

                                <div class="row py-1 border-bottom">
                                    <div class="col-lg-4">
                                        <p>E-Mail:</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>{{auth()->user()->email}}</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="" class="editemail" id=""><i class="fas fa-pencil-alt"></i></a>
                                    </div>

                                </div>

                                <div class="row py-1 ">
                                    <div class="col-lg-4">
                                        <p>Password:</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="password" style="border:none;"
                                            value={{ str_pad('#', strlen(auth()->user()->password)/2, "#", STR_PAD_LEFT)}}/>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="" class="editpass" id=""><i class="fas fa-pencil-alt"></i></a>
                                    </div>

                                </div>
                            </div>

                            <div class="container-fluid px-5 mt-4"
                                style="border: solid 1px #dee2e6; border-radius: 10px">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h4 class="mt-4 font-weight-light">Contact Info</p>
                                    </div>
                                </div>
                                <div class="row py-1 border-top border-bottom">
                                    <div class="col-lg-4">
                                        <p>Company Name:</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>{{auth()->user()->company_name}}</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="" href="" class="editcompanyname" id=""><i
                                                class="fas fa-pencil-alt"></i></a>
                                    </div>

                                </div>

                                <div class="row py-1 border-bottom">
                                    <div class="col-lg-4">
                                        <p>Contact Name:</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>{{auth()->user()->name}}</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="" class="editcontact" id=""><i class="fas fa-pencil-alt"></i></a>
                                    </div>

                                </div>

                                <div class="row py-1 ">
                                    <div class="col-lg-4">
                                        <p>Address:</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>{{auth()->user()->street_address.' '.auth()->user()->city.', '.auth()->user()->state. ' '.auth()->user()->zip}}
                                        </p>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="" class="editaddress" id=""><i class="fas fa-pencil-alt"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </div>

    @endsection