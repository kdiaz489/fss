@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 2%">
    <a onclick="history.back()" class="btn btn-link text-frenchblue" style="margin-right:2%"><i class="fas fa-long-arrow-alt-left"></i> Go Back</a>

    <br>
    <br>

    <hr>

    <h1>Kit ID: #{{$kit->id}}</h1>
    <table class="table">

            <tbody>

                <thead class="thead-light">
                    <tr>
                      <th >Details</th>
                      <th></th>
                    </tr>
                  </thead>


              <tr>
                  <th scope="row">Kit Name</th>
                  <td>{{$kit->kit_name}}</td>
              </tr>

              <tr>
                  <th scope="row">Sku #</th>
                  <td>{{$kit->sku}}</td>
              </tr>

              <tr>
                  <th scope="row">Description</th>
                  <td>{{$kit->description}}</td>
              </tr>


                <tr>
                  <th scope="row">Units in Kit</th>
                  <td>
                  @foreach ($basic_units as $unit)
                        <a href="/viewbasicunit/{{$unit->id}}"><span class="badge badge-secondary">{{ 'sku: ' . $unit->sku . ' qty: ' . $unit->pivot->quantity}}</span></a>
                  @endforeach
                  </td>
              </tr>

              <tr>
                  <th scope="row">Kit Quantity</th>
                  <td>{{$kit->kit_qty}}</td>
              </tr>

              <tr>
                  <th scope="row">Case Quantity</th>
                  <td>{{$kit->case_qty}}</td>
              </tr>

              <tr>
                  <th scope="row">Carton Quantity</th>
                  <td>{{$kit->carton_qty}}</td>
              </tr>

              <tr>
                  <th scope="row">Pallet Quantity</th>
                  <td>{{$kit->pallet_qty}}</td>
              </tr>

              <tr>
                  <th scope="row">Total Quantity</th>
                  <td>{{$kit->total_qty}}</td>
              </tr>

            </tbody>
          </table>

</div>

@endsection()