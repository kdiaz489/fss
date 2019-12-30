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
          
          
                      <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link text-white shadow-sm" style="background-color: #3b679c">
          
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
                            <a href="/dashboard/user/fulfillment" class="nav-link text-gunmetal bg-whitewash">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Fulfillment Orders</p>
                            </a>
                          </li>
                        </ul>
                      </li>
          
                      <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white">
                          <i class="nav-icon fas fa-warehouse"></i>
                          <p>
                            Storage
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="/dashboard/user/inventory" class="nav-link text-white">
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
Fulfilment Orders
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
                    <a href="/createfilorder" class="btn btn-outline-secondary">Create Fulfillment</a>
                    -->

                    <p class="h1 font-weight-light">Fulfillment Orders</p>
                    @if(count($orders) > 0)
                    <div class="table-responsive">
                        <table class="table table-sm" id="filorders">
                            <thead>
                                <tr>
                                    <th width="10%"></th>
                                    <th width="10%">Order ID</th>
                                    <th width="10%">Submitted On</th>
                                    <th width="10%">Customer</th>
                                    <th width="10%">Payment</th>
                                    <th width="10%">Status</th>
                                    <th width="10%"></th>

                                </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)


                            <tr>
                                <td width="10%"><button type="button" class="btn text-denim toggle-{{$order->id}}"
                                        id="toggle-details{{$order->id}}" data-toggle="collapse"
                                        data-target="#details{{$order->id}}" aria-expanded="false"
                                        aria-controls="details" data-delay="0"><i class="fas fa-plus"></i></button></td>
                                <td width="10%">
                                    <a href="/vieworder/{{$order->id}}">
                                        <button class="btn btn-link text-denim btn-sm px-0 "
                                            type="button">{{str_pad($order->orderid, 6, '0', STR_PAD_LEFT)}}</button>
                                    </a>
                                </td>
                                <td width="10%">{{$order->created_at->format('m/d/y')}}</td>
                                <td width="10%">{{$order->cust_name}}</td>
                                <td width="10%">{{$order->financial_status}}</td>
                                <td width="10%">{{$order->fulfillment_status}}</td>
                                <td width="10%">
                                    <div style="margin-left: 10%">

                                        <a href="/vieworder/{{$order->id}}" class="float-left" style="margin-right:1%">
                                            <button class="btn btn-link text-denim btn-sm" type="button">View</button>
                                        </a>
                                        <form action="/order/remove/{{$order->id}}" method="POST" class="float-left">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-link text-danger btn-sm">Remove</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            @if($order->basic_units->all())
                            @foreach ($order->basic_units->all() as $unit)

                            <tr>
                                <td class="py-0 border-0"></td>
                                <td class="py-0 border-0" colspan="12">
                                    <div id="details{{$order->id}}" class="accordion-body details collapse">
                                        <table class="table table-sm bg-whitewash">
                                            <thead>
                                                <tr>
                                                    <th width="10%">SKU</th>
                                                    <th width="10%">Description</th>
                                                    <th width="10%">Barcode</th>
                                                    <th width="10%">Container Type</th>
                                                    <th width="10%">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td width="10%">{{$unit->sku}}</td>
                                                    <td width="10%">{{$unit->description}}</td>
                                                    <td width="10%"></td>
                                                    <td width="10%">Loose Item</td>
                                                    <td width="10%">{{$unit->pivot->quantity}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif

                            @if($order->kits->all())
                            @foreach ($order->kits->all() as $kit)
                            <tr>
                                <td class="py-0 border-0"></td>
                                <td class="py-0 border-0" colspan="12">
                                    <div id="details{{$order->id}}" class="accordion-body details collapse">
                                        <table class="table table-sm bg-whitewash">
                                            <thead>
                                                <tr>
                                                    <th  width="10%">SKU</th>
                                                    <th  width="10%">Description</th>
                                                    <th  width="10%">Barcode</th>
                                                    <th  width="10%">Container Type</th>
                                                    <th  width="10%">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td  width="10%">{{$kit->sku}}</td>
                                                    <td  width="10%">{{$kit->description}}</td>
                                                    <td  width="10%"></td>
                                                    <td  width="10%">Kit</td>
                                                    <td  width="10%">{{$kit->pivot->quantity}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif


                            @if($order->cases->all())
                            @foreach ($order->cases->all() as $case)
                            <tr>
                                <td class="py-0 border-0"></td>
                                <td class="py-0 border-0" colspan="12">
                                    <div id="details{{$order->id}}" class="accordion-body details collapse">
                                        <table class="table table-sm bg-whitewash">
                                            <thead>
                                                <tr>
                                                    <th  width="10%">SKU</th>
                                                    <th  width="10%">Description</th>
                                                    <th  width="10%">Barcode</th>
                                                    <th  width="10%">Container Type</th>
                                                    <th  width="10%">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td  width="10%">{{$case->sku}}</td>
                                                    <td  width="10%">{{$case->description}}</td>
                                                    <td  width="10%"></td>
                                                    <td  width="10%">Case</td>
                                                    <td  width="10%">{{$case->pivot->quantity}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif

                            @if($order->cartons->all())
                            @foreach ($order->cartons->all() as $carton)
                            <tr>
                                <td class="py-0 border-0"></td>
                                <td class="py-0 border-0" colspan="12">
                                    <div id="details{{$order->id}}" class="accordion-body details collapse">
                                        <table class="table table-sm bg-whitewash">
                                            <thead>
                                                <tr>
                                                    <th  width="10%">SKU</th>
                                                    <th  width="10%">Description</th>
                                                    <th  width="10%">Barcode</th>
                                                    <th  width="10%">Container Type</th>
                                                    <th  width="10%">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td  width="10%">{{$carton->sku}}</td>
                                                    <td  width="10%">{{$carton->description}}</td>
                                                    <td  width="10%"></td>
                                                    <td  width="10%">Carton</td>
                                                    <td  width="10%">{{$carton->pivot->quantity}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif

                            @if($order->pallets->all())
                            @foreach ($order->pallets->all() as $pallet)
                            <tr>
                                <td class="py-0 border-0"></td>
                                <td class="py-0 border-0" colspan="12">
                                    <div id="details{{$order->id}}" class="accordion-body details collapse">
                                        <table class="table table-sm bg-whitewash">
                                            <thead>
                                                <tr>
                                                    <th  width="10%">SKU</th>
                                                    <th  width="10%">Description</th>
                                                    <th  width="10%">Barcode</th>
                                                    <th  width="10%">Container Type</th>
                                                    <th  width="10%">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td  width="10%">{{$pallet->sku}}</td>
                                                    <td  width="10%">{{$pallet->description}}</td>
                                                    <td  width="10%"></td>
                                                    <td  width="10%">Pallet</td>
                                                    <td  width="10%">{{$pallet->pivot->quantity}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                                @endforeach
                                @endif
                                @endforeach
                        </table>
                    </div>
                    @else
                    <p>You have 0 pending orders.</p>
                    @endif
            </div>
            <div class="col-lg-12 col-12">
              <!--
              <a href="/createfilorder" class="btn btn-outline-secondary">Create Fulfillment</a>
              -->

              <p class="h1 font-weight-light">Fulfillment Orders History</p>
              @if(count($ordershistory) > 0)
              <div class="table-responsive">
                  <table class="table table-sm" id="filorders">
                      <thead>
                          <tr>
                              <th width="10%"></th>
                              <th width="10%">Order ID</th>
                              <th width="10%">Submitted On</th>
                              <th width="10%">Customer</th>
                              <th width="10%">Payment</th>
                              <th width="10%">Status</th>
                              <th width="10%"></th>

                          </tr>
                      </thead>
                      <tbody>
                      @foreach($ordershistory as $order)


                      <tr>
                          <td width="10%"><button type="button" class="btn text-denim toggle-{{$order->id}}"
                                  id="toggle-details{{$order->id}}" data-toggle="collapse"
                                  data-target="#details{{$order->id}}" aria-expanded="false"
                                  aria-controls="details" data-delay="0"><i class="fas fa-plus"></i></button></td>
                          <td width="10%">
                              <a href="/vieworder/{{$order->id}}">
                                  <button class="btn btn-link text-denim btn-sm px-0 "
                                      type="button">{{str_pad($order->orderid, 6, '0', STR_PAD_LEFT)}}</button>
                              </a>
                          </td>
                          <td width="10%">{{$order->created_at->format('m/d/y')}}</td>
                          <td width="10%">{{$order->cust_name}}</td>
                          <td width="10%"></td>
                          <td width="10%">{{$order->status}}</td>
                          <td width="10%">
                              <div style="margin-left: 10%">

                                  <a href="/vieworder/{{$order->id}}" class="float-left" style="margin-right:1%">
                                      <button class="btn btn-link text-denim btn-sm" type="button">View</button>
                                  </a>
                                  <form action="/order/remove/{{$order->id}}" method="POST" class="float-left">
                                      @method('DELETE')
                                      @csrf
                                      <button type="submit"
                                          class="btn btn-link text-danger btn-sm">Remove</button>
                                  </form>
                              </div>
                          </td>
                      </tr>

                      @if($order->basic_units->all())
                      @foreach ($order->basic_units->all() as $unit)

                      <tr>
                          <td class="py-0 border-0"></td>
                          <td class="py-0 border-0" colspan="12">
                              <div id="details{{$order->id}}" class="accordion-body details collapse">
                                  <table class="table table-sm bg-whitewash">
                                      <thead>
                                          <tr>
                                              <th width="10%">SKU</th>
                                              <th width="10%">Description</th>
                                              <th width="10%">Barcode</th>
                                              <th width="10%">Container Type</th>
                                              <th width="10%">Quantity</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td width="10%">{{$unit->sku}}</td>
                                              <td width="10%">{{$unit->description}}</td>
                                              <td width="10%"></td>
                                              <td width="10%">Loose Item</td>
                                              <td width="10%">{{$unit->pivot->quantity}}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </td>
                      </tr>
                      @endforeach
                      @endif

                      @if($order->kits->all())
                      @foreach ($order->kits->all() as $kit)
                      <tr>
                          <td class="py-0 border-0"></td>
                          <td class="py-0 border-0" colspan="12">
                              <div id="details{{$order->id}}" class="accordion-body details collapse">
                                  <table class="table table-sm bg-whitewash">
                                      <thead>
                                          <tr>
                                              <th  width="10%">SKU</th>
                                              <th  width="10%">Description</th>
                                              <th  width="10%">Barcode</th>
                                              <th  width="10%">Container Type</th>
                                              <th  width="10%">Quantity</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td  width="10%">{{$kit->sku}}</td>
                                              <td  width="10%">{{$kit->description}}</td>
                                              <td  width="10%"></td>
                                              <td  width="10%">Kit</td>
                                              <td  width="10%">{{$kit->pivot->quantity}}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </td>
                      </tr>
                      @endforeach
                      @endif


                      @if($order->cases->all())
                      @foreach ($order->cases->all() as $case)
                      <tr>
                          <td class="py-0 border-0"></td>
                          <td class="py-0 border-0" colspan="12">
                              <div id="details{{$order->id}}" class="accordion-body details collapse">
                                  <table class="table table-sm bg-whitewash">
                                      <thead>
                                          <tr>
                                              <th  width="10%">SKU</th>
                                              <th  width="10%">Description</th>
                                              <th  width="10%">Barcode</th>
                                              <th  width="10%">Container Type</th>
                                              <th  width="10%">Quantity</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td  width="10%">{{$case->sku}}</td>
                                              <td  width="10%">{{$case->description}}</td>
                                              <td  width="10%"></td>
                                              <td  width="10%">Case</td>
                                              <td  width="10%">{{$case->pivot->quantity}}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </td>
                      </tr>
                      @endforeach
                      @endif

                      @if($order->cartons->all())
                      @foreach ($order->cartons->all() as $carton)
                      <tr>
                          <td class="py-0 border-0"></td>
                          <td class="py-0 border-0" colspan="12">
                              <div id="details{{$order->id}}" class="accordion-body details collapse">
                                  <table class="table table-sm bg-whitewash">
                                      <thead>
                                          <tr>
                                              <th  width="10%">SKU</th>
                                              <th  width="10%">Description</th>
                                              <th  width="10%">Barcode</th>
                                              <th  width="10%">Container Type</th>
                                              <th  width="10%">Quantity</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td  width="10%">{{$carton->sku}}</td>
                                              <td  width="10%">{{$carton->description}}</td>
                                              <td  width="10%"></td>
                                              <td  width="10%">Carton</td>
                                              <td  width="10%">{{$carton->pivot->quantity}}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </td>
                      </tr>
                      @endforeach
                      @endif

                      @if($order->pallets->all())
                      @foreach ($order->pallets->all() as $pallet)
                      <tr>
                          <td class="py-0 border-0"></td>
                          <td class="py-0 border-0" colspan="12">
                              <div id="details{{$order->id}}" class="accordion-body details collapse">
                                  <table class="table table-sm bg-whitewash">
                                      <thead>
                                          <tr>
                                              <th  width="10%">SKU</th>
                                              <th  width="10%">Description</th>
                                              <th  width="10%">Barcode</th>
                                              <th  width="10%">Container Type</th>
                                              <th  width="10%">Quantity</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td  width="10%">{{$pallet->sku}}</td>
                                              <td  width="10%">{{$pallet->description}}</td>
                                              <td  width="10%"></td>
                                              <td  width="10%">Pallet</td>
                                              <td  width="10%">{{$pallet->pivot->quantity}}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </td>
                      </tr>
                  </tbody>
                          @endforeach
                          @endif
                          @endforeach
                  </table>
              </div>
              @else
              <p>You have 0 pending orders.</p>
              @endif
      </div>
        </div>
    </div>
</div>

@endsection

