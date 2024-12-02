@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Product</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
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
                    Product Details View
                    <a href="javascript:" onclick="history.back(); return false;"  style="float: right;">Back</a>
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div>
                    @endif
                    
                    <form action="{{route('product.update',[$product->id])}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="old_img" value="{{$product->thumbnail_image}}">
                        <input type="hidden" name="old_sm_img" value="{{$product->thumbnail_sm_image}}">
                        <input type="hidden" name="product_no" value="{{$product->product_no}}">

                        

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Category</label>
                            <div class="col-sm-6">
                                <select name="category_id" id="categoryList" autocomplete="off" class="form-control @error('category_id') is-invalid @enderror" disabled>
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
                                <select name="brand_id" id="brandList" autocomplete="off" class="form-control @error('brand_id') is-invalid @enderror" disabled>
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
                                placeholder="Product model number" value="{{$product->model_no}}" readonly>
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
                                placeholder="Product serial number" value="{{$product->serial_no}}" readonly>
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
                                placeholder="Product year" value="{{$product->model_year}}" readonly>
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
                                placeholder="Product used hours" value="{{$product->used_hour}}" readonly>
                                @error('used_hour')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        

                       

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Details Description</label>
                            <div class="col-sm-6">
                                <textarea  name="long_description" autocomplete="off" class="form-control @error('long_description') is-invalid @enderror"
                                    placeholder="Product Details Description" style="min-height: 120px" readonly>{{$product->long_description}}</textarea>
                                @error('long_description')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Delivery Place</label>
                            <div class="col-sm-6">
                                
                                <select type="text"  name="delivery_place_id"  class="form-control" style="width: 50%;float: left;" disabled>
                                    <option value="" selected="selected">---</option>
                                    @foreach($deliveryplaces as $deliverypl)
                                    <option value="{{$deliverypl->id}}" {{$product->delivery_place_id ==  $deliverypl->id?'selected':''}}>{{ $deliverypl->name_en }}</option>
                                    @endforeach
                                </select>
                                <select type="text"  name="delivery_status"  class="form-control" style="width: 50%;display: inline-block;" disabled>
                                    <option value="" selected="selected">---</option>
                                      <option value="Arrived" {{$product->delivery_status =="Arrived"?'selected':''}}>Arrived(搬入済) </option>
                                      <option value="Coming" {{$product->delivery_status =="Coming"?'selected':''}}>Coming (未搬入)</option>
                                </select>
                                
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Product Thumbnail Image</label>
                            <div class="col-sm-6">
                                {{-- <input type="file"  name="thumbnail_image" id="imgInp"  class="form-control @error('productimage') is-invalid @enderror" 
                                onchange="loadFile(event)"> --}}
                                    <img src="{{asset($product->thumbnail_image)}}" id="output" style="width: 300px;height:auto;margin-top:10px;border:1px solid #ccc;">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Product Conditional Report</label>
                            <div class="col-sm-6">
                                <input type="text"  value="{{$product->conditional_report}}"   class="form-control @error('conditional_report') is-invalid @enderror" >
                                <br>
                                <a onclick="windopen({{$product->id}});" href="javascript:" class="cond" style="text-decoration: underline;">
                                    Report View
                                </a>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Video Url (Youtube)</label>
                            <div class="col-sm-6">
                                <input type="text"   id="youtubevideolink" onkeyup="loadvideo();" autocomplete="off" class="form-control @error('videourl') is-invalid @enderror" 
                                value="{{$product->videourl}}">
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
                        

                        
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Product Owner</label>
                            <div class="col-sm-6">
                                <select name="woner_id" id="wonerList" autocomplete="off" class="form-control @error('woner_id') is-invalid @enderror" disabled>
                                    <option></option>
                                    @foreach($product_woners as $woner)
                                    <option value="{{$woner->id}}" {{$product->woner_id == $woner->id? 'selected':''}}>{{ $woner->name_en }}&nbsp;{{ $woner->phone1 }}</option>
                                    @endforeach
                                </select>
                                @error('woner_id')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        
                        

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


