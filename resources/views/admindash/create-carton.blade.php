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
Create Carton
@endsection

@section('content')
<div class="container mt-5 w-50">
    <div class="row text-center">
        <div class="col-md-12">
            <h1 class="font-weight-light">Create Carton</h1>
        </div>
    </div>

    <form action="/createcarton" id="createcarton" method="POST">
        <div class="form-row justify-content-center">
            <div class="col-md-10">
                <span class="text-center" id="result"></span>
    
            </div>
            
        </div>
        
        <div class="form-row justify-content-center mb-4">
          <div class="col-md-5">
            <label for="sku" class="font-weight-normal">Carton Sku</label>
            <input type="text" name="sku" class="form-control" placeholder="Sku #">
            <div style="font-weight: 700; color:red">{{$errors->first('sku')}}</div>
          </div>
        
          <div class="col-md-5">
            <label for="user" class="font-weight-normal">Customer</label>
            <select name="user_id" class="form-control select_user">
              <option value="">Choose Customer</option>
        
              @foreach ($users as $user)
              <option value="{{$user->id}}">{{$user->company_name}}</option>
              @endforeach
        
            </select>
          </div>
        </div>
    
        <div class="form-row justify-content-center mb-4">
            <div class="col-md-10">
                <label for="desc" class="font-weight-normal">Description</label>
                <textarea name="desc" id="" cols="30" rows="3" class="form-control form-control-sm" placeholder="Description Here"></textarea>
                <div style="font-weight: 700; color:red">{{$errors->first('desc')}}</div>
            </div>
        </div>
    
        <div class="form-row justify-content-center mb-4">
            <div class="col-md-10 justify-content-center">
                <div class="table-responsive-xl">
                <table class="table table-bordered" id="user_table">
                    <thead>
                        <tr>
                            <th width="20%" class="font-weight-normal">Select Carton Items</th>
                            
                            <th width="20%" class="font-weight-normal">Qty/Carton</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    <tbody class="form_carton">
    
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" align="left">
                                <button type="button" name="add" id="" class="btn btn-success btn-sm add-carton-row circle"><i class="fas fa-lg fa-plus"></i></button>
                                <small class="text-success">Add Item to Carton</small>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                </div>
                @csrf
                <button type="submit" name="save" id="save" class="btn bg-denim text-white">Create Carton</button>
            </div>
        </div>
    
        </form>
    
    </div>
@endsection

@section('scripts')
    

    <script>
        $(document).ready(function(){
            var count = 1;
            dynamic_carton_field(count);
            var dropdown = $('.select_carton_skus').clone(true);


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

        $(document).on('change', '.select_user', function(){
            $(document).find('.select_carton_skus').empty().val(null);
            var selected = $(':selected', this);
            var user_id = selected.val();
            var user = getUser(user_id);
            var options = '';
            options += '<option value=""></option>'
            if(user == 'User not found'){
                $(document).find('.select_carton_skus').append('<option value="">No Cases found.</option>');
                
            }
            else{
                if(user.cases.length <= 0){
                options += '<option value="">No cases available</option>';
                }
                else{
                for(var i = 0; i < user.cases.length; i++){
                    options += '<option value="' + user.cases[i].upc + '">' + user.cases[i].sku + '</option>';
                }
                }

                $(document).find('.select_carton_skus').append(options);
                
                $('.select_carton_skus').select2({
                    placeholder: "Choose Item",
                    theme: 'bootstrap4',
                    width: '100%',
                    });
            }
            dropdown = $(document).find('.select_carton_skus').clone(true);     
        });
    
        function dynamic_carton_field(number){
            html = '<tr>';
            html += '<td><select name="items[]" class="form-control select_carton_skus">'
            


            if(number > 1){
                html += dropdown.html();
                html += '</select></td>'
                html += '<td><input type="text" name="item_qty[]" class="form-control" /></td>';
                html += '<td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove-carton-row circle"><i class="fas fa-lg fa-minus"></i></button>\
                        <small class="text-danger">Remove Item</small>\
                        </td></tr>';
                $('.form_carton').append(html);
            }
            else{
                html += '</select></td>'
                html += '<td><input type="text" name="item_qty[]" class="form-control" /></td>';
                html += '<td>\
                        <button type="button" name="remove" id="" class="btn btn-danger btn-sm remove-carton-row circle"><i class="fas fa-lg fa-minus"></i></button>\
                        <small class="text-danger">Remove Item</small>\
                        </td></tr>';
                $('.form_carton').append(html);
            }
            $(document).find('.select_carton_skus').select2({
                placeholder: "Choose Item",
                theme: 'bootstrap4',
                width: '100%',
            });

        }
    
        $(document).on('click', '.remove-carton-row', function(){

            $(this).closest("tr").remove();

        });
    
        $(document).on('click', '.add-carton-row', function(){
            count++;
            dynamic_carton_field(count);
            });
    
            $('.modal').on('click', '.remove-carton-row', function(){
            const table = document.getElementsByClassName('form_carton');
            const rownum = table[0].getElementsByTagName('TR').length;
            
            if(rownum != 1){
                count--;
                $(this).closest("tr").remove();
            }
        });
    
        $(document).on('change', '.select_carton_skus', function(){
            var selected = $(':selected', this);
            var label = selected.parent().attr('label');
            if(label == 'Cartons'){
                selected.closest('tr').find('.carton-item-type').val('Carton').change();
            }
            else if(label == 'Cases'){
                selected.closest('tr').find('.carton-item-type').val('Case').change();
            }
            else if(label == 'Kits'){
                selected.closest('tr').find('.carton-item-type').val('Kit').change();
            }
            else if(label == 'Units'){
                selected.closest('tr').find('.carton-item-type').val('Unit').change();
            }
                
        });
    
        $('#createcarton').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:'/createcarton',
                    method:'post',
                    data:$(this).serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#save').attr('disabled','disabled');
                    },
                    success:function(data)
                    {
                        if(data.error)
                        {
                            var error_html = '';
                            for(var count = 0; count < data.error.length; count++)
                            {
                                error_html += '<p>'+data.error[count]+'</p>';
                            }
                            $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                        }
                        else
                        {
                            html = '<tr>';
                            html += '<td><select name="items[]" class="form-control form-control-sm select_transin_skus">'
                            html += '<option value="' + data.id + '" selected>' + data.sku + '</option>'
                            html += '</select></td>'
                            html += '<td><select name="type[]" id="" class="form-control form-control-sm type"><option value="none" disabled >Choose</option><option value="Pallet">Pallet</option><option value="Carton" selected>Carton</option><option value="Case">Case</option><option value="Kit">Kit</option><option value="Unit">Unit</option></select></td>'
                            html += '<td><input type="text" name="item_qty[]" class="form-control" /></td>';
                            html += '<td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove circle"><i class="fas fa-lg fa-minus"></i></button>\
                            <button type="button" name="editcarton" id="' + data.id + '" class="btn btn-secondary btn-sm editcarton circle"><i class="fas fa-edit fa-lg"></i></button></td></tr>';

                            $('.select_transin_skus').select2({
                                minimumResultsForSearch: 1,
                                width: '175px'
                            });

                            $('.type').select2({
                                minimumResultsForSearch: 1,
                                width: '175px'
                            });

                            $('.form_inventory').append(html);  
                            $('#result').html('<div class="alert alert-success">'+data.success+'</div>');

                        }
                        $('#save').attr('disabled', false);
                    }
                })
            });
            });
    
    </script>
    
    @endsection
    