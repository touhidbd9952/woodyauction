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
            <div id="menudiv3" class="col-md-12" > 
                <h4>Winner Bidding to Payment</h4>
                <br>
    
                <p>
                    WOODY notifies Bidder, after the Auction close, of his/her Successful Bid by E-mail and sends the Invoice by Fax. At this point the sales contract is concluded.
                        The Successful Bidder shall complete the payment including the equipment price, Contract Fee, Carryout Charge, etc. within one week from the date that he/she received the notice of the successful bid by e-mail.
                    <br>
                    <b>
                    【BANK ACCOUNT】
                    </b>
                    <br />
                    The Bank we are using is The BANK OF TOKYO MITSUBISHI UFJ and SUMITOMO MITSUI BANKING CORPORATION,KAMATA BRANCH, the account name is WOODY CO.,LTD.
                    <br />
                    ＜Please be careful of the "Money Transfer Fraud".＞
                    <br />
                    WOODY designates the above Bank Account as the Only Bank Account for auction deals. We will NEVER ask Bidders to send money to any other Bank Account.
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