<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductVideoController extends Controller
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
    public function index()
    {
        $this->checkvaliduser();
        return view('admin.product.videouploadform');
    }

    public function upload_video(Request $request)
    { 
        $this->checkvaliduser();
        $data=$request->all();
         $rules=[
           'video'          =>'mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040|required'];
        $validator = Validator($data,$rules);

        if ($validator->fails())
        {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
            $video=$data['video'];
            $input = time().$video->getClientOriginalExtension();
            $destinationPath = 'uploads/videos';
            $video->move($destinationPath, $input);

                $user['video']       =$input;
                $user['created_at']  =date('Y-m-d h:i:s');
                $user['updated_at']  =date('Y-m-d h:i:s');
                $user['user_id']     =session('user_id');
                DB::table('user_videos')->insert($user);

            return redirect()->back()->with('upload_success','upload_success');
        }
    }
}
