@extends('layouts.admindashlte')

@section('user-name')
 {{auth()->user()->name}}   
@endsection

@section('content')

<div class="modal fade editAdminModal" id="editAdminModal" tabindex="-1" role="dialog"
    aria-labelledby="editAdminModalCenterTitle" aria-hidden="true">
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
<div class="container-fluid dashboard-container mb-5">


    <div class="row justify-content-center">
        <div class="col-md-12 " style="padding-top: 2%">

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="col-lg-12 col-12">

                        <div class="container dashboard-container">
                            <h3 class="font-weight-light">Account Settings</h3>

                            <br>
                            <div class="container-fluid px-5" style="border: solid 1px #dee2e6; border-radius: 10px">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h4 class="mt-4">Profile</h4>
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
                                            value={{ str_pad('#', strlen(auth()->user()->password)/2, "#", STR_PAD_LEFT)}}/>
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
                                        <h4 class="mt-4">Contact Info</h4>
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

    @endsection