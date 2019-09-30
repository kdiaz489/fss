@extends('layouts.app')

@section('content')

<!-- Modal -->
<div class="modal fade editModal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer m-auto">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary">Save</button>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid bg-whitewash ">
    <div class="container dashboard-container pt-5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs border-1" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#allshipments" role="tab" data-toggle="tab">Shipments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#inventoryrequests" role="tab" data-toggle="tab">Inventory</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#account" role="tab" data-toggle="tab">Account</a>
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
                    <div role="tabpanel" class="tab-pane active" id="allshipments">
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
                                            <button class="btn btn-outline-secondary btn-sm" type="button">View</button>
                                        </a>
                                        <a href="/pdf/{{$shipment->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-outline-secondary btn-sm" type="button">Export PDF</button>
                                        </a>
                                        <form action="/ship/cancel/{{$shipment->id}}" method="POST" class="float-left">
                                            @method('PUT')
                                            @csrf

                                            <button type="submit"
                                                class="btn bg-frenchblue text-white btn-sm">Cancel</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        @else
                        <p>You have no shipments.</p>
                        @endif
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="inventoryrequests">
                        <h1 class="display-4">Inventory</h1>
                        <br>
                        <a href="/stor/addinventory" class="btn btn-outline-secondary">Add Inventory</a>
                        <a href="/stor/transout" class="btn btn-outline-secondary">Transfer Out</a>
                        <br>
                        <br>

                        @if(count($storagework) > 0)
                        <table class="table">
                            <tr>
                                <th>SKU</th>
                                <th>Submitted On</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            @foreach($storagework as $item)
                            <tr>
                                <td>{{$item->sku}}</td>
                                <td>{{$item->created_at->format('H:i:s m/d/y')}}</td>
                                <td>{{$item->work_status}}</td>

                                <td>
                                    <div style="margin-left: 50%">
                                        <a href="/pdfexport/{{$item->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-outline-secondary btn-sm" type="button">View</button>
                                        </a>
                                        <form action="/stor/cancel/{{$item->id}}" method="POST" class="float-left">
                                            @method('PUT')
                                            @csrf
                                            <button type="submit" class="btn bg-frenchblue text-white btn-sm">Cancel</button>
                                        </form>
                                    </div>
                                </td>


                            </tr>
                            @endforeach
                        </table>

                        @else
                        <p>You have no inventory requests.</p>
                        @endif
                    </div>
                    <div role="tabpanel" class="tab-pane" id="account">
                        <div class="container dashboard-container">
                            <h1 class="display-4">Account Settings</h1>
                            <br>
                            <br>
                            <div class="container-fluid px-5" style="border: solid 1px #dee2e6; border-radius: 10px">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h2 class="mt-4">Profile</h2>
                                    </div>
                                </div>

                                <div class="row py-5 border-bottom">
                                    <div class="col-lg-4">
                                        <h5>Username:</h5>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5>{{auth()->user()->user_name}}</h5>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="" href="" class="editusername" id=""><i
                                                class="fas fa-pencil-alt"></i></a>
                                    </div>

                                </div>

                                <div class="row py-5 border-bottom">
                                    <div class="col-lg-4">
                                        <h5>E-Mail:</h5>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5>{{auth()->user()->email}}</h5>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="" class="editemail" id=""><i class="fas fa-pencil-alt"></i></a>
                                    </div>

                                </div>

                                <div class="row py-5 ">
                                    <div class="col-lg-4">
                                        <h5>Password:</h5>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="password" style="border:none;"
                                            value={{auth()->user()->password}} />
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="" class="editpass" id=""><i class="fas fa-pencil-alt"></i></a>
                                    </div>

                                </div>
                            </div>

                            <div class="container-fluid px-5 mt-4"
                                style="border: solid 1px #dee2e6; border-radius: 10px">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h2 class="mt-4">Contact Info</h2>
                                    </div>
                                </div>
                                <div class="row py-5 border-bottom">
                                    <div class="col-lg-4">
                                        <h5>Company Name:</h5>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5>{{auth()->user()->company_name}}</h5>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="" href="" class="editcompanyname" id=""><i
                                                class="fas fa-pencil-alt"></i></a>
                                    </div>

                                </div>

                                <div class="row py-5 border-bottom">
                                    <div class="col-lg-4">
                                        <h5>Contact Name:</h5>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5>{{auth()->user()->name}}</h5>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="" class="editcontact" id=""><i class="fas fa-pencil-alt"></i></a>
                                    </div>

                                </div>

                                <div class="row py-5 ">
                                    <div class="col-lg-4">
                                        <h5>Address:</h5>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5>{{auth()->user()->street_address.' '.auth()->user()->city.', '.auth()->user()->state. ' '.auth()->user()->zip}}
                                        </h5>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="" class="editaddress" id=""><i class="fas fa-pencil-alt"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>



        </div>
    </div>
</div>
@endsection