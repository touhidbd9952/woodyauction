<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Skproducts;
use App\Models\Product;
use App\Models\Product_multiple_image;
use App\Models\Skproduct_multiple_images;
use App\Models\Product_video;
use App\Models\Skproduct_videos;
use App\Models\Brand;
use App\Models\Delivery_place;
use App\Models\Product_woner;
use App\Models\Bidder_register;
use App\Models\AuctionHistory;
use App\Models\Auction;
use App\Models\Skauction_histories;
use App\Models\Ownerinvoice;
use App\Models\Customerinvoice;
use App\Models\Infoservice;

use App\Mail\auctionBidOwnMail;
use App\Mail\auctionProductOwnerMail;

use Illuminate\Support\Facades\DB;



use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
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
        $categories = Category::where('status','active')->orderby('name_en','asc')->get(); 
        $brands = Brand::where('status','active')->orderby('name_en','asc')->get(); 
        $deliveryplaces = Delivery_place::where('status','active')->orderby('name_en','asc')->get();
        $product_woners = Product_woner::where('status','active')->orderBy('name_en','asc')->get(); 
        
        return view('backend.admin.product.add_product', compact('categories','brands','product_woners','deliveryplaces'));
    }
    //set_productdata_in_temp
    public function set_productdata_in_temp(Request $request)
    {
        //return response()->json('paisi');

        $wonerList = $request->wonerList;
        $categoryList = $request->categoryList;
        $brandList = $request->brandList;
        $model_no = $request->model_no;
        $serial_no = $request->serial_no;
        $model_year = $request->model_year;
        $used_hour = $request->used_hour;
        $long_description = $request->long_description;
        $long_description_jp = $request->long_description_jp;
        $delivery_place_id = $request->delivery_place_id;
        $delivery_status = $request->delivery_status;
        $releasing_charge = $request->releasing_charge;
        $youtubevideolink = $request->youtubevideolink;
        Session::put('wonerList',$wonerList) ;
        Session::put('categoryList',$categoryList) ;
        Session::put('brandList',$brandList) ;
        Session::put('model_no',$model_no) ;
        Session::put('serial_no',$serial_no) ;
        Session::put('model_year',$model_year) ;
        Session::put('used_hour',$used_hour) ;
        Session::put('long_description',$long_description) ;
        Session::put('long_description_jp',$long_description_jp) ;
        Session::put('delivery_place_id',$delivery_place_id) ;
        Session::put('delivery_status',$delivery_status) ;
        Session::put('releasing_charge',$releasing_charge) ;
        Session::put('youtubevideolink',$youtubevideolink) ;
        
        return response()->json(array(
            'successmsg' => "Save As Draft",
        ));
    }
    //get_productdata_from_temp
    public function get_productdata_from_temp()
    {
        return response()->json(array(
            'wonerList' =>session()->get('wonerList') ,
            'categoryList' =>session()->get('categoryList') ,
            'brandList' =>session()->get('brandList') ,
            'model_no' =>session()->get('model_no') ,
            'serial_no' =>session()->get('serial_no') ,
            'model_year' =>session()->get('model_year') ,
            'used_hour' =>session()->get('used_hour') ,
            'long_description' =>session()->get('long_description') ,
            'long_description_jp' =>session()->get('long_description_jp') ,
            'delivery_place_id' =>session()->get('delivery_place_id') ,
            'delivery_status' =>session()->get('delivery_status') ,
            'releasing_charge' =>session()->get('releasing_charge') ,
            'youtubevideolink' =>session()->get('youtubevideolink') ,
        ));
    }

    //Product store
    public function store(Request $request)
    {
        $this->checkvaliduser();
        //dd($request->all());
        //validation  
        $request->validate([
            "category_id" => 'required',
            //"brand_id" => 'required',
            "model_no" => 'max:255',
            "serial_no" => 'max:255',
            "model_year" => 'max:255',
            "used_hour" => 'max:20',
            "buy_price" => 'max:40',
            "sale_price" => 'max:40',
            //"short_description" => 'required',
            //"short_description_jp" => 'required',
            //"long_description" => 'required',
            //"long_description_jp" => 'required',
            "delivery_place_id" => 'max:11',
            "releasing_charge" => 'max:20',
            'thumbnail_image' => 'required|mimes:jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF',
            'conditional_report' => 'mimes:pdf,txt,rtf,jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF',
        ]);
        
        $product_category = Category::where('id',$request->category_id)->get(); 
        $product_brand = Brand::where('id',$request->brand_id)->get(); 
        $picname ="";
        if(count($product_category)>0)
        {
            $picname .= $product_category[0]->name_en;
        }
        if(count($product_brand)>0)
        {
            $picname .= '-'.$product_brand[0]->name_en;
        }
        $picname .= '-'.$request->model_no.'-'.$request->serial_no;     

        //product main image upload
        $product_thambnail = $request->file('thumbnail_image'); 

        $product_thambnail_name_gen = $picname."_".hexdec(uniqid()).'.'.$product_thambnail->getClientOriginalExtension();
        Image::make($product_thambnail)->resize(640,480)->save('uploads/images/product/thambnail/'.$product_thambnail_name_gen);
        Image::make($product_thambnail)->resize(100,75)->save('uploads/images/product/thambnail_sm/'.$product_thambnail_name_gen);

        $product_thambnail_image = 'uploads/images/product/thambnail/'.$product_thambnail_name_gen;
        $product_thambnail_sm_image = 'uploads/images/product/thambnail_sm/'.$product_thambnail_name_gen;  

		$product_conditional_report_path = "";
        if($request->file('conditional_report') != "")
        {
            $conditional_report = $request->file('conditional_report'); 
            $ext = $conditional_report->getClientOriginalExtension();
            
            if($ext == 'pdf'||$ext == 'txt'||$ext == 'rtf'||$ext == 'PDF'||$ext == 'TXT'||$ext == 'RTF')
            {
                $product_conditional_report_name_gen = hexdec(uniqid()).'.'.$conditional_report->getClientOriginalExtension();
                //Image::make($conditional_report)->save('uploads/files/'.$product_conditional_report_name_gen);
                $request->file('conditional_report')->move('./uploads/files/', $product_conditional_report_name_gen);
            }
            else if($ext == 'JPG'||$ext == 'jpg'||$ext == 'jpeg'||$ext == 'JPEG'||$ext == 'png'||$ext == 'PNG'||$ext == 'gif'||$ext == 'GIF')
            {
                $image = getimagesize($conditional_report);
                $width = $image[0];
                $height = $image[1];
                
                $product_conditional_report_name_gen = $picname."_".hexdec(uniqid()).'.'.$conditional_report->getClientOriginalExtension();
                Image::make($conditional_report)->resize($width,$height)->save('./uploads/files/'.$product_conditional_report_name_gen);
            }
            

            $product_conditional_report_path = 'uploads/files/'.$product_conditional_report_name_gen;
        }
                               

        $brand_name_en ="";
        $brand_name_jp ="";
        if($request->brand_id)
        {
            $brand = Brand::findOrFail($request->brand_id);
            $brand_name_en = $brand->name_en;
            $brand_name_jp = $brand->name_jp;
        }
        

        //Insert data and get id
        
        $id = Product::insertGetId([
            'product_no' => uniqid(),	
            'category_id'=> $request->category_id, 	
            'thumbnail_image'=> $product_thambnail_image, 	
            'thumbnail_sm_image'=> $product_thambnail_sm_image, 
            'videourl' => $request->videourl,
            'conditional_report' => $product_conditional_report_path,	
            'brand_id'=> $request->brand_id, 
            'brand_name_en'=> $brand_name_en,
            'brand_name_jp'=> $brand_name_jp,	
            'model_no'=> $request->model_no, 	
            'serial_no'=> $request->serial_no, 	
            'model_year'=> $request->model_year, 	
            'used_hour'=> $request->used_hour, 	
            'buy_price'=> $request->buy_price, 	
            'sale_price'=> $request->sale_price, 	
            'short_description'=> $request->short_description, 	
            'short_description_jp'=> $request->short_description_jp, 	
            'long_description'=> $request->long_description, 	
            'long_description_jp'=> $request->long_description_jp, 	
            'delivery_place_id'=> $request->delivery_place_id, 
            'delivery_status'=> $request->delivery_status,
            'releasing_charge'=> $request->releasing_charge==""?0.00:str_replace( ',', '',$request->releasing_charge), 	
            'allow_comment'=> $request->allow_comment, 	
            'woner_id'=> $request->woner_id, 	
            'user_id'=> Auth::user()->id,	
            'stock'=> $request->stock, 	
            'status'=> $request->publish_status, 		
            'created_at'=> Carbon::now(),
        ]);   
        if($id)
        {  
           //delete draf data
            if(Session::has('wonerList')){Session::forget('wonerList') ;}
            if(Session::has('categoryList')){Session::forget('categoryList') ;}
            if(Session::has('brandList')){Session::forget('brandList') ;}
            if(Session::has('model_no')){Session::forget('model_no') ;}
            if(Session::has('serial_no')){Session::forget('serial_no') ;}
            if(Session::has('model_year')){Session::forget('model_year') ;}
            if(Session::has('used_hour')){Session::pforgetut('used_hour') ;}
            if(Session::has('long_description')){Session::forget('long_description') ;}
            if(Session::has('long_description_jp')){Session::forget('long_description_jp') ;}
            if(Session::has('delivery_place_id')){Session::forget('delivery_place_id') ;}
            if(Session::has('delivery_status')){Session::forget('delivery_status') ;}
            if(Session::has('releasing_charge')){Session::forget('releasing_charge') ;}
            if(Session::has('youtubevideolink')){Session::forget('youtubevideolink') ;}

            Skproducts::insertGetId([ 	
                'productid' => $id,	
                'created_at'=> Carbon::now(),
            ]);
            
            //$addmoreimage =url('').'/product/imageview/'.$id;    
            return redirect('product/imageview/'.$id)->with('success','Saved Successfully. Please Add More Multiple Image');
            //return Redirect()->back()->with('success','Saved Successfully. To Add More Image <a href="'.$addmoreimage.'" class="btn btn-success">Click Here</a>');
        }
        else{
            return Redirect()->back()->with('error','Data could not save, try agrain');
        }

    }

    //new product, unsold auction product
    public function view_unsold()
    {
        $this->checkvaliduser();
        $products = Product::latest()->where('auction_product',0)->where('final_result','unsold')->get();
        $menuname = "Product";
        return view('backend.admin.product.view_product_unsold',compact('products','menuname'));
    }

    //view condition report
    public function view_condition_report($id)
    {
        $this->checkvaliduser();
        $product = Product::findOrFail($id); 
        $conditional_report = $product->conditional_report; 
        return view('backend.admin.product.view_conditional_report',compact('conditional_report'));
    }

    //sold auction product
    public function view_sold()
    {
        $this->checkvaliduser();
        $products = Product::latest()->where('final_result','sold')->get();
        $menuname = "Product";
        return view('backend.admin.product.view_product_sold',compact('products','menuname'));
    }

    public function details_view($id)
    { 
        $this->checkvaliduser();
        //get product info by id
        $product = Product::findOrFail($id); 
        $categories = Category::where('status','active')->get(); 
        $brands = Brand::where('status','active')->get(); 
        $deliveryplaces = Delivery_place::where('status','active')->get();
        $product_woners = Product_woner::where('status','active')->get(); 
        return view('backend.admin.product.details_view_product',compact('product','categories','brands','product_woners','deliveryplaces'));
    }
    public function details_view_forinvoice($id,$woner_id,$enddate)
    { 
        $this->checkvaliduser();
        //get product info by id
        $product = Product::findOrFail($id); 
        $categories = Category::where('status','active')->get(); 
        $brands = Brand::where('status','active')->get(); 
        $deliveryplaces = Delivery_place::where('status','active')->get();
        $product_woners = Product_woner::where('status','active')->get(); 
        return view('backend.admin.product.details_view_forinvoice_product',compact('product','categories','brands','product_woners','deliveryplaces','woner_id','enddate'));
    }
    public function update_forinvoice(Request $request,$id)
    {
        Product::find($id)->update([
            	
            'entry_fee' => str_replace("," , "" ,$request->entry_fee),
            'inspection_fee' => str_replace("," , "" ,$request->inspection_fee),
            'other_fee' => str_replace("," , "" ,$request->other_fee),
            'auction_charge' => str_replace("," , "" ,$request->auction_charge),
            'yard_charge' => str_replace("," , "" ,$request->yard_charge),
            'extra_charge' =>str_replace("," , "" ,$request->extra_charge),
            'releasing_charge' => str_replace("," , "" ,$request->releasing_charge),	
            
            'updated_at'=>Carbon::now(),
        ]);

        return Redirect()->route('auction.product_owner_invoice',['id' =>$request->woner_id,'enddate' =>$request->enddate])->with('success','Product added in auction Successfully');
    }
    public function details_view_for_customerinvoice($id,$bidder_id,$enddate)
    { 
        $this->checkvaliduser();
        //get product info by id
        $product = Product::findOrFail($id); 
        $categories = Category::where('status','active')->get(); 
        $brands = Brand::where('status','active')->get(); 
        $deliveryplaces = Delivery_place::where('status','active')->get();
        $product_woners = Product_woner::where('status','active')->get(); 
        return view('backend.admin.product.details_view_for_customerinvoice_product',compact('bidder_id','product','categories','brands','product_woners','deliveryplaces','enddate'));
    }
    public function update_for_customerinvoice(Request $request,$id)
    {
        Product::find($id)->update([
            	
            'entry_fee' => str_replace("," , "" ,$request->entry_fee),
            'inspection_fee' => str_replace("," , "" ,$request->inspection_fee),
            'other_fee' => str_replace("," , "" ,$request->other_fee),
            'auction_charge' => str_replace("," , "" ,$request->auction_charge),
            'yard_charge' => str_replace("," , "" ,$request->yard_charge),
            'extra_charge' =>str_replace("," , "" ,$request->extra_charge),
            'releasing_charge' => str_replace("," , "" ,$request->releasing_charge),	
            
            'updated_at'=>Carbon::now(),
        ]);

        return Redirect()->route('auction.bidder_winner_invoice',['id' =>$request->bidder_id,'enddate' =>$request->enddate])->with('success','Product added in auction Successfully');
    }
    public function edit($id)
    { 
        $this->checkvaliduser();
        //get product info by id
        $product = Product::findOrFail($id); 
        $categories = Category::where('status','active')->orderby('name_en','asc')->get(); 
        $brands = Brand::where('status','active')->orderby('name_en','asc')->get(); 
        $deliveryplaces = Delivery_place::where('status','active')->orderby('name_en','asc')->get();
        $product_woners = Product_woner::where('status','active')->get(); 
        return view('backend.admin.product.edit_product',compact('product','categories','brands','product_woners','deliveryplaces'));
    }

    //product update
    public function update(Request $request, $id)
    {
        $this->checkvaliduser();
         
        $request->validate([
            "category_id" => 'required',
            "model_no" => 'max:255',
            "serial_no" => 'max:255',
            "model_year" => 'max:255',
            "used_hour" => 'max:20',
            "buy_price" => 'max:40',
            "sale_price" => 'max:40',
            
            "releasing_charge" => 'max:20',
            
        ]);
    
        $product_thambnail = "";
        $product_oldimg ="";
        $product_thambnail_image ="";
        $product_thambnail_sm_image ="";
        $product_thambnail = $request->file('thumbnail_image'); 
        $product_conditional_report = $request->file('conditional_report'); 
        $product_conditional_report_path ="";

        $product_category = Category::where('id',$request->category_id)->get(); 
        $product_brand = Brand::where('id',$request->brand_id)->get(); 
        $picname ="";
        if(count($product_category)>0)
        {
            $picname .= $product_category[0]->name_en;
        }
        if(count($product_brand)>0)
        {
            $picname .= '-'.$product_brand[0]->name_en;
        }
        $picname .= '-'.$request->model_no.'-'.$request->serial_no;


        //product_thambnail
        if($product_thambnail !="")
        {
            $ext = $product_thambnail->getClientOriginalExtension();
            if($ext == 'JPG'||$ext == 'jpg'||$ext == 'jpeg'||$ext == 'JPEG'||$ext == 'png'||$ext == 'PNG'||$ext == 'gif'||$ext == 'GIF')
            {
                $product_oldimg = $request->old_img; 
                $product_old_sm_img = $request->old_sm_img; 
                
                if(file_exists($product_oldimg))
                {
                    unlink($product_oldimg);
                }
                if(file_exists($product_old_sm_img))
                {
                    unlink($product_old_sm_img);
                }
                
                $product_thambnail_name_gen = $picname."_".hexdec(uniqid()).'.'.$product_thambnail->getClientOriginalExtension();
                Image::make($product_thambnail)->resize(640,480)->save('uploads/images/product/thambnail/'.$product_thambnail_name_gen);
                Image::make($product_thambnail)->resize(100,75)->save('uploads/images/product/thambnail_sm/'.$product_thambnail_name_gen);
                $product_thambnail_image = 'uploads/images/product/thambnail/'.$product_thambnail_name_gen;
                $product_thambnail_sm_image = 'uploads/images/product/thambnail_sm/'.$product_thambnail_name_gen;
            }
            else{
                $product_thambnail_image =  $request->old_img;
                $product_thambnail_sm_image =  $request->old_sm_img;
            }
        }
        else{
            $product_thambnail_image =  $request->old_img;
            $product_thambnail_sm_image =  $request->old_sm_img;
        }

        //product_conditional_report
        if($product_conditional_report !="")
        {
            
            $file_ext = $product_conditional_report->getClientOriginalExtension();
            if($file_ext == 'pdf'||$file_ext == 'txt'||$file_ext == 'rtf'||$file_ext == 'PDF'||$file_ext == 'TXT'||$file_ext == 'RTF')
            {
                $product_old_conditional_report = $request->old_conditional_report; 
                
                if(file_exists($product_old_conditional_report))
                {
                    unlink($product_old_conditional_report);
                }
                
                $conditional_report = $request->file('conditional_report'); 
                $product_conditional_report_name_gen = hexdec(uniqid()).'.'.$conditional_report->getClientOriginalExtension();
                $request->file('conditional_report')->move('./uploads/files/', $product_conditional_report_name_gen);

                $product_conditional_report_path = 'uploads/files/'.$product_conditional_report_name_gen;

            }
            else if($file_ext == 'JPG'||$file_ext == 'jpg'||$file_ext == 'jpeg'||$file_ext == 'JPEG'||$file_ext == 'png'||$file_ext == 'PNG'||$file_ext == 'gif'||$file_ext == 'GIF')
            {
                $product_old_conditional_report = $request->old_conditional_report; 
                
                if(file_exists($product_old_conditional_report))
                {
                    unlink($product_old_conditional_report);
                }
                $conditional_report = $request->file('conditional_report'); 
                $image = getimagesize($conditional_report);
                $width = $image[0];
                $height = $image[1];
                $product_conditional_report_name_gen = $picname."_".hexdec(uniqid()).'.'.$conditional_report->getClientOriginalExtension();
                Image::make($conditional_report)->resize($width,$height)->save('./uploads/files/'.$product_conditional_report_name_gen);
                $product_conditional_report_path = 'uploads/files/'.$product_conditional_report_name_gen;
            }
            else{
                $product_conditional_report_path =  $request->old_conditional_report;
            }
        }
        else{
            $product_conditional_report_path =  $request->old_conditional_report;
        }
              
        $brand_name_en ="";
        $brand_name_jp ="";
        if($request->brand_id)
        {
            $brand = Brand::findOrFail($request->brand_id);
            $brand_name_en = $brand->name_en;
            $brand_name_jp = $brand->name_jp;
        }
        //Update data
        Product::find($id)->update([
             	
            'category_id'=> $request->category_id, 	
            'thumbnail_image'=> $product_thambnail_image, 	
            'thumbnail_sm_image'=> $product_thambnail_sm_image, 
            'videourl' => $request->videourl,
            'conditional_report' => $product_conditional_report_path,
            'brand_id'=> $request->brand_id, 
            'brand_name_en'=> $brand_name_en,
            'brand_name_jp'=> $brand_name_jp,	
            'model_no'=> $request->model_no, 	
            'serial_no'=> $request->serial_no, 	
            'model_year'=> $request->model_year, 	
            'used_hour'=> $request->used_hour, 	
            'buy_price'=> $request->buy_price, 	
            'sale_price'=> $request->sale_price, 	
            'short_description'=> $request->short_description, 	
            'short_description_jp'=> $request->short_description_jp, 	
            'long_description'=> $request->long_description, 	
            'long_description_jp'=> $request->long_description_jp, 	
            'delivery_place_id'=> $request->delivery_place_id,
            'delivery_status'=> $request->delivery_status, 	
            'releasing_charge'=> str_replace( ',', '',$request->releasing_charge), 	
            'allow_comment'=> $request->allow_comment, 	
            'woner_id'=> $request->woner_id, 	
            'user_id'=> Auth::user()->id,	
            'stock'=> $request->stock, 	
            'status'=> $request->status,
            'updated_at'=>Carbon::now(),
        ]);

        return Redirect()->back()->with('success','Updated Successfully');
    }

    //product delete
    public function delete($id)
    {
        $this->checkvaliduser();
        //get productimage by product id and then delete 
        Skproducts::where('productid',$id)->delete();
        $product = Product::findOrFail($id);
        
        //delete thambnail image
        if(file_exists($product->thumbnail_image))
        {
            unlink($product->thumbnail_image);
        }
        
        //delete multiple image
        $productimages = Product_multiple_image::all();
        if(count($productimages)>0)
        {
            foreach($productimages as $aproductimage)
            {
                if($aproductimage->product_id == $id)
                {
                    if(file_exists($aproductimage->image))
                    {
                        unlink($aproductimage->image);
                    }
                    Product_multiple_image::find($aproductimage->id)->delete();
                }
            }
        }

        //delete product by id
        Skproducts::where('productid',$product->productid)->delete();
        Product::find($id)->delete();

        return Redirect()->back()->with('success','Deleted Successfully');
    }






    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    ////////////Product Image/////////////////////

    public function imageview($id)
    {
        $this->checkvaliduser();
        //get product image by id
        //$productimages = Productimage::where('productid', $id)->pluck('name', 'surname');
        $selectedproduct = Product::find($id);
        $productmultipleimages = Product_multiple_image::where('product_id', $id)->get(); 
        return view('backend.admin.product_multiple_image.view_multiple_image',compact('selectedproduct','productmultipleimages'));
    }

    //edit product thumbnail image
    public function edit_productthumbnailimage($id)
    {
        $this->checkvaliduser();
        $product = Product::findOrFail($id);
        $product_id = $id;
        return view('backend.admin.product.edit_productthumbnailimage',compact('product','product_id'));
    }
    public function change_thumbnail(Request $request,$id)
    {
        $this->checkvaliduser();   
        //dd($request->all());
        $request->validate([
            'thumbnail_image' => 'required|mimes:jpeg,jpg,png,gif'
        ]);
        
        $old_thumnail = $request->old_thumnail;
        $new_product_thambnail = $request->file('thumbnail_image');   

        //get product info
        $product = Product::findOrFail($id);  
        $product_category = Category::where('id',$product->category_id)->get();   
        $product_brand = Brand::where('id',$product->brand_id)->get();  
        $picname ="";
        if(count($product_category)>0)
        {
            $picname .= $product_category[0]->name_en;
        }
        if(count($product_brand)>0)
        {
            $picname .= '-'.$product_brand[0]->name_en;
        }
        $picname .= '-'.$product->model_no.'-'.$product->serial_no;          
       

        if($new_product_thambnail != "")
        {
            //delete old image
            if(file_exists($old_thumnail))
            {    
                unlink($old_thumnail);
            }
            if(file_exists($product->thumbnail_sm_image))
            {    
                unlink($product->thumbnail_sm_image);
            }
            
            //create new image
            $image_name_gen = $picname."_".hexdec(uniqid()).'.'.$new_product_thambnail->getClientOriginalExtension();
            Image::make($new_product_thambnail)->resize(640,480)->save('uploads/images/product/thambnail/'.$image_name_gen);
            Image::make($new_product_thambnail)->resize(100,75)->save('uploads/images/product/thambnail_sm/'.$image_name_gen);

            $new_product_thambnail_image_with_path = 'uploads/images/product/thambnail/'.$image_name_gen;
            $new_thumbnail_sm_image = 'uploads/images/product/thambnail_sm/'.$image_name_gen;
            
            //update product table by id
            Product::findOrFail($id)->update([
                'thumbnail_image' => $new_product_thambnail_image_with_path,
                'thumbnail_sm_image' => $new_thumbnail_sm_image,
                'updated_at' => Carbon::now(),
            ]);


            return Redirect()->back()->with('success','Product thambnail changed');

        }
    }

    //add more product image multiple
    public function productimage_addmore($id)
    { 
        $this->checkvaliduser();
        $product_id = $id;
        return view('backend.admin.product.addmore_product_image', compact('product_id'));
    }
    public function productimage_addmore_upload(Request $request)
    { 
        $this->checkvaliduser();
        ini_set('max_execution_time', 300);

        $product_id = $request->product_id; 

        
        $product = Product::findOrFail($product_id);
        $product_category = Category::where('id',$product->category_id)->get(); 
        $product_brand = Brand::where('id',$product->brand_id)->get(); 
        $picname ="";
        if(count($product_category)>0)
        {
            $picname .= $product_category[0]->name_en;
        }
        if(count($product_brand)>0)
        {
            $picname .= '-'.$product_brand[0]->name_en;
        }
        $picname .= '-'.$product->model_no.'-'.$product->serial_no;

        
        //Product Multiple Image Upload with product id
        $productimage = $request->file('image');
        if($productimage)
        {
            $count = 1;
            foreach($productimage as $pimage)
            {
                if($count <=18)
                {
                    $ext = "";
                    $ext = $pimage->getClientOriginalExtension();
                    $imagefilename = $pimage->getClientOriginalName(); 
                    $preuploaddata = Product_multiple_image::where('product_id',$product_id)->where('imagefilename','like',$imagefilename)->get(); 
                    $loadedimage = 0; 
                    if(count($preuploaddata)>0)
                    {
                        $loadedimage = 1; 
                    }

                    if($loadedimage == 0)
                    { 
                        if($ext=='png'||$ext=='PNG'||$ext=='jpg'||$ext=='JPG'||$ext=='jpeg'||$ext=='JPEG'||$ext=='gif'||$ext=='GIF')
                        {
                            $name_gen = $picname."_".hexdec(uniqid()).'.'.$pimage->getClientOriginalExtension();
                            Image::make($pimage)->resize(640,480)->save('uploads/images/product/multipleimage_L/'.$name_gen);
                            Image::make($pimage)->resize(200,150)->save('uploads/images/product/multipleimage_ms/'.$name_gen);
                            Image::make($pimage)->resize(100,75)->save('uploads/images/product/multipleimage_sm/'.$name_gen);

                            //Insert image data 
                            $id = Product_multiple_image::insertGetId([
                                'product_id'=>$product_id,
                                'imagefilename'=>$imagefilename,
                                'image_L'=>'uploads/images/product/multipleimage_L/'.$name_gen,
                                'image_ms'=>'uploads/images/product/multipleimage_ms/'.$name_gen,
                                'image_sm'=>'uploads/images/product/multipleimage_sm/'.$name_gen,
                                'user_id' => Auth::user()->id,
                                'publish_status'=> 'publish', 
                                'created_at'=>Carbon::now(),
                            ]);
                            if($id !="")
                            {
                                Skproduct_multiple_images::insertGetId([ 	
                                    'productimageid' => $id,	
                                    'created_at'=> Carbon::now(),
                                ]);
                            }

                        }
                    }
                    $loadedimage = 0;
                    $count++;
                }
            }
        }

        return Redirect()->back()->with('success','Product image uploaded');
    }

    //edit productimage multiple
    public function edit_productimage($id,$selectedproduct)
    {
        $this->checkvaliduser();
        //get data
        $productimagedata = Product_multiple_image::find($id);
        $product_id = $selectedproduct;
        return view('backend.admin.product.productimage_edit', compact('productimagedata','product_id'));
    }

    //update productimage multiple
    public function update_productimage(Request $request,$id)
    {
        $this->checkvaliduser();
        //validation  
        $request->validate([
            'productimage' => 'required|mimes:jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF',
        ]);
        //productimageinfo before modify
        $pre_productimageinfo = Product_multiple_image::find($id);
        $product_id = $pre_productimageinfo->product_id;

        $product = Product::findOrFail($product_id);
        $product_category = Category::where('id',$product->category_id)->get(); 
        $product_brand = Brand::where('id',$product->brand_id)->get(); 

        $picname ="";
        if(count($product_category)>0)
        {
            $picname .= $product_category[0]->name_en;
        }
        if(count($product_brand)>0)
        {
            $picname .= '-'.$product_brand[0]->name_en;
        }
        $picname .= '-'.$product->model_no.'-'.$product->serial_no;
        

        $oldproductimage_L = $pre_productimageinfo->image_L;
        $oldproductimage_ms = $pre_productimageinfo->image_ms;
        $oldproductimage_sm = $pre_productimageinfo->image_sm;


        $productimage = $request->file('productimage');
        if($productimage)
        {
                $name_gen = $picname."_".hexdec(uniqid()).'.'.$productimage->getClientOriginalExtension();
                Image::make($productimage)->resize(640,480)->save('uploads/images/product/multipleimage_L/'.$name_gen);
                Image::make($productimage)->resize(200,150)->save('uploads/images/product/multipleimage_ms/'.$name_gen);
                Image::make($productimage)->resize(100,75)->save('uploads/images/product/multipleimage_sm/'.$name_gen);

                //delete old image
                if(file_exists($oldproductimage_L))
                {
                    unlink($oldproductimage_L);
                }
                if(file_exists($oldproductimage_ms))
                {
                    unlink($oldproductimage_ms);
                }
                if(file_exists($oldproductimage_sm))
                {
                    unlink($oldproductimage_sm);
                }
                

                //Insert image data 
                Product_multiple_image::find($id)->update([
                    'product_id'=>$product_id,
                    'image_L'=>'uploads/images/product/multipleimage_L/'.$name_gen,
                    'image_ms'=>'uploads/images/product/multipleimage_ms/'.$name_gen,
                    'image_sm'=>'uploads/images/product/multipleimage_sm/'.$name_gen,
                    'publish_status'=> 'publish',
                    'updated_at'=>Carbon::now(),
                ]);
        }

        return Redirect()->back()->with('success','Product image changed');
    }

    //delete productimage multiple
    public function delete_productimage($id)
    {
        $this->checkvaliduser();
        //Get info
        $productImagesData = Product_multiple_image::find($id); 
        $product_id = $productImagesData->product_id; 
        
        $productimage_L = $productImagesData->image_L;
        $productimage_ms = $productImagesData->image_ms;
        $productimage_sm = $productImagesData->image_sm;
        
        //delete info
        if(Skproduct_multiple_images::where('productimageid',$id)->delete())
        {
        }    
            if(Product_multiple_image::find($id)->delete())
            {
                //delete image
                if(file_exists($productimage_L))
                {
                    unlink($productimage_L);
                }
                if(file_exists($productimage_ms))
                {
                    unlink($productimage_ms);
                }
                if(file_exists($productimage_sm))
                {
                    unlink($productimage_sm);
                }
            }
        
        
        return redirect('product/imageview/'.$product_id);
    }
    //delete all productimage multiple
    public function delete_all_productimage($product_id)
    { 
        $this->checkvaliduser();
        //Get info
        $productImagesDatas = Product_multiple_image::where('product_id',$product_id)->get(); //dd($productImagesDatas);
        //$product_id = $productImagesData->product_id; 
        foreach($productImagesDatas as $productImagesData)
        {
            $productimage_L = $productImagesData->image_L;
            $productimage_ms = $productImagesData->image_ms;
            $productimage_sm = $productImagesData->image_sm;
            
            //delete info
            if(Skproduct_multiple_images::where('productimageid',$productImagesData->id)->delete())
            {
            }    
            if(Product_multiple_image::find($productImagesData->id)->delete())
            {
                //delete image
                if(file_exists($productimage_L))
                {
                    unlink($productimage_L);
                }
                if(file_exists($productimage_ms))
                {
                    unlink($productimage_ms);
                }
                if(file_exists($productimage_sm))
                {
                    unlink($productimage_sm);
                }
            }
        }
        
        
        return redirect('product/imageview/'.$product_id);
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    ////////////Product Video/////////////////////
    public function youtube_video_update(Request $request,$id)
    {
        $this->checkvaliduser();
        $request->validate([
            "videourl" => 'required',
        ]);
        //Update data
        Product::find($id)->update([	
            'videourl'=> $request->videourl, 	
            'updated_at'=>Carbon::now(),
        ]);

        return Redirect()->back()->with('success','Updated Successfully');
    }
    public function productvideo_view($product_id)
    {
        $this->checkvaliduser();
        $productvideos = Product_video::with('product')->where('product_id',$product_id)->paginate(10);
        $product = Product::find($product_id);
        return view('backend.admin.product_multiple_video.view_multiple_video', compact('productvideos','product'));
    }
    public function productvideo_addmore($product_id)
    {
        $this->checkvaliduser();
        $product = Product::find($product_id);
        return view('backend.admin.product_multiple_video.add_video_form',compact('product'));
    }
    public function productvideo_addmore_upload(Request $request, $product_id)
    {
        $this->checkvaliduser();
        
        $this->validate($request, [
            'videofile' =>'required|file|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,video/m4v,video/mov,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi,video/mpeg',
      ]);

      $product = Product::findOrFail($product_id);
      $product_category = Category::where('id',$product->category_id)->get(); 
      $product_brand = Brand::where('id',$product->brand_id)->get(); 
      $videoname ="";
        if(count($product_category)>0)
        {
            $videoname .= $product_category[0]->name_en;
        }
        if(count($product_brand)>0)
        {
            $videoname .= '-'.$product_brand[0]->name_en;
        }
        $videoname .= '-'.$product->model_no.'-'.$product->serial_no;

      
       
        if ($request->hasFile('videofile'))
        {
            $file = $request->file('videofile');
            $name_gen = $videoname.'_'.hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            //$file->move('uploads/videos/product/multiplevideo/', $file->getClientOriginalName());
            $file->move('uploads/videos/product/multiplevideo/', $name_gen);
            $id = Product_video::insertGetId([
                'product_id'=>$product_id,
                'video'=>'uploads/videos/product/multiplevideo/'.$name_gen,
                'user_id' => Auth::user()->id,
                'publish_status'=> 'publish', 
                'created_at'=>Carbon::now(),
            ]);
            if($id !="")
            {
                Skproduct_videos::insertGetId([ 	
                    'productvideoid' => $id,	
                    'created_at'=> Carbon::now(),
                ]);
            }

            return Redirect()->back()->with('success','Video uploaded');
        }
        else
        {
            return Redirect()->back()->with('error','Video file is required');
        }
    }

    public function edit_productvideo($product_video_id)
    {
        $this->checkvaliduser();
        $productvideo = Product_video::find($product_video_id);
        return view('backend.admin.product_multiple_video.edit_video_form', compact('productvideo'));
    }

    public function update_productvideo(Request $request, $productvideo_id)
    {
        $this->checkvaliduser();
        $this->validate($request, [
            'videofile' => 'required|file|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,video/m4v,video/mov,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi,video/mpeg,',
      ]);

      $product = Product::findOrFail($request->product_id);
      $product_category = Category::where('id',$product->category_id)->get(); 
      $product_brand = Brand::where('id',$product->brand_id)->get(); 
      $videoname ="";
        if(count($product_category)>0)
        {
            $videoname .= $product_category[0]->name_en;
        }
        if(count($product_brand)>0)
        {
            $videoname .= '-'.$product_brand[0]->name_en;
        }
        $videoname .= '-'.$product->model_no.'-'.$product->serial_no;
      
       
      $oldproductvideo = $request->oldproductvideo;
        if ($request->hasFile('videofile'))
        {
            //delete previous video
            if(file_exists($oldproductvideo))
            {
                unlink($oldproductvideo);
            } 

            //upload
            $file = $request->file('videofile');
            $name_gen = $videoname."_".hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $file->move('uploads/videos/product/multiplevideo/', $name_gen);
            //update data
            Product_video::find($productvideo_id)->update([
                'product_id'=>$request->product_id,
                'video'=>'uploads/videos/product/multiplevideo/'.$name_gen,
                'user_id' => Auth::user()->id,
                'publish_status'=> 'publish', 
                'updated_at'=>Carbon::now(),
            ]);

            return Redirect()->back()->with('success','Video updated');
        }
        else
        {
            return Redirect()->back()->with('error','Video file is required');
        }
    }

    public function delete_productvideo($productvideo_id)
    {
        $this->checkvaliduser();
        //Get info
        $productVideoData = Product_video::find($productvideo_id); 
        $product_id = $productVideoData->product_id; 
        $video = $productVideoData->video; 
        
        //delete info
        if(Skproduct_videos::where('productvideoid',$productvideo_id)->delete())
        {
            if(Product_video::find($productvideo_id)->delete())
            {
                //delete image
                if(file_exists($video))
                {
                    unlink($video);
                }
                return redirect('product/videoview/'.$product_id)->with('success','Video deleted');
            }
            else
            {
                return redirect('product/videoview/'.$product_id)->with('error-msg',"This brand has record, so can't delete");
            }
        }
        else
        {
            return redirect('product/videoview/'.$product_id)->with('error-msg',"This brand has record, so can't delete");
        }
    }

    ///////////////////////////////Product Enquiry ////////////////////////////////////////////////

    //product_enquiry_view
    // public function product_enquiry_view()
    // {
    //     $customer_enquiry = CustomerMail::with('product')->where('delete_status',0)->orderby('id','desc')->paginate(10);
    //     return view('backend.admin.product_enquiry.view', compact('customer_enquiry'));
    // }
    // //product_enquiry_view_details
    // public function product_enquiry_view_details($id)
    // {
    //     $customer_enquiry = CustomerMail::with('product')->find($id);
    //     return view('backend.admin.product_enquiry.view_details', compact('customer_enquiry'));
    // }
    // public function product_enquiry_delete($id)
    // {
    //     CustomerMail::find($id)->delete();
    //     return Redirect()->back()->with('success','Successfully  deleted');
    // }

    //product search unsold product
    public function search_unsold(Request $request)
    {
        $this->checkvaliduser();
        $this->validate($request, [
            'searchword' => 'required',
      ]);
        if($request->searchby == 0)
        {
            $products = Product::where('status','active')->where('final_result','unsold')->paginate(25);
        }
        else if($request->searchby == 'category')
        {
            $category ="";
            $products ="";
            $category = Category::where('name_en','like','%'.$request->searchword.'%')->take(1)->get(); 
            if($category !="")
            {
                $products = Product::where('category_id',$category[0]->id)->where('status','active')->where('final_result','unsold')->paginate(25);
            }
            if($products=="")
            {
                $products = Product::where('status','active')->where('final_result','unsold')->paginate(25);
            }
            
        }
        else if($request->searchby == 'pname')
        {
            $products="";
            if($request->searchword !="")
            {
                $products = Product::where('name_en','like','%'.$request->searchword.'%')->where('final_result','unsold')->paginate(25); 
            }
            if($products=="")
            {
                $products = Product::where('status','active')->where('final_result','unsold')->paginate(25);
            }
        }
        
        else if($request->searchby == 'brand')
        {
            $category ="";
            $products ="";
            $brand = Brand::where('name_en','like','%'.$request->searchword.'%')->take(1)->get(); 
            if($category !="")
            {
                $products = Product::where('brand_id',$brand[0]->id)->where('status','active')->where('final_result','unsold')->paginate(25);
            }
            if($products=="")
            {
                $products = Product::where('status','active')->where('final_result','unsold')->paginate(25);
            }
            
        }
        else if($request->searchby == 'model_no')
        {
            $products ="";
            if($request->searchword !="")
            {
                $products = Product::where('model_no','like','%'.$request->searchword.'%')->where('status','active')->where('final_result','unsold')->paginate(25);
            }
            if($products=="")
            {
                $products = Product::where('status','active')->where('final_result','unsold')->paginate(25);
            }
            
        }
        else if($request->searchby == 'model_year')
        {
            $products ="";
            if($request->searchword !="")
            {
                $products = Product::where('model_year','like','%'.$request->searchword.'%')->where('status','active')->where('final_result','unsold')->paginate(25);
            }
            if($products=="")
            {
                $products = Product::where('status','active')->where('final_result','unsold')->paginate(25);
            }
            
        }
        else if($request->searchby == 'delivery_place')
        {
            $products ="";
            if($request->searchword !="")
            {
                $products = Product::where('delivery_place','like','%'.$request->searchword.'%')->where('status','active')->where('final_result','unsold')->paginate(25);
            }
            if($products=="")
            {
                $products = Product::where('status','active')->where('final_result','unsold')->paginate(25);
            }
            
        }
        else if($request->searchby == 'all')
        {
            $products = Product::where('status','active')->where('final_result','unsold')->paginate(25);
        }
        return view('backend.admin.product.view_product_unsold',compact('products'));
    }

    /////
    public function search_sold(Request $request)
    {
        $this->checkvaliduser();
        $this->validate($request, [
            'searchword' => 'required',
      ]);
        if($request->searchby == "")
        {   //dd('paisi-1');
            $products = Product::where('status','active')->where('final_result','sold')->paginate(25);
        }
        if($request->searchby == 'category')
        {   //dd('paisi-2');
            $category ="";
            $products ="";
            $category = Category::where('name_en','like','%'.$request->searchword.'%')->take(1)->get(); 
            if($category !="")
            {
                $products = Product::where('category_id',$category[0]->id)->where('status','active')->where('final_result','sold')->paginate(25);
            }
            if($products=="")
            {
                $products = Product::where('status','active')->where('final_result','sold')->paginate(25);
            }
            
        }
        else if($request->searchby == 'pnum')
        {  //dd('paisi-3');
            $products="";
            if($request->searchword !="")
            {
                $products = Product::where('product_no','like','%'.$request->searchword.'%')->where('final_result','sold')->paginate(25); 
            }
            if($products=="")
            {
                $products = Product::where('status','active')->where('final_result','sold')->paginate(25);
            }
        }
        
        else if($request->searchby == 'brand')
        {
            $category ="";
            $products ="";
            $brand = Brand::where('name_en','like','%'.$request->searchword.'%')->take(1)->get(); 
            if($category !="")
            {
                $products = Product::where('brand_id',$brand[0]->id)->where('status','active')->where('final_result','sold')->paginate(25);
            }
            if($products=="")
            {
                $products = Product::where('status','active')->where('final_result','sold')->paginate(25);
            }
            
        }
        else if($request->searchby == 'model_no')
        {
            $products ="";
            if($request->searchword !="")
            {
                $products = Product::where('model_no','like','%'.$request->searchword.'%')->where('status','active')->where('final_result','sold')->paginate(25);
            }
            if($products=="")
            {
                $products = Product::where('status','active')->where('final_result','sold')->paginate(25);
            }
            
        }
        else if($request->searchby == 'model_year')
        {
            $products ="";
            if($request->searchword !="")
            {
                $products = Product::where('model_year','like','%'.$request->searchword.'%')->where('status','active')->where('final_result','sold')->paginate(25);
            }
            if($products=="")
            {
                $products = Product::where('status','active')->where('final_result','sold')->paginate(25);
            }
            
        }
        else if($request->searchby == 'delivery_place')
        {
            $products ="";
            if($request->searchword !="")
            {
                $products = Product::where('delivery_place','like','%'.$request->searchword.'%')->where('status','active')->where('final_result','sold')->paginate(25);
            }
            if($products=="")
            {
                $products = Product::where('status','active')->where('final_result','sold')->paginate(25);
            }
            
        }
        else if($request->searchby == 'all')
        {
            $products = Product::where('status','active')->where('final_result','sold')->paginate(25);
        }
        if($products=="")
        {
            $products = Product::where('status','active')->where('final_result','sold')->paginate(25);
        }
        return view('backend.admin.product.view_product_sold',compact('products'));
    }

    //winner_mail
    public function winner_mail($pid)
    {  
        $this->checkvaliduser();
        $actionpro = Product::find($pid); 
        /////send win mail to the maximum bidder////
        $product_max_bidder_id = $actionpro->auction_max_bidder_id;
        $bidder = Bidder_register::findOrFail($product_max_bidder_id);  
        $bidder_email1 = $bidder['email1'];  
        $bidder_email2 = $bidder['email2'];
        $companyname = $bidder['company_name'];
        $person_incharge = $bidder['person_incharge'];
        $biddercode = $bidder['usercodeno'];


        $data = [
            'companyname' => $companyname,
            'person_incharge' => $person_incharge,
            'biddercode' => $biddercode,
            'auctionno' => $actionpro->product_no,
            'name_en' => $actionpro->name_en,
            'name_jp' => $actionpro->name_jp,
            'thumbnail_image' => $actionpro->thumbnail_image,
            'thumbnail_sm_image' => $actionpro->thumbnail_sm_image,
            'product_no' => $actionpro->product_no,
            'end_time_of_auction' => $actionpro->end_time_of_auction,
            'bid_max_price' => $actionpro->auction_max_bid_amount,
            'modelno' => $actionpro->model_no,
            'serial_no' =>$actionpro->serial_no,
            'model_year' => $actionpro->model_year,
            'used_hour' => $actionpro->used_hour,
            'deliveryplace' => $actionpro->delivery_place,
            //'message' => $actionpro[0]->message,
        ];
        
        Mail::to($bidder_email1)->send(new auctionBidOwnMail($data));

        //$message = "Mail Sent...";
        return Redirect()->back()->with('success',"Mail Sent...");
    }

    public function bid_winner_mail($bidderid,$enddate)
    {  
        $this->checkvaliduser();
        $actionprolist = Product::where('auction_max_bidder_id',$bidderid)->where('auction_end','like',$enddate.'%')->where('final_result','sold')->get();
        foreach($actionprolist as $actionpro)
        {
            /////send win mail to the maximum bidder////
            $product_max_bidder_id = $actionpro->auction_max_bidder_id;
            $bidder = Bidder_register::findOrFail($product_max_bidder_id);  
            $bidder_email1 = $bidder['email1'];  
            $bidder_email2 = $bidder['email2'];
            $companyname = $bidder['company_name'];
            $person_incharge = $bidder['person_incharge'];
            $biddercode = $bidder['usercodeno'];


            $data = [
                'companyname' => $companyname,
                'person_incharge' => $person_incharge,
                'biddercode' => $biddercode,
                'auctionno' => $actionpro->product_no,
                'name_en' => $actionpro->name_en,
                'name_jp' => $actionpro->name_jp,
                'thumbnail_image' => $actionpro->thumbnail_image,
                'thumbnail_sm_image' => $actionpro->thumbnail_sm_image,
                'product_no' => $actionpro->product_no,
                'end_time_of_auction' => $actionpro->end_time_of_auction,
                'bid_max_price' => $actionpro->auction_max_bid_amount,
                'modelno' => $actionpro->model_no,
                'serial_no' =>$actionpro->serial_no,
                'model_year' => $actionpro->model_year,
                'used_hour' => $actionpro->used_hour,
                'deliveryplace' => $actionpro->delivery->name_jp,
                //'message' => $actionpro[0]->message,
            ];
            
            Mail::to($bidder_email1)->send(new auctionBidOwnMail($data));
        }

            //$message = "Mail Sent...";
            return Redirect()->back()->with('mail_success',"Mail Sent...");
        
        
    }

    public function product_Owner_mail($ownerid,$enddate)
    {  
        $this->checkvaliduser();
        $actionprolist = Product::where('woner_id',$ownerid)->where('auction_end','like',$enddate.'%')->where('final_result','sold')->get();
        /////send win mail to the maximum bidder////
        $deliverylist = Delivery_place::where('status','active')->get();
        $woner = Product_woner::findOrFail($ownerid);  
        $woner_email1 = $woner['email1'];  
        $companyname = $woner['company_name_jp'] !=""?$woner['company_name_jp']:$woner['company_name_en'];
        $person_incharge = $woner['person_incharge_jp'] !=""?$woner['person_incharge_jp']:$woner['person_incharge_en'];
        $wonercode = $woner['usercodeno'];

        $auctionsolddata = "";
        foreach($actionprolist as $d)
        {
            $deliveryplacename ="";
            for($i=0;$i<count($deliverylist);$i++)
            {
                if($deliverylist[$i]->id == $d->delivery_place_id)
                {
                    $deliveryplacename = $deliverylist[$i]->name_jp !=""?$deliverylist[$i]->name_jp:$deliverylist[$i]->name_en;
                }
            }
            $auctionsolddata .= "<br>". $d->product_no." ".$d->model_no."-".$d->serial_no."(".$deliveryplacename."ヤード入庫済) ¥ ".number_format($d->auction_max_bid_amount);
        }

        $data = [];
        $data['companyname'] = $companyname;
        $data['person_incharge'] = $person_incharge;
        $data['wonercode'] = $wonercode;
        $data['auctionsolddata'] = $auctionsolddata;
        
        
        Mail::to($woner_email1)->send(new auctionProductOwnerMail($data));

        //$message = "Mail Sent...";
        return Redirect()->back()->with('mail_success',"Mail Sent...");  
    }

    //invoice 
    public function customer_searchpage()
    {
        $this->checkvaliduser();
        $today = Carbon::now();
        $auctionlist = Auction::where('auction_end','<=',$today)->orderby('id','desc')->get(); 
        return view('backend.admin.product.customer_searchpage',compact('auctionlist'));
    }
    public function get_maximum_bidder_list(Request $request)
    {
        $this->checkvaliduser();
        //$start_time_of_action = $request->start_time_of_action;
        $end_time_of_action = $request->end_time_of_action;  
        //$startdt = new \DateTime($start_time_of_action);  
        $enddt = new \DateTime($end_time_of_action); 
        //$startdate = $startdt->format('Y-m-d');  //dd($startdate);
        $enddate = $enddt->format('Y-m-d');
        
        
        $products = Product::select("auction_max_bidder_id")
                    ->where('final_result','sold')
                    ->where('auction_max_bidder_id','!=',0)
                    ->where('auction_end','like',$enddate.'%')
                    ->distinct()->get(['auction_max_bidder_id']);
        
       if(count($products)>0)   
       {
        $productlist = Product::where('final_result','sold')
                    ->where('auction_max_bidder_id','!=',0)
                    ->where('auction_end','like',$enddate.'%')
                    ->get();
           $auction_id = $productlist[0]->auction_id; 
           /////////
           //get data from infoservice table by auction_id and pass it to auction_bidderlist_for_invoice page
           $infoservicelist = Infoservice::where('auction_id', $auction_id)->where('bidder_id','!=',"")->get();
           ////////
           $auction_max_bidder_ids ="";
           $count=0;
         foreach($products as $p)
         {
             if($count==0)
             {
                $auction_max_bidder_ids = $p->auction_max_bidder_id.',';
             }
             else if($count < count($products)-1)
             {
                $auction_max_bidder_ids .=$p->auction_max_bidder_id.',';
             }
             else
             {
                $auction_max_bidder_ids .=$p->auction_max_bidder_id;
             }
             $count++;
         }
         if($auction_max_bidder_ids !="")
         {
            //$ids = explode(",",$auction_max_bidder_ids);
            //dd($ids);
            $auctionmaxbidderlist = Bidder_register::whereIn('id', explode(",",$auction_max_bidder_ids))->paginate(25); //dd($auctionmaxbidderlist);
            return view('backend.admin.product.auction_bidderlist_for_invoice',compact('auctionmaxbidderlist','enddate','auction_id','infoservicelist'));
         }
         else
         {
            return Redirect()->back()->with('esuccess',"No data found");
         }  
       }
       else
       {
         return Redirect()->back()->with('esuccess',"No data found");
       }      
    }
    public function add_service($serviceno,$auctionid,$bidderid,$enddate)
    {
        $infoservicelist = Infoservice::where('auction_id', $auctionid)->where('bidder_id', $bidderid)->get();
        $mail_sent = 0;
        $printout = 0;
        $fax = 0;

        if($serviceno == 1)
        {
            if(count($infoservicelist)==0)
            {
                $id = Infoservice::insertGetId([
                    'auction_id'=>$auctionid,
                    'bidder_id'=>$bidderid,
                    'mail_sent'=>1,
                    'created_at'=>Carbon::now(),
                ]);
            }
            else
            {
                if($infoservicelist[0]->mail_sent == 0){$mail_sent = 1;}else{$mail_sent = 0;}
                Infoservice::where('auction_id', $auctionid)->where('bidder_id', $bidderid)->update([
                    'auction_id'=>$auctionid,
                    'bidder_id'=>$bidderid,
                    'mail_sent'=>$mail_sent,
                    'updated_at'=>Carbon::now(),
                ]);
            }
            return redirect()->route('auction.get_maximum_bidders_list', ['end_time_of_action' => $enddate])->with('message', 'activity updated');
        }
        else if($serviceno == 2)
        {
            if(count($infoservicelist)==0)
            {
                $id = Infoservice::insertGetId([
                    'auction_id'=>$auctionid,
                    'bidder_id'=>$bidderid,
                    'printout'=>1,
                    'created_at'=>Carbon::now(),
                ]);
            }
            else
            {
                if($infoservicelist[0]->printout == 0){$printout = 1;}else{$printout = 0;}
                Infoservice::where('auction_id', $auctionid)->where('bidder_id', $bidderid)->update([
                    'auction_id'=>$auctionid,
                    'bidder_id'=>$bidderid,
                    'printout'=>$printout,
                    'updated_at'=>Carbon::now(),
                ]);
            }
            return redirect()->route('auction.get_maximum_bidders_list', ['end_time_of_action' => $enddate])->with('message', 'activity updated');
        }
        else if($serviceno == 3)
        {
            if(count($infoservicelist)==0)
            {
                $id = Infoservice::insertGetId([
                    'auction_id'=>$auctionid,
                    'bidder_id'=>$bidderid,
                    'fax'=>1,
                    'created_at'=>Carbon::now(),
                ]);
            }
            else
            {
                if($infoservicelist[0]->fax == 0){$fax = 1;}else{$fax = 0;}
                Infoservice::where('auction_id', $auctionid)->where('bidder_id', $bidderid)->update([
                    'auction_id'=>$auctionid,
                    'bidder_id'=>$bidderid,
                    'fax'=>$fax,
                    'updated_at'=>Carbon::now(),
                ]);
            }
            return redirect()->route('auction.get_maximum_bidders_list', ['end_time_of_action' => $enddate])->with('message', 'activity updated');
        }
    }
    public function get_maximum_bidders_list($end_time_of_action)
    {
        $this->checkvaliduser();
          
        $enddt = new \DateTime($end_time_of_action); 
        //$startdate = $startdt->format('Y-m-d');  //dd($startdate);
        $enddate = $enddt->format('Y-m-d');
        
        
        $products = Product::select("auction_max_bidder_id")
                    ->where('final_result','sold')
                    ->where('auction_max_bidder_id','!=',0)
                    ->where('auction_end','like',$enddate.'%')
                    ->distinct()->get(['auction_max_bidder_id']);
        
       if(count($products)>0)   
       {
        $productlist = Product::where('final_result','sold')
                    ->where('auction_max_bidder_id','!=',0)
                    ->where('auction_end','like',$enddate.'%')
                    ->get();
           $auction_id = $productlist[0]->auction_id; 
           /////////
           //get data from infoservice table by auction_id and pass it to auction_bidderlist_for_invoice page
           $infoservicelist = Infoservice::where('auction_id', $auction_id)->get();
           ////////
           $auction_max_bidder_ids ="";
           $count=0;
         foreach($products as $p)
         {
             if($count==0)
             {
                $auction_max_bidder_ids = $p->auction_max_bidder_id.',';
             }
             else if($count < count($products)-1)
             {
                $auction_max_bidder_ids .=$p->auction_max_bidder_id.',';
             }
             else
             {
                $auction_max_bidder_ids .=$p->auction_max_bidder_id;
             }
             $count++;
         }
         if($auction_max_bidder_ids !="")
         {
            //$ids = explode(",",$auction_max_bidder_ids);
            //dd($ids);
            $auctionmaxbidderlist = Bidder_register::whereIn('id', explode(",",$auction_max_bidder_ids))->paginate(25); //dd($auctionmaxbidderlist);
            return view('backend.admin.product.auction_bidderlist_for_invoice',compact('auctionmaxbidderlist','enddate','auction_id','infoservicelist'));
         }
         else
         {
            return Redirect()->back()->with('esuccess',"No data found");
         }  
       }
       else
       {
         return Redirect()->back()->with('esuccess',"No data found");
       }      
    }
    //invoice_search_page
    public function invoice_search_page()
    {
        return view('backend.admin.product.invoice_search_page');
    }
    public function invoice_search(Request $request)
    {
        $this->checkvaliduser();

        $invoicetype = $request->invoicetype;
        $invoiceno = $request->invoiceno;


        if($invoicetype == 'WDY')
        {
            $invoicelist = Customerinvoice::where('invoiceno','like','WDY'.$invoiceno)->get();
            if(count($invoicelist)>0)
            {
                $id = $invoicelist[0]->userid;
                $enddate = $invoicelist[0]->invoicedate;
                $invoiceno = $invoicelist[0]->invoiceno;
                
                $products = Product::where('final_result','sold')
                            ->where('auction_max_bidder_id','=',$id)
                            ->where('auction_end','like', $enddate.'%')
                            ->get();

                $time_input = strtotime($enddate); 
                $enddate = date('Y-m-d', $time_input); 
                $auctionYear = date('Y', $time_input);
                $auctionMonth = date('m', $time_input);
                $auctionDay = date('d', $time_input);

                $auctionmaxbidderinfo = Bidder_register::find($id);
                $deliveryplaces = Delivery_place::latest()->get(); 
                
                $bidder_id = $id;
                return view('backend.admin.product.customer_fax',compact('bidder_id','products','auctionmaxbidderinfo','invoiceno','enddate','auctionYear','auctionMonth','auctionDay','deliveryplaces'));
            }
            else
            {
                return Redirect()->back()->with('errormsg','Invalid invoice number');
            }
            
        }
        else if($invoicetype == 'O-WDY')
        {
            $invoicelist = Ownerinvoice::where('invoiceno','like','O-WDY'.$invoiceno)->get();
            if(count($invoicelist)>0)
            {
                $id = $invoicelist[0]->userid;
                $enddate = $invoicelist[0]->invoicedate;
                $invoiceno = $invoicelist[0]->invoiceno;

                $products = Product::where('final_result','sold')
                            ->where('auction_max_bidder_id','=',$id)
                            ->where('auction_end','like', $enddate.'%')
                            ->get();
                
                $time_input = strtotime($enddate); 
                $enddate = date('Y-m-d', $time_input); 
                $auctionYear = date('Y', $time_input);
                $auctionMonth = date('m', $time_input);
                $auctionDay = date('d', $time_input);

                $auctionmaxbidderinfo = Bidder_register::find($id);
                $deliveryplaces = Delivery_place::latest()->get(); 
                
                $bidder_id = $id;
                return view('backend.admin.product.auction_product_owner_fax',compact('bidder_id','products','auctionmaxbidderinfo','invoiceno','enddate','auctionYear','auctionMonth','auctionDay','deliveryplaces'));
            }
            else
            {
                return Redirect()->back()->with('errormsg','Invalid invoice number');
            }
        }
        else
            {
                return Redirect()->back()->with('errormsg','Invalid invoice number');
            }

    }


    //bidder_winner_invoice
    public function bidder_winner_invoice($sl,$id,$enddate)
    {
        $this->checkvaliduser();
        $products = Product::where('final_result','sold')
                    ->where('auction_max_bidder_id','=',$id)
                    ->where('auction_end','like', $enddate.'%')
                    ->get();
        $auctionmaxbidderinfo = Bidder_register::find($id);
        $deliveryplaces = Delivery_place::latest()->get(); 

        $time_input = strtotime($enddate); 
        $enddate = date('Y-m-d', $time_input); 
        $auctionYear = date('Y', $time_input);
        $auctionMonth = date('m', $time_input);
        $auctionDay = date('d', $time_input);
        //
        $invoicedatetime = $auctionYear.$auctionMonth.$auctionDay;
        if($sl < 10)
        {
            $sl = '0000'.$sl;
        }
        else
        {
            $sl = '000'.$sl;
        }
        $Ownerinvoicelist = Customerinvoice::where('invoiceno','like','WDY'.$invoicedatetime.$sl)->get();
        $invoiceno = 'WDY'.$auctionYear.$auctionMonth.$auctionDay.$sl;
        if(count($Ownerinvoicelist)==0)
        {
            Customerinvoice::insertGetId([
                'invoiceno' => $invoiceno,
                'userid' => $id,
                'invoicedate' => $enddate,
                'created_at'=>Carbon::now(),
            ]);
        }
        
        //
        
        $bidder_id = $id;
        return view('backend.admin.product.customer_fax',compact('bidder_id','products','auctionmaxbidderinfo','invoiceno','enddate','auctionYear','auctionMonth','auctionDay','deliveryplaces'));
    }
    //Auction Product Owner Search for invoice
    public function owner_searchpage()
    {
        $this->checkvaliduser();
        $today = Carbon::now();
        $auctionlist = Auction::where('auction_end','<=',$today)->orderby('id','desc')->get();
        return view('backend.admin.product.owner_searchpage',compact('auctionlist'));
    }
    public function get_sold_product_owner_list(Request $request)
    {
        $this->checkvaliduser();
        //$start_time_of_action = $request->start_time_of_action;
        $end_time_of_action = $request->end_time_of_action;  
        //$startdt = new \DateTime($start_time_of_action);  
        $enddt = new \DateTime($end_time_of_action); 
        //$startdate = $startdt->format('Y-m-d');  //dd($startdate);
        $enddate = $enddt->format('Y-m-d');
        
        
        $products = Product::select("woner_id")
                    ->where('final_result','sold')
                    ->where('auction_max_bidder_id','!=',0)
                    ->where('woner_id','!=',0)
                    ->where('auction_end','like',$enddate.'%')
                    ->distinct()->get(['woner_id']);
                    
       //dd($products);    
       if(count($products)>0)   
       {

            $productlist = Product::where('final_result','sold')
            ->where('auction_max_bidder_id','!=',0)
            ->where('auction_end','like',$enddate.'%')
            ->get();
            $auction_id = $productlist[0]->auction_id; 

            /////////
           //get data from infoservice table by auction_id and pass it to auction_bidderlist_for_invoice page
           $infoservicelist = Infoservice::where('auction_id', $auction_id)->where('owner_id', '!=',"")->get();
           ////////

            /////////////

           $auction_product_owner_ids ="";
           $count=0;
         foreach($products as $p)
         {
             if($count==0)
             {
                $auction_product_owner_ids = $p->woner_id.',';
             }
             else if($count < count($products)-1)
             {
                $auction_product_owner_ids .=$p->woner_id.',';
             }
             else
             {
                $auction_product_owner_ids .=$p->woner_id;
             }
             $count++;
         }
         if($auction_product_owner_ids !="")
         {
            //$ids = explode(",",$auction_max_bidder_ids);
            //dd($ids);
            $auctionproductownerlist = Product_woner::whereIn('id', explode(",",$auction_product_owner_ids))->paginate(25); //dd($auctionmaxbidderlist);
            return view('backend.admin.product.auction_product_owner_list_for_invoice',compact('auctionproductownerlist','enddate','auction_id','infoservicelist'));
         }
         else
         {
            return Redirect()->back()->with('esuccess',"No data found");
         }  
       }
       else
       {
         return Redirect()->back()->with('esuccess',"No data found");
       } 
    }

    public function add_owner_service($serviceno,$auctionid,$ownerid,$enddate)
    {
        $infoservicelist = Infoservice::where('auction_id', $auctionid)->where('owner_id', $ownerid)->get();
        $mail_sent = 0;
        $printout = 0;
        $fax = 0;

        if($serviceno == 1)
        {
            if(count($infoservicelist)==0)
            {
                $id = Infoservice::insertGetId([
                    'auction_id'=>$auctionid,
                    'owner_id'=>$ownerid,
                    'mail_sent'=>1,
                    'created_at'=>Carbon::now(),
                ]);
            }
            else
            {
                if($infoservicelist[0]->mail_sent == 0){$mail_sent = 1;}else{$mail_sent = 0;}
                Infoservice::where('auction_id', $auctionid)->where('owner_id', $ownerid)->update([
                    'mail_sent'=>$mail_sent,
                    'updated_at'=>Carbon::now(),
                ]);
            }
            return redirect()->route('auction.get_sold_product_owners_list', ['end_time_of_action' => $enddate])->with('message', 'activity updated');
        }
        else if($serviceno == 2)
        {
            if(count($infoservicelist)==0)
            {
                $id = Infoservice::insertGetId([
                    'auction_id'=>$auctionid,
                    'owner_id'=>$ownerid,
                    'printout'=>1,
                    'created_at'=>Carbon::now(),
                ]);
            }
            else
            {
                if($infoservicelist[0]->printout == 0){$printout = 1;}else{$printout = 0;}
                Infoservice::where('auction_id', $auctionid)->where('owner_id', $ownerid)->update([
                    'printout'=>$printout,
                    'updated_at'=>Carbon::now(),
                ]);
            }
            return redirect()->route('auction.get_sold_product_owners_list', ['end_time_of_action' => $enddate])->with('message', 'activity updated');
        }
        else if($serviceno == 3)
        {
            if(count($infoservicelist)==0)
            {
                $id = Infoservice::insertGetId([
                    'auction_id'=>$auctionid,
                    'owner_id'=>$ownerid,
                    'fax'=>1,
                    'created_at'=>Carbon::now(),
                ]);
            }
            else
            {
                if($infoservicelist[0]->fax == 0){$fax = 1;}else{$fax = 0;}
                Infoservice::where('auction_id', $auctionid)->where('owner_id', $ownerid)->update([
                    'fax'=>$fax,
                    'updated_at'=>Carbon::now(),
                ]);
            }
            return redirect()->route('auction.get_sold_product_owners_list', ['end_time_of_action' => $enddate])->with('message', 'activity updated');
        }
    }

    public function get_sold_product_owners_list($end_time_of_action)
    {
        $this->checkvaliduser();
        //$start_time_of_action = $request->start_time_of_action;
        //$end_time_of_action = $end_time_of_action;  
        //$startdt = new \DateTime($start_time_of_action);  
        $enddt = new \DateTime($end_time_of_action); 
        //$startdate = $startdt->format('Y-m-d');  //dd($startdate);
        $enddate = $enddt->format('Y-m-d');
        
        
        $products = Product::select("woner_id")
                    ->where('final_result','sold')
                    ->where('woner_id','!=',0)
                    ->where('auction_end','like',$enddate.'%')
                    ->distinct()->get(['woner_id']);
                    
       //dd($products);    
       if(count($products)>0)   
       {

            $productlist = Product::where('final_result','sold')
            ->where('auction_max_bidder_id','!=',0)
            ->where('auction_end','like',$enddate.'%')
            ->get();
            $auction_id = $productlist[0]->auction_id; 

            /////////
           //get data from infoservice table by auction_id and pass it to auction_bidderlist_for_invoice page
           $infoservicelist = Infoservice::where('auction_id', $auction_id)->get();
           ////////

            /////////////

           $auction_product_owner_ids ="";
           $count=0;
         foreach($products as $p)
         {
             if($count==0)
             {
                $auction_product_owner_ids = $p->woner_id.',';
             }
             else if($count < count($products)-1)
             {
                $auction_product_owner_ids .=$p->woner_id.',';
             }
             else
             {
                $auction_product_owner_ids .=$p->woner_id;
             }
             $count++;
         }
         if($auction_product_owner_ids !="")
         {
            //$ids = explode(",",$auction_max_bidder_ids);
            //dd($ids);
            $auctionproductownerlist = Product_woner::whereIn('id', explode(",",$auction_product_owner_ids))->paginate(25); //dd($auctionmaxbidderlist);
            return view('backend.admin.product.auction_product_owner_list_for_invoice',compact('auctionproductownerlist','enddate','auction_id','infoservicelist'));
         }
         else
         {
            return Redirect()->back()->with('esuccess',"No data found");
         }  
       }
       else
       {
         return Redirect()->back()->with('esuccess',"No data found");
       } 
    }

    public function product_owner_invoice($sl,$id,$enddate)
    {
        $this->checkvaliduser();
        $products = Product::select("*")
                    ->where('final_result','sold')
                    ->where('woner_id','=',$id)
                    ->where('auction_end','like',$enddate.'%')
                    ->get();
        $auctionproductownerinfo = Product_woner::find($id);

        $time_input = strtotime($enddate); 
        $enddate = date('Y-m-d', $time_input); 
        $auctionYear = date('Y', $time_input);
        $auctionMonth = date('m', $time_input);
        $auctionDay = date('d', $time_input);

        $invoicedatetime = $auctionYear.$auctionMonth.$auctionDay;
        if($sl < 10)
        {
            $sl = '0000'.$sl;
        }
        else
        {
            $sl = '000'.$sl;
        }
        $Ownerinvoicelist = Ownerinvoice::where('invoiceno','like','O-WDY'.$invoicedatetime.$sl)->get();
        $invoiceno = 'O-WDY'.$auctionYear.$auctionMonth.$auctionDay.$sl; 
        if(count($Ownerinvoicelist)==0)
        {
            Ownerinvoice::insertGetId([
                'invoiceno' => $invoiceno,
                'userid' => $id,
                'invoicedate' => $enddate,
                'created_at'=>Carbon::now(),
            ]);
        }
       
        
        $woner_id = $id;
        
        $commissionpercent = 5; 
        return view('backend.admin.product.auction_product_owner_fax',compact('woner_id','products','auctionproductownerinfo','invoiceno','commissionpercent','enddate','auctionYear','auctionMonth','auctionDay'));
    }

    //edit_for_invoice
    public function edit_for_invoice($id)
    {
        $this->checkvaliduser();
        //get product info by id
        $product = Product::findOrFail($id); 
        $categories = Category::where('status','active')->get(); 
        $brands = Brand::where('status','active')->get(); 
        $product_woners = Product_woner::where('status','active')->get(); 
        return view('backend.admin.auction.edit_auction_product_for_invoice',compact('product','categories','brands','product_woners'));
    }
    public function update_for_invoice(Request $request, $id)
    {
        $this->checkvaliduser();
        //Update data
        Product::find($id)->update([
            'entry_fee' => str_replace("," , "" ,$request->entry_fee),
            'inspection_fee' => str_replace("," , "" ,$request->inspection_fee),
            'other_fee' => str_replace("," , "" ,$request->other_fee),
            'auction_charge' => str_replace("," , "" ,$request->auction_charge),
            'yard_charge' => str_replace("," , "" ,$request->yard_charge),
            'extra_charge' => str_replace("," , "" ,$request->extra_charge),
            'releasing_charge' => str_replace("," , "" ,$request->releasing_charge),
            'user_id'=> Auth::user()->id,
            'updated_at'=> Carbon::now(),
        ]);

        return Redirect()->back()->with('success','Updated Successfully');
    }

    //sold_product_return_as_unsold
    public function sold_product_return_as_unsold($id)
    {
        $product = Product::findOrFail($id);
        return view('backend.admin.product.sold_product_return_as_unsold',compact('id','product'));
    }
    //return_as_unsold
    public function return_as_unsold(Request $request)
    {
        
        $request->validate([
            "id" => 'required',
            "product_return_note" => 'required'
        ]);
        
        Product::find($request->id)->update([
            
            'auction_max_autobid_amount'=>0,
            'auction_max_bid_amount'=>0,
            'auction_max_bidder_id'=>0,
            'auction_2ndmax_bid_amount'=>0,
            'auction_2ndmax_bidder_id'=>0,
            
            
            'higest_bidding_price' => 0,
            'auction_date' => null,
            'start_time_of_auction' =>"",
            'end_time_of_auction' =>"",
            'auction_start' => null,
            'auction_end' => null,

            'auction_product'=>0,
            
            'bid_system' => 'bid',
            'total_bids' =>0,
            'bidders'=>"",
            'bidding_result' => "",
            'final_result' => 'unsold',
            'state'=> 2,

            'product_return_note' => $request->product_return_note,

            'user_id'=> Auth::user()->id,
            'updated_at'=> Carbon::now(),
        ]);

        //Skauction_histories::where('product_id',$request->id)->delete();
        AuctionHistory::where('product_id',$request->id)->update([
            'product_return'=>1,
            'bid_time'=>NULL,
            'updated_at'=> Carbon::now(),
        ]);
        Bidder_register::where('selection','!=',"")->update([
            'selection'=>"",
            'updated_at'=> Carbon::now(),
        ]);

        return redirect('product/view_sold')->with('success','Removed from sold product Successfully');
    }
    //
    public function view_productlist_waiting_for_approve()
    {
        $this->checkvaliduser();
        $products = Product::latest()->where('auction_product',0)->where('state',1)->where('final_result','unsold')->where('whoadd',1)->get();
        $menuname = "Product";
        return view('backend.admin.product.view_productlist_waiting_for_approve',compact('products','menuname'));
        
    }
    //member_product_approve
    public function member_product_approve($id)
    {
        Product::find($id)->update([
             	
            'state'=> 2, //waiting for auction	
            
            'updated_at'=>Carbon::now(),
        ]);
        return response()->json("success");
    }
    //member_needtoedit
    public function member_needtoedit($id)
    {
        Product::find($id)->update([
             	
            'state'=> 4, //need to update
            'updated_at'=>Carbon::now(),
        ]);
        return response()->json("success");
    }





}
