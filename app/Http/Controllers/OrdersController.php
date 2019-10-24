<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Cases;
use App\Basic_Unit;
use Illuminate\Support\Facades\Mail;
use App\Mail\StorUpdateMail;
use App\Mail\StorRequestMail;
use App\Mail\StorRemoveMail;
use App\Mail\CustomerStorRequestMail;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Psr7\readline;

class OrdersController extends Controller
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
    
    function insert(Request $request){
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
            $order = new Order();
            $unit = new Basic_Unit();
            $order->name = $request->unit_name;
            $order->user_id = auth()->user()->id;
            $order->company = auth()->user()->company_name;
            $order->order_type = $request->order_type;
            $order->barcode = $request->barcode;
            $order->status = 'Pending';
            $order->description = $request->unit_desc;

            
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

            $order->unit_qty = $total_units;
            $order->tot_qty = $total_units;
            $order->save();

            for($x = 0; $x < count($units); $x++){
                $order->basic_units()->attach(['basic__unit_id' => $units[$x]], ['quantity'=> $unit_qty[$x]]);
            }
            
            Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
            //return response()->json($insert_data);
            return response()->json([
            'success'  => 'Order submitted successfully.'
            ]);
        /*
      Order::insert($insert_data);
      return response()->json([
       'success'  => 'Data Added successfully.'
      ]);
      */
     }
    }

    function store_transout_unit(Request $request){
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
            $order = new Order();
            $unit = new Basic_Unit();
            $order->name = $request->unit_name;
            $order->user_id = auth()->user()->id;
            $order->company = auth()->user()->company_name;
            $order->order_type = $request->order_type;
            $order->barcode = $request->barcode;
            $order->status = 'Pending';
            $order->description = $request->unit_desc;

            
            $units = $request->units;
            $unit_qty = $request->unit_qty;
            $total_units = 0;

            for($y = 0; $y < count($unit_qty); $y++){
                $unit = Basic_Unit::find($units[$y]);
                if($unit_qty[$y] > $unit->loose_item_qty ){
                    return response()->json([
                        'error'  => 'Quantity input greater than quantity at hand. Please provide valid value.'
                    ]);
            }
        }

            for($i = 0; $i < count($units); $i++){
                $total_units += $unit_qty[$i];
                $data = array(
                    'units' => $units[$i],
                    'unit_qty'  => $unit_qty[$i]
                    );
                $insert_data[] = $data;
            }

            $order->unit_qty = $total_units;
            $order->tot_qty = $total_units;
            $order->save();

            for($x = 0; $x < count($units); $x++){
                $order->basic_units()->attach(['basic__unit_id' => $units[$x]], ['quantity'=> $unit_qty[$x]]);
            }
            
            Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
            //return response()->json($insert_data);
            return response()->json([
            'success'  => 'Order submitted successfully.'
            ]);
        /*
      Order::insert($insert_data);
      return response()->json([
       'success'  => 'Data Added successfully.'
      ]);
      */
     }
    }
    
    public function create()
    {
        //
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $kits = $user->kits->sortKeysDesc();
        return view('orders.trans-in-kit')->with('kits', $kits);
    }

    public function create_unit_order(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $units = $user->basic_units->sortKeysDesc();
        return view('orders.trans-in-unit')->with('units', $units);
    }

    public function create_transout_unit(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $units = $user->basic_units->sortKeysDesc();
        return view('orders.trans-out-unit')->with('units', $units);
    }

    public function create_transin_case(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $cases = $user->cases->sortKeysDesc();
        return view('orders.trans-in-case')->with('cases', $cases);
    }

    public function create_transout_case(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $cases = $user->cases->sortKeysDesc();
        return view('orders.trans-out-case')->with('cases', $cases);
    }

    public function create_transout_kit(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $kits = $user->kits->sortKeysDesc();
        return view('orders.trans-out-kit')->with('kits', $kits);
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
        $order = new Order();

        $request->validate([
            'transin_kit_name' => 'required',
            'transin_kit_qty' => 'required',
            'transin_kit_barcode' => 'nullable',
            'transin_kit_desc' => 'nullable',
            'transin_kit_qty' => 'required',
        ]);

        $order->name = $request->transin_kit_name;
        $order->user_id = auth()->user()->id;
        $order->company = auth()->user()->company_name;
        $order->order_type = 'Transfer In Kits';
        $order->barcode = $request->transin_kit_barcode;
        $order->description = $request->transin_kit_desc;
        $order->kit_qty = $request->transin_kit_qty;
        $order->unit_qty = $request->transin_kit_unit_qty;
        $kits_tot = $request->transin_kit_qty;
        $unit_qty = $request->transin_kit_unit_qty;
        $order->tot_qty = (int)$kits_tot * (int)$unit_qty;
        $order->save();
        $order->kits()->sync($request->kits);
        Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
        return redirect('/transinkit')->with('success', 'You have submittted Transfer In Request of ' . $request->transin_kit_name);        
    }

    public function store_transout_kit(Request $request)
    {
        //
        $order = new Order();

        $request->validate([
            'transout_kit_name' => 'required',
            'transout_kit_qty' => 'required',
            'transout_kit_barcode' => 'nullable',
            'transout_kit_desc' => 'nullable',
            
        ]);

        $order->name = $request->transout_kit_name;
        $order->user_id = auth()->user()->id;
        $order->company = auth()->user()->company_name;
        $order->order_type = 'Transfer Out Kits';
        $order->barcode = $request->transout_kit_barcode;
        $order->description = $request->transout_kit_desc;
        $order->kit_qty = $request->transout_kit_qty;
        $order->unit_qty = $request->transout_kit_unit_qty;
        $kits_tot = $request->transout_kit_qty;
        $unit_qty = $request->transout_kit_unit_qty;
        $order->tot_qty = (int)$kits_tot * (int)$unit_qty;
        $order->save();
        $order->kits()->sync($request->kits);
        Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
        return redirect('/transoutkit')->with('success', 'You have submittted Transfer Out Request of ' . $request->transin_kit_name);        
    }

    public function store_transin_case(Request $request){

        if($request->ajax()){
            $rules = array(
            'cases.*'  => 'required',
            'case_qty.*'  => 'required'
            );



            $error = Validator::make($request->all(), $rules);
            if($error->fails()){
            return response()->json([
                'error'  => $error->errors()->all()
            ]);
            }
            $order = new Order();
            //$case = new Cases();
            $order->name = $request->case_name;
            $order->user_id = auth()->user()->id;
            $order->company = auth()->user()->company_name;
            $order->order_type = $request->order_type;
            $order->barcode = $request->barcode;
            $order->status = 'Pending';
            $order->description = $request->desc;

            
            $cases = $request->cases;
            $case_qty = $request->case_qty;
            $total_cases = 0;
            $total_units = 0;

            for($i = 0; $i < count($cases); $i++){
                $total_cases += $case_qty[$i];
                $case = Cases::find($cases[$i]);
                $units = $case->basic_units->all();
                foreach($units as $unit){
                    $total_units += $unit->pivot->quantity * $case_qty[$i];
                }
                
                
                $data = array(
                    'cases' => $cases[$i],
                    'case_qty'  => $case_qty[$i]
                    );
                $insert_data[] = $data;
            }

            $order->unit_qty = $total_units;
            $order->case_qty = $total_cases;
            $order->tot_qty = $total_units;
            $order->save();

            for($x = 0; $x < count($cases); $x++){
                $order->cases()->attach(['case_id' => $cases[$x]], ['quantity'=> $case_qty[$x]]);
            }
            
            Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
            //return response()->json($insert_data);
            return response()->json([
            'success'  => 'Order submitted successfully.'
            ]);       
    }

}


    public function store_transout_case(Request $request){

        if($request->ajax()){
            $rules = array(
            'cases.*'  => 'required',
            'case_qty.*'  => 'required'
            );



            $error = Validator::make($request->all(), $rules);
            if($error->fails()){
            return response()->json([
                'error'  => $error->errors()->all()
            ]);
            }

            $order = new Order();
            //$case = new Cases();
            $order->name = $request->case_name;
            $order->user_id = auth()->user()->id;
            $order->company = auth()->user()->company_name;
            $order->order_type = $request->order_type;
            $order->barcode = $request->barcode;
            $order->status = 'Pending';
            $order->description = $request->desc;

            
            $cases = $request->cases;
            $case_qty = $request->case_qty;
            $total_cases = 0;
            $total_units = 0;

            for($y = 0; $y < count($case_qty); $y++){
                $case = Cases::find($cases[$y]);
                if($case_qty[$y] > $case->case_qty ){
                    return response()->json([
                        'error'  => 'Quantity input greater than quantity at hand. Please provide valid value.'
                    ]);
            }
        }

            for($i = 0; $i < count($cases); $i++){
                $total_cases += $case_qty[$i];
                $case = Cases::find($cases[$i]);
                $units = $case->basic_units->all();
                foreach($units as $unit){
                    $total_units += $unit->pivot->quantity * $case_qty[$i];
                }
                
                
                $data = array(
                    'cases' => $cases[$i],
                    'case_qty'  => $case_qty[$i]
                    );
                $insert_data[] = $data;
            }

            $order->unit_qty = $total_units;
            $order->case_qty = $total_cases;
            $order->tot_qty = $total_units;
            $order->save();

            for($x = 0; $x < count($cases); $x++){
                $order->cases()->attach(['case_id' => $cases[$x]], ['quantity'=> $case_qty[$x]]);
            }
            
            Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
            //return response()->json($insert_data);
            return response()->json([
            'success'  => 'Order submitted successfully.'
            ]);       
    }

}
/*
    public function store_transout_unit(Request $request)
    {
        //
        $order = new Order();

        $request->validate([
            'transout_unit_name' => 'required',
            'transout_unit_qty' => 'required',
            'transout_unit_barcode' => 'nullable',
            'transout_unit_desc' => 'nullable',
            'units' => 'required',
        ]);

        $order->name = $request->transout_unit_name;
        $order->user_id = auth()->user()->id;
        $order->company = auth()->user()->company_name;
        $order->order_type = 'Transfer Out Units';
        $order->barcode = $request->transout_unit_barcode;
        $order->description = $request->transout_unit_desc;
        $order->unit_qty = $request->transout_unit_qty;
        $order->tot_qty = $request->transout_unit_qty;
        $order->save();
        $order->basic_units()->sync($request->units);
        Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
        return redirect('/transoutunit')->with('success', 'You have submittted Transfer Out Request of ' . $request->transin_unit_name);        
    }
    */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_unit_order(Request $request){
        //
        
        /*
        $request->validate([
            'transin_unit_name' => 'required',
            'transin_unit_qty' => 'required',
            'transin_unit_barcode' => 'nullable',
            'transin_unit_desc' => 'nullable',
            'units' => 'required',
        ]);
        */


     if($request->ajax()){
         
        $order = new Order();
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

        $units = $request->units;
        $unit_qty = $request->unit_qty;
        for($count = 0; $count < count($units); $count++){
            $data = array(
                'units' => $units[$count],
                'unit_qty'  => $unit_qty[$count]
            );
            $insert_data[] = $data; 
        }

        $order->name = $request->transin_unit_name;
        $order->user_id = auth()->user()->id;
        $order->company = auth()->user()->company_name;
        $order->order_type = 'Transfer In Units';
        $order->barcode = $request->transin_unit_barcode;
        $order->description = $request->transin_unit_desc;
        $order->unit_qty = $request->transin_unit_qty;
        $order->tot_qty = $request->transin_unit_qty;
        $order->save();
        $order->basic_units()->sync($request->units);
        Mail::to('ship@fillstorship.com')->send(new StorRequestMail($order));
        //return redirect('/transinkit')->with('success', 'You have submittted Transfer In Request of ' . $request->transin_kit_name);  

        return response()->json($insert_data);              
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
        //
        $order = Order::find($id);
        return view('orders.show-order')->with('order', $order);
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
        $order = Order::find($id);
        $user_id = $order->user_id;
        $user = User::find($user_id);
        $kits = $user->kits->sortKeysDesc();
        return view('orders.edit-order-kit')->with('order', $order)->with('kits', $kits);
    }

    public function edit_unit_order($id){
        $order = Order::find($id);
        $user_id = $order->user_id;
        $user = User::find($user_id);
        $units = $user->basic_units->sortKeysDesc();
        return view('orders.edit-order-unit')->with('order', $order)->with('units', $units);  
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
        $order = Order::find($id);

        $request->validate([
            'transin_kit_name' => 'required',
            'transin_kit_qty' => 'required',
            'transin_kit_barcode' => 'nullable',
            'transin_kit_desc' => 'nullable',
            'transin_kit_qty' => 'required',
            'kits' => 'required',
        ]);

        $order->name = $request->transin_kit_name;
        $order->user_id = auth()->user()->id;
        $order->company = auth()->user()->company_name;
        $order->order_type = 'Transfer In Kits';
        $order->barcode = $request->transin_kit_barcode;
        $order->description = $request->transin_kit_desc;
        $order->kit_qty = $request->transin_kit_qty;
        $order->unit_qty = $request->transin_kit_unit_qty;
        $kits_tot = $request->transin_kit_qty;
        $unit_qty = $request->transin_kit_unit_qty;
        $order->tot_qty = (int)$kits_tot * (int)$unit_qty;
        $order->save();
        $order->kits()->sync($request->kits);
        Mail::to('ship@fillstorship.com')->send(new StorUpdateMail($order));
        return redirect('/editorder/kit'. '/' . $id)->with('success', 'You have updated the following order: ' . $request->transin_kit_name); 
    }

    public function update_unit_order(Request $request, $id){
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
            $order = Order::find($id);
            $user = User::find($order->user_id);
            $user_email = $user->email;
            $unit = new Basic_Unit();
            $order->name = $request->unit_name;
            $order->user_id = auth()->user()->id;
            $order->company = auth()->user()->company_name;
            $order->order_type = $request->order_type;
            $order->barcode = $request->barcode;
            //$order->status = 'Pending';
            $order->description = $request->unit_desc;

            
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

            $order->unit_qty = $total_units;
            $order->tot_qty = $total_units;
            $order->save();
            $order->basic_units()->detach();
            for($x = 0; $x < count($units); $x++){
                $order->basic_units()->attach(['basic__unit_id' => $units[$x]], ['quantity'=> $unit_qty[$x]]);
            }
            
            Mail::to($user_email)->send(new StorUpdateMail($order));
            Mail::to('ship@fillstorship.com')->send(new StorUpdateMail($order));
            //return response()->json($insert_data);
            return response()->json([
            'success'  => 'Order submitted successfully.'
            ]);
        /*
      Order::insert($insert_data);
      return response()->json([
       'success'  => 'Data Added successfully.'
      ]);
      */
     }
        
    }

    public function updatestatus(Request $request, $id){
        $order = Order::find($id);
        
        $order->status = $request->status;
        $order->save();
        $useremail = User::find($order->user_id);
        $useremail = $useremail->email;
        if ($order->order_type == 'Transfer In Units' && $order->status == 'Completed'){
                $units = $order->basic_units->all();
                foreach($units as $item){
                    $unit = Basic_Unit::find($item->pivot->basic__unit_id);
                    $unit->loose_item_qty += $item->pivot->quantity;
                    $unit->total_qty += $item->pivot->quantity;
                    $unit->save();
                    //dd($unit);
                }
            $order->basic_units()->detach();
            $order->delete();
        }

        elseif ($order->order_type == 'Transfer Out Units' && $order->status == 'Completed'){
                $units = $order->basic_units->all();
                foreach($units as $item){
                    $unit = Basic_Unit::find($item->pivot->basic__unit_id);
                    $unit->loose_item_qty -= $item->pivot->quantity;
                    $unit->total_qty -=  $item->pivot->quantity;
                    $unit->save();
                    //dd($unit);
                }
            $order->basic_units()->detach();
            $order->delete();
        }

        elseif ($order->order_type == 'Transfer In Cases' && $order->status == 'Completed'){

            $cases = $order->cases->all();
            
            foreach($cases as $case){
                $caseobj = Cases::find($case->pivot->cases_id);
                $caseobj->case_qty += $case->pivot->quantity;
                $caseobj->save();
            

                foreach($case->basic_units->all() as $unit){
                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                    $unitobj->case_qty += $unit->pivot->quantity * $case->pivot->quantity;
                    $unitobj->total_qty += $unit->pivot->quantity* $case->pivot->quantity;
                    $unitobj->save();
                }

            
        }
        $order->cases()->detach();
        $order->delete();
        }

        elseif ($order->order_type == 'Transfer Out Cases' && $order->status == 'Completed'){

            $cases = $order->cases->all();
            
            foreach($cases as $case){
                $caseobj = Cases::find($case->pivot->cases_id);
                $caseobj->case_qty -= $case->pivot->quantity;
                $caseobj->save();
            

                foreach($case->basic_units->all() as $unit){
                    $unitobj = Basic_Unit::find($unit->pivot->basic__unit_id);
                    $unitobj->case_qty -= $unit->pivot->quantity * $case->pivot->quantity;
                    $unitobj->total_qty -= $unit->pivot->quantity* $case->pivot->quantity;
                    $unitobj->save();
                }

            
        }
            $order->cases()->detach();
            $order->delete();
        }
        
        Mail::to($useremail)->send(new StorUpdateMail($order));
        Mail::to('ship@fillstorship.com')->send(new StorUpdateMail($order));
        return redirect('/dashboard#inventoryrequests')->with('success', 'Storage Order has been updated');
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
        $order = Order::find($id);

        $order->cases()->detach();
        $order->basic_units()->detach();
        $order->delete();
        return redirect('/dashboard#inventoryrequests')->with('success', 'Order has been Removed.');
    }
}
