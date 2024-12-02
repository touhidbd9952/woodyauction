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
    #history_table_head td {
    background-color: #E6E6E6;
    font-weight: bold;
    }
    #history_table td {
    border-bottom: 1px solid #D5D5D5;
    padding: 2px 5px 2px 5px;
    }
    #history_table_first th {font-weight: bold;}
    .bidderdata tr:nth-child(2) {font-weight: bold;color: #000;}
    #system_page .button{margin-top: 0px !important;}
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
         
            <div class="header_title bidstatustitlediv">
                <h3> Bid Status
                    <a  onclick="history.back();" style="cursor: pointer;">
                        <img src="{{asset('fontend')}}/images/left-arrow.png" width="60"><span class="backtoprepage" style="color:#F5A64E">Back</span>
                    </a>
                </h3>
            </div>

            <div class="col-md-8  col-xs-12 bidstatus" style="border:2px solid #F5A64E;border-radius: 16px;padding-top:15px;">
                
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
                    
                    
                        <?php 
                            if($bidder_id == $auction_max_bidder_id)
                            {
                        ?>
                        <div style="width: 100%;padding:5px 10px;border-radius: 10px;">
                            <h5 style="color:rgb(14, 148, 103);text-align: center;">You are currently the highest bidder.</h5>
                        </div>
                        <?php        
                            }
                            else 
                            {
                            ?>
                            <div style="width: 100%;padding:padding:5px 10px;border-radius: 10px;">
                                <Span style="color:rgb(249, 5, 5);font-size:14px;">Others {{$bid_system}} price greater than your bidding price. Please bid again</Span>
                            </div>
                            <?php
                            }
                        ?>
                    
                    
                    <div style="width: 100%;margin-top:25px;">
                        <div style="width: 100%;">
                        
                        <a href="{{route('auction.product_details',[$product_id])}}" class="button backtobiddingdetails"   style="padding: 2px 7px;background: #F5A64E;border: #F5A64E;border-radius: 10px;color: #fff;box-shadow: 2px 2px #DDC7AF;">Back to Bidding &amp; Detail Page</a>
                        
                        
                        <a href="{{route('woody.auction')}}" class="button"    style="padding: 2px 7px;background: #F5A64E;border: #F5A64E;border-radius: 10px;color: #fff;box-shadow: 2px 2px #E8DCD0;">Back to List</a>
                        
                        <br>
                        </div>
                        <div>
                            <img src="{{url('/')}}/{{$productimage}}" width="100" style="float: right;margin-top: -50px;"></div>
                        <div class="clear"><br></div>
                    </div>
                    
                    <div>
                    
                
                    
                    
                    
                <div id="result_list">
                    <div style="font-weight: bold;color: #000;">Auction No.{{$auctionno}}&nbsp;&nbsp;{{$modelno}}  {{$serialno!=""?' / '.$serialno:""}}</div>
                    <div id="result_list_table">
                      <div id="history_table" style="max-height: 400px; overflow-y: auto;">
                      <table class="bidderdata" cellspacing="0" cellpadding="0" border="0" style="width: 100%;">
                      <tbody>
                      <tr id="history_table_head">
                        <td>Bidder No.</td>
                        <td>Bidding Price</td>
                        <td>Bid System</td>
                        <td>Bid Time</td>
                      </tr>

                      
                      @foreach($auction_history as $ahistory)
                      
                          <tr id="history_table_first">
                          <td>
                              {{$ahistory->bidder->usercodeno != $biddercodeno ? substr($ahistory->bidder->usercodeno, 0, 4)."****" : $ahistory->bidder->usercodeno}}     
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
                  </div>
                   
                
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