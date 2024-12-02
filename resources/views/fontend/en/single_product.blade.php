@extends('layouts.fontend_master')

@section('content')


<style>
  .slick-slider-vertical .slick-thumb > img {
    position: absolute;
    top: -1px;
    display: block;
    width: 101%;
    height: 101%;
}
input.reload {float:right;width: 96px;height: 35px;padding: auto;background: #ff8c00;color: #fff;background-size: auto;-webkit-background-size: 32px;-moz-background-size: 32px;-ms-background-size: 32px;background-size: 32px;font-size: 13px;margin: -2px 0 0 15px;}
input.bid {float: right;width: 96px;height: 35px;background: #1b9f36;color: #fff;font-weight: bold;}
.buttons {
    margin-top: 24px;
    padding: 16px 0 8px 0;
    border-top: 1px dotted #ccc;
    overflow: hidden;
}
.bidtimeleft img{width: 16px;margin-right: 4px;}
.logindiv{min-width: 410px;}

@media(max-width:767px)
{
   .mobp{margin-top: 30px;}
   .logindiv {min-width: 320px;}
   .reload{margin-top: 10px !important;}
   .layout-horizontal > * + * {margin-top: 0px;}
   .tabs-custom.tabs-inline * + .tab-content {margin-top: 0px;}
   .section__header {padding-bottom: 0px; }
   .slick-slider-vertical .slick-image {padding: 0 0px;}
   section.section-sm:first-of-type, section.section-md:first-of-type, section.section-lg:first-of-type, section.section-xl:first-of-type, section.section-xxl:first-of-type {
    padding-top: 10px;}
    .section-sm, .section-md, .section-lg, .section-xl, .section-xxl {padding: 50px 0 10px 0;padding-top: 50px;}
    #login{margin-top: 20px;}
}
span.bid {
    float: right;
    width: 96px;
    height: 35px;
    background: #b42d93;
    color: #fff;
    font-weight: bold;
    line-height: 30px;
}
.tabs-custom.tabs-inline * + .tab-content {
    margin-top: 0px !important;
}
.section-lg {
    padding: 20px 0;
}
.slick-slider-vertical .carousel-parent .slick-slide {
    padding: 0 0px 0 0;
}





.slick-track{opacity: 1; height: 300px !important; transform: translate3d(0px, 0px, 0px) !important;}
.slick-prev,.slick-next{display: block !important;}
#child-carousel-1{
  width: 195px;
}
.slick-slider-vertical .carousel-child .slick-slide {
    padding: 9px 0;
    width: inherit;
    width: 95px !important;
}
.slick-slider-vertical .carousel-child {
    width: 95px;
}
.slick-slider-vertical .carousel-child {
    position: relative;
    overflow: visible !important;
}
.slick-vertical .slick-slide {
    display: block;
    height: auto;
    border: 1px solid transparent;
    float: left !important;
    width:95px
}
</style>

<style>
  body {
    font-family: Arial;
    margin: 0;
  }
  
  * {
    box-sizing: border-box;
  }
  
  img {
    vertical-align: middle;
  }
  
  /* Position the image container (needed to position the left and right arrows) */
  .container {
    position: relative;
  }
  
  /* Hide the images by default */
  .mySlides {
    display: none;
  }
  
  /* Add a pointer when hovering over the thumbnail images */
  .cursor {
    cursor: pointer;
  }
  
  /* Next & previous buttons */
  .prev,
  .next {
    cursor: pointer;
    position: absolute;
    top: 40%;
    width: auto;
    padding: 16px;
    margin-top: -50px;
    color: white;
    font-weight: bold;
    font-size: 20px;
    border-radius: 0 3px 3px 0;
    user-select: none;
    -webkit-user-select: none;
  }
  
  /* Position the "next button" to the right */
  .next {
    right: 0;
    border-radius: 3px 0 0 3px;
  }
  
  /* On hover, add a black background color with a little bit see-through */
  .prev:hover,
  .next:hover {
    background-color: rgba(0, 0, 0, 0.8);
  }
  
  /* Number text (1/3 etc) */
  .numbertext {
    color: #f2f2f2;
    font-size: 12px;
    padding: 8px 12px;
    position: absolute;
    top: 0;
  }
  
  /* Container for image text */
  .caption-container {
    text-align: center;
    /* background-color: #222; */
    padding: 2px 16px;
    color: white;
  }
  
  .row:after {
    content: "";
    display: table;
    clear: both;
  }
  
  /* Six columns side by side */
  .column {
      width: 95px;
      /* height: 80px; */
      border: 1px solid #f9c706;
      display: block;
    float: left;
	overflow: hidden;
  }
  
  /* Add a transparency effect for thumnbail images */
  .demo {
    opacity: 1;
    border: 2px solid #f9c706;
  }
  
  img.active,
  img.demo:hover {
    opacity: 1;
    border: 2px solid #f70606;
  }
  .divpicarea{width:100%;min-height:200px;max-height:510px;overflow-y:auto;overflow-x: hidden;padding-bottom: 15px;}
  .divvideoarea{width:auto;max-height:160px;}
  .next {right: 15px;border-radius: 3px 0 0 3px;}
  .download{display: block;background: #3c3b3b;color: #fbfafa;font-weight: bold;}
  .cond{display: block;background: #6c6c6c;color: #fbfafa;font-weight: bold;margin-top:5px;}
  .btn:hover, .btn:focus, .btn.focus {
    color: #fbfafa;
    text-decoration: none;
}
.layout-bordered__main {
  width: 71%;
  padding: 0 0px !important;
}



@font-face {
  font-family: 'password';
  font-style: normal;
  font-weight: 400;
  src: url(https://jsbin-user-assets.s3.amazonaws.com/rafaelcastrocouto/password.ttf);
}
input.myclass{font-family: 'password';}

  @media(max-width:767px)
  {
    .divpicarea{max-height: 360px !important;}
  }
  </style>
<!-- Breadcrumbs-->
<?php 
  $base_url = Session::get('base_url');
?>


  <!-- Our production-->
  <section class="section section-md bg-white" style="margin-top: -50px;">
    <div class="shell">
      <div class="tabs-custom tabs-custom-init tabs-inline" id="tabs-production">
        <!-- Section Header-->
        <div class="section__header">
          <h4 style="color:#F5A64E;font-weight:bold;">{{$pagelanguage['LG_Auction_No']}}:{{$products[0]->product_no}}</h4>
          <div class="section__header-element">
            <!-- Nav tabs-->
            <div class="navigation-custom">
              <button class="button navigation-custom__toggle" data-custom-toggle=".navigation-custom__content" data-custom-toggle-hide-on-blur="true">Filter</button>
              <div class="navigation-custom__content">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tabs-production-1" data-toggle="tab"> </a></li>
                  
                </ul>
              </div>
            </div>
          </div>
        </div>

        
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane fade in active" id="tabs-production-1">
            <div class="layout-horizontal layout-horizontal_md-reverse">
              <div class="layout-horizontal__main">
                @foreach($products as $p)
                {{-- <h4>{{$p->title}}</h4> --}}
                <p>{{$p->detail_des}}</p>
                @endforeach
              </div>
              
              <!---------==================================----------------------->
      
              <div class="row">
                <div class="col-md-4 col-xs-4" style="margin-bottom: 0px;">
                <div class="divpicarea">
                  <?php 
                    $countimage = count($product_multiple_images);
                    $i=1;
                    $j=1;
                  ?>

                  <input type="hidden" id="countimage" value="{{$countimage}}">

                  @foreach($product_multiple_images as $pimages)
                  <?php 
                  if($i<=$countimage)
                  {
                  ?>
                    <div class="column">
                      <img id="{{$i}}" class="demo cursor" src="{{file_exists($pimages->image_sm)==true? asset($pimages->image_sm) :asset($pimages->image_L)}}" style="width:100%" onclick="show('{{asset($pimages->image_L)}}',{{$i}})" alt="{{asset($pimages->image_L)}}">
                    </div>
                   <?php 
                   $i++;
                  }
                   ?> 
                  @endforeach
                  </div>

                  
                </div>
                
                <div class="col-md-8 col-xs-8">
                  <div style="width: 100%;">
                  
                  <a href="javascript:" onclick="preimage()" style="float: left;padding:5px;background: #f9c706;color: #fff;width: 80px;text-align: center;font-weight: bold;">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                  </a>
                  <a href="javascript:" onclick="nextimage()" style="float: right;padding:5px;background: #f9c706;color: #fff;width: 80px;text-align: center;font-weight: bold;">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                  </a>
                </div>
                  @foreach($product_multiple_images as $pimages)
                  <?php 
                  if($j==1)
                  {
                  ?>
                    <div class="mySlides">
                      <img id="largeimg" src="{{ asset($pimages->image_L) }}" style="width:100%">
                    </div>
                    <?php 
                   $j++;
                  }
                   ?> 
                  @endforeach

                    
                
                  
                {{-- <a class="prev" onclick="showSlides(-1)">❮</a>
                <a class="next" onclick="showSlides(1)">❯</a> --}}
              
                <div class="caption-container">
                  <p id="caption"></p>
                </div>
              </div>
              
              <div class="col-md-12 col-xs-12">
                <div class="divvideoarea">
                  <?php 
                    $countvideo = count($product_multiple_videos);
                    $k=1;
                    $l=1;
                  ?>
                  @foreach($product_multiple_videos as $pvideo)
                  <?php 
                  if($k<=$countvideo)
                  {
                  ?>
                    <div style="width: 200px;float: left;margin-right: 5px;">
                      <video style="width:100%;" controls  style="margin-top: -80px;" onclick="currentSlide({{$k}})">
                        <source src="{{ asset($pvideo->video) }}" type="video/mp4">
                      </video>
                
                    </div>
                   <?php 
                   $k++;
                  }
                   ?> 
                  @endforeach

                  
                  @if($p->videourl !="")
                  <div style="width: 160px;float: left;margin-right: 5px;">
                    <a onclick="windvideoopen({{$p->id}});" href="javascript:">
                      <img src="{{ asset('fontend') }}/images/videoicon.JPG"  style="width:65px;"/>
                    </a>
                  </div>
                  @endif  

                  <style>
                  .ytp-title{display: none !important;}
                  </style>
              
                  </div>
              </div>

              <div class="col-md-12 col-xs-12">
                <div style="padding-bottom:1px;padding-top:15px;" class="btn_menu">
                  <table cellspacing="0" cellpadding="0" border="0">
                    <tbody><tr>
                      <td>
                      <a href="{{url('auction/downloadZip/'.$p->id)}}" class="btn download">
                        {{$pagelanguage['LG_Download_Photos']}}
                      </a>
                
                      
                <script language="javascript">
                function windvideoopen(pid)
                {
                
                    var w_size=1050;
                    var h_size=750;
                
                    var l_position=Number((window.screen.width-w_size)/2);
                    var t_position=Number((window.screen.height-h_size)/2);
                
                    window.open('/product/product_video?id='+pid,'newWindow2','toolbar=no,statusbar=no,status=no,scroll=yes,scrollbars=yes,location=no,directories=no,menubar=no,resizable=yes,width='+ w_size +',height='+h_size+',left='+l_position+',top='+t_position);
                
                }
                function windopen(pid)
                {
                
                    var w_size=1050;
                    var h_size=750;
                
                    var l_position=Number((window.screen.width-w_size)/2);
                    var t_position=Number((window.screen.height-h_size)/2);
                
                    window.open('/product/conditional_report?id='+pid,'newWindow2','toolbar=no,statusbar=no,status=no,scroll=yes,scrollbars=yes,location=no,directories=no,menubar=no,resizable=yes,width='+ w_size +',height='+h_size+',left='+l_position+',top='+t_position);
                }
                
                </script>
                      <a onclick="windopen({{$p->id}});" href="javascript:" class="btn cond">
                        {{$pagelanguage['LG_Condition_Report']}}
                      </a>
                      
                      </td>
                    </tr>
                  </tbody></table>
                  </div>
              </div>  


              </div>
              
                
                

              <!-----------================================----------------------->

            </div>


            @foreach($products as $actionpro)
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
                          if($daysout>0){$timeleft=$daysout."d /";}
                          if($hoursout>0){$timeleft.=$hoursout."h";}
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
              ?>
            @endforeach
            <!---======= Customer Contact ==================-->

            <!-- Get in Touch-->
         
  <section class="section section-lg bg-white">
    <div class="">
      <div class="layout-bordered">
        <div class="layout-bordered__main text-center" style="width: 100%;">
          <div class="layout-bordered__main-inner">
            {{-- <h3 style="text-align: left;">{{$pagelanguage['LG_Product_details']}}</h3> --}}
            <div class="row">
              <div class="col-md-5" style="margin-bottom: 30px;">
               <!-- RD Mailform-->
            <table id="product_details" width="100%" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                @foreach($products as $actionpro)   

                <input type="hidden" id="product_no{{$actionpro->id}}">
                <input type="hidden" id="brand{{$actionpro->id}}">
                <input type="hidden" id="biddercountry{{$actionpro->id}}">
                <input type="hidden" id="auction_max_bidder_code{{$actionpro->id}}">
                <input type="hidden" id="bidder_id{{$actionpro->id}}">
                <input type="hidden" id="totalbids{{$actionpro->id}}">
                <input type="hidden" id="biddingstatus{{$actionpro->id}}">
                <input type="hidden" id="biddingstatusresult{{$actionpro->id}}">

              <tr>
                <th>{{$pagelanguage['LG_Model']}} / {{$pagelanguage['LG_Serial']}}</th>
                <td><span id="modelno{{$actionpro->id}}">{{$actionpro->model_no}}</span> <span id="serialno{{$actionpro->id}}">{{$actionpro->serial_no !=""?"/".$actionpro->serial_no:""}}</span></td>
              </tr>
              <tr>
                <th>{{$pagelanguage['LG_Year']}}</th>
                <td>
                  <span id="modelyear{{$actionpro->id}}">{{$actionpro->model_year}}</span>
                </td>
              </tr>
              <tr>
                <th>{{$pagelanguage['LG_Hour']}}</th>
                <td><span id="usedhour{{$actionpro->id}}">{{$actionpro->used_hour}}</span></td>
              </tr>
              <tr>
                <th>{{$pagelanguage['LG_Delivery_Yard']}}</th>
                <td><span id="deliveryplace{{$actionpro->id}}">{{$actionpro->delivery_place_id !=""? ucfirst($actionpro->delivery->name_en):"" }}<br>Arrived (搬入済)</span></td>
              </tr>
              
              <tr>
                <th>{{$pagelanguage['LG_Start_Price']}}</th>
                <td><span class="bold">JPY&nbsp;{{number_format($actionpro->bid_start_price)}}</span></td>
              </tr>
              <tr>
                <th>{{$pagelanguage['LG_Increment']}}</th>
                <td><span class="bold" id="auction_max_bidder_price{{$actionpro->id}}">JPY&nbsp;{{number_format($actionpro->bid_increase_decrease_price)}}</span></td>
              </tr>
              
              <tr>
                <th>{{$pagelanguage['LG_Releasing_Charge']}}</th>
                <td><span id="realeasingcharge{{$actionpro->id}}">{{$actionpro->releasing_charge !=0?"JPY ".number_format($actionpro->releasing_charge):""}}</span></td>
              </tr>
              <tr>
                <th>{{$pagelanguage['LG_Feature']}} <br>{{$pagelanguage['LG_Comment']}}</th>
                <td><span id="featureandcomment{{$actionpro->id}}">{{$actionpro->long_description}}</span></td>
              </tr>
              @endforeach
            </tbody>
            </table>
              </div>
              <div class="col-md-6 mobp">
                <table>
                  <tbody>
                    <tr>
                      <td colspan="3">
                        <?php 
                          $loginstatus = Session::get('loginstatus');
                          $logger_id = Session::get('logger_id'); 
                          if($loginstatus !=1 && $loginstatus !=2 && $logger_id != '-1')
                          {
                        ?>
                        <div id="login_from_product_show" style="margin-bottom: 10px;padding: 10px;border: 1px solid #ccc;"> 
                          <form id="form" action="" method="post" autocomplete="off">
                            <h6 style="text-align: left;"> Bidder Login</h6>
                          <table>
                            <tr>
                              <td colspan="3">
                                {{$pagelanguage['LG_Login_ID']}} <input type="search" id="username" autocomplete="off"  required style="width: 100px;">
                              
                                {{$pagelanguage['LG_Password']}} <input type="text" id="userpass" class="myclass" autocomplete="off"  required style="width: 100px;">
                              
                                
                                <input type="button" class="login button" value="{{$pagelanguage['LG_Login']}}" onclick="bidderLogin_from_product_show(); return false;" style="height: 35px;line-height: 0px;background: #ccc;color:#fff;width: 96px;text-align: center;margin: 0px;padding: 0px;">
                              </td>  
                            </tr>
                          </table>
                          </form>
                      </div>
                      <?php 
                          }
                      ?>
                      </td>  
                    </tr> 
                    <tr> 
                      <td colspan="3">
                    <table style="width: 100%;">  
                      <tr>
                        <td>

                    <form action="{{route('auction.bidforthis',[$products[0]['id']])}}" method="post" onsubmit="return validate({{$products[0]['id']}});"  style="padding-left: 5px;float: right;">
                      
                     

                    <tr id="bidderdiv">
                      <td colspan="3" class="logindiv"> 
                        
                        <input type="hidden" name="biddecreaseprice"  id="biddecreaseprice{{$products[0]['id']}}" value="{{$products[0]['bid_increase_decrease_price']}}">
                        <input type="hidden" name="bidincreaseprice"  id="bidincreaseprice{{$products[0]['id']}}" value="{{$products[0]['bid_increase_decrease_price']}}">
                        <input type="hidden" name="bidcurrentprice"  id="bidcurrentprice{{$products[0]['id']}}" value="{{$products[0]['bid_start_price'] < $products[0]['auction_max_bid_amount'] ? $products[0]['auction_max_bid_amount'] : $products[0]['bid_start_price']}}">

                        <input type="hidden" name="max_bid_amount{{$products[0]['id']}}"  id="max_bid_amount{{$products[0]['id']}}" value="{{$products[0]['auction_max_bid_amount']}}">

                        <input type="hidden" name="bidingstartprice"  id="bidingstartprice{{$products[0]['id']}}" value="{{$products[0]['bid_start_price']}}">
                        <input type="hidden" name="bidtotalprice"  id="bidtotalprice{{$products[0]['id']}}" value="{{$products[0]['bid_start_price'] < $products[0]['auction_max_bid_amount'] ? $products[0]['auction_max_bid_amount'] : $products[0]['bid_start_price']}}">


                        <input type="button" id="{{$products[0]['id']}}" value="-{{number_format($products[0]['bid_increase_decrease_price'])}}" onclick="biddecreasepriceset(this.id)" style="width: 80px;height:35px;border-radius:3px;">
                        <input type="text" name="bidprice" id="bidprice{{$products[0]['id']}}" value="{{$products[0]['bid_start_price'] < $products[0]['auction_max_bid_amount'] ? number_format($products[0]['auction_max_bid_amount']) : number_format($products[0]['bid_start_price'])}}" style="height:35px;width: 120px;text-align:center;" readonly="readonly">
                        <input type="button" id="{{$products[0]['id']}}" value="+{{number_format($products[0]['bid_increase_decrease_price'])}}" onclick="bidincreasepriceset(this.id)" style="width: 80px;height:35px;border-radius:3px;">
                        
                        <input type="button" class="button reload" onclick="reload({{$products[0]['id']}});" value="{{$pagelanguage['LG_Reload']}}" style="padding: 0px 0px !important;">

                    </td>  
                    </tr>  
                    <tr>

                      <td valign="center" align="center" class="bidtimeleft" colspan="3" style="padding-top: 15px;">
                        
                        <img src="{{asset('fontend')}}/images/icon_clock.png">
                        {{$pagelanguage['LG_Time_Left']}}:<span id="timeleft{{$products[0]['id']}}">{{$timeleft}}</span>
                        
                      
                      
                          <!---BID---->
                        
                          @csrf
                          
                        <span id="bidbutton{{$products[0]['id']}}">
                          <?php
                          $logger_id = ""; 
                          $logger_id = Session::get('logger_id');  
                          $loginstatus = Session::get('loginstatus');
                          //bidder bid section
                          if($loginstatus == 1 && $logger_id != '-1')
                          {
                           
                          ?>
                          <input type="submit"  value="{{$pagelanguage['LG_Bid']}}" class="button bid" style="padding: 0px 0px !important;margin-top: 0px;">
                          
                          <?php     
                            
                          }
                          ?>
                          </span>
                        
                        <!---Logout---->
                        <br><br>
                        <?php 
                        if($logger_id != "")
                          {
                        ?>
                          <label  onclick="bidderLogout_from_product_show(); return false;" style="cursor: pointer;margin-right: 15px;float: right;"><i class="fa fa-sign-out"></i> {{$pagelanguage['LG_Logout']}}</label>
                      
                         <?php 
                          }
                         ?>   
                      </td>
                    </tr>
                  </form>
                </td>
                </tr>
                    </table>
                  </td>
                </tr>
                    <tr>
                      <td colspan="3">
                        <div class="buttons">
                          <input class="button back" id="backtoprevious" type="button" onclick="history.back(); return false;" value="{{$pagelanguage['LG_Back_to_Previous_Page']}}" style="background: #f9b005;border-color: #e6a203;color: #fff;padding: 0px 10px;margin-top: 0;display:inline-block">
                          <input class="button listback" type="button" onclick="location.href='{{route('woody.auction')}}'" value="{{$pagelanguage['LG_Back_to_List']}}" style="background: #f9b005;border-color: #e6a203;color: #fff;padding: 0px 10px;margin-top: 0;">
                          
                        </div>
                      </td>  
                    </tr> 



                    <?php 
                      //if logger_id qual to -1 then don't show
                      $logger_id = Session::get('logger_id'); 
                      $bidder_id = $logger_id;
                      $loginstatus = Session::get('loginstatus');
                      if($loginstatus == 1 && $logger_id != '-1')
                      {
                      ?>
                      <tr class="biddingstatusdiv"> 
                          <th class="<?php if($actionpro->total_bids >0){?> bidded_color <?php } ?>">{{$pagelanguage['LG_Bidding_Status']}}</th>
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
                                        //$auctionhistory = "";
                                        //$auctionhistory = App\Models\AuctionHistory::where('product_id',$actionpro->id)->where('bidder_id',$actionpro->auction_max_bidder_id)->where('highest_bidder',1)->get(); 
                                        
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
                    <tr>
                      <td colspan="3"  style="{{$biddingstatusresult_style}}">
                        <div>
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
                            }
                              ?>    
                        </div>
                        
                    </td>
                    </tr> 

                    <tr>
                      <td colspan="3">
                        <div class="buttons">
                          
                        </div>
                      </td>  
                    </tr>

                  </tbody>  
                </table> 
                

              </div> 
            </div>  
            
          </div>
        </div>

        


        


      </div>
    </div>
  </section>

  <?php 
  if(isset($auction_history) && count($auction_history)>0)
  {
  ?>
  <section class="section section-lg bg-white">
    <div id="result_list_table">
      <div id="history_table" style="width: 100%;max-height: 300px;overflow-y:auto;">
      <table class="table bidderdata table-bordered table-striped" cellspacing="0" cellpadding="0" border="0" style="width: 100%;">
      <thead>
      <tr id="history_table_head">
        <th>Bidder No.</th>
        <th>Bidding Price</th>
        <th>Bid System</th>
        <th>Bid Time</th>
      </tr>
      </thead>
      <tbody>
        
      @foreach($auction_history as $ahistory)
         
       <tr id="history_table_first">
        <td>
            {{$ahistory->bidder->id != $bidderid ? substr($ahistory->bidder->usercodeno, 0, 4)."****" : $ahistory->bidder->usercodeno}}     
        </td>
        <td>{{number_format($ahistory->bidding_price)}}</td>
        <td>
          {{$ahistory->bid_system}} 
        </td>
        
        <td><?php $date = new DateTime($ahistory->bid_time); echo $date->format('Y/m/d H:i');?></td> 
      </tr>
            
      @endforeach

      </tbody>
    </table>
      </div>

      
    </div>
  </section>
  <?php 
  }
  ?>  
  
           

          </div>
          
        </div>
      </div>
    </div>
  </section>

  <script>
    var current_src = document.getElementById('largeimg').src;  
    var slideIndex = 1;

    function show(src,n)
    { 
      var img = document.getElementById('largeimg');
      img.src = src;
      current_src = src;

      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("demo");
      //var captionText = document.getElementById("caption");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[0].style.display = "block";
      dots[n-1].className += " active";
      //captionText.innerHTML = dots[slideIndex-1].alt;
    }

    function nextimage()
    {  
      var demo = document.getElementsByClassName("demo");  
      var src = "";
      var id = "";
      for (i = 0; i < demo.length; i++) 
      {
        if(demo[i].classList.contains('active'))
        {
          src = demo[i].src;
          id = demo[i].id;
        }
      }


      id = parseInt(id) + 1;  
      var selectedimg = document.getElementById(id);
      var img = document.getElementById('largeimg');
      img.src = selectedimg.alt;
      current_src = selectedimg.alt;

      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("demo");

      //var captionText = document.getElementById("caption");

      if (id >= slides.length) {slideIndex = 1;}
      if (id < 1) {slideIndex = slides.length;}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[0].style.display = "block";
      dots[id-1].className += " active";
      //captionText.innerHTML = dots[slideIndex-1].alt;
    }
    function preimage()
    {  
      var demo = document.getElementsByClassName("demo");  
      var src = "";
      var id = "";
      for (i = 0; i < demo.length; i++) 
      {
        if(demo[i].classList.contains('active'))
        {
          src = demo[i].src;
          id = demo[i].id;
        }
      }


      id = parseInt(id) - 1;  
      var selectedimg = document.getElementById(id);
      var img = document.getElementById('largeimg');
      img.src = selectedimg.alt;
      current_src = selectedimg.alt;

      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("demo");

      //var captionText = document.getElementById("caption");

      if (id < 1) {slideIndex = 1;}
      if (id < 1) {slideIndex = slides.length;}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[0].style.display = "block";
      dots[id-1].className += " active";
      //captionText.innerHTML = dots[slideIndex-1].alt;
    }

    
    
    // function showSlides(n) 
    // {
    //   alert(n);
    //   slideIndex += n; 
      
    //   show(current_src, slideIndex);
    // }
  </script>
  
  <script>
    var slideIndex = 1;
    showSlides(slideIndex);
    
    function plusSlides(n) {
      showSlides(slideIndex += n);
    }
    
    function currentSlide(n) {
      showSlides(slideIndex = n);
    }
    
    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("demo");
      //var captionText = document.getElementById("caption");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active";
      //captionText.innerHTML = dots[slideIndex-1].alt;
    }
    </script>
<script>
  function validate(pid)
  {
    var max_bid_amount = document.getElementById('max_bid_amount'+pid).value;  
    var bidprice = document.getElementById('bidprice'+pid).value;   
    bidprice = bidprice.replaceAll(',', '');  
    
    if(parseInt(max_bid_amount) !=0 && parseInt(bidprice) == parseInt(max_bid_amount))
    {
      alert("Please increase the price since it's current price");
        return false;
    }
    else
    {
        return true;
    }
      
  }
</script>



  @endsection
