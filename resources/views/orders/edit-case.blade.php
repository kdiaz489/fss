@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h1 class="display-4 text-center mb-4">Edit your Case</h1>
    
    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

    <form action="/updatecase/{{$case->id}}" id="editcase" method="POST">
    {{method_field('PUT')}}
    <div class="form-row justify-content-center">
        <div class="col-md-8">
            <span class="text-center" id="result"></span>
        </div>
        
    </div>
    
    <div class="form-row justify-content-center mb-4">
        <div class="col-md-4">
            <label for="case_name">Case Name</label>
            <input type="text" name="case_name" class="form-control form-control-sm" value="{{$case->case_name}}" placeholder="Name">
            <div style="font-weight: 700; color:red">{{$errors->first('case_name')}}</div>
        </div>

        <div class="col-md-4">
            <label for="sku">Case Sku</label>
            <input type="text" name="sku" class="form-control form-control-sm" value="{{$case->case_name}}" placeholder="Sku #">
            <div style="font-weight: 700; color:red">{{$errors->first('sku')}}</div>
        </div>
    </div>

    <div class="form-row justify-content-center mb-4">
        <div class="col-md-8">
            <label for="desc">Description</label>
            <textarea name="desc" id="" cols="30" rows="3" class="form-control form-control-sm" placeholder="Description Here">{{$case->description}}</textarea>
            <div style="font-weight: 700; color:red">{{$errors->first('desc')}}</div>
        </div>
    </div>

    <div class="form-row justify-content-center mb-4">
        <div class="col-md-8 justify-content-center">
            <table class="table table-bordered table-striped" id="user_table">
                <thead>
                    <tr>
                        <th width="35%">Unit Sku</th>
                        <th width="35%">Quantity</th>
                        <th width="30%">Action</th>
                    </tr>
                </thead>
                <tbody class="form_inventory">

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" align="right">&nbsp;</td>
                        <td>

                        </td>
                    </tr>
                </tfoot>
            </table>
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
            html += '<td><select name="items[]" class="form-control form-control-sm select_skus"'
            html += '@if (count($kits) > 0) <optgroup label="Kits">@foreach ($kits as $kit)<option value="{{$kit->id}}">{{$kit->sku . ' - ' . $kit->kit_name}}</option>@endforeach </optgroup> @endif '
            html += '@if (count($units) > 0) <optgroup label="Units">@foreach ($units as $unit)<option value="{{$unit->id}}">{{$unit->sku . ' - ' . $unit->unit_name}}</option>@endforeach </optgroup> @endif '
            html += '</select></td>';
            html += '<td><input type="text" name="item_qty[]" class="form-control" /></td>';
            if(number > 1)
            {
                html += '<td><button type="button" name="remove" id="" class="btn btn-link text-danger remove">Remove</button></td></tr>';
                
                $('.form_inventory').append(html);
            }
            else
            {   
                html += '<td>@csrf <a onclick="history.back()" class="btn btn-link text-frenchblue" ><i class="fas fa-long-arrow-alt-left"></i> Go Back</a>\
                        <input type="submit" name="save" id="save" class="btn btn-primary bg-denim btn-sm" value="Submit"></td></tr>';
                
                $('.form_inventory').html(html);
            }
            $('.select_skus').select2().val({!! json_encode($case->basic_units()->allRelatedIds() ) !!}).trigger('change');
            $('.select_skus').select2({
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


        $('#editcase').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:'/updatecase/{{$case->id}}',
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

