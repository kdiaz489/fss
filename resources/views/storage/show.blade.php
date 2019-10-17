@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 2%">
    <a href="/dashboard#inventoryrequests" class="btn btn-outline-secondary">Go Back</a>

    <br>
    <br>

    <hr>

    <h1>Inventory Request ID: #{{$storage->id}}</h1>
    <table class="table">

            <tbody>

                <thead class="thead-light">
                    <tr>
                      <th >Inventory Add</th>
                      <th></th>
                    </tr>
                  </thead>

              <tr>
                  <th scope="row">Pro No</th>
                  <td>{{$storage->pro_no}}</td>
              </tr>

              <tr>
                  <th scope="row">Address 01</th>
                  <td>{{$storage->pu_no}}</td>
              </tr>

              <tr>
                  <th scope="row">Address 02</th>
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
                  <th scope="row">Inb Carton</th>
                  <td>{{$storage->inb_carton}}</td>
              </tr>

              <tr>
                  <th scope="row">Inb Case</th>
                  <td>{{$storage->inb_case}}</td>
              </tr>

              <tr>
                  <th scope="row">Inb Item</th>
                  <td>{{$storage->inb_item}}</td>
              </tr>

              <tr>
                  <th scope="row">Inb Total Quantity</th>
                  <td>{{$storage->inb_tot_qty}}</td>
              </tr>
              
              <thead class="thead-light">
                  <tr>
                    <th>Outbound Inventory</th>
                    <th></th>
                  </tr>
                </thead>

              <tr>
                  <th scope="row">Outbound Carton</th>
                  <td>{{$storage->out_carton}}</td>
              </tr>

              <tr>
                  <th scope="row">Outbound Case</th>
                  <td>{{$storage->out_case}}</td>
              </tr>

              <tr>
                  <th scope="row">Outbound Item</th>
                  <td>{{$storage->out_item}}</td>
              </tr>

              <tr>
                  <th scope="row">Outbound Total Quantity</th>
                  <td>{{$storage->out_tot_qty}}</td>
              </tr>

              <thead class="thead-light">
                <tr>
                  <th>Eliminate Inventory</th>
                  <th></th>
                </tr>
              </thead>

              <tr>
                  <th scope="row">Eliminate Carton</th>
                  <td>{{$storage->elim_carton}}</td>
              </tr>

              <tr>
                  <th scope="row">Eliminate Case</th>
                  <td>{{$storage->elim_case}}</td>
              </tr>

              <tr>
                  <th scope="row">Eliminate Item</th>
                  <td>{{$storage->elim_item}}</td>
              </tr>

              <tr>
                  <th scope="row">Eliminate Total Quantity</th>
                  <td>{{$storage->elim_tot_qty}}</td>
              </tr>


            </tbody>
          </table>

</div>

@endsection()