<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\OurProject;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class OurProjectController extends Controller
{
    public function project_view()
    {
        $projects = OurProject::latest()->paginate(25);
        return view('admin.our_project.view_project',compact('projects'));
    }

    public function project_addform()
    {
        return view('admin.our_project.add_project');
    }
    public function project_store(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'title' => 'required|max:255',
            'title_jp' => 'required|max:255',
            'thumbnail_image' => 'required|mimes:jpg,jpeg,png,gif',
        ],
        [
            'title.required' => 'Product title Required',
            'title.max' => 'Maximum 255 chars',
            'title_jp.required' => 'Product Title In Japanese Required',
            'title_jp.max' => 'Maximum 255 chars',
        ]);

        //dd($request->all());
        
        $project_thambnail = $request->file('thumbnail_image'); 
        $project_thambnail_name_gen = hexdec(uniqid()).'.'.$project_thambnail->getClientOriginalExtension();
        Image::make($project_thambnail)->resize(600,600)->save('uploads/images/project/thambnail/'.$project_thambnail_name_gen);

        $project_thambnail_image = 'uploads/images/project/thambnail/'.$project_thambnail_name_gen;
                                    

        //Insert data and get id
        $id = OurProject::insertGetId([
            'title'=> trim($request->title),
            'title_jp'=> trim($request->title_jp),
            'short_des'=> $request->short_des,
            'short_des_jp'=> $request->short_des_jp,
            'detail_des'=> $request->detail_des,
            'detail_des_jp'=> $request->detail_des_jp,
            'thumbnail_image'=> $project_thambnail_image,
            'publish_status'=> $request->publish_status,
            'user_id'=> Auth::user()->id,
            'created_at'=>Carbon::now(),
        ]); 

        return Redirect()->back()->with('success','Saved Successfully');
    }

    public function project_edit($id)
    {
        $ourproducts = OurProject::find($id);
        return view('admin.our_project.edit_project',compact('ourproducts'));
    }
    public function project_update(Request $request,$id)
    {
        //dd($request->all());
        $request->validate([
            'title' => 'required|max:255',
            'title_jp' => 'required|max:255',
            'thumbnail_image' => 'mimes:jpg,jpeg,png,gif',
        ],
        [
            'title.required' => 'Product title Required',
            'title.max' => 'Maximum 255 chars',
            'title_jp.required' => 'Product title Required',
            'title_jp.max' => 'Maximum 255 chars',
        ]);

        
        
        $project_thambnail = "";
        $project_oldimg ="";
        $project_thambnail_image_path ="";

        $project_thambnail = $request->file('thumbnail_image'); 

        if($project_thambnail !="")
        {
            $ext = $project_thambnail->getClientOriginalExtension();

            if($ext == 'jpg'||$ext == 'jpeg'||$ext == 'png'||$ext == 'gif')
            {
                $project_oldimg = $request->old_img; 
                if(file_exists($project_oldimg))
                {
                    unlink($project_oldimg);
                }
                
                $project_thambnail_name_gen = hexdec(uniqid()).'.'.$project_thambnail->getClientOriginalExtension();
                Image::make($project_thambnail)->resize(600,600)->save('uploads/images/project/thambnail/'.$project_thambnail_name_gen);

                $project_thambnail_image_path = 'uploads/images/project/thambnail/'.$project_thambnail_name_gen;
            }
            else{
                $project_thambnail_image_path =  $request->old_img;
            }
        }
        else{
            $project_thambnail_image_path =  $request->old_img;
        }
                                    

        //Insert data and get id
        $id = OurProject::find($id)->update([
            'title'=> trim($request->title),
            'title_jp'=> trim($request->title_jp),
            'short_des'=> $request->short_des,
            'short_des_jp'=> $request->short_des_jp,
            'detail_des'=> $request->detail_des,
            'detail_des_jp'=> $request->detail_des_jp,
            'thumbnail_image'=> $project_thambnail_image_path,
            'publish_status'=> $request->publish_status,
            'user_id'=> Auth::user()->id,
            'updated_at'=>Carbon::now(),
        ]); 

        return Redirect()->back()->with('success','Updated Successfully');
    }

    public function project_delete($id)
    {
        $project = OurProject::find($id);
        $project_thambnail_image = $project->thumbnail_image;
        if(file_exists($project_thambnail_image))
        {
            unlink($project_thambnail_image);
        }
        OurProject::find($id)->delete();
        return Redirect()->back()->with('success','Deleted Successfully');
    }





}
