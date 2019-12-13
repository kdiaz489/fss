@extends('layouts.userdashlte')

@section('main-sidebar')
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar bg-denim elevation-4">
                <!-- Brand Logo -->
                <a href="#" class="brand-link justify-content-center border-0">
                  <img src="{{asset('img/fss-white.svg')}}" alt="AdminLTE Logo" class="brand-image" width="100px" height="80px" style="max-height:27px; width:auto">
                  <span class="brand-text font-weight-light text-white">Dashboard</span>
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
                            <a href="/createfilorder" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Create Manual Order</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/dashboard/user/fulfillment" class="nav-link text-white">
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
                            <a href="/dashboard/user/inventory" class="nav-link text-gunmetal bg-whitewash">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>All Inventory</p>
                            </a>
                          </li>
          
                          <li class="nav-item">
                            <a href="/dashboard/user/orders" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Storage Orders</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/basicunit" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Create Unit</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/createkit" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Create Kit</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/createcase" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Create Case</p>
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
                          <li class="nav-item">
                            <a href="/ship" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Get Quote</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/ship/book" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Book Shipment</p>
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
                            <a href="/createtransin" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Create Transfer In</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/createtransout" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Create Transfer Out</p>
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
                            <a href="/dashboard/user/account" class="nav-link text-white">
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
Inventory
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
                    <!--
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn bg-denim text-white dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-plus"></i> Create
                        </button>
                        <div class="dropdown-menu bg-whitewash" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="/basicunit">Units</a>
                            <a class="dropdown-item" href="/createkit">Kits</a>
                            <a class="dropdown-item" href="/createcase">Cases</a>
                        </div>
                    </div>
                -->

                    <p class="h1 font-weight-light">Product On Pallets</p>

                    @if(count($pallets) > 0)
                    <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                    <th width="10%"></th>
                                    <th width="10%">UPC</th>
                                    <th width="10%">Date Received</th>
                                    <th width="10%">Quantity</th>
                                    <th width="10%">Location</th>
                                    <th width="10%"></th>
        
                                </tr>
                        </thead>

                        @foreach($pallets as $pallet)
                        <tr>
                            <td><button type="button" class="btn text-denim toggle-{{$pallet->id}}" id="toggle-details{{$pallet->id}}" data-toggle="collapse" data-target="#details{{$pallet->id}}" aria-expanded="false" aria-controls="details" data-delay="0"><i class="fas fa-plus"></i></button></td>
                            <td>{{$pallet->upc}}</td>
                            <td>{{$pallet->created_at->format('m/d/y')}}</td>
                            <td>{{$pallet->total_qty}}</td>
                            <td>N/A</td>
                            <td>
                                <div style="margin-left: 30%">
                                    
                                    <a href="/editpallet/{{$pallet->id}}" class="float-left"
                                        style="margin-right:1%">
                                        <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                    </a>
                                    

                                    <a href="/viewpallet/{{$pallet->id}}" class="float-left" style="margin-right:1%">
                                        <button class="btn btn-link text-success btn-sm" type="button">View</button>
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
                                            <div id="details{{$pallet->id}}" class="accordion-body details collapse">
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
                                            <div id="details{{$pallet->id}}" class="accordion-body details collapse">
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
                                            <div id="details{{$pallet->id}}" class="accordion-body details collapse">
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
                                            <div id="details{{$pallet->id}}" class="accordion-body details collapse">
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

                    <p class="h1 font-weight-light">Product In Cartons</p>

                    @if(count($cartons) > 0)
                    <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th width="10%"></th>
                            <th width="10%">UPC</th>
                            <th width="10%">Date Received</th>
                            <th width="10%">Quantity</th>
                            <th width="10%">Location</th>
                            <th width="10%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cartons as $carton)
                        <tr>
                            <td><button type="button" class="btn text-denim toggle-{{$carton->id}}" id="toggle-details{{$carton->id}}" data-toggle="collapse" data-target="#details{{$carton->id}}" aria-expanded="false" aria-controls="details" data-delay="0"><i class="fas fa-plus"></i></button></td>
                            <td>{{$carton->upc}}</td>
                            <td>{{$carton->created_at->format('m/d/y')}}</td>
                            <td>{{$carton->total_qty}}</td>
                            <td>N/A</td>
                            <td>
                                <div style="margin-left: 30%">
                                
                                    <a href="/editcarton/{{$carton->id}}" class="float-left"
                                        style="margin-right:1%">
                                        <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                    </a>
                                        

                                    <a href="/viewcarton/{{$carton->id}}" class="float-left" style="margin-right:1%">
                                        <button class="btn btn-link text-success btn-sm" type="button">View</button>
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
                                            <div id="details{{$carton->id}}" class="accordion-body details collapse">
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
                                            <div id="details{{$carton->id}}" class="accordion-body details collapse">
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
                                            <div id="details{{$carton->id}}" class="accordion-body details collapse">
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
                    </tbody>
                    </table>
                    </div>
                    @else
                    <p>You have 0 cartons.</p>
                    @endif

                    <p class="h1 font-weight-light">Product In Cases</p>

                    @if(count($cases) > 0)
                    <div class="table-responsive">
                    <table class="table table-sm cases-table">
                        <thead>
                        <tr>
                            <th width="10%">Expand</th>
                            <th width="10%">Sku</th>
                            <th width="10%">Description</th>
                            <th width="10%">UPC</th>
                            <th width="10%">Quantity</th>
                            <th width="10%">Qty/Case</th>
                            <th width="10%">Location</th>
                            <th width="10%">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cases as $case)
                        <tr>
                            <td><button type="button" class="btn text-denim toggle-{{$case->id}}" id="toggle-details{{$case->id}}" data-toggle="collapse" data-target="#details{{$case->id}}" aria-expanded="false" aria-controls="details" data-delay="0"><i class="fas fa-plus"></i></button></td>
                            <td>{{$case->sku}}</td>
                            <td>{{$case->description}}</td>
                            <td>{{$case->upc}}</td>
                            <td>10</td>
                            <td>{{$case->case_qty}}</td>
                            <td>N/A</td>
                            <td>
                                <div style="margin-left: 30%">
                                
                                    <a href="/editcase/{{$case->id}}" class="float-left" style="margin-right:1%">
                                        <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                    </a>
                                        

                                    <a href="/viewcase/{{$case->id}}" class="float-left" style="margin-right:1%">
                                        <button class="btn btn-link text-success btn-sm" type="button">View</button>
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
                                        <div  id="details{{$case->id}}" class="details collapse">
                                                <table class="table table-sm bg-whitewash">
                                                        <thead>
                                                            <tr>
                                                                <th width="10%">SKU</th>
                                                                <th width="10%">Description</th>
                                                                <th width="10%">UPC</th>
                                                                <th width="10%">Container Type</th>
                                                                <th width="10%">Qty</th>
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
                                            <div id="details{{$case->id}}" class="details collapse">
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
                    </tbody>
                    </table>
                    </div>
                    @else
                    <p>You have 0 cases.</p>
                    @endif

                    <p class="h1 font-weight-light">Product In Kits</p>

                    @if(count($kits) > 0)
                    <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th width="10%"></th>
                            <th width="10%">Sku</th>
                            <th width="10%">Description</th>
                            <th width="10%">UPC</th>
                            <th width="10%">Quantity</th>
                            <th width="10%">Qty/Kit</th>
                            <th width="10%">Location</th>
                            <th width="10%"></th>
                        </tr>
                        </thead>
                        @foreach($kits as $kit)
                        <tr>
                            <td><button type="button" class="btn text-denim toggle-{{$kit->id}}" id="toggle-details{{$kit->id}}" data-toggle="collapse" data-target="#details{{$kit->id}}" aria-expanded="false" aria-controls="details" data-delay="0"><i class="fas fa-plus"></i></button></td>
                            <td>{{$kit->sku}}</td>
                            <td>{{$kit->description}}</td>
                            <td>{{$kit->upc}}</td>
                            <td>{{$kit->total_qty}}</td>
                            <td>{{$kit->kit_qty}}</td>
                            <td>N/A</td>
                            <td>

                                <div style="margin-left: 30%">
                                    
                                    <a href="/editkit/{{$kit->id}}" class="float-left" style="margin-right:1%">
                                        <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                    </a>
                                        
                                    <a href="/viewkit/{{$kit->id}}" class="float-left" style="margin-right:1%">
                                        <button class="btn btn-link text-success btn-sm" type="button">View</button>
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
                                        <div  id="details{{$kit->id}}" class="details collapse">
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
                                                                <td><{{$unit->upc}}/td>
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


                    <p class="h1 font-weight-light">Units</p>
                    @if(count($basic_units) > 0)
                    <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                        <tr>

                            <th width="10%">Sku</th>
                            <th width="10%">Description</th>
                            <th width="10%">Pallet Qty</th>
                            <th width="10%">Carton Qty</th>
                            <th width="10%">Case Qty</th>
                            <th width="10%">Kit Qty</th>
                            <th width="10%">Loose Qty</th>
                            <th width="10%">Total Qty On Hand</th>
                            <th width="10%"></th>

                        </tr>
                        </thead>
                        @foreach($basic_units as $unit)
                        <tr>
                            <td>{{$unit->sku}}</td>
                            <td>{{$unit->description}}</td>
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
                                        
                                    <a href="/viewbasicunit/{{$unit->id}}" class="float-left" style="margin-right:1%">
                                        <button class="btn btn-link text-success btn-sm" type="button">View</button>
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
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection