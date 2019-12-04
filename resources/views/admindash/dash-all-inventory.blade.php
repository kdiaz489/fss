@extends('layouts.admindashlte')

@section('user-name')
{{auth()->user()->name}}
@endsection

@section('content')


<div class="container-fluid dashboard-container">

    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

</div>
<div class="container-fluid dashboard-container">


    <div class="row justify-content-center">
        <div class="col-md-12 ">

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="col-lg-12 col-12">

                <h3 class="font-weight-light">Product On Pallets</h3>

                <br>

                @if(count($pallets) > 0)
                <div class="table-responsive">
                    <table class="table table-sm">
                        <tr>
                            <th width="10%"></th>
                            <th width="10%">Sku</th>
                            <th width="10%">Description</th>
                            <th width="10%">Cartons per Pallet</th>
                            <th width="10%">Cases per Pallet</th>
                            <th width="10%">Kits per Pallet</th>
                            <th width="10%">Total # Pallets</th>
                            <th width="10%"></th>

                        </tr>
                        @foreach($pallets as $pallet)
                        <tr>
                            <td><button type="button" class="btn text-denim toggle-{{$pallet->id}}"
                                    id="toggle-details-pallet-{{$pallet->id}}" data-toggle="collapse"
                                    data-target="#details-pallet-{{$pallet->id}}" aria-expanded="false" aria-controls="details"
                                    data-delay="0"><i class="fas fa-plus"></i></button></td>

                            <td>{{$pallet->sku}}</td>
                            <td>{{$pallet->description}}</td>

                            <td>{{$pallet->carton_qty}}</td>
                            <td>{{$pallet->case_qty}}</td>
                            <td>{{$pallet->kit_qty}}</td>
                            <td>{{$pallet->total_qty}}</td>
                            <td>
                                <div style="margin-left: 30%">
                                    <!--
                                            <a href="/editpallet/{{$pallet->id}}" class="float-left"
                                                style="margin-right:1%">
                                                <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                            </a>
                                            -->

                                    <a href="/viewpallet/{{$pallet->id}}" class="float-left" style="margin-right:1%">
                                        <button class="btn btn-link text-denim btn-sm" type="button">View</button>
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
                                                <th width="10%">Barcode</th>
                                                <th width="10%">Container Type</th>
                                                <th width="10%">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$unit->sku}}</td>
                                                <td>{{$unit->description}}</td>
                                                <td></td>
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
                                                <th width="10%">Barcode</th>
                                                <th width="10%">Container Type</th>
                                                <th width="10%">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$carton->sku}}</td>
                                                <td>{{$carton->description}}</td>
                                                <td></td>
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
                                                <th width="10%">Barcode</th>
                                                <th width="10%">Container Type</th>
                                                <th width="10%">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$kit->sku}}</td>
                                                <td>{{$kit->description}}</td>
                                                <td></td>
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
                                                <th width="10%">Barcode</th>
                                                <th width="10%">Container Type</th>
                                                <th width="10%">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$case->sku}}</td>
                                                <td>{{$case->description}}</td>
                                                <td></td>
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

                @if(count($cartons) > 0)
                <div class="table-responsive">
                    <table class="table table-sm">
                        <tr>
                            <th width="10%"></th>

                            <th width="10%">Sku</th>
                            <th width="10%">Description</th>
                            <th width="10%">Cases per Carton</th>
                            <th width="10%">Kits per Carton</th>
                            <th width="10%">Units per Carton</th>
                            <th width="10%">Total # Cartons</th>
                            <th width="10%"></th>

                        </tr>
                        @foreach($cartons as $carton)
                        <tr>
                            <td><button type="button" class="btn text-denim toggle-{{$carton->id}}"
                                    id="toggle-details-carton-{{$carton->id}}" data-toggle="collapse"
                                    data-target="#details-carton-{{$carton->id}}" aria-expanded="false" aria-controls="details"
                                    data-delay="0"><i class="fas fa-plus"></i></button></td>

                            <td>{{$carton->sku}}</td>
                            <td>{{$carton->description}}</td>
                            <td>{{$carton->case_qty}}</td>
                            <td>{{$carton->kit_qty}}</td>
                            <td>{{$carton->basic_unit_qty}}</td>
                            <td>{{$carton->total_qty}}</td>
                            <td>
                                <div style="margin-left: 30%">
                                    <!--
                                            <a href="/editcarton/{{$carton->id}}" class="float-left"
                                                style="margin-right:1%">
                                                <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                            </a>
                                            -->

                                    <a href="/viewcarton/{{$carton->id}}" class="float-left" style="margin-right:1%">
                                        <button class="btn btn-link text-denim btn-sm" type="button">View</button>
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
                                                <th width="10%">Barcode</th>
                                                <th width="10%">Container Type</th>
                                                <th width="10%">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$unit->sku}}</td>
                                                <td>{{$unit->description}}</td>
                                                <td></td>
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
                                                <th width="10%">Barcode</th>
                                                <th width="10%">Container Type</th>
                                                <th width="10%">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$kit->sku}}</td>
                                                <td>{{$kit->description}}</td>
                                                <td></td>
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
                                                <th width="10%">Barcode</th>
                                                <th width="10%">Container Type</th>
                                                <th width="10%">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$case->sku}}</td>
                                                <td>{{$case->description}}</td>
                                                <td></td>
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

                @if(count($cases) > 0)
                <div class="table-responsive">
                    <table class="table table-sm">
                        <tr>
                            <th width="10%"></th>

                            <th width="10%">Sku</th>
                            <th width="10%">Description</th>
                            <th width="10%">Cases in Pallets</th>
                            <th width="10%">Cases in Cartons</th>
                            <th width="10%">Kits per Case</th>
                            <th width="10%">Units per Case</th>
                            <th width="10%">Total # Cases</th>
                            <th width="10%"></th>

                        </tr>
                        @foreach($cases as $case)
                        <tr>
                            <td><button type="button" class="btn text-denim toggle-{{$case->id}}"
                                    id="toggle-details-case-{{$case->id}}" data-toggle="collapse"
                                    data-target="#details-case-{{$case->id}}" aria-expanded="false" aria-controls="details"
                                    data-delay="0"><i class="fas fa-plus"></i></button></td>
                            <td>{{$case->sku}}</td>
                            <td>{{$case->description}}</td>
                            <td>{{$case->pallet_qty}}</td>
                            <td>{{$case->carton_qty}}</td>
                            <td>{{$case->kit_qty}}</td>
                            <td>{{$case->basic_unit_qty}}</td>
                            <td>{{$case->total_qty}}</td>
                            <td>
                                <div style="margin-left: 30%">
                                    <!--
                                            <a href="/editcase/{{$case->id}}" class="float-left" style="margin-right:1%">
                                                <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                            </a>
                                            -->

                                    <a href="/viewcase/{{$case->id}}" class="float-left" style="margin-right:1%">
                                        <button class="btn btn-link text-denim btn-sm" type="button">View</button>
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
                                                <th width="10%">Barcode</th>
                                                <th width="10%">Container Type</th>
                                                <th width="10%">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$unit->sku}}</td>
                                                <td>{{$unit->description}}</td>
                                                <td></td>
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
                                                <th width="10%">Barcode</th>
                                                <th width="10%">Container Type</th>
                                                <th width="10%">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$kit->sku}}</td>
                                                <td>{{$kit->description}}</td>
                                                <td></td>
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

                @if(count($kits) > 0)
                <div class="table-responsive">
                    <table class="table table-sm">
                        <tr>
                            <th width="10%"></th>
                            <th width="10%">Sku</th>
                            <th width="10%">Description</th>
                            <th width="10%">Kits in Pallets</th>
                            <th width="10%">Kits in Cartons</th>
                            <th width="10%">Units per Kit</th>
                            <th width="10%">Total # Kits</th>
                            <th width="10%"></th>
                        </tr>
                        @foreach($kits as $kit)
                        <tr>
                            <td><button type="button" class="btn text-denim toggle-{{$kit->id}}"
                                    id="toggle-details-kit-{{$kit->id}}" data-toggle="collapse"
                                    data-target="#details-kit-{{$kit->id}}" aria-expanded="false" aria-controls="details"
                                    data-delay="0"><i class="fas fa-plus"></i></button></td>
                            <td>{{$kit->sku}}</td>
                            <td>{{$kit->description}}</td>
                            <td>{{$kit->pallet_qty}}</td>
                            <td>{{$kit->carton_qty}}</td>
                            <td>{{$kit->basic_unit_qty}}</td>

                            <td>{{$kit->total_qty}}</td>
                            <td>

                                <div style="margin-left: 30%">
                                    <!--
                                            <a href="/editkit/{{$kit->id}}" class="float-left" style="margin-right:1%">
                                                <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                            </a>
                                            -->
                                    <a href="/viewkit/{{$kit->id}}" class="float-left" style="margin-right:1%">
                                        <button class="btn btn-link text-denim btn-sm" type="button">View</button>
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
                                                <th width="10%">Barcode</th>
                                                <th width="10%">Container Type</th>
                                                <th width="10%">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$unit->sku}}</td>
                                                <td>{{$unit->description}}</td>
                                                <td></td>
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
                @if(count($basic_units) > 0)
                <div class="table-responsive">
                    <table class="table table-sm">
                        <tr>

                            <th width="10%">Sku</th>
                            <th width="10%">Description</th>
                            <th width="10%">Pallet Qty</th>
                            <th width="10%">Carton Qty</th>
                            <th width="10%">Case Qty</th>
                            <th width="10%">Kit Qty</th>
                            <th width="10%">Total Qty</th>
                            <th width="10%"></th>

                        </tr>
                        @foreach($basic_units as $unit)
                        <tr>
                            <td>{{$unit->sku}}</td>
                            <td>{{$unit->desc}}</td>
                            <td>{{$unit->pallet_qty}}</td>
                            <td>{{$unit->carton_qty}}</td>
                            <td>{{$unit->case_qty}}</td>
                            <td>{{$unit->kit_qty}}</td>
                            <td>{{$unit->total_qty}}</td>
                            <td>
                                <div style="margin-left: 30%">
                                    <!--
                                            <a href="/editbasicunit/{{$unit->id}}" class="float-left"
                                                style="margin-right:1%">
                                                <button class="btn btn-link text-denim btn-sm" type="button">Edit</button>
                                            </a>
                                            -->
                                    <a href="/viewbasicunit/{{$unit->id}}" class="float-left" style="margin-right:1%">
                                        <button class="btn btn-link text-denim btn-sm" type="button">View</button>
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

    @endsection