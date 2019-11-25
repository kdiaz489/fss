@extends('layouts.userdashboard')

@section('content')

<div class="container mt-5">
    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->
    
    <h1 class="display-4 text-center mb-4">Create Fulfillment Order</h1>
    <div class="container w-75">
        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".csv">
                    <br>
                    <button class="btn btn-success">Import User Data</button>
            </form>
            @yield('csv_data')
    </div>



    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div class="container w-75">
        <form id="fil_order_form" action="" method="">
            <div class="form-row justify-content-center">

                <div class="col-md-12">
                    <span class="" id="order-result"></span>
                </div>
            </div>

            <div class="form-row px-0">
                <div class="col-md-12">
                    <a href="/dashboard/user/fulfillment" class="btn btn-link text-gunmetal pl-0"><i
                            class="fas fa-long-arrow-alt-left"></i> Back</a>
                    

                </div>

            </div>


            <div class="form-row justify-content-center mb-4">

                <div class="col-md-6">
                    <label for="custname">Customer Name</label>
                    <input type="text" name="custname" class="form-control" placeholder="Name">
                </div>

                <div class="col-md-6">
                    <label for="ordernum">Order #</label>
                    <input type="text" name="ordernum" class="form-control" placeholder="Order Number">
                </div>
            </div>

            <div class="form-row justify-content-center mb-4">
                <div class="col-md-4">
                    <label for="address">Street Address</label>
                    <input type="text" name="address" class="form-control" placeholder="Purchaser street Address">

                </div>
                <div class="col-md-4">
                    <label for="city">City</label>
                    <input type="text" name="city" class="form-control" placeholder="Purchaser City">

                </div>

                <div class="col-md-4">
                    <label for="zip">Zip</label>
                    <input type="text" name="zip" class="form-control" placeholder="Purchaser Zip">

                </div>

                <input type="hidden" name="order_type" value="Fulfill Items">

            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="user_table">
                    <thead>
                        <tr>
                            <th width="20%">Select Order Item</th>
                            <th width="20%">Item Type</th>
                            <th width="20%">Qty per order</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    <tbody class="form_inventory">

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" align="left">
                                <button type="button" name="add" id="" class="btn btn-success btn-sm add circle"><i class="fas fa-lg fa-plus"></i></button>
                                <small class="text-success">Add Item to Order</small>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @csrf
            <input type="submit" name="save" id="save" class="btn btn-primary bg-denim btn-sm" value="Submit Order">
        </form>

    </div>

</div>


<script>
    $(document).ready(function(){
        var count = 1;
        dynamic_field(count);


        function dynamic_field(number){
            html = '<tr>';
            html += '<td><select name="items[]" class="form-control form-control-sm select_transin_skus">'
            html += '<option value="none" disabled selected>Choose</option>'
            html += '@if (count($pallets) > 0) <optgroup label="Pallets"> @foreach ($pallets as $pallet)<option class="option-sm" value="{{$pallet->id}}">{{$pallet->sku}}</option>@endforeach</optgroup> @else<option value="" disabled>No Pallets Available</option> @endif '
            html += '@if (count($cartons) > 0) <optgroup label="Cartons"> @foreach ($cartons as $carton)<option class="option-sm" value="{{$carton->id}}">{{$carton->sku}}</option>@endforeach</optgroup> @else<option value="" disabled>No Cartons Available</option> @endif '
            html += '@if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case) @if($case->total_qty !=0) <option class="option-sm" value="{{$case->id}}">{{$case->sku}}</option>@endif @endforeach</optgroup> @else<option value="" disabled>No Cases Available</option> @endif '
            html += '@if (count($kits) > 0) <optgroup label="Kits"> @foreach ($kits as $kit) @if($kit->total_qty !=0) <option class="option-sm" value="{{$kit->id}}">{{$kit->sku}}</option>@endif @endforeach</optgroup> @else<option value="" disabled>No Kits Available</option> @endif '
            html += '@if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit) @if($unit->total_qty !=0) <option class="option-sm" value="{{$unit->id}}">{{$unit->sku}}</option>@endif @endforeach</optgroup> @else<option value="" disabled>No Units Available</option> @endif '
            html += '</select></td>'
            html += '<td><select name="type[]" id="" class="form-control form-control-sm type"><option value="none" disabled selected>Choose</option><option value="Pallet">Pallet</option><option value="Carton">Carton</option><option value="Case">Case</option><option value="Kit">Kit</option><option value="Unit">Unit</option></select></td>'
            html += '<td><input type="text" name="item_qty[]" class="form-control" /></td>';
            if(number > 1)
            {
               
                html += '<td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove circle"><i class="fas fa-lg fa-minus"></i></button>\
                        <small class="text-danger">Remove Item</small>\
                        </td></tr>';
                
                $('.form_inventory').append(html);
            }
            else
            {   
                html += '<td>\
                        <button type="button" name="remove" id="" class="btn btn-danger btn-sm remove circle"><i class="fas fa-lg fa-minus"></i></button>\
                        <small class="text-danger">Remove Item</small>\
                        </td></tr>';
                $('.form_inventory').append(html);
            }
            $('.select_transin_skus').select2({
                minimumResultsForSearch: 1,
                width: '175px'
            });

            $('.type').select2({
                minimumResultsForSearch: 1,
                width: '175px'
            });
        }

        $(document).on('change', '.select_transin_skus', function(){
            var selected = $(':selected', this);
            var label = selected.parent().attr('label');
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


        $(document).on('click', '.editpallet', function(e){
            e.preventDefault();
            const palletid = this.id;
            $('.modal-body').load('/editpallet/' + palletid, function(){
                $('.modal').modal('show');
            });
            
        });

        $(document).on('click', '.editcarton', function(e){
            e.preventDefault();
            const cartonid = this.id;
            $('.modal-body').load('/editcarton/' + cartonid, function(){
                $('.modal').modal('show');
            });
              
        });
          

        $(document).on('click', '.add', function(){
            count++;
            dynamic_field(count);
        });

        $(document).on('click', '.remove', function(){
            const table = document.getElementsByClassName('form_inventory');
            const rownum = table[0].getElementsByTagName('TR').length;
            
            if(rownum != 1){
                count--;
                $(this).closest("tr").remove();
            }
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

        
        $('#fil_order_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:'/createfilorder',
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
                            
                            $('#order-result').html('<div class="alert alert-danger text-center">'+data.error+'</div>');
                        }
                        else
                        {
                            //dynamic_field(1);
                            $('#order-result').html('<div class="alert alert-success text-center">'+data.success+'</div>');

                        }
                        $('#save').attr('disabled', false);
                    }
                })
            }); 
            
        });

</script>

@endsection