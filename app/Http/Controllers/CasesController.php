<?php

namespace App\Http\Controllers;

use App\Cases;
use App\User;
use App\Basic_Unit;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class CasesController extends Controller
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
        $basic_units =  $user->basic_units->sortKeysDesc();
        $kits = $user->kits->all();
        return view('cases.create-case')->with('units', $basic_units)->with('kits', $kits);
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


            $rules = array(
                'items.*'  => 'required',
                'item_qty.*'  => 'required',
                'types.*' => 'required'
            );



            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }
            $case = new Cases();
            $case->user_id = auth()->user()->id;
            $case->company = auth()->user()->company_name;
            $case->description = $request->desc;
            $case->sku = $request->sku;
            $case->upc = $request->upc;
            $case->loose_item_qty = 0;
            $case->basic_unit_qty = 0;
            $case->kit_qty = 0;
            $case->case_qty = 0;
            $case->carton_qty = 0;
            $case->pallet_qty = 0;
            $case->total_qty = 0;
            $case->save();

            $items = $request->items;
            $item_qty = $request->item_qty;
            $types = $request->types;


            for ($i = 0; $i < count($types); $i++) {
                if ($types[$i] == 'Unit') {
                    $data = array(
                        'basic__unit_id' => $items[$i],
                        'quantity' => $item_qty[$i]
                    );
                    $unit_data[] = $data;
                    $case->case_qty += $item_qty[$i];
                    $case->save();
                    $case->basic_units()->attach($unit_data);
                }

                if ($types[$i] == 'Kit') {
                    $data = array(
                        'kit_id' => $items[$i],
                        'quantity' => $item_qty[$i]
                    );
                    $kit_data[] = $data;
                    $case->case_qty += $item_qty[$i];
                    $case->save();
                    $case->kits()->attach($kit_data);
                }
            }
            
            return response()->json([
                'success'  => 'Case has been created. - SKU: ' . $case->sku . ' UPC: ' . $case->upc . ''
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
        $case = Cases::find($id);
        $user_id = $case->user_id;
        $user = User::find($user_id);
        $basic_units =  $case->basic_units->sortKeysDesc();
        $kits = $case->kits->all();
        return view('cases.show-case')->with('basic_units', $basic_units)->with('case', $case)->with('kits', $kits);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $case = Cases::find($id);
        $user_id = $case->user_id;
        $user = User::find($user_id);
        $units =  $user->basic_units->sortKeysDesc();
        $kits = $user->kits->all();
        return view('cases.edit-case')->with('units', $units)->with('case', $case)->with('kits', $kits);
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


            $rules = array(
                'items.*'  => 'required',
                'item_qty.*'  => 'required',
                'types.*' => 'required'
            );



            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }
            $case = Cases::find($id);
            $case->sku = $request->sku;
            $case->upc = $request->upc;
            $case->case_qty = 0;
            $case->description = $request->desc;
            $case->save();
            $case->kits()->detach();
            $case->basic_units()->detach();

            $items = $request->items;
            $item_qty = $request->item_qty;
            $types = $request->types;


            for ($i = 0; $i < count($types); $i++) {
                if ($types[$i] == 'Unit') {
                    $data = array(
                        'basic__unit_id' => $items[$i],
                        'quantity' => $item_qty[$i]
                    );
                    $unit_data[] = $data;
                    $case->case_qty += $item_qty[$i];
                    $case->save();
                    $case->basic_units()->attach($unit_data);
                }

                if ($types[$i] == 'Kit') {
                    $data = array(
                        'kit_id' => $items[$i],
                        'quantity' => $item_qty[$i]
                    );
                    $kit_data[] = $data;
                    $case->case_qty += $item_qty[$i];
                    $case->save();
                    $case->kits()->attach($kit_data);
                }
            }
            
            return response()->json([
                'success'  => 'Case has been updated. - SKU: ' . $case->sku . ' UPC: ' . $case->upc . ''
            ]);
        }
    }

    public function adminupdate(Request $request, $id)
    {
        //
        //dd($request);
        
        $case = Cases::find($id);

        $case->update([
                        'sku' => $request->sku, 
                        'upc' => $request->upc, 
                        'description' => $request->desc,
                        'loose_item_qty' => $request->loose_item_qty,
                        'basic_unit_qty' => $request->basic_unit_qty,
                        'kit_qty' => $request->kit_qty,
                        'case_qty' => $request->case_qty,
                        'carton_qty' => $request->carton_qty,
                        'pallet_qty' => $request->pallet_qty,
                        'total_qty' => $request->total_qty,
                        'location' => $request->location,
                        'lot_num' => $request->lot_num,
                        ]);


        //return redirect('/dashboard/admin/editunit/' . $id)->with('success', 'You have successfully updated unit. - SKU: ' . $basic_unit->sku . ' UPC: ' . $basic_unit->upc . '');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $case = Cases::find($id);
        $sku = $case->sku;
        $upc = $case->upc;
        $case->basic_units()->detach();
        $case->orders()->detach();
        $case->kits()->detach();
        $case->delete();
        return redirect()->back()->with('success', 'You have successfully deleted case. - SKU: ' . $sku . ' UPC: ' . $upc . '');
    }
}
