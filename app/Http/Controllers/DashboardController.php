<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use App\StorageWork;
use App\Shipment;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function updateusername(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $user->user_name = request('username');
        $user->save();
        return redirect('/dashboard#account')->with('success', 'Updated User Name');
    }

    public function updateemail(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $user->email = request('email');
        $user->save();
        return redirect('/dashboard#account')->with('success', 'Updated Username');
    }

    public function updatecompanyname(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $user->company_name = request('company-name');
        $user->save();
        return redirect('/dashboard#account')->with('success', 'Updated Company Name');
    }

    public function updatecontactname(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $user->name = request('contact-name');
        $user->save();
        return redirect('/dashboard#account')->with('success', 'Updated Contact Name');
    }

    public function updateaddress(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $user->street_address = request('street-address');
        $user->city = request('city');
        $user->state = request('state');
        $user->zip = request('zip');
        $user->save();
        return redirect('/dashboard#account')->with('success', 'Updated Company Address');
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

    public function index()
    {



        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $shipments = $user->shipments->sortKeysDesc();
        $storagework = $user->storagework->sortKeysDesc();
        $storage = $user->storage->sortKeysDesc();
        
        if($user->hasAnyRole('user')){
            return view('dashboard')->with('shipments', $shipments)->with('storage', $storage)->with('storagework', $storagework);
        }
        elseif($user->hasAnyRole('admin')){
            
            //DB version
            $storagework = DB::select('SELECT * FROM stor_wk_tbl');
            $shipments = DB::select('SELECT * FROM ship_wk_tbl');
            //Eloquent Version
            //$posts = Post::orderBy('title', 'desc')->get();
            $storagework = StorageWork::orderBy('created_at', 'desc')->paginate(10);
            $shipments = Shipment::orderBy('created_at', 'desc')->paginate(10);
            return view('admindashboard')->with('shipments', $user->shipments)->with('shipments', $shipments)->with('storagework', $storagework)->with('users', User::all());;
        }
    }
}
