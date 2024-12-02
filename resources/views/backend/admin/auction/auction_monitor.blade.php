@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">
                            Auction Monitor 
                            <div id="txt" style="display: inline-block;margin-left: 20px;"></div>
                        </h4>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        ({{$start_time_of_auction}} - {{$end_time_of_auction}})
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Auction Monitor 
                                        <input type="button" class="button reload" onclick="auctionmonitoring();" value="Reload" style="padding: 0px 0px !important;">
                                    </li>
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
                

                <div class="card-body" style="padding: .25rem !important; ">
                  
                    <div class="table-responsive" id="auctionmonitor">
                        
                            @foreach($products as $b)
                                
                                    <div class="col-md-4" style="width: 340px !important;border: 1px solid #ccc;height:130px;border-radius: 5px;display:inline-block;margin-right: 1px;margin-bottom: 5px;">
                                        <div style="height:85px;">
                                            <div style="float: left;">
                                                <a href="{{url('auction/biddersview/'.$b->id)}}">
                                                <img src="{{asset($b->thumbnail_sm_image)}}"  style="width: 110px;height:auto;padding:5px;">
                                                </a>
                                            </div>
                                            <div style="float: left;">
                                                <a href="{{url('auction/biddersview/'.$b->id)}}" style="text-decoration: underline;cursor: pointer;">
                                                {{ $b->product_no}} 
                                                </a>
                                                <br>
                                                {{ $b->category->name_en}}<br>
                                                {{$b->brand->name_en}}<br>
                                                {{ $b->model_no}}{{ $b->serial_no !=""? " / ".$b->serial_no:""}}
                                            </div>
                                        </div>
                                        <div style="height:20px;padding:0 5px;font-weight: bold;">
                                            <span id="totalbids{{$b->id}}" style="width: 102px;display: inline-block">{{ $b->total_bids !=0?"Total Bid: ".$b->total_bids:"Total Bid: 0"}}</span>
                                            <span id="timeleft{{$b->id}}" style="min-width: 100px;display: inline-block">{{ $b->total_bids !=0?"Time Left: ".$b->total_bids:"Time Left: 0"}}</span>
                                        </div>
                                        <div style="height:20px;padding:0 5px;font-weight: bold;">
                                            <span id="autobidamount{{$b->id}}" style="width: 150px;display:inline-block;margin-right:10px;">{{ $b->auction_max_autobid_amount !=0?"  A-Bid : ".number_format($b->auction_max_autobid_amount):"  A-Bid : 0"}}</span>
                                            <span id="currentbidamount{{$b->id}}" style="width: 150px;display:inline-block;">{{ $b->auction_max_bid_amount !=0?"  C-Bid : ".number_format($b->auction_max_bid_amount):"  C-Bid : 0"}}</span>
                                        </div>

                                    </div>
                                    
                            @endforeach

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


<script>
function auctionmonitoring()
{
    $.ajax({
            type:'GET',
            url: '/auction/monitor_forview',
            dataType:'json',
            success:function(data)
            {    
                $.each(data.products,function(key,aproduct){   //alert(Date.parse(aproduct.start_time_of_auction));
            

                    document.getElementById('totalbids'+aproduct.id).innerHTML = "Total Bid: "+aproduct.total_bids;
                    document.getElementById('currentbidamount'+aproduct.id).innerHTML = "  C-Bid : "+parseInt(aproduct.auction_max_bid_amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    document.getElementById('autobidamount'+aproduct.id).innerHTML = "  A-Bid : "+parseInt(aproduct.auction_max_autobid_amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    //auction time calculation start 
                    var auction_startdate = new Date(aproduct.start_time_of_auction);  
                    auction_startdate = auction_startdate.getTime() / 1000;   
                    var auction_enddate = new Date(aproduct.end_time_of_auction);
                    auction_enddate = auction_enddate.getTime() / 1000; 
                    var today_date = new Date(Date.now());   
                    today_date = today_date.getTime() / 1000;

                    var timeduration="";
                    var day = 86400;
                    var hour = 3600;
                    var minute = 60;
                    var daysout=0;
                    var hoursout=0;
                    var minutesout=0;
                    var secondsout =0;
                    var timeleft="";
                    if(today_date < auction_startdate)
                    {
                        //start - end
                        //alert('paisi-1');
                        timeduration =  auction_enddate - auction_startdate;

                        if(timeduration <=0){timeleft = 0;}
                        else
                        {
                            daysout = Math.floor(timeduration / day);
                            hoursout = Math.floor((timeduration - daysout * day)/hour);
                            minutesout = Math.floor((timeduration - daysout * day - hoursout * hour)/minute);
                            secondsout = Math.floor((timeduration - daysout * day - hoursout * hour - minutesout * minute)/60);
                            if(daysout>0){timeleft=daysout+"d";}
                            if(hoursout>0){timeleft +=" / "+hoursout+"h";}
                            if(minutesout>0){timeleft += " / "+minutesout+"m";}
                            //if(secondsout>0){$timeleft += $secondsout+" second";}
                        }
                    }
                    else if(today_date >= auction_startdate && today_date <= auction_enddate)
                    {
                        //end - today
                        //alert('paisi-2');
                        timeduration =  auction_enddate - today_date;

                        if(timeduration <=0){timeleft = 0;}
                        else{
                            daysout = Math.floor(timeduration / day);
                            hoursout = Math.floor((timeduration - daysout * day)/hour);
                            minutesout = Math.floor((timeduration - daysout * day - hoursout * hour)/minute);
                            secondsout = Math.floor((timeduration - daysout * day - hoursout * hour - minutesout * minute)/60);
                            if(daysout>0){timeleft=daysout+"d";}
                            if(hoursout>0){timeleft +=" / "+hoursout+"h";}
                            if(minutesout>0){timeleft += " / "+minutesout+"m";}
                            if(secondsout>0){timeleft += secondsout+" second";}
                        }
                    }
                    else {
                        //old dated
                        //alert('paisi-3');
                        timeleft = 0;
                    }
                    document.getElementById('timeleft'+aproduct.id).innerHTML = "Time Left: "+timeleft;

                    //auction time calculation end
              });
              
            }
        })
        setTimeout(auctionmonitoring, 6000);
}
</script>



@endsection


