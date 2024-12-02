<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Models\Product_multiple_image;
use App\Models\Product_multiple_video;
use App\Models\CustomerMail;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function add_form()
    {
        $categories = Category::where('publish_status','publish')->get(); 
        
        return view('admin.product.add_product', compact('categories'));
    }

    //Product store
    public function store(Request $request)
    {
        //dd($request->all());
        //validation  
        $request->validate([
            'cat_id' => 'required',
            //'title' => 'required|max:255',
            //'title_jp' => 'required|max:255',
            'thumbnail_image' => 'required|mimes:jpg,jpeg,png,gif',
        ],
        [
            //'title.required' => 'Product title Required',
            //'title.max' => 'Maximum 255 chars',
            //'title_jp.required' => 'Product Title In Japanese Required',
            //'title_jp.max' => 'Maximum 255 chars',
        ]);

        //dd($request->all());
        
        $product_thambnail = $request->file('thumbnail_image'); 
        $product_thambnail_name_gen = hexdec(uniqid()).'.'.$product_thambnail->getClientOriginalExtension();
        Image::make($product_thambnail)->resize(600,600)->save('uploads/images/product/thambnail/'.$product_thambnail_name_gen);

        $product_thambnail_image = 'uploads/images/product/thambnail/'.$product_thambnail_name_gen;
                                    

        //Insert data and get id
        $id = Product::insertGetId([
            'cat_id'=> $request->cat_id,
            //'title'=> trim($request->title),
            //'title_jp'=> trim($request->title_jp),
            'short_des'=> $request->short_des,
            'short_des_jp'=> $request->short_des_jp,
            'detail_des'=> $request->detail_des,
            'detail_des_jp'=> $request->detail_des_jp,
            'thumbnail_image'=> $product_thambnail_image,
            'publish_status'=> $request->publish_status,
            'user_id'=> Auth::user()->id,
            'created_at'=>Carbon::now(),
        ]); 

        return Redirect()->back()->with('success','Saved Successfully');
    }

    public function view()
    {
        $products = Product::latest()->paginate(25);
        return view('admin.product.view_product',compact('products'));
    }

    public function edit($id)
    { 
        //get product info by id
        $products = Product::findOrFail($id); 
        $categories = Category::where('publish_status','publish')->get(); 
        return view('admin.product.edit_product',compact('products','categories'));
    }

    //product update
    public function update(Request $request, $id)
    {
        //dd($request->all());
        //validation  
        $request->validate([
            'cat_id' => 'required',
            //'title' => 'required|max:191',
            //'title_jp' => 'required|max:255',
        ],
        [
            //'title.required' => 'Product Title Required',
            //'title.max' => 'Maximum 191 chars',
            //'title_jp.required' => 'Product Title In Japanese Required',
            //'title_jp.max' => 'Maximum 191 chars',
        ]);

        //dd($request->all());
    
        $product_thambnail = "";
        $product_oldimg ="";
        $product_thambnail_image ="";
        $product_thambnail = $request->file('thumbnail_image'); 
        
        if($product_thambnail !="")
        {
            $ext = $product_thambnail->getClientOriginalExtension();
            if($ext == 'jpg'||$ext == 'jpeg'||$ext == 'png'||$ext == 'gif')
            {
                $product_oldimg = $request->old_img; 
                if(file_exists($product_oldimg))
                {
                    unlink($product_oldimg);
                }
                
                $product_thambnail_name_gen = hexdec(uniqid()).'.'.$product_thambnail->getClientOriginalExtension();
                Image::make($product_thambnail)->resize(600,600)->save('uploads/images/product/thambnail/'.$product_thambnail_name_gen);
                $product_thambnail_image = 'uploads/images/product/thambnail/'.$product_thambnail_name_gen;
            }
            else{
                $product_thambnail_image =  $request->old_img;
            }
        }
        else{
            $product_thambnail_image =  $request->old_img;
        }
               
        //Update data
        Product::find($id)->update([
            'cat_id'=> $request->cat_id,
            //'title'=> trim($request->title),
            //'title_jp'=> trim($request->title_jp),
            'short_des'=> $request->short_des,
            'short_des_jp'=> $request->short_des_jp,
            'detail_des'=> $request->detail_des,
            'detail_des_jp'=> $request->detail_des_jp,
            'thumbnail_image'=> $product_thambnail_image,
            'publish_status'=> $request->publish_status,
            'user_id'=> Auth::user()->id,
            'updated_at'=>Carbon::now(),
        ]);

        return Redirect()->back()->with('success','Updated Successfully');
    }

    //product delete
    public function delete($id)
    {
        //get productimage by product id and then delete 
        $product = Product::findOrFail($id);
        //delete thambnail image
        if(is_file($product->thumbnail_image))
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
        Product::find($id)->delete();

        return Redirect()->back()->with('success','Deleted Successfully');
    }






    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    ////////////Product Image/////////////////////

    public function imageview($id)
    {
        //get product image by id
        //$productimages = Productimage::where('productid', $id)->pluck('name', 'surname');
        $selectedproduct = Product::find($id);
        $productmultipleimages = Product_multiple_image::where('product_id', $id)->get(); 
        return view('admin.product_multiple_image.view_multiple_image',compact('selectedproduct','productmultipleimages'));
    }

    //edit product thumbnail image
    public function edit_productthumbnailimage($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.edit_productthumbnailimage',compact('product'));
    }
    public function change_thumbnail(Request $request,$id)
    {
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
        $product_id = $id;
        return view('backend.admin.product.addmore_product_image', compact('product_id'));
    }
    public function productimage_addmore_upload(Request $request)
    { 
        $product_id = $request->product_id; 

        //Product Multiple Image Upload with product id
        $productimage = $request->file('image');
        if($productimage)
        {
            foreach($productimage as $pimage)
            {
                if($pimage->getClientOriginalExtension()=='png'||$pimage->getClientOriginalExtension()=='jpg'||$pimage->getClientOriginalExtension()=='jpeg')
                {
                    $name_gen = hexdec(uniqid()).'.'.$pimage->getClientOriginalExtension();
                    Image::make($pimage)->resize(600,600)->save('uploads/images/product/multipleimage/'.$name_gen);

                    //Insert image data 
                    Product_multiple_image::insert([
                        'product_id'=>$product_id,
                        'image'=>'uploads/images/product/multipleimage/'.$name_gen,
                        'user_id' => Auth::user()->id,
                        'publish_status'=> 'publish', 
                        'created_at'=>Carbon::now(),
                    ]);

                }
            }
        }

        return Redirect()->back()->with('success','Product image uploaded');
    }

    //edit productimage multiple
    public function edit_productimage($id)
    {
        //get data
        $productimagedata = Product_multiple_image::find($id);
        return view('admin.product.productimage_edit', compact('productimagedata'));
    }

    //update productimage multiple
    public function update_productimage(Request $request,$id)
    {
        //validation  
        $request->validate([
            'productimage' => 'required|mimes:jpg,jpeg,png,gif',
        ]);
        //productimageinfo before modify
        $pre_productimageinfo = Product_multiple_image::find($id);
        $product_id = $pre_productimageinfo->product_id;
        $oldproductimage = $pre_productimageinfo->image;


        $productimage = $request->file('productimage');
        if($productimage)
        {
                $name_gen = hexdec(uniqid()).'.'.$productimage->getClientOriginalExtension();
                Image::make($productimage)->resize(600,600)->save('uploads/images/product/multipleimage/'.$name_gen);

                //delete old image
                if(is_file($oldproductimage))
                {
                    unlink($oldproductimage);
                }
                

                //Insert image data 
                Product_multiple_image::find($id)->update([
                    'product_id'=>$product_id,
                    'image'=>'uploads/images/product/multipleimage/'.$name_gen,
                    'publish_status'=> 'publish',
                    'updated_at'=>Carbon::now(),
                ]);
        }

        return Redirect()->back()->with('success','Product image changed');
    }

    //delete productimage multiple
    public function delete_productimage($id)
    {
        //Get info
        $productImagesData = Product_multiple_image::find($id); 
        $product_id = $productImagesData->product_id; 
        $image = $productImagesData->image; 
        
        //delete info
        Product_multiple_image::find($id)->delete();
        //delete image
        if(is_file($image))
        {
            unlink($image);
        }
        
        return redirect('product/imageview/'.$product_id);
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    ////////////Product Video/////////////////////

    public function productvideo_view($product_id)
    {
        $productvideos = Product_multiple_video::with('product')->where('product_id',$product_id)->paginate(10);
        $product = Product::find($product_id);
        return view('admin.product_multiple_video.view_multiple_video', compact('productvideos','product'));
    }
    public function productvideo_addmore($product_id)
    {
        $product = Product::find($product_id);
        return view('admin.product_multiple_video.add_video_form',compact('product'));
    }
    public function productvideo_addmore_upload(Request $request, $product_id)
    {
        
        $this->validate($request, [
            'videofile' => 'required|file|mimetypes:video/mp4',
      ]);
       
        if ($request->hasFile('videofile'))
        {
            $file = $request->file('videofile');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            //$file->move('uploads/videos/product/multiplevideo/', $file->getClientOriginalName());
            $file->move('uploads/videos/product/multiplevideo/', $name_gen);
            Product_multiple_video::insert([
                'product_id'=>$product_id,
                'video'=>'uploads/videos/product/multiplevideo/'.$name_gen,
                'user_id' => Auth::user()->id,
                'publish_status'=> 'publish', 
                'created_at'=>Carbon::now(),
            ]);

            return Redirect()->back()->with('success','Video uploaded');
        }
        else
        {
            return Redirect()->back()->with('error','Video file is required');
        }
    }

    public function edit_productvideo($product_video_id)
    {
        $productvideo = Product_multiple_video::find($product_video_id);
        return view('admin.product_multiple_video.edit_video_form', compact('productvideo'));
    }

    public function update_productvideo(Request $request, $productvideo_id)
    {
        $this->validate($request, [
            'videofile' => 'required|file|mimetypes:video/mp4',
      ]);
       
      $oldproductvideo = $request->oldproductvideo;
        if ($request->hasFile('videofile'))
        {
            //delete previous video
            if(is_file($oldproductvideo))
            {
                unlink($oldproductvideo);
            } 

            //upload
            $file = $request->file('videofile');
            $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $file->move('uploads/videos/product/multiplevideo/', $name_gen);
            //update data
            Product_multiple_video::find($productvideo_id)->update([
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
        //Get info
        $productVideoData = Product_multiple_video::find($productvideo_id); 
        $product_id = $productVideoData->product_id; 
        $video = $productVideoData->video; 
        
        //delete info
        Product_multiple_video::find($productvideo_id)->delete();
        //delete image
        if(is_file($video))
        {
            unlink($video);
        }
        
        return redirect('product/videoview/'.$product_id)->with('success','Video deleted');
    }

    ///////////////////////////////Product Enquiry ////////////////////////////////////////////////

    //product_enquiry_view
    public function product_enquiry_view()
    {
        $customer_enquiry = CustomerMail::with('product')->where('delete_status',0)->orderby('id','desc')->paginate(10);
        return view('admin.product_enquiry.view', compact('customer_enquiry'));
    }
    //product_enquiry_view_details
    public function product_enquiry_view_details($id)
    {
        $customer_enquiry = CustomerMail::with('product')->find($id);
        return view('admin.product_enquiry.view_details', compact('customer_enquiry'));
    }
    public function product_enquiry_delete($id)
    {
        CustomerMail::find($id)->delete();
        return Redirect()->back()->with('success','Successfully  deleted');
    }



}
