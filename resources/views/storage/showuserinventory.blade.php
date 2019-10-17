@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 2%">
    <a href="/dashboard#inventoryrequests" class="btn btn-outline-secondary">Go Back</a>

    <br>
    <br>

    <hr>

    <h1>Inventory ID: #{{$storage->id}}</h1>
    <table class="table">

            <tbody>

                <thead class="thead-light">
                    <tr>
                      <th>Item Details</th>
                      <th></th>
                    </tr>
                  </thead>

              <tr>
                  <th scope="row">Pro Number</th>
                  <td>{{$storage->pro_no}}</td>
              </tr>

              <tr>
                  <th scope="row">Pu Number</th>
                  <td>{{$storage->pu_no}}</td>
              </tr>

              <tr>
                  <th scope="row">Po Number</th>
                  <td>{{$storage->po_no}}</td>
              </tr>

              <tr>
                  <th scope="row">Barcode</th>
                  <td>{{$storage->barcode}}</td>
              </tr>

              <tr>
                  <th scope="row">SKU</th>
                  <td>{{$storage->sku}}</td>
              </tr>

              <tr>
                  <th scope="row">Description</th>
                  <td>{{$storage->description}}</td>
              </tr>

              <tr>
                  <th scope="row">Carton Quantity</th>
                  <td>{{$storage->carton_qty}}</td>
              </tr>

              <tr>
                  <th scope="row">Case Quantity</th>
                  <td>{{$storage->case_qty}}</td>
              </tr>

              <tr>
                  <th scope="row">Item Quantity</th>
                  <td>{{$storage->item_qty}}</td>
              </tr>

              <tr>
                  <th scope="row">Building</th>
                  <td>{{$storage->building}}</td>
              </tr>
              
              <tr>
                  <th scope="row">Row</th>
                  <td>{{$storage->row_}}</td>
              </tr>

              <tr>
                  <th scope="row">Column</th>
                  <td>{{$storage->col_}}</td>
              </tr>

              <tr>
                  <th scope="row">Created At</th>
                  <td>{{$storage->created_at}}</td>
              </tr>

              <tr>
                  <th scope="row">Updated At</th>
                  <td>{{$storage->updated_at}}</td>
              </tr>

            </tbody>
          </table>

</div>

@endsection()