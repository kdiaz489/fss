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
                        <a href="/dashboard" class="nav-link text-white">
                            <i class="fas fa-angle-right nav-icon"></i>
                            <p>All Shipments</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="/dashboard/user/getquote" class="nav-link text-gunmetal bg-whitewash">
                            <i class="fas fa-angle-right nav-icon"></i>
                            <p>Get Quote</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="/dashboard/user/bookshipment" class="nav-link text-white">
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
Get Shipping Quote
@endsection

@section('content')
<!-- Confirm Data Modal -->
<div class="modal fade shipModal" action="insert.php" id="confirm_data_Modal" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="margin:auto">

      </div>

      <div class="modal-footer">
        <div class="m-auto">
          @guest
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <input type="button" href="/register" name="register" id="register" value="Register"
            class="btn btn-primary" />
          @endguest

          @auth
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" id="bookshipment_auth" class="btn bg-denim text-white book-btn">Book</button>
          @endauth
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Confirm Data Modal Ends -->

<div class="col-md-8 justify-content-center m-auto">
<div class="container" style="margin-top:2%; margin-bottom:0%;">
  <p class="text-center"><span style="color:orange">*</span> required for quote</p>
</div>

<form id="dash_quote_form" class="" action="ship" method="POST">
  <div class="container-fluid freight-quote-container">


    <div class="row">
      <div class="col col-sm-6 bg-whitewash" style="padding:2%">
        <h3 class="text-center">Shipper</h3>

        <hr>


        <div class="form-row">

          <div class="col-lg-6 col-12">
            <label>Zip <span style="color:orange">*</span></label>
            <input type="text" class="form-control form-control-sm required" id="orig_zip" name="orig_zip"
              placeholder="Zip/Postal Code">

          </div>


          <div class="col-lg-6 col-12">
            <label>Dock</label>
            <select class="form-control form-control-sm required" id="orig_dock" name="orig_dock">
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select>

          </div>
        </div>


        <div class="form-row mt-4">
          <div class="col-sm-4">

            <label>Forklift</label>
            <div class="form-group small">
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="orig_frklft" id="orig_frklft" value="Yes"> Yes
                </label>
              </div>
              <br>
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="orig_frklft" id="orig_frklft" value="No" checked>
                  No
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <label>Liftgate</label>
            <div class="form-group small">
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="orig_lfgt" id="orig_lfgt" value="Yes"> Yes
                </label>
              </div>
              <br>
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="orig_lfgt" id="orig_lfgt" value="No" checked> No
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <label>Floorstack</label>
            <div class="form-group small">
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="orig_flrstk" id="orig_flrstk" value="Yes"> Yes
                </label>
              </div>
              <br>
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="orig_flrstk" id="orig_flrstk" value="No" checked>
                  No
                </label>
              </div>
            </div>
          </div>
        </div>

      </div>


      <div class="col-sm-6 bg-whitewash" style="padding:2%">
        <h3 class="text-center">Receiver</h3>
        <hr>

        <div class="form-row ">


          <div class="col-sm-6">
            <label>Zip <span style="color:orange">*</span></label>
            <input type="text" class="form-control form-control-sm required" name="dest_zip" id="dest_zip"
              value="{{ old('dest_zip') }}" placeholder="Zip/Postal Code">

          </div>

          <div class="col-sm-6">
            <label>Dock</label>
            <select class="form-control form-control-sm required" name="dest_dock" id="dest_dock">
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select>

          </div>
        </div>


        <div class="form-row mt-4">
          <div class="col-sm-6">
            <label>Forklift</label>
            <div class="form-group small">
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="dest_frklft" id="dest_frklft" value="Yes"> Yes
                </label>
              </div>
              <br>
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="dest_frklft" id="dest_frklft" value="No" checked>
                  No
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-6">
            <label>Liftgate</label>
            <div class="form-group small">
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="dest_lfgt" id="dest_lfgt" value="Yes"> Yes
                </label>
              </div>
              <br>
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="dest_lfgt" id="dest_lfgt" value="No" checked> No
                </label>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>


  <div class="container-fluid freight-quote-container">
    <div class="row" style="margin-top: 40px">

      <div class="col col-lg-12 col-sm-12 col-12 bg-whitewash text-gunmetal" style="padding:2%">
        <h3 class="text-center">Load Details</h3>
        <hr>

        <div class="form-row">

          <div class=" form-group col-lg-3 col-12">
            <label>Number <span style="color:orange">*</span></label>
            <input type="text" class="form-control form-control-sm required" name="no_of_pallets" id="no_of_pallets"
              placeholder="# of Items">

          </div>


          <div class=" form-group col-lg-3 col-12">
            <label>Pack Type</label>

            <select class="form-control form-control-sm required" name="prod_type" id="prod_type"
              placeholder="Pack Type">
              <option value="Pallet">Pallet</option>
              <option value="Bag">Bag</option>
              <option value="Bale">Bale</option>
              <option value="Box">Box</option>
              <option value="Bundle">Bundle</option>
              <option value="Carton">Carton</option>
            </select>

          </div>


          <div class="col col-lg-3 col-12">
            <label>Weight Per Pallet <span style="color:orange">*</span></label>
            <input type="text" class="form-control form-control-sm required" name="weight_per_pallet"
              id="weight_per_pallet" placeholder="lbs">

          </div>


          <div class="col col-lg-3 col-12">
            <label>Weight Total <span style="color:orange">*</span></label>
            <input type="text" class="form-control form-control-sm required" name="tot_load_wt" id="tot_load_wt"
              placeholder="lbs">

          </div>


        </div>



        <div class="form-row justify-content-md-center">


          <div class=" form-group col-lg-3 col-12">
            <label>Width <span style="color:orange">*</span></label>
            <input type="text" class="form-control form-control-sm required" name="pallet_width" id="pallet_width"
              placeholder="W (inches)">


          </div>

          <div class=" form-group col-lg-3 col-12">
            <label>Length <span style="color:orange">*</span></label>
            <input type="text" class="form-control form-control-sm required" name="pallet_length" id="pallet_length"
              placeholder="L (inches)">
          </div>

          <div class=" form-group col-lg-3 col-12">
            <label>Height <span style="color:orange">*</span></label>
            <input type="text" class="form-control form-control-sm required" name="pallet_height" id="pallet_height"
              placeholder="H (inches)">
          </div>

        </div>


        <div class="form-row">
          <div class=" form-group col-lg-3 col-12">
            <label>Hazardous</label>
            <select class="form-control form-control-sm" name="prod_hazard" id="prod_hazard">
              <option value="No">No</option>
              <option value="Yes">Yes</option>

            </select>

          </div>

          <div class=" form-group col-lg-3 col-12">
            <label>Stackable</label>
            <select class="form-control form-control-sm" name="prod_stackable" id="prod_stackable"
              placeholder="stackable">
              <option value="No">No</option>
              <option value="Yes">Yes</option>

            </select>

          </div>

          <div class=" form-group col-lg-3 col-12">
            <label>Load Strap</label>
            <select class="form-control form-control-sm required" name="load_strap" id="load_strap"
              placeholder="stackable">
              <option value="No">No</option>
              <option value="Yes">Yes</option>

            </select>

          </div>

          <div class=" form-group col-lg-3 col-12">
            <label>Load Block</label>
            <select class="form-control form-control-sm required" name="load_blck" id="load_blck"
              placeholder="stackable">
              <option value="No">No</option>
              <option value="Yes">Yes</option>

            </select>


          </div>

        </div>


      </div>



    </div>
  </div>

  <div class="row justify-content-center mt-3">
    <button type="button" class="btn bg-denim text-white quote-btn dash_get_quote" style="margin-right:10px">Get
      Quote</button>
    <button type="button" id="bookshipment_guest" class="btn bg-denim text-white quote-btn book-btn">Book
      Shipment</button>
  </div>


  @csrf
</form>
</div>
@endsection

