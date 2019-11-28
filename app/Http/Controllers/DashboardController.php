<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use App\StorageWork;
use App\Shipment;
use App\Storage;
use App\Basic_Unit;
use App\Kit;
use App\Cases;
use App\Carton;
use App\Pallet;
use App\Order;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $shipments = $user->shipments->where('work_status', '!=', 'Completed')->sortByDesc('created_at');
        $shipmentshistory = $user->shipmentshistory->sortByDesc('created_at');

        if($user->hasAnyRole('user')){
            return view('userdash.dash-shipments')->with('shipments', $shipments)->with('shipmentshistory', $shipmentshistory);
        }
        elseif($user->hasAnyRole('admin')){
            
            //DB version
            $shipments = DB::select('SELECT * FROM ship_wk_tbl');
            $shipments = Shipment::orderBy('created_at', 'desc')->get();
            
            return view('admindash.dash-all-ship')->with('shipments', $shipments);
        }
    }


    public function updateusername(Request $request){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $user->user_name = $request->username;
        $user->save();
        return redirect()->back()->with('success', 'Updated User Name');
    }

    public function updateemail(Request $request){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->with('success', 'Updated Username');
    }

    public function updatecompanyname(Request $request){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $user->company_name = request('company-name');
        $user->save();
        return redirect()->back()->with('success', 'Updated Company Name');
    }

    public function updatecontactname(Request $request){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $user->name = request('contact-name');
        $user->save();
        return redirect()->back()->with('success', 'Updated Contact Name');
    }

    public function updateaddress(Request $request){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $user->street_address = request('street-address');
        $user->city = request('city');
        $user->state = request('state');
        $user->zip = request('zip');
        $user->save();
        return redirect()->back()->with('success', 'Updated Company Address');
    }

    public function getadduser(){

        return view('dashboard.adduser');
    }
    public function getupdateusername(){

        return view('dashboard.editusername');
    }

    public function getupdateemail(){

        return view('dashboard.editemail');
    }

    public function getupdatepass(){

        return view('dashboard.editpass');
    }

    public function getupdatecompanyname(){

        return view('dashboard.editcompanyname');
    }

    public function getupdatecontactname(){

        return view('dashboard.editcontactname');
    }

    public function getupdateaddress(){

        return view('dashboard.editaddress');
    }

    public function getdashhome(){

        return view('userdash.dash-home');
    }

    public function getuserdashinventory(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $basic_units = $user->basic_units->sortByDesc('created_at');
        $kits = $user->kits->sortByDesc('created_at');
        $cases = $user->cases->sortByDesc('created_at');
        $cartons = $user->cartons->sortByDesc('created_at');
        $pallets = $user->pallets->sortByDesc('created_at');
        return view('userdash.dash-inventory')->with('cartons', $cartons)->with('pallets', $pallets)->with('cases', $cases)->with('basic_units', $basic_units)->with('kits', $kits);
    }

    public function getuserdashfulfillment(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $kits = $user->kits;
        $orders = $user->orders->where('order_type', '=', 'Fulfill Items')->where('status', '=', 'Pending Approval')->sortByDesc('created_at');
        return view('userdash.dash-fulfillment')->with('orders', $orders);
    }

    public function getuserdashaccount(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('userdash.dash-account')->with('user', $user);
    }

    public function getuserorders(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $orders = $user->orders->where('order_type', '!=', 'Fulfill Items')->where('status', '=', 'Pending Approval')->sortByDesc('created_at');
        $orderhistory = $user->orders->where('order_type', '!=', 'Fulfill Items')->where('status', '=', 'Completed')->sortByDesc('created_at');
        return view('userdash.dash-orders')->with('user', $user)->with('orders', $orders)->with('orderhistory', $orderhistory);
    }



    public function getadminusers(){

        return view('admindash.dash-all-user')->with('users', User::all());
    }

    public function getadminaccount(){

        return view('admindash.dash-account');
    }

    public function getadminfulfillment(){

        $orders = Order::orderBy('created_at', 'desc')->where('order_type', '=', 'Fulfill Items')->where('status', '=', 'Pending Approval')->get();
        return view('admindash.dash-fulfillment')->with('orders', $orders);
    }

    public function getadminorders(){
        $orders = Order::orderBy('created_at', 'desc')->get()->where('status', '=', 'Pending Approval')->where('order_type', '!=', 'Fulfill Items');
        return view('admindash.dash-orders')->with('orders', $orders);
    }

    public function getadmininventory(){
        /*
        $units = DB::select('SELECT * FROM basic_unit_tbl');
        $kits = DB::select('SELECT * FROM kit_tbl');
        $cases = DB::select('SELECT * FROM cases');
        $cartons = DB::select('SELECT * FROM cartons');
        $pallets = DB::select('SELECT * FROM pallets');
        $orders = DB::select('SELECT * FROM orders WHERE status = ?', ['Pending Approval']);
        */

        $units = Basic_Unit::orderBy('created_at', 'desc')->get();
        $kits = Kit::orderBy('created_at', 'desc')->get();
        $cases = Cases::orderBy('created_at', 'desc')->get();
        $cartons = Carton::orderBy('created_at', 'desc')->get();
        $pallets = Pallet::orderBy('created_at', 'desc')->get();
        //$orders = Order::orderBy('created_at', 'desc')->get()->where('status', '=', 'Pending Approval');

        return view('admindash.dash-all-inventory')->with('basic_units', $units)->with('kits', $kits)->with('cases', $cases)->with('cartons', $cartons)->with('pallets', $pallets);
    }


}
