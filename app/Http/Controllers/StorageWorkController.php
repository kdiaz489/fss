<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StorageWork;
use App\Storage;
use Auth;
use DB;
use App\User;
use App\Mail\StorUpdateMail;
use App\Mail\StorRequestMail;
use Illuminate\Support\Facades\Mail;

class StorageWorkController extends Controller
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
        $storage = StorageWork::find($id);
        return view('storage.show')->with('storage', $storage);
    }

    public function index()
    {
        //DB version
        $storage = DB::select('SELECT * FROM stor_wk_tbl');
        //Eloquent Version
        //$posts = Post::orderBy('title', 'desc')->get();
        $storage = StorageWork::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.storage.index')->with('storage', $storage);
    }

    
    public function edit($id){

        return view('admin.storage.edit')->with(['storage'=>StorageWork::find($id)]);

    }


    public function update(Request $request, $id){
        $storage = Storage::where('stor_work_id', '=', $id)->first();
        $storagework = StorageWork::find($id);
        $useremail = User::find($storagework->user_id);
        $useremail = $useremail->email;
        $storage->work_status = $request->status_1;
        $storagework->work_status = $request->status_1;
        $storage->save();
        $storagework->save();
        //dd($shipment->work_status);
        Mail::to('ship@fillstorship.com')->send(new StorUpdateMail($storagework));
        Mail::to($useremail)->send(new StorUpdateMail($storagework));
        //dd($useremail);
        return redirect('/dashboard#inventoryrequests')->with('success', 'Storage has been updated');
    }

    public function cancelrequest(Request $request, $id){
        $storagework = StorageWork::find($id);
        $storagework->work_status = 'Cancelled';
        $storagework->save();

        Mail::to('ship@fillstorship.com')->send(new StorUpdateMail($storagework));
        return redirect('/dashboard#inventoryrequests')->with('success', 'Storage request has been cancelled');
    }

    public function destroy($id)
    {
        $storagework = StorageWork::find($id);
        $storagework->delete();

        $storage = Storage::where('stor_work_id', $id);
        $storage->delete();
        return redirect('/dashboard#inventoryrequests')->with('success', 'Inventory Request Cancelled');
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
        if($duration > 1){
            $storageTotal = round(($storageTotal * $duration),2);
        }
        return response()->json($storageTotal);
    }


    public function store(){
        $storage = new StorageWork();
        $storageuser = new Storage();

        if(Auth::guest() ){
            $storage->user_id = 0;
            $storageuser->user_id = 0;

        }
        else{
            $storage->user_id = auth()->user()->id;
            $storageuser->user_id = auth()->user()->id;
        }

        $storage->pro_no = 0;
        $storage->pu_no = 0;
        $storage->po_no = request('po_no');
        $storage->barcode = 0;
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
        $storage->work_status = 'Pending';
        $storage->save();

        
        $storageuser->pro_no = 0;
        $storageuser->pu_no = 0;
        $storageuser->po_no = request('po_no');
        $storageuser->barcode = 0;
        $storageuser->sku = request('sku');
        $storageuser->description = request('description');
        $storageuser->carton_qty = 0;
        $storageuser->case_qty = 0;
        $storageuser->item_qty = 0;
        $storageuser->building = 0;
        $storageuser->row_ = 0;
        $storageuser->col_ = 0;
        $storageuser->work_status = 'Pending';
        $storageuser->stor_work_id = $storage->id;
        
        $storageuser->save();

        Mail::to('ship@fillstorship.com')->send(new StorRequestMail($storage));
        return redirect('/dashboard#inventoryrequests')->with('success', 'Storage Request Sent');
    }


    public function storeTransOutInventory(){
        $storage = new StorageWork();
        
        if(Auth::guest() ){
            $storage->user_id = 0;

        }
        else{
            $storage->user_id = auth()->user()->id;
        }

        $storage->out_carton = 0;
        $storage->pro_no = 0;
        $storage->pu_no = 0;
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

        Mail::to('ship@fillstorship.com')->send(new StorRequestMail($storage));
        return redirect('/dashboard#inventoryrequests')->with('success', 'Storage Request Sent');
    }

}
