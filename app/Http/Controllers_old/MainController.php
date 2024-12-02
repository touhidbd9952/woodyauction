<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Category;
use App\Models\Product;
use App\Models\Product_multiple_image;
use App\Models\Product_multiple_video;
use App\Models\CustomerMail;
use App\Models\OurProject;
use App\Models\Slider;

use App\Mail\customerMailContact;
use App\Mail\generalContact;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;



class MainController extends Controller
{
    
    public function __construct()
    {
        //base url
        $base_url = URL::to('/'); 
        Session::put('base_url',$base_url) ;
        //$base_url = Session::get('base_url');

        //language
        if (Session::has('language')) 
        {
            $language = "";
            $language = Session::get('language');
            if($language =="")
            {
                $language = "en";
                Session::put('language',$language) ;
            }
        }

    }
    public function change_language($lan)
    {
        $pageurl ="";
        if($lan =="en")
        {
            Session::put('language','en') ; 
        }
        else if($lan =="jp"){
            Session::put('language','jp') ;
        }
        //return response()->json('changed');
        return response()->json($lan);
    }
    
    public function get_pageurl($en_url,$jp_url)
    {
        $pageurl ="";
        $language = "";
        $language = Session::get('language'); 
        if($language =="" || $language =="en")
        {
            $language = "en";
            Session::put('language',$language) ; 
            $pageurl  = $en_url;
        }
        else if($language =="jp"){
            $language = "jp";
            Session::put('language',$language) ;
            $pageurl  = $jp_url;
        }

        return $pageurl ;
    }

    public function index()
    {
        $page =$this->get_pageurl('en.welcome','jp.welcome');

        $categories = Category::with('user')->where('publish_status','publish')->get();
        $our_projects = OurProject::with('user')->where('publish_status','publish')->get();
        $sliders = Slider::with('user')->where('publish_status','publish')->get();
        return view($page,compact('categories','our_projects','sliders'));
    }
    public function aboutus()
    {
        $page =$this->get_pageurl('en.aboutus','jp.aboutus');
        
        return view($page);
    }

    //all category show 
    public function fabrications()
    { 
        $page =$this->get_pageurl('en.category','jp.category');
        
        $categories = Category::with('user')->where('publish_status','publish')->get(); 
        $our_projects = OurProject::with('user')->where('publish_status','publish')->get(); 

        return view($page, compact('categories','our_projects'));
    }

    //all product view by category id
    public function fabrication($id)
    { 
        $page =$this->get_pageurl('en.product','jp.product');
        
        $products = Product::with('category')->with('user')->where('cat_id',$id)->get();
        $our_projects = OurProject::with('user')->where('publish_status','publish')->get();
        $catid = $id;
        return view($page, compact('products','catid','our_projects'));
    }

    //selected product view in single page by product id
    public function fabrication_view($id)
    {
        //page selection
        $page =$this->get_pageurl('en.single_product','jp.single_product');
        
        $products = Product::with('category')->with('user')->where('id',$id)->get();
        $product_multiple_images = Product_multiple_image::with('product')->with('user')->where('product_id',$id)->get();
        $product_multiple_videos = Product_multiple_video::with('product')->with('user')->where('product_id',$id)->get();
        $product_id = $id;

        $successmessage ="";
        return view($page, compact('products','product_id', 'product_multiple_images', 'product_multiple_videos','successmessage'));
    }
    public function contactus()
    {
        $page =$this->get_pageurl('en.contactus','jp.contactus');
        


        return view($page);
    }

    //contactmail
    public function contactmail(Request $request)
    {   
        $page =$this->get_pageurl('en.single_product','jp.single_product');
        
        $product_id = $request->product_id;

        /////////////////////////////////

        //insert record in customermail table
        if($request->name !="" && $request->company_name !="" && $request->email !="" && $request->product_id !="" && $request->message !="")
        {
            CustomerMail::insert([
                'name'=>$request->name,
                'companyname'=>$request->company_name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'product_id'=>$request->product_id,
                'message'=>$request->message,
                'created_at'=>Carbon::now(),
            ]);

            $product = Product::find($request->product_id);
            $product_name = $product->title;
            $product_image = $product->thumbnail_image;


            //mailing System
            $data = array();
            $data['name'] = $request->name;
            $data['companyname'] = $request->company_name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['product_id'] = $request->product_id;
            $data['product_name'] = $product->title;
            $data['product_image'] = $product_image;
            $data['message'] = $request->message;

        //to which mail address, mail need to send
        //by which mailable class

            Mail::to('touhidbd9952@gmail.com')->send(new customerMailContact($data));

            
            $products = Product::with('category')->with('user')->where('id',$product_id)->get();
            $product_multiple_images = Product_multiple_image::with('product')->with('user')->where('product_id',$product_id)->get();
            $product_multiple_videos = Product_multiple_video::with('product')->with('user')->where('product_id',$product_id)->get();
            $product_id = $product_id;

            $successmessage ="Mail Sent...";
            return view($page,compact('products','product_id', 'product_multiple_images', 'product_multiple_videos','successmessage'));
        }
        else{
            $successmessage ="Mail Send problem...";
            return view($page,compact('products','product_id', 'product_multiple_images', 'product_multiple_videos','successmessage'));
        }

    }

    //contactus
    public function general_contactus(Request $request)
    {
        $page =$this->get_pageurl('en.contactus','jp.contactus');

        $data = [
            'name' => $request->name,
            'email' =>$request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ];
        
        Mail::to('woody@gmail.com')->send(new generalContact($data));

        $notification=array(
            'message'=>'Mail Sent...',
            'alert-type'=>'success'
        );

        $successmessage ="Mail Sent...";
        //return view($page,compact('successmessage'));
        return redirect()->route('contactus')->with($notification);
        
    } 

    //Captcha 
    public function refreshCaptcha()
    {
        
    }





}
