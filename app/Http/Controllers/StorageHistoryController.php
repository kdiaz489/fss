<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StorageHistory;


class StorageHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function show($id){

    }

    public function index(){
        $storage_history = DB::select('SELECT * FROM stor_wk_history');
        //Eloquent Version
        //$posts = Post::orderBy('title', 'desc')->get();
        $storage_history = StorageHistory::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.storage.history')->with('storage', $storage_history);
    }

    public function create(){

    }

    public function store(){

    }

    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
