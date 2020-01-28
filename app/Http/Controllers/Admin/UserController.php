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
            return redirect('/dashboard/admin/users')->with('warning', "You are not allowed to edit this user's roles. Please request more access by web master.");
        }
        return view('admin.users.edit')->with(['user'=>User::find($id), 'roles' => Role::all()]);

    }


    public function update(Request $request, $id){
        if (Auth::user()->id == $id) {
            return redirect()->back()->with('warning', "You are not allowed to edit this user's roles. Please request more access by web master.");
        }
        $user = User::find($id);
        $user->roles()->sync($request->roles);
        
        return redirect()->back()->with('success', 'User roles have been updated.');
    }

    public function creditupdate(Request $request, $id){
        $user = User::find($id);
        $user->credit = $request->credit_status;
        $user->save();
        return redirect()->back()->with('success', $user->name . "'s credit status has been updated to: ". $user->credit . ".");
    }

    public function accountbalanceupdate(Request $request, $id){
        $user = User::find($id);
        $user->account_balance = $request->accbal;
        $user->save();
        return redirect()->back()->with('success', $user->name . "'s account balance has been updated to: ". $user->account_balance . ".");
    }

    public function getuser($id){
        $user = User::with('cases', 'kits', 'basic_units')->find($id);
        return collect(['user' => $user]);
        
    }


    public function destroy($id){

        if (Auth::user()->id == $id) {
            return redirect()->back()->with('warning', 'You are not allowed to delete yourself as a user.');
        }
        $user = User::find($id);
        if ($user) {
            $user->roles()->detach();
            $user->delete();
            return redirect()->back()->with('success', 'User has successfully been deleted.');
        }
        
        return redirect()->back()->with('warning', 'This user cannot be deleted.');
        
    }
}
