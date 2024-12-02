@extends('layouts.admin_master')

@section('content')

<style>
    .dateinputgroup{position: relative;display: flex;flex-wrap: wrap;align-items: stretch;}
    .bootstrap-datetimepicker-widget{min-width: 284px !important;}
    .requireddata{color: rgb(253, 1, 1);}
    .fa-clock::before {content: "\f017";text-align: center;position: relative;left: 130px;}
</style>    
<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Auction</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Auction Edit Form</li>
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
                    Auction Edits Form
                    <a href="{{route('auction.view')}}"  style="float: right;">View Auction List</a>
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div>
                    @endif
                    
                    <form action="{{route('auction.update',[$product->id])}}" method="post" enctype="multipart/form-data" onsubmit="convertnumber()">
                        @csrf

                        <input type="hidden" name="auction_id" value="{{$auction[0]->id}}">
                        <input type="hidden" name="category_id" value="{{$product->category_id}}">
                        <input type="hidden" name="brand_id" value="{{$product->brand_id}}">
                        <input type="hidden" name="model_no" value="{{$product->model_no}}">
                        <input type="hidden" name="serial_no" value="{{$product->serial_no}}">

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-4 text-end control-label col-form-label">Auction Product</label>
                            <div class="col-sm-6">
                                {{-- <label  class="form-control">{{$product->name_en}}</label> --}}
                                <img src="{{asset($product->thumbnail_image)}}" id="output" style="width: 300px;height:auto;margin-top:10px;border:1px solid #ccc;">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-4 text-end control-label col-form-label">Category</label>
                            <div class="col-sm-6">
                                <label  class="form-control">{{$product->category->name_en}}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-4 text-end control-label col-form-label">Brand</label>
                            <div class="col-sm-6">
                                <label  class="form-control">{{$product->brand != ""?$product->brand->name_en:""}}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-4 text-end control-label col-form-label">Model No.</label>
                            <div class="col-sm-6">
                                <label  class="form-control">{{$product->model_no}}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-4 text-end control-label col-form-label">Serial No.</label>
                            <div class="col-sm-6">
                                <label  class="form-control">{{$product->serial_no}}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-4 text-end control-label col-form-label">Model year</label>
                            <div class="col-sm-6">
                                <label  class="form-control">{{$product->model_year}}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-4 text-end control-label col-form-label">Used hour</label>
                            <div class="col-sm-6">
                                <label  class="form-control">{{$product->used_hour}}</label>
                            </div>
                        </div>

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
                                class="col-sm-3 text-end control-label col-form-label">Video Url (Youtube)</label>
                            <div class="col-sm-6">
                                <input type="text"  name="videourl" id="youtubevideolink" onkeyup="loadvideo();" autocomplete="off" class="form-control @error('videourl') is-invalid @enderror" 
                                placeholder="Product youtube video url" value="{{$product->videourl !=""?$product->videourl:old('videourl')}}">
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

                        {{-- <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Buy Price</label>
                            <div class="col-sm-6">
                                <label  class="form-control">{{number_format((int)$product->buy_price)}}</label>
                            </div>
                        </div> --}}




                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-4 text-end control-label col-form-label">Auction Entry fee(Product owner) 出展料<span class="requireddata"></span></label>
                            <div class="col-sm-6">
                                <input type="text"  name="entry_fee" id="entry_fee" onkeyup="commagenerate('entry_fee')" autocomplete="off" class="form-control @error('entry_fee') is-invalid @enderror" 
                                 value="{{number_format((int)$product->entry_fee)}}">
                                @error('entry_fee')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-4 text-end control-label col-form-label">Inspection fee (Producut owner)点検費用<span class="requireddata"></span></label>
                            <div class="col-sm-6">
                                <input type="text"  name="inspection_fee" id="inspection_fee" onkeyup="commagenerate('inspection_fee')" autocomplete="off" class="form-control @error('inspection_fee') is-invalid @enderror" 
                                 value="{{number_format((int)$product->inspection_fee)}}">
                                @error('inspection_fee')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-4 text-end control-label col-form-label">Other fee(Producut owner) その他費用<span class="requireddata"></span></label>
                            <div class="col-sm-6">
                                <input type="text"  name="other_fee" id="other_fee" onkeyup="commagenerate('other_fee')" autocomplete="off" class="form-control @error('other_fee') is-invalid @enderror" 
                                 value="{{number_format((int)$product->other_fee)}}">
                                @error('other_fee')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-4 text-end control-label col-form-label">Successful bid charges(Bidder)落札料<span class="requireddata"></span></label>
                            <div class="col-sm-6">
                                <input type="text"  name="auction_charge" id="auction_charge" onkeyup="commagenerate('auction_charge')" value="{{number_format((int)$product->auction_charge)}}" autocomplete="off" class="form-control @error('auction_charge') is-invalid @enderror" 
                                >
                                @error('auction_charge')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-4 text-end control-label col-form-label">Releasing charge(Bidder)出庫料<span class="requireddata"></span></label>
                            <div class="col-sm-6">
                                <input type="text"  name="releasing_charge" id="releasing_charge" onkeyup="commagenerate('releasing_charge')" value="{{number_format((int)$product->releasing_charge)}}" autocomplete="off" class="form-control @error('releasing_charge') is-invalid @enderror" 
                                 >
                                @error('releasing_charge')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-4 text-end control-label col-form-label">Loding Charge (Bidder)搬出作業料<span class="requireddata"></span></label>
                            <div class="col-sm-6">
                                <input type="text"  name="yard_charge" id="yard_charge" onkeyup="commagenerate('yard_charge')" value="{{number_format((int)$product->yard_charge)}}" autocomplete="off" class="form-control @error('yard_charge') is-invalid @enderror" 
                                 >
                                @error('yard_charge')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-4 text-end control-label col-form-label">Other chage(Bidder)その他費用<span class="requireddata"></span></label>
                            <div class="col-sm-6">
                                <input type="text"  name="extra_charge" id="extra_charge" onkeyup="commagenerate('extra_charge')" value="{{number_format((int)$product->extra_charge)}}" autocomplete="off" class="form-control @error('extra_charge') is-invalid @enderror" 
                                 >
                                @error('extra_charge')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-4 text-end control-label col-form-label">Auction Bid Start Price<span class="requireddata">*</span></label>
                            <div class="col-sm-6">
                                <input type="text"  name="bid_start_price" id="bid_start_price" onkeyup="commagenerate('bid_start_price')" autocomplete="off" class="form-control @error('bid_start_price') is-invalid @enderror" 
                                value="{{number_format((int)$product->bid_start_price)}}">
                                @error('bid_start_price')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-4 text-end control-label col-form-label">Bid Increase Amount<span class="requireddata">*</span></label>
                            <div class="col-sm-6">
                                <input type="text"  name="bid_increase_decrease_price" id="bid_increase_decrease_price" onkeyup="commagenerate('bid_increase_decrease_price')" autocomplete="off" class="form-control @error('bid_increase_decrease_price') is-invalid @enderror" 
                                value="{{number_format((int)$product->bid_increase_decrease_price)}}">
                                @error('bid_increase_decrease_price')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-4 text-end control-label col-form-label">Selected Auction</label>
                            <div class="col-sm-6">
                                <label   class="form-control">{{$auction[0]->name}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-4 text-end control-label col-form-label">Auction Start</label>
                            <div class="col-sm-6">
                                <label   class="form-control">{{$auction[0]->start_time_of_auction}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-4 text-end control-label col-form-label">Auction End</label>
                            <div class="col-sm-6">
                                <label   class="form-control">{{$auction[0]->end_time_of_auction}}</label>
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label for="startdate" class="col-sm-3 text-end control-label col-form-label">Auction Start:<span class="requireddata">*</span></label>
                              <div class="col-sm-6 dateinputgroup date" id="datetimepicker1" data-target-input="nearest">
                                  <input type="text" name="start_time_of_action" class="form-control datetimepicker-input" data-target="#datetimepicker1" value="{{$product->start_time_of_auction}}" required>
                                  <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                              </div>
                          </div> --}}

                          {{-- <div class="form-group row">
                            <label for="startdate" class="col-sm-3 text-end control-label col-form-label">Auction End:<span class="requireddata">*</span></label>
                              <div class="col-sm-6 dateinputgroup date" id="datetimepicker2" data-target-input="nearest">
                                  <input type="text" name="end_time_of_action" class="form-control datetimepicker-input" data-target="#datetimepicker2" value="{{$product->end_time_of_auction}}" required>
                                  <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                              </div>
                          </div> --}}



                        
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-primary" style="float: right">
                                    Update For Auction
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function convertnumber()
    {
        var entry_fee = document.getElementById('entry_fee').value;
        var inspection_fee = document.getElementById('inspection_fee').value;
        var other_fee = document.getElementById('other_fee').value;

        var auction_charge = document.getElementById('auction_charge').value;
        var yard_charge = document.getElementById('yard_charge').value;
        var extra_charge = document.getElementById('extra_charge').value;
        var releasing_charge = document.getElementById('releasing_charge').value;

        var bid_start_price = document.getElementById('bid_start_price').value;
        var bid_increase_decrease_price = document.getElementById('bid_increase_decrease_price').value;


        document.getElementById('entry_fee').value = entry_fee.replace(/,/g, "");
        document.getElementById('inspection_fee').value = inspection_fee.replace(/,/g, "");
        document.getElementById('other_fee').value = other_fee.replace(/,/g, "");

        document.getElementById('auction_charge').value = auction_charge.replace(/,/g, "");
        document.getElementById('yard_charge').value = yard_charge.replace(/,/g, "");
        document.getElementById('extra_charge').value = extra_charge.replace(/,/g, "");
        document.getElementById('releasing_charge').value = releasing_charge.replace(/,/g, "");

        document.getElementById('bid_start_price').value = bid_start_price.replace(/,/g, "");
        document.getElementById('bid_increase_decrease_price').value = bid_increase_decrease_price.replace(/,/g, "");

    }
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


