<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductMultipleVideoController extends Controller
{
    public function index()
    {
        return view('admin.product.videouploadform');
    }

    public function upload_video(Request $request)
    { 
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
