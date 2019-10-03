<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fullfilment;
use Auth;

class FulfillmentsController extends Controller
{
    public function create(){
        $title = 'Storage';
        return view('fulfillment.fil')->with('title', $title);
    }




    public function store(){
        $storage = new Storage();

        if(Auth::guest() ){
            $storage->user_id = 0;

        }
        else{
            $storage->user_id = auth()->user()->id;
        }

        $storage->pro_no = request('pro_no');
        $storage->pu_no = request('pu_no');
        $storage->po_no = request('po_no');
        $storage->barcode = request('barcode');
        $storage->sku = request('sku');
        $storage->description = request('description');
        $storage->inb_carton = request('inb_carton');
        $storage->inb_case = request('inb_case');
        $storage->inb_item = request('inb_item');
        $storage->inb_tot_qty = request('inb_tot_qty');
        $storage->out_carton = 0;
        $storage->out_case = 0;
        $storage->out_item = 0;
        $storage->out_tot_qty = 0;
        $storage->elim_carton = 0;
        $storage->elim_case = 0;
        $storage->elim_item = 0;
        $storage->elim_tot_qty = 0;
        $storage->building = 'N/A';
        $storage->row_ = 'N/A';
        $storage->column_ = 'N/A';



        $storage->save();




        //return redirect('/ship')->with('success', 'Shipment Request Sent');
        //dd($palletGo, $charges);

        return redirect('/dashboard')->with('success', 'Shipment Request Sent');
    }

}
