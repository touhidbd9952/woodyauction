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

<script> 
function showmenu(menudiv)
{ 
    
    document.getElementById("menudiv1").style.display = "none";  
    document.getElementById("menudiv2").style.display = "none"; 
    document.getElementById("menudiv3").style.display = "none"; 
    document.getElementById("menudiv4").style.display = "none"; 

    document.getElementById(""+menudiv).style.display = "block";
    
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
                        <a href="javascript:" class="menudiv" onclick="showmenu('menudiv1')">Bidding Style</a>
                    </div>
                    <div class="col-md-3">
                        <a href="javascript:" class="menudiv" onclick="showmenu('menudiv2')">Log-in & Bedding</a>
                    </div>
                    <div class="col-md-3">
                        <a href="javascript:" class="menudiv" onclick="showmenu('menudiv3')">Target Machines Selection</a>
                    </div>
                    <div class="col-md-3">
                        <a href="javascript:" class="menudiv" onclick="showmenu('menudiv4')">Carry-Out of Equipment</a>
                    </div>
                </div>    
            </div>  

            




            <!---======== start =========---->
            <div id="menudiv2" class="col-md-12" style="display: none"> 
                <h4>How to Log-in & Bedding</h4>
                <br>
    
                <p>
                    <b><i class="fas fa-circle"></i>Enter User ID and Password to Login your Auction</b>
                    <ol>
                    <li>
                        You can login by using User ID and Password from "Auction Product Items List" Page or "Item Details" Page. After successful Login you can start bidding. 
                        <br>
                        <img src="{{'fontend/images/document/login.jpg'}}" style="max-width:700px;">
                    </li>
                </p>

                <p>
                    <b><i class="fas fa-circle"></i>Bidding</b>
                    <ol>
                    <li>
                        Now you can bid from " Auction Product Item List page" and "Item Detail page", Click “+" sign Button and "Increment Amount" to set new Bid Price and then click "Bid" Button.
                        (At this point Bidding has not yet been completed.)
                        <br>
                        <img src="{{'fontend/images/document/bidding.jpg'}}" style="max-width:700px;">
                    </li>
                </p>

                <p>
                    <b><i class="fas fa-circle"></i>Confirmation Page</b>
                    <ol>
                    <li>
                        Click "Confirm Bid" Button to confirm Bid Price.
                        <br>
                        <img src="{{'fontend/images/document/bidconfirm.jpg'}}" style="max-width:700px;">
                        <br><br>
                    </li>
                </p>

                <p>
                    <b><i class="fas fa-circle"></i>Bid Status page</b>
                    <ol>
                    <li>
                        If you turn out to be the Highest Bidder.
                        <br>
                        <img src="{{'fontend/images/document/bidstatus.jpg'}}" style="max-width:700px;">
                    </li>
                </p>

                <p>
                    <ol>
                    <li>
                        If you want to bid on another item, click on "Back to LIST" button.<br>
                        Win bidder will see below green message
                        <br>
                        <img src="{{'fontend/images/document/winbidmessage.jpg'}}" style="max-width:700px;">
                    </li>
                </p>

                <p>
                    <ol>
                    <li>
                        Looser bidder will see below red message
                        <br>
                        <img src="{{'fontend/images/document/losebidmessage.jpg'}}" style="max-width:700px;">
                    </li>
                </p>

                <p>
                    <ol>
                    <li>
                        If bidder click on  "Back to BIDDING & DETAIL PAGE", then software will show the previous auction details page.
                    </li>
                </p>

                <p>
                    <ol>
                    <li>
                        When we have accepted Your Bid, we will send you "Bid Accepted" e-mail.
                        <br>
                        When you have got OUTBIDDEN, we will send you "You were OUTBIDDEN" e-mail.
                    </li>
                </p>

            </div>
            <!---======== end =========---->


            

        </div>
      </div>
      </section>
      </section>
  </div>
  </div>
</section>





  @endsection