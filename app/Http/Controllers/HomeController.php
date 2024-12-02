<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
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
        //Session::flush(); // removes all session data
        //dd(Hash::make(12345));
        Session::put('language','en') ;

        if(Auth::user()->role_id ==3)
        {
            return view('backend.admin.home');  //3 for admin
        }
        else if(Auth::user()->role_id ==1)
        {
            return view('backend.member.home'); //1 for bidder member
        }
        else{
            return view('auth.login');  //normal user
        }
    }
}
