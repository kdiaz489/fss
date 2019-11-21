@extends('layouts.userdashboard')

@section('content')
<div class="container" style="margin-top: 2%">
    <a onclick="history.back()" class="btn btn-link text-frenchblue" style="margin-right:2%"><i class="fas fa-long-arrow-alt-left"></i> Go Back</a>

    <br>
    <br>

    <hr>

    <h1>Case ID: #{{$case->id}}</h1>
    <table class="table">

            <tbody>

                <thead class="thead-light">
                    <tr>
                      <th >Details</th>
                      <th></th>
                    </tr>
                  </thead>


              <tr>
                  <th scope="row">Case Name</th>
                  <td>{{$case->case_name}}</td>
              </tr>

              <tr>
                  <th scope="row">Sku #</th>
                  <td>{{$case->sku}}</td>
              </tr>

              <tr>
                  <th scope="row">Description</th>
                  <td>{{$case->description}}</td>
              </tr>

              <tr>
                  <th scope="row">Unit Quantity</th>
                  <td>{{$case->basic_unit_qty}}</td>
              </tr>

                <tr>
                  <th scope="row">Units in Case</th>
                  <td>
                  @foreach ($basic_units as $unit)
                        <a href="/viewbasicunit/{{$unit->id}}"><span class="badge badge-secondary">{{'sku: ' . $unit->sku . ' qty: ' . $unit->pivot->quantity}}</span></a>
                  @endforeach
                  </td>
              </tr>

              <tr>
                  <th scope="row">Kit Quantity</th>
                  <td>{{$case->kit_qty}}</td>
              </tr>

                <tr>
                  <th scope="row">Kits in Case</th>
                  <td>
                      @if ($case->kits->all() != null)
                        @foreach ($case->kits->all() as $kit)
                                <a href="/viewkit/{{$kit->id}}"><span class="badge badge-secondary">{{'sku: ' . $kit->sku . ' qty: ' . $kit->pivot->quantity}}</span></a>
                        @endforeach 
                      @endif

                  </td>
              </tr>

              <tr>
                  <th scope="row">Case Quantity</th>
                  <td>{{$case->case_qty}}</td>
              </tr>

              <tr>
                  <th scope="row">Carton Quantity</th>
                  <td>{{$case->carton_qty}}</td>
              </tr>

              <tr>
                  <th scope="row">Pallet Quantity</th>
                  <td>{{$case->pallet_qty}}</td>
              </tr>

            </tbody>
          </table>

</div>

@endsection()