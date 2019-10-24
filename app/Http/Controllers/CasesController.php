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
        return view('orders.create-case')->with('units', $basic_units);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            $rules = array(
            'units.*'  => 'required',
            'unit_qty.*'  => 'required'
            );



            $error = Validator::make($request->all(), $rules);
            if($error->fails()){
            return response()->json([
                'error'  => $error->errors()->all()
            ]);
            }
            $case = new Cases();
            $unit = new Basic_Unit();
            $case->case_name = $request->case_name;
            $case->user_id = auth()->user()->id;
            $case->company = auth()->user()->company_name;
            $case->sku = $request->sku;
            $case->description = $request->desc;

            
            $units = $request->units;
            $unit_qty = $request->unit_qty;
            $total_units = 0;

            for($i = 0; $i < count($units); $i++){
                $total_units += $unit_qty[$i];
                $data = array(
                    'units' => $units[$i],
                    'unit_qty'  => $unit_qty[$i]
                    );
                $insert_data[] = $data;
            }

            $case->save();

            for($x = 0; $x < count($units); $x++){
                $case->basic_units()->attach(['basic__unit_id' => $units[$x]], ['quantity'=> $unit_qty[$x]]);
            }
            
            //return response()->json($insert_data);
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
        return view('orders.show-case')->with('basic_units', $basic_units)->with('case', $case);
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
        $basic_units =  $case->basic_units->sortKeysDesc();
        return view('orders.edit-case')->with('basic_units', $basic_units)->with('case', $case);
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
        $case->delete();
        return redirect('/dashboard#inventoryrequests')->with('success', 'Case has been Removed.');
    }
}
