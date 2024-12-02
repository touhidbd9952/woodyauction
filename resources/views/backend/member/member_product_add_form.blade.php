@extends('layouts.member_admin_master')

@section('content')

<style>
    .red{color: red;padding-left:10px;}
    .addnew{cursor: pointer;color: blue;text-decoration: underline;}
    .form-control:focus {border-color: red;}
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
                                    <li class="breadcrumb-item active" aria-current="page">Product Add Form</li>
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
                    Product Add Form
                    <a href="{{route('member.product.view_newlyadded_productlist')}}"  style="float: right;">View Product</a>
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
                    
                    <form action="{{route('member.product.store')}}" method="post" enctype="multipart/form-data">

                        @csrf


                        
                        
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Category <span class="red">*</span></label>
                            <div class="col-sm-6">
                                <select name="category_id" id="categoryList" autocomplete="off" class="form-control @error('category_id') is-invalid @enderror" required>
                                    <option></option>
                                    @foreach($categories as $cat)
                                    <option value="{{$cat->id}}">{{ $cat->name_en }}</option>
                                    @endforeach
                                </select>
                                
                                @error('category_id')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Brand </label>
                            <div class="col-sm-6">
                                <select name="brand_id" id="brandList" autocomplete="off" class="form-control @error('brand_id') is-invalid @enderror" >
                                    <option></option>
                                    @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{ $brand->name_en }}</option>
                                    @endforeach
                                </select>

                                @error('brand_id')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Model No </label>
                            <div class="col-sm-6">
                                <input type="text"  name="model_no" id="model_no" autocomplete="off" class="form-control @error('model_no') is-invalid @enderror" 
                                placeholder="Product model number" value="{{old('model_no')}}" >
                                @error('model_no')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Serial No </label>
                            <div class="col-sm-6">
                                <input type="text"  name="serial_no" id="serial_no" autocomplete="off" class="form-control @error('serial_no') is-invalid @enderror" 
                                placeholder="Product serial number" value="{{old('serial_no')}}" >
                                @error('serial_no')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Product Year</label>
                            <div class="col-sm-6">
                                <input type="number"  name="model_year" id="model_year" autocomplete="off" class="form-control @error('model_year') is-invalid @enderror" 
                                placeholder="Product year" value="{{old('model_year')}}">
                                @error('model_year')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Used hours</label>
                            <div class="col-sm-6">
                                <input type="number"  name="used_hour" id="used_hour" autocomplete="off" class="form-control @error('used_hour') is-invalid @enderror" 
                                placeholder="Product used hours" value="{{old('used_hour')}}">
                                @error('used_hour')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Auction Bid Start Price <span class="red">*</span> </label>
                            <div class="col-sm-6">
                                <input type="text"  name="bid_start_price" id="bid_start_price" autocomplete="off"  onkeyup="commagenerate('bid_start_price')" class="form-control @error('bid_start_price') is-invalid @enderror" 
                                 value="0">
                                @error('bid_start_price')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="buy_price" value="0">
                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Buy Price <span class="red">*</span></label>
                            <div class="col-sm-6">
                                <input type="number"  name="buy_price" autocomplete="off" class="form-control @error('buy_price') is-invalid @enderror" 
                                placeholder="Product buy price" value="{{old('buy_price')}}" required>
                                @error('buy_price')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        <input type="hidden" name="sale_price" value="0">
                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Sale Price <span class="red">*</span></label>
                            <div class="col-sm-6">
                                <input type="number"  name="sale_price" autocomplete="off" class="form-control @error('sale_price') is-invalid @enderror" 
                                placeholder="Product sale price" value="{{old('sale_price')}}">
                                @error('sale_price')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        <input type="hidden" name="short_description" value="...">
                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Short Description <span class="red">*</span></label>
                            <div class="col-sm-6">
                                <textarea  name="short_description" autocomplete="off" class="form-control @error('short_description') is-invalid @enderror"
                                    placeholder="Product Short Description">{{old('short_description')}}</textarea>
                                @error('short_description')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        <input type="hidden" name="short_description_jp" value="...">

                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Short Description (JP) <span class="red">*</span></label>
                            <div class="col-sm-6">
                                <textarea  name="short_description_jp" autocomplete="off" class="form-control @error('short_description_jp') is-invalid @enderror"
                                    placeholder="Product Short Description In Japanese">{{old('short_description_jp')}}</textarea>
                                @error('short_description_jp')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <input type="hidden" name="long_description" value="Details Description"> --}}
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Details Description </label>
                            <div class="col-sm-6">
                                <textarea  name="long_description" id="long_description" autocomplete="off" class="form-control @error('long_description') is-invalid @enderror"
                                    placeholder="Product Details Description" style="min-height: 120px">{{old('long_description')}}</textarea>
                                @error('long_description')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="long_description_jp" id="long_description_jp" value="Details Description (JP)">
                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Details Description (JP) </label>
                            <div class="col-sm-6">
                                <textarea  name="long_description_jp" id="long_description_jp" autocomplete="off" class="form-control @error('long_description_jp') is-invalid @enderror"
                                    placeholder="Product Details Description In Japanese" style="min-height: 120px">{{old('long_description_jp')}}</textarea>
                                @error('long_description_jp')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}



                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Delivery Place </label>
                            <div class="col-sm-6">
                                <select type="text"  name="delivery_place_id" id="delivery_place_id"  class="form-control" style="width: 50%;float: left;" >
                                    <option value="" selected="selected">---</option>
                                    @foreach($deliveryplaces as $deliverypl)
                                    <option value="{{$deliverypl->id}}">{{ $deliverypl->name_en }}</option>
                                    @endforeach
                                </select>
                                <select type="text"  name="delivery_status" id="delivery_status"  class="form-control" style="width: 50%;display: inline-block;">
                                    <option value="" selected="selected">---</option>
                                      <option value="Arrived">Arrived(搬入済) </option>
                                      <option value="Coming">Coming (未搬入)</option>
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="releasing_charge" value="0">
                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Releasing charge</label>
                            <div class="col-sm-6">
                                <input type="text"  name="releasing_charge" id="releasing_charge" onkeyup="commagenerate('releasing_charge')" autocomplete="off" class="form-control @error('releasing_charge') is-invalid @enderror" 
                                placeholder="Product releasing charge" value="{{old('releasing_charge')}}">
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
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Product Main Image <span class="red">*</span></label>
                            <div class="col-sm-6">
                                <input type="file"  name="thumbnail_image" id="imgInp"  class="form-control @error('productimage') is-invalid @enderror" 
                                onchange="loadFile(event)" required>
                                    <img src="{{asset('fontend/images/product-image-size.jpg')}}" id="output" style="width: 300px;height:225px;margin-top:10px;border:1px solid #ccc;">
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Product Multiple Image</label>
                            <div class="col-sm-6">
                                <input type="file"  name="image[]" id="productmultipleimage"  class="form-control @error('image') is-invalid @enderror"
                                     multiple>
                                    
                                    <div id="myImg"></div>
                            </div>
                        </div> --}}

                        {{-- <div class="form-group row">
                            <label for="videofile" class="col-sm-3 text-end control-label col-form-label">Product Video</label>

                            <div class="col-sm-6">
                                <input  type="file" name="videofile" id="videofile" class="form-control @error('videofile') is-invalid @enderror"  value="{{ old('videofile') }}" >

                                @error('videofile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        
                        

                        <input type="hidden" name="stock" value="available">
                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Stock <span class="red">*</span></label>
                            <div class="col-sm-6">
                                <select name="stock" class="form-control @error('stock') is-invalid @enderror">
                                    <option value="available">Available</option>
                                    <option value="negotiating">Negotiating</option>
                                    <option value="sold_out">Sold out</option>
                                </select>
                                @error('stock')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        <input type="hidden" name="publish_status" value="active">
                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Publish status <span class="red">*</span></label>
                            <div class="col-sm-6">
                                <select name="publish_status" class="form-control @error('publish_status') is-invalid @enderror">
                                    <option value="active">Publish</option>
                                    <option value="inactive">Unpublish</option>
                                </select>
                                @error('publish_status')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> --}}

                        <input type="hidden" name="allow_comment" value="no">
                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Allow comment </label>
                            <div class="col-sm-6">
                                <select name="allow_comment" class="form-control @error('allow_comment') is-invalid @enderror">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
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
                                placeholder="Product youtube video url" value="{{old('videourl')}}">
                                @error('videourl')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">&nbsp;</label>
                            <div class="col-sm-6">
                                
                                <iframe width="300" height="225" id="videourl" src="">
                                </iframe>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-primary" style="float: right">
                                    Save
                                </button>
                            </div>
                        </div>

                    </form>
                    {{-- <a href="javascript:" onclick="setTempData()" class="btn btn-primary">Set As Draft</a> --}}
                    {{-- <a href="javascript:" onclick="getTempData()" class="btn btn-primary">Get From Draft</a> --}}

                    

                </div>
            </div>

        </div>
    </div>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
    //multiple seleted image show    
    $(function() {
      $("#productmultipleimage").change(function() {
        if (this.files && this.files[0]) {
          for (var i = 0; i < this.files.length; i++) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[i]);
          }
        }
      });
    });
    
    function imageIsLoaded(e) {
      $('#myImg').append('<img src=' + e.target.result + ' style="width:100px;height:100px">');
    };
</script>

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
    document.getElementById('newcaten').style.display="none";
    document.getElementById('newcatjp').style.display="none";
    $('#newcategory').click(function(){
        document.getElementById('newcaten').style.display="block";
        document.getElementById('newcatjp').style.display="block";
    });
    
    document.getElementById('newbranden').style.display="none";
    document.getElementById('newbrandjp').style.display="none";
    $('#newbrandid').click(function(){
        document.getElementById('newbranden').style.display="block";
        document.getElementById('newbrandjp').style.display="block";
    });
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
    function setTempData()
    {  
      var wonerList = document.getElementById('wonerList').value;
      var categoryList = document.getElementById('categoryList').value;
      var brandList = document.getElementById('brandList').value;
      var model_no = document.getElementById('model_no').value;
      var serial_no = document.getElementById('serial_no').value;
      var model_year = document.getElementById('model_year').value;  
      var used_hour = document.getElementById('used_hour').value;
      var long_description = document.getElementById('long_description').value;   
      var long_description_jp = document.getElementById('long_description_jp').value;  
      var delivery_place_id = document.getElementById('delivery_place_id').value;  
      var delivery_status = document.getElementById('delivery_status').value;
      //var releasing_charge = document.getElementById('releasing_charge').value; 
      var releasing_charge = "";
      var youtubevideolink = document.getElementById('youtubevideolink').value;    //alert('youtubevideolink');
  
      $.ajax({
              type:'POST',
              url: '/product/set_productdata_in_temp',
              data: {
                    "_token": "{{ csrf_token() }}",
                    "wonerList": wonerList,
                    "categoryList": categoryList,
                    "brandList": brandList,
                    "model_no": model_no,
                    "serial_no": serial_no,
                    "model_year": model_year,
                    "used_hour": used_hour,
                    "long_description": long_description,
                    "long_description_jp": long_description_jp,
                    "delivery_place_id": delivery_place_id,
                    "delivery_status": delivery_status,
                    "releasing_charge": releasing_charge,
                    "youtubevideolink": youtubevideolink,
                },
              dataType:'json',
              success:function(response){
                  alert(response.successmsg);
              }
          })
    }
    function getTempData()
    {
      $.ajax({
              type:'get',
              url: '/product/get_productdata_from_temp',
              dataType:'json',
              success:function(data){
                for(var i=0; i < document.getElementById('wonerList').options.length; i++)
                {
                    if(document.getElementById('wonerList').options[i].value === data.wonerList) {
                        document.getElementById('wonerList').selectedIndex = i;
                        break;
                    }
                }
                for(var i=0; i < document.getElementById('categoryList').options.length; i++)
                {
                    if(document.getElementById('categoryList').options[i].value === data.categoryList) {
                        document.getElementById('categoryList').selectedIndex = i;
                        break;
                    }
                }
                for(var i=0; i < document.getElementById('brandList').options.length; i++)
                {
                    if(document.getElementById('brandList').options[i].value === data.brandList) {
                        document.getElementById('brandList').selectedIndex = i;
                        break;
                    }
                }
                  //document.getElementById('wonerList').value = data.wonerList;
                  //document.getElementById('categoryList').value = data.categoryList;
                  //document.getElementById('brandList').value = data.brandList;
                  document.getElementById('model_no').value = data.model_no;
                  document.getElementById('serial_no').value = data.serial_no;
                  document.getElementById('model_year').value = data.model_year;
                  document.getElementById('used_hour').value = data.used_hour;
                  document.getElementById('long_description').value = data.long_description;
                  document.getElementById('long_description_jp').value = data.long_description_jp;
                  for(var i=0; i < document.getElementById('delivery_place_id').options.length; i++)
                    {
                        if(document.getElementById('delivery_place_id').options[i].value === data.delivery_place_id) {
                            document.getElementById('delivery_place_id').selectedIndex = i;
                            break;
                        }
                    }
                  //document.getElementById('delivery_place_id').value = data.delivery_place_id;
                  for(var i=0; i < document.getElementById('delivery_status').options.length; i++)
                    {
                        if(document.getElementById('delivery_status').options[i].value === data.delivery_status) {
                            document.getElementById('delivery_status').selectedIndex = i;
                            break;
                        }
                    }
                  //document.getElementById('delivery_status').value = data.delivery_status;
                  //document.getElementById('releasing_charge').value = data.releasing_charge;
                  document.getElementById('youtubevideolink').value = data.youtubevideolink;  
              }
          })
  
    }
  </script>

@endsection


