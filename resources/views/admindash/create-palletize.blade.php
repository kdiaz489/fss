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
          
                      <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link text-white shadow-sm" style="background-color: #3b679c">
          
                          <i class="nav-icon fas fa-box-open"></i>
                          <p>
                            Fulfilment
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="/dashboard/admin/createpalletize" class="nav-link text-gunmetal bg-whitewash">
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
@endhasrole


@section('breadcrumb')
Palletize
@endsection

@section('content')

<div class="container mt-5 ">

    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

    <!-- Modal -->
    <div class="modal fade confirmModal" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle"
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

    <!--Spinner-->
    <div id="overlay" style="display:none;">
        <div class="spinner"></div>
        <br/>
        Loading...
    </div>

    <div class="container container-transin mb-5">
        <h1 class="font-weight-light text-center mb-5">Create Palletized Order</h1>
        <form id="admin_palletize_form" action="/createtransin" method="POST">
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
                        <input type="text" name="in_care_of" class="form-control" placeholder="In Care of">
                    </div>
                    <div class="col-md-4">
                        <label for="user">Customer</label>
                        <select name="user_id" class="form-control select_user">
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
                            <input type="text" name="carrier" class="form-control" placeholder="Carrier">
                        </div>
    
                        <div class="col-md-6">
                            <label for="carrier_id">Carrier Id</label>
                            <input type="text" name="carrier_id" class="form-control" placeholder="Carrier Id">
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
                        <textarea name="desc" cols="30" rows="3" class="form-control"
                            placeholder="Description Here"></textarea>

                    </div>

                    <input type="hidden" name="order_type" value="Palletize">
                    
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
                                <select name="container_type[0][]" class="form-control container_type">
                                    <option value="">Choose</option>
                                    <option value="Pallet">Pallet</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="container_barcode">Barcode</label>
                                <input type="text" name="container_barcode[0][]" class="form-control container_barcode"
                                    placeholder="container barcode">
                            </div>
                            <div class="col-md-4">
                                <label for="container_qty">Quantity</label>
                                <input type="text" name="container_qty[0][]" class="form-control container_qty"
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
                                                    <select name="items[0][]" class="form-control select_items required">
                                                        <option value="">Choose Item</option>    
                                                    </select>
                                                </td>

                                                <td width="20%">
                                                    <input type="text" name="item_qty[0][]" class="form-control required" placeholder="Quantity #"/>
                                                </td>
                                                <td width="20%"><button type="button" name="remove"
                                                        class="btn btn-danger btn-sm remove circle mr-1"><i
                                                            class="fas fa-lg fa-minus"></i></button><small
                                                        class="text-danger">Remove</small></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" class="pb-0"><button type="button" name="add"
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
    function getUser(id){
        var user = '';
        
        $.ajax({
        type: 'GET',
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        url: '/getuser/' + id,
        async:false,
        
        success: function(data){
            user = data.user; 
        },
        fail: function(e){
            user = 'User not found';
        }
        });

        return user;
    }

    $(document).ready(function(){

        var container = $('.card-container').clone(true);
        var count = 0;

        $(document).ajaxStart(function () {
            $('#overlay').fadeIn();
        });

        $(document).ajaxComplete(function () {
            $('#overlay').css("display", "none");
        });

        $('.select_items').select2({
        placeholder: "Choose Item",
        theme: 'bootstrap4',
        width: '100%',
        });
        
        /*
        $(document).on('change', '.container_type', function(){
            var selected = $(':selected', this);
            var value = selected.val();
            var label = selected.parent().attr('label');
           
            if(value == 'Pallet'){
                //selected.closest('tr').find('.type').val('Pallet').change();
                var button = '<button type="button" id="add-carton" class="btn btn-secondary btn-sm circle add-carton ml-2">\
                                <i class="fas fa-lg fa-plus"></i></button><small class="text-secondary ml-1">Add Carton to Pallet</small>';
                selected.closest('.card-container').find('.add').closest('td').append(button);
                if(selected.closest('.card-container').find('.container_qty').hasClass('required') == false){
                    selected.closest('.card-container').find('.container_qty').addClass('required');
                }

            }
             
        });
          */

        $(document).on('change', '.select_user', function(){
            $(document).find('.select_items').empty();
            var selected = $(':selected', this);
            var user_id = selected.val();
            var user = getUser(user_id);
            var html = '';
            html += '<option value="">Choose Item</option>';
            if(user == 'User not found'){
            $(document).find('.select_items').append('<option value="">No Cases found.</option>');
            }
            else{
            if(user.cases.length <= 0){
                html += '<option value="">No cases available</option>';
            }
            else{
              html += '<optgroup label="Cases">'
                for(var i = 0; i < user.cases.length; i++){
                    html += '<option value="' + user.cases[i].upc + '">' + user.cases[i].sku + '</option>';
                }
              html += '<optgroup>';
            }
            if(user.basic_units.length <= 0){
                html += '<option value="">No cases available</option>';
            }
            else{
              html += '<optgroup label="Units">'
                for(var i = 0; i < user.basic_units.length; i++){
                    html += '<option value="' + user.basic_units[i].upc + '">' + user.basic_units[i].sku + '</option>';
                }
              html += '<optgroup>';
            }
            $(document).find('.select_items').append(html);
            container = $(document).find('.card-container').clone(true);
            }  
            $('.select_items').select2({
              placeholder: "Choose Item",
              theme: 'bootstrap4',
              width: '100%',
              });
  });

       

        $(document).on('click', '.add-container', function(e){
            e.preventDefault();
            $(container)
            .clone()
            .appendTo('div.create-container')
            .find('input')
            .attr('name', function(_, currentValue){
                return currentValue.replace(/\d/, function(num){
                    var tot_ele = ($('.card-container').length) - 1;
                    return +num+ tot_ele;
                });
            });
            $('.card-container:last').find('select')
            .attr('name', function(_, currentValue){
                return currentValue.replace(/\d/, function(num){
                    var tot_ele = ($('.card-container').length) - 1;
                    return +num+ tot_ele;
                });
            });
            
        });

        $(document).on('click', '.btn-tool', function(){
            $(this).closest('.card').remove();
        });


        

        $(document).on('click', '.add', function(){
            count++;
            var user_id = $(':selected', '.select_user').val();
            var user = getUser(user_id);
            var html = '';
            html = '<tr>';
            html += '<td><select name="items['+count+'][]" class="form-control select_items required">';
            html += '<option value="">Choose Item</option>';
            
            if(user == 'User not found'){
            html += '<option value="">No Cases found.</option>';
            }
            else{
            if(user.cases.length <= 0){
                html += '<option value="">No cases available</option>';
            }
            else{
                html += '<optgroup label="Cases">'
                for(var i = 0; i < user.cases.length; i++){
                html += '<option value="' + user.cases[i].upc + '">' + user.cases[i].sku + '</option>';
                }
                html += '</optgroup>'
            }
            if(user.basic_units <= 0){
                html += '<option value="">No cases available</option>';
            }
            else{
                html += '<optgroup label="Units">'
                for(var i = 0; i < user.basic_units.length; i++){
                html += '<option value="' + user.basic_units[i].upc + '">' + user.basic_units[i].sku + '</option>';
                }
                html += '</optgroup>'
            }
            } 
            html += '</select></td>'; 
            html += '<td><input type="text" name="item_qty['+count+'][]" class="form-control required item_qty" placeholder="Quantity #"/></td>';
            html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove circle"><i class="fas fa-lg fa-minus"></i></button>\
                        <small class="text-danger">Remove</small></td>';
            html += '</tr>';
            $(this).closest('table').append(html);
            $('.select_items').select2({
              placeholder: "Choose Item",
              theme: 'bootstrap4',
              width: '100%',
              });

        });


        $(document).on('click', '.remove', function(){
            count--;
            $(this).closest("tr").remove();
        });

        $('.createpallet').on('click', function(e){
            e.preventDefault();
            $('.modal-body').load('/createpallet', function(){
                $('.modal').modal('show');
            });
            
        });
        
        $('.confirm_submit').on('click', function(event){
                event.preventDefault();
                $('.confirmModal').modal("hide");
                if($('#admin_palletize_form').valid()){
                    $('#admin_palletize_form').find('.card-container').each(function(i,ele){
                    $(ele).find('.container_type').attr('name', 'container_type['+i+'][]');
                    $(ele).find('.container_barcode').attr('name', 'container_barcode['+i+'][]');
                    $(ele).find('.container_qty').attr('name', 'container_qty['+i+'][]');
                    $(ele).find('.select_items').attr('name', 'items['+i+'][]');
                    $(ele).find('.item_qty').attr('name', 'item_qty['+i+'][]');
                    /*
                    $(this).find('.carton-container').each(function(y, ele2){
                        $(ele2).find('.carton_barcode').attr('name', 'carton_barcode['+i+']['+y+']');
                        $(ele2).find('.carton_qty').attr('name', 'carton_qty['+i+']['+y+']');
                        $(ele2).find('.select_carton_skus').attr('name', 'carton_items['+i+']['+y+'][]');
                        $(ele2).find('.carton_item_qty').attr('name', 'carton_item_qty['+i+']['+y+'][]');
                    });
                    */
                });
                
                $.ajax({
                    url:'/createpalletize',
                    method:'post',
                    data:$('#admin_palletize_form').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#save').attr('disabled','disabled');
                    },
                    success:function(data)
                    {
                        if(data.error)
                        {
                            var error_html = '';
                            for(var count = 0; count < data.error.length; count++){
                                error_html += '<p>'+data.error[count]+'</p>';
                            }
                            $('#order-result').html('<div class="alert alert-danger text-center">'+data.error+'</div>');
                        }
                        else{
                            $('#order-result').html('<div class="alert alert-success text-center">'+data.success+'</div>');
                        }
                        $('#save').attr('disabled', false);
                    }
                });
            }
            
            }); 
            
        });

</script>

@endsection