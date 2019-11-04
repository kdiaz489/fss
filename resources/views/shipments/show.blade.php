@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 2%">
    <a onclick="history.back()" class="btn btn-outline-secondary">Go Back</a>

    <br>
    <br>

    <hr>

    <h1>Shipment ID: #{{$shipment->id}}</h1>
    <table class="table table-bordered">

            <tbody>

                <thead class="thead-light">
                    <tr>
                      <th >Origin</th>
                      <th></th>
                    </tr>
                  </thead>

              <tr>
                  <th scope="row">Company</th>
                  <td>{{$shipment->orig_company}}</td>
              </tr>

              <tr>
                  <th scope="row">Address 01</th>
                  <td>{{$shipment->orig_address_01}}</td>
              </tr>

              <tr>
                  <th scope="row">Address 02</th>
                  <td>{{$shipment->orig_address_02}}</td>
              </tr>

              <tr>
                  <th scope="row">City</th>
                  <td>{{$shipment->orig_city}}</td>
              </tr>

              <tr>
                  <th scope="row">State</th>
                  <td>{{$shipment->orig_state}}</td>
              </tr>

              <tr>
                  <th scope="row">Zip</th>
                  <td>{{$shipment->orig_zip}}</td>
              </tr>

              <tr>
                  <th scope="row">Contact Name</th>
                  <td>{{$shipment->orig_cont_name}}</td>
              </tr>

              <tr>
                  <th scope="row">Contact Email</th>
                  <td>{{$shipment->orig_cont_email}}</td>
              </tr>

              <tr>
                  <th scope="row">Contact Phone</th>
                  <td>{{$shipment->orig_cont_phone}}</td>
              </tr>

              <tr>
                  <th scope="row">Destination Type</th>
                  <td>{{$shipment->orig_type}}</td>
              </tr>
              
              <thead class="thead-light">
                  <tr>
                    <th >Destination</th>
                    <th></th>
                  </tr>
                </thead>

              <tr>
                  <th scope="row">Company</th>
                  <td>{{$shipment->dest_company}}</td>
              </tr>

              <tr>
                  <th scope="row">Address 01</th>
                  <td>{{$shipment->dest_address_01}}</td>
              </tr>

              <tr>
                  <th scope="row">Address 02</th>
                  <td>{{$shipment->dest_address_02}}</td>
              </tr>

              <tr>
                  <th scope="row">City</th>
                  <td>{{$shipment->dest_city}}</td>
              </tr>

              <tr>
                  <th scope="row">State</th>
                  <td>{{$shipment->dest_state}}</td>
              </tr>

              <tr>
                  <th scope="row">Zip</th>
                  <td>{{$shipment->dest_zip}}</td>
              </tr>

              <tr>
                  <th scope="row">Contact Name</th>
                  <td>{{$shipment->dest_cont_name}}</td>
              </tr>

              <tr>
                  <th scope="row">Contact Email</th>
                  <td>{{$shipment->dest_cont_email}}</td>
              </tr>

              <tr>
                  <th scope="row">Contact Phone</th>
                  <td>{{$shipment->dest_cont_phone}}</td>
              </tr>
              
              <tr>
                  <th scope="row">Destination Type</th>
                  <td>{{$shipment->dest_type}}</td>
              </tr>


              <thead class="thead-light">
                  <tr>
                    <th>Load Details</th>
                    <th></th>
                  </tr>
                </thead>

                <tr>
                    <th scope="row">Number of Items</th>
                    <td>{{$shipment->no_of_pallets}}</td>
                </tr>

                <tr>
                    <th scope="row">Weight Per Pallet</th>
                    <td>{{$shipment->weight_per_pallet}}</td>
                </tr>

                <tr>
                    <th scope="row">Total Load Weight</th>
                    <td>{{$shipment->tot_load_wt}}</td>
                </tr>

                <tr>
                    <th scope="row">Freight Class</th>
                    <td>{{$shipment->freight_class}}</td>
                </tr>

                <tr>
                    <th scope="row">Length</th>
                    <td>{{$shipment->pallet_length}}</td>
                </tr>

                <tr>
                    <th scope="row">Width</th>
                    <td>{{$shipment->pallet_width}}</td>
                </tr>

                <tr>
                    <th scope="row">Height</th>
                    <td>{{$shipment->pallet_height}}</td>
                </tr>

                <tr>
                    <th scope="row">Total Cost</th>
                    <td>${{$shipment->tot_load_cost}}</td>
                </tr>

            </tbody>
          </table>

</div>

@endsection()