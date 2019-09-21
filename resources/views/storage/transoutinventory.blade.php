@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:2%; width:30%">
    <h1 class=" display-5 text-center">Transfer Out Inventory</h1>
<form action="/stor/submittransout" method="POST" class="bg-whitewash">
    <div class="container" style=" margin-top: 5%; padding:4%; width:90%">

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Out Carton</label>
                <input name="out_carton" class="form-control form-control-sm" type="text" placeholder="Out">
            </div>
                
                
            <div class="form-group col-md-6">
                <label for="">Out Case</label>
                <input name="out_case" class="form-control form-control-sm" type="text" placeholder="Case">
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                    <label for="">Out Item</label>
                    <input name="out_item" class="form-control form-control-sm" type="text" placeholder="Item">
                </div>
            
            
                <div class="form-group col-md-6">
                        <label for="">Out Total Quantity</label>
                        <input name="out_tot_qty" class="form-control form-control-sm" type="text" placeholder="Total">
                </div>
        </div>
        
        <div class="form-row justify-content-center">
            <br>
            @csrf
            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
         </div>

    </div>



</form>
</div>
@endsection()
