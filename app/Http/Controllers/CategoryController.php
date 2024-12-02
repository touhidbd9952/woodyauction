<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Skcategories;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
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
        return view('backend.admin.category.add_category');
    }
    //Category Store
    public function store(Request $request)
    {
        $this->checkvaliduser();
        //validation  
        $request->validate([
            'name_en' => 'required|max:255|unique:categories',
            'name_jp' => 'required|max:255',
        ],
        [
            'name_en.required' => 'Category Name Required',
            'name_jp.required' => 'Category Name In Japanese Required',
            'name_en.max' => 'Maximum 255 chars',
        ]);

        $id = Category::insertGetId([
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
            Skcategories::insertGetId([ 	
                'categoryid' => $id,	
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
        $categories = Category::orderby('sl','asc')->latest()->get();  
        return view('backend.admin.category.view_category', compact('categories'));
    }

    //Category edit
    public function edit($id)
    {
        $this->checkvaliduser();
        $categories = Category::find($id);
        return view('backend.admin.category.edit_category', compact('categories'));
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
            'name_en.required' => 'Category Name Required',
            'name_jp.required' => 'Category Name In Japanese Required',
            'name_en.max' => 'Maximum 255 chars',
        ]);
        

        Category::find($id)->update([
            'name_en'=>$request->name_en,
            'name_jp'=>$request->name_jp,
            'name_slag_en'=>preg_replace('/\s+/', '-', $request->name_en),
            'name_slag_jp'=>preg_replace('/\s+/', '-', $request->name_jp),
            'sl' => $request->sl,
            'status'=>$request->status,
            'user_id'=>Auth::user()->id,
            'updated_at'=>Carbon::now(),
        ]);
        return Redirect()->back()->with('success','Category updated');
    }

    //Category delete
    public function delete($id)
    {
        $this->checkvaliduser();

        $product = Product::where('category_id',$id)->get(); 
        if(count($product)==0)
        {
            if(Skcategories::where('categoryid',$id)->delete())
            {
                Category::find($id)->delete();
                return Redirect()->back()->with('success','Category Deleted');
            }
            else
            {
                return Redirect()->back()->with('error-msg',"This category has record, so can't delete");
            }
        }
        else
        {
            return Redirect()->back()->with('error-msg',"This category has record, so can't delete");
        }
    }


}
