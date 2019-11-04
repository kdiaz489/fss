@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h1 class="display-4 text-center mb-4">Build your Pallet</h1>
    
    
    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

    <form action="/createpallet" id="createpallet" method="POST">
    <div class="form-row justify-content-center">
        <div class="col-md-9">
            <span class="text-center" id="result"></span>

        </div>
        
    </div>

    <div class="form-row justify-content-center">
        <div class="col-md-8">
            <button type="button" onclick="history.back()" class="btn btn-link text-gunmetal p-0"><i class="fas fa-long-arrow-alt-left"></i> Go Back</button>
            <br>
            <br>
        </div>
        
    </div>
    
    <div class="form-row justify-content-center mb-4">
        <div class="col-md-4">
            <label for="pallet_name">Pallet Name</label>
            <input type="text" name="pallet_name" class="form-control form-control-sm" placeholder="Name">
            <div style="font-weight: 700; color:red">{{$errors->first('pallet_name')}}</div>
        </div>

        <div class="col-md-4">
            <label for="sku">Pallet Sku</label>
            <input type="text" name="sku" class="form-control form-control-sm"  placeholder="Sku #">
            <div style="font-weight: 700; color:red">{{$errors->first('sku')}}</div>
        </div>

    </div>

    <div class="form-row justify-content-center mb-4">
        <div class="col-md-8">
            <label for="desc">Description</label>
            <textarea name="desc" id="" cols="30" rows="3" class="form-control form-control-sm" placeholder="Description Here"></textarea>
            <div style="font-weight: 700; color:red">{{$errors->first('desc')}}</div>
        </div>
    </div>

    <div class="form-row justify-content-center mb-4">
        <div class="col-md-8 justify-content-center">
            <table class="table table-bordered table-striped" id="user_table">
                <thead>
                    <tr>
                        <th width="30%">Select Pallet Items</th>
                        <th width="30%">Item Type</th>
                        <th width="20%">Quantity</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody class="form_inventory">

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" align="right">&nbsp;</td>
                        <td>
                            @csrf
                        <input type="submit" name="save" id="save" class="btn btn-link text-denim" value="Submit">
                        
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    </form>

</div>

<script>
    $(document).ready(function(){
        var count = 1;
        dynamic_field(count);


        function dynamic_field(number){
            html = '<tr>';
            html += '<td><select name="items[] class="form-control form-control-sm select_skus">'
            html += '@if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case)<option value="{{$case->id}}">{{$case->sku . ' - ' . $case->case_name}}</option></optgroup>@endforeach @else<option value="" disabled>No Cases Available</option> @endif '
            html += '@if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit)<option value="{{$unit->id}}">{{$unit->sku . ' - ' . $unit->unit_name}}</option></optgroup>@endforeach @else<option value="" disabled>No Units Available</option> @endif '
            html += '@if (count($units) > 0) <optgroup label="Kits"> @foreach ($kits as $kit)<option value="{{$kit->id}}">{{$kit->sku . ' - ' . $kit->kit_name}}</option></optgroup>@endforeach @else<option value="" disabled>No Kits Available</option> @endif '

            html += '</select></td>';
            html += '<td> <select type="text" name="type[]" class="form-control form-control-sm" placeholder="Item Type"><option value="n/a" selected disabled>Choose</option><option value="Unit">Unit</option><option value="Case">Case</option><option value="Kit">Kit</option></select></td>'
            html += '<td><input type="text" name="item_qty[]" class="form-control form-control-sm" placeholder="Item Quantity" /></td>';
            if(number > 1)
            {
                html += '<td><button type="button" name="remove" id="" class="btn btn-link text-danger remove">Remove</button></td></tr>';
                
                $('.form_inventory').append(html);
            }
            else
            {   
                html += '<td><button type="button" name="add" id="add" class="btn btn-link text-success add">Add</button> \
                        </td></tr>';
                $('.form_inventory').html(html);
            }
            $('.select_skus').select2({
                placeholder: 'Click to select cases'
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


        $('#createpallet').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:'/createpallet',
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

