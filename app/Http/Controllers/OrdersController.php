<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
use App\Mail\OrderFulfilled;
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

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    { }

    public function getorder($id){
        $order = Order::with('basic_units')->find($id);
        return collect(['order' => $order]);
    }

    public function getcartonizedorder($id){
        $order = Order::with('cases.basic_units')->find($id);
        return collect(['order' => $order]);
    }

    public function getpalletizedorder($id){
        $order = Order::with('cases.basic_units')->find($id);
        return collect(['order' => $order]);
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

    public function create_cartonize()
    {

        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $units = $user->basic_units->all();
        $kits = $user->kits->all();
        $cases = $user->cases->all();
        $cartons = $user->cartons->all();
        $pallets = $user->pallets->all();
        return view('orders.create-cartonize')->with('pallets', $pallets)->with('cartons', $cartons)->with('cases', $cases)->with('kits', $kits)->with('units', $units);
    }

    public function create_palletize()
    {

        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $units = $user->basic_units->all();
        $kits = $user->kits->all();
        $cases = $user->cases->all();
        $cartons = $user->cartons->all();
        $pallets = $user->pallets->all();
        return view('orders.create-palletize')->with('pallets', $pallets)->with('cartons', $cartons)->with('cases', $cases)->with('kits', $kits)->with('units', $units);
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
                $ordernumber->user_id = $request->user_id;
                $order->orderid = $ordernumber->fss_id;
                $order->ordernumber_id = $ordernumber->id;
                $ordernumber->save();


                $order->user_id = $request->user_id;
                $order->company = User::find($request->user_id)->company_name;
                $order->order_type = $request->order_type;
                $order->originator = $request->originator;
                $order->in_care_of = $request->in_care_of;
                $order->so_num = $request->so_num;
                $order->po_num = $request->po_num;
                $order->job_num = $request->job_num;
                $order->carrier_id = $request->carrier_id;
                $order->carrier = $request->carrier;
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

                $container_types = $request->container_type;
                $container_barcodes = $request->container_barcode;
                $container_qtys = $request->container_qty;
                $carton_barcode = $request->carton_barcode;
                $carton_qty = $request->carton_qty;
                $carton_items = $request->carton_items;
                $carton_item_qty = $request->carton_item_qty;
                $items = $request->items;
                $item_qty = $request->item_qty;
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

                for ($i = 0; $i < count($container_types); $i++) {
                    $container_type = strval($container_types[$i][0]);

                    if ($container_type === 'Pallet') {
                        $pallet = new Pallet();
                        $pallet->user_id = $request->user_id;
                        $pallet->status = 'Pending Approval';
                        $pallet->upc = $container_barcodes[$i][0];
                        $total_pallets += $container_qtys[$i][0];
                        $pallet->total_qty += $container_qtys[$i][0];
                        $pallet->save();
                        $order->pallets()->attach([['pallet_id' => $pallet->id, 'quantity' => $container_qtys[$i][0]]]);
                        if($items != NULL){
                            for ($y = 0; $y < count($items[$i]); $y++) {

                                if (Basic_Unit::where('upc', $items[$i][$y])->where('user_id', $request->user_id)->exists()) {
                                    $total_units += $item_qty[$i][$y];
                                    $unit = Basic_Unit::where('upc', $items[$i][$y])->where('user_id', $request->user_id)->first();
                                    $pallet->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $item_qty[$i][$y]]]);
                                }
                                if (Kit::where('upc', $items[$i][$y])->where('user_id', $request->user_id)->exists()) {
                                    $total_kits += $item_qty[$i][$y];
                                    $kit = Kit::where('upc', $items[$i][$y])->where('user_id', $request->user_id)->first();
                                    $pallet->kits()->attach([['kit_id' => $kit->id, 'quantity' => $item_qty[$i][$y]]]);
                                }
                                if (Cases::where('upc', $items[$i][$y])->where('user_id', $request->user_id)->exists()) {
                                    $total_cases += $item_qty[$i][$y];
                                    $case = Cases::where('upc', $items[$i][$y])->where('user_id', $request->user_id)->first();
                                    $pallet->cases()->attach([['cases_id' => $case->id, 'quantity' => $item_qty[$i][$y]]]);
                                }
                        }
                    }
                        if($request->carton_items != NULL){
                            
                            for($y = 0; $y < count($carton_qty[$i]); $y++){
                                $carton = new Carton();
                                $carton->user_id = $request->user_id;
                                $carton->company = User::find($request->user_id)->company_name;
                                $total_cartons += $carton_qty[$i][$y];
                                $carton->upc = $carton_barcode[$i][$y];
                                $carton->status = 'Pending Approval';
                                $carton->save();
                                for($z = 0; $z < count($carton_items[$i][$y]); $z++){
                                    if (Basic_Unit::where('upc', $carton_items[$i][$y][$z])->where('user_id', $request->user_id)->exists()) {
                                        $total_units += $carton_item_qty[$i][$y][$z];
                                        $unit = Basic_Unit::where('upc', $carton_items[$i][$y][$z])->where('user_id', $request->user_id)->first();
                                        $carton->total_qty +=$carton_item_qty[$i][$y][$z];
                                        $carton->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $carton_item_qty[$i][$y][$z]]]); 
                                    }
                                    if (Kit::where('upc', $carton_items[$i][$y][$z])->where('user_id', $request->user_id)->exists()) {
                                        $total_kits += $carton_item_qty[$i][$y][$z];
                                        $kit = Kit::where('upc', $carton_items[$i][$y][$z])->where('user_id', $request->user_id)->first();
                                        $carton->total_qty +=$carton_item_qty[$i][$y][$z];
                                        $carton->kits()->attach([['kit_id' => $kit->id, 'quantity' => $carton_item_qty[$i][$y][$z]]]);
                                    }
                                    if (Cases::where('upc', $carton_items[$i][$y][$z])->where('user_id', $request->user_id)->exists()) {
                                        $total_cases += $carton_item_qty[$i][$y][$z];
                                        $case = Cases::where('upc', $carton_items[$i][$y][$z])->where('user_id', $request->user_id)->first();
                                        $carton->total_qty +=$carton_item_qty[$i][$y][$z];
                                        $carton->cases()->attach([['cases_id' => $case->id, 'quantity' => $carton_item_qty[$i][$y][$z]]]);
                                    }
                                }
                            $pallet->cartons()->attach([['carton_id' => $carton->id, 'quantity' => $carton_qty[$i][$y]]]);
                        }
                        $carton->save();
                    }
                    $pallet->save();
                    }

                    if ($container_type === 'Carton') {
                        $carton = new Carton();
                        $carton->user_id = $request->user_id;
                        $carton->company = User::find($request->user_id)->company_name;
                        $carton->status = 'Pending Approval';
                        $carton->upc = $container_barcodes[$i][0];
                        $total_cartons += $container_qtys[$i][0];
                        $carton->total_qty += $container_qtys[$i][0];
                        $carton->save();
                        $order->cartons()->attach([['carton_id' => $carton->id, 'quantity' => $container_qtys[$i][0]]]);
                        for ($x = 0; $x < count($items[$i]); $x++) {

                            if (Basic_Unit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->exists()) {
                                $total_units += $item_qty[$i][$x];
                                $unit = Basic_Unit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->first();
                                $carton->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $item_qty[$i][$x]]]);
                            }
                            if (Kit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->exists()) {
                                $total_kits += $item_qty[$i][$x];
                                $kit = Kit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->first();
                                $carton->kits()->attach([['kit_id' => $kit->id, 'quantity' => $item_qty[$i][$x]]]);
                            }
                            if (Cases::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->exists()) {
                                $total_cases += $item_qty[$i][$x];
                                $case = Cases::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->first();
                                $carton->cases()->attach([['cases_id' => $case->id, 'quantity' => $item_qty[$i][$x]]]);
                            }
                        }
                    }
                    if ($container_type === 'Loose Items') {

                        for ($x = 0; $x < count($items[$i]); $x++) {

                            if (Basic_Unit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->exists()) {
                                $total_units += $item_qty[$i][$x];
                                $unit = Basic_Unit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->first();
                                $order->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $item_qty[$i][$x]]]);
                            }
                            if (Kit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->exists()) {
                                $total_kits += $item_qty[$i][$x];
                                $kit = Kit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->first();
                                $order->kits()->attach([['kit_id' => $kit->id, 'quantity' => $item_qty[$i][$x]]]);
                            }
                            if (Cases::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->exists()) {
                                $total_cases += $item_qty[$i][$x];
                                $case = Cases::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->first();
                                $order->cases()->attach([['cases_id' => $case->id, 'quantity' => $item_qty[$i][$x]]]);
                            }
                        }
                    }
                }
                $order->pallet_qty = $total_pallets;
                $order->carton_qty = $total_cartons;
                $order->case_qty = $total_cases;
                $order->kit_qty = $total_kits;
                $order->unit_qty = $total_units;
                $order->save();
                DB::commit();
                Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
                return response()->json([
                    'success'  => 'Order submitted successfully. Your Order # is ' . $order->orderid . ''
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'error'  => $e->getMessage()
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
                $ordernumber->user_id = $request->user_id;
                $order->orderid = $ordernumber->fss_id;
                $order->ordernumber_id = $ordernumber->id;
                $ordernumber->save();


                $order->user_id = $request->user_id;
                $order->company = User::find($request->user_id)->company_name;
                $order->originator = $request->originator;
                $order->in_care_of = $request->in_care_of;
                $order->so_num = $request->so_num;
                $order->po_num = $request->po_num;
                $order->job_num = $request->job_num;
                $order->carrier_id = $request->carrier_id;
                $order->carrier = $request->carrier;
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

                $container_types = $request->container_type;
                $container_barcodes = $request->container_barcode;
                $container_qtys = $request->container_qty;
                $items = $request->items;
                $item_qty = $request->item_qty;
                $carton_barcode = $request->carton_barcode;
                $carton_qty = $request->carton_qty;
                $carton_items = $request->carton_items;
                $carton_item_qty = $request->carton_item_qty;
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

                for ($i = 0; $i < count($container_types); $i++) {
                    $container_type = strval($container_types[$i][0]);

                    if ($container_type === 'Pallet') {
                        $pallet = new Pallet();
                        $pallet->user_id = $request->user_id;
                        $pallet->company = User::find($request->user_id)->company_name;
                        $pallet->status = 'Pending Approval';
                        $pallet->upc = $container_barcodes[$i][0];
                        $total_pallets += $container_qtys[$i][0];
                        $pallet->total_qty += $container_qtys[$i][0];
                        $pallet->save();
                        $order->pallets()->attach([['pallet_id' => $pallet->id, 'quantity' => $container_qtys[$i][0]]]);
                        for ($y = 0; $y < count($items[$i]); $y++) {

                            if (Basic_Unit::where('upc', $items[$i][$y])->where('user_id', $request->user_id)->exists()) {
                                $total_units += $item_qty[$i][$y];
                                $unit = Basic_Unit::where('upc', $items[$i][$y])->where('user_id', $request->user_id)->first();
                                if ($unit->total_qty < $item_qty[$i][$y]) {
                                    throw new \Exception('Quantity of units on pallet is greater than quantity at hand.');
                                }
                                else{
                                    $pallet->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $item_qty[$i][$y]]]);
                                }
                                
                            }
                            if (Kit::where('upc', $items[$i][$y])->where('user_id', $request->user_id)->exists()) {
                                $total_kits += $item_qty[$i][$y];
                                $kit = Kit::where('upc', $items[$i][$y])->where('user_id', $request->user_id)->first();
                                if ($kit->total_qty < $item_qty[$i][$y]) {
                                    throw new \Exception('Quantity of kits on pallet is greater than quantity at hand.');
                                }
                                else{
                                    $pallet->kits()->attach([['kit_id' => $kit->id, 'quantity' => $item_qty[$i][$y]]]);
                                }
                                
                            }
                            if (Cases::where('upc', $items[$i][$y])->where('user_id', $request->user_id)->exists()) {
                                $total_cases += $item_qty[$i][$y];
                                $case = Cases::where('upc', $items[$i][$y])->where('user_id', $request->user_id)->first();
                                if ($case->total_qty < $item_qty[$i][$y]) {
                                    throw new \Exception('Quantity of cases on pallet is greater than quantity at hand.');
                                }
                                else{
                                    $pallet->cases()->attach([['cases_id' => $case->id, 'quantity' => $item_qty[$i][$y]]]);
                                }
                                
                            }

                        }
                        if($request->carton_items != NULL){
                            
                            for($y = 0; $y < count($carton_qty[$i]); $y++){
                                $carton = new Carton();
                                $carton->user_id = $request->user_id;
                                $carton->company = User::find($request->user_id)->company_name;
                                $carton->status = 'Pending Approval';
                                $total_cartons += $carton_qty[$i][$y];
                                $carton->upc = $carton_barcode[$i][$y];
                                $carton->save();
                                for($z = 0; $z < count($carton_items[$i][$y]); $z++){
                                if (Basic_Unit::where('upc', $carton_items[$i][$y][$z])->where('user_id', $request->user_id)->exists()) {
                                    $total_units += $carton_item_qty[$i][$y][$z];
                                    $unit = Basic_Unit::where('upc', $carton_items[$i][$y][$z])->where('user_id', $request->user_id)->first();
                                    if ($unit->total_qty < $carton_item_qty[$i][$y][$z]) {
                                        throw new \Exception('Quantity of units in carton is greater than quantity at hand.');
                                    }
                                    else{
                                        $carton->total_qty +=$carton_item_qty[$i][$y][$z];
                                        $carton->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $carton_item_qty[$i][$y][$z]]]);
                                    }
                                    
                                }
                                if (Kit::where('upc', $carton_items[$i][$y][$z])->where('user_id', $request->user_id)->exists()) {
                                    $total_kits += $carton_item_qty[$i][$y][$z];
                                    $kit = Kit::where('upc', $carton_items[$i][$y][$z])->where('user_id', $request->user_id)->first();
                                    if ($kit->total_qty < $carton_item_qty[$i][$y][$z]) {
                                        throw new \Exception('Quantity of kits in carton is greater than quantity at hand.');
                                    }
                                    else{
                                        $carton->total_qty +=$carton_item_qty[$i][$y][$z];
                                        $carton->kits()->attach([['kit_id' => $kit->id, 'quantity' => $carton_item_qty[$i][$y][$z]]]);
                                    }
                                    
                                }
                                if (Cases::where('upc', $carton_items[$i][$y][$z])->where('user_id', $request->user_id)->exists()) {
                                    $total_cases += $carton_item_qty[$i][$y][$z];
                                    $case = Cases::where('upc', $carton_items[$i][$y][$z])->where('user_id', $request->user_id)->first();
                                    if ($case->total_qty < $carton_item_qty[$i][$y][$z]) {
                                        throw new \Exception('Quantity of cases in carton is greater than quantity at hand.');
                                    }
                                    else{
                                        $carton->total_qty +=$carton_item_qty[$i][$y][$z];
                                        $carton->cases()->attach([['cases_id' => $case->id, 'quantity' => $carton_item_qty[$i][$y][$z]]]);
                                    }
                                    
                                }
                            }
                            $pallet->cartons()->attach([['carton_id' => $carton->id, 'quantity' => $carton_qty[$i][$y]]]);
                        }
                        $carton->save();
                    }
                    $pallet->save();
                }

                    if ($container_type === 'Carton') {
                        $carton = new Carton();
                        $carton->user_id = $request->user_id;
                        $carton->company = User::find($request->user_id)->company_name;
                        $carton->status = 'Pending Approval';
                        $carton->upc = $container_barcodes[$i][0];
                        $total_cartons += $container_qtys[$i][0];
                        $carton->total_qty += $container_qtys[$i][0];
                        $carton->save();
                        $order->cartons()->attach([['carton_id' => $carton->id, 'quantity' => $container_qtys[$i][0]]]);
                        for ($x = 0; $x < count($items[$i]); $x++) {

                            if (Basic_Unit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->exists()) {
                                $total_units += $item_qty[$i][$x];
                                $unit = Basic_Unit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->first();
                                if ($unit->total_qty < $item_qty[$i][$x]) {
                                    throw new \Exception('Quantity of units in carton is greater than quantity at hand.');
                                }
                                else{
                                    $carton->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $item_qty[$i][$x]]]);
                                }
                                
                            }
                            if (Kit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->exists()) {
                                $total_kits += $item_qty[$i][$x];
                                $kit = Kit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->first();
                                if ($kit->total_qty < $item_qty[$i][$x]) {
                                    throw new \Exception('Quantity of kits in carton is greater than quantity at hand.');
                                }
                                else{
                                    $carton->kits()->attach([['kit_id' => $kit->id, 'quantity' => $item_qty[$i][$x]]]);
                                }
                                
                            }
                            if (Cases::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->exists()) {
                                $total_cases += $item_qty[$i][$x];
                                $case = Cases::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->first();
                                if ($case->total_qty < $item_qty[$i][$x]) {
                                    throw new \Exception('Quantity of cases in carton is greater than quantity at hand.');
                                }
                                else{
                                    $carton->cases()->attach([['cases_id' => $case->id, 'quantity' => $item_qty[$i][$x]]]);
                                }
                                
                            }
                        }
                        $carton->save();
                    }
                    if ($container_type === 'Loose Items') {

                        for ($x = 0; $x < count($items[$i]); $x++) {

                            if (Basic_Unit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->exists()) {
                                $total_units += $item_qty[$i][$x];
                                $unit = Basic_Unit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->first();
                                if ($unit->total_qty < $item_qty[$i][$x]) {
                                    throw new \Exception('Quantity of units in loose item order is greater than quantity at hand.');
                                }
                                else{
                                    $order->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $item_qty[$i][$x]]]);
                                }
                                
                            }
                            if (Kit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->exists()) {
                                $total_kits += $item_qty[$i][$x];
                                $kit = Kit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->first();
                                if ($kit->total_qty < $item_qty[$i][$x]) {
                                    throw new \Exception('Quantity of kits in loose item order is greater than quantity at hand.');
                                }
                                else{
                                    $order->kits()->attach([['kit_id' => $kit->id, 'quantity' => $item_qty[$i][$x]]]);
                                }
                                
                            }
                            if (Cases::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->exists()) {
                                $total_cases += $item_qty[$i][$x];
                                $case = Cases::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->first();
                                if ($case->total_qty < $item_qty[$i][$x]) {
                                    throw new \Exception('Quantity of cases in loose item order is greater than quantity at hand.');
                                }
                                else{
                                    $order->cases()->attach([['cases_id' => $case->id, 'quantity' => $item_qty[$i][$x]]]);
                                }
                                
                            }
                        }
                    }

                }
                $order->pallet_qty = $total_pallets;
                $order->carton_qty = $total_cartons;
                $order->case_qty = $total_cases;
                $order->kit_qty = $total_kits;
                $order->unit_qty = $total_units;
                $order->save();
                DB::commit();
                Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
                return response()->json([
                    'success'  => 'Order submitted successfully. Your Order # is ' . $order->orderid . ''
                ]);
                
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'error'  => $e->getMessage()
                ]);
            }
            
        }
    }


    public function store_cartonize(Request $request)
    {

        /**
         * 
         * Establishes rules for form input
         * If fields are not filled in, will return json error message
         * 
         */
        if ($request->ajax()) {

            
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
                $ordernumber->user_id = $request->user_id;
                $order->orderid = $ordernumber->fss_id;
                $order->ordernumber_id = $ordernumber->id;
                $ordernumber->save();


                $order->user_id = $request->user_id;
                $order->company = User::find($request->user_id)->company_name;
                $order->order_type = $request->order_type;
                $order->originator = $request->originator;
                $order->in_care_of = $request->in_care_of;
                $order->so_num = $request->so_num;
                $order->po_num = $request->po_num;
                $order->job_num = $request->job_num;
                $order->carrier_id = $request->carrier_id;
                $order->carrier = $request->carrier;
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

                $container_types = $request->container_type;
                $container_barcodes = $request->container_barcode;
                $container_qtys = $request->container_qty;
                $carton_barcode = $request->carton_barcode;
                $carton_qty = $request->carton_qty;
                $carton_items = $request->carton_items;
                $carton_item_qty = $request->carton_item_qty;
                $items = $request->items;
                $item_qty = $request->item_qty;
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

                for ($i = 0; $i < count($container_types); $i++) {
                    

                        /*
                        $container_type = strval($container_types[$i][0]);
                        $carton = new Carton();
                        $carton->user_id = $request->user_id;
                        $carton->company = User::find($request->user_id)->company_name;
                        $carton->status = 'Pending Approval';
                        $carton->upc = $container_barcodes[$i][0];
                        $total_cartons += $container_qtys[$i][0];
                        $carton->total_qty += $container_qtys[$i][0];
                        $carton->save();
                        $order->cartons()->attach([['carton_id' => $carton->id, 'quantity' => $container_qtys[$i][0]]]);
                        */

                        for ($x = 0; $x < count($items[$i]); $x++) {

                            if (Basic_Unit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->exists()) {
                                $total_units += $item_qty[$i][$x];
                                $unit = Basic_Unit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->first();
                                $order->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $item_qty[$i][$x]]]);
                            }
                            if (Kit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->exists()) {
                                $total_kits += $item_qty[$i][$x];
                                $kit = Kit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->first();
                                $order->kits()->attach([['kit_id' => $kit->id, 'quantity' => $item_qty[$i][$x]]]);
                            }
                            if (Cases::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->exists()) {
                                $total_cases += $item_qty[$i][$x];
                                $case = Cases::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->first();
                                $order->cases()->attach([['cases_id' => $case->id, 'quantity' => $item_qty[$i][$x]]]);
                            }
                        }
                    

                }

                $order->pallet_qty = $total_pallets;
                $order->carton_qty = $total_cartons;
                $order->case_qty = $total_cases;
                $order->kit_qty = $total_kits;
                $order->unit_qty = $total_units;
                $order->save();
                DB::commit();
                Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
                return response()->json([
                    'success'  => 'Cartonize order submitted successfully. Your Order # is ' . $order->orderid . ''
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'error'  => $e->getMessage()
                ]);
            }
            
        }
    }


    public function store_palletize(Request $request)
    {
       
        /**
         * 
         * Establishes rules for form input
         * If fields are not filled in, will return json error message
         * 
         */
        if ($request->ajax()) {
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
                $ordernumber->user_id = $request->user_id;
                $order->orderid = $ordernumber->fss_id;
                $order->ordernumber_id = $ordernumber->id;
                $ordernumber->save();


                $order->user_id = $request->user_id;
                $order->company = User::find($request->user_id)->company_name;
                $order->originator = $request->originator;
                $order->in_care_of = $request->in_care_of;
                $order->so_num = $request->so_num;
                $order->po_num = $request->po_num;
                $order->job_num = $request->job_num;
                $order->carrier_id = $request->carrier_id;
                $order->carrier = $request->carrier;
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

                $container_types = $request->container_type;
                $container_barcodes = $request->container_barcode;
                $container_qtys = $request->container_qty;
                $items = $request->items;
                $item_qty = $request->item_qty;
                $carton_barcode = $request->carton_barcode;
                $carton_qty = $request->carton_qty;
                $carton_items = $request->carton_items;
                $carton_item_qty = $request->carton_item_qty;
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

                
                    //$container_type = strval($container_types[$i][0]);

                    
                       
                        //$order->pallets()->attach([['pallet_id' => $pallet->id, 'quantity' => $container_qtys[$i][0]]]);
                        for ($i = 0; $i < count($container_types); $i++) {
                        for ($y = 0; $y < count($items[$i]); $y++) {

                            if (Basic_Unit::where('upc', $items[$i][$y])->where('user_id', $request->user_id)->exists()) {
                                $total_units += $item_qty[$i][$y];
                                $unit = Basic_Unit::where('upc', $items[$i][$y])->where('user_id', $request->user_id)->first();
                                if ($unit->total_qty < $item_qty[$i][$y]) {
                                    throw new \Exception('Quantity of units on pallet is greater than quantity at hand.');
                                }
                                else{
                                    $order->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $item_qty[$i][$y]]]);
                                }
                                
                            }
                            if (Kit::where('upc', $items[$i][$y])->where('user_id', $request->user_id)->exists()) {
                                $total_kits += $item_qty[$i][$y];
                                $kit = Kit::where('upc', $items[$i][$y])->where('user_id', $request->user_id)->first();
                                if ($kit->total_qty < $item_qty[$i][$y]) {
                                    throw new \Exception('Quantity of kits on pallet is greater than quantity at hand.');
                                }
                                else{
                                    $order->kits()->attach([['kit_id' => $kit->id, 'quantity' => $item_qty[$i][$y]]]);
                                }
                                
                            }
                            if (Cases::where('upc', $items[$i][$y])->where('user_id', $request->user_id)->exists()) {
                                $total_cases += $item_qty[$i][$y];
                                $case = Cases::where('upc', $items[$i][$y])->where('user_id', $request->user_id)->first();
                                if ($case->total_qty < $item_qty[$i][$y]) {
                                    throw new \Exception('Quantity of cases on pallet is greater than quantity at hand.');
                                }
                                else{
                                    $order->cases()->attach([['cases_id' => $case->id, 'quantity' => $item_qty[$i][$y]]]);
                                }
                                
                            }

                        }
                    }
                        /*
                        if($request->carton_items != NULL){
                            
                            for($y = 0; $y < count($carton_qty[$i]); $y++){
                                $carton = new Carton();
                                $carton->user_id = $request->user_id;
                                $carton->company = User::find($request->user_id)->company_name;
                                $carton->status = 'Pending Approval';
                                $total_cartons += $carton_qty[$i][$y];
                                $carton->upc = $carton_barcode[$i][$y];
                                $carton->save();
                                for($z = 0; $z < count($carton_items[$i][$y]); $z++){
                                if (Basic_Unit::where('upc', $carton_items[$i][$y][$z])->where('user_id', $request->user_id)->exists()) {
                                    $total_units += $carton_item_qty[$i][$y][$z];
                                    $unit = Basic_Unit::where('upc', $carton_items[$i][$y][$z])->where('user_id', $request->user_id)->first();
                                    if ($unit->total_qty < $carton_item_qty[$i][$y][$z]) {
                                        throw new \Exception('Quantity of units in carton is greater than quantity at hand.');
                                    }
                                    else{
                                        $carton->total_qty +=$carton_item_qty[$i][$y][$z];
                                        $carton->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $carton_item_qty[$i][$y][$z]]]);
                                    }
                                    
                                }
                                if (Kit::where('upc', $carton_items[$i][$y][$z])->where('user_id', $request->user_id)->exists()) {
                                    $total_kits += $carton_item_qty[$i][$y][$z];
                                    $kit = Kit::where('upc', $carton_items[$i][$y][$z])->where('user_id', $request->user_id)->first();
                                    if ($kit->total_qty < $carton_item_qty[$i][$y][$z]) {
                                        throw new \Exception('Quantity of kits in carton is greater than quantity at hand.');
                                    }
                                    else{
                                        $carton->total_qty +=$carton_item_qty[$i][$y][$z];
                                        $carton->kits()->attach([['kit_id' => $kit->id, 'quantity' => $carton_item_qty[$i][$y][$z]]]);
                                    }
                                    
                                }
                                if (Cases::where('upc', $carton_items[$i][$y][$z])->where('user_id', $request->user_id)->exists()) {
                                    $total_cases += $carton_item_qty[$i][$y][$z];
                                    $case = Cases::where('upc', $carton_items[$i][$y][$z])->where('user_id', $request->user_id)->first();
                                    if ($case->total_qty < $carton_item_qty[$i][$y][$z]) {
                                        throw new \Exception('Quantity of cases in carton is greater than quantity at hand.');
                                    }
                                    else{
                                        $carton->total_qty +=$carton_item_qty[$i][$y][$z];
                                        $carton->cases()->attach([['cases_id' => $case->id, 'quantity' => $carton_item_qty[$i][$y][$z]]]);
                                    }
                                    
                                }
                            }
                            $pallet->cartons()->attach([['carton_id' => $carton->id, 'quantity' => $carton_qty[$i][$y]]]);
                        }
                        $carton->save();
                    }
                    $pallet->save();
                    */
                
                    /*
                    if ($container_type === 'Loose Items') {

                        for ($x = 0; $x < count($items[$i]); $x++) {

                            if (Basic_Unit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->exists()) {
                                $total_units += $item_qty[$i][$x];
                                $unit = Basic_Unit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->first();
                                if ($unit->total_qty < $item_qty[$i][$x]) {
                                    throw new \Exception('Quantity of units in loose item order is greater than quantity at hand.');
                                }
                                else{
                                    $order->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $item_qty[$i][$x]]]);
                                }
                                
                            }
                            if (Kit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->exists()) {
                                $total_kits += $item_qty[$i][$x];
                                $kit = Kit::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->first();
                                if ($kit->total_qty < $item_qty[$i][$x]) {
                                    throw new \Exception('Quantity of kits in loose item order is greater than quantity at hand.');
                                }
                                else{
                                    $order->kits()->attach([['kit_id' => $kit->id, 'quantity' => $item_qty[$i][$x]]]);
                                }
                                
                            }
                            if (Cases::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->exists()) {
                                $total_cases += $item_qty[$i][$x];
                                $case = Cases::where('upc', $items[$i][$x])->where('user_id', $request->user_id)->first();
                                if ($case->total_qty < $item_qty[$i][$x]) {
                                    throw new \Exception('Quantity of cases in loose item order is greater than quantity at hand.');
                                }
                                else{
                                    $order->cases()->attach([['cases_id' => $case->id, 'quantity' => $item_qty[$i][$x]]]);
                                }
                                
                            }
                        }
                    }
                    */

                
                $order->pallet_qty = $total_pallets;
                $order->carton_qty = $total_cartons;
                $order->case_qty = $total_cases;
                $order->kit_qty = $total_kits;
                $order->unit_qty = $total_units;
                $order->save();
                DB::commit();
                Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
                return response()->json([
                    'success'  => 'Palletize order submitted successfully. Your Order # is ' . $order->orderid . ''
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

        if ($request->ajax()) {
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
                $ordernumber->user_id = $request->user_id;
                $order->orderid = $ordernumber->fss_id;
                $order->ordernumber_id = $ordernumber->id;
                $ordernumber->save();

                $order->user_id = $request->user_id;
                $order->company = User::find($request->user_id)->company_name;
                $order->order_type = $request->order_type;
                $order->cust_name = $request->custname;
                $order->cust_order_no = $request->orderno;
                $order->street_address = $request->address;
                $order->city = $request->city;
                $order->state = $request->state;
                $order->zip = $request->zip;
                $order->status = 'Pending Approval';
                $order->order_type = 'Fulfill Items';
                $order->financial_status = 'Unpaid';
                $order->fulfillment_status = 'Unfulfilled';
                $order->save();


                /**
                 * 
                 * Creates variables to store input array from the pallet input (array of pallet ids) and pallet quantity
                 * Creates variables for object totals -> pallets, cases (if applies), and units (if applies)
                 * 
                 */

                $container_types = $request->container_type;
                $container_barcodes = $request->container_barcode;
                $container_qtys = $request->container_qty;
                $items = $request->items;
                $item_qty = $request->item_qty;
                $carton_barcode = $request->carton_barcode;
                $carton_qty = $request->carton_qty;
                $carton_items = $request->carton_items;
                $carton_item_qty = $request->carton_item_qty;
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

                for ($i = 0; $i < count($container_types); $i++) {
                    $container_type = strval($container_types[$i][0]);

                    if ($container_type === 'Pallet') {
                        $pallet = new Pallet();
                        $pallet->user_id = auth()->user()->id;
                        $pallet->company = auth()->user()->company_name;
                        dd($container_barcodes[$i][0]);
                        $pallet->upc = $container_barcodes[$i][0];
                        $pallet->save();
                        $total_pallets += $container_qtys[$i][0];
                        $pallet->total_qty += $container_qtys[$i][0];
                        $order->pallets()->attach([['pallet_id' => $pallet->id, 'quantity' => $container_qtys[$i][0]]]);
                        if($items != NULL){
                        for ($y = 0; $y < count($items[$i]); $y++) {

                            if (Basic_Unit::where('upc', $items[$i][$y])->where('user_id', auth()->user()->id)->exists()) {
                                $total_units += $item_qty[$i][$y];
                                $unit = Basic_Unit::where('upc', $items[$i][$y])->where('user_id', auth()->user()->id)->first();
                                if ($unit->total_qty < $item_qty[$i][$y]) {
                                    throw new \Exception('Quantity of units on pallet is greater than quantity at hand.');
                                }
                                else{
                                    $pallet->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $item_qty[$i][$y]]]);
                                }
                                
                            }
                            if (Kit::where('upc', $items[$i][$y])->where('user_id', auth()->user()->id)->exists()) {
                                $total_kits += $item_qty[$i][$y];
                                $kit = Kit::where('upc', $items[$i][$y])->where('user_id', auth()->user()->id)->first();
                                if ($kit->total_qty < $item_qty[$i][$y]) {
                                    throw new \Exception('Quantity of kits on pallet is greater than quantity at hand.');
                                }
                                else{
                                    $pallet->kits()->attach([['kit_id' => $kit->id, 'quantity' => $item_qty[$i][$y]]]);
                                }
                                
                            }
                            if (Cases::where('upc', $items[$i][$y])->where('user_id', auth()->user()->id)->exists()) {
                                $total_cases += $item_qty[$i][$y];
                                $case = Cases::where('upc', $items[$i][$y])->where('user_id', auth()->user()->id)->first();
                                if ($case->total_qty < $item_qty[$i][$y]) {
                                    throw new \Exception('Quantity of cases on pallet is greater than quantity at hand.');
                                }
                                else{
                                    $pallet->cases()->attach([['cases_id' => $case->id, 'quantity' => $item_qty[$i][$y]]]);
                                }
                                
                            }

                        }
                    }
                        if($request->carton_items != NULL){
                            
                            for($y = 0; $y < count($carton_qty); $y++){
                                dd($carton_qty);
                                $carton = new Carton();
                                $carton->user_id = auth()->user()->id;
                                $carton->company = auth()->user()->company_name;
                                $total_cartons += $carton_qty[$i][$y];
                                $carton->upc = $carton_barcode[$i][$y];
                                $carton->save();
                                for($z = 0; $z < count($carton_items[$i][$y]); $z++){
                                if (Basic_Unit::where('upc', $carton_items[$i][$y][$z])->where('user_id', auth()->user()->id)->exists()) {
                                    $total_units += $carton_item_qty[$i][$y][$z];
                                    $unit = Basic_Unit::where('upc', $carton_items[$i][$y][$z])->where('user_id', auth()->user()->id)->first();
                                    if ($unit->total_qty < $carton_item_qty[$i][$y][$z]) {
                                        throw new \Exception('Quantity of units in carton is greater than quantity at hand.');
                                    }
                                    else{
                                        $carton->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $carton_item_qty[$i][$y][$z]]]);
                                    }
                                    
                                }
                                if (Kit::where('upc', $carton_items[$i][$y][$z])->where('user_id', auth()->user()->id)->exists()) {
                                    $total_kits += $carton_item_qty[$i][$y][$z];
                                    $kit = Kit::where('upc', $carton_items[$i][$y][$z])->where('user_id', auth()->user()->id)->first();
                                    if ($kit->total_qty < $carton_item_qty[$i][$y][$z]) {
                                        throw new \Exception('Quantity of kits in carton is greater than quantity at hand.');
                                    }
                                    else{
                                        $carton->kits()->attach([['kit_id' => $kit->id, 'quantity' => $carton_item_qty[$i][$y][$z]]]);
                                    }
                                    
                                }
                                if (Cases::where('upc', $carton_items[$i][$y][$z])->where('user_id', auth()->user()->id)->exists()) {
                                    $total_cases += $carton_item_qty[$i][$y][$z];
                                    $case = Cases::where('upc', $carton_items[$i][$y][$z])->where('user_id', auth()->user()->id)->first();
                                    if ($case->total_qty < $carton_item_qty[$i][$y][$z]) {
                                        throw new \Exception('Quantity of cases in carton is greater than quantity at hand.');
                                    }
                                    else{
                                        $carton->cases()->attach([['cases_id' => $case->id, 'quantity' => $carton_item_qty[$i][$y][$z]]]);
                                    }
                                    
                                }
                            }
                            $pallet->cartons()->attach([['carton_id' => $carton->id, 'quantity' => $carton_qty[$i][$y]]]);
                        }
                    }
                    $pallet->save();
                }

                    if ($container_type === 'Carton') {
                        $carton = new Carton();
                        $carton->user_id = auth()->user()->id;
                        $carton->company = auth()->user()->company_name;
                        $carton->save();
                        $carton->upc = $container_barcodes[$i][0];
                        $total_cartons += $container_qtys[$i][0];
                        $carton->total_qty += $container_qtys[$i][0];
                        $order->cartons()->attach([['carton_id' => $carton->id, 'quantity' => $container_qtys[$i][0]]]);
                        for ($x = 0; $x < count($items[$i]); $x++) {

                            if (Basic_Unit::where('upc', $items[$i][$x])->where('user_id', auth()->user()->id)->exists()) {
                                $total_units += $item_qty[$i][$x];
                                $unit = Basic_Unit::where('upc', $items[$i][$x])->where('user_id', auth()->user()->id)->first();
                                if ($unit->total_qty < $item_qty[$i][$x]) {
                                    throw new \Exception('Quantity of units in carton is greater than quantity at hand.');
                                }
                                else{
                                    $carton->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $item_qty[$i][$x]]]);
                                }
                                
                            }
                            if (Kit::where('upc', $items[$i][$x])->where('user_id', auth()->user()->id)->exists()) {
                                $total_kits += $item_qty[$i][$x];
                                $kit = Kit::where('upc', $items[$i][$x])->where('user_id', auth()->user()->id)->first();
                                if ($kit->total_qty < $item_qty[$i][$x]) {
                                    throw new \Exception('Quantity of kits in carton is greater than quantity at hand.');
                                }
                                else{
                                    $carton->kits()->attach([['kit_id' => $kit->id, 'quantity' => $item_qty[$i][$x]]]);
                                }
                                
                            }
                            if (Cases::where('upc', $items[$i][$x])->where('user_id', auth()->user()->id)->exists()) {
                                $total_cases += $item_qty[$i][$x];
                                $case = Cases::where('upc', $items[$i][$x])->where('user_id', auth()->user()->id)->first();
                                if ($case->total_qty < $item_qty[$i][$x]) {
                                    throw new \Exception('Quantity of cases in carton is greater than quantity at hand.');
                                }
                                else{
                                    $carton->cases()->attach([['cases_id' => $case->id, 'quantity' => $item_qty[$i][$x]]]);
                                }
                                
                            }
                        }
                        $carton->save();
                    }
                    if ($container_type === 'Loose Items') {

                        for ($x = 0; $x < count($items[$i]); $x++) {

                            if (Basic_Unit::where('upc', $items[$i][$x])->where('user_id', auth()->user()->id)->exists()) {
                                $total_units += $item_qty[$i][$x];
                                $unit = Basic_Unit::where('upc', $items[$i][$x])->where('user_id', auth()->user()->id)->first();
                                if ($unit->total_qty < $item_qty[$i][$x]) {
                                    throw new \Exception('Quantity of units in loose item order is greater than quantity at hand.');
                                }
                                else{
                                    $order->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $item_qty[$i][$x]]]);
                                }
                                
                            }
                            if (Kit::where('upc', $items[$i][$x])->where('user_id', auth()->user()->id)->exists()) {
                                $total_kits += $item_qty[$i][$x];
                                $kit = Kit::where('upc', $items[$i][$x])->where('user_id', auth()->user()->id)->first();
                                if ($kit->total_qty < $item_qty[$i][$x]) {
                                    throw new \Exception('Quantity of kits in loose item order is greater than quantity at hand.');
                                }
                                else{
                                    $order->kits()->attach([['kit_id' => $kit->id, 'quantity' => $item_qty[$i][$x]]]);
                                }
                                
                            }
                            if (Cases::where('upc', $items[$i][$x])->where('user_id', auth()->user()->id)->exists()) {
                                $total_cases += $item_qty[$i][$x];
                                $case = Cases::where('upc', $items[$i][$x])->where('user_id', auth()->user()->id)->first();
                                if ($case->total_qty < $item_qty[$i][$x]) {
                                    throw new \Exception('Quantity of cases in loose item order is greater than quantity at hand.');
                                }
                                else{
                                    $order->cases()->attach([['cases_id' => $case->id, 'quantity' => $item_qty[$i][$x]]]);
                                }
                                
                            }
                        }
                    }

                }
                $order->pallet_qty = $total_pallets;
                $order->carton_qty = $total_cartons;
                $order->case_qty = $total_cases;
                $order->kit_qty = $total_kits;
                $order->unit_qty = $total_units;
                $order->save();
                DB::commit();
                Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
                return response()->json([
                    'success'  => 'Order submitted successfully. Your Order # is ' . $order->orderid . ''
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

    public function verify_order_skus(Request $request, $id){
        
        if($request->type == 'Unit'){
           
            if (Basic_Unit::where('sku', $request->sku)->where('company', 'Color Proof')->exists()) {
                $unit = Basic_Unit::where('sku', $request->sku)->where('company', 'Color Proof')->first();
                //dd($unit->upc);
                if(strval($unit->upc) == strval($request->barcode)){
                    return response()->json([
                        'success'  => 'This item matches the product SKU.'
                    ], 200);
                }
                else{
                    return response()->json([
                        'error'  => 'Barcode check. This item does not match the product SKU'
                    ], 404);
                }
            }
            else{
                return response()->json([
                    'error'  => 'Barcode check. This item does exist for the user who created the order.'
                ], 404);
            }

        }
        elseif($request->type == 'Case'){
           
            if (Cases::where('sku', $request->sku)->where('company', 'Color Proof')->exists()) {
                $case = Cases::where('sku', $request->sku)->where('company', 'Color Proof')->first();
                //dd($unit->upc);
                if(strval($case->upc) == strval($request->barcode)){
                    return response()->json([
                        'success'  => 'This item scanned matches the product SKU.'
                    ], 200);
                }
                else{
                    return response()->json([
                        'error'  => 'Barcode check. This item does not match the product SKU'
                    ], 404);
                }
            }
            else{
                return response()->json([
                    'error'  => 'Barcode check. his item does exist for the user who created the order.'
                ], 404);
            }
        }
        else{
            return response()->json([
                'error'  => 'This item does not match the product SKU'
            ], 404);
        }


    }

    public function updatestatus(Request $request, $id)
    {
        $order = Order::find($id);
        $order->status = $request->status;
        $useremail = User::find($order->user_id);
        $useremail = $useremail->email;

        DB::beginTransaction();
        try {

            

        if ($order->order_type == 'Transfer In Items' && $request->status == 'Completed') {

            if ($this->hasPallets($order, 'order')) {
                foreach ($order->pallets->all() as $pallet) {

                    if ($this->hasCartons($pallet, 'pallet')) {
                        foreach ($pallet->cartons->all() as $carton) {
                            if ($this->hasCases($carton, 'carton')) {
                                foreach ($carton->cases->all() as $case) {
                                    $caseobj = Cases::find($case->pivot->cases_id);
                                    $caseobj->case_shelf_qty += $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $caseobj->total_qty = ($caseobj->case_shelf_qty + $caseobj->case_pallet_qty);
                                    $caseobj->save();
                                    if ($this->hasKits($case, 'cases')) {
                                        foreach ($case->kits->all() as $kit) {
                                            $kitobj = Kit::find($kit->pivot->kit_id);
                                            $kitobj->case_qty += $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                            $kitobj->total_qty += $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                            $kitobj->save();
                                            if ($this->hasUnits($kit, 'kit')) {
                                                foreach ($kit->basic_units->all() as $unit) {
                                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                                    $unitobj->kit_qty += $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                                    $unitobj->total_qty += $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                                    $unitobj->save();
                                                }
                                            }
                                        }
                                    }
                                    if ($this->hasUnits($case, 'cases')) {
                                        foreach ($case->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->case_qty += $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                            $unitobj->total_qty = ($unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty);
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }

                            if ($this->hasKits($carton, 'carton')) {
                                foreach ($carton->kits->all() as $kit) {
                                    $kitobj = Kit::find($kit->pivot->kit_id);
                                    $kitobj->carton_qty += $kit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $kitobj->total_qty += $kit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $kitobj->save();
                                    if ($this->hasUnits($kit, 'kit')) {
                                        foreach ($kit->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->kit_qty += $unit->pivot->quantity * $kit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                            $unitobj->total_qty =  $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }
                            if ($this->hasUnits($carton, 'carton')) {
                                foreach ($carton->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->loose_item_qty +=  $unit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->total_qty =  $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                                    $unitobj->save();
                                }
                            }
                        $carton->status = 'In Warehouse';
                        $carton->save();
                        }
                    }

                    if ($this->hasCases($pallet, 'pallet')) {
                        foreach ($pallet->cases->all() as $case) {
                            $caseobj = Cases::find($case->pivot->cases_id);
                            $caseobj->case_shelf_qty += $case->pivot->quantity * $pallet->pivot->quantity;
                            $caseobj->total_qty = ($caseobj->case_pallet_qty + $caseobj->case_shelf_qty);
                            $caseobj->save();
                            if ($this->hasKits($case, 'cases')) {
                                foreach ($case->kits->all() as $kit) {
                                    $kitobj = Kit::find($kit->pivot->kit_id);
                                    $kitobj->case_qty += $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                    $kitobj->total_qty = $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                    $kitobj->save();
                                    if ($this->hasUnits($kit, 'kit')) {
                                        foreach ($kit->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->kit_qty += $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                            $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }
                            if ($this->hasUnits($case, 'cases')) {
                                foreach ($case->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->case_qty += $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->total_qty = ($unitobj->pallet_qty + $unitobj->case_qty + $unitobj->kit_qty + $unitobj->loose_item_qty);
                                    $unitobj->save();
                                }
                            }
                        }
                    }

                    if ($this->hasKits($pallet, 'pallet')) {
                        foreach ($pallet->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);
                            $kitobj->pallet_qty += $kit->pivot->quantity * $pallet->pivot->quantity;
                            $kitobj->total_qty += $kit->pivot->quantity * $pallet->pivot->quantity;
                            $kitobj->save();
                            if ($this->hasUnits($kit, 'kit')) {
                                foreach ($kit->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->kit_qty += $unit->pivot->quantity * $kit->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                                    $unitobj->save();
                                }
                            }
                        }
                    }
                    if ($this->hasUnits($pallet, 'pallet')) {
                        foreach ($pallet->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->loose_item_qty += $unit->pivot->quantity * $pallet->pivot->quantity;
                            $unitobj->total_qty = $unitobj->pallet_qty + $unitobj->case_qty + $unitobj->kit_qty + $unitobj->loose_item_qty;
                            $unitobj->save();
                        }
                    }

                    //$pallet->delete();
                    $pallet->status = 'In Warehouse';
                    $pallet->save();
                }
            }

            if ($this->hasCartons($order, 'order')) {
                foreach ($order->cartons->all() as $carton) {

                    if ($this->hasCases($carton, 'carton')) {
                        foreach ($carton->cases->all() as $case) {
                            $caseobj = Cases::find($case->pivot->cases_id);
                            $caseobj->case_shelf_qty += $case->pivot->quantity * $carton->pivot->quantity;
                            $caseobj->total_qty += $case->pivot->quantity * $carton->pivot->quantity;
                            $caseobj->save();
                            if ($this->hasKits($case, 'cases')) {
                                foreach ($case->kits->all() as $kit) {
                                    $kitobj = Kit::find($kit->pivot->kit_id);
                                    $kitobj->case_qty += $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity;
                                    $kitobj->total_qty += $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity;
                                    $kitobj->save();
                                    if ($this->hasUnits($kit, 'kit')) {
                                        foreach ($kit->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->kit_qty += $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity;
                                            $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }
                            if ($this->hasUnits($case, 'cases')) {
                                foreach ($case->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->case_qty += $unit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity;
                                    $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                                    $unitobj->save();
                                }
                            }
                        }
                    }

                    if ($this->hasKits($carton, 'carton')) {
                        foreach ($carton->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);
                            $kitobj->carton_qty += $kit->pivot->quantity * $carton->pivot->quantity;
                            $kitobj->total_qty += $kit->pivot->quantity * $carton->pivot->quantity;
                            $kitobj->save();
                            if ($this->hasUnits($kit, 'kit')) {
                                foreach ($kit->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->kit_qty += $unit->pivot->quantity * $kit->pivot->quantity * $carton->pivot->quantity;
                                    $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                                    $unitobj->save();
                                }
                            }
                        }
                    }
                    if ($this->hasUnits($carton, 'carton')) {
                        foreach ($carton->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->loose_item_qty +=  $unit->pivot->quantity * $carton->pivot->quantity;
                            $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                            $unitobj->save();
                        }
                    }
                    //$carton->delete();
                    $carton->status = 'In Warehouse';
                    $carton->save();
                }
            }

            if ($this->hasCases($order, 'order')) {

                foreach ($order->cases->all() as $case) {
                    $caseobj = Cases::find($case->pivot->cases_id);
                    $caseobj->case_shelf_qty += $case->pivot->quantity;
                    $caseobj->total_qty = $case->case_shelf_qty + $case->case_pallet_qty;
                    $caseobj->save();
                    if ($this->hasKits($case, 'cases')) {
                        foreach ($case->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);
                            $kitobj->case_qty += $kit->pivot->quantity * $case->pivot->quantity;
                            $kitobj->total_qty += $kit->pivot->quantity * $case->pivot->quantity;
                            $kitobj->save();
                            if ($this->hasUnits($kit, 'kit')) {
                                foreach ($kit->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->kit_qty += $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity;
                                    $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                                    $unitobj->save();
                                }
                            }
                        }
                    }
                    if ($this->hasUnits($case, 'cases')) {
                        foreach ($case->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->case_qty += $unit->pivot->quantity * $case->pivot->quantity;
                            $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
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
                            $unitobj->kit_qty += $unit->pivot->quantity * $kit->pivot->quantity;
                            $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                            $unitobj->save();
                        }
                    }
                }
            }

            if ($this->hasUnits($order, 'order')) {
                foreach ($order->basic_units->all() as $unit) {
                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                    $unitobj->loose_item_qty += $unit->pivot->quantity;
                    $unitobj->total_qty =  $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                    $unitobj->save();
                }
            }
        } elseif ($order->order_type == 'Transfer Out Items' && $request->status == 'Completed') {

            if ($this->hasPallets($order, 'order')) {
                foreach ($order->pallets->all() as $pallet) {

                    if ($this->hasCartons($pallet, 'pallet')) {
                        foreach ($pallet->cartons->all() as $carton) {
                            if ($this->hasCases($carton, 'carton')) {
                                foreach ($carton->cases->all() as $case) {
                                    $caseobj = Cases::find($case->pivot->cases_id);
                                    $caseobj->case_shelf_qty -= $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $caseobj->total_qty = $caseobj->case_shelf_qty + $case->case_pallet_qty;
                                    $caseobj->save();
                                    if ($this->hasKits($case, 'cases')) {
                                        foreach ($case->kits->all() as $kit) {
                                            $kitobj = Kit::find($kit->pivot->kit_id);
                                            $kitobj->case_qty -= $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                            $kitobj->total_qty -= $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                            $kitobj->save();
                                            if ($this->hasUnits($kit, 'kit')) {
                                                foreach ($kit->basic_units->all() as $unit) {
                                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                                    $unitobj->kit_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                                    $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                                                    $unitobj->save();
                                                }
                                            }
                                        }
                                    }
                                    if ($this->hasUnits($case, 'cases')) {
                                        foreach ($case->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->case_qty -= $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                            $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }

                            if ($this->hasKits($carton, 'carton')) {
                                foreach ($carton->kits->all() as $kit) {
                                    $kitobj = Kit::find($kit->pivot->kit_id);
                                    $kitobj->carton_qty -= $kit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $kitobj->total_qty -= $kit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $kitobj->save();
                                    if ($this->hasUnits($kit, 'kit')) {
                                        foreach ($kit->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->kit_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                            $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }
                            if ($this->hasUnits($carton, 'carton')) {
                                foreach ($carton->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->loose_item_qty -=  $unit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                                    $unitobj->save();
                                }
                            }
                        $carton->status = 'Transferred Out';
                        $carton->save();
                        }
                    }

                    if ($this->hasCases($pallet, 'pallet')) {
                        foreach ($pallet->cases->all() as $case) {
                            $caseobj = Cases::find($case->pivot->cases_id);
                            $caseobj->case_shelf_qty -= $case->pivot->quantity * $pallet->pivot->quantity;
                            $caseobj->total_qty = $caseobj->case_shelf_qty + $case->case_pallet_qty;
                            $caseobj->save();
                            if ($this->hasKits($case, 'cases')) {
                                foreach ($case->kits->all() as $kit) {
                                    $kitobj = Kit::find($kit->pivot->kit_id);
                                    $kitobj->case_qty -= $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                    $kitobj->total_qty -= $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                    $kitobj->save();
                                    if ($this->hasUnits($kit, 'kit')) {
                                        foreach ($kit->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->kit_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                            $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }
                            if ($this->hasUnits($case, 'cases')) {
                                foreach ($case->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->case_qty -= $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                                    $unitobj->save();
                                }
                            }
                        }
                    }

                    if ($this->hasKits($pallet, 'pallet')) {
                        foreach ($pallet->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);
                            $kitobj->pallet_qty -= $kit->pivot->quantity * $pallet->pivot->quantity;
                            $kitobj->total_qty -= $kit->pivot->quantity * $pallet->pivot->quantity;
                            $kitobj->save();
                            if ($this->hasUnits($kit, 'kit')) {
                                foreach ($kit->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->kit_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                                    $unitobj->save();
                                }
                            }
                        }
                    }
                    if ($this->hasUnits($pallet, 'pallet')) {
                        foreach ($pallet->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->case_qty -= $unit->pivot->quantity * $pallet->pivot->quantity;
                            $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                            $unitobj->save();
                        }
                    }

                    //$pallet->delete();
                    $pallet->status = 'Transferred Out';
                    $pallet->save();
                }
            }

            if ($this->hasCartons($order, 'order')) {
                foreach ($order->cartons->all() as $carton) {

                    if ($this->hasCases($carton, 'carton')) {
                        foreach ($carton->cases->all() as $case) {
                            $caseobj = Cases::find($case->pivot->cases_id);
                            $caseobj->case_shelf_qty -= $case->pivot->quantity * $carton->pivot->quantity;
                            $caseobj->total_qty -= $case->pivot->quantity * $carton->pivot->quantity;
                            $caseobj->save();
                            if ($this->hasKits($case, 'cases')) {
                                foreach ($case->kits->all() as $kit) {
                                    $kitobj = Kit::find($kit->pivot->kit_id);
                                    $kitobj->case_qty -= $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity;
                                    $kitobj->total_qty -= $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity;
                                    $kitobj->save();
                                    if ($this->hasUnits($kit, 'kit')) {
                                        foreach ($kit->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->kit_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity;
                                            $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }
                            if ($this->hasUnits($case, 'cases')) {
                                foreach ($case->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->case_qty -= $unit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity;
                                    $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                                    $unitobj->save();
                                }
                            }
                        }
                    }

                    if ($this->hasKits($carton, 'carton')) {
                        foreach ($carton->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);
                            $kitobj->carton_qty -= $kit->pivot->quantity * $carton->pivot->quantity;
                            $kitobj->total_qty -= $kit->pivot->quantity * $carton->pivot->quantity;
                            $kitobj->save();
                            if ($this->hasUnits($kit, 'kit')) {
                                foreach ($kit->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->kit_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $carton->pivot->quantity;
                                    $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                                    $unitobj->save();
                                }
                            }
                        }
                    }
                    if ($this->hasUnits($carton, 'carton')) {
                        foreach ($carton->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->loose_item_qty -=  $unit->pivot->quantity * $carton->pivot->quantity;
                            $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                            $unitobj->save();
                        }
                    }
                    //$carton->delete();
                    $carton->status = 'Transferred Out';
                    $carton->save();
                }
            }

            if ($this->hasCases($order, 'order')) {
                foreach ($order->cases->all() as $case) {
                    $caseobj = Cases::find($case->pivot->cases_id);
                    $caseobj->case_shelf_qty -= $case->pivot->quantity;
                    $caseobj->total_qty -= $caseobj->case_shelf_qty + $caseobj->case_pallet_qty;
                    $caseobj->save();
                    if ($this->hasKits($case, 'cases')) {
                        foreach ($case->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);
                            $kitobj->case_qty -= $kit->pivot->quantity * $case->pivot->quantity;
                            $kitobj->total_qty -= $kit->pivot->quantity * $case->pivot->quantity;
                            $kitobj->save();
                            if ($this->hasUnits($kit, 'kit')) {
                                foreach ($kit->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->kit_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity;
                                    $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                                    $unitobj->save();
                                }
                            }
                        }
                    }
                    if ($this->hasUnits($case, 'cases')) {
                        foreach ($case->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->case_qty -= $unit->pivot->quantity * $case->pivot->quantity;
                            $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
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
                            $unitobj->kit_qty -= $unit->pivot->quantity * $kit->pivot->quantity;
                            $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                            $unitobj->save();
                        }
                    }
                }
            }

            if ($this->hasUnits($order, 'order')) {
                foreach ($order->basic_units->all() as $unit) {
                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                    $unitobj->loose_item_qty -= $unit->pivot->quantity;
                    $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                    $unitobj->save();
                }
            }
        }  elseif ($order->order_type == 'Cartonize' && $request->status == 'Completed') {


                    if ($this->hasCases($order, 'order')) {
                        
                        foreach ($order->cases->all() as $case) {
                            $caseobj = Cases::find($case->pivot->cases_id);
                            //dd($order->pivot->quantity);
                            $caseobj->case_shelf_qty -= $case->pivot->quantity;
                            $caseobj->total_qty = ($caseobj->case_shelf_qty + $caseobj->case_pallet_qty);
                            $caseobj->save();

                            if ($this->hasUnits($case, 'cases')) {
                                foreach ($case->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    //use below once we get count
                                    $unitobj->case_qty -= $unit->pivot->quantity * $case->pivot->quantity;
                                    //$unitobj->total_qty = ($unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty);
                                    $unitobj->total_qty = $unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty;
                                    $unitobj->save();
                                }
                            }
                        }
                    }

                    if ($this->hasUnits($order, 'order')) {
                        foreach ($order->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            //$unitobj->carton_qty -=  $unit->pivot->quantity * $carton->pivot->quantity;
                            $unitobj->case_qty -= $unit->pivot->quantity;
                            $unitobj->total_qty = ($unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty);
                            $unitobj->save();
                        }
                    }
                    //$carton->delete();
                    
                    
                
            


        }elseif ($order->order_type == 'Palletize' && $request->status == 'Completed') {

            
                
                    if ($this->hasCases($order, 'order')) {
                        foreach ($order->cases->all() as $case) {
                            $caseobj = Cases::find($case->pivot->cases_id);
                            //caseobj->pallet_qty -= $case->pivot->quantity * $pallet->pivot->quantity;
                            $caseobj->case_shelf_qty -= $case->pivot->quantity;
                            $caseobj->total_qty = $caseobj->case_shelf_qty + $caseobj->case_pallet_qty;
                            $caseobj->save();
                            if ($this->hasKits($case, 'cases')) {
                                foreach ($case->kits->all() as $kit) {
                                    $kitobj = Kit::find($kit->pivot->kit_id);
                                    //$kitobj->case_qty -= $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                    $kitobj->total_qty -= $kit->pivot->quantity * $case->pivot->quantity;
                                    $kitobj->save();
                                    if ($this->hasUnits($kit, 'kit')) {
                                        foreach ($kit->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->kit_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity;
                                            $unitobj->total_qty = ($unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty);
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }
                            if ($this->hasUnits($case, 'cases')) {
                                foreach ($case->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    //$unitobj->case_qty -= $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->case_qty -= $unit->pivot->quantity * $case->pivot->quantity;
                                    $unitobj->total_qty = ($unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty);
                                    $unitobj->save();
                                }
                            }
                        }
                    }

                    if ($this->hasUnits($order, 'order')) {
                        foreach ($order->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            //$unitobj->pallet_qty -= $unit->pivot->quantity * $pallet->pivot->quantity;
                            $unitobj->case_qty -= $unit->pivot->quantity;
                            $unitobj->total_qty = ($unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->pallet_qty);
                            $unitobj->save();
                        }
                    }

        } elseif ($order->order_type == 'Fulfill Items' && $request->status == 'Completed') {

            if ($this->hasPallets($order, 'order')) {
                foreach ($order->pallets->all() as $pallet) {

                    if ($this->hasCartons($pallet, 'pallet')) {
                        foreach ($pallet->cartons->all() as $carton) {
                            if ($this->hasCases($carton, 'carton')) {
                                foreach ($carton->cases->all() as $case) {
                                    $caseobj = Cases::find($case->pivot->cases_id);
                                    $caseobj->carton_qty -= $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $caseobj->total_qty -= $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $caseobj->save();
                                    if ($this->hasKits($case, 'cases')) {
                                        foreach ($case->kits->all() as $kit) {
                                            $kitobj = Kit::find($kit->pivot->kit_id);
                                            $kitobj->case_qty -= $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                            $kitobj->total_qty -= $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                            $kitobj->save();
                                            if ($this->hasUnits($kit, 'kit')) {
                                                foreach ($kit->basic_units->all() as $unit) {
                                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                                    $unitobj->kit_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                                    $unitobj->total_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                                    $unitobj->save();
                                                }
                                            }
                                        }
                                    }
                                    if ($this->hasUnits($case, 'cases')) {
                                        foreach ($case->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->case_qty -= $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                            $unitobj->total_qty -= $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }

                            if ($this->hasKits($carton, 'carton')) {
                                foreach ($carton->kits->all() as $kit) {
                                    $kitobj = Kit::find($kit->pivot->kit_id);
                                    $kitobj->carton_qty -= $kit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $kitobj->total_qty -= $kit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $kitobj->save();
                                    if ($this->hasUnits($kit, 'kit')) {
                                        foreach ($kit->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->kit_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                            $unitobj->total_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }
                            if ($this->hasUnits($carton, 'carton')) {
                                foreach ($carton->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->carton_qty -=  $unit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->total_qty -=  $unit->pivot->quantity * $carton->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        $carton->status = 'Fulfilled';
                        $carton->save();
                        }
                    }

                    if ($this->hasCases($pallet, 'pallet')) {
                        foreach ($pallet->cases->all() as $case) {
                            $caseobj = Cases::find($case->pivot->cases_id);
                            $caseobj->pallet_qty -= $case->pivot->quantity * $pallet->pivot->quantity;
                            $caseobj->total_qty -= $case->pivot->quantity * $pallet->pivot->quantity;
                            $caseobj->save();
                            if ($this->hasKits($case, 'cases')) {
                                foreach ($case->kits->all() as $kit) {
                                    $kitobj = Kit::find($kit->pivot->kit_id);
                                    $kitobj->case_qty -= $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                    $kitobj->total_qty -= $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                    $kitobj->save();
                                    if ($this->hasUnits($kit, 'kit')) {
                                        foreach ($kit->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->kit_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                            $unitobj->total_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }
                            if ($this->hasUnits($case, 'cases')) {
                                foreach ($case->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->case_qty -= $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->total_qty -= $unit->pivot->quantity * $case->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        }
                    }

                    if ($this->hasKits($pallet, 'pallet')) {
                        foreach ($pallet->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);
                            $kitobj->pallet_qty -= $kit->pivot->quantity * $pallet->pivot->quantity;
                            $kitobj->total_qty -= $kit->pivot->quantity * $pallet->pivot->quantity;
                            $kitobj->save();
                            if ($this->hasUnits($kit, 'kit')) {
                                foreach ($kit->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->kit_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->total_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $pallet->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        }
                    }
                    if ($this->hasUnits($pallet, 'pallet')) {
                        foreach ($pallet->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->pallet_qty -= $unit->pivot->quantity * $pallet->pivot->quantity;
                            $unitobj->total_qty -= $unit->pivot->quantity * $pallet->pivot->quantity;
                            $unitobj->save();
                        }
                    }

                    //$pallet->delete();
                    $pallet->status = 'Fulfilled';
                    $pallet->save();
                }
            }

            if ($this->hasCartons($order, 'order')) {
                foreach ($order->cartons->all() as $carton) {

                    if ($this->hasCases($carton, 'carton')) {
                        foreach ($carton->cases->all() as $case) {
                            $caseobj = Cases::find($case->pivot->cases_id);
                            $caseobj->carton_qty -= $case->pivot->quantity * $carton->pivot->quantity;
                            $caseobj->total_qty -= $case->pivot->quantity * $carton->pivot->quantity;
                            $caseobj->save();
                            if ($this->hasKits($case, 'cases')) {
                                foreach ($case->kits->all() as $kit) {
                                    $kitobj = Kit::find($kit->pivot->kit_id);
                                    $kitobj->case_qty -= $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity;
                                    $kitobj->total_qty -= $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity;
                                    $kitobj->save();
                                    if ($this->hasUnits($kit, 'kit')) {
                                        foreach ($kit->basic_units->all() as $unit) {
                                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                            $unitobj->kit_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity;
                                            $unitobj->total_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity;
                                            $unitobj->save();
                                        }
                                    }
                                }
                            }
                            if ($this->hasUnits($case, 'cases')) {
                                foreach ($case->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->case_qty -= $unit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity;
                                    $unitobj->total_qty -= $unit->pivot->quantity * $case->pivot->quantity * $carton->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        }
                    }

                    if ($this->hasKits($carton, 'carton')) {
                        foreach ($carton->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);
                            $kitobj->carton_qty -= $kit->pivot->quantity * $carton->pivot->quantity;
                            $kitobj->total_qty -= $kit->pivot->quantity * $carton->pivot->quantity;
                            $kitobj->save();
                            if ($this->hasUnits($kit, 'kit')) {
                                foreach ($kit->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->kit_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $carton->pivot->quantity;
                                    $unitobj->total_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $carton->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        }
                    }
                    if ($this->hasUnits($carton, 'carton')) {
                        foreach ($carton->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->carton_qty -=  $unit->pivot->quantity * $carton->pivot->quantity;
                            $unitobj->total_qty -=  $unit->pivot->quantity * $carton->pivot->quantity;
                            $unitobj->save();
                        }
                    }
                    //$carton->delete();
                    $carton->status = 'Fulfilled';
                    $carton->save();
                }
            }

            if ($this->hasCases($order, 'order')) {
                foreach ($order->cases->all() as $case) {
                    $caseobj = Cases::find($case->pivot->cases_id);
                    $caseobj->total_qty -= $case->pivot->quantity;
                    $caseobj->save();
                    if ($this->hasKits($case, 'cases')) {
                        foreach ($case->kits->all() as $kit) {
                            $kitobj = Kit::find($kit->pivot->kit_id);
                            $kitobj->case_qty -= $kit->pivot->quantity * $case->pivot->quantity;
                            $kitobj->total_qty -= $kit->pivot->quantity * $case->pivot->quantity;
                            $kitobj->save();
                            if ($this->hasUnits($kit, 'kit')) {
                                foreach ($kit->basic_units->all() as $unit) {
                                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                                    $unitobj->kit_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity;
                                    $unitobj->total_qty = ($unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->carton_qty + $unitobj->pallet_qty);
                                    //$unitobj->total_qty -= $unit->pivot->quantity * $kit->pivot->quantity * $case->pivot->quantity;
                                    $unitobj->save();
                                }
                            }
                        }
                    }
                    if ($this->hasUnits($case, 'cases')) {
                        foreach ($case->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->case_qty -= $unit->pivot->quantity * $case->pivot->quantity;
                            $unitobj->total_qty = ($unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->carton_qty + $unitobj->pallet_qty);
                            //$unitobj->total_qty -= $unit->pivot->quantity * $case->pivot->quantity;
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
                    /*
                    if ($this->hasUnits($kit, 'kit')) {
                        foreach ($kit->basic_units->all() as $unit) {
                            $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                            $unitobj->kit_qty -= $unit->pivot->quantity * $kit->pivot->quantity;
                            $unitobj->total_qty -= $unit->pivot->quantity * $kit->pivot->quantity;
                            $unitobj->save();
                        }
                    }
                    */
                }
            }

            if ($this->hasUnits($order, 'order')) {
                foreach ($order->basic_units->all() as $unit) {
                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                    //$unitobj->total_qty -= $unit->pivot->quantity;
                    $unitobj->loose_item_qty -= $unit->pivot->quantity;
                    $unitobj->total_qty = ($unitobj->loose_item_qty + $unitobj->kit_qty + $unitobj->case_qty + $unitobj->carton_qty + $unitobj->pallet_qty);
                    $unitobj->save();
                }
            }
            Mail::to('ship@fillstorship.com')->send(new OrderFulfilled($order));
        }


        $order->save();
        DB::commit();
        //Mail::to('ship@fillstorship.com')->send(new StorUpdateMail($order));
        return back()->with('success', 'Success. Order #: ' . $order->orderid . ' has been updated.');


    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('eror', 'Error updating order #' . $order->orderid);

    }

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
        $orderid = $order->orderid;
        $order->pallets()->detach();
        $order->cases()->detach();
        $order->kits()->detach();
        $order->basic_units()->detach();
        $order->delete();
        return redirect()->back()->with('success', 'You have successfully deleted Order #: ' . $orderid . '');
    }
}
