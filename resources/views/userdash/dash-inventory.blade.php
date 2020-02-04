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
                            <a href="/createcartonize" class="nav-link text-white">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Create Cartonize</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/createpalletize" class="nav-link text-white">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Create Palletize</p>
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
                            <a href="/dashboard/user/getquote" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Get Quote</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/dashboard/user/bookshipment" class="nav-link text-white">
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
                                <a href="/dashboard/user/fulfillment" class="nav-link text-white">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                    <p>Fulfillment Orders</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/user/orders" class="nav-link text-white">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                    <p>Storage Orders</p>
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

<!-- Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLongTitle">Import Units with CSV</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-secondary text-justify" role="alert">
                    <p>*Note: Prior to importing with your file, please confirm your data is not in scientific notation.</p>
                </div>
                <form action="/importinventory/{{auth()->user()->id}}" enctype="multipart/form-data" id="upload_csv_form" method="post">
                    @csrf
                    <input type="file" name="file" class="form-control-file" id="csv_file">
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary border-0" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary bg-denim border-0 submit_import_csv" form="upload_csv_form">Import</button>
            </div>
          </div>
        </div>
      </div>

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
                    
                    <a href="/inventory/export/{{auth()->user()->id}}" class="btn btn-link text-denim btn-sm ml-0 pl-0" role="button" aria-pressed="false"><i class="fas fa-file-export"></i> Export Inventory</a>

                    <a href="/template/export/{{auth()->user()->id}}" class="btn btn-link text-gunmetal btn-sm ml-0 pl-0" role="button" aria-pressed="false"><i class="fas fa-file-download"></i> Download CSV Template</a>


                    <p class="h1 font-weight-light">Product On Pallets</p>

                    @if(count($pallets) > 0)
                    <div class="table-responsive-md">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                    <th class="fit"></th>
                                    <th class="fit">UPC</th>
                                    <th class="fit">Date Received</th>
                                    <th class="fit">Quantity</th>
                                    <th class="fit">Location</th>
                                    
        
                                </tr>
                        </thead>

                        @foreach($pallets as $pallet)
                        <tr>
                            <td class="fit"><button type="button" class="btn text-denim toggle-{{$pallet->id}}" id="toggle-details-pallet-{{$pallet->id}}" data-toggle="collapse" data-target="#details-pallet-{{$pallet->id}}" aria-expanded="false" aria-controls="details" data-delay="0"><i class="fas fa-plus"></i></button></td>
                            <td class="fit">{{$pallet->upc}}</td>
                            <td class="fit">{{$pallet->created_at->format('m/d/y')}}</td>
                            <td class="fit">{{$pallet->total_qty}}</td>
                            <td class="fit">N/A</td>
                           
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
                                                                    <th class="fit">SKU</th>
                                                                    <th class="fit">Description</th>
                                                                    <th class="fit">UPC</th>
                                                                    <th class="fit">Container Type</th>
                                                                    <th class="fit">Quantity</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="fit">{{$unit->sku}}</td>
                                                                    <td class="fit">{{$unit->description}}</td>
                                                                    <td class="fit">{{$unit->upc}}</td>
                                                                    <td class="fit">Loose Item</td>
                                                                    <td class="fit">{{$unit->pivot->quantity}}</td>
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
                                                                    <th class="fit">SKU</th>
                                                                    <th class="fit">Description</th>
                                                                    <th class="fit">UPC</th>
                                                                    <th class="fit">Container Type</th>
                                                                    <th class="fit">Quantity</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="fit">{{$carton->sku}}</td>
                                                                    <td class="fit">{{$carton->description}}</td>
                                                                    <td class="fit">{{$carton->upc}}</td>
                                                                    <td class="fit">Carton</td>
                                                                    <td class="fit">{{$carton->pivot->quantity}}</td>
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
                                                                    <th class="fit">SKU</th>
                                                                    <th class="fit">Description</th>
                                                                    <th class="fit">UPC</th>
                                                                    <th class="fit">Container Type</th>
                                                                    <th class="fit">Quantity</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="fit">{{$kit->sku}}</td>
                                                                    <td class="fit">{{$kit->description}}</td>
                                                                    <td class="fit">{{$kit->upc}}</td>
                                                                    <td class="fit">Kit</td>
                                                                    <td class="fit">{{$kit->pivot->quantity}}</td>
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
                                                                    <th class="fit">SKU</th>
                                                                    <th class="fit">Description</th>
                                                                    <th class="fit">UPC</th>
                                                                    <th class="fit">Container Type</th>
                                                                    <th class="fit">Quantity</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="fit">{{$case->sku}}</td>
                                                                    <td class="fit">{{$case->description}}</td>
                                                                    <td class="fit">{{$case->upc}}</td>
                                                                    <td class="fit">Case</td>
                                                                    <td class="fit">{{$case->pivot->quantity}}</td>
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
                    <div class="table-responsive-md">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th class="fit"></th>
                            <th class="fit">UPC</th>
                            <th class="fit">Date Received</th>
                            <th class="fit">Quantity</th>
                            <th class="fit">Location</th>
                            <th class="fit"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cartons as $carton)
                        <tr>
                            <td class="fit"><button type="button" class="btn text-denim toggle-{{$carton->id}}" id="toggle-details-carton-{{$carton->id}}" data-toggle="collapse" data-target="#details-carton-{{$carton->id}}" aria-expanded="false" aria-controls="details" data-delay="0"><i class="fas fa-plus"></i></button></td>
                            <td class="fit">{{$carton->upc}}</td>
                            <td class="fit">{{$carton->created_at->format('m/d/y')}}</td>
                            <td class="fit">{{$carton->total_qty}}</td>
                            <td class="fit">N/A</td>
                            <td class="fit">
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
                                                                    <th class="fit">SKU</th>
                                                                    <th class="fit">Description</th>
                                                                    <th class="fit">UPC</th>
                                                                    <th class="fit">Container Type</th>
                                                                    <th class="fit">Quantity</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="fit">{{$unit->sku}}</td>
                                                                    <td class="fit">{{$unit->description}}</td>
                                                                    <td class="fit">{{$unit->upc}}</td>
                                                                    <td class="fit">Loose Item</td>
                                                                    <td class="fit">{{$unit->pivot->quantity}}</td>
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
                                                                    <th class="fit">SKU</th>
                                                                    <th class="fit">Description</th>
                                                                    <th class="fit">UPC</th>
                                                                    <th class="fit">Container Type</th>
                                                                    <th class="fit">Quantity</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="fit">{{$kit->sku}}</td>
                                                                    <td class="fit">{{$kit->description}}</td>
                                                                    <td class="fit">{{$kit->upc}}</td>
                                                                    <td class="fit">Kit</td>
                                                                    <td class="fit">{{$kit->pivot->quantity}}</td>
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
                                                                    <th class="fit">SKU</th>
                                                                    <th class="fit">Description</th>
                                                                    <th class="fit">UPC</th>
                                                                    <th class="fit">Container Type</th>
                                                                    <th class="fit">Quantity</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="fit">{{$case->sku}}</td>
                                                                    <td class="fit">{{$case->description}}</td>
                                                                    <td class="fit">{{$case->upc}}</td>
                                                                    <td class="fit">Case</td>
                                                                    <td class="fit">{{$case->pivot->quantity}}</td>
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
                    <div class="table-responsive-md">
                    <table class="table table-sm cases-table">
                        <thead>
                        <tr>
                            <th class="fit">Expand</th>
                            <th class="fit">Sku</th>
                            <th class="fit">Description</th>
                            <th class="fit">UPC</th>
                            <th class="fit">Quantity</th>
                            <th class="fit">Qty/Case</th>
                            <th class="fit">Location</th>
                            

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cases as $case)
                        <tr>
                            <td class="fit"><button type="button" class="btn text-denim toggle-{{$case->id}}" id="toggle-details-cases-{{$case->id}}" data-toggle="collapse" data-target="#details-cases-{{$case->id}}" aria-expanded="false" aria-controls="details" data-delay="0"><i class="fas fa-plus"></i></button></td>
                            <td class="fit">{{$case->sku}}</td>
                            <td class="fit">{{$case->description}}</td>
                            <td class="fit">{{$case->upc}}</td>
                            <td class="fit">{{$case->total_qty}}</td>
                            <td class="fit">{{$case->qty_per_case}}</td>
                            <td class="fit">N/A</td>
                            
                        </tr>
                    
                            @if($case->basic_units->all())
                                @foreach ($case->basic_units->all() as $unit)
                                    
                                    <tr>
                                        <td class="py-0 border-0"></td>
                                        <td class="py-0 border-0" colspan="12">
                                        <div  id="details-cases-{{$case->id}}" class="details collapse">
                                                <table class="table table-sm bg-whitewash">
                                                        <thead>
                                                            <tr>
                                                                <th class="fit">SKU</th>
                                                                <th class="fit">Description</th>
                                                                <th class="fit">UPC</th>
                                                                <th class="fit">Container Type</th>
                                                                <th class="fit">Qty</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="fit">{{$unit->sku}}</td>
                                                                <td class="fit">{{$unit->description}}</td>
                                                                <td class="fit">{{$unit->upc}}</td>
                                                                <td class="fit">Loose Item</td>
                                                                <td class="fit">{{$unit->pivot->quantity}}</td>
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
                                            <div id="details-cases-{{$case->id}}" class="details collapse">
                                                    <table class="table table-sm bg-whitewash">
                                                            <thead>
                                                                <tr>
                                                                    <th class="fit">SKU</th>
                                                                    <th class="fit">Description</th>
                                                                    <th class="fit">UPC</th>
                                                                    <th class="fit">Container Type</th>
                                                                    <th class="fit">Quantity</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="fit">{{$kit->sku}}</td>
                                                                    <td class="fit">{{$kit->description}}</td>
                                                                    <td class="fit">{{$kit->upc}}</td>
                                                                    <td class="fit">Kit</td>
                                                                    <td class="fit">{{$kit->pivot->quantity}}</td>
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
                    <div class="table-responsive-md">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th class="fit"></th>
                            <th class="fit">Sku</th>
                            <th class="fit">Description</th>
                            <th class="fit">UPC</th>
                            <th class="fit">Quantity</th>
                            <th class="fit">Qty/Kit</th>
                            <th class="fit">Location</th>
                            
                        </tr>
                        </thead>
                        @foreach($kits as $kit)
                        <tr>
                            <td class="fit"><button type="button" class="btn text-denim toggle-{{$kit->id}}" id="toggle-details-kit-{{$kit->id}}" data-toggle="collapse" data-target="#details-kit-{{$kit->id}}" aria-expanded="false" aria-controls="details" data-delay="0"><i class="fas fa-plus"></i></button></td>
                            <td class="fit">{{$kit->sku}}</td>
                            <td class="fit">{{$kit->description}}</td>
                            <td class="fit">{{$kit->upc}}</td>
                            <td class="fit">{{$kit->total_qty}}</td>
                            <td class="fit">{{$kit->kit_qty}}</td>
                            <td class="fit">N/A</td>
                            
                        </tr>

                            @if($kit->basic_units->all())
                                @foreach ($kit->basic_units->all() as $unit)
                                    
                                    <tr>
                                    <td class="py-0 border-0"></td>
                                    <td class="py-0 border-0" colspan="12">
                                        <div  id="details-kit-{{$kit->id}}" class="details collapse">
                                                <table class="table table-sm bg-whitewash">
                                                        <thead>
                                                            <tr>
                                                                <th class="fit">SKU</th>
                                                                <th class="fit">Description</th>
                                                                <th class="fit">UPC</th>
                                                                <th class="fit">Container Type</th>
                                                                <th class="fit">Quantity</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="fit">{{$unit->sku}}</td>
                                                                <td class="fit">{{$unit->description}}</td>
                                                                <td class="fit">{{$unit->upc}}</td>
                                                                <td class="fit">Loose Item</td>
                                                                <td class="fit">{{$unit->pivot->quantity}}</td>
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


                    <p class="h1 font-weight-light d-inline">Units</p>
                
                    <button type="submit" name="submit" class="btn btn-link text-denim d-inline pb-3" data-toggle="modal" data-target="#modalCenter"><i class="fas fa-file-upload"></i> Import with CSV</button>
                        
                
                    @if(count($basic_units) > 0)
                    <div class="table-responsive-md">
                    <table class="table table-sm">
                        <thead>
                        <tr>

                            <th class="fit">Sku</th>
                            <th class="fit">Description</th>
                            <th class="fit">UPC</th>
                            <th class="fit">Pallet Qty</th>
                            <th class="fit">Carton Qty</th>
                            <th class="fit">Case Qty</th>
                            <th class="fit">Kit Qty</th>
                            <th class="fit">Loose Qty</th>
                            <th class="fit">Total Qty</th>
                           

                        </tr>
                        </thead>
                        @foreach($basic_units as $unit)
                        <tr>
                            <td class="fit">{{$unit->sku}}</td>
                            <td class="fit">{{$unit->description}}</td>
                            <td class="fit">{{$unit->upc}}</td>
                            <td class="fit">{{$unit->pallet_qty}}</td>
                            <td class="fit">{{$unit->carton_qty}}</td>
                            <td class="fit">{{$unit->case_qty}}</td>
                            <td class="fit">{{$unit->kit_qty}}</td>
                            <td class="fit">{{$unit->loose_item_qty}}</td>
                            <td class="fit">{{$unit->total_qty}}</td>
                           

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
<script>
    /*
    $(document).ready(function(){

    $('#upload_csv_form').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: 'POST',
            enctype: 'multipart/form-data',
            url: '/importinventory/{{auth()->user()->id}}',
            data: new FormData(this),
            contentType: false,
            cache:false,
            processData:false

        })
        .done(function(result){
            console.log(result);
            var success = '<div class="alert alert-success text-center" role="alert">You have successfully upload your CSV file. <br> <i class="far fa-check-circle fa-3x"></i></div>';
            $('.modal-body').html(success);
            $('.modal-footer').html('');
            $('.modal').modal('show');

        })
        .fail(function(result){
            console.log(result);
            var error = '<div class="alert alert-danger text-center" role="alert">Your CSV file was not successfully uploaded. Please confirm your file is in the correct format and try again. <br> <i class="far fa-times-circle fa-3x"></i> </div>'
            $('.modal-body').html(error);
            $('.modal-footer').html('');
            $('.modal').modal('show');
        });
    })
});
*/
</script>
@endsection