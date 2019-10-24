<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return view('admin.users.index')->with('users', User::paginate(10));
    }

    public function edit($id){
        if (Auth::user()->id == $id) {
            return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to edit this users roles');
        }
        return view('admin.users.edit')->with(['user'=>User::find($id), 'roles' => Role::all()]);

    }


    public function update(Request $request, $id){
        if (Auth::user()->id == $id) {
            return redirect()->route('/dashboard#allusers')->with('warning', 'You are not allowed to edit this users roles');
        }
        $user = User::find($id);
        $user->roles()->sync($request->roles);
        
        return redirect('/dashboard#allusers')->with('success', 'User has been updated');
    }

    public function creditupdate(Request $request, $id){
        $user = User::find($id);
        $user->credit = $request->credit_status;
        $user->save();
        return redirect('/dashboard#allusers')->with('success', $user->name . "'s credit status has been updated to: ". $user->credit . ".");
    }

    public function accountbalanceupdate(Request $request, $id){
        $user = User::find($id);
        $user->account_balance = $request->accbal;
        $user->save();
        return redirect('/dashboard#allusers')->with('success', $user->name . "'s account balance has been updated to: ". $user->account_balance . ".");
    }


    public function destroy($id){

        if (Auth::user()->id == $id) {
            return redirect('/dashboard#allusers')->with('warning', 'You are not allowed to delete yourself');
        }
        $user = User::find($id);
        if ($user) {
            $user->roles()->detach();
            $user->delete();
            return redirect('/dashboard#allusers')->with('success', 'User has been deleted');
        }
        
        return redirect('/dashboard#allusers')->with('warning', 'This user cannot be deleted.');
        
    }
}
