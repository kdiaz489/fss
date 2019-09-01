@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:2%">
    <h1 class=" display-4 text-center">Transfer Out Inventory</h1>
<form action="/stor/submittransout" method="POST">

    <div class="form-group">
        <label for="">Out Carton</label>
        <input name="out_carton" class="form-control" type="text" placeholder="Out">
    </div>


    <div class="form-group">
        <label for="">Out Case</label>
        <input name="out_case" class="form-control" type="text" placeholder="Case">
    </div>


    <div class="form-group">
        <label for="">Out Item</label>
        <input name="out_item" class="form-control" type="text" placeholder="Item">
    </div>


    <div class="form-group">
            <label for="">Out Total Quantity</label>
            <input name="out_tot_qty" class="form-control" type="text" placeholder="Total">
    </div>


    <br>
    @csrf
    <button type="submit" class="btn btn-primary">Submit</button>
    <br>
    <br>


</form>
</div>
@endsection()
