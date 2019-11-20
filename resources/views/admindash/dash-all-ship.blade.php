@extends('layouts.admindashboard')

@section('content')

<div class="container-fluid bg-whitewash ">
    <div class="container dashboard-container pt-5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs border-1" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/admin/fulfillment">Fulfillment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/admin/inventory">Storage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/dashboard">Shipments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/admin/users">Manage Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/admin/orders">Orders</a>
                </li>
    
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/admin/account">Account</a>
                </li>
            </ul>
    </div>

</div>


<div class="container-fluid dashboard-container">
    <div class="jumbotron bg-whitewash mt-5">
        <h1 class="display-4 text-break text-center">Admin Dashboard.</h1>
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
                        <div class="container dashboard-container"
                            style="display: block; overflow-x: auto; white-space: nowrap;">

                            <h1 class="display-4">Shipments</h1>
                            <br>
                            
                            @if(count($shipments) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Edit Status</th>
                                        <th>Order #</th>
                                        <th>Submitted On</th>
                                        <th>Status</th>
                                        <th>Origin</th>
                                        <th>Destination</th>
                                        <th>Pickup</th>
                                        <th>Delivery</th>
                                        <th>Contact Name</th>
                                        <th>Contact Email</th>
                                        <th>Contact Phone</th>
                                        <th>Dock</th>
                                        <th>Forklift</th>
                                        <th>Actions</th>
                                    </tr>
                                    @foreach($shipments as $shipment)
                                    <tr>
                                        <td>
                                                <form action="/ship/admin/update/{{$shipment->id}}" method="POST">
                                                    @csrf
                                                    {{method_field('PUT')}}
                                                    <select name="status_1" id="" class=" form-control form-control-sm">
                                                        <option value="" selected disabled>Choose</option>
                                                        <option value="Completed">Completed</option>
                                                        <option value="Approved">Approved</option>
                                                        <option value="In Progress">In Progress</option>
                                                        <option value="Rejected">Rejected</option>
                                                    </select>
        
                                                    <button type="submit" class="btn btn-link btn-sm text-center">
                                                         <small>Update</small>
                                                    </button>
                                                </form>

                                        </td>
                                        <td>{{str_pad($shipment->id, 6, '0', STR_PAD_LEFT)}}</td>
                                        <td>{{$shipment->created_at->format('H:i:s   m/d/y')}}</td>
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
                                                <a href="/ship/{{$shipment->id}}" class="float-left"
                                                    style="margin-right:1%">
                                                    <button class="btn btn-link btn-sm" type="button">View</button>
                                                </a>
                                                <a href="/pdf/{{$shipment->id}}" class="float-left" style="margin-right:1%">
                                                    <button class="btn btn-link text-denim btn-sm" type="button">Export PDF</button>
                                                </a>
                                                <form action="/ship/{{$shipment->id}}" method="POST" class="float-left">
                                                    @method('DELETE')
                                                    @csrf

                                                    <button type="submit"
                                                        class="btn btn-link text-danger btn-sm">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            @else
                            <p>You have no requests.</p>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>

    @endsection