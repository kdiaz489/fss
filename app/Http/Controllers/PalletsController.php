<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pallet;
use App\Cases;
use Illuminate\Support\Facades\Validator;

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
            $pallet = new Pallet();
            $pallet->pallet_name = $request->pallet_name;
            $pallet->user_id = auth()->user()->id;
            $pallet->company = auth()->user()->company_name;
            $pallet->sku = $request->sku;
            $pallet->upc = $request->upc;
            $pallet->description = $request->desc;
            $pallet->save();


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
                'success'  => 'Pallet submitted successfully.',
                'id' => $pallet->id,
                'sku' => $pallet->sku
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
        return redirect()->back()->with('success', 'You have successfully deleted pallet.');
    }
}
