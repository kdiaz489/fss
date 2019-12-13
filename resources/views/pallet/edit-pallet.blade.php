
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
Edit Pallet
@endsection

@section('content')
    <div class="container mt-5">

        <h1 class="display-4 text-center mb-4">Edit your Pallet</h1>

        <form action="/editpallet/{{$pallet->id}}" id="editpallet" method="POST">
        {{method_field('PUT')}}
        <div class="form-row justify-content-center">
            <div class="col-md-8">
                <span class="text-center" id="result"></span>
            </div>
            
        </div>

        <div class="form-row justify-content-center mb-4">

            <div class="col-md-8">
                <label for="sku">Pallet Sku</label>
                <input type="text" name="sku" class="form-control form-control-sm" value="{{$pallet->sku}}" placeholder="Sku #">
                <div style="font-weight: 700; color:red">{{$errors->first('sku')}}</div>
            </div>
        </div>

        <div class="form-row justify-content-center mb-4">
            <div class="col-md-8">
                <label for="desc">Description</label>
                <textarea name="desc" id="" cols="30" rows="3" class="form-control form-control-sm" placeholder="Description Here">{{$pallet->description}}</textarea>
                <div style="font-weight: 700; color:red">{{$errors->first('desc')}}</div>
            </div>
        </div>

        <div class="form-row justify-content-center mb-4">
            <div class="col-md-8 justify-content-center">
                <div class="table-responsive">
                <table class="table table-bordered table-striped" id="user_table">
                    <thead>
                        <tr>
                            <th width="25%">Item Sku</th>
                            <th width="25%">Type</th>
                            <th width="20%">Quantity</th>
                            <th width="30%"></th>
                            
                        </tr>
                    </thead>
                    <tbody class="form_pallet">
                        
                            @if ($pallet->cartons->all())
                                @foreach ($pallet->cartons->all() as $pallet_carton)
                                    <tr>
                                    <td><select name="items[]" class= "form-control select_pallet_skus">
                                    @if (count($cartons) > 0) <optgroup label="Cartons"> @foreach ($cartons as $carton) @if ($pallet_carton->id == $carton->id) <option value="{{$carton->id}}" selected>{{$carton->sku}}</option> @else <option value="{{$carton->id}}">{{$carton->sku}}</option> @endif @endforeach </optgroup> @else<option value="" disabled>No Cartons Available</option> @endif 
                                    @if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case)<option value="{{$case->id}}">{{$case->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Cases Available</option> @endif 
                                    @if (count($kits) > 0) <optgroup label="Kits"> @foreach ($kits as $kit)<option value="{{$kit->id}}">{{$kit->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Kits Available</option> @endif
                                    @if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit)<option value="{{$unit->id}}">{{$unit->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Units Available</option> @endif 
                                    </select></td>
                                    <td> <select type="text" name="type[]" class="form-control form-control-sm pallet-item-type" placeholder="Item Type"><option value="n/a" disabled>Choose</option><option value="Carton" selected>Carton</option><option value="Case">Case</option><option value="Kit">Kit</option><option value="Unit">Unit</option><option value="Case">Case</option></select></td>
                                    <td><input type="text" name="item_qty[]" class="form-control form-control-sm" placeholder="Item Quantity" value="{{$pallet_carton->pivot->quantity}}" /></td>
                                    <td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove-pallet-row circle"><i class="fas fa-lg fa-minus"></i></button><small class="text-danger">Remove item</small></td></tr>
                                @endforeach
                            @endif

                            @if ($pallet->cases->all())
                                @foreach ($pallet->cases->all() as $pallet_case)
                                    <tr>
                                    <td><select name="items[]" class= "form-control select_pallet_skus">
                                    @if (count($cartons) > 0) <optgroup label="Cartons"> @foreach ($cartons as $carton)<option value="{{$carton->id}}">{{$carton->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Cartons Available</option> @endif
                                    @if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case) @if ($pallet_case->id == $case->id) <option value="{{$case->id}}" selected>{{$case->sku}}</option> @else <option value="{{$case->id}}">{{$case->sku}}</option> @endif @endforeach </optgroup> @else<option value="" disabled>No Cases Available</option> @endif 
                                    @if (count($kits) > 0) <optgroup label="Kits"> @foreach ($kits as $kit)<option value="{{$kit->id}}">{{$kit->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Kits Available</option> @endif
                                    @if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit)<option value="{{$unit->id}}">{{$unit->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Units Available</option> @endif 
                                    </select></td>
                                    <td> <select type="text" name="type[]" class="form-control form-control-sm pallet-item-type" placeholder="Item Type"><option value="n/a">Choose</option><option value="Carton">Carton</option><option value="Case" selected>Case</option><option value="Kit">Kit</option><option value="Unit">Unit</option><option value="Case">Case</option></select></td>
                                    <td><input type="text" name="item_qty[]" class="form-control" placeholder="Item Quantity" value="{{$pallet_case->pivot->quantity}}" /></td>
                                    <td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove-pallet-row circle"><i class="fas fa-lg fa-minus"></i></button><small class="text-danger">Remove item</small></td></tr>
                                @endforeach
                            @endif


                            @if ($pallet->kits->all())
                                @foreach ($pallet->kits->all() as $pallet_kit)
                                    <tr>
                                    <td><select name="items[]" class= "form-control select_pallet_skus">
                                    @if (count($cartons) > 0) <optgroup label="Cartons"> @foreach ($cartons as $carton)<option value="{{$carton->id}}">{{$carton->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Cartons Available</option> @endif
                                    @if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case)<option value="{{$case->id}}">{{$case->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Cases Available</option> @endif
                                    @if (count($kits) > 0) <optgroup label="Kits"> @foreach ($kits as $kit) @if ($pallet_kit->id == $kit->id) <option value="{{$kit->id}}" selected>{{$kit->sku}}</option> @else <option value="{{$kit->id}}">{{$kit->sku}}</option> @endif @endforeach </optgroup> @else<option value="" disabled>No Kits Available</option> @endif 
                                    @if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit)<option value="{{$unit->id}}">{{$unit->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Units Available</option> @endif 
                                    </select></td>
                                    <td> <select type="text" name="type[]" class="form-control form-control-sm pallet-item-type" placeholder="Item Type"><option value="n/a" disabled>Choose</option><option value="Carton">Carton</option><option value="Case">Case</option><option value="Kit" selected>Kit</option><option value="Unit">Unit</option><option value="Case">Case</option></select></td>
                                    <td><input type="text" name="item_qty[]" class="form-control" placeholder="Item Quantity" value="{{$pallet_kit->pivot->quantity}}" /></td>
                                    <td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove-pallet-row circle"><i class="fas fa-lg fa-minus"></i></button><small class="text-danger">Remove item</small></td></tr>
                                @endforeach
                            @endif


                            @if ($pallet->basic_units->all())
                                @foreach ($pallet->basic_units->all() as $pallet_unit)
                                    <tr>
                                    <td><select name="items[]" class= "form-control select_pallet_skus">
                                    @if (count($cartons) > 0) <optgroup label="Cartons"> @foreach ($cartons as $carton)<option value="{{$carton->id}}">{{$carton->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Cartons Available</option> @endif
                                    @if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case)<option value="{{$case->id}}">{{$case->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Cases Available</option> @endif
                                    @if (count($kits) > 0) <optgroup label="Kits"> @foreach ($kits as $kit)<option value="{{$kit->id}}">{{$kit->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Kits Available</option> @endif
                                    @if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit) @if ($pallet_unit->id == $unit->id) <option value="{{$unit->id}}" selected>{{$unit->sku}}</option> @else <option value="{{$unit->id}}">{{$unit->sku}}</option> @endif @endforeach </optgroup> @else<option value="" disabled>No Units Available</option> @endif 
                                    
                                    </select></td>
                                    <td> <select type="text" name="type[]" class="form-control form-control-sm pallet-item-type" placeholder="Item Type"><option value="n/a" disabled>Choose</option><option value="Carton">Carton</option><option value="Case">Case</option><option value="Kit">Kit</option><option value="Unit" selected>Unit</option><option value="Case">Case</option></select></td>
                                    <td><input type="text" name="item_qty[]" class="form-control" placeholder="Item Quantity" value="{{$pallet_unit->pivot->quantity}}" /></td>
                                    <td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove-pallet-row circle"><i class="fas fa-lg fa-minus"></i></button><small class="text-danger">Remove item</small></td></tr>
                                @endforeach
                            @endif
                            
                    
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" align="left">
                                <button type="button" name="add" id="" class="btn btn-success btn-sm add-pallet-row circle mr-1"><i class="fas fa-lg fa-plus"></i></button><small class="text-success">Add item to pallet</small>
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
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){

        $('.select_pallet_skus').select2({
            theme: 'bootstrap4',
            width: '170px'
        });

        $('.pallet-item-type').select2({
            theme: 'bootstrap4',
            width: '170px'
        });

        $('#result').html();
        var pallet_item_count = 0;

        function dynamic_pallet_field(number){
            html = '<tr>';
            html += '<td><select name="items[]" class="form-control select_pallet_skus">'
            html += '<option value="none" disabled selected>Choose</option>'
            html += '@if (count($cartons) > 0) <optgroup label="Cartons"> @foreach ($cartons as $carton) <option value="{{$carton->id}}">{{$carton->sku}}</option> </optgroup>@endforeach @else<option value="" disabled>No Cartons Available</option> @endif '
            html += '@if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case) <option value="{{$case->id}}">{{$case->sku}}</option> </optgroup>@endforeach @else<option value="" disabled>No Cases Available</option> @endif '
            html += '@if (count($units) > 0) <optgroup label="Kits"> @foreach ($kits as $kit) <option value="{{$kit->id}}">{{$kit->sku}}</option></optgroup>@endforeach @else<option value="" disabled>No Kits Available</option> @endif '
            html += '@if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit) <option value="{{$unit->id}}">{{$unit->sku}}</option></optgroup>@endforeach @else<option value="" disabled>No Units Available</option> @endif '
            html += '</select></td>'
            html += '<td><select name="type[]" id="" class="form-control pallet-item-type"><option value="none" disabled selected>Choose</option><option value="Carton">Carton</option><option value="Case">Case</option><option value="Kit">Kit</option><option value="Unit">Unit</option></select></td>'
            html += '<td><input type="text" name="item_qty[]" class="form-control" placeholder="Item Quantity" /></td>';
            if(number >= 1)
            {
               
                html += '<td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove-pallet-row circle"><i class="fas fa-lg fa-minus"></i></button><small class="text-danger">Remove item</small></td></tr>';
                
                $('.form_pallet').append(html);
            }
            
            $('.select_pallet_skus').select2({
                theme: 'bootstrap4',
                width: '170px'
            });

            $('.pallet-item-type').select2({
                theme: 'bootstrap4',
                width: '170px'
            });
        }

        $(document).on('change', '.select_pallet_skus', function(){
            var selected = $(':selected', this);
            var label = selected.parent().attr('label');
            
            if(label == 'Cartons'){
                selected.closest('tr').find('.pallet-item-type').val('Carton').change();
            }
            else if(label == 'Cases'){
                
                selected.closest('tr').find('.pallet-item-type').val('Case').change();
            }
            else if(label == 'Kits'){
                selected.closest('tr').find('.pallet-item-type').val('Kit').change();
            }
            else if(label == 'Units'){
                selected.closest('tr').find('.pallet-item-type').val('Unit').change();
            }
             
        });

        $(document).on('click','.add-pallet-row', function(){
        pallet_item_count++;
        console.log(pallet_item_count);
        dynamic_pallet_field(pallet_item_count);
        });

        $(document).on('click', '.remove-pallet-row', function(){
        const table = document.getElementsByClassName('form_pallet');
        const rownum = table[0].getElementsByTagName('TR').length;
        
        if(rownum != 1){
            pallet_item_count--;
            $(this).closest("tr").remove();
        }
        });


        $('#editpallet').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:'/updatepallet/{{$pallet->id}}',
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
                            //dynamic_field(1);
                            $('#result').html('<div class="alert alert-success">'+data.success+'</div>');

                        }
                        $('#save').attr('disabled', false);
                    }
                })
            });
        });

</script>
@endsection