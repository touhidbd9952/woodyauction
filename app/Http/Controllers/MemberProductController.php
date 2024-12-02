<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Delivery_place;
use App\Models\Bidder_register;
use App\Models\Product_woner;
use App\Models\Product;
use App\Models\Product_multiple_image;
use App\Models\Skproduct_multiple_images;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;

class MemberProductController extends Controller
{
    // public function __construct()
    // {
    //     $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }        
    // }
    public function check_session()
    {
        $memberid = 0;
        $memberid = Session::get('loggermemberid') ;
        return $memberid;
    }
    public function member_dashboard()
    {
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }
        //$memberid = $this->check_session();
        
        $userdata ="";
        $userdata = Bidder_register::where('id',$memberid)->get(); 
        
        return view('backend.member.member_dashboard',compact('userdata'));
    }
    public function member_profile()
    {
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }
        
        $userdata ="";
        $userdata = Product_woner::where('id',$memberid)->get(); 
        return view('backend.member.member_profile',compact('userdata'));
    }
    public function member_product_add_form()
    {
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }

        $categories = Category::where('status','active')->orderby('name_en','asc')->get(); 
        $brands = Brand::where('status','active')->orderby('name_en','asc')->get(); 
        $deliveryplaces = Delivery_place::where('status','active')->orderby('name_en','asc')->get(); 
        return view('backend.member.member_product_add_form',compact('categories','brands','deliveryplaces'));
    }
    public function member_product_store(Request $request)
    {
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }

        $request->validate([
            "category_id" => 'required',
            "model_no" => 'max:255',
            "serial_no" => 'max:255',
            "model_year" => 'max:255',
            "used_hour" => 'max:20',
            "buy_price" => 'max:40',
            "sale_price" => 'max:40',
            "bid_start_price" =>'required',
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
            'bid_start_price' => $request->bid_start_price==""?0.00:str_replace( ',', '',$request->bid_start_price),
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
            'woner_id'=> Session::get('loggermemberid'), 	
            'user_id'=> Session::get('loggermemberid'),	
            'stock'=> $request->stock, 	
            'status'=> 'inactive', //product just added, need to supervision by admin, if ok then an admin will change it to active
            'state' => 0,  //new entry	
            'whoadd' => 1, //member added this product
            'created_at'=> Carbon::now(),
        ]);   
        if($id)
        {     
            return redirect('member_product/imageview/'.$id)->with('success','Saved Successfully. Please Add More Multiple Image');
        }
        else{
            return Redirect()->back()->with('error','Data could not save, try agrain');
        }
    }
    //multiple image
    public function imageview($id)
    {
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }

        $selectedproduct = Product::find($id);  
        $productmultipleimages = Product_multiple_image::where('product_id', $id)->get(); 
        return view('backend.member.product_multiple_image.view_multiple_image',compact('selectedproduct','productmultipleimages'));
    }
    //edit product thumbnail image
    public function edit_productthumbnailimage($id)
    {
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }

        $product = Product::findOrFail($id);
        $product_id = $id;
        return view('backend.member.edit_productthumbnailimage',compact('product','product_id'));
    }
    public function change_thumbnail(Request $request,$id)
    {
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }
        //dd($request->all());
        $request->validate([
            'thumbnail_image' => 'required|mimes:jpeg,jpg,png,gif'
        ]);

        $old_thumnail = $request->old_thumnail;
        $new_product_thambnail = $request->file('thumbnail_image');
        if(is_file($new_product_thambnail))
        {
            //delete old image
            if(is_file($old_thumnail))
            {
                unlink($old_thumnail);
            }
            
            //create new image
            $image_name_gen = hexdec(uniqid()).'.'.$new_product_thambnail->getClientOriginalExtension();
            Image::make($new_product_thambnail)->resize(600,600)->save('uploads/images/product/thambnail/'.$image_name_gen);

            $new_product_thambnail_image_with_path = 'uploads/images/product/thambnail/'.$image_name_gen;
            
            //update product table by id
            Product::findOrFail($id)->update([
                'thumbnail_image' => $new_product_thambnail_image_with_path,
                'updated_at' => Carbon::now(),
            ]);


            return Redirect()->back()->with('success','Product thambnail changed');

        }
    }
    //add more product image multiple
    public function productimage_addmore($id)
    { 
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }

        $product_id = $id;
        return view('backend.member.addmore_product_image', compact('product_id'));
    }
    public function productimage_addmore_upload(Request $request)
    { 
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }

        $product_id = $request->product_id; 

        //Product Multiple Image Upload with product id
        $productimage = $request->file('image');
        if($productimage)
        {
            foreach($productimage as $pimage)
            {
                $ext = $pimage->getClientOriginalExtension();
                if($ext=='png'||$ext=='PNG'||$ext=='jpg'||$ext=='JPG'||$ext=='jpeg'||$ext=='JPEG'||$ext=='gif'||$ext=='GIF')
                {
                    
                    $imagefilename = $pimage->getClientOriginalName(); 
                    $name_gen = hexdec(uniqid()).'.'.$pimage->getClientOriginalExtension();
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
                        'user_id' => Session::get('loggermemberid'),
                        'publish_status'=> 'publish', 
                        'created_at'=>Carbon::now(),
                    ]);

                }
            }
        }

        return Redirect()->back()->with('success','Product image uploaded');
    }
    public function delete_all_productimage($product_id)
    { 
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }

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
        
        
        return redirect('member_product/imageview/'.$product_id);
    }
    //edit productimage multiple
    public function edit_productimage($id,$selectedproduct)
    {
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }
        //get data
        $productimagedata = Product_multiple_image::find($id);
        return view('backend.member.productimage_edit', compact('productimagedata'));
    }
    //update productimage multiple
    public function update_productimage(Request $request,$id)
    {
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }

        //validation  
        $request->validate([
            'productimage' => 'required|mimes:jpg,jpeg,png,gif',
        ]);
        //productimageinfo before modify
        $pre_productimageinfo = Product_multiple_image::find($id);
        $product_id = $pre_productimageinfo->product_id;
        //$oldproductimage = $pre_productimageinfo->image;

        $oldproductimage_L = $pre_productimageinfo->image_L;
        $oldproductimage_ms = $pre_productimageinfo->image_ms;
        $oldproductimage_sm = $pre_productimageinfo->image_sm;


        $productimage = $request->file('productimage');
        if($productimage)
        {
            $imagefilename = $productimage->getClientOriginalName(); 
            $name_gen = hexdec(uniqid()).'.'.$productimage->getClientOriginalExtension();
            Image::make($productimage)->resize(640,480)->save('uploads/images/product/multipleimage_L/'.$name_gen);
            Image::make($productimage)->resize(200,150)->save('uploads/images/product/multipleimage_ms/'.$name_gen);
            Image::make($productimage)->resize(100,75)->save('uploads/images/product/multipleimage_sm/'.$name_gen);

            //delete old image
            if(is_file($oldproductimage_L))
            {
                unlink($oldproductimage_L);
            }
            if(is_file($oldproductimage_ms))
            {
                unlink($oldproductimage_ms);
            }
            if(is_file($oldproductimage_sm))
            {
                unlink($oldproductimage_sm);
            }
            

            //Insert image data 
            Product_multiple_image::find($id)->update([
                'product_id'=>$product_id,
                'imagefilename'=>$imagefilename,
                'image_L'=>'uploads/images/product/multipleimage_L/'.$name_gen,
                'image_ms'=>'uploads/images/product/multipleimage_ms/'.$name_gen,
                'image_sm'=>'uploads/images/product/multipleimage_sm/'.$name_gen,
                'user_id' => Session::get('loggermemberid'),
                'publish_status'=> 'publish',
                'updated_at'=>Carbon::now(),
            ]);

        }

        return Redirect()->back()->with('success','Product image changed');
    }
    //delete productimage multiple
    public function delete_productimage($id)
    {
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }

        //Get info
        $productImagesData = Product_multiple_image::find($id); 
        $product_id = $productImagesData->product_id; 
        //$image = $productImagesData->image; 
        $productimage_L = $productImagesData->image_L;
        $productimage_ms = $productImagesData->image_ms;
        $productimage_sm = $productImagesData->image_sm;
        
        //delete info
        Product_multiple_image::find($id)->delete();
        //delete image
        if(is_file($productimage_L))
        {
            unlink($productimage_L);
        }
        if(is_file($productimage_ms))
        {
            unlink($productimage_ms);
        }
        if(is_file($productimage_sm))
        {
            unlink($productimage_sm);
        }
        
        return redirect('member_product/imageview/'.$product_id);
    }

    //viewbyid
    public function viewbyid($id)
    { 
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }
        //get product info by id
        $product = Product::findOrFail($id); 
        $categories = Category::where('status','active')->orderby('name_en','asc')->get(); 
        $brands = Brand::where('status','active')->orderby('name_en','asc')->get(); 
        $deliveryplaces = Delivery_place::where('status','active')->orderby('name_en','asc')->get(); 
        return view('backend.member.member_product_edit_form',compact('product','categories','brands','deliveryplaces'));
    }
    public function edit($id)
    { 
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }
        //get product info by id
        $product = Product::findOrFail($id); 
        $categories = Category::where('status','active')->orderby('name_en','asc')->get(); 
        $brands = Brand::where('status','active')->orderby('name_en','asc')->get(); 
        $deliveryplaces = Delivery_place::where('status','active')->orderby('name_en','asc')->get(); 
        return view('backend.member.member_product_edit_form',compact('product','categories','brands','deliveryplaces'));
    }

    //product update
    public function update(Request $request, $id)
    {
        //checkvaliduser
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }
         
        $request->validate([
            "category_id" => 'required',
            "model_no" => 'max:255',
            "serial_no" => 'max:255',
            "model_year" => 'max:255',
            "used_hour" => 'max:20',
            "buy_price" => 'max:40',
            "sale_price" => 'max:40',
            "bid_start_price" =>'required',
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
            'bid_start_price' => $request->bid_start_price==""?0.00:str_replace( ',', '',$request->bid_start_price),
            //'buy_price'=> $request->buy_price, 	
            //'sale_price'=> $request->sale_price, 	
            'short_description'=> $request->short_description, 	
            'short_description_jp'=> $request->short_description_jp, 	
            'long_description'=> $request->long_description, 	
            'long_description_jp'=> $request->long_description_jp, 	
            'delivery_place_id'=> $request->delivery_place_id,
            'delivery_status'=> $request->delivery_status, 	
            // 'releasing_charge'=> str_replace( ',', '',$request->releasing_charge), 	
            // 'allow_comment'=> $request->allow_comment, 	
            // 'woner_id'=> $request->woner_id, 	
            // 'user_id'=> Auth::user()->id,	
            // 'stock'=> $request->stock, 	
            // 'status'=> $request->status,
            'updated_at'=>Carbon::now(),
        ]);

        return Redirect()->back()->with('success','Updated Successfully');
    }


    //view condition report
    public function view_condition_report($id)
    {
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }
        $product = Product::findOrFail($id); 
        $conditional_report = $product->conditional_report; 
        return view('backend.member.view_conditional_report',compact('conditional_report'));
    }
    

    public function view_newlyadded_productlist()
    {
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }

        //$loggermemberid = Session::get('loggermemberid') ;
        $products = Product::latest()->where('auction_product',0)->where('state',0)->where('final_result','unsold')->where('woner_id',$memberid)->get();
        $menuname = "Product";
        return view('backend.member.view_newlyadded_productlist',compact('products','menuname'));
    }
    //request_for_approve
    public function request_for_approve($id)
    {
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }
        Product::find($id)->update([
             	
            'state'=> 1, 	
            'updated_at'=>Carbon::now(),
        ]);
        return response()->json("success");
    }
    //view_productlist_waiting_for_correction
    public function view_productlist_waiting_for_correction()
    {
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }

        //$loggermemberid = Session::get('loggermemberid') ;
        $products = Product::latest()->where('auction_product',0)->where('state',4)->where('final_result','unsold')->where('woner_id',$memberid)->get();
        $menuname = "Member Request";
        return view('backend.member.view_productlist_waiting_for_correction',compact('products','menuname'));
        
    }
    public function view_productlist_waiting_for_approve()
    {
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }

        //$loggermemberid = Session::get('loggermemberid') ;
        $products = Product::latest()->where('auction_product',0)->where('state',1)->where('final_result','unsold')->where('woner_id',$memberid)->get();
        $menuname = "Member Request";
        return view('backend.member.view_productlist_waiting_for_approve',compact('products','menuname'));
        
    }
    public function view_productlist_waiting_for_auction()
    {
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }

        $products = Product::latest()->where('auction_product',0)->where('state',2)->where('final_result','unsold')->where('woner_id',$memberid)->get();
        $menuname = "Member Request";
        return view('backend.member.view_productlist_waiting_for_auction',compact('products','menuname'));
        
    }
    public function view_productlist_current_auction()
    {
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }

        $products = Product::latest()->where('auction_product',1)->where('final_result','unsold')->where('state',3)->where('woner_id',$memberid)->get();
        $menuname = "Member Request";
        return view('backend.member.view_productlist_current_auction',compact('products','menuname'));
        
    }
    //view_productlist_out_of_auction
    public function view_productlist_out_of_auction()
    {
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }

        $products = Product::latest()->where('auction_product',0)->where('state',5)->where('final_result','unsold')->where('woner_id',$memberid)->get();
        $menuname = "Member Request";
        return view('backend.member.view_productlist_out_of_auction',compact('products','menuname'));
    }
    public function view_auction_sold__product_list()
    {
        $memberid = $this->check_session(); if($memberid == 0){Session::flush();return Redirect()->route('/'); }
        $products = Product::latest()->where('auction_product',1)->where('state',3)->where('final_result','sold')->where('woner_id',$memberid)->get();
        $menuname = "Member Request";
        return view('backend.member.view_auction_sold__product_list',compact('products','menuname'));
    }
}
