@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h1 class="display-4 text-center mb-4">Build your Kit</h1>
    
    
    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

    <form action="/createkit" id="createkit" method="POST">
    <div class="form-row justify-content-center">
        <div class="col-md-8">
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
            <label for="pallet_name">Kit Name</label>
            <input type="text" name="kit_name" class="form-control form-control-sm" placeholder="Name">
            
        </div>

        <div class="col-md-4">
            <label for="sku">Kit Sku</label>
            <input type="text" name="sku" class="form-control form-control-sm"  placeholder="Sku #">
        </div>


    </div>

    <div class="form-row justify-content-center mb-4">
        <div class="col-md-8">
            <label for="desc">Description</label>
            <textarea name="desc" id="" cols="30" rows="3" class="form-control form-control-sm" placeholder="Description Here"></textarea>
        </div>
    </div>

    <div class="form-row justify-content-center mb-4">
        <div class="col-md-8 justify-content-center">
            <table class="table table-bordered table-striped" id="user_table">
                <thead>
                    <tr>
                        <th width="30%">Select Items</th>
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
            html += '<td><select name="items[]" class="form-control form-control-sm select_skus">'
            html += '@if (count($units) > 0) @foreach ($units as $unit)<option value="{{$unit->id}}">{{$unit->sku . ' - ' . $unit->unit_name}}</option>@endforeach @else<option value="" disabled>No Units Available</option> @endif </select>'
            html += '</td>';
            html += '<td> <select type="text" name="type[]" class="form-control form-control-sm" placeholder="Item Type"><option value="n/a" selected disabled>Choose</option><option value="Unit">Unit</option></select></td>'
            html += '<td><input type="text" name="item_qty[]" class="form-control" /></td>';
            if(number > 1)
            {
                html += '<td><button type="button" name="remove" id="" class="btn btn-link text-danger remove">Remove</button></td></tr>';
                
                $('.form_inventory').append(html);
            }
            else
            {   
                html += '<td>\
                        <button type="button" name="add" id="add" class="btn btn-link text-success">Add</button>\
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


        $('#createkit').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:'/createkit',
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

