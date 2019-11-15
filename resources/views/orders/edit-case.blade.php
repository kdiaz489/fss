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

        <div class="col-md-8">
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
                        <th width="20%">Select Skus</th>
                        <th width="20%">Item Type</th>
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
                        <a onclick="history.back()" class="btn btn-link text-frenchblue" ><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                        <input type="submit" name="save" id="save" class="btn btn-primary bg-denim btn-sm" value="Submit">
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
            html += '<td><select name="type[]" id="" class="form-control form-control-sm type"><option value="none" disabled selected>Choose</option><option value="Pallet">Pallet</option><option value="Carton">Carton</option><option value="Case">Case</option><option value="Kit">Kit</option><option value="Unit">Unit</option></select></td>'
            html += '<td><input type="text" name="item_qty[]" class="form-control" /></td>';
            if(number > 1)
            {
                html += '<td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove circle"><i class="fas fa-lg fa-minus"></i></button>\
                        <button type="button" name="add" id="" class="btn btn-success btn-sm  add circle"><i class="fas fa-lg fa-plus"></i></button></td></tr>';
                
                $('.form_inventory').append(html);
            }
            else
            {   
                html += '<td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove circle"><i class="fas fa-lg fa-minus"></i></button>\
                        <button type="button" name="add" id="" class="btn btn-success btn-sm  add circle"><i class="fas fa-lg fa-plus"></i></button></td></tr>';
                
                $('.form_inventory').html(html);
            }
            $('.select_skus').select2().val({!! json_encode($case->basic_units()->allRelatedIds() ) !!}).trigger('change');
            $('.select_skus').select2({
                placeholder: 'Click to select'
            });
        }



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

