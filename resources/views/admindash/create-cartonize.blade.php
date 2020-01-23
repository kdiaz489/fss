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
                        <a href="#" class="nav-link text-white" >
          
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
                            <a href="/dashboard/user/getquote" class="nav-link text-white">
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
                            <a href="/createtransin" class="nav-link text-gunmetal bg-whitewash">
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
          
                      <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white" >
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
Cartonize
@endsection

@section('content')

<div class="container mt-5 ">

    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

    <!-- Modal -->
    <div class="modal fade confirmModal" id="" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to submit?</p>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary bg-denim confirm_submit">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container container-transin mb-5">
        <h1 class="font-weight-light text-center mb-5">Create Cartonize</h1>
        <form id="trans_in_order_form" action="/createtransin" method="POST">
            <div class="form-row justify-content-center">

                <div class="col-md-12">
                    <span class="" id="order-result"></span>
                </div>
            </div>



            <div class="card">
                <div class="card-header">
                  <span class="display-4 " style="font-size: 1.2rem;"> 1. Order Information</span>
                </div>
                <div class="card-body">
                <div class="form-row justify-content-center mb-4">
                    <div class="col-md-4">
                        <label for="originator">Originator</label>
                        <input type="text" name="originator" class="form-control required" placeholder="Originator">
                    </div>

                    <div class="col-md-4">
                        <label for="in_care_of">In Care Of</label>
                        <input type="text" name="in_care_of" class="form-control required" placeholder="In Care of">
                    </div>
                    <div class="col-md-4">
                      <label for="user">Customer</label>
                      <select name="user" class="form-control user" id="">
                        <option value="">Choose Customer</option>

                        @foreach ($users as $user)
                          <option value="{{$user->id}}">{{$user->company_name}}</option>    
                        @endforeach
                        
                      </select>
                    </div>
                </div>
                <div class="form-row justify-content-center mb-4">

                    <div class="col-md-4">
                        <label for="po_num">PO #</label>
                        <input type="text" name="po_num" class="form-control" placeholder="#">
                    </div>

                    <div class="col-md-4">
                        <label for="so_num">SO #</label>
                        <input type="text" name="so_num" class="form-control" placeholder="#">
                    </div>
                    <div class="col-md-4">
                        <label for="job_num">Job #</label>
                        <input type="text" name="job_num" class="form-control" placeholder="#">
                    </div>
                </div>
                <div class="form-row justify-content-center mb-4">
                        <div class="col-md-6">
                            <label for="carrier">Carrier</label>
                            <input type="text" name="carrier" class="form-control required" placeholder="Carrier">
                        </div>
    
                        <div class="col-md-6">
                            <label for="carrier_id">Carrier Id</label>
                            <input type="text" name="carrier_id" class="form-control required" placeholder="Carrier Id">
                        </div>
                    </div>
                <div class="form-row justify-content-center mb-4">

                    <div class="col-md-12">
                        <label for="upc">UPC/Barcode</label>
                        <input type="text" name="upc" class="form-control" placeholder="#">
                    </div>
                </div>

                <div class="form-row justify-content-center mb-4">
                    <div class="col-md-12">
                        <label for="desc">Description</label>
                        <textarea name="desc" id="" cols="30" rows="3" class="form-control"
                            placeholder="Description Here"></textarea>

                    </div>

                    <input type="hidden" name="order_type" value="Cartonize">

                </div>
            </div>

            </div>

            <div class="card">
                <div class="card-header">
                  <span class="display-4" style="font-size: 1.2rem;"> 2. Create Product Container</span>
                    <div class="float-right"><button class="btn btn-link add-container p-0 m-0">Add Container</button></div>

                </div>
                <div class="card-body create-container">
                    <div class="card card-container">
                        <div class="card-header bg-white border-bottom-0 pt-1 pb-0 pl-0 pr-2">
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-row px-0 p-2 mb-1 order">

                            <div class="col-md-4">
                                <label for="container_type">Container Type</label>
                                <select name="container_type[0][]" class="form-control container_type required">
                                    <option value="">Choose</option>
                                    <option value="Carton">Cartonize</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="container_barcode">Barcode</label>
                                <input type="text" name="container_barcode[0][]" class="form-control container_barcode"
                                    placeholder="container barcode">
                            </div>
                            <div class="col-md-4">
                                <label for="container_qty">Quantity</label>
                                <input type="text" name="container_qty[0][]" class="form-control container_qty required"
                                    placeholder="container quantity">
                            </div>
                        </div>

                            <div class="form-row px-0 p-2 container_items">
                            <div class="col-md-12 mt-4">

                                <label> Select Products for Container</label>
                                <div class="table-responsive-md">
                                    <table class="table" id="user_table">
                                        <thead style="display:none">
                                            <tr>
                                                <th>Select Order Items</th>
                                                <th>Qty per order</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="form_inventory">
                                            <tr>
                                                <td  width="20%">
                                                    <select name="items[0][]" class="form-control select_cases required">
                                                        <option value="">Choose Item</option>
                                                        
                                                    </select>
                                                </td>

                                                <td width="20%">
                                                    <input type="text" name="item_qty[0][]" class="form-control required" placeholder="Quantity #"/>
                                                </td>
                                                <td width="20%"><button type="button" name="remove" id=""
                                                        class="btn btn-danger btn-sm remove circle mr-1"><i
                                                            class="fas fa-lg fa-minus"></i></button><small
                                                        class="text-danger">Remove</small></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" class="pb-0"><button type="button" name="add" id=""
                                                        class="btn btn-success btn-sm add circle"><i
                                                            class="fas fa-lg fa-plus"></i></button><small
                                                        class="text-success ml-1">Add Product to Container</small></td>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="container w-75 mb-3 mt-0" align="left">
                @csrf
                <button type="button" class="btn btn-primary bg-denim btn-sm" name ="save" id="save" data-toggle="modal" data-target=".confirmModal">Submit Order</button>
            </div>
        </form>

    </div>

</div>
@endsection

@section('scripts')

<script>
$(document).ready(function(){

  function getUser(id){
    var user = '';
    
    $.ajax({
      type: 'GET',
      headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
      url: '/getuser/' + id,
      async:false,
      
      success: function(data){
          console.log('success');
          user = data.user; 
      },
      fail: function(e){
          console.log('user not found');
          user = 'User not found';
      }
      });

      return user;
  }

  $(document).on('change', '.user', function(){
    var selected = $(':selected', this);
    var user_id = selected.val();
    console.log('user id = ' + user_id);
    var user = getUser(user_id);
    var select = '';
    console.log(user);
    if(user == 'User not found'){
      $(document).find('.select_cases').append('<option value="">No Cases found.</option>');
    }
    else{
      if(user.cases.length <= 0){
        select += '<option value="">No cases available</option>';
      }
      else{
        for(var i = 0; i < user.cases.length; i++){
          select += '<option value="' + user.cases[i].upc + '">' + user.cases[i].sku + '</option>';
        }
      }

      $(document).find('.select_cases').append(select);
    }     
  });

});

</script>

@endsection