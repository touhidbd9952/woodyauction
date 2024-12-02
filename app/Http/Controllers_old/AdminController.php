<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.home', compact('products'));
    }

    //admin account view
    public function view()
    {
        $users = User::where('role_id','!=',2)->paginate(25);
        return view('admin.account.view',compact('users'));
    }

    //add new admin account
    public function add_form()
    {
        return view('admin.account.add_admin');
    }

    //store admin account
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8'
        ]);

        User::insert([
            'role_id' => 1,
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'created_at'=>Carbon::now(),
        ]);

        return Redirect()->back()->with('success','Saved Successfully'); 
    }

    //edit admin account
    public function edit($id)
    {

        $user = User::find($id);
        return view('admin.account.edit_admin',compact('user'));
    }

    //update admin account
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        User::find($id)->update([
            'role_id' => 1,
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'updated_at'=>Carbon::now(),
        ]);

        return Redirect()->back()->with('success','Updated Successfully');
    }

    //delete admin account
    public function delete($id)
    {
        User::find($id)->delete();
        return Redirect()->back()->with('success','Account Deleted');
    }

    //change admin password
    public function change_pass(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8'
        ]);

        User::find($id)->update([
            'password'=>Hash::make($request->password),
            'updated_at'=>Carbon::now(),
        ]);

        return Redirect()->back()->with('success','Password changed'); 
    }

}
