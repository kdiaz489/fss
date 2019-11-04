@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h1 class="display-4 text-center mb-4">Submit Order - Transfer Out Cases</h1>
    
    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

                    <div class="container w-75">
                            <form id="trans_out_case_form" action="/transoutcase" method="POST">
                                <div class="form-row justify-content-center">
                                    <div class="col-md-12">
                                        <span class="" id="result"></span>
                                    </div>
                                </div>
                                
                                <div class="form-row mb-4">
                                    <div class="col-md-8">
                                        <a onclick="history.back()" class="btn btn-link text-frenchblue px-0" style="margin-right:2%"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                                    </div>
                                </div>

                                <div class="form-row justify-content-center mb-4">
                                    <div class="col-md-6">
                                        <label for="case_name">Order Name</label>
                                        <input type="text" name="case_name" class="form-control" placeholder="Name">
                                        <div style="font-weight: 700; color:red">{{$errors->first('case_name')}}</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="barcode">Barcode</label>
                                        <input type="text" name="barcode" class="form-control" placeholder="Barcode">
                                        <div style="font-weight: 700; color:red">{{$errors->first('barcode')}}</div>
                                    </div>
                                </div>

                                <div class="form-row justify-content-center mb-4">
                                    <div class="col-md-12">
                                        <label for="desc">Description</label>
                                        <textarea name="desc" id="" cols="30" rows="3" class="form-control" placeholder="Description Here"></textarea>
                                        <div style="font-weight: 700; color:red">{{$errors->first('desc')}}</div>

                                    </div>

                                    <input type="hidden" name="order_type" value="Transfer Out Cases">

                                </div>

                                <table class="table table-bordered table-striped" id="user_table">
                                    <thead>
                                        <tr>
                                            <th width="35%">Case Sku</th>
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
                                                @csrf
                                                <input type="submit" name="save" id="save" class="btn btn-link text-denim btn-sm" value="Submit">
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>
                        
                    </div>

</div>


<script>
    
    $(document).ready(function(){
        var count = 1;
        dynamic_field(count);

    /*
        function dynamic_field(number){
            html = '<tr>';
            html += '<td><select name="cases[]" class="form-control form-control-sm select_kit_skus" multiple="multiple" placeholder="Click to Select Kits">'
            html += '@if (count($cases) > 0) @foreach ($cases as $case)<option value="{{$case->id}}">{{$case->sku . ' - ' . $case->case_name}}</option>@endforeach @else<option value="" disabled>No Cases Available</option> @endif </select>'
            html += '</td>';
            html += '<td><input type="text" name="case_qty[]" class="form-control" value="" /></td>';
            if(number > 1)
            {
                html += '<td><button type="button" name="remove" id="" class="btn btn-link text-danger remove">Remove</button></td></tr>';
                
                $('.form_inventory').append(html);
            }
            else
            {   
                html += '<td>@csrf\
                        <a onclick="history.back()" class="btn btn-link text-frenchblue" style="margin-right:2%"><i class="fas fa-long-arrow-alt-left"></i> Back</a>\
                        <input type="submit" name="save" id="save" class="btn btn-link text-denim btn-sm" value="Submit"></td></tr>';
                $('.form_inventory').html(html);
            }
            $('.select_kit_skus').select2({
                placeholder: 'Click to select',
                maximumSelectionLength: 1
            });
        }

        */


        function dynamic_field(number){
            html = '<tr>';
            html += '<td><select name="cases[]" class="form-control form-control-sm select_skus">'
            html += '@if (count($cases) > 0) @foreach ($cases as $case)<option value="{{$case->id}}">{{$case->sku . ' - ' . $case->case_name}}</option>@endforeach @else<option value="" disabled>No Cases Available</option> @endif </select>'
            html += '</td>';
            html += '<td><input type="text" name="case_qty[]" class="form-control" /></td>';
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

        
        $('#trans_out_case_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:'/transoutcase',
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
                            /*
                            var error_html = '';
                            for(var count = 0; count < data.error.length; count++)
                            {
                                error_html += '<p>'+data.error[count]+'</p>';
                            }
                            */
                            $('#result').html('<div class="alert alert-danger text-center">'+data.error+'</div>');
                        }
                        else
                        {
                            dynamic_field(1);
                            $('#result').html('<div class="alert alert-success text-center">'+data.success+'</div>');

                        }
                        $('#save').attr('disabled', false);
                    }
                })
            }); 
            
        });

</script>

@endsection

