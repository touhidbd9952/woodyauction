<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Category;
use App\Models\Product;
use Intervention\Image\Facades\Image;


class CategoryController extends Controller
{
    public function add_form()
    {
        return view('admin.category.add_category');
    }

    //Category Store
    public function store(Request $request)
    {
       //dd($request->all());
        //validation  
        $request->validate([
            'title' => 'required|max:255',
            'title_jp' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ],
        [
            'title.required' => 'Category Title Required',
            'title_jp.required' => 'Category Title In Japanese Required',
            'title.max' => 'Maximum 255 chars',
            
        ]);
        // echo $request->category_name;die;
        $category_image = $request->file('image');  
        $name_gen = hexdec(uniqid()).'.'.$category_image->getClientOriginalExtension(); 
        Image::make($category_image)->resize(600,600)->save('uploads/images/category/'.$name_gen);

        $category_image_path = 'uploads/images/category/'.$name_gen;

        Category::insert([
            'title'=>$request->title,
            'title_jp'=>$request->title_jp,
            'description'=>$request->description,
            'description_jp'=>$request->description_jp,
            'publish_status'=>$request->publish_status,
            'image'=>$category_image_path,
            'user_id'=>Auth::user()->id,
            'created_at'=>Carbon::now(),
        ]);

        return Redirect()->back()->with('success','Saved Successfully'); 
    }

    //All Category View
    public function view()
    {
        //get all data from categories table
        $categories = Category::latest()->paginate(5);  
        return view('admin.category.view_category', compact('categories'));
    }


    //Category edit
    public function edit($id)
    {
        $categories = Category::find($id);
        return view('admin.category.edit_category', compact('categories'));
    }

    //Category update
    public function update(Request $request, $id)
    {   
        //validation  
        $request->validate([
            'title' => 'required|max:255',
            'title_jp' => 'required|max:255',
        ],
        [
            'title.required' => 'Category Title Required',
            'title.max' => 'Maximum 255 chars',
            'title_jp.required' => 'Category Title In Japanese Required',
            'title_jp.max' => 'Maximum 255 chars',
            
        ]);
        //dd($request->all());
        $category_image = "";
        $category_image_path="";
        $category_oldimg ="";
        $category_image = $request->file('image');
        if($category_image !="")
        {
            $category_oldimg = $request->old_img; 
            if(file_exists($category_oldimg))
            {
                unlink($category_oldimg);
            }
            $ext = $category_image->getClientOriginalExtension();
            if($ext == 'jpg'||$ext == 'jpeg'||$ext == 'png'||$ext == 'gif')
            {
                $name_gen = hexdec(uniqid()).'.'.$category_image->getClientOriginalExtension();
                Image::make($category_image)->resize(600,600)->save('uploads/images/category/'.$name_gen);
                $category_image_path = 'uploads/images/category/'.$name_gen;
            }
            else{
                $category_image_path =  $request->old_img;
            }
        }
        else{
            $category_image_path =  $request->old_img;
        }

        Category::find($id)->update([
            'title'=>$request->title,
            'title_jp'=>$request->title_jp,
            'description'=>$request->description,
            'description_jp'=>$request->description_jp,
            'image'=>$category_image_path,
            'publish_status'=>$request->publish_status,
            'user_id'=>Auth::user()->id,
            'updated_at'=>Carbon::now(),
        ]);
        return Redirect()->back()->with('success','Category updated');
    }

    //Category delete
    public function delete($id)
    {
        $product = Product::where('cat_id',$id)->get(); 
        if(count($product)==0)
        {
            $category = Category::find($id);
            $catoldimg = $category->image;
            if(is_file($catoldimg))
            {
                unlink($catoldimg);
            }
            Category::find($id)->delete();
            return Redirect()->back()->with('success','Category Deleted');
        }
        else
        {
            return Redirect()->back()->with('error-msg',"This category has record, so can't delete");
        }
    }


}
