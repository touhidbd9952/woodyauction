@extends('layouts.member_admin_master')

@section('content')

<style>
    .red{color: red;padding-left:10px;}
</style>

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Product</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/member_dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Product Edit Form</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    Product 
                    <?php 
                        if($product->state ==0 || $product->state ==4)
                        {
                            echo ' Edit Form'; 
                        }
                        else 
                        {
                            echo 'Details View';
                        }
                    ?>
                    
                    <a href="javascript:" onclick="history.back(); return false;" style="float: right;margin:0 15px;">Back</a>
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div> 
                    @endif
                    
                    <form action="{{route('member.product.update',[$product->id])}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="old_img" value="{{$product->thumbnail_image}}">
                        <input type="hidden" name="old_sm_img" value="{{$product->thumbnail_sm_image}}">
                        <input type="hidden" name="old_conditional_report" value="{{$product->conditional_report}}">
                        <input type="hidden" name="product_no" value="{{$product->product_no}}">

                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Product Name</label>
                            <div class="col-sm-6">
                                <input type="text"  name="name_en" autocomplete="off" class="form-control @error('name_en') is-invalid @enderror" 
                                placeholder="Product Name In English" value="{{$product->name_en}}">
                                @error('name_en')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Product Name (JP)</label>
                            <div class="col-sm-6">
                                <input type="text"  name="name_jp" autocomplete="off" class="form-control @error('name_jp') is-invalid @enderror"
                                    placeholder="Product Name In Japanese" value="{{$product->name_jp}}">
                                @error('title_jp')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Category <span class="red">*</span></label>
                            <div class="col-sm-6">
                                <select name="category_id" id="categoryList" autocomplete="off" class="form-control @error('category_id') is-invalid @enderror" required>
                                    <option></option>
                                    @foreach($categories as $cat)
                                    <option value="{{$cat->id}}" {{$product->category_id ==  $cat->id?'selected':''}}>{{ $cat->name_en }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Brand</label>
                            <div class="col-sm-6">
                                <select name="brand_id" id="brandList" autocomplete="off" class="form-control @error('brand_id') is-invalid @enderror" >
                                    <option></option>
                                    @foreach($brands as $brand)
                                    <option value="{{$brand->id}}" {{$product->brand_id ==  $brand->id?'selected':''}}>{{ $brand->name_en }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Model No</label>
                            <div class="col-sm-6">
                                <input type="text"  name="model_no" autocomplete="off" class="form-control @error('model_no') is-invalid @enderror" 
                                placeholder="Product model number" value="{{$product->model_no}}">
                                @error('model_no')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Serial No</label>
                            <div class="col-sm-6">
                                <input type="text"  name="serial_no" autocomplete="off" class="form-control @error('serial_no') is-invalid @enderror" 
                                placeholder="Product serial number" value="{{$product->serial_no}}">
                                @error('serial_no')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Product Year</label>
                            <div class="col-sm-6">
                                <input type="number"  name="model_year" autocomplete="off" class="form-control @error('model_year') is-invalid @enderror" 
                                placeholder="Product year" value="{{$product->model_year}}">
                                @error('model_year')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Used hours</label>
                            <div class="col-sm-6">
                                <input type="number"  name="used_hour" autocomplete="off" class="form-control @error('used_hour') is-invalid @enderror" 
                                placeholder="Product used hours" value="{{$product->used_hour}}">
                                @error('used_hour')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Auction Bid Start Price <span class="red">*</span></label>
                            <div class="col-sm-6">
                                <input type="text"  name="bid_start_price" id="bid_start_price" autocomplete="off"  onkeyup="commagenerate('bid_start_price')" class="form-control @error('bid_start_price') is-invalid @enderror" 
                                 value="{{$product->bid_start_price !=0.00? number_format((int)$product->bid_start_price):old('bid_start_price')}}">
                                @error('bid_start_price')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="buy_price" value="0">
                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Buy Price</label>
                            <div class="col-sm-6">
                                <input type="number"  name="buy_price" autocomplete="off" class="form-control @error('buy_price') is-invalid @enderror" 
                                placeholder="Product buy price" value="{{$product->buy_price}}">
                                @error('buy_price')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        <input type="hidden" name="sale_price" value="0">
                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Sale Price</label>
                            <div class="col-sm-6">
                                <input type="number"  name="sale_price" autocomplete="off" class="form-control @error('sale_price') is-invalid @enderror" 
                                placeholder="Product sale price" value="{{$product->sale_price}}">
                                @error('sale_price')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        <input type="hidden" name="short_description" value="Short Description">
                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Short Description</label>
                            <div class="col-sm-6">
                                <textarea  name="short_description" autocomplete="off" class="form-control @error('short_description') is-invalid @enderror"
                                    placeholder="Product Short Description">{{$product->short_description}}</textarea>
                                @error('short_description')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        <input type="hidden" name="short_description_jp" value="Short Description (JP)">
                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Short Description (JP)</label>
                            <div class="col-sm-6">
                                <textarea  name="short_description_jp" autocomplete="off" class="form-control @error('short_description_jp') is-invalid @enderror"
                                    placeholder="Product Short Description In Japanese">{{$product->short_description_jp}}</textarea>
                                @error('short_description_jp')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <input type="hidden" name="long_description" value="..."> --}}
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Details Description</label>
                            <div class="col-sm-6">
                                <textarea  name="long_description" autocomplete="off" class="form-control @error('long_description') is-invalid @enderror"
                                    placeholder="Product Details Description" style="min-height: 120px">{{$product->long_description}}</textarea>
                                @error('long_description')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="long_description_jp" value="...">
                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Details Description (JP)</label>
                            <div class="col-sm-6">
                                <textarea  name="long_description_jp" autocomplete="off" class="form-control @error('long_description_jp') is-invalid @enderror"
                                    placeholder="Product Details Description In Japanese" style="min-height: 120px">{{$product->long_description_jp}}</textarea>
                                @error('long_description_jp')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Delivery Place</label>
                            <div class="col-sm-6">
                                
                                <select type="text"  name="delivery_place_id"  class="form-control" style="width: 50%;float: left;">
                                    <option value="" selected="selected">---</option>
                                    @foreach($deliveryplaces as $deliverypl)
                                    <option value="{{$deliverypl->id}}" {{$product->delivery_place_id ==  $deliverypl->id?'selected':''}}>{{ $deliverypl->name_en }}</option>
                                    @endforeach
                                </select>
                                <select type="text"  name="delivery_status"  class="form-control" style="width: 50%;display: inline-block;">
                                    <option value="" selected="selected">---</option>
                                      <option value="Arrived" {{$product->delivery_status =="Arrived"?'selected':''}}>Arrived(搬入済) </option>
                                      <option value="Coming" {{$product->delivery_status =="Coming"?'selected':''}}>Coming (未搬入)</option>
                                </select>
                                
                            </div>
                        </div>

                        <input type="hidden" name="releasing_charge" value="{{$product->releasing_charge}}">
                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Releasing charge</label>
                            <div class="col-sm-6">
                                <input type="text"  name="releasing_charge" id="releasing_charge" onkeyup="commagenerate('releasing_charge')" autocomplete="off" class="form-control @error('releasing_charge') is-invalid @enderror" 
                                placeholder="Product releasing charge" value="{{$product->releasing_charge}}">
                                @error('releasing_charge')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Product Conditional Report</label>
                            <div class="col-sm-6">
                                <input type="file"  name="conditional_report"   class="form-control @error('conditional_report') is-invalid @enderror" >
                                <br>
                                <a onclick="windopen({{$product->id}});" href="javascript:" class="cond" style="text-decoration: underline;">
                                    Report View
                                </a>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Product Image <span class="red">*</span></label>
                            <div class="col-sm-6">
                                <input type="file"  name="thumbnail_image" id="imgInp"  class="form-control @error('productimage') is-invalid @enderror" 
                                onchange="loadFile(event)">
                                    <img src="{{asset($product->thumbnail_image)}}" id="output" style="width: 300px;height:225px;margin-top:10px;border:1px solid #ccc;">
                            </div>
                        </div>
                        

                        
                        

                        <input type="hidden" name="stock" value="available">
                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Publish stock</label>
                            <div class="col-sm-6">
                                <select name="stock" class="form-control @error('stock') is-invalid @enderror">
                                    <option value="available" {{$product->stock == 'available'?'selected':''}}>Available</option>
                                    <option value="negotiating" {{$product->stock == 'negotiating'?'selected':''}}>Negotiating</option>
                                    <option value="sold_out" {{$product->stock == 'sold_out'?'selected':''}}>Sold out</option>
                                </select>
                                @error('stock')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}


                        <input type="hidden" name="status" value="active">
                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Publish status</label>
                            <div class="col-sm-6">
                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="active" {{$product->status == 'active'?'selected':''}}>Publish</option>
                                    <option value="inactive" {{$product->status == 'inactive'?'selected':''}}>Unpublish</option>
                                </select>
                                @error('status')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        <input type="hidden" name="allow_comment" value="no">
                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Allow comment</label>
                            <div class="col-sm-6">
                                <select name="allow_comment" class="form-control @error('allow_comment') is-invalid @enderror">
                                    <option value="no" {{$product->allow_comment == 'no'?'selected':''}}>No</option>
                                    <option value="yes" {{$product->allow_comment == 'yes'?'selected':''}}>Yes</option>
                                </select>
                                @error('allow_comment')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Video Url (Youtube)</label>
                            <div class="col-sm-6">
                                <input type="text"  name="videourl" id="youtubevideolink" onkeyup="loadvideo();" autocomplete="off" class="form-control @error('videourl') is-invalid @enderror" 
                                placeholder="Product youtube video url" value="{{$product->videourl}}">
                                @error('videourl')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                                <a onclick="loadvideo();" href="javascript:" class="cond" style="text-decoration: underline;">
                                    Video View
                                </a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">&nbsp;</label>
                            <div class="col-sm-6">
                                <iframe width="300" height="225" id="videourl" src="{{$product->videourl}}">
                                </iframe>
                            </div>
                        </div>

                        

                        

                        
                        <?php 
                        if($product->state ==0 || $product->state ==4)
                        {
                        ?>
                        <div class="form-group row mb-0">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-primary" style="float: right">
                                    Update
                                </button>
                            </div>
                        </div>
                        <?php 
                        }
                        ?>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>


<script>
    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
      output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
      }
    };
  </script>
  <script>
    function commagenerate(idname)
    {
        var idvalue = document.getElementById(idname).value;
        if(idvalue !="")
        {
            idvalue = idvalue.replace(/,/g, '');
            if(isNaN(idvalue) == false)
            {
                idvalue = parseInt(idvalue, 10).toLocaleString('en-US'); //alert(idvalue);
                document.getElementById(idname).value = idvalue;	
            }
        }
    }
  </script>

<script>
    var videoplayer = document.getElementById('videourl');
    videoplayer.style.display="none";
    function loadvideo()
    {
        //alert('paisi');
        var youtubevideolink = document.getElementById('youtubevideolink').value;  //alert(youtubevideolink);
        if(youtubevideolink != "")
        {
            youtubevideolink = youtubevideolink.replace("https://youtu.be/", "https://www.youtube.com/embed/");  //alert(youtubevideolink);
            videoplayer.style.display="block";
            //var videoplayer = document.getElementById('videourl');
            videoplayer.src = youtubevideolink;
            videoplayer.play();
        }
    }
</script>
<script>
    function windopen(pid)
      {
      
          var w_size=1050;
          var h_size=750;
      
          var l_position=Number((window.screen.width-w_size)/2);
          var t_position=Number((window.screen.height-h_size)/2);
      
          window.open('/product/conditional_report?id='+pid,'newWindow2','toolbar=no,statusbar=no,status=no,scroll=yes,scrollbars=yes,location=no,directories=no,menubar=no,resizable=yes,width='+ w_size +',height='+h_size+',left='+l_position+',top='+t_position);
      }
</script>
<script>
    var videoplayer = document.getElementById('videourl');
    videoplayer.style.display="none";
    function loadvideo()
    {
        //alert('paisi');
        var youtubevideolink = document.getElementById('youtubevideolink').value;  //alert(youtubevideolink);
        if(youtubevideolink != "")
        {
            youtubevideolink = youtubevideolink.replace("https://youtu.be/", "https://www.youtube.com/embed/");  //alert(youtubevideolink);
            videoplayer.style.display="block";
            //var videoplayer = document.getElementById('videourl');
            videoplayer.src = youtubevideolink;
            videoplayer.play();
        }
    }
</script>



@endsection


