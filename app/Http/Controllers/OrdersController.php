<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Order;
use App\Kit;
use App\Cases;
use App\Carton;
use App\Basic_Unit;
use App\OrderHistory;
use App\Pallet;
use App\OrderNumber;
use Illuminate\Support\Facades\Mail;
use App\Mail\StorUpdateMail;
use App\Mail\StorRequestMail;
use App\Mail\StorRemoveMail;
use App\Mail\CustomerStorRequestMail;
use Illuminate\Support\Facades\Validator;
use App\Exports\CsvExport;
use App\Imports\CsvImport;
use Maatwebsite\Excel\Facades\Excel;

use function GuzzleHttp\Psr7\readline;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function hasPallets($obj, $type_str)
    {
        return $obj->pallets()
            ->where($type_str . '_id', $obj->getKey())
            ->exists();
    }


    public function hasCartons($obj, $type_str)
    {
        return $obj->cartons()
            ->where($type_str . '_id', $obj->getKey())
            ->exists();
    }

    public function hasCases($obj, $type_str)
    {
        return $obj->cases()
            ->where($type_str . '_id', $obj->getKey())
            ->exists();
    }


    public function hasKits($obj, $type_str)
    {
        return $obj->kits()
            ->where($type_str . '_id', $obj->getKey())
            ->exists();
    }

    public function hasUnits($obj, $type_str)
    {
        return $obj->basic_units()
            ->where($type_str . '_id', $obj->getKey())
            ->exists();
    }

    public function create()
    {
        //
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $kits = $user->kits->sortKeysDesc();
        return view('orders.trans-in-kit')->with('kits', $kits);
    }

    public function create_transin_order()
    {

        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $units = $user->basic_units->all();
        $kits = $user->kits->all();
        $cases = $user->cases->all();
        $cartons = $user->cartons->all();
        $pallets = $user->pallets->all();
        return view('orders.create-trans-in')->with('pallets', $pallets)->with('cartons', $cartons)->with('cases', $cases)->with('kits', $kits)->with('units', $units);
    }

    public function create_transout_order()
    {

        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $units = $user->basic_units->all();
        $kits = $user->kits->all();
        $cases = $user->cases->all();
        $cartons = $user->cartons->all();
        $pallets = $user->pallets->all();
        return view('orders.create-trans-out')->with('pallets', $pallets)->with('cartons', $cartons)->with('cases', $cases)->with('kits', $kits)->with('units', $units);
    }

    public function create_fil_order()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $units = $user->basic_units->sortByDesc('created_at');
        $kits = $user->kits->sortByDesc('created_at');
        $cases = $user->cases->sortByDesc('created_at');
        $cartons = $user->cartons->sortByDesc('created_at');
        $pallets = $user->pallets->sortByDesc('created_at');
        return view('userdash.dash-fulfillment-order')->with('units', $units)->with('kits', $kits)->with('cases', $cases)->with('cartons', $cartons)->with('pallets', $pallets);
    }

    public function store_transin_order(Request $request)
    {

        /**
         * 
         * Establishes rules for form input
         * If fields are not filled in, will return json error message
         * 
         */
        if ($request->ajax()) {
            $rules = array(
                'items.*'  => 'required',
                'item_qty.*'  => 'required',
                'type.*' => 'required'
            );

            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }

            /**
             * 
             * Creates instance of Order object
             * Sets order property for this instance
             * 
             */
            $order = new Order();

            $ordernumber = new OrderNumber();
            $ordernumber->save();
            $ordernumber->fss_id = $ordernumber->id + 100;
            $ordernumber->user_id = auth()->user()->id;
            $order->orderid = $ordernumber->fss_id;
            $order->ordernumber_id = $ordernumber->id;
            $ordernumber->save();


            $order->user_id = auth()->user()->id;
            $order->company = auth()->user()->company_name;
            $order->order_type = $request->order_type;
            $order->barcode = $request->barcode;
            $order->status = 'Pending Approval';
            $order->description = $request->desc;
            $order->save();


            /**
             * 
             * Creates variables to store input array from the pallet input (array of pallet ids) and pallet quantity
             * Creates variables for object totals -> pallets, cases (if applies), and units (if applies)
             * 
             */
            $items = $request->items;
            $item_qty = $request->item_qty;
            $types = $request->type;
            $total_items = 0;
            $total_pallets = 0;
            $total_cartons = 0;
            $total_cases = 0;
            $total_kits = 0;
            $total_units = 0;


            /**
             * 
             * Code that loops through pallets in array.
             * Loops through Cases per pallet if not False and updates total_cases
             * Loops through Units per pallet if not False and updates total_units
             * 
             */
            for ($i = 0; $i < count($items); $i++) {
                $item_type = strval($types[$i]);
                if ($item_type == 'Pallet') {

                    $total_items += $item_qty[$i];
                    $total_pallets += $item_qty[$i];
                    //dd([['pallet_id' => $items[$i], 'quantity' => $item_qty[$i]]]);
                    $order->pallets()->attach([['pallet_id' => $items[$i], 'quantity' => $item_qty[$i]]]);
                }

                if ($item_type == 'Carton') {
                    $total_items += $item_qty[$i];
                    $total_cartons += $item_qty[$i];
                    $order->cartons()->attach([['carton_id' => $items[$i], 'quantity' => $item_qty[$i]]]);
                }

                if ($item_type == 'Case') {
                    $total_items += $item_qty[$i];
                    $total_cases += $item_qty[$i];
                    $order->cases()->attach([['cases_id' => $items[$i], 'quantity' => $item_qty[$i]]]);
                }

                if ($item_type == 'Kit') {
                    $total_items += $item_qty[$i];
                    $total_kits += $item_qty[$i];
                    $order->kits()->attach([['kit_id' => $items[$i], 'quantity' => $item_qty[$i]]]);
                }

                if ($item_type == 'Unit') {
                    $total_items += $item_qty[$i];
                    $total_units += $item_qty[$i];
                    $order->basic_units()->attach([['basic__unit_id' => $items[$i], 'quantity' => $item_qty[$i]]]);
                }
            }




                /**
                 * 
                 * Sets up Order() pallet qty, unit qty (if applies) and case qty (if applies)
                 * Saves Order() object to database and attaches pallets to order
                 * 
                 */
                $order->pallet_qty = $total_pallets;
                $order->carton_qty = $total_units;
                $order->case_qty = $total_cases;
                $order->kit_qty = $total_kits;
                $order->unit_qty = $total_units;
                $order->save();



                Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
                return response()->json([
                    'success'  => 'Order submitted successfully.'
                ]);
            
        }
    }

    public function store_transout_order(Request $request)
    {


        /**
         * 
         * Establishes rules for form input
         * If fields are not filled in, will return json error message
         * 
         */
        if ($request->ajax()) {
            $rules = array(
                'items.*'  => 'required',
                'item_qty.*'  => 'required',
                'type.*' => 'required'
            );

            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }

            /**
             * 
             * Creates instance of Order object
             * Sets order property for this instance
             * 
             */
            DB::beginTransaction();
            try {
                $order = new Order();

                $ordernumber = new OrderNumber();
                $ordernumber->save();
                $ordernumber->fss_id = $ordernumber->id + 100;
                $ordernumber->user_id = auth()->user()->id;
                $order->orderid = $ordernumber->fss_id;
                $order->ordernumber_id = $ordernumber->id;
                $ordernumber->save();


                $order->user_id = auth()->user()->id;
                $order->company = auth()->user()->company_name;
                $order->order_type = $request->order_type;
                $order->barcode = $request->barcode;
                $order->status = 'Pending Approval';
                $order->description = $request->desc;
                $order->save();


                /**
                 * 
                 * Creates variables to store input array from the pallet input (array of pallet ids) and pallet quantity
                 * Creates variables for object totals -> pallets, cases (if applies), and units (if applies)
                 * 
                 */
                $items = $request->items;
                $item_qty = $request->item_qty;
                $types = $request->type;
                $total_items = 0;
                $total_pallets = 0;
                $total_cartons = 0;
                $total_cases = 0;
                $total_kits = 0;
                $total_units = 0;


                /**
                 * 
                 * Code that loops through pallets in array.
                 * Loops through Cases per pallet if not False and updates total_cases
                 * Loops through Units per pallet if not False and updates total_units
                 * 
                 */
                for ($i = 0; $i < count($items); $i++) {
                    $item_type = strval($types[$i]);
                    if ($item_type == 'Pallet') {
                        $total_items += $item_qty[$i];
                        $total_pallets += $item_qty[$i];
                        $pallet = Pallet::find($items[$i]);

                        if ($pallet->cartons->all()) {
                            foreach ($pallet->cartons->all() as $carton) {
                                if ($carton->total_qty < $carton->pivot->quantity) {
                                    throw new \Exception('Quantity of cartons on pallet is greater than quantity at hand.');
                                }
                            }
                        }

                        if ($pallet->cases->all()) {
                            foreach ($pallet->cases->all() as $case) {
                                if ($case->total_qty < $case->pivot->quantity) {
                                    throw new \Exception('Quantity of cases on pallet is greater than quantity at hand.');
                                }
                            }
                        }
                        if ($pallet->kits->all()) {
                            foreach ($pallet->kits->all() as $kit) {
                                if ($kit->total_qty < $kit->pivot->quantity) {
                                    throw new \Exception('Quantity of kits on pallet is greater than quantity at hand.');
                                }
                            }
                        }

                        if ($pallet->basic_units->all()) {
                            foreach ($pallet->basic_units->all() as $unit) {
                                if ($unit->total_qty < $unit->pivot->quantity) {
                                    throw new \Exception('Quantity of units on pallet is greater than quantity at hand.');
                                }
                            }
                        }

                        $order->pallets()->attach([['pallet_id' => $items[$i], 'quantity' => $item_qty[$i]]]);
                    }

                    if ($item_type == 'Carton') {
                        $total_items += $item_qty[$i];
                        $total_cartons += $item_qty[$i];
                        $carton = Carton::find($items[$i]);

                        if ($carton->cases->all()) {
                            foreach ($carton->cases->all() as $case) {
                                if ($case->total_qty < $case->pivot->quantity) {
                                    throw new \Exception('Quantity of cases in carton is greater than quantity at hand.');
                                }
                            }
                        }
                        if ($carton->kits->all()) {
                            foreach ($carton->kits->all() as $kit) {
                                if ($kit->total_qty < $kit->pivot->quantity) {
                                    throw new \Exception('Quantity of kits in carton is greater than quantity at hand.');
                                }
                            }
                        }

                        if ($carton->basic_units->all()) {
                            foreach ($carton->basic_units->all() as $unit) {
                                if ($unit->total_qty < $unit->pivot->quantity) {
                                    throw new \Exception('Quantity of units in carton is greater than quantity at hand.');
                                }
                            }
                        }

                        $order->cartons()->attach([['carton_id' => $items[$i], 'quantity' => $item_qty[$i]]]);
                    }

                    if ($item_type == 'Case') {
                        $total_items += $item_qty[$i];
                        $total_cases += $item_qty[$i];
                        $case = Cases::find($items[$i]);
                        if ($case->total_qty < $item_qty[$i]) {
                            throw new \Exception('Quantity of cases in order is greater than quantity at hand.');
                        }
                        if ($case->kits->all()) {
                            foreach ($case->kits->all() as $kit) {
                                if ($kit->total_qty < $kit->pivot->quantity) {
                                    throw new \Exception('Quantity of kits in case is greater than quantity at hand.');
                                }
                            }
                        }

                        if ($case->basic_units->all()) {
                            foreach ($case->basic_units->all() as $unit) {
                                if ($unit->total_qty < $unit->pivot->quantity) {
                                    throw new \Exception('Quantity of units in case is greater than quantity at hand.');
                                }
                            }
                        }

                        $order->cases()->attach([['cases_id' => $items[$i], 'quantity' => $item_qty[$i]]]);
                    }

                    if ($item_type == 'Kit') {
                        $total_items += $item_qty[$i];
                        $total_kits += $item_qty[$i];
                        $kit = Kit::find($items[$i]);
                        if ($kit->total_qty < $item_qty[$i]) {
                            throw new \Exception('Quantity of kits in order is greater than quantity at hand.');
                        }
                        $order->kits()->attach([['kit_id' => $items[$i], 'quantity' => $item_qty[$i]]]);
                    }

                    if ($item_type == 'Unit') {
                        $total_items += $item_qty[$i];
                        $total_units += $item_qty[$i];
                        $unit = Basic_Unit::find($items[$i]);
                        if ($unit->total_qty < $item_qty[$i]) {
                            throw new \Exception('Quantity of units in order is greater than quantity at hand.');
                        }
                        $order->basic_units()->attach([['basic__unit_id' => $items[$i], 'quantity' => $item_qty[$i]]]);
                    }
                }




                    /**
                     * 
                     * Sets up Order() pallet qty, unit qty (if applies) and case qty (if applies)
                     * Saves Order() object to database and attaches pallets to order
                     * 
                     */
                    $order->pallet_qty = $total_pallets;
                    $order->carton_qty = $total_units;
                    $order->case_qty = $total_cases;
                    $order->kit_qty = $total_kits;
                    $order->unit_qty = $total_units;
                    $order->save();
                    DB::commit();
                    Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
                    return response()->json([
                        'success'  => 'Order submitted successfully.'
                    ]);
                
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'error'  => $e->getMessage()
                ]);
            }
        }
    }



    public function store_fil_order(Request $request)
    {
        /**
         * 
         * Establishes rules for form input
         * If fields are not filled in, will return json error message
         * 
         */
        if ($request->ajax()) {
            $rules = array(
                'items.*'  => 'required',
                'item_qty.*'  => 'required',
                'type.*' => 'required'
            );



            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }

            /**
             * 
             * Creates instance of Order object
             * Sets order property for this instance
             * 
             */
            DB::beginTransaction();
            try {
                $order = new Order();

                $ordernumber = new OrderNumber();
                $ordernumber->save();
                $ordernumber->fss_id = $ordernumber->id + 100;
                $ordernumber->user_id = auth()->user()->id;
                $order->orderid = $ordernumber->fss_id;
                $order->ordernumber_id = $ordernumber->id;
                $ordernumber->save();


                $order->user_id = auth()->user()->id;
                $order->company = auth()->user()->company_name;
                $order->order_type = $request->order_type;
                $order->cust_name = $request->custname;
                $order->cust_order_no = $request->orderno;
                $order->street_address = $request->address;
                $order->city = $request->state;
                $order->zip = $request->zip;
                $order->status = 'Pending Approval';
                $order->save();


                /**
                 * 
                 * Creates variables to store input array from the pallet input (array of pallet ids) and pallet quantity
                 * Creates variables for object totals -> pallets, cases (if applies), and units (if applies)
                 * 
                 */
                $items = $request->items;
                $item_qty = $request->item_qty;
                $types = $request->type;
                $total_items = 0;
                $total_cases = 0;
                $total_kits = 0;
                $total_units = 0;


                /**
                 * 
                 * Code that loops through pallets in array.
                 * Loops through Cases per pallet if not False and updates total_cases
                 * Loops through Units per pallet if not False and updates total_units
                 * 
                 */
                for ($i = 0; $i < count($items); $i++) {
                    
                    
                    $item_type = strval($types[$i]);

                    if ($item_type === 'Case') {
                        
                        $total_items += $item_qty[$i];
                        $total_cases += $item_qty[$i];
                        $case = Cases::find($items[$i]);
                        if ($case->total_qty < $item_qty[$i]) {
                            throw new \Exception('Quantity of cases in order is greater than quantity at hand.');
                        }
                        if ($case->kits->all()) {
                            foreach ($case->kits->all() as $kit) {
                                if ($kit->total_qty < $kit->pivot->quantity) {
                                    throw new \Exception('Quantity of kits in case is greater than quantity at hand.');
                                }
                            }
                        }

                        if ($case->basic_units->all()) {
                            foreach ($case->basic_units->all() as $unit) {
                                if ($unit->total_qty < $unit->pivot->quantity) {
                                    throw new \Exception('Quantity of units in case is greater than quantity at hand.');
                                }
                            }
                        }

                        $order->cases()->attach([['cases_id' => $items[$i], 'quantity' => $item_qty[$i]]]);
                    }

                    if ($item_type === 'Kit') {
                        $total_items += $item_qty[$i];
                        $total_kits += $item_qty[$i];
                        $kit = Kit::find($items[$i]);
                        if ($kit->total_qty < $item_qty[$i]) {
                            throw new \Exception('Quantity of kits in order is greater than quantity at hand.');
                        }
                        $order->kits()->attach([['kit_id' => $items[$i], 'quantity' => $item_qty[$i]]]);
                    }

                    if ($item_type === 'Unit') {
                        //dd($items[$i]);
                        $total_items += $item_qty[$i];
                        $total_units += $item_qty[$i];
                        $unit = Basic_Unit::find($items[$i]);
                        if ($unit->total_qty < $item_qty[$i]) {
                            throw new \Exception('Quantity of units in order is greater than quantity at hand.');
                        }
                        $order->basic_units()->attach([['basic__unit_id' => $items[$i], 'quantity' => $item_qty[$i]]]);
                    }
                }




                    /**
                     * 
                     * Sets up Order() pallet qty, unit qty (if applies) and case qty (if applies)
                     * Saves Order() object to database and attaches pallets to order
                     * 
                     */

                    $order->case_qty = $total_cases;
                    $order->kit_qty = $total_kits;
                    $order->unit_qty = $total_units;
                    $order->save();
                    DB::commit();
                    Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
                    return response()->json([
                        'success'  => 'Fulfillment order submitted successfully.'
                    ]);
                
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'error'  => $e->getMessage()
                ]);
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $order = Order::find($id);
        return view('orders.show-order')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
    }

    public function updatestatus(Request $request, $id)
    {
        $order = Order::find($id);
        //dd($this->hasCases($order, 'cases'));
        $order->status = $request->status;
        $order->save();
        $useremail = User::find($order->user_id);
        $useremail = $useremail->email;
        
        if ($order->order_type == 'Transfer In Items' && $order->status == 'Completed') {

            if ($this->hasPallets($order, 'order')) {
                foreach ($order->pallets->all() as $pallet) {

                    if ($this->hasCartons($pallet, 'pallet')) {
                        foreach ($pallet->cartons->all() as $carton) {
                            if ($this->hasCases($carton, 'carton')) {
                                foreach ($carton->cases->all() as $case) {
                                    $caseobj = Cases::find($case->pivot->cases_id);
                                    $caseobj->total_qty += $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $caseobj->save();
                                    if ($this->hasKits($case, 'cases')) {
                                        foreach ($carton->kits->all() as $kit) {
                                            $kitobj = Kit::find($kit->pivot->kit_id);
                                            $kitobj->total_qty += $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                            $kitobj->save();
                                            if ($this->hasUnits($kit, 'kit')) {
                                                foreach ($kit->basic_units->all() as $unit) {
                                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                                    $unitobj->total_qty += $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                                    $unitobj->save();
                                                }
                                            }
                                        }
                                    }
                                    if ($this->hasUnits($case, 'case')) {
                                        foreach ($kit->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->total_qty += $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }

                            if ($this->hasKits($carton, 'carton')) {
                                foreach ($carton->kits->all() as $kit) {
                                    $kitobj = Kit::find($kit->pivot->kit_id);
                                    $kitobj->total_qty += $kit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $kitobj->save();
                                    if ($this->hasUnits($kit, 'kit')) {
                                        foreach ($kit->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->total_qty += $unit->pivot->quantity * $kit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }
                            if ($this->hasUnits($carton, 'carton')) {
                                foreach ($carton->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->total_qty +=  $unit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        }
                    }

                    if ($this->hasCases($pallet, 'pallet')) {
                        foreach ($pallet->cases->all() as $case) {
                            $caseobj = Cases::find($case->pivot->cases_id);
                            $caseobj->total_qty += $case->pivot->quantity * $pallet->pivot->quantity;
                            $caseobj->save();
                            if ($this->hasKits($case, 'cases')) {
                                foreach ($case->kits->all() as $kit) {
                                    $kitobj = Kit::find($kit->pivot->kit_id);
                                    $kitobj->total_qty += $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                    $kitobj->save();
                                    if ($this->hasUnits($kit, 'kit')) {
                                        foreach ($kit->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->total_qty += $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }
                            if ($this->hasUnits($case, 'cases')) {
                                foreach ($case->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->total_qty += $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        }
                    }

                    if ($this->hasKits($pallet, 'pallet')) {
                        foreach ($pallet->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);
                            $kitobj->total_qty += $kit->pivot->quantity * $pallet->pivot->quantity;
                            $kitobj->save();
                            if ($this->hasUnits($kit, 'kit')) {
                                foreach ($pallet->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->total_qty += $unit->pivot->quantity * $kit->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        }
                    }
                    if ($this->hasUnits($pallet, 'pallet')) {
                        foreach ($pallet->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->total_qty += $unit->pivot->quantity * $pallet->pivot->quantity;
                            $unitobj->save();
                        }
                    }

                    $pallet->delete();
                }
            }

            if ($this->hasCartons($order, 'order')) {
                foreach ($order->cartons->all() as $carton) {

                    if ($this->hasCases($carton, 'carton')) {
                        foreach ($carton->cases->all() as $case) {
                            $caseobj = Cases::find($case->pivot->cases_id);
                            $caseobj->total_qty += $case->pivot->quantity * $carton->pivot->quantity;
                            $caseobj->save();
                            if ($this->hasKits($case, 'cases')) {
                                foreach ($carton->kits->all() as $kit) {
                                    $kitobj = Kit::find($kit->pivot->kit_id);
                                    $kitobj->total_qty += $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity;
                                    $kitobj->save();
                                    if ($this->hasUnits($kit, 'kit')) {
                                        foreach ($kit->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->total_qty += $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity;
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }
                            if ($this->hasUnits($case, 'cases')) {
                                foreach ($kit->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->total_qty += $unit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        }
                    }

                    if ($this->hasKits($carton, 'carton')) {
                        foreach ($carton->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);
                            $kitobj->total_qty += $kit->pivot->quantity * $carton->pivot->quantity;
                            $kitobj->save();
                            if ($this->hasUnits($kit, 'kit')) {
                                foreach ($kit->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->total_qty += $unit->pivot->quantity * $kit->pivot->quantity * $carton->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        }
                    }
                    if ($this->hasUnits($carton, 'carton')) {
                        foreach ($carton->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->total_qty +=  $unit->pivot->quantity * $carton->pivot->quantity;
                            $unitobj->save();
                        }
                    }
                    $carton->delete();
                }
            }

            if ($this->hasCases($order, 'order')) {
                
                foreach ($order->cases->all() as $case) {
                    $caseobj = Cases::find($case->pivot->cases_id);
                    $caseobj->total_qty += $case->pivot->quantity;
                    $caseobj->save();
                    if ($this->hasKits($case, 'cases')) {
                        foreach ($order->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);
                            $kitobj->total_qty += $kit->pivot->quantity * $case->pivot->quantity;
                            $kitobj->save();
                            if ($this->hasUnits($kit, 'kit')) {
                                foreach ($kit->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->total_qty += $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        }
                    }
                    if ($this->hasUnits($case, 'cases')) {
                        foreach ($kit->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->total_qty += $unit->pivot->quantity * $case->pivot->quantity;
                            $unitobj->save();
                        }
                    }
                }
            }

            if ($this->hasKits($order, 'order')) {
                foreach ($order->kits->all() as $kit) {
                    $kitobj = Kit::find($kit->pivot->kit_id);
                    $kitobj->total_qty += $kit->pivot->quantity;
                    $kitobj->save();
                    if ($this->hasUnits($kit, 'kit')) {
                        foreach ($kit->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->total_qty += $unit->pivot->quantity * $kit->pivot->quantity;
                            $unitobj->save();
                        }
                    }
                }
            }

            if ($this->hasUnits($order, 'order')) {
                foreach ($order->basic_units->all() as $unit) {
                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                    $unitobj->total_qty += $unit->pivot->quantity;
                    $unitobj->save();
                }
            }
        } elseif ($order->order_type == 'Transfer Out Items' && $order->status == 'Completed') {

            if ($this->hasPallets($order, 'order')) {
                foreach ($order->pallets->all() as $pallet) {

                    if ($this->hasCartons($pallet, 'pallet')) {
                        foreach ($pallet->cartons->all() as $carton) {
                            if ($this->hasCases($carton, 'carton')) {
                                foreach ($carton->cases->all() as $case) {
                                    $caseobj = Cases::find($case->pivot->cases_id);
                                    $caseobj->total_qty -= $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $caseobj->save();
                                    if ($this->hasKits($case, 'cases')) {
                                        foreach ($carton->kits->all() as $kit) {
                                            $kitobj = Kit::find($kit->pivot->kit_id);
                                            $kitobj->total_qty -= $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                            $kitobj->save();
                                            if ($this->hasUnits($kit, 'kit')) {
                                                foreach ($kit->basic_units->all() as $unit) {
                                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                                    $unitobj->total_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                                    $unitobj->save();
                                                }
                                            }
                                        }
                                    }
                                    if ($this->hasUnits($case, 'cases')) {
                                        foreach ($kit->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->total_qty -= $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }

                            if ($this->hasKits($carton, 'carton')) {
                                foreach ($carton->kits->all() as $kit) {
                                    $kitobj = Kit::find($kit->pivot->kit_id);
                                    $kitobj->total_qty -= $kit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $kitobj->save();
                                    if ($this->hasUnits($kit, 'kit')) {
                                        foreach ($kit->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->total_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }
                            if ($this->hasUnits($carton, 'carton')) {
                                foreach ($carton->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->total_qty -=  $unit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        }
                    }

                    if ($this->hasCases($pallet, 'pallet')) {
                        foreach ($pallet->cases->all() as $case) {
                            $caseobj = Cases::find($case->pivot->cases_id);
                            $caseobj->total_qty -= $case->pivot->quantity * $pallet->pivot->quantity;
                            $caseobj->save();
                            if ($this->hasKits($case, 'cases')) {
                                foreach ($carton->kits->all() as $kit) {
                                    $kitobj = Kit::find($kit->pivot->kit_id);
                                    $kitobj->total_qty -= $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                    $kitobj->save();
                                    if ($this->hasUnits($kit, 'kit')) {
                                        foreach ($kit->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->total_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }
                            if ($this->hasUnits($case, 'cases')) {
                                foreach ($kit->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->total_qty -= $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        }
                    }

                    if ($this->hasKits($pallet, 'pallet')) {
                        foreach ($pallet->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);
                            $kitobj->total_qty -= $kit->pivot->quantity * $pallet->pivot->quantity;
                            $kitobj->save();
                            if ($this->hasUnits($kit, 'kit')) {
                                foreach ($pallet->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->total_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        }
                    }
                    if ($this->hasUnits($pallet, 'pallet')) {
                        foreach ($pallet->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->total_qty -= $unit->pivot->quantity * $pallet->pivot->quantity;
                            $unitobj->save();
                        }
                    }

                    $pallet->delete();
                }
            }

            if ($this->hasCartons($order, 'order')) {
                foreach ($order->cartons->all() as $carton) {

                    if ($this->hasCases($carton, 'carton')) {
                        foreach ($carton->cases->all() as $case) {
                            $caseobj = Cases::find($case->pivot->cases_id);
                            $caseobj->total_qty -= $case->pivot->quantity * $carton->pivot->quantity;
                            $caseobj->save();
                            if ($this->hasKits($case, 'cases')) {
                                foreach ($carton->kits->all() as $kit) {
                                    $kitobj = Kit::find($kit->pivot->kit_id);
                                    $kitobj->total_qty -= $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity;
                                    $kitobj->save();
                                    if ($this->hasUnits($kit, 'kit')) {
                                        foreach ($kit->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->total_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity;
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }
                            if ($this->hasUnits($case, 'cases')) {
                                foreach ($kit->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->total_qty -= $unit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        }
                    }

                    if ($this->hasKits($carton, 'carton')) {
                        foreach ($carton->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);
                            $kitobj->total_qty -= $kit->pivot->quantity * $carton->pivot->quantity;
                            $kitobj->save();
                            if ($this->hasUnits($kit, 'kit')) {
                                foreach ($kit->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->total_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $carton->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        }
                    }
                    if ($this->hasUnits($carton, 'carton')) {
                        foreach ($carton->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->total_qty -=  $unit->pivot->quantity * $carton->pivot->quantity;
                            $unitobj->save();
                        }
                    }
                    $carton->delete();
                }
            }

            if ($this->hasCases($order, 'order')) {
                foreach ($order->cases->all() as $case) {
                    $caseobj = Cases::find($case->pivot->cases_id);
                    $caseobj->total_qty -= $case->pivot->quantity;
                    $caseobj->save();
                    if ($this->hasKits($case, 'cases')) {
                        foreach ($order->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);
                            $kitobj->total_qty -= $kit->pivot->quantity * $case->pivot->quantity;
                            $kitobj->save();
                            if ($this->hasUnits($kit, 'kit')) {
                                foreach ($kit->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->total_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        }
                    }
                    if ($this->hasUnits($case, 'cases')) {
                        foreach ($kit->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->total_qty -= $unit->pivot->quantity * $case->pivot->quantity;
                            $unitobj->save();
                        }
                    }
                }
            }

            if ($this->hasKits($order, 'order')) {
                foreach ($order->kits->all() as $kit) {
                    $kitobj = Kit::find($kit->pivot->kit_id);
                    $kitobj->total_qty -= $kit->pivot->quantity;
                    $kitobj->save();
                    if ($this->hasUnits($kit, 'kit')) {
                        foreach ($kit->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->total_qty -= $unit->pivot->quantity * $kit->pivot->quantity;
                            $unitobj->save();
                        }
                    }
                }
            }

            if ($this->hasUnits($order, 'order')) {
                foreach ($order->basic_units->all() as $unit) {
                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                    $unitobj->total_qty -= $unit->pivot->quantity;
                    $unitobj->save();
                }
            }
        } elseif ($order->order_type == 'Fulfill Items' && $order->status == 'Completed') {

            if ($this->hasPallets($order, 'order')) {
                foreach ($order->pallets->all() as $pallet) {

                    if ($this->hasCartons($pallet, 'pallet')) {
                        foreach ($pallet->cartons->all() as $carton) {
                            if ($this->hasCases($carton, 'carton')) {
                                foreach ($carton->cases->all() as $case) {
                                    $caseobj = Cases::find($case->pivot->cases_id);
                                    $caseobj->total_qty -= $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $caseobj->save();
                                }
                            }

                            if ($this->hasKits($carton, 'carton')) {
                                foreach ($carton->kits->all() as $kit) {
                                    $kitobj = Kit::find($kit->pivot->kit_id);
                                    $kitobj->total_qty -= $kit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $kitobj->save();
                                }
                            }
                            if ($this->hasUnits($carton, 'carton')) {
                                foreach ($carton->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->total_qty -=  $unit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        }
                    }

                    if ($this->hasCases($pallet, 'pallet')) {
                        foreach ($pallet->cases->all() as $case) {
                            $caseobj = Cases::find($case->pivot->cases_id);

                            $caseobj->total_qty -= $case->pivot->quantity * $pallet->pivot->quantity;
                            $caseobj->save();
                        }
                    }

                    if ($this->hasKits($pallet, 'pallet')) {
                        foreach ($pallet->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);

                            $kitobj->total_qty -= $kit->pivot->quantity * $pallet->pivot->quantity;
                            $kitobj->save();
                        }
                    }
                    if ($this->hasUnits($pallet, 'pallet')) {
                        foreach ($pallet->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->total_qty -= $unit->pivot->quantity * $pallet->pivot->quantity;
                            $unitobj->save();
                        }
                    }

                    $pallet->delete();
                }
            }

            if ($this->hasCartons($order, 'order')) {
                foreach ($order->cartons->all() as $carton) {

                    if ($this->hasCases($carton, 'carton')) {
                        foreach ($carton->cases->all() as $case) {
                            $caseobj = Cases::find($case->pivot->cases_id);
                            $caseobj->total_qty -= $case->pivot->quantity * $carton->pivot->quantity;
                            $caseobj->save();
                        }
                    }

                    if ($this->hasKits($carton, 'carton')) {
                        foreach ($carton->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);
                            $kitobj->total_qty -= $kit->pivot->quantity * $carton->pivot->quantity;
                            $kitobj->save();
                        }
                    }
                    if ($this->hasUnits($carton, 'carton')) {
                        foreach ($carton->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->total_qty -=  $unit->pivot->quantity * $carton->pivot->quantity;
                            $unitobj->save();
                        }
                    }
                    $carton->delete();
                }
            }

            if ($this->hasCases($order, 'order')) {
                foreach ($order->cases->all() as $case) {
                    $caseobj = Cases::find($case->pivot->cases_id);
                    $caseobj->total_qty -= $case->pivot->quantity;
                    $caseobj->save();
                }
            }

            if ($this->hasKits($order, 'order')) {
                foreach ($order->kits->all() as $kit) {
                    $kitobj = Kit::find($kit->pivot->kit_id);
                    $kitobj->total_qty -= $kit->pivot->quantity;
                    $kitobj->save();
                }
            }

            if ($this->hasUnits($order, 'order')) {
                foreach ($order->basic_units->all() as $unit) {
                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                    $unitobj->total_qty -= $unit->pivot->quantity;
                    $unitobj->save();
                }
            }
        }
    


        $order_history = Order::find($id);
        $order_history = $order_history->toArray();
        OrderHistory::insert($order_history);
        Mail::to($useremail)->send(new StorUpdateMail($order));
        Mail::to('ship@fillstorship.com')->send(new StorUpdateMail($order));
        return redirect()->back()->with('success', 'Storage Order has been updated.');
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->pallets()->detach();
        $order->cases()->detach();
        $order->kits()->detach();
        $order->basic_units()->detach();
        $order->delete();
        return redirect()->back()->with('success', 'You have successfully deleted order.');
    }
}
