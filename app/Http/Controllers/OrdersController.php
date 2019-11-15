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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    function store_transin_unit(Request $request)
    {
        if ($request->ajax()) {
            $rules = array(
                'units.*'  => 'required',
                'unit_qty.*'  => 'required'
            );



            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }
            $order = new Order();
            $ordernumber = new OrderNumber();
            $ordernumber->save();
            $ordernumber->fss_id = $ordernumber->id + 100;
            $ordernumber->user_id = auth()->user()->id;
            $order->orderid = $ordernumber->fss_id;
            $order->ordernumber_id = $ordernumber->id;
            $ordernumber->save();


            $unit = new Basic_Unit();
            $order->name = $request->unit_name;
            $order->user_id = auth()->user()->id;
            $order->company = auth()->user()->company_name;
            $order->order_type = $request->order_type;
            $order->barcode = $request->barcode;
            $order->status = 'Pending';
            $order->description = $request->unit_desc;


            $units = $request->units;
            $unit_qty = $request->unit_qty;
            $total_units = 0;

            for ($i = 0; $i < count($units); $i++) {
                $total_units += $unit_qty[$i];
                $data = array(
                    'basic__unit_id' => $units[$i],
                    'quantity'  => $unit_qty[$i]
                );
                $insert_data[] = $data;
            }

            $order->unit_qty = $total_units;
            $order->tot_qty = $total_units;
            $order->save();
            $order->basic_units()->attach($insert_data);

            Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
            //return response()->json($insert_data);
            return response()->json([
                'success'  => 'Order submitted successfully.'
            ]);
        }
    }

    function store_transout_unit(Request $request)
    {
        if ($request->ajax()) {
            $rules = array(
                'units.*'  => 'required',
                'unit_qty.*'  => 'required'
            );



            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }
            $order = new Order();
            $ordernumber = new OrderNumber();
            $ordernumber->save();
            $ordernumber->fss_id = $ordernumber->id + 100;
            $ordernumber->user_id = auth()->user()->id;
            $order->orderid = $ordernumber->fss_id;
            $ordernumber->save();
            $unit = new Basic_Unit();
            $order->name = $request->unit_name;
            $order->user_id = auth()->user()->id;
            $order->company = auth()->user()->company_name;
            $order->order_type = $request->order_type;
            $order->barcode = $request->barcode;
            $order->status = 'Pending';
            $order->description = $request->unit_desc;


            $units = $request->units;
            $unit_qty = $request->unit_qty;
            $total_units = 0;

            for ($y = 0; $y < count($unit_qty); $y++) {
                $unit = Basic_Unit::find($units[$y]);
                if ($unit_qty[$y] > $unit->loose_item_qty) {
                    return response()->json([
                        'error'  => 'Quantity input greater than quantity at hand. Please provide valid value.'
                    ]);
                }
            }

            for ($i = 0; $i < count($units); $i++) {
                $total_units += $unit_qty[$i];
                $data = array(
                    'basic__unit_id' => $units[$i],
                    'quantity'  => $unit_qty[$i]
                );
                $insert_data[] = $data;
            }

            $order->unit_qty = $total_units;
            $order->tot_qty = $total_units;
            $order->save();
            $order->basic_units()->attach($insert_data);

            Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
            return response()->json([
                'success'  => 'Order submitted successfully.'
            ]);
        }
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

    public function create_unit_order()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $units = $user->basic_units->sortKeysDesc();
        return view('orders.trans-in-unit')->with('units', $units);
    }

    public function create_transout_unit()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $units = $user->basic_units->sortKeysDesc();
        return view('orders.trans-out-unit')->with('units', $units);
    }

    public function create_transin_case()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $cases = $user->cases->sortKeysDesc();
        return view('orders.trans-in-case')->with('cases', $cases);
    }

    public function create_transout_case()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $cases = $user->cases->sortKeysDesc();
        return view('orders.trans-out-case')->with('cases', $cases);
    }

    public function create_transout_kit()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $kits = $user->kits->sortKeysDesc();
        return view('orders.trans-out-kit')->with('kits', $kits);
    }

    public function create_transin_pallet()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $units = $user->basic_units->sortkeysDesc();
        $cases = $user->cases->sortkeysDesc();
        $pallets = $user->pallets->sortkeysDesc();
        return view('pallet.trans-in-pallet')->with('pallets', $pallets)->with('cases', $cases);
    }

    public function create_transout_pallet()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $cases = $user->cases->sortkeysDesc();
        $pallets = $user->pallets->sortkeysDesc();
        return view('pallet.trans-out-pallet')->with('pallets', $pallets)->with('cases', $cases);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_transin_kit(Request $request)
    {
        /**
         * Establishes rules for form input
         * If fields are not filled in, will return json error message
         */
        if ($request->ajax()) {
            $rules = array(
                'kits.*'  => 'required',
                'kit_qty.*'  => 'required'
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
            $order->save();


            $ordernumber = new OrderNumber();
            $ordernumber->save();
            $ordernumber->fss_id = $ordernumber->id + 100;
            $ordernumber->user_id = auth()->user()->id;
            $order->orderid = $ordernumber->fss_id;
            $order->ordernumber_id = $ordernumber->id;
            $ordernumber->save();

            $order->name = $request->case_name;
            $order->user_id = auth()->user()->id;
            $order->company = auth()->user()->company_name;
            $order->order_type = $request->order_type;
            $order->barcode = $request->barcode;
            $order->status = 'Pending Approval';
            $order->description = $request->desc;


            /**
             * 
             * Creates variables to store input array from the kit input (array of kit ids) and kit quantity
             * Creates variables for object totals -> kits, and units
             * 
             */
            $kits = $request->kits;
            $kit_qty = $request->kit_qty;
            $total_kits = 0;
            $total_units = 0;


            /**
             * 
             * Code that loops through kits in array.
             * 
             * Loops through Units per kit if not False and updates total_units
             * 
             */
            for ($i = 0; $i < count($kits); $i++) {
                $total_kits += $kit_qty[$i];
                $kit = Kit::find($kits[$i]);

                $data = array(
                    'kit_id' => $kits[$i],
                    'quantity'  => $kit_qty[$i]
                );
                $kit_data[] = $data;

                if ($kit->basic_units->all()) {
                    $units = $kit->basic_units->all();
                    foreach ($units as $unit) {
                        $total_units += $unit->pivot->quantity *  $kit_qty[$i];
                    }
                }
            }


            /**
             * 
             * Sets up Order() kit qty, unit qty
             * Saves Order() object to database and attaches pallets to order
             * 
             */
            $order->kit_qty = $total_kits;
            $order->unit_qty = $total_units;

            $order->save();

            $order->kits()->attach($kit_data);

            Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
            return response()->json([
                'success'  => 'Order submitted successfully.'
            ]);
        }
    }

    public function store_transout_kit(Request $request)
    {
        /**
         * Establishes rules for form input
         * If fields are not filled in, will return json error message
         */
        if ($request->ajax()) {
            $rules = array(
                'kits.*'  => 'required',
                'kit_qty.*'  => 'required'
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
            $order->name = $request->case_name;
            $order->user_id = auth()->user()->id;
            $order->company = auth()->user()->company_name;
            $order->order_type = $request->order_type;
            $order->barcode = $request->barcode;
            $order->status = 'Pending Approval';
            $order->description = $request->desc;


            /**
             * 
             * Creates variables to store input array from the kit input (array of kit ids) and kit quantity
             * Creates variables for object totals -> kits, and units
             * 
             */
            $kits = $request->kits;
            $kit_qty = $request->kit_qty;
            $total_kits = 0;
            $total_units = 0;


            /**
             * 
             * Code that loops through kits in array.
             * 
             * Loops through Units per kit if not False and updates total_units
             * 
             */
            for ($i = 0; $i < count($kits); $i++) {
                $total_kits += $kit_qty[$i];
                $kit = Kit::find($kits[$i]);

                $data = array(
                    'kit_id' => $kits[$i],
                    'quantity'  => $kit_qty[$i]
                );
                $kit_data[] = $data;

                if ($kit->basic_units->all()) {
                    $units = $kit->basic_units->all();
                    foreach ($units as $unit) {
                        $total_units += $unit->pivot->quantity *  $kit_qty[$i];
                    }
                }
            }


            /**
             * 
             * Sets up Order() kit qty, unit qty
             * Saves Order() object to database and attaches pallets to order
             * 
             */
            $order->kit_qty = $total_kits;
            $order->unit_qty = $total_units;

            $order->save();
            $order->kits()->attach($kit_data);

            Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
            return response()->json([
                'success'  => 'Order submitted successfully.'
            ]);
        }
    }

    public function store_transin_case(Request $request)
    {

        /**
         * 
         *  Establishes rules to check when form is submitted to controller
         *  If input does not pass rules, returns user to the Transfer In Case page to complete form with correct information
         * 
         */

        if ($request->ajax()) {
            $rules = array(
                'cases.*'  => 'required',
                'case_qty.*'  => 'required'
            );



            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }

            /**
             * 
             * Creates Order object. Sets up attributes for the object
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

            $order->name = $request->case_name;
            $order->user_id = auth()->user()->id;
            $order->company = auth()->user()->company_name;
            $order->order_type = $request->order_type;
            $order->barcode = $request->barcode;
            $order->status = 'Pending';
            $order->description = $request->desc;



            /**
             * 
             * Creates variables for input arrays from Transfer In Form
             * Also sets up counters for total # of cases, units and kits
             * 
             */
            $cases = $request->cases;
            $case_qty = $request->case_qty;
            $total_cases = 0;
            $total_units = 0;
            $total_kits = 0;


            /**
             * 
             * Logic for processing Transfer In Order
             * Goes through each case and checks for relationship with Kits or look Units
             * Creates array of Case Id's and quantitys to attach to order later
             * 
             */

            for ($i = 0; $i < count($cases); $i++) {
                $total_cases += $case_qty[$i];
                $case = Cases::find($cases[$i]);

                if ($case->basic_units->all()) {

                    foreach ($case->basic_units->all() as $unit) {
                        $total_units += $unit->pivot->quantity * $case_qty[$i];
                    }
                }

                if ($case->kits->all()) {
                    foreach ($case->kits->all() as $kit) {
                        $total_kits += $kit->pivot->quantity * $case_qty[$i];
                    }
                    foreach ($kit->basic_units->all() as $unit) {
                        $total_units += $unit->pivot->quantity * $kit->pivot->quantity * $case_qty[$i];
                    }
                }


                $data = array(
                    'cases_id' => $cases[$i],
                    'quantity'  => $case_qty[$i]
                );
                $insert_data[] = $data;
            }


            /**
             * 
             * Updates Order attributes such as unit quantity, kit quantity, case quantity.
             * Saves order and attaches array of Case ID's
             * 
             */
            $order->unit_qty = $total_units;
            $order->kit_qty = $total_kits;
            $order->case_qty = $total_cases;

            $order->save();
            $order->cases()->attach($insert_data);



            /**
             * 
             * Sends email to FSS and returns response to user
             * 
             */
            Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
            return response()->json([
                'success'  => 'Order submitted successfully.'
            ]);
        }
    }


    public function store_transout_case(Request $request)
    {

        /**
         * 
         *  Establishes rules to check when form is submitted to controller
         *  If input does not pass rules, returns user to the Transfer Out Case page to complete form with correct information
         * 
         */

        if ($request->ajax()) {
            $rules = array(
                'cases.*'  => 'required',
                'case_qty.*'  => 'required'
            );

            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }

            /**
             * 
             * Creates Order object. Sets up attributes for the object
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

            $order->name = $request->case_name;
            $order->user_id = auth()->user()->id;
            $order->company = auth()->user()->company_name;
            $order->order_type = $request->order_type;
            $order->barcode = $request->barcode;
            $order->status = 'Pending Approval';
            $order->description = $request->desc;


            /**
             * 
             * Creates variables for input arrays from Transfer In Form
             * Also sets up counters for total # of cases, units and kits
             * 
             */
            $cases = $request->cases;
            $case_qty = $request->case_qty;
            $total_cases = 0;
            $total_kits = 0;
            $total_units = 0;

            for ($y = 0; $y < count($case_qty); $y++) {
                $case = Cases::find($cases[$y]);
                if ($case_qty[$y] > $case->case_qty) {
                    return response()->json([
                        'error'  => 'Quantity input greater than quantity at hand. Please provide valid value.'
                    ]);
                }
            }


            /**
             * 
             * Logic for processing Transfer In Order
             * Goes through each case and checks for relationship with Kits or look Units
             * Creates array of Case Id's and quantitys to attach to order later
             * 
             */

            for ($i = 0; $i < count($cases); $i++) {
                $total_cases += $case_qty[$i];
                $case = Cases::find($cases[$i]);
                $units = $case->basic_units->all();
                if ($case->basic_units->all()) {
                    foreach ($case->basic_units->all() as $unit) {
                        $total_units += $unit->pivot->quantity * $case_qty[$i];
                    }
                }

                if ($case->kits->all()) {
                    foreach ($case->kits->all() as $kit) {
                        $total_kits += $kit->pivot->quantity * $case_qty[$i];
                    }
                    foreach ($kit->basic_units->all() as $unit) {
                        $total_units += $unit->pivot->quantity * $kit->pivot->quantity * $case_qty[$i];
                    }
                }


                $data = array(
                    'cases_id' => $cases[$i],
                    'quantity'  => $case_qty[$i]
                );
                $insert_data[] = $data;
            }


            /**
             * 
             * Updates Order attributes such as unit quantity, kit quantity, case quantity.
             * Saves order and attaches array of Case ID's
             * 
             */
            $order->unit_qty = $total_units;
            $order->case_qty = $total_cases;
            $order->tot_qty = $total_units;
            $order->save();
            $order->cases()->attach($insert_data);


            /**
             * 
             * Sends email to FSS and returns response to user
             * 
             */
            Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
            return response()->json([
                'success'  => 'Order submitted successfully.'
            ]);
        }
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
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'error'  => $e->getMessage()
                ]);
            }
        }
    }

    public function store_transin_pallet(Request $request)
    {

        /**
         * 
         * Establishes rules for form input
         * If fields are not filled in, will return json error message
         * 
         */
        if ($request->ajax()) {
            $rules = array(
                'pallets.*'  => 'required',
                'pallet_qty.*'  => 'required'
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

            $order->name = $request->case_name;
            $order->user_id = auth()->user()->id;
            $order->company = auth()->user()->company_name;
            $order->order_type = $request->order_type;
            $order->barcode = $request->barcode;
            $order->status = 'Pending Approval';
            $order->description = $request->desc;


            /**
             * 
             * Creates variables to store input array from the pallet input (array of pallet ids) and pallet quantity
             * Creates variables for object totals -> pallets, cases (if applies), and units (if applies)
             * 
             */
            $pallets = $request->pallets;
            $pallet_qty = $request->pallet_qty;
            $total_pallets = 0;
            $total_cases = 0;
            $total_units = 0;
            $total_kits = 0;


            /**
             * 
             * Code that loops through pallets in array.
             * Loops through Cases per pallet if not False and updates total_cases
             * Loops through Units per pallet if not False and updates total_units
             * 
             */
            for ($i = 0; $i < count($pallets); $i++) {
                $total_pallets += $pallet_qty[$i];
                $pallet = Pallet::find($pallets[$i]);

                $data = array(
                    'pallet_id' => $pallets[$i],
                    'quantity'  => $pallet_qty[$i]
                );
                $pallet_data[] = $data;

                if ($pallet->cases->all()) {

                    foreach ($pallet->cases->all() as $case) {

                        $total_cases += $case->pivot->quantity * $pallet_qty[$i];

                        if ($case->basic_units->all()) {
                            $units = $case->basic_units->all();
                            foreach ($units as $unit) {
                                $total_units += $unit->pivot->quantity * $case->pivot->quantity * $pallet_qty[$i];
                            }
                        }

                        if ($case->kits->all()) {

                            foreach ($case->kits->all() as $kit) {
                                $total_kits += $kit->pivot->quantity * $case->pivot->quantity * $pallet_qty[$i];

                                if ($kit->basic_units->all()) {
                                    $units = $kit->basic_units->all();
                                    foreach ($units as $unit) {
                                        $total_units += $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet_qty[$i];
                                    }
                                }
                            }
                        }
                    }
                }

                if ($pallet->kits->all()) {
                    foreach ($pallet->kits->all() as $kit) {

                        $total_kits += $kit->pivot->quantity * $pallet_qty[$i];

                        if ($kit->basic_units->all()) {
                            foreach ($kit->basic_units->all() as $unit) {
                                $total_units += $unit->pivot->quantity * $kit->pivot->quantity * $pallet_qty[$i];
                            }
                        }
                    }
                }

                if ($pallet->basic_units->all()) {
                    $units = $pallet->basic_units->all();
                    foreach ($units as $unit) {
                        $total_units += $unit->pivot->quantity *  $pallet_qty[$i];
                    }
                }
            }


            /**
             * 
             * Sets up Order() pallet qty, unit qty (if applies) and case qty (if applies)
             * Saves Order() object to database and attaches pallets to order
             * 
             */
            $order->pallet_qty = $total_pallets;
            $order->unit_qty = $total_units;
            $order->case_qty = $total_cases;
            $order->kit_qty = $total_kits;

            $order->save();
            $order->pallets()->attach($pallet_data);

            Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
            return response()->json([
                'success'  => 'Order submitted successfully.'
            ]);
        }
    }

    public function store_transout_pallet(Request $request)
    {


        /**
         * 
         * Establishes rules for form input
         * If fields are not filled in, will return json error message
         * 
         */

        if ($request->ajax()) {
            $rules = array(
                'pallets.*'  => 'required',
                'pallet_qty.*'  => 'required'
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

            $order->name = $request->name;
            $order->user_id = auth()->user()->id;
            $order->company = auth()->user()->company_name;
            $order->order_type = $request->order_type;
            $order->barcode = $request->barcode;
            $order->status = 'Pending Approval';
            $order->description = $request->desc;



            /**
             * 
             * Creates variables to store input array from the pallet input (array of pallet ids) and pallet quantity
             * Creates variables for object totals -> pallets, cases (if applies), and units (if applies)
             * 
             */
            $pallets = $request->pallets;
            $pallet_qty = $request->pallet_qty;
            $total_pallets = 0;
            $total_cases = 0;
            $total_units = 0;
            $total_kits = 0;


            for ($y = 0; $y < count($pallet_qty); $y++) {
                $pallet = Pallet::find($pallets[$y]);
                if ($pallet_qty[$y] > $pallet->pallet_qty) {
                    return response()->json([
                        'error'  => 'Quantity input greater than quantity at hand. Please provide valid value.'
                    ]);
                }
            }

            /**
             * 
             * Code that loops through pallets in array.
             * Loops through Cases per pallet if not False and updates total_cases
             * Loops through Units per pallet if not False and updates total_units
             * 
             */

            for ($i = 0; $i < count($pallets); $i++) {
                $total_pallets += $pallet_qty[$i];
                $pallet = Pallet::find($pallets[$i]);

                $data = array(
                    'pallet_id' => $pallets[$i],
                    'quantity'  => $pallet_qty[$i]
                );
                $pallet_data[] = $data;

                if ($pallet->cases->all()) {

                    $cases = $pallet->cases->all();

                    foreach ($cases as $case) {

                        $total_cases += $case->pivot->quantity * $pallet_qty[$i];

                        if ($case->basic_units->all()) {
                            $units = $case->basic_units->all();
                            foreach ($units as $unit) {
                                $total_units += $unit->pivot->quantity * $case->pivot->quantity * $pallet_qty[$i];
                            }
                        }

                        if ($case->kits->all()) {
                            $kits = $case->kits->all();
                            foreach ($kits as $kit) {
                                $total_kits += $kit->pivot->quantity * $case->pivot->quantity * $pallet_qty[$i];

                                if ($kit->basic_units->all()) {
                                    $units = $kit->basic_units->all();
                                    foreach ($units as $unit) {
                                        $total_units += $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet_qty[$i];
                                    }
                                }
                            }
                        }
                    }
                }

                if ($pallet->basic_units->all()) {
                    $units = $pallet->basic_units->all();
                    foreach ($units as $unit) {
                        $total_units += $unit->pivot->quantity *  $pallet_qty[$i];
                    }
                }

                if ($pallet->kits->all()) {
                    $kits = $pallet->kits->all();
                    foreach ($kits as $kit) {
                        $total_kits += $kit->pivot->quantity * $pallet[$i];
                        if ($kit->basic_units->all()) {
                            $units = $kit->basic_units->all();
                            foreach ($units as $unit) {
                                $total_units += $unit->pivot->quantity * $kit->pivot->quantity * $pallet_qty[$i];
                            }
                        }
                    }
                }
            }


            /**
             * 
             * Sets up Order() pallet qty, unit qty (if applies) and case qty (if applies)
             * Saves Order() object to database and attaches pallets to order
             * 
             */
            $order->pallet_qty = $total_pallets;
            $order->unit_qty = $total_units;
            $order->case_qty = $total_cases;
            $order->tot_qty = $total_units;
            $order->save();
            $order->pallets()->attach($pallet_data);

            Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
            return response()->json([
                'success'  => 'Order submitted successfully.'
            ]);
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
    {
        //
        $order = Order::find($id);
        $user_id = $order->user_id;
        $user = User::find($user_id);
        $kits = $user->kits->sortKeysDesc();
        return view('orders.edit-order-kit')->with('order', $order)->with('kits', $kits);
    }

    public function edit_unit_order($id)
    {
        $order = Order::find($id);
        $user_id = $order->user_id;
        $user = User::find($user_id);
        $units = $user->basic_units->sortKeysDesc();
        return view('orders.edit-order-unit')->with('order', $order)->with('units', $units);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $order = Order::find($id);

        $request->validate([
            'transin_kit_name' => 'required',
            'transin_kit_qty' => 'required',
            'transin_kit_barcode' => 'nullable',
            'transin_kit_desc' => 'nullable',
            'transin_kit_qty' => 'required',
            'kits' => 'required',
        ]);

        $order->name = $request->transin_kit_name;
        $order->order_type = 'Transfer In Kits';
        $order->barcode = $request->transin_kit_barcode;
        $order->description = $request->transin_kit_desc;
        $order->kit_qty = $request->transin_kit_qty;
        $order->unit_qty = $request->transin_kit_unit_qty;
        $kits_tot = $request->transin_kit_qty;
        $unit_qty = $request->transin_kit_unit_qty;
        $order->tot_qty = (int) $kits_tot * (int) $unit_qty;
        $order->save();
        $order->kits()->sync($request->kits);
        Mail::to('ship@fillstorship.com')->send(new StorUpdateMail($order));
        return redirect('/editorder/kit' . '/' . $id)->with('success', 'You have updated the following order: #' . $request->id);
    }

    public function update_unit_order(Request $request, $id)
    {
        if ($request->ajax()) {
            $rules = array(
                'units.*'  => 'required',
                'unit_qty.*'  => 'required'
            );



            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }
            $order = Order::find($id);
            $user = User::find($order->user_id);
            $user_email = $user->email;
            $unit = new Basic_Unit();
            $order->name = $request->unit_name;
            $order->order_type = $request->order_type;
            $order->barcode = $request->barcode;
            //$order->status = 'Pending';
            $order->description = $request->unit_desc;


            $units = $request->units;
            $unit_qty = $request->unit_qty;
            $total_units = 0;

            for ($i = 0; $i < count($units); $i++) {
                $total_units += $unit_qty[$i];
                $data = array(
                    'basic__unit_id' => $units[$i],
                    'quantity'  => $unit_qty[$i]
                );
                $insert_data[] = $data;
            }

            $order->unit_qty = $total_units;
            $order->tot_qty = $total_units;
            $order->save();
            $order->basic_units()->detach();
            $order->basic_units()->attach($insert_data);

            Mail::to($user_email)->send(new StorUpdateMail($order));
            Mail::to('ship@fillstorship.com')->send(new StorUpdateMail($order));
            //return response()->json($insert_data);
            return response()->json([
                'success'  => 'Order submitted successfully.'
            ]);
        }
    }

    public function updatestatus(Request $request, $id)
    {
        $order = Order::find($id);

        $order->status = $request->status;
        $order->save();
        $useremail = User::find($order->user_id);
        $useremail = $useremail->email;
        if ($order->order_type == 'Transfer In Units' && $order->status == 'Completed') {
            $units = $order->basic_units->all();
            foreach ($units as $item) {
                $unit = Basic_Unit::find($item->pivot->basic__unit_id);
                $unit->loose_item_qty += $item->pivot->quantity;
                $unit->total_qty += $item->pivot->quantity;
                $unit->save();
                //dd($unit);
            }
            $order->basic_units()->detach();
        } elseif ($order->order_type == 'Transfer Out Units' && $order->status == 'Completed') {
            $units = $order->basic_units->all();
            foreach ($units as $item) {
                $unit = Basic_Unit::find($item->pivot->basic__unit_id);
                $unit->loose_item_qty -= $item->pivot->quantity;
                $unit->total_qty -=  $item->pivot->quantity;
                $unit->save();
                //dd($unit);
            }
            $order->basic_units()->detach();
        } elseif ($order->order_type == 'Transfer In Kits' && $order->status == 'Completed') {

            $kits = $order->kits->all();

            foreach ($kits as $kit) {
                $kitobj = Kit::find($kit->pivot->kit_id);
                $kitobj->kit_qty += $kit->pivot->quantity;
                $kitobj->total_qty += $kit->pivot->quantity;
                $kitobj->save();


                foreach ($kit->basic_units->all() as $unit) {
                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                    $unitobj->kit_qty += $unit->pivot->quantity * $kit->pivot->quantity;
                    $unitobj->total_qty += $unit->pivot->quantity * $kit->pivot->quantity;
                    $unitobj->save();
                }
            }
            $order->cases()->detach();
        } elseif ($order->order_type == 'Transfer Out Kits' && $order->status == 'Completed') {

            $kits = $order->kits->all();

            foreach ($kits as $kit) {
                $kitobj = Kit::find($kit->pivot->kit_id);
                $kitobj->kit_qty -= $kit->pivot->quantity;
                $kitobj->total_qty -= $kit->pivot->quantity;
                $kitobj->save();


                foreach ($kit->basic_units->all() as $unit) {
                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                    $unitobj->kit_qty -= $unit->pivot->quantity * $kit->pivot->quantity;
                    $unitobj->total_qty -= $unit->pivot->quantity * $kit->pivot->quantity;
                    $unitobj->save();
                }
            }
            $order->kits()->detach();
        } elseif ($order->order_type == 'Transfer In Cases' && $order->status == 'Completed') {

            $cases = $order->cases->all();

            foreach ($cases as $case) {
                $caseobj = Cases::find($case->pivot->cases_id);
                $caseobj->case_qty += $case->pivot->quantity;
                $caseobj->total_qty += $case->pivot->quantity;
                $caseobj->save();


                if ($case->basic_units->all()) {
                    foreach ($case->basic_units->all() as $unit) {
                        $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                        $caseobj->basic_unit_qty += $unit->pivot->quantity * $case->pivot->quantity;
                        $unitobj->case_qty += $unit->pivot->quantity * $case->pivot->quantity;
                        $unitobj->total_qty += $unit->pivot->quantity * $case->pivot->quantity;
                        $unitobj->save();
                    }
                }

                if ($case->kits->all()) {
                    foreach ($case->kits->all() as $kit) {
                        $kitobj = Kit::find($kit->pivot->kit_id);
                        $caseobj->kit_qty += $kit->pivot->quantity * $case->pivot->quantity;
                        $kitobj->case_qty += $kit->pivot->quantity * $case->pivot->quantity;
                        $kitobj->total_qty += $kit->pivot->quantity * $case->pivot->quantity;
                        $kitobj->save();

                        foreach ($kit->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $caseobj->basic_unit_qty += $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity;
                            $unitobj->case_qty += $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity;
                            //$unitobj->kit_qty += $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity;
                            //$unitobj->pallet_qty += $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity;
                            $unitobj->total_qty += $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity;
                            $unitobj->save();
                        }
                    }
                }
            }
            $order->cases()->detach();
        } elseif ($order->order_type == 'Transfer Out Cases' && $order->status == 'Completed') {

            $cases = $order->cases->all();

            foreach ($cases as $case) {
                $caseobj = Cases::find($case->pivot->cases_id);
                $caseobj->case_qty -= $case->pivot->quantity;
                $caseobj->total_qty -= $case->pivot->quantity;
                $caseobj->save();


                if ($case->basic_units->all()) {
                    foreach ($case->basic_units->all() as $unit) {
                        $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                        $caseobj->basic_unit_qty -= $unit->pivot->quantity * $case->pivot->quantity;
                        $unitobj->case_qty -= $unit->pivot->quantity * $case->pivot->quantity;
                        $unitobj->total_qty -= $unit->pivot->quantity * $case->pivot->quantity;
                        $unitobj->save();
                    }
                }

                if ($case->kits->all()) {
                    foreach ($case->kits->all() as $kit) {
                        $kitobj = Kit::find($kit->pivot->kit_id);
                        //$caseobj->kit_qty -= $kit->pivot->quantity * $case->pivot->quantity;
                        $kitobj->case_qty -= $kit->pivot->quantity * $case->pivot->quantity;
                        $kitobj->total_qty -= $kit->pivot->quantity * $case->pivot->quantity;
                        $kitobj->save();

                        foreach ($kit->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $caseobj->basic_unit_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity;
                            $unitobj->case_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity;
                            //$unitobj->kit_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity;
                            //$unitobj->pallet_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity;
                            $unitobj->total_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity;
                            $unitobj->save();
                        }
                    }
                }
            }
            $order->cases()->detach();
        } elseif ($order->order_type == 'Transfer In Pallets' && $order->status == 'Completed') {
            $pallets = $order->pallets->all();

            foreach ($pallets as $pallet) {
                $palletobj = Pallet::find($pallet->pivot->pallet_id);
                $palletobj->pallet_qty += $pallet->pivot->quantity;

                if ($pallet->cases->all()) {
                    foreach ($pallet->cases->all() as $case) {
                        $caseobj = Cases::find($case->pivot->cases_id);
                        $palletobj->case_qty += $case->pivot->quantity * $pallet->pivot->quantity;
                        $caseobj->pallet_qty += $case->pivot->quantity * $pallet->pivot->quantity;
                        //$caseobj->case_qty += $case->pivot->quantity * $pallet->pivot->quantity;
                        $caseobj->total_qty += $case->pivot->quantity * $pallet->pivot->quantity;
                        $caseobj->save();

                        if ($case->kits->all()) {
                            foreach ($case->kits->all() as $kit) {
                                $kitobj = Kit::find($kit->pivot->kit_id);
                                $palletobj->kit_qty += $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                $kitobj->pallet_qty += $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                //$kitobj->case_qty += $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                //$kitobj->kit_qty += $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                $kitobj->total_qty += $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                $kitobj->save();

                                if ($kit->basic_units->all()) {
                                    foreach ($kit->basic_units->all() as $unit) {
                                        $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                        $palletobj->basic_unit_qty += $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                        $unitobj->pallet_qty +=  $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                        //$unitobj->case_qty +=  $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                        //$unitobj->kit_qty +=  $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                        $unitobj->total_qty +=  $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                        $unitobj->save();
                                    }
                                }
                            }
                        }

                        if ($case->basic_units->all()) {
                            foreach ($case->basic_units->all() as $unit) {
                                $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                $palletobj->basic_unit_qty += $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                //$unitobj->case_qty += $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                $unitobj->pallet_qty += $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                $unitobj->total_qty += $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                $unitobj->save();
                            }
                        }
                    }
                }

                if ($pallet->kits->all()) {
                    foreach ($pallet->kits->all() as $kit) {
                        $kitobj = Kit::find($kit->pivot->kit_id);
                        $palletobj->kit_qty += $kit->pivot->quantity * $pallet->pivot->quantity;
                        $kitobj->pallet_qty += $kit->pivot->quantity * $pallet->pivot->quantity;
                        $kitobj->total_qty += $kit->pivot->quantity * $pallet->pivot->quantity;
                        $kitobj->save();

                        if ($kit->basic_units->all()) {
                            foreach ($kit->basic_units->all() as $unit) {
                                $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                $palletobj->basic_unit_qty += $unit->pivot->quantity * $kit->pivot->quantity * $pallet->pivot->quantity;
                                $unitobj->pallet_qty +=  $unit->pivot->quantity * $kit->pivot->quantity * $pallet->pivot->quantity;
                                //$unitobj->case_qty +=  $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                //$unitobj->kit_qty +=  $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                $unitobj->total_qty +=  $unit->pivot->quantity * $kit->pivot->quantity * $pallet->pivot->quantity;
                                $unitobj->save();
                            }
                        }
                    }

                    if ($pallet->basic_units->all()) {
                        foreach ($pallet->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $palletobj->basic_unit_qty += $unit->pivot->quantity  * $pallet->pivot->quantity;
                            //$unitobj->case_qty += $unit->pivot->quantity  * $case->pivot->quant $pallet->pivot->quantity;
                            //$unitobj->loose_item_qty += $unit->pivot->quantity * $pallet->pivot->quantity;
                            $unitobj->pallet_qty += $unit->pivot->quantity * $pallet->pivot->quantity;
                            $unitobj->total_qty += $unit->pivot->quantity * $pallet->pivot->quantity;
                            $unitobj->save();
                        }
                    }
                }
                $palletobj->save();
            }

            $order->pallets()->detach();
        } elseif ($order->order_type == 'Transfer Out Pallets' && $order->status == 'Completed') {
            $pallets = $order->pallets->all();

            foreach ($pallets as $pallet) {
                $palletobj = Pallet::find($pallet->pivot->pallet_id);
                $palletobj->pallet_qty -= $pallet->pivot->quantity;

                if ($pallet->cases->all()) {
                    foreach ($pallet->cases->all() as $case) {
                        $caseobj = Cases::find($case->pivot->cases_id);
                        $palletobj->case_qty -= $case->pivot->quantity * $pallet->pivot->quantity;
                        $caseobj->pallet_qty -= $case->pivot->quantity * $pallet->pivot->quantity;
                        $caseobj->total_qty -= $case->pivot->quantity * $pallet->pivot->quantity;
                        $caseobj->save();

                        if ($case->kits->all()) {
                            foreach ($case->kits->all() as $kit) {
                                $kitobj = Kit::find($kit->pivot->kit_id);
                                $palletobj->kit_qty -= $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                $kitobj->pallet_qty -= $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                //$kitobj->case_qty -= $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                //$kitobj->kit_qty -= $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                $kitobj->total_qty -= $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                $kitobj->save();

                                if ($kit->basic_units->all()) {
                                    foreach ($kit->basic_units->all() as $unit) {
                                        $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                        $palletobj->basic_unit_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                        $unitobj->pallet_qty -=  $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                        //$unitobj->case_qty -=  $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                        //$unitobj->kit_qty -=  $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                        $unitobj->total_qty -=  $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                        $unitobj->save();
                                    }
                                }
                            }
                        }

                        if ($case->basic_units->all()) {
                            foreach ($case->basic_units->all() as $unit) {
                                $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                $palletobj->basic_unit_qty -= $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                //$unitobj->case_qty -= $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                $unitobj->pallet_qty -= $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                $unitobj->total_qty -= $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                $unitobj->save();
                            }
                        }
                    }
                }

                if ($pallet->kits->all()) {
                    foreach ($pallet->kits->all() as $kit) {
                        $kitobj = Kit::find($kit->pivot->kit_id);
                        $palletobj->kit_qty -= $kit->pivot->quantity * $pallet->pivot->quantity;
                        $kitobj->pallet_qty -= $kit->pivot->quantity * $pallet->pivot->quantity;
                        $kitobj->total_qty -= $kit->pivot->quantity * $pallet->pivot->quantity;
                        $kitobj->save();

                        if ($kit->basic_units->all()) {
                            foreach ($kit->basic_units->all() as $unit) {
                                $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                $palletobj->basic_unit_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $pallet->pivot->quantity;
                                $unitobj->pallet_qty -=  $unit->pivot->quantity * $kit->pivot->quantity * $pallet->pivot->quantity;
                                //$unitobj->case_qty -=  $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                //$unitobj->kit_qty -=  $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                $unitobj->total_qty -=  $unit->pivot->quantity * $kit->pivot->quantity * $pallet->pivot->quantity;
                                $unitobj->save();
                            }
                        }
                    }

                    if ($pallet->basic_units->all()) {
                        foreach ($pallet->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $palletobj->basic_unit_qty -= $unit->pivot->quantity  * $pallet->pivot->quantity;
                            //$unitobj->case_qty -= $unit->pivot->quantity  * $case->pivot->quant $pallet->pivot->quantity;
                            //$unitobj->loose_item_qty -= $unit->pivot->quantity * $pallet->pivot->quantity;
                            $unitobj->pallet_qty -= $unit->pivot->quantity * $pallet->pivot->quantity;
                            $unitobj->total_qty -= $unit->pivot->quantity * $pallet->pivot->quantity;
                            $unitobj->save();
                        }
                    }
                }

                $palletobj->save();
            }
        } elseif ($order->order_type == 'Transfer In Items' && $order->status == 'Completed') {

            if ($order->pallets->all()) {
                foreach ($order->pallets->all() as $pallet) {

                    if ($pallet->cartons->all()) {
                        foreach ($pallet->cartons->all() as $carton) {
                            if ($carton->cases->all()) {
                                foreach ($carton->cases->all() as $case) {
                                    $caseobj = Cases::find($case->pivot->cases_id);
                                    $caseobj->total_qty += $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $caseobj->save();
                                }
                            }

                            if ($carton->kits->all()) {
                                foreach ($carton->kits->all() as $kit) {
                                    $kitobj = Kit::find($kit->pivot->kit_id);
                                    $kitobj->total_qty += $kit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $kitobj->save();
                                }
                            }
                            if ($carton->basic_units->all()) {
                                foreach ($carton->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->total_qty +=  $unit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        }
                    }

                    if ($pallet->cases->all()) {
                        foreach ($pallet->cases->all() as $case) {
                            $caseobj = Cases::find($case->pivot->cases_id);

                            $caseobj->total_qty += $case->pivot->quantity * $pallet->pivot->quantity;
                            $caseobj->save();
                        }
                    }

                    if ($pallet->kits->all()) {
                        foreach ($pallet->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);

                            $kitobj->total_qty += $kit->pivot->quantity * $pallet->pivot->quantity;
                            $kitobj->save();
                        }
                    }
                    if ($pallet->basic_units->all()) {
                        foreach ($pallet->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->total_qty += $unit->pivot->quantity * $pallet->pivot->quantity;
                            $unitobj->save();
                        }
                    }

                    $pallet->delete();
                }
            }

            if ($order->cartons->all()) {
                foreach ($order->cartons->all() as $carton) {

                    if ($carton->cases->all()) {
                        foreach ($carton->cases->all() as $case) {
                            $caseobj = Cases::find($case->pivot->cases_id);
                            $caseobj->total_qty += $case->pivot->quantity * $carton->pivot->quantity;
                            $caseobj->save();
                        }
                    }

                    if ($carton->kits->all()) {
                        foreach ($carton->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);
                            $kitobj->total_qty += $kit->pivot->quantity * $carton->pivot->quantity;
                            $kitobj->save();
                        }
                    }
                    if ($carton->basic_units->all()) {
                        foreach ($carton->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->total_qty +=  $unit->pivot->quantity * $carton->pivot->quantity;
                            $unitobj->save();
                        }
                    }
                    $carton->delete();
                }
            }

            if ($order->cases->all()) {
                foreach ($order->cases->all() as $case) {
                    $caseobj = Cases::find($case->pivot->cases_id);
                    $caseobj->total_qty += $case->pivot->quantity;
                    $caseobj->save();
                }
            }

            if ($order->kits->all()) {
                foreach ($order->kits->all() as $kit) {
                    $kitobj = Kit::find($kit->pivot->kit_id);
                    $kitobj->total_qty += $kit->pivot->quantity;
                    $kitobj->save();
                }
            }

            if ($order->basic_units->all()) {
                foreach ($order->basic_units->all() as $unit) {
                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                    $unitobj->total_qty += $unit->pivot->quantity;
                    $unitobj->save();
                }
            }
        } elseif ($order->order_type == 'Transfer Out Items' && $order->status == 'Completed') {

            if ($order->pallets->all()) {
                foreach ($order->pallets->all() as $pallet) {

                    if ($pallet->cartons->all()) {
                        foreach ($pallet->cartons->all() as $carton) {
                            if ($carton->cases->all()) {
                                foreach ($carton->cases->all() as $case) {
                                    $caseobj = Cases::find($case->pivot->cases_id);
                                    $caseobj->total_qty -= $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $caseobj->save();
                                }
                            }

                            if ($carton->kits->all()) {
                                foreach ($carton->kits->all() as $kit) {
                                    $kitobj = Kit::find($kit->pivot->kit_id);
                                    $kitobj->total_qty -= $kit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $kitobj->save();
                                }
                            }
                            if ($carton->basic_units->all()) {
                                foreach ($carton->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->total_qty -=  $unit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        }
                    }

                    if ($pallet->cases->all()) {
                        foreach ($pallet->cases->all() as $case) {
                            $caseobj = Cases::find($case->pivot->cases_id);

                            $caseobj->total_qty -= $case->pivot->quantity * $pallet->pivot->quantity;
                            $caseobj->save();
                        }
                    }

                    if ($pallet->kits->all()) {
                        foreach ($pallet->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);

                            $kitobj->total_qty -= $kit->pivot->quantity * $pallet->pivot->quantity;
                            $kitobj->save();
                        }
                    }
                    if ($pallet->basic_units->all()) {
                        foreach ($pallet->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->total_qty -= $unit->pivot->quantity * $pallet->pivot->quantity;
                            $unitobj->save();
                        }
                    }

                    $pallet->delete();
                }
            }

            if ($order->cartons->all()) {
                foreach ($order->cartons->all() as $carton) {

                    if ($carton->cases->all()) {
                        foreach ($carton->cases->all() as $case) {
                            $caseobj = Cases::find($case->pivot->cases_id);
                            $caseobj->total_qty -= $case->pivot->quantity * $carton->pivot->quantity;
                            $caseobj->save();
                        }
                    }

                    if ($carton->kits->all()) {
                        foreach ($carton->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);
                            $kitobj->total_qty -= $kit->pivot->quantity * $carton->pivot->quantity;
                            $kitobj->save();
                        }
                    }
                    if ($carton->basic_units->all()) {
                        foreach ($carton->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->total_qty -=  $unit->pivot->quantity * $carton->pivot->quantity;
                            $unitobj->save();
                        }
                    }
                    $carton->delete();
                }
            }

            if ($order->cases->all()) {
                foreach ($order->cases->all() as $case) {
                    $caseobj = Cases::find($case->pivot->cases_id);
                    $caseobj->total_qty -= $case->pivot->quantity;
                    $caseobj->save();
                }
            }

            if ($order->kits->all()) {
                foreach ($order->kits->all() as $kit) {
                    $kitobj = Kit::find($kit->pivot->kit_id);
                    $kitobj->total_qty -= $kit->pivot->quantity;
                    $kitobj->save();
                }
            }

            if ($order->basic_units->all()) {
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
