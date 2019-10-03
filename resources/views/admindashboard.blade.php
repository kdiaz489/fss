@extends('layouts.app')

@section('content')

<div class="modal fade editAdminModal" id="editAdminModal" tabindex="-1" role="dialog" aria-labelledby="editAdminModalCenterTitle" aria-hidden="true">
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
                    <a class="nav-link" href="#allusers" role="tab" data-toggle="tab">Manage Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#inventoryrequests" role="tab" data-toggle="tab">Inventory Requests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#account" role="tab" data-toggle="tab">Account</a>
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
<div class="container-fluid">


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
                                
                                    <div class="container dashboard-container" style="display: block; overflow-x: auto; white-space: nowrap;">
                                    
                                    <h1 class="display-4">Shipments</h1>
                                    <br>
                                    <br>
                                 
                                    @if(count($shipments) > 0)
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Edit</th>
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
                                                        
                                                        <button type="submit" style=" margin-left: 1.25rem;" class="btn btn-link btn-sm">Update</button>
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
                                                    <a href="/ship/{{$shipment->id}}" class="float-left" style="margin-right:1%">
                                                            <button class="btn btn-link btn-sm" type="button">View</button>
                                                        </a>

                                                    <form action="/ship/{{$shipment->id}}" method="POST" class="float-left">
                                                        @method('DELETE')
                                                        @csrf
                                                        
                                                        <button type="submit" class="btn btn-link text-danger btn-sm">Delete</button>
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
                          
                            

                                <div role="tabpanel" class="tab-pane fade" id="allusers">
                                    <div class="container dashboard-container">
                                        <h1 class="display-4">Manage Users</h1>
                                        <br>
                                        <p>*Feature under development</p>
                                        <button type="button" class="adduser btn btn-outline-secondary" data-toggle="modal" data-target="#editAdminModal" disabled>Add User</button>
                                        <br>
                                        <br>
                                        <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Roles</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($users as $user)
                                                    <tr>
                                                        <td>{{$user->name}}</td>
                                                        <td>{{$user->email}}</td>
                                                        <td>{{implode(', ', $user->roles()->pluck('name')->toArray())}}</td>
                                                        <td>
                                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="float-left">
                                                            <button class="btn btn-link text-primary btn-sm" type="button">Edit Roles</button>
                                                        </a>
                                                    <form action="{{route('admin.users.destroy', $user->id) }}" method="POST" class="float-left">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                        <button type="submit" class="btn btn-link text-danger btn-sm">Delete</button>
                                                    </form>
                                                    <!---
                                                    <a href="{{ route('admin.impersonate', $user->id) }}" class="float-left">
                                                        <button class="btn btn-success btn-sm" type="button">Impersonate User</button>
                                                    </a>
                                                    --->
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                               


                                <div role="tabpanel" class="tab-pane fade" id="inventoryrequests">
                                    
                                    <div class="container dashboard-container" >
                                        <h1 class="display-4">Inventory Requests</h1>
                                        <br>
                                        
                                        <br>

                                        @if(count($storagework) > 0)
                                        <table class="table table-bordered" style="display: block; overflow-x: auto; white-space: nowrap;">
                                            <tr>
                                                <th style="padding-left:60px; padding-right:60px;">Edit</th>
                                                <th style="padding-left:60px; padding-right:60px;">Data</th>
                                                <th>work_status</th>
                                                <th>company</th>
                                                <th>user_id</th>
                                                <th>sku</th>
                                                <th>description</th>
                                                <th>inb_carton</th>
                                                <th>inb_case</th>
                                                <th>inb_item</th>
                                                <th>inb_tot_qty</th>
                                                <th>out_carton</th>
                                                <th>out_case</th>
                                                <th>out_item</th>
                                                <th>out_tot_qty</th>
                                                <th>elim_carton</th>
                                                <th>elim_case</th>
                                                <th>elim_item</th>
                                                <th>elim_tot_qty</th>
                                                <th>building</th>
                                                <th>row_</th>
                                                <th>col_</th>
                                                <th>created_at</th>
                                                <th>updated_at</th>
                                                
                                                
                                            </tr>
                                            @foreach($storagework as $item)
                                            <tr>
                                                    <td style="padding-left: 0; padding-right:40px; font-size:14px;">

                                                        <form action=" /stor/admin/update/{{$item->id}}" method="POST">
                                                            @csrf
                                                            {{method_field('PUT')}}
                                                            <div class="form-check">
                                                                    <input type="checkbox" name="status_1" value="Complete">
                                                                    <label>Complete</label>
                                                                    <br>
                                                                    <input type="checkbox" name="status_1" value="In Progress">
                                                                    <label>In Progress</label>
                                                                    <br>
                                        
                                                                    <input type="checkbox" name="status_1" value="Cancel">
                                                                    <label>Cancel</label>
                                                                    <br>
                                                                    
                                                                </div>
                                                            
                                                            <button type="submit" style="margin-left:40px" class="btn btn-link btn-sm">Update</button>
                                                        
                                                        </form>

                                                    </td>
                                                <td style="padding-right:40px;">Pro #: {{$item->pro_no}} <br> Pu #: {{$item->pu_no}} <br> Po #: {{$item->po_no}} <br> Barcode: {{$item->barcode}}</td>
                                                <td>{{$item->work_status}}</td>
                                                <td>{{$item->company}}</td>
                                                <td>{{$item->user_id}}</td>
                                                <td>{{$item->sku}}</td>
                                                <td>{{$item->description}}</td>
                                                <td>{{$item->inb_carton}}</td>
                                                <td>{{$item->inb_case}}</td>
                                                <td>{{$item->inb_item}}</td>
                                                <td>{{$item->inb_tot_qty}}</td>
                                                <td>{{$item->out_carton}}</td>
                                                <td>{{$item->out_case}}</td>
                                                <td>{{$item->out_item}}</td>
                                                <td>{{$item->out_tot_qty}}</td>
                                                <td>{{$item->elim_carton}}</td>
                                                <td>{{$item->elim_case}}</td>
                                                <td>{{$item->elim_item}}</td>
                                                <td>{{$item->elim_tot_qty}}</td>
                                                <td>{{$item->building}}</td>
                                                <td>{{$item->row_}}</td>
                                                <td>{{$item->column_}}</td>
                                                <td>{{$item->created_at->format('H:i:s m/d/y')}}</td>
                                                <td>{{$item->updated_at->format('H:i:s m/d/y')}}</td>
                                                




                                                </tr>
                                            @endforeach
                                        </table>
                                        @else
                                            <p>You have no requests.</p>
                                        @endif
                                </div>
                            </div>  
                            <div role="tabpanel" class="tab-pane fade" id="account">
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
                                                        <a href="" href="" class="editusername" id=""><i class="fas fa-pencil-alt"></i></a>
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
                                                        <input type="password" style="border:none;" value={{auth()->user()->password}}/>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <a href=""  class="editpass" id=""><i class="fas fa-pencil-alt"></i></a>
                                                    </div>
                        
                                                </div>
                                        </div>

                                        <div class="container-fluid px-5 mt-4" style="border: solid 1px #dee2e6; border-radius: 10px">
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
                                                        <a href="" href="" class="editcompanyname" id=""><i class="fas fa-pencil-alt"></i></a>
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
                                                        <h5>{{auth()->user()->street_address.' '.auth()->user()->city.', '.auth()->user()->state. ' '.auth()->user()->zip}}</h5>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <a href=""  class="editaddress" id=""><i class="fas fa-pencil-alt"></i></a>
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
