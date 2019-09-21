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
