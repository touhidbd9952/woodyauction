@extends('layouts.admin_master')

@section('content')
<style>
    .bidderinfo{width: 500px;background: #fff;position: absolute;top: 0px;z-index: 1000;left: 500px;overflow-x: auto;display: none;}
    input.reload {float: right;width: 96px;height: 35px;padding: auto;background: #ff8c00;background-size: auto;color: #fff;background-size: auto;-webkit-background-size: 32px;-moz-background-size: 32px;-ms-background-size: 32px;background-size: 32px;font-size: 13px;margin: 0 auto;margin-right: auto;}
</style>    
<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Auction Bidder List</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Auction Bidder List </li>
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
                    <div style="float: left;margin-right:10px;">
                        <img src="{{asset($products[0]->thumbnail_image)}}"  style="width: 150px;height:auto;">
                    </div>
                    <div class="card-title" style="float: left;">
                        <input type="hidden" id="pid" value="{{ $products[0]->id}}">
                        <span style="width: 80px;display: inline-block;">Category </span>: {{ $products[0]->category->name_en}} <br>
                        <span style="width: 80px;display: inline-block;">Maker</span>: {{ $products[0]->brand_id !=""? $products[0]->brand->name_en:""}} <br>
                        <span style="width: 80px;display: inline-block;">Model</span>: {{ $products[0]->model_no}} <br>
                        <span style="width: 80px;display: inline-block;">Serial</span>: {{ $products[0]->serial_no}} <br>
                        <span style="width: 80px;display: inline-block;">Total Bids</span>: <span id="totalbid">{{ $products[0]->total_bids}}</span> <br>
                        <input type="button" class="button reload" onclick="showbidrecord({{$products[0]->id}});" value="Reload" style="padding: 0px 0px !important;">
                    </div>   
                    <div id="bidderinfo" class="bidderinfo">
                        
                        <table class="table" style="width: 900px;">
                            <thead>
                                <tr>
                                    <th style="min-width: 120px">Biddere No </th>
                                    <th style="min-width: 120px">Company Name </th>
                                    <th>President Name </th>
                                    <th>Person In Charge</th>
                                    <th>Country</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            <tbody id="bidderview">
                                
                            </tbody>
                        </table>
                         
                    </div> 
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr id="history_table_head">
                                    <th>Bidder No.</th>
                                    <th>Bidding Price</th>
                                    <th>Bid System</th>
                                    <th>Bid Time</th>
                                </tr>
                            </thead>
                            <tbody id="bidview">
                                
                            @foreach($auction_history as $ahistory)
         
                            <tr>
                             <td>
                                 <span onmouseover="showbidder({{$ahistory->bidder_id}})" style="text-decoration: underline;cursor: pointer;">{{$ahistory->bidder->usercodeno}} </span>    
                             </td>
                             <td>{{number_format($ahistory->bidding_price)}}</td>
                             <td>
                               {{$ahistory->bid_system}} 
                             </td>
                             
                             <td>{{$ahistory->bid_time}}</td> 
                           </tr>
                                 
                           @endforeach
                                
                            </tbody>
                            
                        </table>

                       

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function showbidrecord(pid)
    { 
        $.ajax({
            type:'GET',
            url: '/auction/bidinfo/'+pid,
            dataType:'json',
            success:function(data){  
            document.getElementById("bidview").innerHTML ="";
            var tablerow ="";  
            $.each(data.auction_history,function(key,ahistory){   
              
                tablerow += `<tr>
                        <td><span onmouseover="showbidder(${ahistory.bidder_id})" style="text-decoration: underline;cursor: pointer;">${ahistory.bidder.usercodeno} </span></td>
                        <td>${ahistory.bidding_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
                        <td>${ahistory.bid_system}</td>
                        <td>${ahistory.bid_time}</td>
                    </tr>`  
              });
              $('#bidview').html(tablerow);
              document.getElementById('totalbid').innerHTML = data.products[0].total_bids;
            }
        })
    }
</script>


@endsection


