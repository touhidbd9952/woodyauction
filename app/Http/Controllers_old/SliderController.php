<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Slider;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class SliderController extends Controller
{
    public function slider_addform()
    {
        return view('admin.slider.add_slider');
    }

    public function slider_store(Request $request)
    {
        //dd($request->all());
        //validation  
        $request->validate([
            'title' => 'max:255',
            'title_jp' => 'max:255',
            'slider_image' => 'required|mimes:jpg,jpeg,png,gif',
        ]);

        //dd($request->all());
        
        $slider_image = $request->file('slider_image'); 
        $slider_image_name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920,749)->save('uploads/images/slider/'.$slider_image_name_gen);

        $slider_image_path = 'uploads/images/slider/'.$slider_image_name_gen;
                                    

        //Insert data and get id
        $id = Slider::insertGetId([
            'title'=> trim($request->title),
            'title_jp'=> trim($request->title_jp),
            'subtitle'=> trim($request->subtitle),
            'subtitle_jp'=> trim($request->subtitle_jp),
            'slider_image'=> $slider_image_path,
            'publish_status'=> $request->publish_status,
            'user_id'=> Auth::user()->id,
            'created_at'=>Carbon::now(),
        ]); 

        return Redirect()->back()->with('success','Saved Successfully');
    }

    public function slider_edit($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.edit_slider',compact('slider'));
    }

    public function slider_update(Request $request, $id)
    {
        //dd($request->all());
        //validation  
        $request->validate([
            'title' => 'max:255',
            'title_jp' => 'max:255',
        ]);

        //dd($request->all());
        $slider_image = "";
        $slider_oldimg ="";
        $slider_image_path="";
        $slider_image = $request->file('slider_image');
        
        if($slider_image !="")
        {
            $ext = $slider_image->getClientOriginalExtension();
            if($ext == 'jpg'||$ext == 'jpeg'||$ext == 'png'||$ext == 'gif')
            {
                $slider_oldimg = $request->old_img; 
                if(file_exists($slider_oldimg))
                {
                    unlink($slider_oldimg);
                }
                
                $slider_image_name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
                Image::make($slider_image)->resize(1920,749)->save('uploads/images/slider/'.$slider_image_name_gen);
                $slider_image_path = 'uploads/images/slider/'.$slider_image_name_gen;
            }
            else{
                $slider_image_path =  $request->old_img;
            }
        }
        else
        {
            $slider_image_path =  $request->old_img;
        }                         

        //Insert data and get id
        Slider::find($id)->update([
            'title'=> trim($request->title),
            'title_jp'=> trim($request->title_jp),
            'subtitle'=> trim($request->subtitle),
            'subtitle_jp'=> trim($request->subtitle_jp),
            'slider_image'=> $slider_image_path,
            'publish_status'=> $request->publish_status,
            'user_id'=> Auth::user()->id,
            'updated_at'=>Carbon::now(),
        ]); 

        return Redirect()->back()->with('success','Updated Successfully');
    }

    public function slider_view()
    {
        $sliders = Slider::where('publish_status','publish')->paginate(25);
        return view('admin.slider.view_slider',compact('sliders'));
    }

    public function slider_delete($id)
    {
        $slider = Slider::findOrFail($id);
        
        if(file_exists($slider->slider_image))
        {
            unlink($slider->slider_image);
        }
        //delete by id
        Slider::find($id)->delete();
        return Redirect()->back()->with('success','Deleted Successfully');
    }
}
