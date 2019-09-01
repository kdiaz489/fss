<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pnlinh\GoogleDistance\Facades\GoogleDistance;
use App\Shipment;
use App\User;
use Auth;
use DB;
use App\Mail\ShipUpdateMail;
use Illuminate\Support\Facades\Mail;

class ShipmentsController extends Controller
{
    protected $weight_disc = array(
        1 => 1,
        2 => 0.9167,
        3 => 0.8334,
        4 => 0.7501,
        5 => 0.6668,
        6 => 0.5835,
        7 => 0.5002,
        8 => 0.4169,
        9 => 0.3336,
        10 => 0.2503,
        11 => 0.167,
        12 => 0.0837
    );

    protected $pallet_disc = array(
        2 => 0.15,
        3 => 0.4,
        4 => 0.7,
        5 => 1.2,
        6 => 1.95,
        7 => 2.23,
        8 => 2.87,
        9 => 3.29,
        10 => 3.92,
        11 => 4.41,
        12 => 5.04
    );

    public function __construct()
    {
        //This snippet of code doesnt let you see the page without login Auth
        $this->middleware('auth', ['except' => ['calcLenth', 'palletGoNoGo', 'create', 'calcMileageCost', 'calcCharges', 'calc', 'store', 'calcLenth']]);
    }

    public function index()
    {
        //DB version
        $shipments = DB::select('SELECT * FROM ship_wk_tbl');
        //Eloquent Version
        //$posts = Post::orderBy('title', 'desc')->get();
        $shipments = Shipment::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.shipments.index')->with('shipments', $shipments);
    }

    public function create(){
        $title = 'Shipping';
        return view('shipments.ship')->with('title', $title);
    }

    public function calcLength($width, $totItems, $length){
        $multiplier;
        $totLength;
        if ($width <= 4.5) {
            if (($totItems >=1) && ($totItems<=2)) {
                $multiplier = 1;
            }
            elseif (($totItems>=3) && ($totItems<=4)) {
                $multiplier = 2;
            }
            elseif (($totItems>=5) && ($totItems<=6)) {
                $multiplier = 3;
            }
            elseif (($totItems>=7) && ($totItems<=8)) {
                $multiplier = 4;
            }
            elseif (($totItems>=9) && ($totItems<=10)) {
                $multiplier = 5;
            }
            elseif (($totItems>=11) && ($totItems<=12)) {
                $multiplier = 6;
            }
            $totLength = $multiplier * $length;
        }
        else{
            $totLength = $totItems * $length;
        }
        return $totLength;
    }

    public function palletGoNoGo($length, $width, $height, $weight, $totItems, $totLength){
        $data = array(
            'max_pal_wt' => 'N/A',
            'max_load' => 'N/A',
            'max_width' => 'N/A',
            'max_length' => 'N/A',
            'max_height' => 'N/A',

        );

        //Calculates Max Pal Wt
        if (($weight/$totItems) > 4000) {
            $data['max_pal_wt'] = 'No Go';
        }
        else{
            $data['max_pal_wt'] = 'Go';
        }

        //Calculates Max Load
        if ($weight > 12000) {
            $data['max_load'] = 'No Go';
        }
        else{
            $data['max_load'] = 'Go';
        }

        //Calculates Max Width

        if ($width > 8) {
            $data['max_width'] = 'No Go';
        }
        else{
            $data['max_width'] = 'Go';
        }

        //Calculates Max Length
        if ($totLength > 26) {
            $data['max_length'] = "No Go";
        }
        else{
            $data['max_length'] = "Go";
        }

        //Calculates Max Height
        if ($height > 8) {
            $data['max_height'] = "No Go";
        }
        else{
            $data['max_height'] = "Go";
        }
        return $data;
    }


    public function calcMileageCost($mileage){
        $mileageCost =0;
        if ($mileage <= 50) {
            $mileageCost = 0;
        }
        elseif (($mileage >= 51) && ($mileage <= 60)){
            $mileageCost = 5;
        }
        elseif (($mileage >= 61) && ($mileage <= 70)){
            $mileageCost = 10;
        }
        elseif (($mileage >= 71) && ($mileage <= 80)){
            $mileageCost = 15;
        }
        elseif (($mileage >= 81) && ($mileage <= 90)){
            $mileageCost = 20;
        }
        elseif (($mileage >= 91) && ($mileage <= 100)){
            $mileageCost = 25;
        }
        elseif (($mileage >= 101) && ($mileage <= 110)){
            $mileageCost = 30;
        }
        elseif (($mileage >= 111) && ($mileage <= 120)){
            $mileageCost = 35;
        }
        elseif (($mileage >= 121) && ($mileage <= 130)){
            $mileageCost = 40;
        }
        elseif (($mileage >= 131) && ($mileage <= 140)){
            $mileageCost = 45;
        }
        elseif (($mileage >= 141) && ($mileage <= 150)){
            $mileageCost = 50;
        }
        elseif (($mileage >= 151) && ($mileage <= 160)){
            $mileageCost = 55;
        }
        return $mileageCost;
    }



    public function calcCharges($totWeight, $pal_area, $totItems, $orig_address, $dest_address){
        $data = array(
            'ext_wght' => '0',
            'sm_pall_chg' => ' 0',
            'mult_sm_pal_cost' => '0',
            'sing_pal_cost' => '0',
            'mult_pal_cost' => '0',
            'wt_chg' => '0',
            'pall_disc' => '0',
            'pall_disc_cst' => '0',
            'tot_load_cost' => '0',
            'orig_address' => $orig_address,
            'dest_address' => $dest_address,
            'mileage' => '0',
            'mileage_cost_total' => '0',

        );
        //Calculates Extra Weight Charge
        if(($totWeight/$totItems) > 1000){
            $data['ext_wght'] = round(($totWeight - ($totItems*1000)),2);

        }
        else{
            $data['ext_wght'] = 0;
        }

        //Calculates Single Pallet Cost
        if($pal_area <=16){
            $data['sing_pal_cost'] = 68.33;
        }
        else{
            $data['sing_pal_cost'] = round(($pal_area * 4.27),2);
        }

        //Calculates Small Pallet Charge
        if ($pal_area < (0.5*16)) {
            $data['sm_pall_chg'] = round((0.5 * $data['sing_pal_cost']),2);
        }
        else{
            $data['sm_pall_chg'] = 0;
        }


        //Calculates Multiple Small Pallet Cost
        if($pal_area <= (0.5 * 16)){
            $data['mult_sm_pal_cost'] = round(($data['sm_pall_chg'] * $totItems),2);
        }
        else{
            $data['mult_sm_pal_cost'] = 0;
        }

        // Calculates Multiple Pallet Cost
        $data['mult_pal_cost'] = round(($totItems * $data['sing_pal_cost']),2);

        //Calculates extra weight charge
        if (array_key_exists($totItems, $this->weight_disc)) {
            $wt_chg_disc = $this->weight_disc[$totItems];
            $data['wt_chg'] = round(($wt_chg_disc * 4 * ($data['ext_wght']/100)),2);
        }
        else if($totItems > 12){
            $wt_chg_disc = 0.0837;
            $data['wt_chg'] = round(($wt_chg_disc * 4 * ($data['ext_wght']/100)),2);
        }

        //Calculates Pallet Discount, if applies, else, returns 0 as pallet discount
        if($totItems == 1){
            $data['pall_disc'] = 0;
        }
        else{
            if (array_key_exists($totItems, $this->pallet_disc)) {
                $data['pall_disc'] = $this->pallet_disc[$totItems];

            }
            elseif($totItems > 12){
                $data['pall_disc'] = 5.04;
            }
        }


        //Calculates Total Pallet Discount Cost, if applies, else, returns 0 as pallet discount
        if($totItems == 1){
            $data['pall_disc_cst'] = 0;
        }
        else{
            $data['pall_disc_cst'] = round(($data['sing_pal_cost'] * $data['pall_disc']),2);
        }


        $distanceMeters = GoogleDistance::calculate($orig_address, $dest_address);
        $distanceMiles = ceil($distanceMeters/1609.344);
        $data['mileage'] = $distanceMiles;

        $mileageCost = $this->calcMileageCost($distanceMiles);
        $data['tot_load_cost'] = $data['tot_load_cost'] + $mileageCost;
        $data['mileage_cost_total'] = $mileageCost;

        //Calculates Total Load Cost
        if($pal_area <= (0.5*16)){
            $data['tot_load_cost'] = round((($data['wt_chg'] + $data['mileage_cost_total'] + $data['sm_pall_chg']) - $data['pall_disc_cst']),2);

        }
        else{
            $data['tot_load_cost'] = round((($data['wt_chg'] + $data['mileage_cost_total'] + $data['mult_pal_cost']) - $data['pall_disc_cst']),2);

        }



        // Returns Data
        return $data;



    }



    public function calc(){

        // Load Info
        $totItems = request('no_of_pallets');
        $width = request('pallet_width')/12;
        $length = request('pallet_length')/12;
        $totLoadWeight = request('tot_load_wt');
        $height = request('pallet_height')/12;
        $totLength = $this->calcLength($width, $totItems, $length);
        $palArea = $width * $length;
        $totArea = $totItems * $palArea;
        $orig_address_01= request('orig_address_01') . ' ';
        $orig_address_02 = request('orig_address_02') .  ' ';
        if($orig_address_02 == ' '){
            $orig_address_02 = '';
        }
        $orig_address_city = request('orig_city') .  ' ';
        $orig_address_state =  request('orig_state') .  ' ';
        $orig_address_zip = request('orig_zip');
        $orig_address = $orig_address_01 . $orig_address_02 . $orig_address_city . $orig_address_state . $orig_address_zip;
        $dest_address_01= request('dest_address_01') . ' ';
        $dest_address_02 = request('dest_address_02') .  ' ';
        if($dest_address_02 == ' '){
            $dest_address_02 = '';
        }
        $dest_address_city = request('dest_city') .  ' ';
        $dest_address_state =  request('dest_state') .  ' ';
        $dest_address_zip = request('dest_zip');
        $dest_address = $dest_address_01 . $dest_address_02 . $dest_address_city . $dest_address_state . $dest_address_zip;


        //Pallet Go No Go
        //Prameters needed are $length, $width, $height, $tot_load_weight, $totItems, $totLength
        //Determines Go or No Go on  max_pal_wt, max_load, max_width, max_length, max_height

        $palletGo = $this->palletGoNoGo($length, $width, $height, $totLoadWeight, $totItems, $totLength);


        //Charges
        //Parameters needed are $totWeight, $pal_area, $totItems
        //Calculates charges for ext_wght, sm_pall_chg, mult_sm_pal_cost, sing_pal_cost, mult_pal_cost, wt_chg, pall_disc, pall_disc_cst,tot_load_cost
        $charges = $this->calcCharges($totLoadWeight, $palArea, $totItems, $orig_address, $dest_address);

        $destInside = request('dest_inside');
        $destLftgt = request('dest_lfgt');
        $origFlrstck = request('orig_flrstk');
        $origInside = request('orig_inside');
        $loadStrap = request('load_strap');
        $loadBlck = request('load_blck');


        if ($destInside == 'Yes') {
            $charges['tot_load_cost'] = $charges['tot_load_cost'] + 30;
        }

        if ( $destLftgt == 'Yes') {
            $charges['tot_load_cost'] = $charges['tot_load_cost'] + 30;
        }

        if ($origFlrstck  == 'Yes') {
            $charges['tot_load_cost'] = $charges['tot_load_cost'] + 60;
        }

        if($origInside == 'Yes'){
            $charges['tot_load_cost'] = $charges['tot_load_cost'] + 20;
        }

        if( $loadStrap == 'Yes'){
            $charges['tot_load_cost'] = $charges['tot_load_cost'] + 10;
        }

        if( $loadBlck  == 'Yes'){
            $charges['tot_load_cost'] = $charges['tot_load_cost'] + 10;
        }

        //return redirect('/ship')->with('success', 'Shipment Request Sent');
        //dd($palletGo, $charges);
        $charges['tot_load_cost'] = round($charges['tot_load_cost'], 2);
        return response()->json($charges);
    }

    public function show($id)
    {

        $shipment = Shipment::find($id);
        return view('shipments.show')->with('shipment', $shipment);
    }

    public function destroy($id)
    {
        $shipment = Shipment::find($id);
        $shipment->delete();
        return redirect('/dashboard')->with('success', 'Shipment Request Cancelled');
    }

    public function edit($id){

        return view('admin.shipments.edit')->with(['shipment'=>Shipment::find($id)]);

    }


    public function update(Request $request, $id){

        $shipment = Shipment::find($id);
        $shipment->work_status = $request->status_1;
        $shipment->save();
        $useremail = User::find($shipment->user_id);
        $useremail = $useremail->email;
        //dd($shipment->work_status);
        //dd($useremail);
        Mail::to($useremail)->send(new ShipUpdateMail($shipment));
        Mail::to('ship@fillstorship.com')->send(new ShipUpdateMail($shipment));
        return redirect('/dashboard')->with('success', 'Shipment has been updated');
    }

    public function store(){
        $shipment = new Shipment();

        if(Auth::guest() ){
            $shipment->user_id = 0;

        }
        else{
            $shipment->user_id = auth()->user()->id;
        }

        if(request('orig_address_02') == ''){
            $origAddress02 = 'N/A';
        }
        else{
            $origAddress02 = request('orig_address_02');
        }

        if(request('dest_address_02') == ''){
            $destAddress02 = 'N/A';
        }
        else{
            $destAddress02 = request('dest_address_02');
        }

        $shipment->pro_no = 0;
        $shipment->pu_no = 0;
        $shipment->po_no = 0;
        $shipment->barcode = 0;
        $shipment->carrier = 0;
        $shipment->work_status = 'In Progress';
        $shipment->orig_company =request('orig_company');
        $shipment->orig_address_01 =request('orig_address_01');
        $shipment->orig_address_02 = $origAddress02;
        $shipment->orig_city =request('orig_city');
        $shipment->orig_zip =request('orig_zip');
        $shipment->orig_state =request('orig_state');
        $shipment->orig_cont_name =request('orig_cont_name');
        $shipment->orig_cont_phone =request('orig_cont_phone');
        $shipment->orig_cont_email =request('orig_cont_email');
        $shipment->orig_pickup_date =request('orig_pickup_date');
        $shipment->orig_type =request('orig_type');
        $shipment->orig_dock =request('orig_dock');
        $shipment->orig_frklft =request('orig_frklft');
        $shipment->orig_flrstk =request('orig_flrstk');
        $shipment->orig_inside =request('orig_inside');
        $shipment->orig_lfgt =request('orig_lfgt');
        $shipment->orig_notes =request('orig_notes');
        $shipment->dest_company =request('dest_company');
        $shipment->dest_address_01 =request('dest_address_01');
        $shipment->dest_address_02 = $destAddress02;
        $shipment->dest_city =request('dest_city');
        $shipment->dest_zip =request('dest_zip');
        $shipment->dest_state =request('dest_state');
        $shipment->dest_cont_name =request('dest_cont_name');
        $shipment->dest_cont_phone=request('dest_cont_phone');
        $shipment->dest_cont_email =request('dest_cont_email');
        $shipment->dest_pickup_date =request('dest_pickup_date');
        $shipment->dest_type =request('dest_type');
        $shipment->dest_frklft =request('dest_frklft');
        $shipment->dest_dock =request('dest_dock');
        $shipment->dest_inside=request('dest_inside');
        $shipment->dest_lfgt=request('dest_lfgt');
        $shipment->dest_app_req =request('dest_app_req');
        $shipment->dest_notes =request('dest_notes');
        $shipment->prod_type =request('prod_type');
        $shipment->prod_desc =request('prod_desc');
        $shipment->prod_value =request('prod_value');
        $shipment->prod_hazard =request('prod_hazard');
        $shipment->prod_stackable =request('prod_stackable');
        $shipment->no_of_pallets =request('no_of_pallets');
        $shipment->weight_per_pallet =request('weight_per_pallet');
        $shipment->tot_load_wt =request('tot_load_wt');
        $shipment->pallet_width =request('pallet_width');
        $shipment->pallet_length =request('pallet_length');
        $shipment->pallet_height =request('pallet_height');
        $shipment->freight_class =request('freight_class');
        $shipment->load_strap =request('load_strap');
        $shipment->load_blck=request('load_blck');


        $totItems = request('no_of_pallets');
        $width = request('pallet_width')/12;
        $length = request('pallet_length')/12;
        $totLoadWeight = request('tot_load_wt');
        $height = request('pallet_height')/12;
        $totLength = $this->calcLength($width, $totItems, $length);
        $palArea = $width * $length;
        $totArea = $totItems * $palArea;
        $orig_address_01= request('orig_address_01') . ' ';
        $orig_address_02 = request('orig_address_02') .  ' ';
        if($orig_address_02 == ' '){
            $orig_address_02 = '';
        }
        $orig_address_city = request('orig_city') .  ' ';
        $orig_address_state =  request('orig_state') .  ' ';
        $orig_address_zip = request('orig_zip');
        $orig_address = $orig_address_01 . $orig_address_02 . $orig_address_city . $orig_address_state . $orig_address_zip;
        $dest_address_01= request('dest_address_01') . ' ';
        $dest_address_02 = request('dest_address_02') .  ' ';
        if($dest_address_02 == ' '){
            $dest_address_02 = '';
        }
        $dest_address_city = request('dest_city') .  ' ';
        $dest_address_state =  request('dest_state') .  ' ';
        $dest_address_zip = request('dest_zip');
        $dest_address = $dest_address_01 . $dest_address_02 . $dest_address_city . $dest_address_state . $dest_address_zip;


        //Pallet Go No Go
        //Prameters needed are $length, $width, $height, $tot_load_weight, $totItems, $totLength
        //Determines Go or No Go on  max_pal_wt, max_load, max_width, max_length, max_height

        $palletGo = $this->palletGoNoGo($length, $width, $height, $totLoadWeight, $totItems, $totLength);


        //Charges
        //Parameters needed are $totWeight, $pal_area, $totItems
        //Calculates charges for ext_wght, sm_pall_chg, mult_sm_pal_cost, sing_pal_cost, mult_pal_cost, wt_chg, pall_disc, pall_disc_cst,tot_load_cost
        $charges = $this->calcCharges($totLoadWeight, $palArea, $totItems, $orig_address, $dest_address);

        $destInside = request('dest_inside');
        $destLftgt = request('dest_lfgt');
        $origFlrstck = request('orig_flrstk');
        $origInside = request('orig_inside');
        $loadStrap = request('load_strap');
        $loadBlck = request('load_blck');


        if ($destInside == 'Yes') {
            $charges['tot_load_cost'] = $charges['tot_load_cost'] + 30;
        }

        if ( $destLftgt == 'Yes') {
            $charges['tot_load_cost'] = $charges['tot_load_cost'] + 30;
        }

        if ($origFlrstck  == 'Yes') {
            $charges['tot_load_cost'] = $charges['tot_load_cost'] + 60;
        }

        if($origInside == 'Yes'){
            $charges['tot_load_cost'] = $charges['tot_load_cost'] + 20;
        }

        if( $loadStrap == 'Yes'){
            $charges['tot_load_cost'] = $charges['tot_load_cost'] + 10;
        }

        if( $loadBlck  == 'Yes'){
            $charges['tot_load_cost'] = $charges['tot_load_cost'] + 10;
        }

        //return redirect('/ship')->with('success', 'Shipment Request Sent');
        //dd($palletGo, $charges);
        $charges['tot_load_cost'] = round($charges['tot_load_cost'], 2);


        $shipment->pal_area = $palArea;
        $shipment->tot_area = $totArea;
        $shipment->max_pal_wt = $palletGo['max_pal_wt'];
        $shipment->max_load = $palletGo['max_load'];
        $shipment->max_width = $palletGo['max_width'];
        $shipment->max_length = $palletGo['max_length'];
        $shipment->max_height = $palletGo['max_height'];
        $shipment->ext_wght = $charges['ext_wght'];
        $shipment->sm_pall_chg = $charges['sm_pall_chg'];
        $shipment->mult_sm_pal_cost = $charges['mult_sm_pal_cost'];
        $shipment->sing_pal_cost = $charges['sing_pal_cost'];
        $shipment->mult_pal_cost = $charges['mult_pal_cost'];
        $shipment->wt_chg = $charges['wt_chg'];
        $shipment->pall_disc = $charges['pall_disc'];
        $shipment->pall_disc_cst = $charges['pall_disc_cst'];
        $shipment->tot_load_cost = $charges['tot_load_cost'];
        $shipment->save();



        
        //return redirect('/ship')->with('success', 'Shipment Request Sent');
        //dd($palletGo, $charges);

        return response()->json($charges);
    }


}
