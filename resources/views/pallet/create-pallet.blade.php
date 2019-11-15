

    <form action="/createpallet" id="createpallet" method="POST">
    <div class="form-row justify-content-center">
        <div class="col-md-10">
            <span class="text-center" id="result"></span>
        </div>
    </div>

    
    <div class="form-row justify-content-center mb-4">

        <div class="col-md-10">
            <label for="sku">Pallet Sku</label>
            <input type="text" name="sku" class="form-control form-control-sm"  placeholder="Sku #">
            <div style="font-weight: 700; color:red">{{$errors->first('sku')}}</div>
        </div>

    </div>

    <div class="form-row justify-content-center mb-4">
        <div class="col-md-10">
            <label for="desc">Description</label>
            <textarea name="desc" id="" cols="30" rows="3" class="form-control form-control-sm" placeholder="Description Here"></textarea>
            <div style="font-weight: 700; color:red">{{$errors->first('desc')}}</div>
        </div>
    </div>

    <div class="form-row justify-content-center mb-4">
        <div class="col-md-10 justify-content-center">
            <div class="table-responsive">
            <table class="table table-bordered table-striped" id="user_table">
                <thead>
                    <tr>
                        <th width="20%">Select Pallet Items</th>
                        <th width="20%">Item Type</th>
                        <th width="20%">Quantity</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody class="form_pallet">

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
    </div>

    </form>

</div>

<script>
    $(document).ready(function(){
        var pallet_item_count = 1;
        dynamic_pallet_field(pallet_item_count);

        function dynamic_pallet_field(number){
            html = '<tr>';
            html += '<td><select name="items[]" class="form-control form-control-sm select_pallet_skus">'
            html += '<option value="none" disabled selected>Choose</option>'
            html += '@if (count($cartons) > 0) <optgroup label="Cartons"> @foreach ($cartons as $carton) <option value="{{$carton->id}}">{{$carton->sku}}</option> @endforeach</optgroup> @else<option value="" disabled>No Cartons Available</option> @endif '
            html += '@if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case) <option value="{{$case->id}}">{{$case->sku}}</option> @endforeach</optgroup> @else<option value="" disabled>No Cases Available</option> @endif '
            html += '@if (count($units) > 0) <optgroup label="Kits"> @foreach ($kits as $kit) <option value="{{$kit->id}}">{{$kit->sku}}</option>@endforeach</optgroup> @else<option value="" disabled>No Kits Available</option> @endif '
            html += '@if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit) <option value="{{$unit->id}}">{{$unit->sku}}</option>@endforeach</optgroup> @else<option value="" disabled>No Units Available</option> @endif '
            html += '</select></td>'
            html += '<td><select name="type[]" id="" class="form-control form-control-sm pallet-item-type"><option value="none" disabled selected>Choose</option><option value="Carton">Carton</option><option value="Case">Case</option><option value="Kit">Kit</option><option value="Unit">Unit</option></select></td>'
            html += '<td><input type="text" name="item_qty[]" class="form-control" /></td>';
            if(number > 1)
            {
               
                html += '<td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove-pallet-row circle"><i class="fas fa-lg fa-minus"></i></button>\
                        <button type="button" name="add" id="" class="btn btn-success btn-sm add-pallet-row circle"><i class="fas fa-lg fa-plus"></i></button></td></tr>';
                
                $('.form_pallet').append(html);
            }
            else
            {   
                html += '<td>\
                        <button type="button" name="remove" id="" class="btn btn-danger btn-sm remove-pallet-row circle"><i class="fas fa-lg fa-minus"></i></button>\
                        <button type="button" name="add" id="" class="btn btn-success btn-sm add-pallet-row circle"><i class="fas fa-lg fa-plus"></i></button>\
                        </td></tr>';
                $('.form_pallet').append(html);
            }
            $('.select_pallet_skus').select2({
                
                minimumResultsForSearch: 1,
                width: '155px'
            });

            $('.pallet-item-type').select2({
                placeholder: 'Click to select cases',
                minimumResultsForSearch: 1,
                width: '175px'
            });
        }


        $('.modal').on( 'change', '.select_pallet_skus', function(){
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

        $('.modal').on('click','.add-pallet-row',function(){
        pallet_item_count++;
        dynamic_pallet_field(pallet_item_count);
        });

        $('.modal').on('click', '.remove-pallet-row', function(){

        const table = document.getElementsByClassName('form_pallet');
        const rownum = table[0].getElementsByTagName('TR').length;
        
        if(rownum != 1){
            pallet_item_count--;
            $(this).closest("tr").remove();
        }
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
                            html = '<tr>';
                            html += '<td><select name="items[]" class="form-control form-control-sm select_transin_skus">'
                            html += '<option value="' + data.id + '" selected>' + data.sku + '</option>'
                            html += '</select></td>'
                            html += '<td><select name="type[]" id="" class="form-control form-control-sm type"><option value="none" disabled selected>Choose</option><option value="Pallet" selected>Pallet</option><option value="Carton">Carton</option><option value="Case">Case</option><option value="Kit">Kit</option><option value="Unit">Unit</option></select></td>'
                            html += '<td><input type="text" name="item_qty[]" class="form-control" /></td>';
                            html += '<td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove circle"><i class="fas fa-lg fa-minus"></i></button>\
                            <button type="button" name="add" id="" class="btn btn-success btn-sm add circle"><i class="fas fa-lg fa-plus"></i></button>\
                            <button type="button" name="editpallet" id="' + data.id + '" class="btn btn-secondary btn-sm editpallet circle"><i class="fas fa-edit fa-lg"></i></button></td></tr>';

                            $('.type').select2({
                                placeholder: 'Click to select cases',
                                minimumResultsForSearch: 1,
                                width: '175px'
                            });

                            $('.form_inventory').append(html);  
                            $('#result').html('<div class="alert alert-success">'+data.success+'</div>');

                        }
                        $('#save').attr('disabled', false);
                    }
                })
            });
        });

</script>


