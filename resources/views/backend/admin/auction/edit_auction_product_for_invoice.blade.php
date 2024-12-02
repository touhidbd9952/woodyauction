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
                                    <li class="breadcrumb-item active" aria-current="page">Auction Edit For Invoice</li>
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
                    Auction Edit For Invoice
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div>
                    @endif
                    
                    <form action="{{route('auction.update_for_invoice',[$product->id])}}" method="post" enctype="multipart/form-data" onsubmit="convertnumber()">
                        @csrf


                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Auction Product</label>
                            <div class="col-sm-6">
                                <label  class="form-control">{{$product->product_no}}</label>
                                <img src="{{asset($product->thumbnail_image)}}" id="output" style="width: 300px;height:auto;margin-top:10px;border:1px solid #ccc;">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Category</label>
                            <div class="col-sm-6">
                                <label  class="form-control">{{$product->category->name_en}}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Brand</label>
                            <div class="col-sm-6">
                                <label  class="form-control">{{$product->brand != ""?$product->brand->name_en:""}}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Model No.</label>
                            <div class="col-sm-6">
                                <label  class="form-control">{{$product->model_no}}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Serial No.</label>
                            <div class="col-sm-6">
                                <label  class="form-control">{{$product->serial_no}}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Model year</label>
                            <div class="col-sm-6">
                                <label  class="form-control">{{$product->model_year}}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Used hour</label>
                            <div class="col-sm-6">
                                <label  class="form-control">{{$product->used_hour}}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Buy Price</label>
                            <div class="col-sm-6">
                                <label  class="form-control">{{$product->buy_price}}</label>
                            </div>
                        </div>




                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Auction Entry fee(Product owner) 出展料<span class="requireddata"></span></label>
                            <div class="col-sm-6">
                                <input type="text"  name="entry_fee" id="entry_fee" onkeyup="commagenerate('entry_fee')" autocomplete="off" class="form-control @error('entry_fee') is-invalid @enderror" 
                                 value="{{number_format((int)$product->entry_fee)}}" style="background: #f7eb8b;">
                                @error('entry_fee')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Inspection fee (Producut owner)点検費用<span class="requireddata"></span></label>
                            <div class="col-sm-6">
                                <input type="text"  name="inspection_fee" id="inspection_fee" onkeyup="commagenerate('inspection_fee')" autocomplete="off" class="form-control @error('inspection_fee') is-invalid @enderror" 
                                 value="{{number_format((int)$product->inspection_fee)}}" style="background: #f7eb8b;">
                                @error('inspection_fee')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Other fee(Producut owner) その他費用<span class="requireddata"></span></label>
                            <div class="col-sm-6">
                                <input type="text"  name="other_fee" id="other_fee" onkeyup="commagenerate('other_fee')" autocomplete="off" class="form-control @error('other_fee') is-invalid @enderror" 
                                 value="{{number_format((int)$product->other_fee)}}" style="background: #f7eb8b;">
                                @error('other_fee')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Successful bid charges(Bidder)落札料<span class="requireddata"></span></label>
                            <div class="col-sm-6">
                                <input type="text"  name="auction_charge" id="auction_charge" onkeyup="commagenerate('auction_charge')" value="{{number_format((int)$product->auction_charge)}}" autocomplete="off" class="form-control @error('auction_charge') is-invalid @enderror" 
                                style="background: #f7eb8b;">
                                @error('auction_charge')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Releasing charge(Bidder)出庫料<span class="requireddata"></span></label>
                            <div class="col-sm-6">
                                <input type="text"  name="releasing_charge" id="releasing_charge" onkeyup="commagenerate('releasing_charge')" value="{{number_format((int)$product->releasing_charge)}}" autocomplete="off" class="form-control @error('releasing_charge') is-invalid @enderror" 
                                style="background: #f7eb8b;">
                                @error('releasing_charge')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Loding Charge (Bidder)搬出作業料<span class="requireddata"></span></label>
                            <div class="col-sm-6">
                                <input type="text"  name="yard_charge" id="yard_charge" onkeyup="commagenerate('yard_charge')" value="{{number_format((int)$product->yard_charge)}}" autocomplete="off" class="form-control @error('yard_charge') is-invalid @enderror" 
                                style="background: #f7eb8b;">
                                @error('yard_charge')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Other chage(Bidder)その他費用<span class="requireddata"></span></label>
                            <div class="col-sm-6">
                                <input type="text"  name="extra_charge" id="extra_charge" onkeyup="commagenerate('extra_charge')" value="{{number_format((int)$product->extra_charge)}}" autocomplete="off" class="form-control @error('extra_charge') is-invalid @enderror" 
                                style="background: #f7eb8b;">
                                @error('extra_charge')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>
                        


                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Auction Bid Start Price<span class="requireddata"></span></label>
                            <div class="col-sm-6">
                                <label class="form-control">{{number_format((int)$product->bid_start_price)}}</label>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Bid Increase Amount<span class="requireddata"></span></label>
                            <div class="col-sm-6">
                                <label class="form-control"> {{number_format((int)$product->bid_increase_decrease_price)}}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="startdate" class="col-sm-3 text-end control-label col-form-label">Auction Start:<span class="requireddata"></span></label>
                              <div class="col-sm-6 dateinputgroup date" id="datetimepicker1" data-target-input="nearest">
                                <label class="form-control">{{$product->start_time_of_auction}}</label>
                                  
                              </div>
                          </div>

                          <div class="form-group row">
                            <label for="startdate" class="col-sm-3 text-end control-label col-form-label">Auction End:<span class="requireddata"></span></label>
                              <div class="col-sm-6 dateinputgroup date" id="datetimepicker2" data-target-input="nearest">
                                <label class="form-control">{{$product->end_time_of_auction}}</label>
                              </div>
                          </div>

                        
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-primary" style="float: right">
                                    Update For Invoice
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


@endsection


