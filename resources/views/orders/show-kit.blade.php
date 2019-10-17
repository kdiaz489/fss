@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 2%">
    <a href="/dashboard#inventoryrequests" class="btn btn-link text-frenchblue" style="margin-right:2%"><i class="fas fa-long-arrow-alt-left"></i> Go Back</a>

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
                  <th scope="row">Value</th>
                  <td>{{'$' . $kit->kit_price}}</td>
              </tr>

              <tr>
                  <th scope="row">Sku #</th>
                  <td>{{$kit->kit_sku}}</td>
              </tr>

              <tr>
                  <th scope="row">Description</th>
                  <td>{{$kit->kit_desc}}</td>
              </tr>


                <tr>
                  <th scope="row">Units in Kit</th>
                  <td>
                  @foreach ($basic_units as $unit)
                        <a href="/viewbasicunit/{{$unit->id}}"><span class="badge badge-secondary">{{$unit->sku}}</span></a>
                  @endforeach
                  </td>
              </tr>


            </tbody>
          </table>

</div>

@endsection()