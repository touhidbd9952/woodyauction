@extends('layouts.fontend_master')

@section('content')
 
 
 <!-- Swiper -->
 <!-- Breadcrumbs-->
 

<!--=============================  ======================================-->
<section class="section section-md bg-white" style="margin-top: -50px;">
  <div class="shell shell-wide wow fadeInUpSmall divsize" data-wow-offset="150" style="margin-left: 0px;margin-right:0px;">
    
    <style>
      .header_title{font-size: 18px !important;}
      .pl0{padding-left: 0px;}
      .pr0{padding-right: 0px;}
      .w100{width: 100%;}
      .choice ul{list-style-type: none;padding-left:0px;}
      .choice ul li{display: inline;height:20px;margin:6px 0px;}
      .choice ul li:nth-child(2)::before,.choice ul li:nth-child(3)::before,.choice ul li:nth-child(4)::before {
        content: '';
        display: inline-block;
        width: 1px;
        height: 20px;
        margin: 6px 1em;
        background-color: #aaa;
        -webkit-transform-origin: 50% 50%;
        -moz-transform-origin: 50% 50%;
        -ms-transform-origin: 50% 50%;
        transform-origin: 50% 50%;
        -webkit-transform: rotate(15deg);
        -moz-transform: rotate(15deg);
        -ms-transform: rotate(15deg);
        transform: rotate(15deg);
        vertical-align: top;
        }
      .choice ul li a.selected{color: rgb(5, 145, 40);padding: 0 5px;}
      .choice ul li a.newtoday{color: #f4b906;}
      .choice ul li a.endsoon{color: #ff0404;}
      .pmr{padding-right: 0px;}
      .tablegap{background: #fff;width:100%;height: 15px;}
      .table {width: 100%;max-width: 100%;margin-bottom: 0px !important;}
      input.reload {float:right;width: 96px;height: 35px;padding: auto;background: #ff8c00;color: #fff;background-size: auto;-webkit-background-size: 32px;-moz-background-size: 32px;-ms-background-size: 32px;background-size: 32px;font-size: 13px;margin: 0 auto;}
      input.bid {float: right;width: 96px;height: 35px;background: #1b9f36;color: #fff;font-weight: bold;}
      .pagination > .active > a, .pagination > .active > a:hover, .pagination > .active > a:focus, .pagination > .active > span, .pagination > .active > span:hover, .pagination > .active > span:focus {
    z-index: 3;color: #fff;background-color: #f5a63f;border-color: #f5a63f;cursor: default;}
    .pagination > li > a, .pagination > li > span {color: #f5a63f;}
    a.thumbnail:hover, a.thumbnail:focus, a.thumbnail.active {border-color: #f5a63f;}
    .table > thead > tr > th {border-bottom: 1px solid #ddd;}
    .item_selection i{font-style: normal;font-size: 14px;}
    span.bid {float: right;width: 96px;height: 35px;background: #b42d93;color: #fff;font-weight: bold;line-height: 30px;}
    /* .biddingstatusdiv{display: none;} 
    .biddiv{display: none;}  */
    .bidded_color{background: #FFCADC;}
    .greenmenu{padding:10px 15px !important; background: #1b9f36; color:#fff !important;}
    .yellowmenu{padding:10px 15px !important; background: #f5a63f; color:#fff !important;}
    .redmenu{padding:10px 15px !important; background: #ff0404; color:#fff !important;}
    
      @media(max-width:767px)
      {
          .pmr{padding-right: 15px;}
      }
  </style>    
  
  <div class="cat-items-grid">
  <section id="home" class="home-page-content page-content">

      {{-- <section class="homepage-slider">
      <div class="container">
      
      <div class="homeCarousel flexslider" data-animation="fade" data-slideshowspeed="2000">
      <ul class="slides">
      
      <li style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;" class="flex-active-slide">
          <a href=""><img src="{{ asset('fontend') }}/img/oldimg/banner1.jpg" alt="banners" draggable="false" style="max-height: 80px;width: 100%;"></a></li>
      
      </ul>
      <ul class="flex-direction-nav">
          <li class="flex-nav-prev"><a class="flex-prev flex-disabled" href="#" tabindex="-1">Previous</a></li>
          <li class="flex-nav-next"><a class="flex-next flex-disabled" href="#" tabindex="-1">Next</a></li></ul>
        </div>
      
      </div>
      </section> --}}
      
      
      <section class="products-section">
      <div class="container">
        <div class="row">  


        @include('inc.fontend_sidebar')




        <div id="main_contents" >
         <div style="width: 100%;min-height:100px;border:1px solid #ccc;padding:10px;">  
            
              <form action="{{route('auction.search')}}" method="POST" onsubmit="return searchvalidation()">
                
                @csrf

                  <div class="form-group row" style="max-height: 100px;">
                      <div class="col-sm-12 col-xs-12">
                          <label  class="header_title">{{$pagelanguage['LG_Item_Search']}}</label>
                      </div>
                      
                      <div class="col-sm-12">
                          <div class="row">
                              <div class="col-sm-3 col-xs-6  pr0">
                                  <label  class="border_none w100">{{$pagelanguage['LG_Model']}}</label>
                                  <input type="text" name="model" id="search_model" class="w100" value="{{isset($search_model)? $search_model:''}}" style="height: 30px;line-height: 30px;">   
                              </div>
  
                              <div class="col-sm-3 col-xs-6  pmr">
                                  <label  class="border_none w100">{{$pagelanguage['LG_Auction_No']}}：</label>
                                  <input type="text" name="auctionno" id="search_auctionno" class="w100" value="{{isset($search_auctionno)?$search_auctionno:''}}" style="height: 30px;line-height: 30px;">
                              </div>
  
                              <div class="col-sm-3 col-xs-6  pr0">
                                  <label  class="border_none w100">{{$pagelanguage['LG_Delivery_Yard']}}：</label>
                                  <select name="deliveryarea" id="search_deliveryarea" class="w100" style="height: 30px;line-height: 30px;border: 1px solid;background: #fff;border-radius: 3px;">
                                      <option value="" >---</option>
                                      @foreach($deliveryplaces as $deliverypl)
                                      <option value="{{$deliverypl->id}}" {{(isset($search_deliveryarea) && $search_deliveryarea == $deliverypl->id)?'selected':''}}>{{ $deliverypl->name_en }}</option>
                                      @endforeach
                                      
                                  </select>
                              </div>
                              <div class="col-sm-3 col-xs-6">
                                  <label  class="border_none w100">&nbsp;</label>
                                  <input type="submit" value="{{$pagelanguage['LG_Search']}}" style="width:80px;color: #000;">
                              </div>
                          </div>
                      </div>
                  </div>
              </form>
              
  
                  <div class="form-group row" style="max-height: 30px;">

                     <div class="col-sm-12 choice"> 
                         <div style="width: 100%;min-height: 40px;padding:8px 0px;margin-bottom:5px;float: left;border-top:1px solid #ccc;border-bottom:1px solid #ccc;">
                            <div style="width: 60px;float: left;"><label>{{$pagelanguage['LG_Choice']}}:</label></div>
                            <div style="width: 400px;float: left;">
                            <ul>
                                <?php 
                                if(!isset($selectedmenu)){$selectedmenu = 1;}
                                ?>
                                <li><a href="{{route('auction.all_product')}}" class="all selected {{$selectedmenu ==0?'greenmenu':''}}">{{$pagelanguage['LG_ALL']}}</a></li>
                                <li><a href="{{route('auction.new_today')}}" class="newtoday {{$selectedmenu ==1?'yellowmenu':''}}">{{$pagelanguage['LG_New_Today']}}!</a></li>
                                <li><a href="{{route('auction.end_today')}}" class="endsoon {{$selectedmenu ==2?'redmenu':''}}">{{$pagelanguage['LG_End_soon']}}!</a></li>
                            </ul>
                            </div>

                            <?php 
                            $logger_id = Session::get('logger_id'); 
                            $auctproducts = $auctionproducts->count() ;  
                            if($logger_id != '-1' && $auctproducts > 0)
                            {
                            ?>
                            <input type="button" class="button reload" onclick="reload_page();" value="{{$pagelanguage['LG_Reload']}}" style="padding: 0px 0px !important;float: right;margin-right:23px;">
                        <?php 
                            }
                            else if($logger_id == '-1' && $auctproducts>0)
                            {
                        ?>
                        <input type="button" class="button reload" onclick="auction_time_check();" value="{{$pagelanguage['LG_Refresh']}}" style="padding: 0px 0px !important;float: right;margin-right:23px;">
                        <?php 
                            }
                        ?>

                        
                    </div>

                    </div> 
                    {{-- end choice --}}
                </div>

                <?php
                    $sort =1; 
                    $sort = Session::get('sort'); 
                ?>
                <div class="form-group row" style="max-height: 30px;">
                    <div class="col-sm-12 choice"> 
                        <div style="width: 60px;float: left;"><label>{{$pagelanguage['LG_Sort']}}:</label></div>
                        <div style="width: 100%;min-width: 678px;display: inline;">
                        <ul>
                            <li>
                                Auction No.
                                <a href="{{route('auction.auctionno_asc',[$selectedmenu])}}">
                                    <?php if($sort ==1){?><img src="{{ asset('fontend') }}/images/selected_up.png" style="width: 19px;height:auto;"><?php }else{?><img src="{{ asset('fontend') }}/images/up.png" style="width: 19px;height:auto;"><?php }?>
                                </a>
                                <a href="{{route('auction.auctionno_desc',[$selectedmenu])}}">
                                    <?php if($sort ==2){?><img src="{{ asset('fontend') }}/images/selected_down.png" style="width: 20px;height:auto;margin-left: -5px;"><?php }else{?><img src="{{ asset('fontend') }}/images/down.png" style="width: 20px;height:auto;margin-left: -5px;"><?php }?>
                                </a>
                            </li>
                            <li>
                                Maker
                                <a href="{{route('auction.maker_asc',[$selectedmenu])}}">
                                    <?php if($sort ==3){?><img src="{{ asset('fontend') }}/images/selected_up.png" style="width: 19px;height:auto;"><?php }else{?><img src="{{ asset('fontend') }}/images/up.png" style="width: 19px;height:auto;"><?php }?>
                                </a>
                                <a href="{{route('auction.maker_desc',[$selectedmenu])}}">
                                    <?php if($sort ==4){?><img src="{{ asset('fontend') }}/images/selected_down.png" style="width: 20px;height:auto;margin-left: -5px;"><?php }else{?><img src="{{ asset('fontend') }}/images/down.png" style="width: 20px;height:auto;margin-left: -5px;"><?php }?>
                                </a>
                            </li>
                            <li>
                                Model
                                <a href="{{route('auction.model_asc',[$selectedmenu])}}">
                                    <?php if($sort ==5){?><img src="{{ asset('fontend') }}/images/selected_up.png" style="width: 19px;height:auto;"><?php }else{?><img src="{{ asset('fontend') }}/images/up.png" style="width: 19px;height:auto;"><?php }?>
                                </a>
                                <a href="{{route('auction.model_desc',[$selectedmenu])}}">
                                    <?php if($sort ==6){?><img src="{{ asset('fontend') }}/images/selected_down.png" style="width: 20px;height:auto;margin-left: -5px;"><?php }else{?><img src="{{ asset('fontend') }}/images/down.png" style="width: 20px;height:auto;margin-left: -5px;"><?php }?>
                                </a>
                            </li>
                            <li>
                                Time Left
                                <a href="{{route('auction.timeleft_asc',[$selectedmenu])}}">
                                    <?php if($sort ==7){?><img src="{{ asset('fontend') }}/images/selected_up.png" style="width: 19px;height:auto;"><?php }else{?><img src="{{ asset('fontend') }}/images/up.png" style="width: 19px;height:auto;"><?php }?>
                                </a>
                                <a href="{{route('auction.timeleft_desc',[$selectedmenu])}}">
                                    <?php if($sort ==8){?><img src="{{ asset('fontend') }}/images/selected_down.png" style="width: 20px;height:auto;margin-left: -5px;"><?php }else{?><img src="{{ asset('fontend') }}/images/down.png" style="width: 20px;height:auto;margin-left: -5px;"><?php }?>
                                </a>
                            </li>
                        </ul>
                        </div>
                      </div> 

                  </div>    
         </div>
         
         
  
         <div style="width: 100%;min-height:100px;border:1px solid #ccc;padding:10px;margin-top:15px;">
          <div class="form-group row">
              <div class="col-md-12 choice">
                  <div class=""> <!----table-responsive---->
                    
                      <table id="example2" class="table table-striped">
                          <thead>
                              <tr>
                                  <th>
                                      {{ $auctionproducts->links() }}
                                  </th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td style="background: #fff;">
                                    <?php  
                                         
                                        $bidder_id = Session::get('logger_id'); 
                                        $loginstatus = Session::get('loginstatus') ;
                                        $selected_product_list ="";
                                        if($bidder_id !="" && $loginstatus ==1)
                                        {
                                            $bidder_info = App\Models\Bidder_register::where('status','active')->where('id',$bidder_id)->get();
                                            $totalbidder = $bidder_info->count() ;
                                            if($totalbidder>0){
                                                $selected_product_list = $bidder_info[0]->selection;
                                            }
                                            
                                        }
                                         
                                    ?>
                                      
                                      @forelse ($auctionproducts as $actionpro)
                                          <?php 
                                              ///////time left calculation start////////
                                              $auction_startdate = strtotime($actionpro->start_time_of_auction);
                                              $auction_enddate = strtotime($actionpro->end_time_of_auction);
                                              $today_date = strtotime(Illuminate\Support\Carbon::now());
                                              $timeduration="";
                                              $day = 86400;
                                              $hour = 3600;
                                              $minute = 60;
                                              $daysout=0;
                                              $hoursout=0;
                                              $minutesout=0;
                                              $secondsout =0;
                                              $timeleft="";
                                              if($today_date <= $auction_startdate)
                                              {
                                                  //start - end
                                                  $timeduration =  $auction_enddate - $auction_startdate;
  
                                                  if($timeduration <=0){$timeleft = 0;}
                                                  else{
                                                      $daysout = floor($timeduration / $day);
                                                      $hoursout = floor(($timeduration - $daysout * $day)/$hour);
                                                      $minutesout = floor(($timeduration - $daysout * $day - $hoursout * $hour)/$minute);
                                                      $secondsout = (($timeduration - $daysout * $day - $hoursout * $hour - $minutesout * $minute)); 
                                                      
                                                      if($daysout>0){$timeleft=$daysout."d";}
                                                      if($hoursout>0){$timeleft.=" / ".$hoursout."h";}
                                                      if($minutesout>0){$timeleft.=" / ".$minutesout."m";}
                                                      if($daysout==0 && $hoursout==0 && $minutesout==0)
                                                      {
                                                        if($secondsout>0){$timeleft.= $secondsout." second";}else{$timeleft = 0;}    
                                                      }
                                                  }
                                              }
                                              else if($today_date > $auction_startdate && $today_date < $auction_enddate)
                                              {
                                                  //end - today
                                                  $timeduration =  $auction_enddate - $today_date;
  
                                                  if($timeduration <=0){$timeleft = 0;}
                                                  else{
                                                      $daysout = floor($timeduration / $day);
                                                      $hoursout = floor(($timeduration - $daysout * $day)/$hour);
                                                      $minutesout = floor(($timeduration - $daysout * $day - $hoursout * $hour)/$minute);
                                                      $secondsout = (($timeduration - $daysout * $day - $hoursout * $hour - $minutesout * $minute));  
                                                      if($daysout>0){$timeleft=$daysout."d";}
                                                      if($hoursout>0){$timeleft.=" / ".$hoursout."h";}
                                                      if($minutesout>0){$timeleft.=" / ".$minutesout."m";}
                                                      if($daysout==0 && $hoursout==0 && $minutesout==0)
                                                      {
                                                        if($secondsout>0){$timeleft.= $secondsout." second";}else{$timeleft = 0;}  
                                                      }   
                                                  }
                                              }
                                              else {
                                                  //old dated
                                                  $timeleft = 0;
                                                  
                                              }
                                              ///////time left calculation end////////
                                              
                                              ///////day,month,date calculation start////////
                                              $auction_enddate ="";
                                              $auction_enddate = strtotime($actionpro->end_time_of_auction);
                                              $bidclose = "CL:".date("D",$auction_enddate).".,".date("M",$auction_enddate).".".date("d",$auction_enddate);
                                               ///////day,month,date calculation end////////
                                               $isauctiondate_today = false;
                                               if(date("Y/m/d") == date("Y/m/d",strtotime($actionpro->auction_date)))
                                               {
                                                  $isauctiondate_today = true;
                                               }
  
                                               
                                          ?>
                                     
                                     
                                     <input type="hidden" id="id{{$actionpro->id}}" value="{{$actionpro->id}}">
  
                                     <table id="example2" class="table table-striped table-bordered">
                                        <tbody>
                                          <tr>
                                            <td rowspan="7"  style="width: 120px;">
                                                <div class="item_selection">
                                                    <?php 
                                                    
                                                    if($selected_product_list !="")
                                                    {
                                                        $selected_product = explode(",",$selected_product_list); 
                                                        if(in_array($actionpro->id, $selected_product))
                                                        {
                                                    ?>
                                                    <a onclick="removeFromWatchlist({{$actionpro->id}})" title="Remove From selection" style="cursor: pointer;">
                                                        <i class="fas fa-star" style="color:#ff8c00"></i>&nbsp;{{$pagelanguage['LG_RemoveFromselection']}}
                                                    </a>
                                                    <?php 
                                                        }
                                                        else 
                                                        {
                                                    ?>
                                                    <a onclick="addToWatchlist({{$actionpro->id}})" title="Add to selection" style="cursor: pointer;">
                                                        <i class="fas fa-star"></i>&nbsp;{{$pagelanguage['LG_AddToSelection']}}
                                                    </a>
                                                    <?php      
                                                        }
                                                    }
                                                    else 
                                                    {
                                                    ?>
                                                    <a onclick="addToWatchlist({{$actionpro->id}})" title="Add to selection" style="cursor: pointer;">
                                                        <i class="fas fa-star"></i>&nbsp;{{$pagelanguage['LG_AddToSelection']}}
                                                    </a>
                                                    <?php     
                                                    }
                                                    ?>
                                                </div>
                                                
                                                <div class="info" style="margin-top: 25px;margin-bottom: 65px;">
                                                <font style="color:#ff8c00">
                                                    <b style="color: #000;">{{$bidclose}}</b>
                                                    {{$isauctiondate_today==true?"New Today!":""}}
                                                </font> <!---CL:Tue.,Sep.28---->
                                                </div>

                                                @if($actionpro->videourl !="")
                                                <div style="width: 100%;">
                                                <a href="javascript:" onclick="windvideoopen({{$actionpro->id}});" style="display: block;text-align: center;">
                                                    <img src="{{ asset('fontend') }}/images/videoicon.jpg"  style="width:80px;"/>
                                                </a>
                                                </div>
                                                @endif

                                                <a class="thumbnail" href="{{route('auction.product_details',[$actionpro->id])}}">
                                                    <img src="{{url('/')}}/{{$actionpro->thumbnail_sm_image}}" id="image{{$actionpro->id}}" width="125" height="100">
                                                </a>
                                            </td>
                                              
                                            <th rowspan="7" colspan=""  class=" bidded_color " style="width: 300px;" nowrap="nowrap">
                                                    <table style="width:100%; ">
                                                      <tr>
                                                          <td  colspan="3">
                                                              <table>
                                                                  <tr>
                                                                      <th style="text-align:left;width:130px;">{{$pagelanguage['LG_Auction_No']}}</th>
                                                                      <th>:</th>
                                                                      <td style="text-align:left;padding-left:5px">
                                                                      <a href="{{route('auction.product_details',[$actionpro->id])}}">
                                                                            <!--- Auction Number---->
                                                                            <span id="product_no{{$actionpro->id}}" style="color: #f5a63f;">{{$actionpro->product_no}}</span>
                                                                        </a>
                                                                      </td>
                                                                  </tr>
                                                                  <tr>
                                                                      <th style="text-align:left">{{$pagelanguage['LG_Maker']}}</th>
                                                                       <th>:</th>
                                                                      <td style="text-align:left;padding-left:5px"><span id="brand{{$actionpro->id}}">{{strtoupper($actionpro->brand !=""?$actionpro->brand->name_en:"")}}</span></td>
                                                                  </tr>
                                                                  <tr>
                                                                      <th style="text-align:left">{{$pagelanguage['LG_Model']}}</th>
                                                                       <th>:</th>
                                                                      <td style="text-align:left;padding-left:5px;font-size: 16px;">
                                                                      <b><span id="modelno{{$actionpro->id}}">{{$actionpro->model_no}}</span> </b>
                                                                      </td>
                                                                  </tr>
                                                                  <tr>
                                                                    <th style="text-align:left">{{$pagelanguage['LG_Serial']}}</th>
                                                                     <th>:</th>
                                                                    <td style="text-align:left;padding-left:5px">
                                                                    <b><span id="serialno{{$actionpro->id}}">{{$actionpro->serial_no !=""? $actionpro->serial_no:""}}</span></b>
                                                                    </td>
                                                                </tr>
                                                              </table>
                                                          </td>
                                                      </tr>
                                                      <tr>
                                                          <td   colspan="">
                                                              <table style="border:none">
                                                                  <tr>
                                                                      <th style="text-align:left,width:130px ">{{$pagelanguage['LG_Year']}}</th>
                                                                       <th>:</th>
                                                                      <td style="text-align:left;padding-left:5px">
                                                                      <span id="modelyear{{$actionpro->id}}">{{$actionpro->model_year}}</span>
                                                                      </td>
                                                                  </tr>
                                                                  <tr>
                                                                      <th style="text-align:left;width:130px ">{{$pagelanguage['LG_Hour']}}</th>
                                                                       <th>:</th>
                                                                      <td style="text-align:left;padding-left:5px">
                                                                      <span id="usedhour{{$actionpro->id}}">{{$actionpro->used_hour}}</span>
                                                                      </td>
                                                                  </tr>
                                                                  <tr>
                                                                      <th style="text-align:left;width:130px ">{{$pagelanguage['LG_Delivery_Yard']}}</th>
                                                                       <th>:</th>
                                                                      <td style="text-align:left;padding-left:5px">
                                                                      <span id="deliveryplace{{$actionpro->id}}">{{$actionpro->delivery_place_id !=""? ucfirst($actionpro->delivery->name_en):""}}<br>{{$actionpro->delivery_status=="Arrived"?"Arrived (搬入済)":"Coming (未搬入)"}}</span>
                                                                      </td>
                                                                  </tr>
                                                                  <tr>
                                                                      <th style="text-align:left"><strong>{{$pagelanguage['LG_Releasing_Charge']}}</strong></th>
                                                                       <th>:</th>
                                                                      <td style="text-align:left;padding-left:5px">
                                                                      <strong><span id="realeasingcharge{{$actionpro->id}}">{{$actionpro->releasing_charge !=0?"JPY ".number_format($actionpro->releasing_charge):""}}</span></strong>
                                                                      </td>
                                                                  </tr>
                                                              </table>
                                                          </td>
                                                      </tr>
                                                      <tr>
                                                          <td   colspan="3">&nbsp;</td>
                                                      </tr>    
                                                      <tr>
                                                          <td rowspan="4" colspan="">
                                                              <table>
                                                                  <tr>
                                                                      <th style="text-align:left;width:130px;">{{$pagelanguage['LG_Current_Bid']}}</th>
                                                                      <th>:</th>
                                                                      <td style="text-align:left;padding-left:5px;font-size: 16px;">
                                                                      <strong>
                                                                            {{$pagelanguage['LG_JPY']}}
                                                                        
                                                                            <span id="auction_max_bidder_price{{$actionpro->id}}" >
                                                                                {{number_format($actionpro->bid_start_price < $actionpro->auction_max_bid_amount ? $actionpro->auction_max_bid_amount : $actionpro->bid_start_price)}}
                                                                            </span>
                                                                        
                                                                        </strong>
                                                                      </td>
                                                                  </tr>
                                                                  <tr>
                                                                      <th style="text-align:left">{{$pagelanguage['LG_Bidder_No']}}</th>
                                                                       <th>:</th>
                                                                      <td style="text-align:left;padding-left:5px">
                                                                      <?php 
                                                                            $usercodeno ="";
                                                                            if($actionpro->auction_max_bidder_id !=0)
                                                                            {
                                                                                $loggercodeno = Session::get('loggercodeno'); 
                                                                                $bidder = App\Models\Bidder_register::where('id',$actionpro->auction_max_bidder_id)->get(); 
                                                                                if($bidder[0]['usercodeno'] == $loggercodeno)
                                                                                {
                                                                                    $usercodeno = $bidder[0]['usercodeno']; 
                                                                                } 
                                                                                else 
                                                                                {
                                                                                    $usercodeno = substr($bidder[0]['usercodeno'], 0, 4)."****";
                                                                                }
                                                                                
                                                                            }
                                                                            ?>
                                                                            <span id="biddercountry{{$actionpro->id}}">
                                                                                    {{-- <img class="flag" src=""> --}}
                                                                            </span>
                                                                            <span id="auction_max_bidder_code{{$actionpro->id}}">{{$usercodeno}}</span>
                                                                      </td>
                                                                  </tr>
                                                                  <tr>
                                                                      <th style="text-align:left"><b>{{$pagelanguage['LG_Bids']}}</b></th>
                                                                       <th>:</th>
                                                                      <td style="text-align:left;padding-left:5px">
                                                                      <span id="totalbids{{$actionpro->id}}">{{$actionpro->total_bids}}</span>
                                                                      </td>
                                                                  </tr>
                                                                  <tr>
                                                                         <th style="text-align:left">{{$pagelanguage['LG_Time_Left']}}</th>
                                                                       <th>:</th>
                                                                      <td style="text-align:left;padding-left:5px">
                                                                     <span id="timeleft{{$actionpro->id}}">{{$timeleft}}</span>
                                                                      </td>
                                                                  </tr>
                                                              </table>
                                                          </td>
                                                      </tr>
                                                  </table>
                                            
                                            </th>
                                            <td rowspan="2" colspan="5">
                                                <table style="width: 100%;">
                                                    <tr style="border-bottom:1px solid #ccc;">
                                                        
                                                        <td style="border-bottom:none" colspan="3">
                                                            <div style="min-height: 100px;max-height:100px;overflow-y:auto ;">
                                                            <label style="width: 100%;">{{$pagelanguage['LG_Feature']}} &amp;{{$pagelanguage['LG_Comment']}}:</label>
                                                            <span id="featureandcomment{{$actionpro->id}}">{{$actionpro->long_description}}</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <?php 
                                                            $logger_id = Session::get('logger_id'); 
                                                            $loginstatus = Session::get('loginstatus');
                                                            if($logger_id == '-1' || $loginstatus == 2)
                                                            {
                                                            ?>   
                                                            <input type="button" class="button reload" onclick="time_check({{$actionpro->id}});" value="{{$pagelanguage['LG_Refresh']}}" style="padding: 0px 0px !important;float: right;margin-right:23px;">
                                                        <?php 
                                                            }
                                                        ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                        <table style="width: 100%;margin: 15px 0px;">
                                                            <?php 
                                                    //if logger_id qual to -1 then don't show
                                                    $logger_id = Session::get('logger_id'); 
                                                    $loginstatus = Session::get('loginstatus');
                                                    if($loginstatus == 1 && $logger_id != '-1')
                                                    {
                                                    ?>
                                                            <tr class="biddingstatusdiv"> 
                                                            <td style="width: 100%;">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                <div style="width: 100%;font-weight: bold;">{{$pagelanguage['LG_Bidding_Status']}}:</div>
                                                                <?php 
        
                                                                    $logger_id = Session::get('logger_id');  
                                                                    $biddingstatus ="";
                                                                    $biddingstatusresult_style ="";
                                                                    $autobidstatus ="";
                                                                    //   if($actionpro->auction_max_bidder_id == $logger_id)
                                                                    //   {
                                                                    //     $biddingstatus = "You are currently the highest bidder";
                                                                    //   }
        
                                                                    if($actionpro->bidding_result =="yes")
                                                                        {
                                                                            if(Session::get('logger_id') == $actionpro->auction_max_bidder_id)
                                                                            {
                                                                                $auction_history = "";
                                                                                $auction_history = App\Models\AuctionHistory::where('product_id',$actionpro->id)->where('bidder_id',$actionpro->auction_max_bidder_id)->where('highest_bidder',1)->get(); 
                                                                                
                                                                                $biddingstatus = $pagelanguage['LG_You_are_currently_the_highest_bidder'] ; 
                                                                                
                                                                                if($actionpro->bid_system == "AUTOBID"  )
                                                                                {
                                                                                    $autobidstatus ="";
                                                                                    $autobidstatus = "[".$pagelanguage['LG_autobid'] ." ".number_format($actionpro->auction_max_autobid_amount !=0? $actionpro->auction_max_autobid_amount:$actionpro->auction_max_bid_amount)."".$pagelanguage['LG_amount_sign']."]";
                                                                                }
                                                                                
                                                                                $biddingstatusresult_style = 'text-align:center; background-color:#29AE6C; line-height:35px;';  
                                                                            }
                                                                            else if(Session::has('logger_id') && Session::get('logger_id') != $actionpro->auction_max_bidder_id)
                                                                            {
                                                                                $bidderlist = "";
                                                                                $bidderlist = $actionpro->bidders;
                                                                                if($bidderlist !="")
                                                                                {
                                                                                    $bidderarray = explode(",", $bidderlist);
                                                                                    if(is_array($bidderarray))
                                                                                    {
                                                                                        if(count($bidderarray)>0)
                                                                                        {
                                                                                            if (in_array($bidder_id, $bidderarray) && $loginstatus ==1)
                                                                                            {
                                                                                                if($bidder_id != $actionpro->auction_max_bidder_id)
                                                                                                {
                                                                                                    $biddingstatus = "" ;
                                                                                                    $biddingstatus = $pagelanguage['LG_You_are_not_currently_the_highest_bidder'] ;
                                                                                                    $biddingstatusresult_style = 'text-align:center; background-color:#FF1F0E; line-height:35px;';
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
        
                                                                                }
                                                                                
                                                                            }
                                                                            else if($actionpro->total_bids >0)
                                                                            {
                                                                                $biddingstatus = "" ;
                                                                                $biddingstatusresult_style = 'text-align:center;';
                                                                            }
                                                                            else 
                                                                            {
                                                                                $bidderlist = "";
                                                                                $bidderlist = $actionpro->bidders;
                                                                                if($bidderlist !="")
                                                                                {
                                                                                    $bidderarray = explode(",", $bidderlist);
                                                                                    if(is_array($bidderarray))
                                                                                    {
                                                                                        if(count($bidderarray)>0)
                                                                                        {
                                                                                            if (in_array($bidder_id, $bidderarray) && $loginstatus ==1)
                                                                                            {
                                                                                                if($bidder_id != $actionpro->auction_max_bidder_id)
                                                                                                {
                                                                                                    $biddingstatus = "" ;
                                                                                                    $biddingstatus = $pagelanguage['LG_You_are_not_currently_the_highest_bidder'] ;
                                                                                                    $biddingstatusresult_style = 'text-align:center; background-color:#FF1F0E; line-height:35px;';
                                                                                                }
                                                                                            }
                                                                                            else 
                                                                                            {
                                                                                                $biddingstatus = "" ;
                                                                                                $biddingstatusresult_style = 'text-align:center;';
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                                else
                                                                                {
                                                                                    $biddingstatus = "" ;
                                                                                    $biddingstatusresult_style = 'text-align:center;';
                                                                                }
                                                                                
                                                                            }
                                                                        }
                                                                ?>
                                                                <div style="width: 100%;min-height: 50px;{{$biddingstatusresult_style}}" id="biddingstatusresult{{$actionpro->id}}"  style="{{$biddingstatusresult_style}}">
                                                                    <div >
                                                                        <?php 
                                                                            if($biddingstatus != "")
                                                                            {
                                                                            ?>
                                                                                <b style="display:inline-block;">
                                                                                    <span id="biddingstatus{{$actionpro->id}}">
                                                                                        {{$biddingstatus}}
                                                                                        <?php 
                                                                                        if($autobidstatus !="")
                                                                                        {
                                                                                        ?>
                                                                                            <span style="display: block;margin-top: -20px;">
                                                                                            {{$autobidstatus}}
                                                                                            </span>
                                                                                        <?php 
                                                                                        }
                                                                                        ?>
                                                                                    </span>
                                                                                </b>
                                                                            <?php 
                                                                            }
                                                                            ?>    
                                                                    </div>
                                                                    
                                                                </div>
                                                                
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <input type="button" class="button reload" onclick="reload({{$actionpro->id}});" value="{{$pagelanguage['LG_Reload']}}" style="padding: 0px 0px !important;">
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            </tr>
                                                            <tr class="biddiv">
                                                               
                                                                <td colspan="3">
                                                                    <lable>{{$pagelanguage['LG_Bid']}}</lable>
                                                                    <form action="{{route('auction.bidforthis',[$actionpro->id])}}" method="post" onsubmit="return validate({{$actionpro->id}});">
                                                                        @csrf
        
                                                                    <input type="hidden" name="biddecreaseprice{{$actionpro->id}}"  id="biddecreaseprice{{$actionpro->id}}" value="{{$actionpro->bid_increase_decrease_price}}">
                                                                    <input type="hidden" name="bidincreaseprice{{$actionpro->id}}"  id="bidincreaseprice{{$actionpro->id}}" value="{{$actionpro->bid_increase_decrease_price}}">
                                                                    <input type="hidden" name="bidcurrentprice"  id="bidcurrentprice{{$actionpro->id}}" value="{{$actionpro->bid_start_price < $actionpro->auction_max_bid_amount ? $actionpro->auction_max_bid_amount : $actionpro->bid_start_price}}">
                                                                    <input type="hidden" name="bidingstartprice{{$actionpro->id}}"  id="bidingstartprice{{$actionpro->id}}" value="{{$actionpro->bid_start_price}}">
                                                                    <input type="hidden" name="bidtotalprice{{$actionpro->id}}"  id="bidtotalprice{{$actionpro->id}}" value="{{$actionpro->bid_start_price < $actionpro->auction_max_bid_amount ? $actionpro->auction_max_bid_amount : $actionpro->bid_start_price}}">
        
        
                                                                    <input type="button" id="{{$actionpro->id}}"  value="-{{number_format($actionpro->bid_increase_decrease_price)}}" onclick="biddecreasepriceset(this.id)"   style="width: 80px;height:35px;border-radius:3px;">
                                                                    <input type="text" name="bidprice{{$actionpro->id}}"   id="bidprice{{$actionpro->id}}"  value="{{number_format($actionpro->bid_start_price < $actionpro->auction_max_bid_amount ? $actionpro->auction_max_bid_amount : $actionpro->bid_start_price)}}" style="height:35px;width: 120px;text-align:center;"  readonly="readonly">
                                                                    <input type="button"  id="{{$actionpro->id}}"  value="+{{number_format($actionpro->bid_increase_decrease_price)}}" onclick="bidincreasepriceset(this.id)"  style="width: 80px;height:35px;border-radius:3px;">
                                                                    <span id="bidbutton{{$actionpro->id}}">
                                                                    <?php 
                                                                    //if($timeleft !=0)
                                                                    //{
                                                                        //if($actionpro->auction_max_bidder_id != $logger_id)
                                                                        //{
                                                                    ?>
                                                                    <input type="submit"  value="{{$pagelanguage['LG_Bids']}}" class="button bid" style="padding: 0px 0px !important;margin-top: 0px;">
                                                                    
                                                                    </span>
        
                                                                    </form>  
                                                                </td>
                                                            </tr>
                                            
                                                    <?php 
                                                    }
                                                    //if logger_id qual to -1 then don't show
                                                    ?>
                                                        </table>  
                                                        </td>  
                                                    </tr>    
                                                </table>
                                            </td>
                                              
                                            
                                          </tr>
                                          
                                          
                                            
                                            
                                            
                                          
                                        </tbody>
                                          
                                        <div class="tablegap"></div>
                                        @empty
                                            <p style="font-size: 16px;font-weight: bold;">{{$pagelanguage['LG_Sorry_No_Auction_Data_Found']}}</p>
                                        @endforelse
                                    </table>
                                    </td> 
                                    </tr>
                                </tbody>
                                
                            </table>        
                                          
                               




                    
                      
                      {{ $auctionproducts->links() }}
                      
  

                  </div>    
              </div>
          </div>    
         </div>

         <?php 
            $logger_id = Session::get('logger_id'); 
            $auctproducts = $auctionproducts->count() ;
            if($logger_id != '-1' && $auctproducts>0)
            {
            ?>
            <input type="button" class="button reload" onclick="reload_page();" value="{{$pagelanguage['LG_Reload']}}" style="padding: 0px 0px !important;float: right;margin-right:23px;">
        <?php 
            }
            else if($logger_id == '-1' && $auctproducts>0)
            {
        ?>
        <input type="button" class="button reload" onclick="auction_time_check();" value="{{$pagelanguage['LG_Refresh']}}" style="padding: 0px 0px !important;float: right;margin-right:23px;">
        <?php 
            }
        ?>
        
        </div>
       </div>
      
      </div>
      </section>
      
      
      </section>
  </div>
    
    
  </div>
</section>

<script>
    function windvideoopen(pid)
    {
    
        var w_size=1050;
        var h_size=750;
    
        var l_position=Number((window.screen.width-w_size)/2);
        var t_position=Number((window.screen.height-h_size)/2);
    
        window.open('/product/product_video?id='+pid,'newWindow2','toolbar=no,statusbar=no,status=no,scroll=yes,scrollbars=yes,location=no,directories=no,menubar=no,resizable=yes,width='+ w_size +',height='+h_size+',left='+l_position+',top='+t_position);
    
    }
    </script>
    <script>
        function validate(pid)
        {
            var bidcurrentprice = document.getElementById('bidcurrentprice'+pid).value;
            var bidprice = document.getElementById('bidprice'+pid).value;
            if(bidcurrentprice !="" && bidprice <= bidcurrentprice)
            {
                alert('Someone already bid at this price, Please increase your bid price');
                return false;
            }
            else
            {
                return true;
            }
            
        }
    </script>
    <script>
        function searchvalidation()
        {
            var search_model = document.getElementById('search_model').value;
            var search_auctionno = document.getElementById('search_auctionno').value;
            var search_deliveryarea = document.getElementById('search_deliveryarea').value;

            if(search_model =="" && search_auctionno =="" && search_deliveryarea =="")
            {
                return false;
            }
            else
            {
                return true;
            }
        }
    </script>

  @endsection