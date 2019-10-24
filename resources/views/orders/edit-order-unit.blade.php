@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h1 class="display-4 text-center mb-4">Edit Order - Transfer In Units</h1>
    
    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

                    <div class="container w-75">
                            <form id="update_unit_order" method="POST">
                                {{method_field('PUT')}}

                                <span class="" id="result"></span>

                                <div class="form-row justify-content-center mb-4">
                                    <div class="col-md-6">
                                        <label for="unit_name">Order Name</label>
                                        <input type="text" name="unit_name" class="form-control" placeholder="Name" value="{{$order->name}}">
                                        <div style="font-weight: 700; color:red">{{$errors->first('name')}}</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="barcode">Barcode</label>
                                        <input type="text" name="barcode" class="form-control" placeholder="Barcode" value="{{$order->barcode}}">
                                        <div style="font-weight: 700; color:red">{{$errors->first('barcode')}}</div>
                                    </div>
                                </div>

                                <div class="form-row justify-content-center mb-4">
                                    <div class="col-md-12">
                                        <label for="desc">Description</label>
                                        <textarea name="desc" id="" cols="30" rows="3" class="form-control" placeholder="Description Here">{{$order->desc}}</textarea>
                                        <div style="font-weight: 700; color:red">{{$errors->first('desc')}}</div>

                                    </div>

                                    <input type="hidden" name="order_type" value="Transfer In Units">

                                </div>

                                <table class="table table-bordered table-striped" id="user_table">
                                    <thead>
                                        <tr>
                                            <th width="35%">Unit SkU</th>
                                            <th width="35%">Quantity</th>
                                            <th width="30%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="form_inventory">
                                        <td><select name="units[]" class="form-control form-control-sm select_kit_skus" multiple="multiple" placeholder="Click to Select Kits">
                                        
                                            @if(count($order->basic_units) >0))
                                            @foreach ($order->basic_units as $unit)
                                            <option value="{{$unit->id}}" selected>{{$unit->sku . ' - ' . $unit->unit_name}}</option>
                                            

                                            @foreach($units as $item)
                                            <option value="">{{$item->sku . ' - ' . $item->unit_name}}</option>
                                            @endforeach

                                        </td>
                                        <td>
                                            <input type="text" value="{{$unit->pivot->quantity}}">
                                        </td>
                                        <td>
                                            <button type="button" name="add" id="add" class="btn btn-link text-success">Add</button><button type="button" name="remove" id="" class="btn btn-link text-danger remove">Remove</button>
                                        </td>
                                            @endforeach

                                            @endif
                                        

                                  

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" align="right">&nbsp;</td>
                                            <td>
                                                @csrf
                                                <a onclick="history.back()" class="btn btn-link text-frenchblue" style="margin-right:2%"><i class="fas fa-long-arrow-alt-left"></i> Go Back</a>
                                                <input type="submit" name="save" id="save" class="btn btn-primary bg-denim btn-sm" value="Submit">
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>
                        
                    </div>

</div>


<script>
    /*
    $(document).ready(function(){
        var count = 0;
        dynamic_field(count);

    //$('.select_kit_skus').select2().val({!! json_encode($order->basic_units()->allRelatedIds() ) !!}).trigger('change');

        function dynamic_field(number){

            if(number >= 1)
            {
                html = '<tr>';
                html += '<td><select name="units[]" class="form-control form-control-sm select_kit_skus" multiple="multiple" placeholder="Click to Select Kits">'
                html += '@if (count($units) > 0) @foreach ($units as $unit)<option value="{{$unit->id}}">{{$unit->sku . ' - ' . $unit->unit_name}}</option>@endforeach @else<option value="" disabled>No Kits Available</option> @endif </select>'
                html += '</td>';
                html += '<td><input type="text" name="unit_qty[]" class="form-control" /></td>';
                html += '<td><button type="button" name="add" id="add" class="btn btn-link text-success">Add</button><button type="button" name="remove" id="" class="btn btn-link text-danger remove">Remove</button></td></tr>';
                
                $('.form_inventory').append(html);
            }
            else
            {   
                html = '@foreach($order->basic_units->all() as $item) <tr>';
                html += '<td><select name="units[]" class="form-control form-control-sm select_kit_skus" multiple="multiple" value="{{$item->id}}">'
                html += '@if (count($units) > 0) @foreach ($units as $unit) if()<option value="{{$unit->id}}">{{$unit->sku . ' - ' . $unit->unit_name}}</option>@endforeach @else<option value="" disabled>No Kits Available</option> @endif </select>'
                html += '</td>';
                html += '<td><input type="text" name="unit_qty[]" class="form-control" value="{{$unit->pivot}}" /></td>';
                html += '<td><button type="button" name="add" id="add" class="btn btn-link text-success">Add</button><button type="button" name="remove" id="" class="btn btn-link text-danger remove">Remove</button></td> </tr>  @endforeach';
                $('.form_inventory').html(html);
            }
            $('.select_kit_skus').select2({
                placeholder: 'Click to select'
            });
        }



        $(document).on('click', '#add', function(){
        count++;
        dynamic_field(count);
        });

        $(document).on('click', '.remove', function(){
        count--;
        $(this).closest("tr").remove();
        });


        $('#update_unit_order').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:'/updateorder/unit/{{$order->id}}',
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
*/
</script>

@endsection