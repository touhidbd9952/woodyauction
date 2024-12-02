<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product_woner;
use App\Models\Skproduct_woners;
use App\Models\Product;
use App\Models\Bidder_register;
use App\Models\Product_woner_request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Mail\ownerRegistrationSuccessMail;
use Illuminate\Support\Facades\Mail;


class ProductWonerController extends Controller
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

    
    public function get_userID()
    {
        $this->checkvaliduser();
        
        $useridpart1 = rand(000,999);
        $useridpart2 = rand(000,999);
        $useridpart3 = rand(000,999);
        $userID = $useridpart1.$useridpart2.$useridpart3; 

        $productwoner = Product_woner::where('username',$userID)->get();
        if(count($productwoner)>0)
        {
            $this->get_userID();
        }
        else{
            return $userID;
        }
    }
    public function get_userPass()
    {
        $this->checkvaliduser();
        $useridpart1 = rand(00,99);
        $useridpart2 = rand(00,99);
        $useridpart3 = rand(00,99);
        $userPass = $useridpart1.$useridpart2.$useridpart3; 
        return $userPass;
    }
    public function get_usercodeno()
    {
        $this->checkvaliduser();
        $usercodeno = rand(00000000,99999999);
        $bidder ="";
        $bidder = Product_woner::where('usercodeno',$usercodeno)->get();
        if(count($bidder)>0)
        {
            $this->get_usercodeno();
        }
        else{
            return $usercodeno;
        }
    }

    public function add_form()
    {
        $this->checkvaliduser();  
        $userID = $this->get_userID(); //dd($userID);
        $userPass = $this->get_userPass();
        return view('backend.admin.product_owner.add_owner',compact('userID','userPass'));
    }
    //Product Owner Store
    public function store(Request $request)
    {
        $this->checkvaliduser();
       //dd($request->all());
       $usercodeno = rand(00000000,99999999);
       $productownercodeno ="";
       $productowner = Product_woner::where('usercodeno',$usercodeno)->get();
       if(count($productowner)>0||$productownercodeno =="")
       {
           $productowner = $this->get_usercodeno();
       }
        //validation  
        $request->validate([
            'username' => 'required|numeric|min:6|unique:product_woners',
            'password' => 'required|numeric|min:4',
            'name_en' => 'required|max:255',
            'address' => 'required|max:500',
            'postcode' => 'required|max:255',
            'country' => 'required|max:255',
            'email1' => 'required|email|max:255',
            'phone1' => 'required|max:255'
        ]);

        // insert data
        $id = Product_woner::insertGetId([
            'usercodeno' => $productowner,
            'username'=>$request->username,
            'password'=>Hash::make($request->password),
            'name_en'=>$request->name_en,
            'name_jp'=>$request->name_jp,
            'company_name_en'=>$request->company_name_en,
            'company_name_jp'=>$request->company_name_jp,
            'person_incharge_en'=>$request->person_incharge_en,
            'person_incharge_jp'=>$request->person_incharge_jp,
            'address'=>$request->address,
            'postcode'=>$request->postcode,
            'country'=>$request->country,
            'email1'=>$request->email1,
            'email2'=>$request->email2,
            'phone1'=>$request->phone1,
            'phone2'=>$request->phone2,
            'fax'=>$request->fax,
            'status'=>$request->status,
            'user_id'=>Auth::user()->id,
            'created_at'=>Carbon::now(),
        ]);
        if($id !="")
        {
            Skproduct_woners::insertGetId([ 	
                'productwonersid' => $id,	
                'created_at'=> Carbon::now(),
            ]);
           
        }
        if($request->requestedid)
        {
            Product_woner_request::find($request->requestedid)->delete();

            $data = array();
            $data["company_name_en"] = $request->company_name_en;
            $data["company_name_jp"] = $request->company_name_jp;
            $data["name_en"] = $request->name_en;
            $data["name_jp"] = $request->name_jp;
            $data["person_incharge_en"] = $request->person_incharge_en;
            $data["person_incharge_jp"] = $request->person_incharge_jp;
            
            $data["address"] = $request->address;
            $data["postcode"] = $request->postcode;
            $data["country"] = $request->country;
            $data["email1"] = $request->email1;
            $data["email2"] = $request->email2;
            $data["phone1"] = $request->phone1;
            $data["phone2"] = $request->phone2;
            $data["fax"] = $request->fax;

            Mail::to($request->email1)->send(new ownerRegistrationSuccessMail($data));

            return Redirect()->route('productowner.requestview')->with('success','Saved Successfully');
        }
        return Redirect()->route('productowner.requestview')->with('success','Saved Successfully');
         
    }
    public function delete_request($id)
    {
        Product_woner_request::find($id)->delete();
        return Redirect()->route('productowner.requestview')->with('success','Deleted Successfully');
    }

    //All Category View
    public function view()
    {
        $this->checkvaliduser();
        //get all data from categories table
        $woners = Product_woner::latest()->get();  
        return view('backend.admin.product_owner.view_owner', compact('woners'));
    }


    //Category edit
    public function edit($id)
    {
        $this->checkvaliduser();
        $woner = Product_woner::find($id);
        return view('backend.admin.product_owner.edit_owner', compact('woner'));
    }
    
    //Category update
    public function update(Request $request, $id)
    {  
        $this->checkvaliduser(); 
        //validation  
        $request->validate([
            'name_en' => 'required|max:255',
            'address' => 'required|max:500',
            'postcode' => 'required|max:255',
            'country' => 'required|max:255',
            'email1' => 'required|email|max:255',
            'phone1' => 'required|max:255',
            
        ]);
        //dd($request->all());
        Product_woner::find($id)->update([
            'name_en'=>$request->name_en,
            'name_jp'=>$request->name_jp,
            'company_name_en'=>$request->company_name_en,
            'company_name_jp'=>$request->company_name_jp,
            'person_incharge_en'=>$request->person_incharge_en,
            'person_incharge_jp'=>$request->person_incharge_jp,
            'address'=>$request->address,
            'postcode'=>$request->postcode,
            'country'=>$request->country,
            'email1'=>$request->email1,
            'email2'=>$request->email2,
            'phone1'=>$request->phone1,
            'phone2'=>$request->phone2,
            'fax'=>$request->fax,
            'status'=>$request->status,
            'user_id'=>Auth::user()->id,
            'updated_at'=>Carbon::now(),
        ]);
        return Redirect()->back()->with('success','Updated successfully');
    }

    //edit_credential
    public function edit_credential($id)
    {
        $this->checkvaliduser();
        $woner = Product_woner::find($id); 
        return view('backend.admin.product_owner.edit_owner_credential', compact('woner'));
    }
    public function change_password(Request $request, $id)
    {
        $this->checkvaliduser(); 
        //validation  
        $request->validate([
            'password' => 'required|numeric|min:4|same:confirmpassword',
            'confirmpassword' => 'required',
        ]);
        //dd($request->all());
        Product_woner::find($id)->update([
            'password'=>Hash::make($request->password),
            'user_id'=>Auth::user()->id,
            'updated_at'=>Carbon::now(),
        ]);
        return Redirect()->back()->with('success','Changed successfully');
    }

    //Category delete
    public function delete($id)
    {
        $this->checkvaliduser();
        $product = Product::where('woner_id',$id)->get(); 
        if(count($product)==0)
        {
            if(Skproduct_woners::where('productwonersid',$id)->delete())
            {
                Product_woner::find($id)->delete();
                return Redirect()->back()->with('success','Deleted successfully');
            }
            else
            {
                return Redirect()->back()->with('error-msg',"This id has record, so can't delete");
            }
        }
        else
        {
            return Redirect()->back()->with('error-msg',"This id has record, so can't delete");
        }
    }
    //Product_owner Request View
    public function requestview()
    {
        $this->checkvaliduser();
        $productownerrequests = Product_woner_request::latest()->get();  
        return view('backend.admin.product_owner.view_owner_register_request', compact('productownerrequests'));
    }
    public function view_request_details($id)
    {
        $this->checkvaliduser();
        
         //get last record
        // $bidder = Bidder_register::orderBy('id', 'desc')->first();
        // $basevalue = $bidder->basevalue;
        // $startvalue = 0;
        // $endvalue = 0;
        // $biddercodeno = 0;
        // if($basevalue == 0)
        // {
        //     $basevalue = 100;
        //     $startvalue = $basevalue + 1;
        //     $endvalue = $basevalue + 10;
        //     $biddercodeno = '08100'.rand($startvalue,$endvalue);
        //     $basevalue = $endvalue;
        // }
        // else
        // {
        //     $startvalue = $basevalue + 1;
        //     $endvalue = $basevalue + 10;
        //     $biddercodeno = '08100'.rand($startvalue,$endvalue);
        //     $basevalue = $endvalue;
        // }
        //dd($request->all());
       $usercodeno = rand(00000000,99999999);
       $productownercodeno ="";
       $productowner = Product_woner::where('usercodeno',$usercodeno)->get();
       if(count($productowner)>0||$productownercodeno =="")
       {
           $productownercodeno = $this->get_usercodeno();
       }

        $userPass = $this->get_userPass();

        $productowner = Product_woner_request::find($id);
        $requestedid = $id;
        return view('backend.admin.product_owner.add_new_product_owner', compact('productowner','requestedid','productownercodeno','userPass'));
    }

    
}
