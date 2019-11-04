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
        return view('orders.create-case')->with('units', $basic_units)->with('kits', $kits);
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
            $case->case_name = $request->case_name;
            $case->user_id = auth()->user()->id;
            $case->company = auth()->user()->company_name;
            $case->sku = $request->sku;
            $case->description = $request->desc;
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
                    $case->basic_units()->attach($unit_data);
                }

                if ($types[$i] == 'Kit') {
                    $data = array(
                        'kit_id' => $items[$i],
                        'quantity' => $item_qty[$i]
                    );
                    $kit_data[] = $data;
                    $case->kits()->attach($kit_data);
                }
            }
            
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
        $case = Cases::find($id);
        $user_id = $case->user_id;
        $user = User::find($user_id);
        $basic_units =  $case->basic_units->sortKeysDesc();
        $kits = $case->kits->all();
        return view('orders.show-case')->with('basic_units', $basic_units)->with('case', $case)->with('kits', $kits);
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
        return view('orders.edit-case')->with('units', $units)->with('case', $case)->with('kits', $kits);
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
            $case->basic_units()->detach();
            $case->kits()->detach();
            $case->case_name = $request->case_name;
            $case->sku = $request->sku;
            $case->description = $request->desc;


            $items = $request->items;
            $item_qty = $request->item_qty;
            $types = $request->types;
            

            for ($i = 0; $i < count($types); $i++) {
                if ($types[$i] == 'Unit') {
                    
                    $case->basic_units()->attach(['basic__unit_id' => $items[$i]], ['quantity' => $item_qty[$i]]);
                }

                if ($types[$i] == 'Kit') {
                  
                    $case->kits()->attach(['basic__unit_id' => $items[$i]], ['quantity' => $item_qty[$i]]);
                }
            }

            $case->save();

            return response()->json([
                'success'  => 'Case submitted successfully.'
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
        $case = Cases::find($id);
        $case->basic_units()->detach();
        $case->orders()->detach();
        $case->kits()->detach();
        $case->delete();
        return redirect()->back()->with('success', 'Case has been Removed.');
    }
}
