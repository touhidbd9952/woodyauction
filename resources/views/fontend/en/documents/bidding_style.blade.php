@extends('layouts.fontend_master2')

@section('content')
 <!-- Swiper -->
 <!-- Breadcrumbs-->

<!--=============================  ======================================-->
<style>
    #myDIV {
      width: 100%;
      padding: 50px 0;
      text-align: center;
      background-color: lightblue;
      margin-top: 20px;
    }
    .section-div{margin-bottom: 15px;}
    .headertitle{display: block;text-align:center;font-weight:bold;font-size: 16px;color:#F5A641;background: #f4f3f3;}
    .menudiv{background: #F5A641;color:#f4f3f3;display:block;text-align:center;font-weight:bold;margin-bottom:5px;}
    .menudiv:hover, .menudiv:focus {background: #f3d3aa;color:#f4f3f3;text-decoration: none;outline: none;}
    .section-div p{margin-top: 10px;font-size:14px;}
    .section-div p, ul li, ol li{color: #000 !important;}
    .section-div p b{font-size: 16px;color: #000 !important;}
    p b{font-size: 16px;color: #000 !important;}
    p{color: #000 !important;}
    .section-div b{font-size: 16px;color: #000 !important;}
    .fa-circle{padding-right: 10px;color: #F5A641;}
</style>
<script>
    function myFunction(myDIV) {
      var x = document.getElementById(""+myDIV);
      if (x.style.display === "none") 
      {
        x.style.display = "block";
      } 
      else 
      {
        x.style.display = "none";
      }
    }
</script>
   

<section class="section section-md bg-white">
  <div class="shell shell-wide wow fadeInUpSmall divsize" data-wow-offset="150" style="margin-left: 0px;margin-right:0px;">
  <div class="cat-items-grid">
  <section id="home" class="home-page-content page-content">
      <section class="products-section">
      <div class="container">
        <div class="row"> 
            <div class="col-md-12"> 
                <div style="width: 100%;min-height:50px;">
                    <div class="col-md-3">
                        <a href="{{route('bid_document.bidding_style')}}" class="menudiv" >Bidding Style</a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{route('bid_document.log_in_and_bedding')}}" class="menudiv" >Log-in & Bedding</a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{route('bid_document.target_machines_selection')}}" class="menudiv" >Target Machines Selection</a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{route('bid_document.carry_out_of_equipment')}}" class="menudiv" >Carry-Out of Equipment</a>
                    </div>
                </div>    
            </div>  

            <!---======== start =========---->
            <div id="menudiv1" class="col-md-12" > 
            <h4>Bidding Style</h4>
            <br><br>

            <div class="section-div"> 
                <a href="javascript:" onclick="myFunction('menudiv1myDIV1')" class="headertitle">Bidding Up Style </a>
                <div id="menudiv1myDIV1" style="display:none">
                   <p>
                    Auction can have Plural bidders that bid up the price of each item and this way the Highest Bidder at the Auction Close Time becomes the Winner. When plural bidders bid on the same item before the Auction Close, the Auction Time for this item is extended automatically.
                   </p>
                </div>
            </div>

            <div class="section-div"> 
                <a href="javascript:" onclick="myFunction('menudiv1myDIV2')" class="headertitle">Automatic Bid System </a>
                <div id="menudiv1myDIV2" style="display:none">
                     <p>
                        A bidder can Bid with Maximum Amount (AUTOBID) on auction item until Auction Close. Maximum Bid Amount of a Bidder is NOT shown to other bidders. 
                        The item can be won at less than the planned maximum amount of money as long as the subject price is not surpassed by those of other bidders. When Bidder wants to bid on plural items, Bidder can manage to bid on each item more easily by using AUTOBID when Auction Close draws near.
                     </p>
                </div>
            </div>

            <div class="section-div"> 
                <a href="javascript:" onclick="myFunction('menudiv1myDIV3')" class="headertitle">Automatic Extension of Auction </a>
                <div id="menudiv1myDIV3" style="display:none">
                   <p>
                    If a Bid is placed when the remaining time is 2 minutes or less before the Auction Closing Time, Auction time will be extended for 2 minutes. After the first extension.
                   </p>
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





  @endsection