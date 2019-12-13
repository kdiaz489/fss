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


@section('breadcrumb')
Transfer In
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
        <h1 class="font-weight-light text-center mb-5">Create Transfer In Order</h1>
        <form id="trans_in_order_form" action="/createtransin" method="POST">
            <div class="form-row justify-content-center">

                <div class="col-md-12">
                    <span class="" id="order-result"></span>
                </div>
            </div>



            <div class="card">
                <div class="card-header">
                    1) Order Information
                </div>
                <div class="card-body">
                <div class="form-row justify-content-center mb-4">
                    <div class="col-md-6">
                        <label for="originator">Originator</label>
                        <input type="text" name="originator" class="form-control required" placeholder="Originator">
                    </div>

                    <div class="col-md-6">
                        <label for="in_care_of">In Care Of</label>
                        <input type="text" name="in_care_of" class="form-control required" placeholder="In Care of">
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

                    <input type="hidden" name="order_type" value="Transfer In Items">

                </div>
            </div>

            </div>

            <div class="card">
                <div class="card-header">
                    2) Create Product Container
                    <div class="float-right"><button class="btn btn-link add-container">Add Container</button></div>

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
                                    <option value="Pallet">Pallet</option>
                                    <option value="Carton">Carton</option>
                                    <option value="Loose Items">Loose Items</option>
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
                                <div class="table-responsive">
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
                                                    <select name="items[0][]" class="form-control select_transin_skus required">
                                                        <option value="">Choose Item</option>
                                                        @if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case) <option value="{{$case->upc}}">{{$case->sku}}</option> @endforeach</optgroup> @else<option value="" disabled>No Cases Available</option> @endif 
                                                        @if (count($kits) > 0) <optgroup label="Kits"> @foreach ($kits as $kit) <option value="{{$kit->upc}}">{{$kit->sku}}</option> @endforeach</optgroup> @else<option value="" disabled>No Kits Available</option> @endif 
                                                        @if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit) <option value="{{$unit->upc}}">{{$unit->sku}}</option> @endforeach</optgroup> @else<option value="" disabled>No Units Available</option> @endif 
    
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

        //var container = $('.create-container').html();
        var container = $('.card-container').clone(true);
        var count = 1;



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
            
            if(value == 'Carton'){
                //selected.closest('tr').find('.type').val('Carton').change();
                selected.closest('.card-container').find('.add-carton').remove();
                selected.closest('.card-container').find('.text-secondary').remove();
                if(selected.closest('.card-container').find('.container_qty').hasClass('required') == false){
                    selected.closest('.card-container').find('.container_qty').addClass('required');
                }
            }

            if(value == 'Loose Items'){
                //selected.closest('tr').find('.type').val('Carton').change();
                selected.closest('.card-container').find('.container_qty').removeClass('required');
                selected.closest('.card-container').find('.add-carton').remove();
                selected.closest('.card-container').find('.text-secondary').remove();
            }
            /*
            else if(label == 'Cases'){
                selected.closest('tr').find('.type').val('Case').change();
            }
            else if(label == 'Kits'){
                selected.closest('tr').find('.type').val('Kit').change();
            }
            else if(label == 'Units'){
                selected.closest('tr').find('.type').val('Unit').change();
            }
            */
             
        });
          

        $(document).on('click', '.editpallet', function(e){
            e.preventDefault();
            const palletid = this.id;
            $('.modal-body').load('/editpallet/' + palletid, function(){
                $('.modal').modal('show');
            });
            
        });

        $(document).on('click', '.add-carton', function(e){
                e.preventDefault();
                html = '<div class="bg-whitewash shadow-sm my-3 col-md-12 py-3 carton-container">'
                html += '<div class="form-row"><div class="col-md-12"><button type="button" class="btn remove-carton float-right"> <i class="fas fa-times"></i></button></div></div>'
                html += '<div class="form-row mb-3">'
                html += '<div class="col-md-6"> <label for="carton_barcode">Carton Barcode</label><input type="text" name="carton_barcode[0][]" class="form-control carton_barcode" placeholder="container barcode"></div>\
                            <div class="col-md-6"><label for="container_qty">Carton Quantity</label> <input type="text" name="carton_qty[0][]" class="form-control carton_qty required" placeholder="container quantity"></div></div>'
                html += '<label> Select Products for Carton</label>'
                html += '<div class="form-row">'
                html += '<table class="table"><thead></thead><tbody><tr>';
                html += '<td width="20%"><select name="carton_items[0][][]" class="form-control select_carton_skus required">'
                html += '<option value="">Choose Item</option>'
                html += '@if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case) <option value="{{$case->upc}}">{{$case->sku}}</option> @endforeach</optgroup> @else<option value="" disabled>No Cases Available</option> @endif '
                html += '@if (count($kits) > 0) <optgroup label="Kits"> @foreach ($kits as $kit) <option value="{{$kit->upc}}">{{$kit->sku}}</option> @endforeach</optgroup> @else<option value="" disabled>No Kits Available</option> @endif '
                html += '@if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit) <option value="{{$unit->upc}}">{{$unit->sku}}</option> @endforeach</optgroup> @else<option value="" disabled>No Units Available</option> @endif '
                html += '</select></td>'
                html += '<td width="20%"><input type="text" name="carton_item_qty[0][][]" class="form-control required carton_item_qty" placeholder="Quantity #"/></td>';
                html += '<td width="20%"><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove circle"><i class="fas fa-lg fa-minus"></i></button>\
                    <small class="text-danger">Remove</small>\
                    </td></tr>';
                html += '<tfoot><tr> <td colspan="4" class="pb-0 links"><button type="button" name="add" id="" class="btn btn-success btn-sm add_carton_row circle">\
                        <i class="fas fa-lg fa-plus"></i></button><small class="text-success ml-1">Add Product to Carton</small></td></tr> </tfoot>'
                html += '</tbody></table></div></div>';
                $(this).closest('div.container_items').append(html);

            //$('.create-container').append(container);
            
            
        });

        $(document).on('click', '.add-container', function(e){
            e.preventDefault();
            console.log(container);
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
            //$('.create-container').append(container);
            
        });

        $(document).on('click', '.editcarton', function(e){
            e.preventDefault();
            const cartonid = this.id;
            $('.modal-body').load('/editcarton/' + cartonid, function(){
                $('.modal').modal('show');
            });
              
        });

        $(document).on('click', '.btn-tool', function(){
        
            $(this).closest('.card').remove();

        });


        $(document).on('click', '.remove-carton', function(){
        
        $(this).closest('.carton-container').remove();

        });

        $(document).on('click', '.add', function(){
        count++;
        html = '<tr>';
        html += '<td><select name="items['+count+'][]" class="form-control select_transin_skus required">'
        html += '<option value="">Choose Item</option>'
        html += '@if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case) <option value="{{$case->upc}}">{{$case->sku}}</option> @endforeach</optgroup> @else<option value="" disabled>No Cases Available</option> @endif '
        html += '@if (count($kits) > 0) <optgroup label="Kits"> @foreach ($kits as $kit) <option value="{{$kit->upc}}">{{$kit->sku}}</option> @endforeach</optgroup> @else<option value="" disabled>No Kits Available</option> @endif '
        html += '@if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit) <option value="{{$unit->upc}}">{{$unit->sku}}</option> @endforeach</optgroup> @else<option value="" disabled>No Units Available</option> @endif '
        html += '</select></td>'
        html += '<td><input type="text" name="item_qty['+count+'][]" class="form-control required item_qty" placeholder="Quantity #"/></td>';
        html += '<td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove circle"><i class="fas fa-lg fa-minus"></i></button>\
                    <small class="text-danger">Remove</small>\
                    </td></tr>';
        $(this).closest('table').append(html);

        });

        $(document).on('click', '.add_carton_row', function(){
        count++;
        html = '<tr>';
        html += '<td><select name="carton_items['+count+'][][]" class="form-control select_carton_skus required">'
        html += '<option value="">Choose Item</option>'
        html += '@if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case) <option value="{{$case->upc}}">{{$case->sku}}</option> @endforeach</optgroup> @else<option value="" disabled>No Cases Available</option> @endif '
        html += '@if (count($kits) > 0) <optgroup label="Kits"> @foreach ($kits as $kit) <option value="{{$kit->upc}}">{{$kit->sku}}</option> @endforeach</optgroup> @else<option value="" disabled>No Kits Available</option> @endif '
        html += '@if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit) <option value="{{$unit->upc}}">{{$unit->sku}}</option> @endforeach</optgroup> @else<option value="" disabled>No Units Available</option> @endif '
        html += '</select></td>'
        html += '<td><input type="text" name="carton_item_qty['+count+'][][]" class="form-control required carton_item_qty" placeholder="Quantity #"/></td>';
        html += '<td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove circle"><i class="fas fa-lg fa-minus"></i></button>\
                    <small class="text-danger">Remove</small>\
                    </td></tr>';
        $(this).closest('table').append(html);

        });

        $(document).on('click', '.remove', function(){
        //const table = document.getElementsByClassName('form_inventory');
        //const rownum = table[0].getElementsByTagName('TR').length;
        /*
        if(rownum != 1){
            count--;
            $(this).closest("tr").remove();
        }
        });
        */
        count--;
        $(this).closest("tr").remove();
        });

        $('.createpallet').on('click', function(e){
            e.preventDefault();
            $('.modal-body').load('/createpallet', function(){
                $('.modal').modal('show');
            });
            
        });


        $('.createcarton').on('click', function(e){
            e.preventDefault();
            $('.modal-body').load('/createcarton', function(){
                $('.modal').modal('show');
            });
            
        });

        
        $('.confirm_submit').on('click', function(event){
                event.preventDefault();
                $('.confirmModal').modal("hide");
                if($('#trans_in_order_form').valid()){
                    $('#trans_in_order_form').find('.card-container').each(function(i,ele){
                    $(ele).find('.container_type').attr('name', 'container_type['+i+'][]');
                    $(ele).find('.container_barcode').attr('name', 'container_barcode['+i+'][]');
                    $(ele).find('.container_qty').attr('name', 'container_qty['+i+'][]');
                    $(ele).find('.select_transin_skus').attr('name', 'items['+i+'][]');
                    $(ele).find('.item_qty').attr('name', 'item_qty['+i+'][]');
                    
                    $(this).find('.carton-container').each(function(y, ele2){
                        $(ele2).find('.carton_barcode').attr('name', 'carton_barcode['+i+']['+y+']');
                        $(ele2).find('.carton_qty').attr('name', 'carton_qty['+i+']['+y+']');
                        $(ele2).find('.select_carton_skus').attr('name', 'carton_items['+i+']['+y+'][]');
                        $(ele2).find('.carton_item_qty').attr('name', 'carton_item_qty['+i+']['+y+'][]');
                    });
                    

                });
                
                
                
                $.ajax({
                    url:'/createtransin',
                    method:'post',
                    data:$('#trans_in_order_form').serialize(),
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
                            
                            $('#order-result').html('<div class="alert alert-danger text-center">'+data.error+'</div>');
                        }
                        else
                        {
                            //dynamic_field(1);
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