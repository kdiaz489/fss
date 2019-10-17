<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\StorUpdateMail;
use App\Mail\StorRequestMail;
use App\Mail\StorRemoveMail;
use App\Mail\CustomerStorRequestMail;

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
            'transout_kit_qty' => 'required',
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_unit_order(Request $request)
    {
        //
        $order = new Order();

        $request->validate([
            'transin_unit_name' => 'required',
            'transin_unit_qty' => 'required',
            'transin_unit_barcode' => 'nullable',
            'transin_unit_desc' => 'nullable',
            'units' => 'required',
        ]);

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
        return redirect('/transinunit')->with('success', 'You have submittted Transfer In Request of ' . $request->transin_unit_name);        
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
        $order = Order::find($id);
        $request->validate([
            'transin_unit_name' => 'required',
            'transin_unit_qty' => 'required',
            'transin_unit_barcode' => 'nullable',
            'transin_unit_desc' => 'nullable',
            
        ]);

        $order->name = $request->transin_unit_name;
        $order->barcode = $request->transin_unit_barcode;
        $order->description = $request->transin_unit_desc;
        $order->unit_qty = $request->transin_unit_qty;
        $order->tot_qty = $request->transin_unit_qty;
        $order->save();
        $order->basic_units()->sync($request->units);
        Mail::to('ship@fillstorship.com')->send(new StorUpdateMail($order));
        return redirect('/editorder/unit'. '/' . $id)->with('success', 'You have updated the following order:  ' . $order->name); 
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


        $order->delete();
        return redirect('/dashboard#inventoryrequests')->with('success', 'Order has been Removed.');
    }
}
