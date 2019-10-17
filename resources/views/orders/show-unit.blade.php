@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 2%">
    <a href="/dashboard#inventoryrequests" class="btn btn-link text-frenchblue" style="margin-right:2%"><i class="fas fa-long-arrow-alt-left"></i> Go Back</a>

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


            </tbody>
          </table>

</div>

@endsection()