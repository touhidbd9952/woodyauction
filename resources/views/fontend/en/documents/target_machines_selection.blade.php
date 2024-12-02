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
            <div id="menudiv3" class="col-md-12" > 
                <h4>Target Machines Selection</h4>
                <br>
    
                <div>
                   <img src="{{url('fontend/images/document/selecteditems.jpg')}}" style="max-width:700px;display:">
                </div>
                <div style="color: #000;">
                    <br>
                    <b style="font-size: 16px;">About Selections (★)</b>
                    <br>
                    After Login, when you click on   
                    <img src="{{url('fontend/images/document/addtoselection.jpg')}}" style="max-width:700px;display:inline;">
                    top to item photo, the mark turns to   
                    <img src="{{url('fontend/images/document/removefromselection.jpg')}}" style="max-width:700px;display:inline;">
                    and the item is added in "Selections" list. 

                    <br><br>
                    <b style="font-size: 16px;">Selections</b> <br>
                    When you click on "Selections" Button, only Selected Items (★) will show.
                    <br><br>

                    <b style="font-size: 16px;">Result of Selections</b> <br>
                    After Auction Close you can see the results of your bidding on the items. 
                    <br><br>

                    <b style="font-size: 16px;">Category List</b> <br>
                    Select a category that you want to see before auction.
                    <br><br>

                    <b style="font-size: 16px;">Item Search</b> <br>
                    Search auction item by Model name, Auction No., and Delivery yard area. 
                    <br><br>

                    <b style="font-size: 16px;">Choice</b><br>
                    •	"All" will show All Items. <br>
                    •	"New Today" will show only the items just uploaded the current day.<br>
                    •	"End Soon" will show only the items whose auction close the current day. <br>

                    
                </div>
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