@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:2%; width:30%">
    <h1 class="display-4 text-center">Add to Inventory</h1>
<form action="/stor/submitinventory" method="POST" id="submit-inventory" class="container-border-radius mt-5" >
<div class="container " style=" padding: 4%; width:90%">

    <div class="form-row justify-content-center">
        <div class="col-6">
            <label for="">PO</label>
            <input name="po_no" class="form-control" type="text" placeholder="PO #">
        </div>

        <div class="col-6">
            <label for="">Sku</label>
            <input name="sku" class="form-control" type="text" placeholder="SKU #">
        </div>

    </div>


    <div class="form-row justify-content-center">
        <div class="col-6">
            <label for="">Description</label>
            <input name="description" class="form-control" type="text" placeholder="Description">
        </div>

        <div class="col-6">
                <label for="">Case Quantity</label>
                <input name="inb_carton" id="case_qty" class="form-control" value="0" type="text" placeholder="">
        </div>

    </div>


    <div class="form-row justify-content-center">
        <div class="col-6">
            <label for="">Quantity Per Case</label>
            <input name="inb_case" id="qty_per_case" class="form-control" value="0" type="text" placeholder="">
        </div>

        <div class="col-6">
            <label for="">Item Quantity</label>
            
            <input name="inb_item" id="item_qty" class="form-control" value="0" type="text" placeholder="">
        </div>

    </div>

    <div class="form-row justify-content-center">
        <div class="col-6">
            <label for="">Total Quantity</label>
            <input name="inb_tot_qty" id="total_qty" class="form-control" value="0" type="text" placeholder="">
        </div>

    </div>

    <div class="form-row justify-content-center my-3">

            @csrf
            <button type="submit" class="btn btn-primary">Add</button>

    
    </div>



</div>
</form>
</div>
@endsection()
