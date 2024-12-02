@extends('layouts.fontend_master2')

@section('content')
 
 
 <!-- Swiper -->
 <!-- Breadcrumbs-->
 

<!--=============================  ======================================-->
<section class="section section-md bg-white">
  <div class="shell shell-wide wow fadeInUpSmall divsize" data-wow-offset="150" style="margin-left: 0px;margin-right:0px;">
    
    <style>
      .header_title{font-size: 18px !important;}
      .pl0{padding-left: 0px;}
      .pr0{padding-right: 0px;}
      .w100{width: 100%;}
      .choice ul{list-style-type: none;padding-left:0px;}
      .choice ul li{display: inline;height:20px;margin:6px 1em;}
      .choice ul li a.selected{color: #fff;background:rgb(41, 174, 108);padding: 0 5px;}
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
    .fl_left{width: 220px;float: left;padding: 5px;}
    .fl_right{width: 220px;float: right;padding: 5px;margin-top:0px;}
    /* .biddingstatusdiv{display: none;} 
    .biddiv{display: none;}  */
    
      @media(max-width:767px)
      {
          .pmr{padding-right: 15px;}
      }
  </style>    
  
  <div class="cat-items-grid">
  <section id="home" class="home-page-content page-content">

      
      
      
      <section class="products-section">
      <div class="container">
        <div class="row">  


        @include('inc.fontend_sidebar')




        <div id="main_contents" style="width: 95%;">
         
            <div class="header_title bidconfirmtitlediv">
                <h3> Bid Confirmation
                    <a  onclick="history.back();" style="cursor: pointer;">
                        <img src="{{asset('fontend')}}/images/left-arrow.png" width="60"><span style="color:#F5A64E">Back</span>
                    </a>
                </h3>
            </div>

            <div class="col-md-6  col-xs-12 bidconfirm" style="border:2px solid #F5A64E;border-radius: 16px;padding-top:15px;">
                
                <div id="system_page">
                  
                  <div class="header_title">
                    <div id="bidder_info">
                        <p style="background: #F5A64E;color: #fff;padding-left: 10px;border-radius: 10px;">
                            Bidder No:<span>{{$biddercodeno}}&nbsp;&nbsp; {{$biddername}}</span>
                        </p>
                    <br>
                </div>
                
                  </div>
                  
                  <div id="page_content" style="width: 100%">
                    
                    <div style="width: 100%">
                      <div style="text-align: center;width:100%;font-size: 16px;color:#000;">
                        <div> I bid for {{$auctionproduct["model_no"]}}  {{$auctionproduct->serial_no!=""?'/'.$auctionproduct->serial_no:""}}</div>
                     </div>
                     <div style="width: 100%;margin-bottom: 20px;margin-bottom: 80px;">
                        <center>
                         <img src="{{url('/')}}/{{$auctionproduct->thumbnail_image}}" width="100" style="float: right;margin-top: -50px;">
                        </center>
                    </div>
                    </div>
                    
                    <div style="width: 100%;font-size: 16px;color:#000;text-align:center;margin-bottom:20px;">
                        Confirm Bidding Price 
                        <span>JPY {{number_format($bidcurrentprice)}}</span>
                    </div>
                    
                    <div>
                    
                
                    
                      <div>
                        <a href="javascript:" class="button back fl_left" type="button" onclick="history.back(); return false;">  Back to Previous Page </a>
                        
                
                        <a href="{{url('auction/bidconfirmation/'.$product_id.'/'.$bidcurrentprice.'/'.$bidder_id.'/'.$biddercodeno)}}" class="button fl_right" style="background: #068420;color:#fff;">Confirm BID</a>
                      </div>
                    
                    <p  style="text-align: right;padding-top: 50px;"> 
                        ※Please read  
                        <a href="javascript:" data-toggle="modal" data-target="#termsandcondition">"Termes and Conditions for bidding"</a>
                        <br>before click on "Confirm BID" button.
                    </p>
                   
                
                    </div>
                    
                  </div>
                 
                </div>
            </div>    
         
        </div>
       </div>
      
      </div>
      </section>
      
      
      </section>
  </div>
    
    
  </div>
</section>

<!-- Modal -->
<div class="modal fade" id="termsandcondition" tabindex="-1" role="dialog" aria-labelledby="termsandconditionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Terms and Condition</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



  @endsection