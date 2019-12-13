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
                            <a href="/createcase" class="nav-link text-gunmetal bg-whitewash">
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

@section('breadcrumb')
Create Case
@endsection

@section('content')

<div class="container mt-5">

    <h1 class="display-4 text-center mb-4">Create your Case</h1>

    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

    <form action="/createcase" id="createcase" method="POST">
        <div class="form-row justify-content-center">
            <div class="col-md-8">
                <span class="text-center" id="result"></span>
            </div>

        </div>


        <div class="form-row justify-content-center mb-4">

            <div class="col-md-4">
                <label for="sku">Individual Items Sku</label>
                <input type="text" name="sku" class="form-control form-control-sm" value="{{ old('sku')}}"
                    placeholder="Sku #">
                <div style="font-weight: 700; color:red">{{$errors->first('sku')}}</div>
            </div>
            <div class="col-md-4">
                <label for="upc">UPC/Barcode</label>
                <input type="text" name="upc" class="form-control form-control-sm" placeholder="UPC #">
            </div>
        </div>

        <div class="form-row justify-content-center mb-4">
            <div class="col-md-8">
                <label for="desc">Description</label>
                <textarea name="desc" id="" cols="30" rows="3" class="form-control form-control-sm"
                    placeholder="Description Here">{{ old('desc')}}</textarea>
                <div style="font-weight: 700; color:red">{{$errors->first('desc')}}</div>
            </div>
        </div>

        <div class="form-row justify-content-center mb-4">
            <div class="col-md-8 justify-content-center">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="user_table">
                    <thead>
                        <tr>
                            <th width="20%">Select Items</th>
                            <th width="20%">Type</th>
                            <th width="20%">Quantity</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody class="form_inventory">

                    </tbody>
                    <tfoot>
                        <tr>
                            
                            <td colspan="4" align="left">
                                <button type="button" name="add" id="" class="btn btn-success btn-sm add-case-row circle"><i class="fas fa-lg fa-plus"></i></button> <small class="text-success">Add item to case</small>
                            </td>
                        </tr>
                    </tfoot>
                </table>
              </div>
            </div>
        </div>
        <div class="form-row justify-content-center">
            <div class="col-md-8">
                <input type="submit" name="save" id="save" class="btn btn-primary bg-denim btn-sm border-0" value="Submit Edit">
            </div>
        </div>
    
        @csrf
    </form>

</div>

<script>
    $(document).ready(function(){
        var count = 1;
        dynamic_field(count);


        function dynamic_field(number){
            html = '<tr>';
            html += '<td><select name="items[]" class="form-control form-control-sm select_case_skus">'
            html += '<option value="none" disabled selected>Choose</option> ';
            html += '@if (count($kits) > 0) <optgroup label="Kits"> @foreach ($kits as $kit) <option value="{{$kit->id}}">{{$kit->sku}}</option>@endforeach</optgroup>  @else<option value="" disabled>No Kits Available</option> @endif '
            html += '@if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit) <option value="{{$unit->id}}">{{$unit->sku}}</option>@endforeach</optgroup> @else<option value="" disabled>No Units Available</option> @endif '

            html += '</select></td>';
            html += '<td><select name="types[]" id="" class="form-control form-control-sm case_item_type"><option value="none" disabled selected>Choose</option><option value="Kit">Kit</option><option value="Unit">Unit</option></select></td>'
            html += '<td><input type="text" name="item_qty[]" class="form-control" placeholder="Item Quantity" /></td>';
            if(number >= 1)
            {
                html += '<td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove-case-row circle mr-1"><i class="fas fa-lg fa-minus"></i></button><small class="text-danger">Remove item</small></td></tr>';
                
                $('.form_inventory').append(html);
            }
            
            $('.select_case_skus').select2({
                
                width: '175px',
                theme: 'bootstrap4'
            });

             $('.case_item_type').select2({
                
                width: '175px',
                theme: 'bootstrap4'
            });
        }

        $(document).on('change', '.select_case_skus', function(){
            var selected = $(':selected', this);
            var label = selected.parent().attr('label');
            console.log(label);
            if(label == 'Pallets'){
                selected.closest('tr').find('.type').val('Pallet').change();
            }
            if(label == 'Cartons'){
                selected.closest('tr').find('.type').val('Carton').change();
            }
            else if(label == 'Cases'){
                selected.closest('tr').find('.type').val('Case').change();
            }
            else if(label == 'Kits'){
                selected.closest('tr').find('.type').val('Kit').change();
            }
            else if(label == 'Units'){
                selected.closest('tr').find('.type').val('Unit').change();
            }
             
        });

        $(document).on('click', '.add-case-row', function(){
        count++;
        dynamic_field(count);
        });

        $(document).on('click', '.remove-case-row', function(){
        const table = document.getElementsByClassName('form_inventory');
        const rownum = table[0].getElementsByTagName('TR').length;
        
        if(rownum != 1){
            count--;
            $(this).closest("tr").remove();
        }
        });


        $('#createcase').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:'/createcase',
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
                            dynamic_field(1);
                            $('#result').html('<div class="alert alert-success">'+data.success+'</div>');

                        }
                        $('#save').attr('disabled', false);
                    }
                })
            });
        });

</script>

@endsection