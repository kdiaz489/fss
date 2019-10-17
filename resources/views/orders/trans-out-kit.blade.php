@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h1 class="display-4 text-center mb-4">Submit Order - Transfer Out Kits</h1>
    
    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

    <form action="/transoutkit" method="POST">
    
    <div class="form-row justify-content-center mb-4">
        <div class="col-md-3">
            <label for="transout_kit_name">Order Name</label>
            <input type="text" name="transout_kit_name" class="form-control" placeholder="Name">
            <div style="font-weight: 700; color:red">{{$errors->first('transout_kit_name')}}</div>

        </div>

        <div class="col-md-3">
            <label for="transout_kit_qty">Kit Quantity</label>
            <input type="text" name="transout_kit_qty" class="form-control" placeholder="Quantity">
            <div style="font-weight: 700; color:red">{{$errors->first('transout_kit_name')}}</div>

        </div>

        <div class="col-md-3">
            <label for="transout_kit_unit_qty">Unit Quantity</label>
            <input type="text" name="transout_kit_unit_qty" class="form-control" placeholder="Units Qty">
            <div style="font-weight: 700; color:red">{{$errors->first('transout_kit_name')}}</div>

        </div>

    </div>

    <div class="form-row justify-content-center mb-4">
        <div class="col-md-3">
            <label for="transout_kit_desc">Description</label>
            <textarea name="transout_kit_desc" id="" cols="30" rows="1" class="form-control" placeholder="Description Here"></textarea>
            <div style="font-weight: 700; color:red">{{$errors->first('transout_kit_name')}}</div>


        </div>


        <div class="col-md-3">
            <label for="transout_kit_barcode">Barcode</label>
            <input type="text" name="transout_kit_barcode" class="form-control" placeholder="Barcode">
            <div style="font-weight: 700; color:red">{{$errors->first('transout_kit_name')}}</div>

        </div>

    </div>


    <div class="form-row justify-content-center mb-4">
        <div class="col-md-9 justify-content-center">

            <label>Select Skus</label>
            <br>
            <select name="kits[]" class="form-control form-control-sm select_kit_skus" multiple="multiple" placeholder="Click to Select Kits">
                @if (count($kits) > 0)
                    @foreach ($kits as $kit)
                        <option value="{{$kit->id}}">{{$kit->kit_sku . ' - ' . $kit->kit_name}}</option>
                    @endforeach
                @else
                    <option value="" disabled>No Kits Available</option>
                @endif
            </select>
            <div style="font-weight: 700; color:red">{{$errors->first('kits')}}</div>

        </div>
    </div>

    <div class="form-row justify-content-center mb-5">
        <a href="/dashboard#inventoryrequests" class="btn btn-link text-frenchblue" style="margin-right:2%"><i class="fas fa-long-arrow-alt-left"></i> Go Back</a>
        <button type="submit" class="btn btn-primary">Create</button>
    </div>

    @csrf
    </form>

</div>

@endsection
