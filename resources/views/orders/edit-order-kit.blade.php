@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h1 class="display-4 text-center mb-4">Edit your Kit</h1>
    
    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

    <form action="/updateorder/kit/{{$order->id}}" method="POST">
    {{method_field('PUT')}}
    <div class="form-row justify-content-center mb-4">
        <div class="col-md-3">
            <label for="transin_kit_name">Order Name</label>
            <input type="text" name="transin_kit_name" value="{{$order->name}}" class="form-control" placeholder="Name">
        </div>

        <div class="col-md-3">
            <label for="transin_kit_qty">Kit Quantity</label>
            <input type="text" name="transin_kit_qty" value="{{$order->kit_qty}}" class="form-control" placeholder="Quantity">
        </div>

        <div class="col-md-3">
            <label for="transin_kit_barcode">Barcode</label>
            <input type="text" name="transin_kit_barcode" value="{{$order->barcode}}" class="form-control" placeholder="Barcode">
        </div>
    </div>

    <div class="form-row justify-content-center mb-4">
        <div class="col-md-3">
            <label for="transin_kit_desc">Description</label>
            <textarea name="transin_kit_desc" value="" id="" cols="30" rows="1" class="form-control" placeholder="Description Here">{{$order->description}}</textarea>

        </div>


        <div class="col-md-3">
            <label for="transin_kit_unit_qty">Unit Quantity</label>
            <input type="text" name="transin_kit_unit_qty" value="{{$order->unit_qty}}" class="form-control" placeholder="Units Qty">
        </div>
    </div>


    <div class="form-row justify-content-center mb-4">
        <div class="col-md-9 justify-content-center">

            <label>Select Skus</label>
            <br>
            <select name="kits[]" class="form-control form-control-sm select_kit_skus" multiple="multiple" placeholder="Click to Select Kits">
                @if (count($kits) > 0)
                    @foreach ($kits as $kit)
                        <option value="{{$kit->id}}">{{'Kit Sku: ' . $kit->kit_sku . ' - ' . 'Kit Name: ' . $kit->kit_name}}</option>
                    @endforeach
                @else
                    <option value="" disabled>No Kits Available</option>
                @endif
            </select>
        </div>
    </div>
    <div class="form-row justify-content-center mb-5">
        <a href="/dashboard#inventoryrequests" class="btn btn-link text-frenchblue" style="margin-right:2%"><i class="fas fa-long-arrow-alt-left"></i> Go Back</a>
        <button type="submit" class="btn btn-primary">Create</button>
    </div>
    @csrf
    </form>

</div>
<script>
$('.select_kit_skus').select2().val({!! json_encode($order->kits()->allRelatedIds() ) !!}).trigger('change');
</script>

@endsection