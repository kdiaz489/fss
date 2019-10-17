<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Unit;

use App\Sku;

class UnitsController extends Controller
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
        //
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
        $accu_unit = new Unit();
        $sku = new Sku();
        $accu_unit->unit_name = $request->unit_name;
        $accu_unit->unit_type = $request->unit_type;
        $accu_unit->num_units = $request->num_units;
        $accu_unit->num_prod_unit = $request->num_prod_unit;
        $accu_unit->num_prod_tot = $request->num_prod_tot;
        $accu_unit->sku_1 = $request->sku_1;
        $accu_unit->sku_1_qty = $request->sku_1_qty;
        $accu_unit->sku_2 = $request->sku_2;
        $accu_unit->sku_2_qty = $request->sku_2_qty;
        $accu_unit->save();

       
        $sku->accu_unit_id = $accu_unit->id;
        $sku->accu_prod_tot = $request->num_units;
        $sku->loose_prod = 100;
        $sku->prod_kits = 1;
        $sku->prod_cases= 2;
        $sku->tot_num_prod = 3;

        return redirect('/dashboard')->with('success', 'Success. Unit will be transferred in. SKU added.');
        
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
        //
    }
}
