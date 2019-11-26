@extends('layouts.userdashlte')

@section('content')
<div class="container" style="margin-top: 2%">
    <a onclick="history.back()" class="btn btn-link text-frenchblue" style="margin-right:2%"><i class="fas fa-long-arrow-alt-left"></i> Go Back</a>

    <br>
    <br>

    <hr>

    <h1>Pallet ID: #{{$pallet->id}}</h1>
    <table class="table">

            <tbody>

                <thead class="thead-light">
                    <tr>
                      <th >Details</th>
                      <th></th>
                    </tr>
                  </thead>


              <tr>
                  <th scope="row">Pallet Name</th>
                  <td>{{$pallet->pallet_name}}</td>
              </tr>

              <tr>
                  <th scope="row">Sku #</th>
                  <td>{{$pallet->sku}}</td>
              </tr>

              <tr>
                  <th scope="row">Description</th>
                  <td>{{$pallet->description}}</td>
              </tr>

              <tr>
                  <th scope="row">Pallet Quantity</th>
                  <td>{{$pallet->pallet_qty}}</td>
              </tr>

                <tr>
                  <th scope="row">Kits per Pallet</th>
                  <td>
                  @foreach ($kits as $kit)
                        <a href="/viewkit/{{$kit->id}}"><span class="badge badge-secondary">{{'sku: ' . $kit->sku . ' qty: ' . $kit->pivot->quantity}}</span></a>
                  @endforeach
                  </td>
              </tr>

                <tr>
                  <th scope="row">Cases per Pallet</th>
                  <td>
                  @foreach ($cases as $case)
                        <a href="/viewcase/{{$case->id}}"><span class="badge badge-secondary">{{'sku: ' . $case->sku . ' qty: ' . $case->pivot->quantity}}</span></a>
                  @endforeach
                  </td>
              </tr>

                <tr>
                  <th scope="row">Loose Items per Pallet</th>
                  <td>
                      @if ($pallet->basic_units != null)
                        @foreach ($pallet->basic_units as $unit)
                                <a href="/viewbasicunit/{{$unit->id}}"><span class="badge badge-secondary">{{'sku: ' . $unit->sku . ' qty: ' . $unit->pivot->quantity}}</span></a>
                        @endforeach
                      @endif

                  </td>
              </tr>


            </tbody>
          </table>

</div>

@endsection()