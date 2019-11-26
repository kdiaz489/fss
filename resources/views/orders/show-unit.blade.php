@extends('layouts.userdashlte')

@section('content')
<div class="container" style="margin-top: 2%">
    <a onclick="history.back()" class="btn btn-link text-frenchblue" style="margin-right:2%"><i class="fas fa-long-arrow-alt-left"></i> Go Back</a>

    <br>
    <br>

    <hr>

    <h1>Unit ID: #{{$basic_unit->id}}</h1>
    <table class="table">

            <tbody>

                <thead class="thead-light">
                    <tr>
                      <th>Details</th>
                      <th></th>
                    </tr>
                  </thead>

              <tr>
                  <th scope="row">Unit Name</th>
                  <td>{{$basic_unit->unit_name}}</td>
              </tr>

              <tr>
                  <th scope="row">Value</th>
                  <td>{{'$' . $basic_unit->price}}</td>
              </tr>

              <tr>
                  <th scope="row">Sku #</th>
                  <td>{{$basic_unit->sku}}</td>
              </tr>

              <tr>
                  <th scope="row">Description</th>
                  <td>{{$basic_unit->description}}</td>
              </tr>

              <tr>
                  <th scope="row">Weight</th>
                  <td>{{$basic_unit->weight}}</td>
              </tr>

              <tr>
                  <th scope="row">Loose Item Quantity</th>
                  <td>{{$basic_unit->loose_item_qty}}</td>
              </tr>

              <tr>
                  <th scope="row">Kit Qty</th>
                  <td>{{$basic_unit->kit_qty}}</td>
              </tr>

              <tr>
                  <th scope="row">Case Quantity</th>
                  <td>{{$basic_unit->case_qty}}</td>
              </tr>

              <tr>
                  <th scope="row">Carton Quantity</th>
                  <td>{{$basic_unit->carton_qty}}</td>
              </tr>

              <tr>
                  <th scope="row">Pallet Quantity</th>
                  <td>{{$basic_unit->pallet_qty}}</td>
              </tr>

            </tbody>
          </table>

</div>

@endsection()