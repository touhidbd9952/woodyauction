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
            <div id="menudiv4" class="col-md-12" > 
                <h4>Carry-Out of Equipment</h4>
                <br>
                <p><i class="fas fa-circle"></i>The Successful Bidder is required to give WOODY an advance notice, by the previous day of the Carry-Out, about the date and time, and transport company name of the purchased item. 
                (Please do not contact the Yard Staff directly.）</p> 
                <br>
                <p>	<i class="fas fa-circle"></i>When there is No advance notice the equipment connot be carried out.
                Due to inovitable reasons, he/she may do Carry-Out bat with the payment of "Extra Work Charge" of JPY5,000. 
                <br>
                Phone:+81(0)3-5700-4622　E-mail:all@woodyltd.com <br>
                <p>	<i class="fas fa-circle"></i>We may be forced to decline the Carry-Out by the Successful Bidder, if he/she comes with a non-law-abiding vehicle, unsafe truck or trailer. </p>
                <p>	<i class="fas fa-circle"></i>In Case that the Equipment has already [Arrived] at the Delivery Yard by the time of Auction Entry </p>
                <p>The Successful Bidder is requested to make payment within one week and to carry out the purchased Equipment within two weeks from the Auction Close Day.
                If Carry-Out is not executed by the above deadline, the Storage Fee is chargeable on the Successful Bidder.</p>
                <p>	<i class="fas fa-circle"></i>In Case that the Equipment is still [Coming] to the Delivery Yard at the time of Auction Entry </p>
                
                <p><i class="fas fa-circle"></i>The purchased equipment by the Successful Bidder will arrive in WOODY's Designated Delivery Yard within One Week.
                The Successful Bidder is requested to carry out hie/her equipment within three weeks from the Auction Close including the period neccesary for its transnport into the Delivery Yard. If Carry-Out is not executed by the above deadline, the Storage Fee is chargeable on the Successful Bidder.</p>
                <p>	<i class="fas fa-circle"></i>In Case of Carry-Out from "Consigner’s Own Yard" 
                When Successful Bidder is an Overseas Auction Member
                After the Successful Bidding the purchased Equipment is transported to one of WOODY-Designated Forwarders' Yards. The Successful Bidder will be billed for Inland Trucking Charge specified in the INVOICE.
                When Successful Bidder is a Domestic Auction Member</p>
                <p> <i class="fas fa-circle"></i>Carry-Out is done in terms of Freight On Board. </p>
                <p> <i class="fas fa-circle"></i>The successful Bidder is required to follow WOODY's instructions.
                The Successful Bidder CANNOT contact the Consigner directly to carry out his/her equipment.</p>
                <p>  <i class="fas fa-circle"></i>If Carry-Out is not executed within two weeks after the Auction Close, WOODY will transfer
                the equipment to WOODY's Designated Delivery Yard.The Successful Bidder is responsible for
                all the cost incurred from such operation. </p>
                <p>  <i class="fas fa-circle"></i>After three weeks from the Auction Day we shall not be responsible for safe storage
                of Equipment. </p>
                <p>	<i class="fas fa-circle"></i>In Case of Carry-Out from "Consigner’s Own Yard" </p>
                <p> <i class="fas fa-circle"></i>When Successful Bidder is a Domestic Auction Member</p>
                <p>	<i class="fas fa-circle"></i>The Successful Bidder shall be responsible for all the accidents and/or troubles taking place at the time of and after the Carry-Out. WOODY shall be exempted from such responsibility. </p>
                <p>	<i class="fas fa-circle"></i>The Successful Bidder shall be responsible for all damages or losses (e.g. sticking, rust, oil leakage,damage to electric system) incurred after the Auction, caused fy any reasons including lapse of time, weather, etc. </p>
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