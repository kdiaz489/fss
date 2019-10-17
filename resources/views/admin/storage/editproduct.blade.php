@extends('layouts.app')

@section('content')


<div class="container mt-5">
    <h1 class="text-center display-4">Edit Product Details</h1>
    <form action=" /stor/product/update/{{$product->id}}" class="container-border-radius mt-3" method="POST">
        @csrf
        {{method_field('PUT')}}

        <div class="form-row justify-content-md-center mt-3">
            <div class="col-md-4">
                <label for="pro_no">PRO Number</label>
                <input type="text" class="form-control form-control-sm" name="pro_no" value="{{$product->pro_no}}">
            </div>

            <div class="col-md-4">
                <label for="pu_no">PU Number</label>
                <input type="text" class="form-control form-control-sm" name="pu_no" value="{{$product->pu_no}}">
            </div>



        </div>

        <div class="form-row justify-content-md-center mt-3">

            <div class="col-md-4">
                <label for="po_no">PO Number</label>
                <input type="text" class="form-control form-control-sm" name="po_no" value="{{$product->po_no}}">
            </div>

            <div class="col-md-4">
                <label for="sku">SKU</label>
                <input type="text" class="form-control form-control-sm" name="sku" value="{{$product->sku}}">
            </div>

        </div>

        <div class="form-row justify-content-md-center mt-3">
            <div class="col-md-4">
                <label for="description">Description</label>
                <input type="text" class="form-control form-control-sm" name="description"
                    value="{{$product->description}}">
            </div>
            <div class="col-md-4">
                <label for="barcode">Barcode</label>
                <input type="text" class="form-control form-control-sm" name="barcode"
                    value="{{$product->barcode}}">
            </div>
        </div>

        <div class="form-row justify-content-md-center mt-3">
            <div class="col-md-4">
                <label for="carton_qty">Carton Quantity</label>
                <input type="text" class="form-control form-control-sm" name="carton_qty"
                    value="{{$product->carton_qty}}">
            </div>

            <div class="col-md-4">
                <label for="">Case Quantity</label>
                <input type="text" class="form-control form-control-sm" name="case_qty" value="{{$product->case_qty}}">
            </div>

        </div>

        <div class="form-row justify-content-md-center mt-3">
            <div class="col-md-4">
                <label for="item_qty">Item Quantity</label>
                <input type="text" class="form-control form-control-sm" name="item_qty" value="{{$product->item_qty}}">
            </div>

            <div class="col-md-4">
                <label for="building">Building</label>
                <input type="text" class="form-control form-control-sm" name="building" value="{{$product->building}}">
            </div>

        </div>

        <div class="form-row justify-content-md-center mt-3">
            <div class="col-md-4">
                <label for="row_">Row</label>
                <input type="text" class="form-control form-control-sm" name="row_" value="{{$product->row_}}">
            </div>

            <div class="col-md-4">
                <label for="col_">Column</label>
                <input type="text" class="form-control form-control-sm" name="col_" value="{{$product->col_}}">
            </div>

        </div>

        <div class="form-row justify-content-center mt-3 mb-3">
            <button type="submit" class="btn btn-primary bg-denim">Update</button>
        </div>

    </form>
</div>

@endsection