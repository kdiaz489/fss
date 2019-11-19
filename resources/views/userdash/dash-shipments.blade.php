@extends('layouts.userdashboard')

@section('content')

<div class="container-fluid bg-whitewash ">
    <div class="container dashboard-container pt-5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs border-1" role="tablist">
            <li class="nav-item">
                <a class="nav-link" href="#">Fulfillment</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/dashboard">Shipments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/user/inventory">Storage</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/user/orders">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/user/account">Account</a>
            </li>

        </ul>
    </div>

</div>


<div class="container-fluid dashboard-container">
    <div class="jumbotron bg-whitewash mt-5">
        <h1 class="display-4 text-break text-center">Welcome to your Dashboard, {{ Auth::user()->name }}.</h1>
    </div>

    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

</div>
<div class="container-fluid dashboard-container">


    <div class="row justify-content-center">
        <div class="col-md-12 " style="padding-top: 2%">

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="col-lg-12 col-12">


                <!-- Tab panes -->
                <div class="tab-content">
                    <br>
                    
                        <h1 class="display-4">Shipments</h1>

                        <br>
                        <a href="/ship" class="btn btn-outline-secondary">Quick Quote</a>
                        <a href="/ship/book" class="btn btn-outline-secondary">Book Shipment</a>

                        <br>
                        <br>
                        @if(count($shipments) > 0)
                        <table class="table">
                            <tr>
                                <th>Shipment Destination</th>
                                <th>Submitted On</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            @foreach($shipments as $shipment)
                            <tr>
                                <td>{{$shipment->dest_company}}</td>
                                <td>{{$shipment->created_at->format('H:i:s m/d/y')}}</td>
                                <td>{{$shipment->work_status}}</td>
                                <td>
                                    <div style="margin-left: 40%">
                                        <a href="/ship/{{$shipment->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-secondary btn-sm"
                                                type="button">View</button>
                                        </a>
                                        <a href="/pdf/{{$shipment->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">Export
                                                PDF</button>
                                        </a>
                                        <form action="/ship/cancel/{{$shipment->id}}" method="POST" class="float-left">
                                            @method('PUT')
                                            @csrf

                                            <button type="submit"
                                                class="btn btn-link text-danger btn-sm">Cancel</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        @else
                        <p>You have no pending shipments.</p>
                        @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection