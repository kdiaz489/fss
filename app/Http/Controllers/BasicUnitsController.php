<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Basic_Unit;
use App\User;
use Illuminate\Validation\Rule;

class BasicUnitsController extends Controller
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
        //
        return view('basic_units.create-unit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'upc'=> [ 'required',
                        Rule::unique('basic_unit_tbl')->where(function ($query) use($request){
                        $query->where('user_id', $request->user_id);
            })], 
            
            'desc' => 'required',
        ]);

        $unit = new Basic_Unit();
        $unit->sku = $request->sku;
        $unit->user_id = $request->user_id;
        $unit->upc = $request->upc;
        $unit->company = User::find($request->user_id)->company_name;
        $unit->loose_item_qty = 0;
        $unit->basic_unit_qty = 0;
        $unit->kit_qty = 0;
        $unit->case_qty = 0;
        $unit->carton_qty = 0;
        $unit->pallet_qty = 0;
        $unit->total_qty = 0;
        $unit->description = $request->desc;
        $unit->location = 'N/A';
        $unit->lot_num = 'N/A';
        $unit->save();
        return redirect()->back()->with('success', 'Product has been created - Sku: ' . $unit->sku);
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
        $basic_unit = Basic_Unit::find($id);
        return view('basic_units.show-unit')->with('basic_unit', $basic_unit);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $basic_unit = Basic_Unit::find($id);
        return view('basic_units.edit-unit')->with('basic_unit', $basic_unit);
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
            'sku'=> 'required',
            'upc' => 'required',
            'desc' => 'nullable',
            
        ]);

        $basic_unit = Basic_Unit::find($id);
        $basic_unit->sku = $request->sku;
        $basic_unit->upc = $request->upc;
        $basic_unit->description = $request->desc;
        $basic_unit->save();

        return redirect('/editbasicunit'. '/' . $id)->with('success', 'You have successfully updated unit. - SKU: ' . $basic_unit->sku . ' UPC: ' . $basic_unit->upc . '');
    
    }

    public function adminupdate(Request $request, $id)
    {
        //
        //dd($request);
        
        $basic_unit = Basic_Unit::find($id);
        $total = $request->pallet_qty + $request->case_qty + $request->loose_item_qty;

        $basic_unit->update([
                        'sku' => $request->sku, 
                        'upc' => $request->upc, 
                        'description' => $request->desc,
                        'loose_item_qty' => $request->loose_item_qty,
                        'basic_unit_qty' => $request->basic_unit_qty,
                        'kit_qty' => $request->kit_qty,
                        'case_qty' => $request->case_qty,
                        'carton_qty' => $request->carton_qty,
                        'pallet_qty' => $request->pallet_qty,
                        'location' => $request->location,
                        'lot_num' => $request->lot_num,
                        'total_qty' => $total
                        ]);


        return redirect()->back()->with('success', 'You have successfully updated unit. - SKU: ' . $basic_unit->sku . ' UPC: ' . $basic_unit->upc . '');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $basic_unit = Basic_Unit::find($id);
        $basic_unit->orders()->detach();
        $basic_unit->cases()->detach();
        $basic_unit->delete();
        return back()->with('success', 'You have successfully deleted unit.');

    }
}
