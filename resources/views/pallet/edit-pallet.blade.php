

    <form action="/editpallet/{{$pallet->id}}" id="editpallet" method="POST">
    {{method_field('PUT')}}
    <div class="form-row justify-content-center">
        <div class="col-md-11">
            <span class="text-center" id="result"></span>
        </div>
        
    </div>

    <div class="form-row justify-content-center mb-4">

        <div class="col-md-11">
            <label for="sku">Pallet Sku</label>
            <input type="text" name="sku" class="form-control form-control-sm" value="{{$pallet->sku}}" placeholder="Sku #">
            <div style="font-weight: 700; color:red">{{$errors->first('sku')}}</div>
        </div>
    </div>

    <div class="form-row justify-content-center mb-4">
        <div class="col-md-11">
            <label for="desc">Description</label>
            <textarea name="desc" id="" cols="30" rows="3" class="form-control form-control-sm" placeholder="Description Here">{{$pallet->description}}</textarea>
            <div style="font-weight: 700; color:red">{{$errors->first('desc')}}</div>
        </div>
    </div>

    <div class="form-row justify-content-center mb-4">
        <div class="col-md-11 justify-content-center">
            <div class="table-responsive">
            <table class="table table-bordered table-striped" id="user_table">
                <thead>
                    <tr>
                        <th width="25%">Item Sku</th>
                        <th width="25%">Type</th>
                        <th width="20%">Quantity</th>
                        <th width="30%"></th>
                        
                    </tr>
                </thead>
                <tbody class="form_pallet">
                    
                        @if ($pallet->cartons->all())
                            @foreach ($pallet->cartons->all() as $pallet_carton)
                                <tr>
                                <td><select name="items[]" class= "form-control select_pallet_skus">
                                @if (count($cartons) > 0) <optgroup label="Cartons"> @foreach ($cartons as $carton) @if ($pallet_carton->id == $carton->id) <option value="{{$carton->id}}" selected>{{$carton->sku}}</option> @else <option value="{{$carton->id}}">{{$carton->sku}}</option> @endif @endforeach </optgroup> @else<option value="" disabled>No Cartons Available</option> @endif 
                                @if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case)<option value="{{$case->id}}">{{$case->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Cases Available</option> @endif 
                                @if (count($kits) > 0) <optgroup label="Kits"> @foreach ($kits as $kit)<option value="{{$kit->id}}">{{$kit->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Kits Available</option> @endif
                                @if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit)<option value="{{$unit->id}}">{{$unit->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Units Available</option> @endif 
                                </select></td>
                                <td> <select type="text" name="type[]" class="form-control form-control-sm pallet-item-type" placeholder="Item Type"><option value="n/a" disabled>Choose</option><option value="Carton" selected>Carton</option><option value="Case">Case</option><option value="Kit">Kit</option><option value="Unit">Unit</option><option value="Case">Case</option></select></td>
                                <td><input type="text" name="item_qty[]" class="form-control form-control-sm" placeholder="Item Quantity" value="{{$pallet_carton->pivot->quantity}}" /></td>
                                <td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove-pallet-row circle"><i class="fas fa-lg fa-minus"></i></button>
                                    <button type="button" name="add" id="" class="btn btn-success btn-sm add-pallet-row circle"><i class="fas fa-lg fa-plus"></i></button></td></tr>
                            @endforeach
                        @endif

                        @if ($pallet->cases->all())
                            @foreach ($pallet->cases->all() as $pallet_case)
                                <tr>
                                <td><select name="items[]" class= "form-control select_pallet_skus">
                                @if (count($cartons) > 0) <optgroup label="Cartons"> @foreach ($cartons as $carton)<option value="{{$carton->id}}">{{$carton->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Cartons Available</option> @endif
                                @if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case) @if ($pallet_case->id == $case->id) <option value="{{$case->id}}" selected>{{$case->sku}}</option> @else <option value="{{$case->id}}">{{$case->sku}}</option> @endif @endforeach </optgroup> @else<option value="" disabled>No Cases Available</option> @endif 
                                @if (count($kits) > 0) <optgroup label="Kits"> @foreach ($kits as $kit)<option value="{{$kit->id}}">{{$kit->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Kits Available</option> @endif
                                @if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit)<option value="{{$unit->id}}">{{$unit->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Units Available</option> @endif 
                                </select></td>
                                <td> <select type="text" name="type[]" class="form-control form-control-sm pallet-item-type" placeholder="Item Type"><option value="n/a">Choose</option><option value="Carton">Carton</option><option value="Case" selected>Case</option><option value="Kit">Kit</option><option value="Unit">Unit</option><option value="Case">Case</option></select></td>
                                <td><input type="text" name="item_qty[]" class="form-control form-control-sm" placeholder="Item Quantity" value="{{$pallet_case->pivot->quantity}}" /></td>
                                <td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove-pallet-row circle"><i class="fas fa-lg fa-minus"></i></button>
                                    <button type="button" name="add" id="" class="btn btn-success btn-sm add-pallet-row circle"><i class="fas fa-lg fa-plus"></i></button></td></tr>
                            @endforeach
                        @endif


                        @if ($pallet->kits->all())
                            @foreach ($pallet->kits->all() as $pallet_kit)
                                <tr>
                                <td><select name="items[]" class= "form-control select_pallet_skus">
                                @if (count($cartons) > 0) <optgroup label="Cartons"> @foreach ($cartons as $carton)<option value="{{$carton->id}}">{{$carton->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Cartons Available</option> @endif
                                @if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case)<option value="{{$case->id}}">{{$case->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Cases Available</option> @endif
                                @if (count($kits) > 0) <optgroup label="Kits"> @foreach ($kits as $kit) @if ($pallet_kit->id == $kit->id) <option value="{{$kit->id}}" selected>{{$kit->sku}}</option> @else <option value="{{$kit->id}}">{{$kit->sku}}</option> @endif @endforeach </optgroup> @else<option value="" disabled>No Kits Available</option> @endif 
                                @if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit)<option value="{{$unit->id}}">{{$unit->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Units Available</option> @endif 
                                </select></td>
                                <td> <select type="text" name="type[]" class="form-control form-control-sm pallet-item-type" placeholder="Item Type"><option value="n/a" disabled>Choose</option><option value="Carton">Carton</option><option value="Case">Case</option><option value="Kit" selected>Kit</option><option value="Unit">Unit</option><option value="Case">Case</option></select></td>
                                <td><input type="text" name="item_qty[]" class="form-control form-control-sm" placeholder="Item Quantity" value="{{$pallet_kit->pivot->quantity}}" /></td>
                                <td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove-pallet-row circle"><i class="fas fa-lg fa-minus"></i></button>
                                    <button type="button" name="add" id="" class="btn btn-success btn-sm add-pallet-row circle"><i class="fas fa-lg fa-plus"></i></button></td></tr>
                            @endforeach
                        @endif


                        @if ($pallet->basic_units->all())
                            @foreach ($pallet->basic_units->all() as $pallet_unit)
                                <tr>
                                <td><select name="items[]" class= "form-control select_pallet_skus">
                                @if (count($cartons) > 0) <optgroup label="Cartons"> @foreach ($cartons as $carton)<option value="{{$carton->id}}">{{$carton->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Cartons Available</option> @endif
                                @if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case)<option value="{{$case->id}}">{{$case->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Cases Available</option> @endif
                                @if (count($kits) > 0) <optgroup label="Kits"> @foreach ($kits as $kit)<option value="{{$kit->id}}">{{$kit->sku}}</option>@endforeach </optgroup> @else<option value="" disabled>No Kits Available</option> @endif
                                @if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit) @if ($pallet_unit->id == $unit->id) <option value="{{$unit->id}}" selected>{{$unit->sku}}</option> @else <option value="{{$unit->id}}">{{$unit->sku}}</option> @endif @endforeach </optgroup> @else<option value="" disabled>No Units Available</option> @endif 
                                 
                                </select></td>
                                <td> <select type="text" name="type[]" class="form-control form-control-sm pallet-item-type" placeholder="Item Type"><option value="n/a" disabled>Choose</option><option value="Carton">Carton</option><option value="Case">Case</option><option value="Kit">Kit</option><option value="Unit" selected>Unit</option><option value="Case">Case</option></select></td>
                                <td><input type="text" name="item_qty[]" class="form-control form-control-sm" placeholder="Item Quantity" value="{{$pallet_unit->pivot->quantity}}" /></td>
                                <td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove-pallet-row circle"><i class="fas fa-lg fa-minus"></i></button>
                                    <button type="button" name="add" id="" class="btn btn-success btn-sm add-pallet-row circle"><i class="fas fa-lg fa-plus"></i></button></td></tr>
                            @endforeach
                        @endif
                        
                   
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

        $('.select_pallet_skus').select2({
            minimumResultsForSearch: 1,
            width: '155px'
        });

        $('.pallet-item-type').select2({
            minimumResultsForSearch: 1,
            width: '155px'
        });

        $('#result').html();
        var pallet_item_count = 0;

        function dynamic_pallet_field(number){
            html = '<tr>';
            html += '<td><select name="items[]" class="form-control form-control-sm select_pallet_skus">'
            html += '<option value="none" disabled selected>Choose</option>'
            html += '@if (count($cartons) > 0) <optgroup label="Cartons"> @foreach ($cartons as $carton) <option value="{{$carton->id}}">{{$carton->sku}}</option> </optgroup>@endforeach @else<option value="" disabled>No Cartons Available</option> @endif '
            html += '@if (count($cases) > 0) <optgroup label="Cases"> @foreach ($cases as $case) <option value="{{$case->id}}">{{$case->sku}}</option> </optgroup>@endforeach @else<option value="" disabled>No Cases Available</option> @endif '
            html += '@if (count($units) > 0) <optgroup label="Kits"> @foreach ($kits as $kit) <option value="{{$kit->id}}">{{$kit->sku}}</option></optgroup>@endforeach @else<option value="" disabled>No Kits Available</option> @endif '
            html += '@if (count($units) > 0) <optgroup label="Units"> @foreach ($units as $unit) <option value="{{$unit->id}}">{{$unit->sku}}</option></optgroup>@endforeach @else<option value="" disabled>No Units Available</option> @endif '
            html += '</select></td>'
            html += '<td><select name="type[]" id="" class="form-control form-control-sm pallet-item-type"><option value="none" disabled selected>Choose</option><option value="Carton">Carton</option><option value="Case">Case</option><option value="Kit">Kit</option><option value="Unit">Unit</option></select></td>'
            html += '<td><input type="text" name="item_qty[]" class="form-control" /></td>';
            if(number >= 1)
            {
               
                html += '<td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove-edit-pallet-row circle"><i class="fas fa-lg fa-minus"></i></button>\
                        <button type="button" name="add" id="" class="btn btn-success btn-sm add-edit-pallet-row circle"><i class="fas fa-lg fa-plus"></i></button></td></tr>';
                
                $('.form_pallet').append(html);
            }
            
            $('.select_pallet_skus').select2({
                minimumResultsForSearch: 1,
                width: '155px'
            });

            $('.pallet-item-type').select2({
                minimumResultsForSearch: 1,
                width: '175px'
            });
        }

        $('.modal').on('change', '.select_pallet_skus', function(){
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

        $('.modal').on('click', '.add-edit-pallet-row', function(){
        pallet_item_count++;
        console.log(pallet_item_count);
        dynamic_pallet_field(pallet_item_count);
        });

        $('.modal').on('click', '.remove-edit-pallet-row', function(){
        const table = document.getElementsByClassName('form_pallet');
        const rownum = table[0].getElementsByTagName('TR').length;
        
        if(rownum != 1){
            pallet_item_count--;
            $(this).closest("tr").remove();
        }
        });


        $('#editpallet').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:'/updatepallet/{{$pallet->id}}',
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
                            
                            $('#result').html('<div class="alert alert-danger">'+data.error+'</div>');
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
