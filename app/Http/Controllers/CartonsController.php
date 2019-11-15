<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Carton;
use Illuminate\Support\Facades\Validator;

class CartonsController extends Controller
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
    public function create()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $basic_units =  $user->basic_units->all();
        $kits = $user->kits->all();
        $cases = $user->cases->all();
        return view('carton.create-carton')->with('units', $basic_units)->with('kits', $kits)->with('cases', $cases);
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
            $carton = new Carton();
           
            $carton->user_id = auth()->user()->id;
            $carton->company = auth()->user()->company_name;
            $carton->sku = $request->sku;
            $carton->description = $request->desc;
            $carton->save();


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
             * Checks for Unit, Kit, Case, if condition is met then create an object based on the item type and attached to the $carton
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
                    $carton->basic_units()->attach(['basic__unit_id' => $items[$i]], ['quantity' => $item_qty[$i]]);


                 }

                if ($types[$i] == 'Kit') {
                    /* 
                    $data = array(
                        'kit_id' => $items[$i],
                        'quantity' => $item_qty[$i]
                    );
                    
                    $kit_data[] = $data;
                    */
                    $carton->kits()->attach(['kit_id' => $items[$i]], ['quantity' => $item_qty[$i]]);


                 }

                if ($types[$i] == 'Case') {
                    /*
                    $data = array(
                        'cases_id' => $items[$i],
                        'quantity' => $item_qty[$i]
                    );
                    
                    $case_data[] = $data;
                    */
                    $carton->cases()->attach(['cases_id' => $items[$i]], ['quantity' => $item_qty[$i]]);
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
                'success'  => 'Carton submitted successfully.',
                'id' => $carton->id,
                'sku' => $carton->sku
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
        $carton = Carton::find($id);
        $cases = $carton->cases->all();
        $kits = $carton->kits->all();
        $units = $carton->basic_units->all();
        return view('carton.show-carton')->with('carton', $carton)->with('cases', $cases)->with('kits', $kits)->with('units', $units);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carton = Carton::find($id);
        $user_id = $carton->user_id;
        $user = User::find($user_id);
        $units =  $user->basic_units->all();
        $kits = $user->kits->all();
        $cases = $user->cases->all();
        return view('carton.edit-carton')->with('carton', $carton)->with('units', $units)->with('cases', $cases)->with('kits', $kits);
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
            $carton = Carton::find($id);
            $carton->sku = $request->sku;
            $carton->description = $request->desc;
            $carton->save();
            $carton->basic_units()->detach();
            $carton->kits()->detach();
            $carton->cases()->detach();


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
             * Checks for Unit, Kit, Case, if condition is met then create an object based on the item type and attached to the $carton
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
                    $carton->basic_units()->attach(['basic__unit_id' => $items[$i]], ['quantity' => $item_qty[$i]]);


                 }

                if ($types[$i] == 'Kit') {
                    /* 
                    $data = array(
                        'kit_id' => $items[$i],
                        'quantity' => $item_qty[$i]
                    );
                    
                    $kit_data[] = $data;
                    */
                    $carton->kits()->attach(['kit_id' => $items[$i]], ['quantity' => $item_qty[$i]]);


                 }

                if ($types[$i] == 'Case') {
                    /*
                    $data = array(
                        'cases_id' => $items[$i],
                        'quantity' => $item_qty[$i]
                    );
                    
                    $case_data[] = $data;
                    */
                    $carton->cases()->attach(['cases_id' => $items[$i]], ['quantity' => $item_qty[$i]]);
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
                'success'  => 'Carton updated successfully.',
                'id' => $carton->id,
                'sku' => $carton->sku
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
        $carton = Carton::find($id);
        $carton->delete();
        return redirect()->back()->with('success', 'You have successfully deleted carton.');
    }
}
