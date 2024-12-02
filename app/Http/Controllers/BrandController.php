<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Skbrands;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
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
        return view('backend.admin.brand.add_brand');
    }
    //Category Store
    public function store(Request $request)
    {
        $this->checkvaliduser();
        //validation  
        $request->validate([
            'name_en' => 'required|max:255|unique:brands',
            'name_jp' => 'required|max:255',
        ],
        [
            'name_en.required' => 'Brand Name Required',
            'name_jp.required' => 'Brand Name In Japanese Required',
            'name_en.max' => 'Maximum 255 chars',
        ]);

        $id = Brand::insertGetId([
            'name_en'=>$request->name_en,
            'name_jp'=>$request->name_jp,
            'name_slag_en'=>preg_replace('/\s+/', '-', $request->name_en),
            'name_slag_jp'=>preg_replace('/\s+/', '-', $request->name_jp),
            'status'=>$request->status,
            'user_id'=>Auth::user()->id,
            'created_at'=>Carbon::now(),
        ]);
        if($id !="")
        {
            Skbrands::insertGetId([ 	
                'brandid' => $id,	
                'created_at'=> Carbon::now(),
            ]);
        }
        
        return Redirect()->back()->with('success','Saved Successfully'); 
    }

    //All Category View
    public function view()
    {
        $this->checkvaliduser();
        //get all data from categories table
        $brands = Brand::latest()->get();  
        return view('backend.admin.brand.view_brand', compact('brands'));
    }

    //Category edit
    public function edit($id)
    {
        $this->checkvaliduser();

        $brands = Brand::find($id);
        return view('backend.admin.brand.edit_brand', compact('brands'));
    }

    //Category update
    public function update(Request $request, $id)
    {  
        $this->checkvaliduser(); 
        //validation  
        $request->validate([
            'name_en' => 'required|max:255',
            'name_jp' => 'required|max:255',
        ],
        [
            'name_en.required' => 'Brand Name Required',
            'name_jp.required' => 'Brand Name In Japanese Required',
            'name_en.max' => 'Maximum 255 chars',
        ]);
        

        Brand::find($id)->update([
            'name_en'=>$request->name_en,
            'name_jp'=>$request->name_jp,
            'name_slag_en'=>preg_replace('/\s+/', '-', $request->name_en),
            'name_slag_jp'=>preg_replace('/\s+/', '-', $request->name_jp),
            'status'=>$request->status,
            'user_id'=>Auth::user()->id,
            'updated_at'=>Carbon::now(),
        ]);

        Product::where('brand_id',$id)->update([
            'brand_name_en'=>$request->name_en,
            'brand_name_jp'=>$request->name_jp,
            'user_id'=>Auth::user()->id,
            'updated_at'=>Carbon::now(),
        ]);

        return Redirect()->back()->with('success','Brand updated');
    }

    //Category delete
    public function delete($id)
    {
        $this->checkvaliduser();
        
        $product = Product::where('brand_id',$id)->get(); 
        if(count($product)==0)
        {
            if(Skbrands::where('brandid',$id)->delete())
            {
                Brand::find($id)->delete();
                return Redirect()->back()->with('success','Brand Deleted');
            }
            else
            {
                return Redirect()->back()->with('error-msg',"This brand has record, so can't delete");
            }
        }
        else
        {
            return Redirect()->back()->with('error-msg',"This brand has record, so can't delete");
        }
    }
}
