@extends('layouts.userdashlte')

@section('user-name')
{{auth()->user()->name}}
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

    <div class="container w-75 mb-5">
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

                        <div class="col-md-12">
                            <label for="barcode">Barcode</label>
                            <input type="text" name="barcode" class="form-control" placeholder="Barcode" required>
                            <div style="font-weight: 700; color:red">{{$errors->first('barcode')}}</div>
                        </div>
                    </div>

                    <div class="form-row justify-content-center mb-4">
                        <div class="col-md-12">
                            <label for="desc">Description</label>
                            <textarea name="desc" id="" cols="30" rows="3" class="form-control"
                                placeholder="Description Here" required></textarea>
                            <div style="font-weight: 700; color:red">{{$errors->first('desc')}}</div>

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
                    <div class="card">
                        <div class="card-header bg-white border-bottom-0 pt-1 pb-0 pl-0 pr-2">
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-row px-0 p-2 mb-3 order">

                            <div class="col-md-4">
                                <label for="container_type">Type</label>
                                <select name="container_type[][]" class="form-control form-control-sm container_type" required>
                                    <option value="">Choose</option>
                                    <option value="Pallet">Pallet</option>
                                    <option value="Carton">Carton</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="container_barcode">Barcode</label>
                                <input type="text" name="container_barcode[][]" class="form-control form-control-sm container_barcode"
                                    placeholder="container barcode" required>
                            </div>
                            <div class="col-md-4">
                                <label for="container_qty">Quantity</label>
                                <input type="text" name="container_qty[][]" class="form-control form-control-sm container_qty"
                                    placeholder="container quantity" required>
                            </div>

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
                                                    <select name="items[][]" class="form-control select_transin_skus" required>
                                                        <option value="">Choose Item</option>
                                                        @if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case) <option value="{{$case->sku}}">{{$case->sku}}</option> @endforeach</optgroup> @else<option value="" disabled>No Cases Available</option> @endif 
                                                        @if (count($kits) > 0) <optgroup label="Kits"> @foreach ($kits as $kit) <option value="{{$kit->sku}}">{{$kit->sku}}</option> @endforeach</optgroup> @else<option value="" disabled>No Kits Available</option> @endif 
                                                        @if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit) <option value="{{$unit->sku}}">{{$unit->sku}}</option> @endforeach</optgroup> @else<option value="" disabled>No Units Available</option> @endif 
    
                                                    </select>
                                                </td>

                                                <td width="20%">
                                                    <input type="text" name="item_qty[][]" class="form-control" placeholder="Quantity #" required/>
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
                                                        class="text-success ml-1">Add Item</small></td>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div align="left">
                @csrf
                <input type="submit" name="save" id="save" class="btn btn-primary bg-denim btn-sm" value="Submit Order">
            </div>
        </form>

    </div>

</div>
@endsection

@section('scripts')

<script>
    $(document).ready(function(){

            html = '<tr>';
            html += '<td><select name="items[][]" class="form-control select_transin_skus" required>'
            html += '<option value="">Choose Item</option>'
            html += '@if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case) <option value="{{$case->sku}}">{{$case->sku}}</option> @endforeach</optgroup> @else<option value="" disabled>No Cases Available</option> @endif '
            html += '@if (count($kits) > 0) <optgroup label="Kits"> @foreach ($kits as $kit) <option value="{{$kit->sku}}">{{$kit->sku}}</option> @endforeach</optgroup> @else<option value="" disabled>No Kits Available</option> @endif '
            html += '@if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit) <option value="{{$unit->sku}}">{{$unit->sku}}</option> @endforeach</optgroup> @else<option value="" disabled>No Units Available</option> @endif '
            html += '</select></td>'
            html += '<td><input type="text" name="item_qty[][]" class="form-control item_qty" placeholder="Quantity #" required/></td>';
            html += '<td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove circle"><i class="fas fa-lg fa-minus"></i></button>\
                        <small class="text-danger">Remove</small>\
                        </td></tr>';

        var container = $('.create-container').html();

        var count = 1;



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

        $(document).on('click', '.add-container', function(e){
            e.preventDefault();
            
            $('.create-container').append(container);
            
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

        $(document).on('click', '.add', function(){
        count++;
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

        
        $('#trans_in_order_form').on('submit', function(event){
                event.preventDefault();
                $(this).find('.order').each(function(i,ele){
                    $(ele).find('.container_type').attr('name', 'container_type['+i+'][]');
                    $(ele).find('.container_barcode').attr('name', 'container_barcode['+i+'][]');
                    $(ele).find('.container_qty').attr('name', 'container_qty['+i+'][]');
                    $(ele).find('.select_transin_skus').attr('name', 'items['+i+'][]');
                    $(ele).find('.type').attr('name', 'type['+i+'][]');
                    $(ele).find('.item_qty').attr('name', 'item_qty['+i+'][]');
                });
                
                $.ajax({
                    url:'/createtransin',
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
                            
                            $('#order-result').html('<div class="alert alert-danger text-center">'+error_html+'</div>');
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