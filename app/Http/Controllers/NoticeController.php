<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class NoticeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function checkvaliduser()
    {
        $validuser = "";
        $validuser = Session::get('validuser');  
        if($validuser =="" || $validuser ==0)
        { 
            echo '<div style="width:300px;padding:20px;min-height:100px;margin:0 auto;border:1px solid #ccc;text-align:center;margin-top:15%;"><br>Token Missing or Invalid';
            echo '<br><br>Go to &nbsp;<a href="'.route('home').'">Dashboard</a>&nbsp; and set user token number</div>';exit;
        }
        //$this->checkvaliduser();
    }
    public function add_form()
    {
        $this->checkvaliduser();
        return view('backend.admin.notice.add_notice');
    }
    //Notice Store
    public function store(Request $request)
    { 
        $this->checkvaliduser();

        $request->validate([
            'notice_message' => 'required',
        ]);

        Notice::insert([
            'notice_message'=>$request->notice_message,
            'user_id'=>Auth::user()->id,
            'created_at'=>Carbon::now(),
        ]);
        
        return Redirect()->back()->with('success','Saved Successfully'); 
    }

    //All Notice View
    public function view()
    {
        $this->checkvaliduser();
        //get all data from categories table
        $notices = Notice::latest()->get();  
        return view('backend.admin.notice.view_notice', compact('notices'));
    }

    //Notice edit
    public function edit($id)
    {
        $this->checkvaliduser();

        $notices = Notice::find($id);
        return view('backend.admin.notice.edit_notice', compact('notices'));
    }

    //Notice update
    public function update(Request $request, $id)
    { 
        $this->checkvaliduser();  
        //validation  
        $request->validate([
            'notice_message' => 'required',
        ]);
        

        Notice::find($id)->update([
            'notice_message'=>$request->notice_message,
            'user_id'=>Auth::user()->id,
            'updated_at'=>Carbon::now(),
        ]);
        return Redirect()->back()->with('success','Notice Message updated');
    }
    //active message
    public function active_notice($id)
    { 
        $this->checkvaliduser();

        $notices = Notice::latest()->get();  //dd($notices);
        foreach($notices as $n)
        {
            if($n->id == $id)
            {
                Notice::find($id)->update([
                    'status'=>1,
                    'user_id'=>Auth::user()->id,
                    'updated_at'=>Carbon::now(),
                ]);
            }
            else
            {
                Notice::find($n->id)->update([
                    'status'=>0,
                    'user_id'=>Auth::user()->id,
                    'updated_at'=>Carbon::now(),
                ]);
            }
        }
        
        
        return Redirect()->back()->with('success','Notice Active');
    }


    //Notice delete
    public function delete($id)
    {
        $this->checkvaliduser();
        
        Notice::find($id)->delete();
        return Redirect()->back()->with('success','Notice Message Deleted');
    }
}
