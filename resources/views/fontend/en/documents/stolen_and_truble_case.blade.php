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
    .txtl{text-align: left;}
    .fontsize-13{font-size:13px;}
    .datatable th, .datatable td{padding: 0 5px;color: #000;}
    .fbold{font-weight: bold;}
    #datadiv, #datadiv b{color:#000;}
    #datadiv h4{color:#F5A63F}
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
            
            <!---======== start =========---->
            <div> 
              <div>  
                <div id="contents-wrapper">

                <h4 style="color: #F5A63F">Information on FOB & Basic Washing</h4>
                <br>
                
                <p>
                    For uploading auction data, public document such as damage report may be required. 
                    Woody serves for and manages the site from viewpoint of defamation prevention. 
                    Please note that Woody does not investigate on the evidence of each case to be uploaded 
                    and the information is solely responsible for the content of each case. 
                </p>
                <p>
                    We strongly urge bidder to keep their password tightly secured and don’t reply to FRAUD email if arrived. If needed only contact to woody co.ltd.
                </p>
                




                </div>  
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