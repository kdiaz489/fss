<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kit;
use App\Basic_Unit;
use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class KitsController extends Controller
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
        $basic_units =  $user->basic_units->sortKeysDesc();
        $kits = $user->kits;
        return view('orders.create-kit')->with('units', $basic_units)->with('kits', $kits);
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
                'type.*' => 'required',
                
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
            $kit = new Kit();
            $kit->user_id = auth()->user()->id;
            $kit->company = auth()->user()->company_name;
            $kit->sku = $request->sku;
            $kit->description = $request->desc;
            $kit->save();


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
            for ($i = 0; $i < count($item_qty); $i++) {
                if ($types[$i] == 'Unit') { 
                    /*
                    $data = array(
                        'basic__unit_id' => $items[$i],
                        'quantity' => $item_qty[$i]
                    );
                    $unit_data[] = $data;
                    */
                    $kit->kit_qty += $item_qty[$i];
                    $kit->save();
                    $kit->basic_units()->attach(['basic__unit_id' => $items[$i]], ['quantity' => $item_qty[$i]]);


                 }
            }
            return response()->json([
                'success'  => 'Kit submitted successfully.'
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
        $kit = Kit::find($id);
        $user_id = $kit->user_id;
        $user = User::find($user_id);
        $basic_units =  $kit->basic_units->sortKeysDesc();
        return view('orders.show-kit')->with('basic_units', $basic_units)->with('kit', $kit);
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
        
        
        $kit = Kit::find($id);
        $user_id = $kit->user_id;
        $user = User::find($user_id);
        $basic_units = $user->basic_units->sortKeysDesc();
       
        return view('orders.edit-kit')->with('kit', $kit)->with('units', $basic_units);
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

         $request->validate([
            
            'kit_sku'=> 'required',
            'kit_price' => 'nullable',
            'kit_name' => 'required',
            'kit_desc' => 'nullable',
            'units' => 'required',
            
        ]);   

        $kit = Kit::find($id);
        $kit->kit_name = $request->kit_name;
        $kit->kit_price = $request->kit_price;
        $kit->kit_sku = $request->kit_sku;
        $kit->kit_desc = $request->kit_desc;
        $kit->save();

        $kit->basic_units()->sync($request->units);
        return redirect('/editkit'. '/' . $id)->with('success', 'You have successfully updated Kit' . $kit->kit_name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kit = Kit::find($id);

        $kit->basic_units()->detach();
        $kit->delete();
        return redirect()->back()->with('success', 'You have successfully deleted kit.');
    }
}
