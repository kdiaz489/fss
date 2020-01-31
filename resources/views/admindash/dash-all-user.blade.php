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
                            <a href="/dashboard/admin/fulfillment" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Fulfillment Orders</p>
                            </a>
                          </li>
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
                            <a href="/dashboard/admin/createcarton" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Create Carton</p>
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
                      <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link text-white shadow-sm" style="background-color: #3b679c">
                              <i class="nav-icon fas fa-users"></i>
                              <p>
                                Users
                                <i class="fas fa-angle-left right"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="/dashboard/admin/users" class="nav-link text-gunmetal bg-whitewash">
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

<!-- Moddal -->
<div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLongTitle">Set Shopify Keys</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST" id="user_shopify_form">
            <div class="form-row my-3">
                <label for="shop_name">Shop Name</label>
                <input type="text" name="shop_name" class="form-control" placeholder="myshop.myshopify.com">
            </div>
            <div class="form-row my-3">
              <label for="api_key">API Key</label>
              <input type="text" name="api_key" class="form-control" placeholder="Key">
            </div>
            <div class="form-row my-3">
                <label for="api_pass">API Password</label>
                <input type="text" name="api_pass" class="form-control" placeholder="Password">
            </div>
            @csrf
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary save_keys">Save</button>
        </div>
      </div>
    </div>
  </div>

<div class="container-fluid dashboard-container">

    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

</div>

<!--Spinner-->
<div id="overlay" style="display:none;">
    <div class="spinner"></div>
    <br />
    Loading...
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
                <h3 class="font-weight-light mb-3">Manage Users</h3>
                        <div class="table-responsive">
                            <table class="table table-sm users-table mb-3 dt-responsive display nowrap">
                                <thead>
                                    <tr>
                                        <th class="fit">Company</th>
                                        <th class="fit">Name</th>
                                        <th class="fit">Address</th>
                                        <th class="fit">Email</th>
                                        <th class="fit">Role</th>
                                        <th class="fit">Account Balance</th>
                                        <th class="fit">API Key</th>
                                        <th class="fit">Credit</th>
                                        <th class="fit">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td class="fit company">{{$user->company_name}}</td>
                                        <td class="fit">{{$user->name}}</td>
                                        <td class="fit">{{$user->street_address . ' ' . $user->city . ', ' . $user->state . ' ' . $user->zip}}</td>
                                        <td class="fit">{{$user->email}}</td>
                                        <td class="fit">{{implode(', ', $user->roles()->pluck('name')->toArray())}}</td>
                                        <td class="fit">
                                            <form action="/user/accbal/update/{{$user->id}}" id="update-accbal-{{$user->id}}" class="p-0 m-0" method="POST" aria-describedby="acc_submit">
                                              <div class="input-group">
                                                  
                                                    {{method_field('PUT')}}
                                                    <input type="text" name="accbal" class="form-control form-control-sm" aria-describedby="basic-addon2" value="{{number_format($user->account_balance,2)}}">
                                                    @csrf
                                                
                                                  <div class="input-group-append">
                                                    <button type="submit" class="btn btn-secondary btn-sm" type="button">Update</button>
                                                  </div>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="fit">
                                          @if ($user->providers->all() != null )
                                          <input type="password" name="" value="{{$user->providers->first()->pivot->api_key}}" class="form-control border-0 bg-white" disabled>
                                          
                                          @else

                                          @endif
                                          
                                        </td>
                                        <td class="fit">
                                            <form action="/user/credit/update/{{$user->id}}" id="update-credit-{{$user->id}}" method="POST">
                                            <div class="input-group">
                                                    {{method_field('PUT')}}
                                                    <select name="credit_status" class="custom-select custom-select-sm rounded-0">
                                                        <option selected>Choose</option>
                                                        <option value="Approved">Approved</option>
                                                        <option value="Not Approved">Not Approved</option>
                                                    </select>
                                                    @csrf
                                                <div class="input-group-append">
                                                    <button type="submit" form="update-credit-{{$user->id}}"
                                                        class="btn btn-secondary btn-sm"><small>Update</small></button>
                                                </div>
                                            </div>
                                          </form>
                                        </td>
                                        <td class="fit">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="float-left">
                                                <button class="btn btn-link text-primary btn-sm" type="button">Edit Role</button>
                                            </a>
                                            <button class="btn btn-link text-secondary btn-sm api_keys">Shopify</button>
                                            <form action="{{route('admin.users.destroy', $user->id) }}" method="POST"
                                                class="float-left">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit"
                                                    class="btn btn-link text-danger btn-sm">Delete</button>
                                            </form>
                                            
                                            <a href="{{ route('admin.impersonate', $user->id) }}" class="float-left">
                                                <button class="btn btn-link text-success btn-sm" type="button">Impersonate</button>
                                            </a>      
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
  $(document).ready(function(){

    var initialContent = $(document).find('.modal-body').html();
    

    $('.users-table').DataTable({
      'order': [[0, 'asc']],
      'columnDefs': [
      {'targets' : [5,6,7,8], 'orderable': false, 'bSort': false}
      ],
      paging: false,
      info : false,
      responsive: true
    });

    $(document).ajaxStart(function () {
      $('#overlay').fadeIn();
    });

    $(document).ajaxComplete(function () {
        $('#overlay').css("display", "none");
    });

    $(document).on('click', '.api_keys', function(e){
      e.preventDefault();
      var user_name = $(this).closest('tr').find('.company').text();
      $('.modal-body').find('form').append('<input type="hidden" name="user_name" value = "' + user_name + '">');
      $('.modal').modal('show');
    });

  

    $('.modal').on('hide.bs.modal', function (e) {
      $('.modal-body').html(initialContent);
      $('.modal-footer').css('display', 'flex');
      });

    $(document).on('click', '.save_keys', function(e){
      e.preventDefault();
      
      var array = $('#user_shopify_form').serializeArray();
      var company_name = array[4].value;
      
      $.ajax({
        type: 'POST',
        url: '/setapikeys/' + company_name,
        data: $('#user_shopify_form').serialize(),
      })
      .done(function(result){
        $('.modal-body').html('<p class="p-5 font-weight-bold border border-secondary text-success text-center">You have successfully entered Shopify API keys for this user.<br><br> <i class="border p-4 rounded-circle border-success bg-success text-white fas fa-3x fa-thumbs-up"></i></p>');
        console.log('success');
      })
      .fail(function(error){
        html = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
        for(var i =0; i < error.responseJSON.error.length; i++){
          html += '<p>' + error.responseJSON.error[i] + '</p>';
        }
        html += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        $('.modal-body').html(html);
        $('.modal-footer').css('display', 'none');
        
      });
    });
});





</script>
@endsection