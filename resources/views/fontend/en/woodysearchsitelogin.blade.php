@extends('layouts.fontend_master2')

@section('content')
 
 
 <!-- Swiper -->
 <!-- Breadcrumbs-->
 

<!--=============================  ======================================-->
<section class="section section-md bg-white">
  <div class="shell shell-wide wow fadeInUpSmall divsize" data-wow-offset="150" style="margin-left: 0px;margin-right:0px;">
    
    <style>
      .header_title{font-size: 18px !important;}
      
    .msgstyle{padding: 15px;border: 1px solid #fbbd05;text-align: center;}
    .backlink{color: #fbb206;font-weight: bold;font-size: 18px;}
  </style>    
  
  <div class="cat-items-grid">
  <section id="home" class="home-page-content page-content">

      
      
      
      <section class="products-section">
      <div class="container">
        <div class="row">  


        <div id="main_contents" style="width: 95%;">
         
            <div class="msgstyle">
                @if(isset($msg))
                <h5> {{$msg}}</h5>
                @endif

                <br><br><br>
                <a href="{{route('woody.auction')}}" class="backlink"><img src="{{url('fontend/images/left-arrow.png')}}" style="width:50px;">Back To Woody Auction</a>  
            </div>  
            
         
        </div>

        @include('inc.fontend_sidebar')

       </div>
      
      </div>
      </section>
      
      
      </section>
  </div>
    
    
  </div>
</section>


  @endsection