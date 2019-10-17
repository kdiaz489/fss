@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h1 class="display-4 text-center mb-4">Edit your Unit</h1>
    
    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

    <form action="/updateorder/unit/{{$order->id}}" method="POST">
    {{method_field('PUT')}}
    <div class="form-row justify-content-center mb-4">
        <div class="col-md-3">
            <label for="transin_unit_name">Order Name</label>
            <input type="text" name="transin_unit_name" value="{{$order->name}}" class="form-control" placeholder="Name">
            <div style="font-weight: 700; color:red">{{$errors->first('transin_unit_name')}}</div>
        </div>

        <div class="col-md-3">
            <label for="transin_unit_barcode">Barcode</label>
            <input type="text" name="transin_unit_barcode" value="{{$order->barcode}}" class="form-control" placeholder="Barcode">
            <div style="font-weight: 700; color:red">{{$errors->first('transin_unit_barcode')}}</div>
        </div>
    </div>

    <div class="form-row justify-content-center mb-4">
        <div class="col-md-3">
            <label for="transin_unit_desc">Description</label>
            <textarea name="transin_unit_desc" value="" id="" cols="30" rows="1" class="form-control" placeholder="Description Here">{{$order->description}}</textarea>
            <div style="font-weight: 700; color:red">{{$errors->first('transin_unit_desc')}}</div>

        </div>


        <div class="col-md-3">
            <label for="transin_unit_unit_qty">Unit Quantity</label>
            <input type="text" name="transin_unit_qty" value="{{$order->unit_qty}}" class="form-control" placeholder="Units Qty">
            <div style="font-weight: 700; color:red">{{$errors->first('transin_unit_qty')}}</div>
        </div>
    </div>


    <div class="form-row justify-content-center mb-4">
        <div class="col-md-6 justify-content-center">

            <label>Select Skus</label>
            <br>
            <select name="units[]" class="form-control form-control-sm select_kit_skus" multiple="multiple" placeholder="Click to Select Kits">
                @if (count($units) > 0)
                    @foreach ($units as $unit)
                        <option value="{{$unit->id}}">{{'SKU: ' . $unit->sku . ' - ' . 'Unit Name: ' . $unit->unit_name}}</option>
                    @endforeach
                @else
                    <option value="" disabled>No Units Available</option>
                @endif
            </select>
        </div>
    </div>
    <div style="font-weight: 700; color:red">{{$errors->first('units')}}</div>
    <div class="form-row justify-content-center mb-5">
        <a href="/dashboard#inventoryrequests" class="btn btn-link text-frenchblue" style="margin-right:2%"><i class="fas fa-long-arrow-alt-left"></i> Go Back</a>
        <button type="submit" class="btn btn-primary">Create</button>
    </div>
    @csrf
    </form>

</div>
<script>
$('.select_kit_skus').select2().val({!! json_encode($order->basic_units()->allRelatedIds() ) !!}).trigger('change');
</script>

@endsection