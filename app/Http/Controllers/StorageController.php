<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Storage;
use Auth;
use App\Mail\StorRequestMail;
use App\Mail\CustomerStorRequestMail;


class StorageController extends Controller
{
    public function create(){
        $title = 'Storage';
        return view('storage.stor')->with('title', $title);
    }

    public function addinventory(){
        return view('storage.addinventory');
    }

    public function transoutInventory(){
        return view('storage.transoutinventory');
    }


    public function eliminventory(){
        return view('storage.eliminventory');
    }

    public function show($id)
    {
        $storage = Storage::find($id);
        return view('storage.showuserinventory')->with('storage', $storage);
    }

    public function edit($id){
        $product = Storage::find($id);
        return view('admin.storage.editproduct')->with('product', $product);
    }

    public function update(Request $request, $id){
        $product = Storage::find($id);
        if($request->pro_no != '' || $request->pro_no != NULL){
            $product->pro_no = $request->pro_no;    
        }
        else{
            $product->pro_no = ' ';
        }

        if($request->pu_no != '' || $request->pu_no != NULL){
            $product->pu_no= $request->pu_no;    
        }
        else{
            $product->pu_no = ' ';
        }

        if($request->po_no != '' || $request->po_no != NULL){
            $product->po_no= $request->po_no;    
        }
        else{
            $product->po_no = ' ';
        }

        if($request->sku != '' || $request->sku != NULL){
           $product->sku = $request->sku;    
        }
        else{
            $product->sku = ' ';
        }

        if($request->barcode != '' || $request->barcode != NULL){
           $product->barcode = $request->barcode;    
        }
        else{
            $product->sku = ' ';
        }

        if($request->description != '' || $request->description != NULL){
           $product->description = $request->description;    
        }
        else{
            $product->description = ' ';
        }
             
        if($request->carton_qty != '' || $request->carton_qty != NULL){
           $product->carton_qty = $request->carton_qty;    
        }
        else{
            $product->carton_qty = ' ';
        }
        
        if($request->case_qty != '' || $request->case_qty != NULL){
           $product->case_qty = $request->case_qty;   
        }
        else{
            $product->case_qty = ' ';
        }     
        
        if($request->item_qty != '' || $request->item_qty != NULL){
           $product->item_qty = $request->item_qty; 
        }
        else{
            $product->item_qty = ' ';
        } 

        if($request->building != '' || $request->building != NULL){
           $product->building = $request->building; 
        }
        else{
            $product->building = ' ';
        }    
        
        if($request->row_ != '' || $request->row_ != NULL){
           $product->row_ = $request->row_;
        }
        else{
            $product->row_ = ' ';
        }

        if($request->col_ != '' || $request->col_ != NULL){
           $product->col_ = $request->col_;
        }
        else{
            $product->col_ = ' ';
        }
                
        $product->save();

        return redirect('/dashboard')->with('success', 'Success. Details for product ID# ' . $product->id . ' have been updated.');

    }

    public function destroy($id)
    {
        $storage = Storage::find($id);
        $storage->delete();
        return redirect('/dashboard')->with('success', 'Inventory Request Cancelled');
    }


    public function findRate($numPallets){
        $rate=0;

        if(($numPallets >= 0) && ($numPallets <=10)){
            $rate = 15/13.32;
        }
        elseif(($numPallets >= 11) && ($numPallets <=20)){
            $rate = 14/13.32;
        }
        elseif(($numPallets >= 21) && ($numPallets <=30)){
            $rate = 13/13.32;
        }
        elseif(($numPallets >= 31) && ($numPallets <=40)){
            $rate = 12/13.32;
        }
        elseif(($numPallets >= 41) && ($numPallets <=50)){
            $rate = 11/13.32;
        }
        elseif(($numPallets >= 51) && ($numPallets <=60)){
            $rate = 10/13.32;
        }
        elseif(($numPallets >= 61) && ($numPallets <=70)){
            $rate = 9/13.32;
        }
        elseif(($numPallets >= 71) && ($numPallets <=80)){
            $rate = 8/13.32;
        }
        elseif(($numPallets >= 81) && ($numPallets <=90)){
            $rate = 7/13.32;
        }
        elseif(($numPallets >= 91) && ($numPallets <=99)){
            $rate = 6/13.32;
        }
        else{
            $rate = 5/13.31;
        }

        return $rate;

    }

    public function calc(){
        $numPallets = request('num-pallets');
        $length = (request('length')/12);
        $width = (request('width')/12);
        $height = (request('height')/12);
        $weight = request('weight');
        $stackable = request('stackable');
        $duration = request('duration');
        $sqft = $length * $width;
        $sqftTotal = $sqft * $numPallets;
        $ratePerPallet = $this->findRate($numPallets);

        $storageTotal = $sqftTotal * $ratePerPallet;
        if($duration >= 1){
            $storageTotal = bcdiv(($storageTotal * $duration),1,2);
        }
        return response()->json($storageTotal);
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
        //Mail::to('ship@fillstorship.com')->send(new StorRequestMail($emaildata));
        //Mail::to(auth()->user()->email)->send(new CustomerStorRequestMail($emaildata));
        return redirect('/dashboard')->with('success', 'Storage Request Sent');
    }


    public function storeTransOutInventory(){
        $storage = new Storage();

        if(Auth::guest() ){
            $storage->user_id = 0;

        }
        else{
            $storage->user_id = auth()->user()->id;
        }

        $storage->out_carton = 0;
        $storage->pu_no = 0;
        $storage->pro_no = 0;
        $storage->po_no = 0;
        $storage->barcode = 0;
        $storage->sku = 0;
        $storage->description = 0;
        $storage->inb_carton = 0;
        $storage->inb_case = 0;
        $storage->inb_item = 0;
        $storage->inb_tot_qty = 0;
        $storage->out_carton = request('out_carton');
        $storage->out_case = request('out_case');
        $storage->out_item = request('out_item');
        $storage->out_tot_qty = request('out_tot_qty');
        $storage->elim_carton = 0;
        $storage->elim_case = 0;
        $storage->elim_item = 0;
        $storage->elim_tot_qty = 0;
        $storage->building = 'N/A';
        $storage->work_status = 'Pending';
        $storage->row_ = 'N/A';
        $storage->column_ = 'N/A';



        $storage->save();




        //return redirect('/ship')->with('success', 'Shipment Request Sent');
        //dd($palletGo, $charges);

        return redirect('/dashboard')->with('success', 'Storage Request Sent');
    }

}
