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
                            <a href="/createkit" class="nav-link text-gunmetal bg-whitewash">
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
Edit Carton
@endsection

@section('content')
    <div class="container mt-5">

        <h1 class="display-4 text-center mb-4">Edit your Carton</h1>
        <form action="/createcarton" id="editcarton" method="POST">
        {{method_field('PUT')}}
        <div class="form-row justify-content-center">
            <div class="col-md-8">
                <span class="text-center" id="result"></span>

            </div>
            
        </div>
        
        <div class="form-row justify-content-center mb-4">

            <div class="col-md-8">
                <label for="sku">Carton Sku</label>
                <input type="text" name="sku" class="form-control form-control-sm"  placeholder="Sku #" value="{{$carton->sku}}">
                <div style="font-weight: 700; color:red">{{$errors->first('sku')}}</div>
            </div>

        </div>

        <div class="form-row justify-content-center mb-4">
            <div class="col-md-8">
                <label for="desc">Description</label>
                <textarea name="desc" id="" cols="30" rows="3" class="form-control form-control-sm" placeholder="Description Here">{{$carton->description}}</textarea>
                <div style="font-weight: 700; color:red">{{$errors->first('desc')}}</div>
            </div>
        </div>

        <div class="form-row justify-content-center mb-4">
            <div class="col-md-8 justify-content-center">
                <div class="table-responsive-md">
                <table class="table table-sm table-bordered table-striped" id="user_table">
                    <thead>
                        <tr>
                            <th width="20%">Select Items</th>
                            <th width="20%">Item Type</th>
                            <th width="20%">Quantity</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody class="form_carton">


                            @if ($carton->cases->all())
                                @foreach ($carton->cases->all() as $carton_case)
                                    <tr>
                                    <td><select name="items[]" class= "form-control select_carton_skus">
                                    @if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case) @if ($carton_case->id == $case->id) <option value="{{$case->id}}" selected>{{$case->sku}}</option> @else <option value="{{$case->id}}">{{$case->sku}}</option> @endif @endforeach </optgroup> @else<option value="" disabled>No Cases Available</option> @endif 
                                    @if (count($kits) > 0) <optgroup label="Kits"> @foreach ($kits as $kit)<option value="{{$kit->id}}">{{$kit->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Kits Available</option> @endif
                                    @if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit)<option value="{{$unit->id}}">{{$unit->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Units Available</option> @endif 
                                    </select></td>
                                    <td> <select type="text" name="type[]" class="form-control form-control-sm carton_item_type" placeholder="Item Type"><option value="n/a">Choose</option><option value="Carton">Carton</option><option value="Case" selected>Case</option><option value="Kit">Kit</option><option value="Unit">Unit</option><option value="Case">Case</option></select></td>
                                    <td><input type="text" name="item_qty[]" class="form-control form-control-sm" placeholder="Item Quantity" value="{{$carton_case->pivot->quantity}}" /></td>
                                    <td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove-edit-carton-row circle"><i class="fas fa-lg fa-minus"></i></button>
                                        <button type="button" name="add" id="" class="btn btn-success btn-sm add-edit-carton-row circle"><i class="fas fa-lg fa-plus"></i></button></td></tr>
                                @endforeach
                            @endif


                            @if ($carton->kits->all())
                                @foreach ($carton->kits->all() as $carton_kit)
                                    <tr>
                                    <td><select name="items[]" class= "form-control select_carton_skus">
                                    @if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case)<option value="{{$case->id}}">{{$case->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Cases Available</option> @endif
                                    @if (count($kits) > 0) <optgroup label="Kits"> @foreach ($kits as $kit) @if ($carton_kit->id == $kit->id) <option value="{{$kit->id}}" selected>{{$kit->sku}}</option> @else <option value="{{$kit->id}}">{{$kit->sku}}</option> @endif @endforeach </optgroup> @else<option value="" disabled>No Kits Available</option> @endif 
                                    @if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit)<option value="{{$unit->id}}">{{$unit->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Units Available</option> @endif 
                                    </select></td>
                                    <td> <select type="text" name="type[]" class="form-control form-control-sm carton_item_type" placeholder="Item Type"><option value="n/a" disabled>Choose</option><option value="Carton">Carton</option><option value="Case">Case</option><option value="Kit" selected>Kit</option><option value="Unit">Unit</option><option value="Case">Case</option></select></td>
                                    <td><input type="text" name="item_qty[]" class="form-control form-control-sm" placeholder="Item Quantity" value="{{$carton_kit->pivot->quantity}}" /></td>
                                    <td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove-edit-carton-row circle"><i class="fas fa-lg fa-minus"></i></button>
                                        <button type="button" name="add" id="" class="btn btn-success btn-sm add-edit-carton-row circle"><i class="fas fa-lg fa-plus"></i></button></td></tr>
                                @endforeach
                            @endif


                            @if ($carton->basic_units->all())
                                @foreach ($carton->basic_units->all() as $carton_unit)
                                    <tr>
                                    <td><select name="items[]" class= "form-control select_carton_skus">
                                    @if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case)<option value="{{$case->id}}">{{$case->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Cases Available</option> @endif
                                    @if (count($kits) > 0) <optgroup label="Kits"> @foreach ($kits as $kit)<option value="{{$kit->id}}">{{$kit->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Kits Available</option> @endif
                                    @if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit) @if ($carton_unit->id == $unit->id) <option value="{{$unit->id}}" selected>{{$unit->sku}}</option> @else <option value="{{$unit->id}}">{{$unit->sku}}</option> @endif @endforeach </optgroup> @else<option value="" disabled>No Units Available</option> @endif 
                                    
                                    </select></td>
                                    <td> <select type="text" name="type[]" class="form-control form-control-sm carton_item_type" placeholder="Item Type"><option value="n/a" disabled>Choose</option><option value="Carton">Carton</option><option value="Case">Case</option><option value="Kit">Kit</option><option value="Unit" selected>Unit</option><option value="Case">Case</option></select></td>
                                    <td><input type="text" name="item_qty[]" class="form-control form-control-sm" placeholder="Item Quantity" value="{{$carton_unit->pivot->quantity}}" /></td>
                                    <td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove-edit-carton-row circle"><i class="fas fa-lg fa-minus"></i></button>
                                        <button type="button" name="add" id="" class="btn btn-success btn-sm add-edit-carton-row circle"><i class="fas fa-lg fa-plus"></i></button></td></tr>
                                @endforeach
                            @endif
                            
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" align="left">
                                <button type="button" name="add" id="" class="btn btn-success btn-sm add-carton-row circle mr-1"><i class="fas fa-lg fa-plus"></i></button><small class="text-success">Add item to carton</small>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
        <div class="form-row justify-content-center">
            <div class="col-md-8">
                <input type="submit" name="save" id="save" class="btn btn-primary bg-denim border-0" value="Submit Edit">
            </div>
        </div>
         @csrf
        </form>

</div>
@endsection


@section('scripts')
<script>
    $(document).ready(function(){

        $('.select_carton_skus').select2({
            theme: 'bootstrap4',
            width: '170px'
        });

        $('.carton_item_type').select2({
            theme: 'bootstrap4',
            width: '170px'
        });

        var count = 0;
        dynamic_carton_field(count);


        function dynamic_carton_field(number){
            html = '<tr>';
            html += '<td><select name="items[]" class="form-control form-control-sm select_carton_skus">'
            html += '<option value="none" disabled selected>Choose</option>'
            html += '@if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case) <option value="{{$case->id}}">{{$case->sku}}</option>@endforeach</optgroup> @else<option value="" disabled>No Cases Available</option> @endif '
            html += '@if (count($kits) > 0) <optgroup label="Kits"> @foreach ($kits as $kit) <option value="{{$kit->id}}">{{$kit->sku}}</option>@endforeach</optgroup> @else<option value="" disabled>No Kits Available</option> @endif '
            html += '@if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit) <option value="{{$unit->id}}">{{$unit->sku}}</option>@endforeach</optgroup> @else<option value="" disabled>No Units Available</option> @endif '
            html += '</select></td>'
            html += '<td><select name="type[]" id="" class="form-control form-control-sm carton_item_type"><option value="none" disabled selected>Choose</option><option value="Case">Case</option><option value="Kit">Kit</option><option value="Unit">Unit</option></select></td>'
            html += '<td><input type="text" name="item_qty[]" class="form-control" /></td>';
            if(number >= 1)
            {
               
                html += '<td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove-edit-carton-row circle"><i class="fas fa-lg fa-minus"></i></button>\
                        <button type="button" name="add" id="" class="btn btn-success btn-sm add-edit-carton-row circle"><i class="fas fa-lg fa-plus"></i></button></td></tr>';
                
                $('.form_carton').append(html);
            }

            $('.select_carton_skus').select2({
                theme: 'bootstrap4',
                width: '170px'
            });

            $('.carton_item_type').select2({
                theme: 'bootstrap4',
                width: '170px'
            });

        }



        $(document).on('click', '.add-edit-carton-row', function(){
        count++;
        dynamic_carton_field(count);
        });

        $(document).on('click', '.remove-edit-carton-row', function(){
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
                selected.closest('tr').find('.carton_item_type').val('Carton').change();
            }
            else if(label == 'Cases'){
                selected.closest('tr').find('.carton_item_type').val('Case').change();
            }
            else if(label == 'Kits'){
                selected.closest('tr').find('.carton_item_type').val('Kit').change();
            }
            else if(label == 'Units'){
                selected.closest('tr').find('.carton_item_type').val('Unit').change();
            }
             
        });

        $('#editcarton').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:'/updatecarton/{{$carton->id}}',
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
                            
                            $('#result').html('<div class="alert alert-danger">'+data.error+'</div>');
                        }
                        else
                        {
                           
                            $('#result').html('<div class="alert alert-success">'+data.success+'</div>');

                        }
                        $('#save').attr('disabled', false);
                    }
                })
            });
        });

</script>
@endsection