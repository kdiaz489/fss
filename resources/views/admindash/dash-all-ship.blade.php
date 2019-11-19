@extends('layouts.admindashboard')

@section('content')

<div class="container-fluid bg-whitewash ">
    <div class="container dashboard-container pt-5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs border-1" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="/dashboard">Shipments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/admin/users">Manage Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/admin/inventory">Inventory Requests</a>
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
                    <br>
                        <div class="container dashboard-container"
                            style="display: block; overflow-x: auto; white-space: nowrap;">

                            <h1 class="display-4">Shipments</h1>
                            <br>
                            <br>

                            @if(count($shipments) > 0)
                            <table class="table table-bordered">
                                <tr>
                                    <th>Edit Status</th>
                                    <th>Shipment Status</th>
                                    <th>Shipment Origin</th>
                                    <th>Shipment Destination</th>
                                    <th>Submitted On</th>
                                    <th>Updated On</th>
                                    <th>Total Cost</th>
                                    <th>Actions</th>
                                </tr>
                                @foreach($shipments as $shipment)
                                <tr>
                                    <td>
                                        <form action=" /ship/admin/update/{{$shipment->id}}" method="POST">
                                            @csrf
                                            {{method_field('PUT')}}

                                            <div class="form-check">
                                                <input type="checkbox" name="status_1" value="Complete">
                                                <label>Complete</label>
                                                <br>
                                                <input type="checkbox" name="status_1" value="In Progress">
                                                <label>In Progress</label>
                                                <br>

                                                <input type="checkbox" name="status_1" value="Cancelled">
                                                <label>Cancelled</label>
                                                <br>


                                            </div>

                                            <button type="submit" style=" margin-left: 1.25rem;"
                                                class="btn btn-link btn-sm">Update</button>
                                        </form>
                                    </td>
                                    <td>{{$shipment->work_status}}</td>
                                    <td>{{$shipment->orig_company}}</td>
                                    <td>{{$shipment->dest_company}}</td>
                                    <td>{{$shipment->created_at->format('H:i:s   m/d/y')}}</td>
                                    <td>{{$shipment->updated_at->format('H:i:s   m/d/y')}}</td>
                                    <td>${{$shipment->tot_load_cost}}</td>
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