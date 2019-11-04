@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

    <h1 class="display-4 text-center">Create Unit</h1>

    
        <form action="/basicunit" method="POST">
            <div class="form-row justify-content-center mb-3">
                

                <div class="col-md-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control form-control-sm" value="{{ old('name')}}" placeholder="Name">
                    <div style="font-weight: 700; color:red">{{$errors->first('name')}}</div>
                </div>
                <div class="col-md-3">
                    <label for="sku">Sku</label>
                    <input type="text" name="sku" class="form-control form-control-sm" value="{{ old('sku')}}" placeholder="Sku #">
                    <div style="font-weight: 700; color:red">{{$errors->first('sku')}}</div>
                </div>

            </div>

            <div class="form-row justify-content-center mb-3">
                <div class="col-md-6">
                    <label for="desc">Description</label>
                    <textarea name="desc" id="desc" cols="30" rows="3" class="form-control form-control-sm" value="{{ old('desc')}}" placeholder="Product Description"></textarea>
                    
                    

                </div>
            </div>

            <div class="form-row justify-content-center mb-3">

                <div class="col-md-3">
                    <label for="price">Value</label>
                    <input type="text" name="price" class="form-control form-control-sm" value="{{ old('price')}}" placeholder="$ USD">

                </div>

                <div class="col-md-3">
                    <label for="weight">Weight</label>
                    <input type="text" name="weight" class="form-control form-control-sm" value="{{ old('weight')}}" placeholder="Weight in lbs">
                </div>
            </div>
            <div class="form-row justify-content-center">
                <a onclick="history.back()" class="btn btn-link text-frenchblue" style="margin-right:2%"><i class="fas fa-long-arrow-alt-left"></i> Go Back</a>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
            @csrf
        </form>
  
</div>

@endsection