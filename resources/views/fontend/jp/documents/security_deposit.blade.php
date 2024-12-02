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
                        <a href="{{route('woody.terms_and_condition')}}" class="menudiv" >Terms and Condition</a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{route('woody.security_deposit')}}" class="menudiv" >Security Deposit</a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{route('woody.winner_bidding_to_payment')}}" class="menudiv" >Winner Bidding to Payment</a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{route('bid_document.carry_out_of_equipment')}}" class="menudiv" >Carry-Out of Equipment</a>
                    </div>
                </div>    
            </div>  

            




            <!---======== start =========---->
            <div id="menudiv2" class="col-md-12" > 
                <h4>Security Deposit</h4>
                <br>
    
                <p>
                    <b>It requires secuity Deposit to participate in the WOODY AUCTION.</b>
                    <ol>
                    <li><i class="fas fa-circle"></i>	Needs to be 10% or over of the planned purchase amount (minimum JPY500,000)
                    <li><i class="fas fa-circle"></i>	There shall be no interest yielded for the Security Deposit.
                    <li><i class="fas fa-circle"></i>	The Security Deposit shall guarantee the debt the Member may owe WOODY Auction through participating in our Auctions.
                    <li><i class="fas fa-circle"></i>	The remaining amount of the Security Deposit shall be returned to the Member after it is applied to the outstanding amount the Auction Member owes WOODY, when the membership is canceled.
                    <li><i class="fas fa-circle"></i>	If the outstanding debt balance of the withdrawing member is larger than the amount of the Security Deposit, the member is solely responsible for clearing up the debt within seven working days.
                    <li><i class="fas fa-circle"></i>	WOODY will be exempted from returning the Security Deposit, when no application for return has been made within three years from the date of Membership Cancellation.
                    【BANK ACCOUNT】
                    <br />
                    The Bank we are using is The BANK OF TOKYO MITSUBISHI UFJ and SUMITOMO MITSUI BANKING CORPORATION,KAMATA BRANCH, the account name is WOODY CO.,LTD.
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