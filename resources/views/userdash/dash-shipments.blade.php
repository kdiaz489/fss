@extends('layouts.userdashlte')

@section('user-name')
 {{auth()->user()->name}}   
@endsection

@section('content')


<div class="container-fluid dashboard-container">
    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

</div>
<div class="container-fluid dashboard-container">


    <div class="row justify-content-center">
        <div class="col-md-12">

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="col-lg-12 col-12">
                        <p class="h1 font-weight-light">Shipments</p>

                        <!--
                        <a href="/ship" class="btn btn-outline-secondary">Quick Quote</a>
                        <a href="/ship/book" class="btn btn-outline-secondary">Book Shipment</a>
                        -->

                        @if(count($shipments) > 0)
                        <div class="table-responsive">

                        
                            <table class="table shipments">
                                <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Booked On</th>
                                    <th>Status</th>
                                    <th>Org Info</th>
                                    <th>Dest Info</th>
                                    <th>Pick Date</th>
                                    <th>Delivery Date</th>
                                    <th>Contact Name</th>
                                    <th>Contact Email</th>
                                    <th>Contact Phone</th>
                                    <th>Dock</th>
                                    <th>Fork Lift</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shipments as $shipment)
                                <tr>
                                    <td>{{str_pad($shipment->id, 6, '0', STR_PAD_LEFT)}}</td>
                                    <td>{{$shipment->created_at->format('H:i:s m/d/y')}}</td>
                                    <td>{{$shipment->work_status}}</td>
                                    <td>{{$shipment->orig_company}}</td>
                                    <td>{{$shipment->dest_company}}</td>
                                    <td>{{$shipment->orig_pickup_date}}</td>
                                    <td>{{$shipment->dest_pickup_date}}</td>
                                    <td>{{$shipment->dest_cont_name}}</td>
                                    <td>{{$shipment->dest_cont_email}}</td>
                                    <td>{{$shipment->dest_cont_phone}}</td>
                                    <td>{{$shipment->dest_dock}}</td>
                                    <td>{{$shipment->dest_frklft}}</td>
                                    <td>
                                        <div>
                                            <a href="/ship/{{$shipment->id}}" class="float-left">
                                                <button class="btn btn-link text-secondary btn-sm px-0 pr-1"
                                                    type="button"><small>View</small></button>
                                            </a>
                                            <a href="/pdf/{{$shipment->id}}" class="float-left">
                                                <button class="btn btn-link text-denim btn-sm px-0 pr-1" type="button"><small>PDF</small></button>
                                            </a>
                                            <form action="/ship/cancel/{{$shipment->id}}" method="POST" class="float-left">
                                                @method('PUT')
                                                @csrf

                                                <button type="submit"
                                                    class="btn btn-link text-danger btn-sm px-0 pr-1"><small>Cancel</small></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                        @else
                        <p>You have no pending shipments.</p>
                        @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
        $(function () {
          
          $('.shipments').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
    });
        });
      </script>   
@endsection