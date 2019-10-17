@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h1 class="display-4 text-center mb-4">Create your Kit</h1>
    
    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

    <form action="/createkit" method="POST">
    
    <div class="form-row justify-content-center mb-4">
        <div class="col-md-3">
            <label for="kit_name">Kit Name</label>
            <input type="text" name="kit_name" class="form-control form-control-sm" value="{{ old('kit_name')}}" placeholder="Name">
            <div style="font-weight: 700; color:red">{{$errors->first('kit_name')}}</div>
        </div>

        <div class="col-md-3">
            <label for="kit_price">Price</label>
            <input type="text" name="kit_price" class="form-control form-control-sm" value="{{ old('kit_orice')}}" placeholder="$ USD">
            <div style="font-weight: 700; color:red">{{$errors->first('kit_price')}}</div>
        </div>

        <div class="col-md-3">
            <label for="kit_sku">Kit Sku</label>
            <input type="text" name="kit_sku" class="form-control form-control-sm" value="{{ old('kit_sku')}}" placeholder="Sku #">
            <div style="font-weight: 700; color:red">{{$errors->first('kit_sku')}}</div>
        </div>
    </div>

    <div class="form-row justify-content-center mb-4">
        <div class="col-md-9">
            <label for="kit_desc">Description</label>
            <textarea name="kit_desc" id="" cols="30" rows="3" class="form-control form-control-sm" placeholder="Description Here">{{ old('kit_desc')}}</textarea>
            <div style="font-weight: 700; color:red">{{$errors->first('kit_desc')}}</div>
        </div>
    </div>

    <div class="form-row justify-content-center mb-4">
        <div class="col-md-9 justify-content-center">

            <label>Select Skus</label>
            <br>
            <select name="units[]" class="form-control form-control-sm select_kit_skus" multiple="multiple" placeholder="Click to Select Skus">
                @if (count($basic_units) > 0)
                    @foreach ($basic_units as $unit)
                        <option value="{{$unit->id}}">{{$unit->sku . ' - ' . $unit->unit_name}}</option>
                    @endforeach
                @else
                    <option value="" disabled>No Skus Available</option>
                @endif
            </select>
            <div style="font-weight: 700; color:red">{{$errors->first('units[]')}}</div>
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

<script></script>