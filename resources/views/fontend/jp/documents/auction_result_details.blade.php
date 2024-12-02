@extends('layouts.fontend_master2')

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
          <h4 style="color:#F5A64E;font-weight:bold;">Auction No.:{{$products[0]->product_no}} <span style="float: right;">Sold Date:{{date('Y-m-d',strtotime($products[0]->auction_end))}}</span></h4>
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
                  @foreach($product_multiple_images as $pimages)
                  <?php 
                  if($i<=$countimage)
                  {
                  ?>
                    <div class="column">
                      <img class="demo cursor" src="{{file_exists($pimages->image_sm)==true? asset($pimages->image_sm) :asset($pimages->image_L)}}" style="width:100%" onclick="show('{{asset($pimages->image_L)}}',{{$i}})">
                    </div>
                   <?php 
                   $i++;
                  }
                   ?> 
                  @endforeach
                  </div>

                  
                </div>
                
                <div class="col-md-8 col-xs-8">
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
                      <i class="fa fa-youtube-play" style="font-size:48px;color:red"></i>
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
                        Download Photos
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
                        Condition Report
                      </a>
                      
                      </td>
                    </tr>
                  </tbody></table>
                  </div>
              </div>  


              </div>
              
                
                

              <!-----------================================----------------------->

            </div>


            
         
  <section class="section section-lg bg-white">
    <div class="">
      <div class="layout-bordered">
        <div class="layout-bordered__main text-center" style="width: 100%;">
          <div class="layout-bordered__main-inner">
            <h3 style="text-align: left;">{{$pagelanguage['LG_Product_details']}}</h3>
            <div class="row">
              <div class="col-md-8" style="margin-bottom: 30px;">
               <!-- RD Mailform-->
            <table id="product_details" width="100%" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                @foreach($products as $actionpro)   

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
                <th>{{$pagelanguage['LG_Feature']}} <br>{{$pagelanguage['LG_Comment']}}</th>
                <td><span id="featureandcomment{{$actionpro->id}}">{{$actionpro->long_description}}</span></td>
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
  </section>

          </div>
          
        </div>
      </div>
    </div>
  </section>

  <script>
    var current_src = document.getElementById('largeimg').src;  
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

    var slideIndex = 1;
    
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




  @endsection
