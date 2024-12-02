@extends('layouts.fontend_master2')

@section('content')
 
 
 <!-- Swiper -->
 <!-- Breadcrumbs-->
 

<!--=============================  ======================================-->
<section class="section section-md bg-white">
  <div class="shell shell-wide wow fadeInUpSmall divsize" data-wow-offset="150" style="margin-left: 0px;margin-right:0px;">
    
    <style>
      .header_title{font-size: 18px !important;}
      
    .msgstyle{padding: 15px;text-align: center;}
    .backlink{color: #fbb206;font-weight: bold;font-size: 18px;}
  </style>    
  
  <div class="cat-items-grid">
  <section id="home" class="home-page-content page-content">

      
      
      
      <section class="products-section">
      <div class="container">
        <div class="row">  


        {{-- @include('inc.fontend_sidebar') --}}




        <div id="main_contents">
         
            <div class="msgstyle">
                @if(isset($msg) && $msg !="")
                <h4 style="border: 1px solid #fbb206;padding:20px;"> 
                  <?php 
                  if($pagelanguage['LG_language'] == 'en')
                  {
                  ?>
                  Password retrieve mail is sent. Please login to your mail account
                  <?php 
                  }
                  else
                  {
                  ?>
                  パスワード変更メールをお送り致しました。メールをご確認下さい。
                  <?php 
                  }
                  ?>
                </h4>
                @endif
                @if(isset($emsg)&&$emsg !="")
                <h4 style="border: 1px solid #fbb206;padding:20px;color:rgb(252, 2, 2)"> 
                  <?php 
                  if($pagelanguage['LG_language'] == 'en')
                  {
                  ?>
                  Invalid Email Address
                  <?php 
                  }
                  else
                  {
                  ?>
                  無効な電子メールアドレス
                  <?php 
                  }
                  ?>
                </h4>
                @endif

                <br><br><br>
                <a href="{{route('woody.auction')}}" class="backlink"><img src="{{url('fontend/images/left-arrow.png')}}" style="width:50px;">
                  <?php 
                  if($pagelanguage['LG_language'] == 'en')
                  {
                  ?>
                  Back To Woody Auction
                  <?php 
                  }
                  else
                  {
                  ?>
                  ウッディーオークションへ戻る
                  <?php 
                  }
                  ?>
                </a>  
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