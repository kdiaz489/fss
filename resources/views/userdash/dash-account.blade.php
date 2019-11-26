@extends('layouts.userdashlte')

@section('user-name')
 {{auth()->user()->name}}   
@endsection

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

<div class="container-fluid dashboard-container">

    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

</div>

<div class="container mb-5" style="max-width:1200px">


    <div class="row justify-content-center">
        <div class="col-md-12 ">

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="col-lg-12 col-12">
                    <br>
                    <h1 class="h1 font-weight-light">Account Balance</h1>
                    <div class="container-fluid px-5 py-3" style="border: solid 1px #dee2e6; border-radius: 10px">
                        <div class="row">
                            <div class="col-lg-4">
                                <h2 class="h2 font-weight-light">Balance Owed</h2>
                            </div>
                        </div>

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

                        <br>
                
                            <h1 class="h1 font-weight-light">Account Settings</h1>
                            <div class="container-fluid px-5 py-3" style="border: solid 1px #dee2e6; border-radius: 10px">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h2 class="h2 font-weight-light">Profile</h2>
                                    </div>
                                </div>

                                <div class="row py-3 border-top border-bottom">
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

                                <div class="row py-3 border-bottom">
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

                                <div class="row py-3 ">
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

                            <div class="container-fluid px-5 py-3 mt-4"
                                style="border: solid 1px #dee2e6; border-radius: 10px">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h2 class="h2 font-weight-light">Contact Info</h2>
                                    </div>
                                </div>
                                <div class="row py-3 border-top border-bottom">
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

                                <div class="row py-3 border-bottom">
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

                                <div class="row py-3 ">
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
@endsection