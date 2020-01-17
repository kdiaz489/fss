@extends('layouts.admindashlte')

@section('main-sidebar')
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar bg-denim elevation-4">
                <!-- Brand Logo -->
                <a href="#" class="brand-link justify-content-center border-0">
                  <img src="{{asset('img/fss-white.svg')}}" alt="AdminLTE Logo" class="brand-image" width="100px" height="80px" style="max-height:27px; width:auto">
                  <span class="brand-text font-weight-light text-white">Admin Dashboard</span>
                </a>
          
                <!-- Sidebar -->
                <div class="sidebar">
          
          
                  <!-- Sidebar Menu -->
                  <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                      <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
          
          
                      <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white">
          
                          <i class="nav-icon fas fa-box-open"></i>
                          <p>
                            Fulfilment
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
          
                          <li class="nav-item">
                            <a href="/dashboard/admin/fulfillment" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Fulfillment Orders</p>
                            </a>
                          </li>
                        </ul>
                      </li>
          
                      <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link text-white shadow-sm" style="background-color: #3b679c">
                          <i class="nav-icon fas fa-warehouse"></i>
                          <p>
                            Storage
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="/dashboard/admin/inventory" class="nav-link text-gunmetal shadow-sm bg-whitewash">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>All Inventory</p>
                            </a>
                          </li>
          
                        </ul>
                      </li>
                      <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white">
                          <i class="nav-icon fas fa-shipping-fast"></i>
                          <p>
                            Shipments
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="/dashboard" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>All Shipments</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white">
                          <i class="nav-icon fas fa-edit"></i>
                          <p>
                            Orders
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="/dashboard/admin/orders" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Storage Orders</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="nav-item has-treeview">
                            <a href="#" class="nav-link text-white">
                              <i class="nav-icon fas fa-users"></i>
                              <p>
                                Users
                                <i class="fas fa-angle-left right"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="/dashboard/admin/users" class="nav-link text-white">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                  <p>Manage Users</p>
                                </a>
                              </li>
                            </ul>
                          </li>
                      <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white">
          
                          <i class="nav-icon fas fa-user-alt"></i>
                          <p>
                            {{auth()->user()->name}} 
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="/dashboard/admin/account" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Account Details</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('logout') }}" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                              <i class="fas fa-angle-right nav-icon"></i>
                              {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                            </form>
                          </li>
          
          
                        </ul>
                      </li>
          
          
          
                    </ul>
                  </nav>
                  <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
              </aside>
@endsection

@section('breadcrumb')
All Inventory
@endsection

@section('content')

<!-- Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" form="pick-form" class="btn btn-primary remove-submit">Remove</button>
        </div>
      </div>
    </div>
  </div>


<div class="container-fluid dashboard-container w-95 p-0 m-auto">

    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

</div>

@if (count($users) > 0)

<div class="w-95 m-auto mb-5">
        <div class="dropdown mb-3">
                <button onclick="myFunction()" class="btn btn-secondary bg-denim border-0 show-dropdown-btn rounded-0">Customers <i class="fas fa-caret-down"></i></button>
                <div id="myDropdown" class="dropdown-content scrollable-menu">
                  <input type="text" class="py-2" placeholder="Search.." onfocus="this.value=''" id="myInput" onkeyup="filterFunction()">
                        @foreach ($users as $user)
                            @if ($loop->first)
                                <a class="p-3" id="{{$user->id . 'tab'}}" data-toggle="tab" href="#{{'user_' . $user->id}}" role="tab" aria-selected="false">{{$user->company_name}}</a>
                            @else
                                <a class="p-3" id="{{$user->id . 'tab'}}" data-toggle="tab" href="#{{'user_' . $user->id}}" role="tab" aria-selected="false">{{$user->company_name}}</a>
                            @endif
                    @endforeach
                </div>
        </div>
</div>




<div class="tab-content w-95 m-auto" id="myTabContent">
@foreach ($users as $user)

@if ($loop->first)
<div class="tab-pane fade show active" id="{{'user_' . $user->id}}">



        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

            <h2 class="font-weight-light bg-whitewash mb-4 p-1">{{$user->company_name . ' - Inventory'}}</h2>
            <h3 class="font-weight-light">Product On Pallets</h3>

            @if(count($user->pallets->all()) > 0)
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th width="2%"></th>
                        <th width="10%">Sku</th>
                        <th width="10%">Date Created</th>
                        <th width="10%">Quantity</th>
                        <th width="10%">Status</th>
                        <th width="10%">Location</th>
                        <th width="10%"></th>

                    </tr>
                </thead>
                    @foreach($user->pallets->all() as $pallet)
                    <tr>
                        <td><button type="button" class="btn text-denim toggle-{{$pallet->id}}"
                                id="toggle-details-pallet-{{$pallet->id}}" data-toggle="collapse"
                                data-target="#details-pallet-{{$pallet->id}}" aria-expanded="false" aria-controls="details"
                                data-delay="0"><i class="fas fa-plus"></i></button></td>

                        <td>{{$pallet->sku}}</td>
                        <td>{{date('m/d/y', strtotime($pallet->created_at))}}</td>
                        <td>{{$pallet->total_qty}}</td>
                        <td>{{$pallet->status}}</td>
                        <td>N/A</td>
                        <td>
                            <div style="margin-left: 30%">
                                
                                <a href="/editpallet/{{$pallet->id}}" class="float-left"
                                    style="margin-right:1%">
                                    <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                </a>

                                

                                <form action="/removepallet/{{$pallet->id}}" method="POST" class="float-left">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-link text-danger btn-sm">Remove</button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @if($pallet->basic_units->all())
                    @foreach ($pallet->basic_units->all() as $unit)

                    <tr>
                        <td class="py-0 border-0"></td>
                        <td class="py-0 border-0" colspan="12">
                            <div id="details-pallet-{{$pallet->id}}" class="accordion-body details collapse">
                                <table class="table table-sm bg-whitewash">
                                    <thead>
                                        <tr>
                                            <th width="10%">SKU</th>
                                            <th width="10%">Description</th>
                                            <th width="10%">UPC</th>
                                            <th width="10%">Container Type</th>
                                            <th width="10%">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$unit->sku}}</td>
                                            <td>{{$unit->description}}</td>
                                            <td>{{$unit->upc}}</td>
                                            <td>Loose Item</td>
                                            <td>{{$unit->pivot->quantity}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                    @if($pallet->cartons->all())
                    @foreach ($pallet->cartons->all() as $carton)

                    <tr>
                        <td class="py-0 border-0"></td>
                        <td class="py-0 border-0" colspan="12">
                            <div id="details-pallet-{{$pallet->id}}" class="accordion-body details collapse">
                                <table class="table table-sm bg-whitewash">
                                    <thead>
                                        <tr>
                                            <th width="10%">SKU</th>
                                            <th width="10%">Description</th>
                                            <th width="10%">UPC</th>
                                            <th width="10%">Container Type</th>
                                            <th width="10%">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$carton->sku}}</td>
                                            <td>{{$carton->description}}</td>
                                            <td>{{$carton->upc}}</td>
                                            <td>Carton</td>
                                            <td>{{$carton->pivot->quantity}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                    @if($pallet->kits->all())
                    @foreach ($pallet->kits->all() as $kit)
                    <tr>
                        <td class="py-0 border-0"></td>
                        <td class="py-0 border-0" colspan="12">
                            <div id="details-pallet-{{$pallet->id}}" class="accordion-body details collapse">
                                <table class="table table-sm bg-whitewash">
                                    <thead>
                                        <tr>
                                            <th width="10%">SKU</th>
                                            <th width="10%">Description</th>
                                            <th width="10%">UPC</th>
                                            <th width="10%">Container Type</th>
                                            <th width="10%">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$kit->sku}}</td>
                                            <td>{{$kit->description}}</td>
                                            <td>{{$kit->upc}}</td>
                                            <td>Kit</td>
                                            <td>{{$kit->pivot->quantity}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif


                    @if($pallet->cases->all())
                    @foreach ($pallet->cases->all() as $case)
                    <tr>
                        <td class="py-0 border-0"></td>
                        <td class="py-0 border-0" colspan="12">
                            <div id="details-pallet-{{$pallet->id}}" class="accordion-body details collapse">
                                <table class="table table-sm bg-whitewash">
                                    <thead>
                                        <tr>
                                            <th width="10%">SKU</th>
                                            <th width="10%">Description</th>
                                            <th width="10%">UPC</th>
                                            <th width="10%">Container Type</th>
                                            <th width="10%">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$case->sku}}</td>
                                            <td>{{$case->description}}</td>
                                            <td>{{$case->upc}}</td>
                                            <td>Case</td>
                                            <td>{{$case->pivot->quantity}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                    @endforeach
                </table>
            </div>
            @else
            <p>You have 0 pallets.</p>
            @endif

            <h3 class="font-weight-light">Product In Cartons</h3>

            @if(count($user->cartons->all()) > 0)
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th width="2%"></th>
                        <th width="10%">Sku</th>
                        <th width="10%">Date Created</th>
                        <th width="10%">Quantity</th>
                        <th width="10%">Status</th>
                        <th width="10%">Location</th>
                        <th width="10%"></th>

                    </tr>
                    </thead>
                    @foreach($user->cartons->all() as $carton)
                    <tr>
                        <td><button type="button" class="btn text-denim toggle-{{$carton->id}}"
                                id="toggle-details-carton-{{$carton->id}}" data-toggle="collapse"
                                data-target="#details-carton-{{$carton->id}}" aria-expanded="false" aria-controls="details"
                                data-delay="0"><i class="fas fa-plus"></i></button>
                        </td>

                        <td>{{$carton->sku}}</td>
                        <td>{{date('m/d/y', strtotime($carton->created_at))}}</td>
                        <td>{{$carton->total_qty}}</td>
                        <td>N/A</td>
                        
                        <td>
                            <div style="margin-left: 30%">
                            
                                <a href="/editcarton/{{$carton->id}}" class="float-left"
                                    style="margin-right:1%">
                                    <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                </a>

                                <form action="/removecarton/{{$carton->id}}" method="POST" class="float-left">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-link text-danger btn-sm">Remove</button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @if($carton->basic_units->all())
                    @foreach ($carton->basic_units->all() as $unit)

                    <tr>
                        <td class="py-0 border-0"></td>
                        <td class="py-0 border-0" colspan="12">
                            <div id="details-carton-{{$carton->id}}" class="accordion-body details collapse">
                                <table class="table table-sm bg-whitewash">
                                    <thead>
                                        <tr>
                                            <th width="10%">SKU</th>
                                            <th width="10%">Description</th>
                                            <th width="10%">UPC</th>
                                            <th width="10%">Container Type</th>
                                            <th width="10%">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$unit->sku}}</td>
                                            <td>{{$unit->description}}</td>
                                            <td>{{$unit->upc}}</td>
                                            <td>Loose Item</td>
                                            <td>{{$unit->pivot->quantity}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                    @if($carton->kits->all())
                    @foreach ($carton->kits->all() as $kit)
                    <tr>
                        <td class="py-0 border-0"></td>
                        <td class="py-0 border-0" colspan="12">
                            <div id="details-carton-{{$carton->id}}" class="accordion-body details collapse">
                                <table class="table table-sm bg-whitewash">
                                    <thead>
                                        <tr>
                                            <th width="10%">SKU</th>
                                            <th width="10%">Description</th>
                                            <th width="10%">UPC</th>
                                            <th width="10%">Container Type</th>
                                            <th width="10%">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$kit->sku}}</td>
                                            <td>{{$kit->description}}</td>
                                            <td>{{$kit->upc}}</td>
                                            <td>Kit</td>
                                            <td>{{$kit->pivot->quantity}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif


                    @if($carton->cases->all())
                    @foreach ($carton->cases->all() as $case)
                    <tr>
                        <td class="py-0 border-0"></td>
                        <td class="py-0 border-0" colspan="12">
                            <div id="details-carton-{{$carton->id}}" class="accordion-body details collapse">
                                <table class="table table-sm bg-whitewash">
                                    <thead>
                                        <tr>
                                            <th width="10%">SKU</th>
                                            <th width="10%">Description</th>
                                            <th width="10%">UPC</th>
                                            <th width="10%">Container Type</th>
                                            <th width="10%">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$case->sku}}</td>
                                            <td>{{$case->description}}</td>
                                            <td>{{$case->upc}}</td>
                                            <td>Case</td>
                                            <td>{{$case->pivot->quantity}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                    @endforeach
                </table>
            </div>
            @else
            <p>You have 0 cartons.</p>
            @endif


            <h3 class="font-weight-light">Product In Cases</h3>

            @if(count($user->cases->all()) > 0)
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th width="2%"></th>
                        <th width="10%">Sku</th>
                        <th width="10%">Description</th>
                        <th width="10%">UPC</th>
                        <th width="10%">Quantity</th>
                        <th width="10%">Qty/Case</th>
                        <th width="10%">Location</th>
                        <th width="10%"></th>

                    </tr>
                    </thead>
                    @foreach($user->cases->all() as $case)
                    <tr>
                        <td><button type="button" class="btn text-denim toggle-{{$case->id}}"
                                id="toggle-details-case-{{$case->id}}" data-toggle="collapse"
                                data-target="#details-case-{{$case->id}}" aria-expanded="false" aria-controls="details"
                                data-delay="0"><i class="fas fa-plus"></i></button></td>
                        <td>{{$case->sku}}</td>
                        <td>{{$case->description}}</td>
                        <td>{{$case->upc}}</td>
                        <td>{{$case->total_qty}}</td>
                        <td>{{$case->case_qty}}</td>
                        <td>N/A</td>
                        
                        <td>
                            <div style="margin-left: 30%">
                                
                                <a href="/editcase/{{$case->id}}" class="float-left" style="margin-right:1%">
                                    <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                </a>

                                <form action="/removecase/{{$case->id}}" method="POST" class="float-left"
                                    style="margin-right:1%">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-link text-danger btn-sm">Remove</button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @if($case->basic_units->all())
                    @foreach ($case->basic_units->all() as $unit)

                    <tr>
                        <td class="py-0 border-0"></td>
                        <td class="py-0 border-0" colspan="12">
                            <div id="details-case-{{$case->id}}" class="details collapse">
                                <table class="table table-sm bg-whitewash">
                                    <thead>
                                        <tr>
                                            <th width="10%">SKU</th>
                                            <th width="10%">Description</th>
                                            <th width="10%">UPC</th>
                                            <th width="10%">Container Type</th>
                                            <th width="10%">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$unit->sku}}</td>
                                            <td>{{$unit->description}}</td>
                                            <td>{{$unit->upc}}</td>
                                            <td>Loose Item</td>
                                            <td>{{$unit->pivot->quantity}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                    @if($case->kits->all())
                    @foreach ($case->kits->all() as $kit)
                    <tr>
                        <td class="py-0 border-0"></td>
                        <td class="py-0 border-0" colspan="12">
                            <div id="details-case-{{$case->id}}" class="details collapse">
                                <table class="table table-sm bg-whitewash">
                                    <thead>
                                        <tr>
                                            <th width="10%">SKU</th>
                                            <th width="10%">Description</th>
                                            <th width="10%">UPC</th>
                                            <th width="10%">Container Type</th>
                                            <th width="10%">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$kit->sku}}</td>
                                            <td>{{$kit->description}}</td>
                                            <td>{{$kit->upc}}</td>
                                            <td>Kit</td>
                                            <td>{{$kit->pivot->quantity}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    @endforeach
                </table>
            </div>
            @else
            <p>You have 0 cases.</p>
            @endif


            <h3 class="font-weight-light">Product In Kits</h3>

            @if(count($user->kits->all()) > 0)
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th width="2%"></th>
                        <th width="10%">Sku</th>
                        <th width="10%">Description</th>
                        <th width="10%">UPC</th>
                        <th width="10%">Quantity</th>
                        <th width="10%">Location</th>
                        <th width="10%"></th>
                    </tr>
                    </thead>
                    @foreach($user->kits->all() as $kit)
                    <tr>
                        <td><button type="button" class="btn text-denim toggle-{{$kit->id}}"
                                id="toggle-details-kit-{{$kit->id}}" data-toggle="collapse"
                                data-target="#details-kit-{{$kit->id}}" aria-expanded="false" aria-controls="details"
                                data-delay="0"><i class="fas fa-plus"></i></button></td>
                        <td>{{$kit->sku}}</td>
                        <td>{{$kit->description}}</td>
                        <td>{{$kit->upc}}</td>
                        <td>{{$kit->total_qty}}</td>
                        <td>N/A</td>
                        <td>

                            <div style="margin-left: 30%">
                                
                                <a href="/editkit/{{$kit->id}}" class="float-left" style="margin-right:1%">
                                    <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                </a>

                                <form action="/removekit/{{$kit->id}}" method="POST" class="float-left">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-link text-danger btn-sm">Remove</button>
                                </form>

                            </div>
                        </td>
                    </tr>

                    @if($kit->basic_units->all())
                    @foreach ($kit->basic_units->all() as $unit)

                    <tr>
                        <td class="py-0 border-0"></td>
                        <td class="py-0 border-0" colspan="12">
                            <div id="details-kit-{{$kit->id}}" class="details collapse">
                                <table class="table table-sm bg-whitewash">
                                    <thead>
                                        <tr>
                                            <th width="10%">SKU</th>
                                            <th width="10%">Description</th>
                                            <th width="10%">UPC</th>
                                            <th width="10%">Container Type</th>
                                            <th width="10%">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$unit->sku}}</td>
                                            <td>{{$unit->description}}</td>
                                            <td>{{$unit->upc}}</td>
                                            <td>Loose Item</td>
                                            <td>{{$unit->pivot->quantity}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>


                    </tr>
                    @endforeach
                    @endif

                    @endforeach
                </table>
            </div>
            @else
            <p>You have 0 kits.</p>
            @endif



            <h3 class="font-weight-light">Units</h3>
            @if(count($user->basic_units->all()) > 0)
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th width="10%">Sku</th>
                        <th width="10%">Description</th>
                        <th width="10%">UPC</th>
                        <th width="10%">Pallet Qty</th>
                        <th width="10%">Carton Qty</th>
                        <th width="10%">Case Qty</th>
                        <th width="10%">Kit Qty</th>
                        <th width="10%">Loose Item Qty</th>
                        <th width="10%">Total Qty</th>
                        <th width="10%"></th>

                    </tr>
                    </thead>
                    @foreach($user->basic_units->all() as $unit)
                    <tr>
                        <td>{{$unit->sku}}</td>
                        <td>{{$unit->description}}</td>
                        <td>{{$unit->upc}}</td>
                        <td>{{$unit->pallet_qty}}</td>
                        <td>{{$unit->carton_qty}}</td>
                        <td>{{$unit->case_qty}}</td>
                        <td>{{$unit->kit_qty}}</td>
                        <td>{{$unit->loose_item_qty}}</td>
                        <td>{{$unit->total_qty}}</td>
                        <td>
                            <div style="margin-left: 30%">
                                
                                <a href="/editbasicunit/{{$unit->id}}" class="float-left"
                                    style="margin-right:1%">
                                    <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                </a>

                                <form action="/removebasicunit/{{$unit->id}}" method="POST" class="float-left"
                                    style="margin-right:1%">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-link text-danger btn-sm">Remove</button>
                                </form>

                            </div>
                        </td>

                    </tr>
                    @endforeach
                </table>
            </div>
            @else
            <p>You have 0 units.</p>
            @endif
        
</div>    

@else
<div class="tab-pane fade" id="{{'user_' . $user->id}}" role="tabpanel" aria-labelledby="{{$user->id . 'tab'}}">



            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
                <h2 class="font-weight-light bg-whitewash mb-4 p-1">{{$user->company_name . ' - Inventory'}}</h2>
                <h3 class="font-weight-light">Product On Pallets</h3>

                @if(count($user->pallets->all()) > 0)
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th width="2%"></th>
                            <th width="10%">Sku</th>
                            <th width="10%">Date Created</th>
                            <th width="10%">Quantity</th>
                            <th width="10%">Location</th>
                            <th width="10%"></th>

                        </tr>
                    </thead>
                        @foreach($user->pallets->all() as $pallet)
                        <tr>
                            <td><button type="button" class="btn text-denim toggle-{{$pallet->id}}"
                                    id="toggle-details-pallet-{{$pallet->id}}" data-toggle="collapse"
                                    data-target="#details-pallet-{{$pallet->id}}" aria-expanded="false" aria-controls="details"
                                    data-delay="0"><i class="fas fa-plus"></i></button></td>

                            <td>{{$pallet->sku}}</td>
                            <td>{{date('m/d/y', strtotime($pallet->created_at))}}</td>
                            <td>{{$pallet->total_qty}}</td>
                            <td>N/A</td>
                            <td>
                                <div style="margin-left: 30%">
                                    
                                    <a href="/editpallet/{{$pallet->id}}" class="float-left"
                                        style="margin-right:1%">
                                        <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                    </a>

                                <a href="/getpallet/{{$pallet->id}}" class="float-left pick-pallet"
                                        style="margin-right:1%">
                                        <button class="btn btn-link text-success btn-sm" type="button">Pick</button>
                                    </a>

                                    <form action="/removepallet/{{$pallet->id}}" method="POST" class="float-left">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-link text-danger btn-sm">Remove</button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @if($pallet->basic_units->all())
                        @foreach ($pallet->basic_units->all() as $unit)

                        <tr>
                            <td class="py-0 border-0"></td>
                            <td class="py-0 border-0" colspan="12">
                                <div id="details-pallet-{{$pallet->id}}" class="accordion-body details collapse">
                                    <table class="table table-sm bg-ghostwhite">
                                        <thead>
                                            <tr>
                                                <th width="10%">SKU</th>
                                                <th width="10%">Description</th>
                                                <th width="10%">UPC</th>
                                                <th width="10%">Container Type</th>
                                                <th width="10%">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$unit->sku}}</td>
                                                <td>{{$unit->description}}</td>
                                                <td>{{$unit->upc}}</td>
                                                <td>Loose Item</td>
                                                <td>{{$unit->pivot->quantity}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif

                        @if($pallet->cartons->all())
                        @foreach ($pallet->cartons->all() as $carton)

                        <tr>
                            <td class="py-0 border-0"></td>
                            <td class="py-0 border-0" colspan="12">
                                <div id="details-pallet-{{$pallet->id}}" class="accordion-body details collapse">
                                    <table class="table table-sm bg-ghostwhite">
                                        <thead>
                                            <tr>
                                                <th width="10%">SKU</th>
                                                <th width="10%">Description</th>
                                                <th width="10%">UPC</th>
                                                <th width="10%">Container Type</th>
                                                <th width="10%">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$carton->sku}}</td>
                                                <td>{{$carton->description}}</td>
                                                <td>{{$carton->upc}}</td>
                                                <td>Carton</td>
                                                <td>{{$carton->pivot->quantity}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif

                        @if($pallet->kits->all())
                        @foreach ($pallet->kits->all() as $kit)
                        <tr>
                            <td class="py-0 border-0"></td>
                            <td class="py-0 border-0" colspan="12">
                                <div id="details-pallet-{{$pallet->id}}" class="accordion-body details collapse">
                                    <table class="table table-sm bg-ghostwhite">
                                        <thead>
                                            <tr>
                                                <th width="10%">SKU</th>
                                                <th width="10%">Description</th>
                                                <th width="10%">UPC</th>
                                                <th width="10%">Container Type</th>
                                                <th width="10%">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$kit->sku}}</td>
                                                <td>{{$kit->description}}</td>
                                                <td>{{$kit->upc}}</td>
                                                <td>Kit</td>
                                                <td>{{$kit->pivot->quantity}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif


                        @if($pallet->cases->all())
                        @foreach ($pallet->cases->all() as $case)
                        <tr>
                            <td class="py-0 border-0"></td>
                            <td class="py-0 border-0" colspan="12">
                                <div id="details-pallet-{{$pallet->id}}" class="accordion-body details collapse">
                                    <table class="table table-sm bg-ghostwhite">
                                        <thead>
                                            <tr>
                                                <th width="10%">SKU</th>
                                                <th width="10%">Description</th>
                                                <th width="10%">UPC</th>
                                                <th width="10%">Container Type</th>
                                                <th width="10%">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$case->sku}}</td>
                                                <td>{{$case->description}}</td>
                                                <td>{{$case->upc}}</td>
                                                <td>Case</td>
                                                <td>{{$case->pivot->quantity}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif

                        @endforeach
                    </table>
                </div>
                @else
                <p>You have 0 pallets.</p>
                @endif

                <h3 class="font-weight-light">Product In Cartons</h3>

                @if(count($user->cartons->all()) > 0)
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th width="2%"></th>
                            <th width="10%">Sku</th>
                            <th width="10%">Date Created</th>
                            <th width="10%">Quantity</th>
                            <th width="10%">Location</th>
                            <th width="10%"></th>

                        </tr>
                        </thead>
                        @foreach($user->cartons->all() as $carton)
                        <tr>
                            <td><button type="button" class="btn text-denim toggle-{{$carton->id}}"
                                    id="toggle-details-carton-{{$carton->id}}" data-toggle="collapse"
                                    data-target="#details-carton-{{$carton->id}}" aria-expanded="false" aria-controls="details"
                                    data-delay="0"><i class="fas fa-plus"></i></button></td>

                            <td>{{$carton->sku}}</td>
                            <td>{{date('m/d/y', strtotime($carton->created_at))}}</td>
                            <td>{{$carton->total_qty}}</td>
                            <td>N/A</td>
                            <td>
                                <div style="margin-left: 30%">
                                    
                                    <a href="/editcarton/{{$carton->id}}" class="float-left"
                                        style="margin-right:1%">
                                        <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                    </a>

                                    <form action="/removecarton/{{$carton->id}}" method="POST" class="float-left">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-link text-danger btn-sm">Remove</button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @if($carton->basic_units->all())
                        @foreach ($carton->basic_units->all() as $unit)

                        <tr>
                            <td class="py-0 border-0"></td>
                            <td class="py-0 border-0" colspan="12">
                                <div id="details-carton-{{$carton->id}}" class="accordion-body details collapse">
                                    <table class="table table-sm bg-ghostwhite">
                                        <thead>
                                            <tr>
                                                <th width="10%">SKU</th>
                                                <th width="10%">Description</th>
                                                <th width="10%">UPC</th>
                                                <th width="10%">Container Type</th>
                                                <th width="10%">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$unit->sku}}</td>
                                                <td>{{$unit->description}}</td>
                                                <td>{{$unit->upc}}</td>
                                                <td>Loose Item</td>
                                                <td>{{$unit->pivot->quantity}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif

                        @if($carton->kits->all())
                        @foreach ($carton->kits->all() as $kit)
                        <tr>
                            <td class="py-0 border-0"></td>
                            <td class="py-0 border-0" colspan="12">
                                <div id="details-carton-{{$carton->id}}" class="accordion-body details collapse">
                                    <table class="table table-sm bg-ghostwhite">
                                        <thead>
                                            <tr>
                                                <th width="10%">SKU</th>
                                                <th width="10%">Description</th>
                                                <th width="10%">UPC</th>
                                                <th width="10%">Container Type</th>
                                                <th width="10%">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$kit->sku}}</td>
                                                <td>{{$kit->description}}</td>
                                                <td>{{$kit->upc}}</td>
                                                <td>Kit</td>
                                                <td>{{$kit->pivot->quantity}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif


                        @if($carton->cases->all())
                        @foreach ($carton->cases->all() as $case)
                        <tr>
                            <td class="py-0 border-0"></td>
                            <td class="py-0 border-0" colspan="12">
                                <div id="details-carton-{{$carton->id}}" class="accordion-body details collapse">
                                    <table class="table table-sm bg-ghostwhite">
                                        <thead>
                                            <tr>
                                                <th width="10%">SKU</th>
                                                <th width="10%">Description</th>
                                                <th width="10%">UPC</th>
                                                <th width="10%">Container Type</th>
                                                <th width="10%">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$case->sku}}</td>
                                                <td>{{$case->description}}</td>
                                                <td>{{$case->upc}}</td>
                                                <td>Case</td>
                                                <td>{{$case->pivot->quantity}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif

                        @endforeach
                    </table>
                </div>
                @else
                <p>You have 0 cartons.</p>
                @endif


                <h3 class="font-weight-light">Product In Cases</h3>

                @if(count($user->cases->all()) > 0)
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                        <tr>
                            <th width="2%"></th>
                            <th width="5%">SKU</th>
                            <th width="10%">Description</th>
                            <th width="5%">UPC</th>
                            <th width="3%">Total</th>
                            <th width="3%">Pallet</th>
                            <th width="3%">Shelf</th>
                            <th width="5%">Location</th>
                            <th width="5%">Lot #</th>
                            <th width="3%"></th>
                        </tr>
                        </thead>
                        @foreach($user->cases->all() as $case)
                        <tr>
                            <td class="text-center"><button type="button" class="btn btn-sm text-denim toggle-{{$case->id}}"
                                    id="toggle-details-case-{{$case->id}}" data-toggle="collapse"
                                    data-target="#details-case-{{$case->id}}" aria-expanded="false" aria-controls="details"
                                    data-delay="0"><i class="fas fa-plus"></i></button></td>
                            <td contenteditable="false" class="sku">{{$case->sku}}</td>
                            <td contenteditable="false" class="desc">{{$case->description}}</td>
                            <td contenteditable="false" class="upc">{{$case->upc}}</td>
                            <td contenteditable="false" class="total_qty">{{$case->total_qty}}</td>
                            <td contenteditable="false" class="pallet_qty">{{$case->case_pallet_qty}}</td>
                            <td contenteditable="false" class="shelf_qty">{{$case->case_shelf_qty}}</td>
                            <td contenteditable="false" class="location">{{$case->location}}</td>
                            <td contenteditable="false" class="lot_num">{{$case->lot_num}}</td>
                            <td>
                                    <button id="case-{{$case->id}}" class="btn btn-link text-success btn-sm update-case d-none"><i class="far fa-check-circle fa-lg"></i></button>
                                    <button class="btn btn-link text-denim btn-sm enable-modify d-inline"><i class="far fa-edit fa-lg"></i></button>
                                    <form action="/removecase/{{$case->id}}" method="POST" class="d-inline"
                                        style="margin-right:1%">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-link text-danger btn-sm d-inline"><i class="far fa-trash-alt fa-lg"></i></button>
                                    </form>
                            </td>
                        </tr>
                        @if($case->basic_units->all())
                        @foreach ($case->basic_units->all() as $unit)

                        <tr>
                            <td class="p-0 border-0"></td>
                            <td class="p-0 border-0" colspan="12">
                                <div id="details-case-{{$case->id}}" class="details collapse">
                                    <table class="table table-sm bg-ghostwhite">
                                        <thead>
                                            <tr>
                                                <th width="5%">SKU</th>
                                                <th width="10%">Description</th>
                                                <th width="5%">UPC</th>
                                                <th width="5%">Container Type</th>
                                                <th width="5%">Qty/Case</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$unit->sku}}</td>
                                                <td>{{$unit->description}}</td>
                                                <td>{{$unit->upc}}</td>
                                                <td>Basic Unit</td>
                                                <td>{{$unit->pivot->quantity}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif

                        @if($case->kits->all())
                        @foreach ($case->kits->all() as $kit)
                        <tr>
                            <td class="p-0 border-0"></td>
                            <td class="p-0 border-0" colspan="12">
                                <div id="details-case-{{$case->id}}" class="details collapse">
                                    <table class="table table-sm bg-ghostwhite">
                                        <thead>
                                            <tr>
                                                <th width="10%">SKU</th>
                                                <th width="10%">Description</th>
                                                <th width="10%">UPC</th>
                                                <th width="10%">Container Type</th>
                                                <th width="10%">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$kit->sku}}</td>
                                                <td>{{$kit->description}}</td>
                                                <td>{{$kit->upc}}</td>
                                                <td>Kit</td>
                                                <td>{{$kit->pivot->quantity}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        @endforeach
                    </table>
                </div>
                @else
                <p>You have 0 cases.</p>
                @endif


                <h3 class="font-weight-light">Product In Kits</h3>

                @if(count($user->kits->all()) > 0)
                <div class="table-responsive">
                    <table class="table table-sm table-bordered kits-table">
                        <thead>
                        <tr>
                            <th width="2%"></th>
                            <th width="5%">SKU</th>
                            <th width="10%">Description</th>
                            <th width="5%">UPC</th>
                            <th width="5%">Total</th>
                            <th width="5%">Location</th>
                            <th width="5%">Lot #</th>
                            <th width="3%"></th>
                        </tr>
                        </thead>
                        @foreach($user->kits->all() as $kit)
                        <tr>
                            <td class="text-center"><button type="button" class="btn btn-sm text-denim toggle-{{$kit->id}}"
                                    id="toggle-details-kit-{{$kit->id}}" data-toggle="collapse"
                                    data-target="#details-kit-{{$kit->id}}" aria-expanded="false" aria-controls="details"
                                    data-delay="0"><i class="fas fa-plus"></i></button></td>
                            <td contenteditable="false" class="sku">{{$kit->sku}}</td>
                            <td contenteditable="false" class="desc">{{$kit->description}}</td>
                            <td contenteditable="false" class="upc">{{$kit->upc}}</td>
                            <td contenteditable="false" class="total_qty">{{$kit->total_qty}}</td>
                            <td contenteditable="false" class="location">{{$kit->location}}</td>
                            <td contenteditable="false" class="lot_num">{{$kit->lot_num}}</td>
                            <td>
                                    <button id="kit-{{$kit->id}}" class="btn btn-link text-success btn-sm update-kit d-none"><i class="far fa-check-circle fa-lg"></i></button>
                                    <button class="btn btn-link text-denim btn-sm enable-modify d-inline"><i class="far fa-edit fa-lg"></i></button>
                                    <form action="/removekit/{{$kit->id}}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-link text-danger btn-sm d-inline"><i class="far fa-trash-alt fa-lg"></i></button>
                                    </form>

                            </td>
                        </tr>

                        @if($kit->basic_units->all())
                        @foreach ($kit->basic_units->sortByDesc('sku')->all() as $unit)

                        <tr>
                            <td class="p-0 border-0"></td>
                            <td class="p-0 border-0" colspan="12">
                                <div id="details-kit-{{$kit->id}}" class="details collapse">
                                    <table class="table table-sm bg-ghostwhite">
                                        <thead>
                                            <tr>
                                                <th width="10%">SKU</th>
                                                <th width="15%">Description</th>
                                                <th width="10%">UPC</th>
                                                <th width="5%">Container Type</th>
                                                <th width="5%">Qty/Kit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$unit->sku}}</td>
                                                <td>{{$unit->description}}</td>
                                                <td>{{$unit->upc}}</td>
                                                <td>Basic Unit</td>
                                                <td>{{$unit->pivot->quantity}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>


                        </tr>
                        @endforeach
                        @endif

                        @endforeach
                    </table>
                </div>
                @else
                <p>You have 0 kits.</p>
                @endif



                <h3 class="font-weight-light">Units</h3>
                @if(count($user->basic_units->all()) > 0)
                <div class="table-responsive">
                    <table class="table table-sm table-bordered units-table">
                        <thead>
                        <tr>
                            <th width="10%">SKU</th>
                            <th width="20%">Description</th>
                            <th width="10%">UPC</th>
                            <th width="5%">Pallet</th>
                            <th width="5%">Carton</th>
                            <th width="5%">Case</th>
                            <th width="5%">Kit</th>
                            <th width="5%">Loose</th>
                            <th width="5%">Total</th>
                            <th width="5%">Location</th>
                            <th width="5%">Lot #</th>
                            <th width="10%"></th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->basic_units->all() as $unit)
                        <tr>
                            <td contenteditable="false" class="sku">{{$unit->sku}}</td>
                            <td contenteditable="false" class="desc">{{$unit->description}}</td>
                            <td contenteditable="false" class="upc">{{$unit->upc}}</td>
                            <td contenteditable="false" class="pallet_qty">{{$unit->pallet_qty}}</td>
                            <td contenteditable="false" class="carton_qty">{{$unit->carton_qty}}</td>
                            <td contenteditable="false" class="case_qty">{{$unit->case_qty}}</td>
                            <td contenteditable="false" class="kit_qty">{{$unit->kit_qty}}</td>
                            <td contenteditable="false" class="loose_item_qty">{{$unit->loose_item_qty}}</td>
                            <td contenteditable="false" class="total_qty">{{$unit->total_qty}}</td>
                            <td contenteditable="false" class="location">{{$unit->location}}</td>
                            <td contenteditable="false" class="lot_num">{{$unit->lot_num}}</td>
                            <td>    
                                <button id="unit-{{$unit->id}}" class="btn btn-link text-success btn-sm update-unit d-none"><i class="far fa-check-circle fa-lg"></i></button>
                                <button class="btn btn-link text-denim btn-sm enable-modify d-inline"><i class="far fa-edit fa-lg"></i></button>
                                <form action="/removebasicunit/{{$unit->id}}" method="POST" class="d-inline"
                                    style="margin-right:1%">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-link text-danger btn-sm d-inline"><i class="far fa-trash-alt fa-lg"></i></button>
                                </form>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                @else
                <p>You have 0 units.</p>
                @endif
                             
            
</div>
@endif
@endforeach
</div>
@endif  
@endsection

@section('scripts')
<script>

function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
  }
  
  function filterFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    div = document.getElementById("myDropdown");
    a = div.getElementsByTagName("a");
    for (i = 0; i < a.length; i++) {
      txtValue = a[i].textContent || a[i].innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        a[i].style.display = "";
      } else {
        a[i].style.display = "none";
      }
    }
  }

$(document).ready(function(e){



$('.pick-pallet').on('click', function(e){
    e.preventDefault();
    var url = $(this).attr('href');
    var id = url.slice(16);
    $.ajax({
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        type: 'GET',
        url: url,
       
    })
    .done(function(data){
        $('.modal-header').prepend('<h5>Remove from Pallet</h5>')
        let pallet = data.pallet;
        console.log(pallet);
        let html='<form id="pick-form" class="pallet-' + pallet.id + '">';
        
        if(pallet.cases.length > 0){
            html += '';
                for(var i = 0; i < pallet.cases.length; i++){
                    html += '<div class="row mb-3"><div class="col-md-6">';
                    html += '<label class="font-weight-normal">SKU <input type="text" class="form-control" value="' + pallet.cases[i].sku + '" name="item[]" readonly></div></label>';
                    html += '<div class="col-md-6"><label class="font-weight-normal">Quantity <input type="number" name="item_qty[]" class="form-control" value="1"></label></div></div>';
                }
        }

        if(pallet.cartons.length > 0){
            html += '';
                for(var i = 0; i < pallet.cartons.length; i++){
                    html += '<div class="row"><div class="col-md-6">';
                    html += '<label class="font-weight-normal">SKU <input type="text" class="form-control" value="' + pallet.cartons[i].upc + '" name="item[] readonly"></div></label>';
                    html += '<div class="col-md-6"><label class="font-weight-normal"><input type="number" name="item_qty[]" class="form-control" value="1"></label></div>';

                }
        }
        
        html += '@csrf</form>';

        $('.modal-body').html(html);
        $('.modal').modal('show');

        
    })
    .fail(function(data){
        console.log('fail');
    });

});

$(document).on('submit', '#pick-form', function(e){
    e.preventDefault();

    var pallet_id = $('#pick-form').attr('class').slice(7);
    console.log(pallet_id);
    $.ajax({
        type: 'POST',
        url: '/pickfrompallet/' + pallet_id,
        data: $(this).serialize()

    })
    .done(function(data){
        $('.modal-body').html('<p class="text-success">You have successfully picked from this pallet.</p>');
        $('.modal').modal('show');
    })
    .fail(function(data){
        $('.modal-body').html('<p class="text-danger">You did not successfully pick from this pallet. Please try again.</p>');
        $('.modal').modal('show');
    });

});

$('.units-table').dataTable({
    'order': [[0, 'asc']],
    'columnDefs': [
    {'targets' : [3,4,5,6,7,8,9,10,11], 'orderable': false, 'bSort': false}
    ],
    paging: false,
    searching: false,
    info : false
});



$('.update-unit').on('click', function(e){
    e.preventDefault();
    var row = $(this).closest('tr');
    var submit = $(this);
    var sku = $(row).find('.sku').text();
    var desc = $(row).find('.desc').text();
    var upc = $(row).find('.upc').text();
    var pallet_qty = $(row).find('.pallet_qty').text();
    var carton_qty = $(row).find('.carton_qty').text();
    var case_qty = $(row).find('.case_qty').text();
    var kit_qty = $(row).find('.kit_qty').text();
    var loose_item_qty = $(row).find('.loose_item_qty').text();
    var total_qty = $(row).find('.total_qty').text();
    var location = $(row).find('.location').text();
    var lot_num = $(row).find('.lot_num').text();
    var id = $(this).attr('id');
    id = id.slice(5, id.length);
    console.log('id ' + id);

    var formData = new FormData();
    formData.append('sku', sku);
    formData.append('desc', desc);
    formData.append('upc', upc);
    formData.append('pallet_qty', pallet_qty);
    formData.append('carton_qty', carton_qty);
    formData.append('case_qty', case_qty);
    formData.append('kit_qty', kit_qty);
    formData.append('loose_item_qty', loose_item_qty);
    formData.append('total_qty',total_qty);
    formData.append('location',location);
    formData.append('lot_num',lot_num);
    formData.append('_token', '{{csrf_token()}}');
    formData.append('_method', 'PUT');

    $.ajax({
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        type: 'POST',
        url: '/admin/updatebasicunit/' + id,
        data: formData,
        processData: false,
        contentType: false,
    })
    .done(function(data){
        console.log('success');
        $(submit).removeClass('d-inline');
        $(submit).addClass('d-none');
    })
    .fail(function(data){
        console.log('fail');
    });
});

$('.update-case').on('click', function(e){
    e.preventDefault();
    var row = $(this).closest('tr');
    var submit = $(this);
    var sku = $(row).find('.sku').text();
    var desc = $(row).find('.desc').text();
    var upc = $(row).find('.upc').text();
    var pallet_qty = $(row).find('.pallet_qty').text();
    var shelf_qty = $(row).find('.shelf_qty').text();
    var total_qty = $(row).find('.total_qty').text();
    var location = $(row).find('.location').text();
    var lot_num = $(row).find('.lot_num').text();
    var id = $(this).attr('id');
    id = id.slice(5, id.length);
    console.log('id ' + id);

    var formData = new FormData();
    formData.append('sku', sku);
    formData.append('desc', desc);
    formData.append('upc', upc);
    formData.append('pallet_qty', pallet_qty);
    formData.append('shelf_qty', shelf_qty);
    formData.append('total_qty',total_qty);
    formData.append('location',location);
    formData.append('lot_num',lot_num);
    formData.append('_token', '{{csrf_token()}}');
    formData.append('_method', 'PUT');

    $.ajax({
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        type: 'POST',
        url: '/admin/updatecase/' + id,
        data: formData,
        processData: false,
        contentType: false,
    })
    .done(function(data){
        console.log('success');
        $(submit).removeClass('d-inline');
        $(submit).addClass('d-none');
    })
    .fail(function(data){
        console.log('fail');
    });
});

$('.update-unit').on('click', function(e){
    e.preventDefault();
    var row = $(this).closest('tr');
    var submit = $(this);
    var sku = $(row).find('.sku').text();
    var desc = $(row).find('.desc').text();
    var upc = $(row).find('.upc').text();
    var pallet_qty = $(row).find('.pallet_qty').text();
    var carton_qty = $(row).find('.carton_qty').text();
    var case_qty = $(row).find('.case_qty').text();
    var kit_qty = $(row).find('.kit_qty').text();
    var loose_item_qty = $(row).find('.loose_item_qty').text();
    var total_qty = $(row).find('.total_qty').text();
    var location = $(row).find('.location').text();
    var lot_num = $(row).find('.lot_num').text();
    var id = $(this).attr('id');
    id = id.slice(5, id.length);
    console.log('id ' + id);

    var formData = new FormData();
    formData.append('sku', sku);
    formData.append('desc', desc);
    formData.append('upc', upc);
    formData.append('pallet_qty', pallet_qty);
    formData.append('carton_qty', carton_qty);
    formData.append('case_qty', case_qty);
    formData.append('kit_qty', kit_qty);
    formData.append('loose_item_qty', loose_item_qty);
    formData.append('total_qty',total_qty);
    formData.append('location',location);
    formData.append('lot_num',lot_num);
    formData.append('_token', '{{csrf_token()}}');
    formData.append('_method', 'PUT');

    $.ajax({
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        type: 'POST',
        url: '/admin/updatebasicunit/' + id,
        data: formData,
        processData: false,
        contentType: false,
    })
    .done(function(data){
        console.log('success');
        $(submit).removeClass('d-inline');
        $(submit).addClass('d-none');
    })
    .fail(function(data){
        console.log('fail');
    });
});

$(document).on('click', '.enable-modify', function(e){
    e.preventDefault();
    var row = $(this).closest('tr');
    var update = $(this).prev().removeClass('d-none').addClass('d-inline');
    row.find('.sku').attr('contenteditable', true);
    row.find('.desc').attr('contenteditable', true);
    row.find('.upc').attr('contenteditable', true);
    row.find('.pallet_qty').attr('contenteditable', true);
    row.find('.shelf_qty').attr('contenteditable', true);
    row.find('.carton_qty').attr('contenteditable', true);
    row.find('.case_qty').attr('contenteditable', true);
    row.find('.kit_qty').attr('contenteditable', true);
    row.find('.loose_item_qty').attr('contenteditable', true);
    row.find('.total_qty').attr('contenteditable', true);
    row.find('.location').attr('contenteditable', true);
    row.find('.lot_num').attr('contenteditable', true);
    
    $(this).html('<i class="fas fa-ban fa-lg"></i>');
    $(this).removeClass('enable-modify');
    $(this).addClass('disable-modify');
    $(row).addClass('bg-ghostwhite');

});

$(document).on('click', '.disable-modify', function(e){
    e.preventDefault();
    console.log('disable');
    var row = $(this).closest('tr');
    var update = $(this).prev().removeClass('d-inline').addClass('d-none');
    row.find('.sku').attr('contenteditable', false);
    row.find('.desc').attr('contenteditable', false);
    row.find('.upc').attr('contenteditable', false);
    row.find('.pallet_qty').attr('contenteditable', false);
    row.find('.carton_qty').attr('contenteditable', false);
    row.find('.case_qty').attr('contenteditable', false);
    row.find('.kit_qty').attr('contenteditable', false);
    row.find('.loose_item_qty').attr('contenteditable', false);
    row.find('.total_qty').attr('contenteditable', false);
    row.find('.location').attr('contenteditable', false);
    row.find('.lot_num').attr('contenteditable', false);

    $(this).html('<i class="far fa-edit fa-lg"></i>');
    $(this).removeClass('disable-modify');
    $(this).addClass('enable-modify');
    $(row).removeClass('bg-ghostwhite');
});

$(".dropdown .dropdown-content a").on("click", function(){

   $(this).tab('show');
   $("#myDropdown").find(".active").removeClass("active");
   $("#myDropdown").find(".active").attr('aria-selected', false);
   $(this).addClass("active");
   $(this).attr('aria-selected', true);
});



$(document).click(function(event) {
  //if you click on anything except the modal itself or the "open modal" link, close the modal
  if (!$(event.target).closest("#myInput, .show-dropdown-btn").length) {
    $("body").find("#myDropdown").removeClass("show");
  }
});


});
  </script>
@endsection
