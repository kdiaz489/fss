<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StorageWork;
use App\Storage;
use App\StorageHistory;
use Auth;
use DB;
use App\User;
use App\Mail\StorUpdateMail;
use App\Mail\StorRequestMail;
use App\Mail\StorRemoveMail;
use App\Mail\CustomerStorRequestMail;
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
        //locates line item in database for stor_tbl and stor_wk_tbl
        //$storage = Storage::where('stor_work_id', '=', $id)->first();
        $storagework = StorageWork::find($id);
        $storage = new Storage();
        $storagehistory = new StorageHistory();

        //finds email address of user
        $user = User::find($storagework->user_id);
        $useremail = $user->email;

        //stores updated work status into each line item's work_status column
        //$storage->work_status = $request->status_1;
        $storagework->work_status = $request->status_1;


        if($request->status_1 == 'Complete' && $storagework->work_type == 'Transfer In'){
        
            
            $storagehistory->user_id = $storagework->user_id;
            $storagehistory->work_type = $storagework->work_type;
            $storagehistory->company = $storagework->company;
            $storagehistory->pro_no = $storagework->pro_no;
            $storagehistory->pu_no = $storagework->pu_no;
            $storagehistory->po_no = $storagework->po_no;
            $storagehistory->barcode = $storagework->barcode;
            $storagehistory->sku = $storagework->pro_no;
            $storagehistory->description = $storagework->description;
            $storagehistory->inb_carton = $storagework->inb_carton;;
            $storagehistory->inb_case = $storagework->inb_case;
            $storagehistory->inb_item = $storagework->inb_item;
            $storagehistory->inb_tot_qty = $storagework->inb_tot_qty;
            $storagehistory->out_carton = $storagework->out_carton;
            $storagehistory->out_case = $storagework->out_case;
            $storagehistory->out_item = $storagework->out_item;
            $storagehistory->out_tot_qty = $storagework->out_tot_qty;
            $storagehistory->elim_carton = $storagework->elim_carton;
            $storagehistory->elim_case = $storagework->elim_case;
            $storagehistory->elim_item = $storagework->elim_item;
            $storagehistory->elim_tot_qty = $storagework->elim_tot_qty;
            $storagehistory->building = $storagework->building;
            $storagehistory->row_ = $storagework->row_;
            $storagehistory->column_ = $storagework->column_;
            $storagehistory->work_status = $storagework->work_status;
                
            //saves changes
            $storagehistory->save();
            

            $storage->user_id = $storagework->user_id;
            $storage->company = $storagework->company;
            $storage->pro_no = $storagework->pro_no;
            $storage->pu_no = $storagework->pu_no;
            $storage->po_no = $storagework->po_no;
            $storage->barcode = $storagework->barcode;
            $storage->sku = $storagework->sku;
            $storage->description = $storagework->description;
            $storage->carton_qty = $storagework->inb_carton;
            $storage->case_qty = $storagework->inb_case;
            $storage->item_qty = $storagework->inb_item;
            $storage->building = $storagework->building;
            $storage->row_ = $storagework->row_;
            $storage->col_ = $storagework->column_;
            $storage->work_status = $request->status_1;
            $storage->stor_work_id = $id;
            
            //saves changes
            $storage->save();

            $this->destroy($storagework->id);
            return redirect('/dashboard#inventoryrequests')->with('success', 'Inventory has been added.');
        }

        elseif($request->status_1 == 'Complete' && $storagework->work_type == 'Transfer Out'){
    
            
            $storagehistory->user_id = $storagework->user_id;
            $storagehistory->work_type = $storagework->work_type;
            $storagehistory->company = $storagework->company;
            $storagehistory->pro_no = $storagework->pro_no;
            $storagehistory->pu_no = $storagework->pu_no;
            $storagehistory->po_no = $storagework->po_no;
            $storagehistory->barcode = $storagework->barcode;
            $storagehistory->sku = $storagework->pro_no;
            $storagehistory->description = $storagework->description;
            $storagehistory->inb_carton = $storagework->inb_carton;;
            $storagehistory->inb_case = $storagework->inb_case;
            $storagehistory->inb_item = $storagework->inb_item;
            $storagehistory->inb_tot_qty = $storagework->inb_tot_qty;
            $storagehistory->out_carton = $storagework->out_carton;
            $storagehistory->out_case = $storagework->out_case;
            $storagehistory->out_item = $storagework->out_item;
            $storagehistory->out_tot_qty = $storagework->out_tot_qty;
            $storagehistory->elim_carton = $storagework->elim_carton;
            $storagehistory->elim_case = $storagework->elim_case;
            $storagehistory->elim_item = $storagework->elim_item;
            $storagehistory->elim_tot_qty = $storagework->elim_tot_qty;
            $storagehistory->building = $storagework->building;
            $storagehistory->row_ = $storagework->row_;
            $storagehistory->column_ = $storagework->column_;
            $storagehistory->work_status = $storagework->work_status;
                
            //save stor_wk_tbl line item to stor_wk_history
            $storagehistory->save();

            //removes line item from stor_wk_tbl
            $this->destroy($storagework->id);
            return redirect('/dashboard#inventoryrequests')->with('success', 'Inventory has been updated');
        }
        else{
       
        //saves update to storage work table if conditions above were not met
        $storagework->save();
        
        //sends work status update email both to the user and to fillstorship
        Mail::to('ship@fillstorship.com')->send(new StorUpdateMail($storagework));
        Mail::to($useremail)->send(new StorUpdateMail($storagework));

        //redirects back to dashboard
        return redirect('/dashboard#inventoryrequests')->with('success', 'Inventory has been updated');
        }
    }

    public function removeinventory(Request $request, $id){

        //finds line item with the corresponding id
        $storage = Storage::find($id);
        $storage->work_status = 'Remove From Inventory';
        $storage->save();

        Mail::to('ship@fillstorship.com')->send(new StorRemoveMail($storage));
        return redirect('/dashboard#inventoryrequests')->with('success', 'Inventory Removal has been requested. We will get back to you shortly.');
    }

    public function cancelinventoryitem(Request $request, $id){

        //finds line item with the corresponding id
        $storage = Storage::find($id);

        
        $storage->work_status = 'Cancelled';
        $storage->save();

        //Mail::to('ship@fillstorship.com')->send(new StorUpdateMail($storage));
        return redirect('/dashboard#inventoryrequests')->with('success', 'Storage request has been cancelled');
    }


    public function destroy($id)
    {
        $storagework = StorageWork::find($id);
        $data = $storagework;
        $data->work_status = 'Deleted';
        $storagework->delete();

        //$storage = Storage::where('stor_work_id', $id);
        //$storage->delete();

        //Mail::to('ship@fillstorship.com')->send(new StorUpdateMail($data));
        return redirect('/dashboard#inventoryrequests')->with('success', 'Inventory Request Completed');
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
            $rate = 5/13.32;
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
        //dd($ratePerPallet);

        $storageTotal = $sqftTotal * $ratePerPallet;
        if($duration > 1){
            $storageTotal = round(($storageTotal * $duration),2);
        }
        return response()->json($storageTotal);
    }


    public function store(){
        $storagework = new StorageWork();
        //$storage = new Storage();

        if(Auth::guest() ){
            $storagework->user_id = 0;
           

            $storagework->company = 'Guest';
            
        }
        else{
            $storagework->user_id = auth()->user()->id;
           

            $storagework->company = auth()->user()->company_name;
            
        }
        $storagework->work_type='Transfer In';
        $storagework->pro_no = ' ';
        $storagework->pu_no = ' ';
        $storagework->po_no = request('po_no');
        $storagework->barcode = ' ';
        $storagework->sku = request('sku');
        $storagework->description = request('description');
        $storagework->inb_carton = request('inb_carton');
        $storagework->inb_case = request('inb_case');
        $storagework->inb_item = request('inb_item');
        $storagework->inb_tot_qty = request('inb_tot_qty');
        $storagework->out_carton = ' ';
        $storagework->out_case = ' ';
        $storagework->out_item = ' ';
        $storagework->out_tot_qty = ' ';
        $storagework->elim_carton = ' ';
        $storagework->elim_case = ' ';
        $storagework->elim_item = ' ';
        $storagework->elim_tot_qty = ' ';
        $storagework->building = ' ';
        $storagework->row_ = ' ';
        $storagework->column_ = ' ';
        $storagework->work_status = 'Pending';
        $storagework->save();

        /*
        $storage->pro_no = ' ';
        $storage->pu_no = ' ';
        $storage->po_no = request('po_no');
        $storage->barcode = ' ';
        $storage->sku = request('sku');
        $storage->description = request('description');
        $storage->carton_qty = request('inb_carton');
        $storage->case_qty = request('inb_case');
        $storage->item_qty = request('inb_item');
        $storage->building = ' ';
        $storage->row_ = ' ';
        $storage->col_ = ' ';
        $storage->work_status = 'Pending';
        $storage->stor_work_id = $storage->id;
        $storage->save();
        */
        Mail::to(auth()->user()->email)->send(new CustomerStorRequestMail($storagework));
        Mail::to('ship@fillstorship.com')->send(new StorRequestMail($storagework));
        return redirect('/dashboard#inventoryrequests')->with('success', 'Storage Request Sent');
    }


    public function storeTransOutInventory(){
        $storagework = new StorageWork();
        $inventory = new Storage();
        if(Auth::guest() ){
            $storagework->user_id = 0;

        }
        else{
            $storagework->user_id = auth()->user()->id;
        }
        $storagework->company = auth()->user()->company_name;
        $storagework->work_type = 'Transfer Out';
        $storagework->out_carton = 'N/A';
        $storagework->pro_no = 'N/A';
        $storagework->pu_no = 'N/A';
        $storagework->po_no = 'N/A';
        $storagework->barcode = 'N/A';
        $storagework->sku = 'N/A';
        $storagework->description = 'N/A';
        $storagework->inb_carton = 'N/A';
        $storagework->inb_case = 'N/A';
        $storagework->inb_item = 'N/A';
        $storagework->inb_tot_qty = 'N/A';
        $storagework->out_carton = request('out_carton');
        $storagework->out_case = request('out_case');
        $storagework->out_item = request('out_item');
        $storagework->out_tot_qty = request('out_tot_qty');
        $storagework->elim_carton = 'N/A';
        $storagework->elim_case = 'N/A';
        $storagework->elim_item = 'N/A';
        $storagework->elim_tot_qty = 'N/A';
        $storagework->building = 'N/A';
        $storagework->work_status = 'Pending';
        $storagework->row_ = 'N/A';
        $storagework->column_ = 'N/A';
        $storagework->save();



        Mail::to(auth()->user()->email)->send(new CustomerStorRequestMail($storagework));
        Mail::to('ship@fillstorship.com')->send(new StorRequestMail($storagework));
        return redirect('/dashboard#inventoryrequests')->with('success', 'Storage Request Sent');
    }

}
