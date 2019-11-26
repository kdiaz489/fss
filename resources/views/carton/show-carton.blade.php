@extends('layouts.userdashlte')

@section('content')
<div class="container" style="margin-top: 2%">
    <a onclick="history.back()" class="btn btn-link text-frenchblue" style="margin-right:2%"><i class="fas fa-long-arrow-alt-left"></i> Back</a>

    <br>
    <br>

    <hr>

    <h1>Carton ID: #{{$carton->id}}</h1>
    <table class="table">

            <tbody>

                <thead class="thead-light">
                    <tr>
                      <th >Details</th>
                      <th></th>
                    </tr>
                  </thead>


              <tr>
                  <th scope="row">Sku #</th>
                  <td>{{$carton->sku}}</td>
              </tr>

              <tr>
                  <th scope="row">Description</th>
                  <td>{{$carton->description}}</td>
              </tr>

              <tr>
                  <th scope="row">Pallet Quantity</th>
                  <td>{{$carton->pallet_qty}}</td>
              </tr>

                <tr>
                  <th scope="row">Kits per Carton</th>
                  <td>
                  @foreach ($kits as $kit)
                        <a href="/viewkit/{{$kit->id}}"><span class="badge badge-secondary">{{'sku: ' . $kit->sku . ' qty: ' . $kit->pivot->quantity}}</span></a>
                  @endforeach
                  </td>
              </tr>

                <tr>
                  <th scope="row">Cases per Carton</th>
                  <td>
                  @foreach ($cases as $case)
                        <a href="/viewcase/{{$case->id}}"><span class="badge badge-secondary">{{'sku: ' . $case->sku . ' qty: ' . $case->pivot->quantity}}</span></a>
                  @endforeach
                  </td>
              </tr>

                <tr>
                  <th scope="row">Units per Carton</th>
                  <td>
                      @if ($carton->basic_units->all() != null)
                        @foreach ($carton->basic_units->all() as $unit)
                                <a href="/viewbasicunit/{{$unit->id}}"><span class="badge badge-secondary">{{'sku: ' . $unit->sku . ' qty: ' . $unit->pivot->quantity}}</span></a>
                        @endforeach
                      @endif

                  </td>
              </tr>


            </tbody>
          </table>

</div>

@endsection()