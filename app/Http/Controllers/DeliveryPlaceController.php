<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery_place;
use App\Models\Skdelivery_places;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class DeliveryPlaceController extends Controller
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
        return view('backend.admin.deliveryplace.add_deliveryplace');
    }
    //Category Store
    public function store(Request $request)
    {
        $this->checkvaliduser();
        //validation  
        $request->validate([
            'name_en' => 'required|max:255|unique:delivery_places',
            'name_jp' => 'required|max:255',
        ],
        [
            'name_en.required' => 'Delivery place Name Required',
            'name_jp.required' => 'Delivery place Name In Japanese Required',
            'name_en.max' => 'Maximum 255 chars',
        ]);

        $id = Delivery_place::insertGetId([
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
            Skdelivery_places::insertGetId([ 	
                'deliveryplaceid' => $id,	
                'created_at'=> Carbon::now(),
            ]);
            return Redirect()->back()->with('success','Saved Successfully');
        }
        else
        {
            return Redirect()->back()->with('error-msg',"Sorry, not saved");
        }
         
    }

    //All Category View
    public function view()
    {
        $this->checkvaliduser();
        //get all data from categories table
        $deliveryplaces = Delivery_place::latest()->get();  
        return view('backend.admin.deliveryplace.view_deliveryplace', compact('deliveryplaces'));
    }

    //Category edit
    public function edit($id)
    {
        $this->checkvaliduser();

        $deliveryplaces = Delivery_place::find($id);
        return view('backend.admin.deliveryplace.edit_deliveryplace', compact('deliveryplaces'));
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
        

        Delivery_place::find($id)->update([
            'name_en'=>$request->name_en,
            'name_jp'=>$request->name_jp,
            'name_slag_en'=>preg_replace('/\s+/', '-', $request->name_en),
            'name_slag_jp'=>preg_replace('/\s+/', '-', $request->name_jp),
            'status'=>$request->status,
            'user_id'=>Auth::user()->id,
            'updated_at'=>Carbon::now(),
        ]);
        return Redirect()->back()->with('success','Delivery place updated');
    }

    //Category delete
    public function delete($id)
    {
        $this->checkvaliduser();
        
        $product = Product::where('delivery_place_id',$id)->get(); 
        if(count($product)==0)
        {
            if(Skdelivery_places::where('deliveryplaceid',$id)->delete())
            {
                Delivery_place::find($id)->delete();
                return Redirect()->back()->with('success','Delivery Place Deleted');
            }
            else
            {
                return Redirect()->back()->with('error-msg',"This delivery place has record, so can't delete");
            }
        }
        else
        {
            return Redirect()->back()->with('error-msg',"This delivery place has record, so can't delete");
        }
    }
}
