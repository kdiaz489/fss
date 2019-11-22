@extends('layouts.userdashboard')

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
        <ul class="nav nav-tabs border-1 nav-pills with-arrow flex-column flex-sm-row text-center" role="tablist">
            <li class="nav-item flex-sm-fill">
                <a class="nav-link mr-sm-3 rounded" href="/dashboard/user/fulfillment">Fulfillment</a>
            </li>
            <li class="nav-item flex-sm-fill">
                <a class="nav-link mr-sm-3 rounded" href="/dashboard/user/inventory">Storage</a>
            </li>
            <li class="nav-item flex-sm-fill">
                <a class="nav-link mr-sm-3 rounded" href="/dashboard">Shipments</a>
            </li>
            <li class="nav-item flex-sm-fill">
                    <a class="nav-link mr-sm-3 rounded" href="/dashboard/user/orders">Orders</a>
                </li>
            <li class="nav-item flex-sm-fill">
                <a class="nav-link mr-sm-3 rounded active" href="/dashboard/user/account">Account</a>
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
                    <h1 class="display-4">Account Balance</h1>
                    <br>
                    <br>
                    <div class="container-fluid px-5" style="border: solid 1px #dee2e6; border-radius: 10px">
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <h2 class="mt-4">Balance Owed</h2>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="table-responsive">

                        
                            <table class="table">
                                    <tr>
                                        <th>User</th>
                                        <th>Company</th>
                                        <th>Remaining Balance</th>
                                        <th></th>
                                    </tr>
                                
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->company_name}}</td>
                                        <td>{{'$' . number_format($user->account_balance,2)}}</td>
                                        <td>
                                            <div style="margin-left: 40%">
                                                <a href="/makepayment/{{$user->id}}" class="float-left" style="margin-right:1%">
                                                    <button class="btn btn-link text-denim btn-sm" type="button">Make a Payment</button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                </table>
                        </div>
                        </div>

                        <br><br>
                
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
                                            value={{ str_pad('#', strlen(auth()->user()->password)/2, "#", STR_PAD_LEFT)}} />
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
@endsection