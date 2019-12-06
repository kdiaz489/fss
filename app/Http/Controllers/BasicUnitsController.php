<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Basic_Unit;
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
        return view('orders.create-unit');
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
            'sku'=> [ 'required',
                        Rule::unique('basic_unit_tbl')->where(function ($query){
                        $query->where('user_id', auth()->user()->id);
            })], 
            
            'desc' => 'required',
        ]);

        $unit = new Basic_Unit();
        $unit->sku = $request->sku;
        $unit->user_id = auth()->user()->id;
        $unit->upc = $request->upc;
        $unit->description = $request->desc;
        $unit->save();
        return redirect('/basicunit')->with('success', 'Product has been added - Sku: ' . $unit->sku);
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
        return view('orders.show-unit')->with('basic_unit', $basic_unit);
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
        return view('orders.edit-unit')->with('basic_unit', $basic_unit);
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
            'price' => 'nullable',
            'name' => 'required',
            'desc' => 'nullable',
            'weight' => 'nullable'
        ]);

        $basic_unit = Basic_Unit::find($id);
        $basic_unit->sku = $request->sku;
        $basic_unit->price = $request->price;
        $basic_unit->unit_name = $request->name;
        $basic_unit->description = $request->desc;
        $basic_unit->weight = $request->weight;
        $basic_unit->save();

        return redirect('/editbasicunit'. '/' . $id)->with('success', 'You have successfully updated product ' . $basic_unit->unit_name);
    
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
        return redirect()->back()->with('success', 'You have successfully deleted unit.');

    }
}
