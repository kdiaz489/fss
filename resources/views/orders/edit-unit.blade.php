@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h1 class="display-4 text-center mb-4">Edit your Unit</h1>
    
    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

        <form action="/updatebasicunit/{{$basic_unit->id}}" method="POST">
        {{method_field('PUT')}} 
            <div class="form-row justify-content-center mb-3">

                <div class="col-md-6">
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

            <div class="form-row justify-content-center">
                <a onclick="history.back()" class="btn btn-link text-frenchblue" style="margin-right:2%"><i class="fas fa-long-arrow-alt-left"></i> Go Back</a>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
            @csrf
        </form>

</div>


@endsection
