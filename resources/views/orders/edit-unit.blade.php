@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h1 class="display-4 text-center mb-4">Edit your Kit</h1>
    
    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

        <form action="/updatebasicunit/{{$basic_unit->id}}" method="POST">
        {{method_field('PUT')}} 
            <div class="form-row justify-content-center mb-3">

                <div class="col-md-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control form-control-sm" value="{{$basic_unit->unit_name}}" placeholder="Name">
                    <div style="font-weight: 700; color:red">{{$errors->first('name')}}</div>
                </div>
                <div class="col-md-3">
                    <label for="sku">Sku</label>
                    <input type="text" name="sku" class="form-control form-control-sm" value="{{$basic_unit->sku}}" placeholder="Sku #">
                    <div style="font-weight: 700; color:red">{{$errors->first('sku')}}</div>
                </div>

            </div>

            <div class="form-row justify-content-center mb-3">
                <div class="col-md-6">
                    <label for="desc">Description</label>
                    <textarea name="desc" id="desc" cols="30" rows="3" class="form-control form-control-sm" placeholder="Product Description">{{$basic_unit->description}}</textarea>
                    
                    

                </div>
            </div>

            <div class="form-row justify-content-center mb-3">

                <div class="col-md-3">
                    <label for="price">Price</label>
                    <input type="text" name="price" class="form-control form-control-sm" value="{{$basic_unit->price}}" placeholder="$ USD">

                </div>

                <div class="col-md-3">
                    <label for="weight">Weight</label>
                    <input type="text" name="weight" class="form-control form-control-sm" value="{{$basic_unit->weight}}" placeholder="Weight in lbs">
                </div>
            </div>
            <div class="form-row justify-content-center">
                <a href="/dashboard#inventoryrequests" class="btn btn-link text-frenchblue" style="margin-right:2%"><i class="fas fa-long-arrow-alt-left"></i> Go Back</a>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
            @csrf
        </form>

</div>


@endsection
