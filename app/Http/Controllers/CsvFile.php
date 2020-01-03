<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\User;
use App\Imports\CsvImport;
use App\Exports\OrderExport;
use App\Exports\InventoryExport;
use App\Imports\InventoryImport;
use App\Exports\TemplateExport;
use App\Exports\KitExport;
use App\Exports\CartonExport;

class CsvFile extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::latest()->paginate(10);
        
    }

    public function order_export($id){
        return Excel::download(new OrderExport($id), 'sample.csv');
    }

    public function csv_import(){
        Excel::import(new CsvImport, request()->file('file'));
        return back();
    }

    public function inventory_export($id){
        ini_set('precision', 18);
        return Excel::download(new InventoryExport($id), 'inventory_' . $id . '.csv' );
    }

    public function inventory_import($id){
        Excel::import(new InventoryImport($id), request()->file('file'));
        return back();
    }
    public function template_export($id){
        $user = User::select('id', 'company_name')->where('id', $id)->get();
        //dd($user);
        return Excel::download(new TemplateExport($user), 'inventory_template.csv' );
    }

    public function kits_export($id){
        return Excel::download(new KitExport($id), 'sample.csv');
    }

    public function cases_export($id){
        return Excel::download(new TemplateExport($id), 'sample.csv');
    }

    public function cartons_export($id){
        return Excel::download(new CartonExport($id), 'sample.csv');
    }

    /**
     * Show the form for importing inventory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('userdash.dash-import-inventory');
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
