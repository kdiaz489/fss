<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kit;
use App\Basic_Unit;
use App\User;
use Illuminate\Validation\Rule;

class KitsController extends Controller
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
        $kits = $user->kits;
        return view('orders.create-kit')->with('basic_units', $basic_units)->with('kits', $kits);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $request->validate([
            
            'kit_sku'=> ['required',
                        Rule::unique('kit_tbl')->where(function ($query){
                            return $query->where('user_id', auth()->user()->id);
                        })],
            'kit_price' => 'nullable',
            'kit_name' => 'required',
            'kit_desc' => 'nullable',
            
        ]);       

        $kit = new Kit();
        $kit->kit_name = $request->kit_name;
        $kit->user_id = auth()->user()->id;
        $kit->kit_price = $request->kit_price;
        $kit->kit_sku = $request->kit_sku;
        $kit->kit_desc = $request->kit_desc;
        $kit->save();
        $kit->basic_units()->sync($request->units);
        return redirect('/createkit')->with('success', 'Kit has been created.');
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
       
        return view('orders.edit-kit')->with('kit', $kit)->with('basic_units', $basic_units);
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


        $kit->delete();
        return redirect('/dashboard#inventoryrequests')->with('success', 'Kit has been Removed.');
    }
}
