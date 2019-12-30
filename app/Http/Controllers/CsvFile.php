<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\User;
use App\Imports\CsvImport;
use App\Exports\CsvExport;
use App\Imports\OrderImport;
use App\Exports\OrderExport;
use App\Exports\UnitExport;
use App\Exports\KitExport;
use App\Exports\CaseExport;
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

    public function units_export($id){
        return Excel::download(new UnitExport($id), 'sample.csv');
    }

    public function kits_export($id){
        return Excel::download(new KitExport($id), 'sample.csv');
    }

    public function cases_export($id){
        return Excel::download(new CaseExport($id), 'sample.csv');
    }

    public function cartons_export($id){
        return Excel::download(new CartonExport($id), 'sample.csv');
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
