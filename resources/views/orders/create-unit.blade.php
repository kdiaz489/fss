@extends('layouts.userdashlte')

@section('user-name')
{{auth()->user()->name}}
@endsection

@section('content')

<div class="container mt-5">
    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

    <h1 class="display-4 text-center">Create Unit</h1>


    <form action="/basicunit" method="POST">
        <div class="form-row justify-content-center mb-3">

            <div class="col-md-6">
                <label for="sku">Sku</label>
                <input type="text" name="sku" class="form-control form-control-sm" value="{{ old('sku')}}"
                    placeholder="Sku #">
                <div style="font-weight: 700; color:red">{{$errors->first('sku')}}</div>
            </div>

        </div>

        <div class="form-row justify-content-center mb-3">
            <div class="col-md-6">
                <label for="desc">Description</label>
                <textarea name="desc" id="desc" cols="30" rows="3" class="form-control form-control-sm"
                    value="{{ old('desc')}}" placeholder="Product Description"></textarea>
                <div style="font-weight: 700; color:red">{{$errors->first('desc')}}</div>

            </div>
        </div>

        <div class="form-row justify-content-center">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
        @csrf
    </form>

</div>

@endsection