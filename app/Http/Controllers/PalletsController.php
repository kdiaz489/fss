<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pallet;
use App\Carton;
use App\Cases;
use App\Kit;
use App\Basic_Unit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PalletsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

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
    public function create()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $cases = $user->cases->all();
        $units = $user->basic_units->all();
        $kits = $user->kits->all();
        $cartons = $user->cartons->all();
        return view('pallet.create-pallet')->with('cartons', $cartons)->with('kits', $kits)->with('cases', $cases)->with('units', $units);
    }

    public function getpallet($id){
        $pallet = Pallet::with('basic_units', 'cases')->find($id);
        return collect(['pallet' => $pallet]);
    }

    public function pickfrompallet(Request $request, $id){
        
        $pallet = Pallet::with('cases','basic_units')->find($id);
        $item = $request->item;
        $item_qty = $request->item_qty;
        if($pallet->cases != null){
            $cases = $pallet->cases;
            for($i = 0; $i < count($cases); $i++){
                if($cases[$i]->sku == $item[$i]){
                    
                    $quantity = ((int)$cases[$i]->pivot->quantity - (int)$item_qty[$i]);
                    
                    $cases[$i]->pivot->quantity = $quantity;
                    $cases[$i]->pivot->save();

                    $cases[$i]->case_pallet_qty -= $item_qty[$i];
                    $cases[$i]->case_shelf_qty += $item_qty[$i];
                    $cases[$i]->total_qty = ($cases[$i]->case_shelf_qty + $cases[$i]->case_pallet_qty);
                    $cases[$i]->save();

                    foreach($cases[$i]->basic_units->all() as $unit){
                        $unit->pallet_qty -= $item_qty[$i] * $cases[$i]->qty_per_case;
                        $unit->case_qty += $item_qty[$i] * $cases[$i]->qty_per_case;
                        $unit->total_qty = ($unit->case_qty + $unit->pallet_qty + $unit->loose_item_qty);
                        $unit->save();
                    }

                }
            }
        }

        if($pallet->basic_units != null){
            $units = $pallet->basic_units;
            for($i = 0; $i < count($units); $i++){
                if($units[$i]->sku == $item[$i]){
                    
                    $quantity = ((int)$units[$i]->pivot->quantity - (int)$item_qty[$i]);
                    
                    $units[$i]->pivot->quantity = $quantity;
                    $units[$i]->pivot->save();

                    $units[$i]->pallet_qty -= $item_qty[$i];
                    $units[$i]->total_qty = ($units[$i]->case_qty + $units[$i]->pallet_qty + $units[$i]->loose_item_qty);
                    $units[$i]->save();
                }
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {


            /**
             * Establishes rules for form
             * Items, item quantity and pallet quantity are required
             * If rules are not met, json error is returned to the form
             */
            $rules = array(
                'items.*'  => 'required',
                'item_qty.*'  => 'required',
            );

            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }

            DB::beginTransaction();
            try{
            /**
             * If request passes validation, Pallet object is initiated and attributes are set
             */
            $pallet = new Pallet();
            //$pallet->pallet_name = $request->pallet_name;
            $pallet->user_id = $request->user_id;
            $pallet->company = User::find($request->user_id)->company_name;
            $pallet->sku = $request->sku;
            $pallet->upc = $request->upc;
            $pallet->status="Pending Approval";
            $pallet->description = $request->desc;
            $pallet->loose_item_qty = 0;
            $pallet->basic_unit_qty = 0;
            $pallet->kit_qty = 0;
            $pallet->case_qty = 0;
            $pallet->carton_qty = 0;
            $pallet->pallet_qty = 0;
            $pallet->total_qty = 0;
            $pallet->save();


            /**
             * 
             * Form arrays are saved into local variables
             * 
             */
            $items = $request->items;
            $item_qty = $request->item_qty;


            /**
             * Conditional statements check for the type of items that were submitted to the form
             * Checks for Unit, Kit, Case, if condition is met then create an object based on the item type and attached to the $pallet
             */
            for ($i = 0; $i < count($items); $i++) {
                if (Basic_Unit::where('user_id', $request->user_id)->whereNotNull('upc')->where('upc', $items[$i])->exists()) {
                    $unit = Basic_Unit::where('user_id', $request->user_id)->whereNotNull('upc')->where('upc', $items[$i])->first();
                    $pallet->basic_units()->attach(['basic__unit_id' => $unit->id], ['quantity' => $item_qty[$i]]);
                 }
                 

                 elseif (Kit::where('user_id', $request->user_id)->whereNotNull('upc')->where('upc', $items[$i])->exists()) {
                     $kit = Kit::where('user_id', $request->user_id)->whereNotNull('upc')->where('upc', $items[$i])->first();
                    $pallet->kits()->attach(['kit_id' => $kit->id], ['quantity' => $item_qty[$i]]);
                 }
                 

                 elseif (Cases::where('user_id', $request->user_id)->whereNotNull('upc')->where('upc', $items[$i])->exists()) {
                    $case = Cases::where('user_id', $request->user_id)->whereNotNull('upc')->where('upc', $items[$i])->first();
                    $pallet->cases()->attach(['cases_id' => $case->id], ['quantity' => $item_qty[$i]]);
                }
                

                elseif (Carton::where('user_id', $request->user_id)->whereNotNull('upc')->where('upc', $items[$i])->exists()) {
                    $carton = Carton::where('user_id', $request->user_id)->whereNotNull('upc')->where('upc', $items[$i])->first();
                    $pallet->cartons()->attach(['carton_id' => $carton->id], ['quantity' => $item_qty[$i]]);
                }
                else{
                    throw new \Exception('Please confirm that all items have a UPC/Barcode to continue creating pallet.');
                 }
            }

            /**
             * Pallet that was initiated and saved. Json success message returned to form.
             */
            DB::commit();
            return response()->json([
                'success'  => 'Pallet submitted successfully.',
                'id' => $pallet->id,
                'sku' => $pallet->sku
            ]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
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
        $pallet = Pallet::find($id);
        $cases = $pallet->cases->all();
        $kits = $pallet->kits->all();
        $units = $pallet->basic_units->all();
        return view('pallet.show-pallet')->with('pallet', $pallet)->with('cases', $cases)->with('kits', $kits)->with('units', $units);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pallet = Pallet::find($id);
        $user_id = $pallet->user_id;
        $user = User::find($user_id);
        $units = $user->basic_units->all();
        $kits = $user->kits->all();
        $cases = $user->cases->all();
        $cartons = $user->cartons->all();

        return view('pallet.edit-pallet')->with('units', $units)->with('kits', $kits)->with('cases', $cases)->with('cartons', $cartons)->with('pallet', $pallet);
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
        if ($request->ajax()) {


            /**
             * Establishes rules for form
             * Items, item quantity and pallet quantity are required
             * If rules are not met, json error is returned to the form
             */
            $rules = array(
                'items.*'  => 'required',
                'item_qty.*'  => 'required',
                'type' => 'required',
                
            );

            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }


            /**
             * If request passes validation, Pallet object is initiated and attributes are set
             */
            $pallet = Pallet::find($id);
            $pallet->sku = $request->sku;
            $pallet->description = $request->desc;
            $pallet->save();
            $pallet->basic_units()->detach();
            $pallet->kits()->detach();
            $pallet->cases()->detach();
            $pallet->cartons()->detach();


            /**
             * 
             * Form arrays are saved into local variables
             * 
             */
            $items = $request->items;
            $types = $request->type;
            $item_qty = $request->item_qty;


            /**
             * Conditional statements check for the type of items that were submitted to the form
             * Checks for Unit, Kit, Case, if condition is met then create an object based on the item type and attached to the $pallet
             */
            for ($i = 0; $i < count($types); $i++) {
                if ($types[$i] == 'Unit') {
                    /* 
                    $data = array(
                        'basic__unit_id' => $items[$i],
                        'quantity' => $item_qty[$i]
                    );
                    
                    $unit_data[] = $data;
                    */
                    $pallet->basic_units()->attach(['basic__unit_id' => $items[$i]], ['quantity' => $item_qty[$i]]);


                 }

                if ($types[$i] == 'Kit') {
                    /* 
                    $data = array(
                        'kit_id' => $items[$i],
                        'quantity' => $item_qty[$i]
                    );
                    
                    $kit_data[] = $data;
                    */
                    $pallet->kits()->attach(['kit_id' => $items[$i]], ['quantity' => $item_qty[$i]]);


                 }

                if ($types[$i] == 'Case') {
                    /*
                    $data = array(
                        'cases_id' => $items[$i],
                        'quantity' => $item_qty[$i]
                    );
                    
                    $case_data[] = $data;
                    */
                    $pallet->cases()->attach(['cases_id' => $items[$i]], ['quantity' => $item_qty[$i]]);
                }

                if ($types[$i] == 'Carton') {
                    /*
                    $data = array(
                        'cases_id' => $items[$i],
                        'quantity' => $item_qty[$i]
                    );
                    
                    $case_data[] = $data;
                    */
                    $pallet->cartons()->attach(['carton_id' => $items[$i]], ['quantity' => $item_qty[$i]]);
                }
            }

            /*
            for ($i = 0; $i < count($cases); $i++) {
                $data = array(
                    'cases_id' => $cases[$i],
                    'quantity'  => $case_qty[$i]
                );
                $insert_data[] = $data;
            }
            */


            /**
             * Pallet that was initiated and saved. Json success message returned to form.
             */
            
            return response()->json([
                'success'  => 'Pallet updated successfully.',
                'id' => $pallet->id,
                'sku' => $pallet->sku
            ]);
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
        $pallet = Pallet::find($id);
        $pallet->delete();
        return back()->with('success', 'You have successfully deleted pallet.');
    }
}
