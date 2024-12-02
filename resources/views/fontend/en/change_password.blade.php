@extends('layouts.fontend_master2')

@section('content')
 
 
 <!-- Swiper -->
 <!-- Breadcrumbs-->
 

<!--=============================  ======================================-->
<section class="section section-md bg-white">
  <div class="shell shell-wide wow fadeInUpSmall divsize" data-wow-offset="150" style="margin-left: 0px;margin-right:0px;">
    
    <style>
      .header_title{font-size: 18px !important;}
      .pl0{padding-left: 0px;}
      .pr0{padding-right: 0px;}
      .w100{width: 100%;}
      .choice ul{list-style-type: none;padding-left:0px;}
      .choice ul li{display: inline;height:20px;margin:6px 1em;}
      .choice ul li a.selected{color: #fff;background:rgb(41, 174, 108);padding: 0 5px;}
      .choice ul li a.newtoday{color: #f4b906;}
      .choice ul li a.endsoon{color: #ff0404;}
      .pmr{padding-right: 0px;}
      .tablegap{background: #fff;width:100%;height: 15px;}
      .table {width: 100%;max-width: 100%;margin-bottom: 0px !important;}
      input.reload {float:right;width: 96px;height: 35px;padding: auto;background: #ff8c00;color: #fff;background-size: auto;-webkit-background-size: 32px;-moz-background-size: 32px;-ms-background-size: 32px;background-size: 32px;font-size: 13px;margin: 0 auto;}
      input.bid {float: right;width: 96px;height: 35px;background: #1b9f36;color: #fff;font-weight: bold;}
      .pagination > .active > a, .pagination > .active > a:hover, .pagination > .active > a:focus, .pagination > .active > span, .pagination > .active > span:hover, .pagination > .active > span:focus {
    z-index: 3;color: #fff;background-color: #f5a63f;border-color: #f5a63f;cursor: default;}
    .pagination > li > a, .pagination > li > span {color: #f5a63f;}
    a.thumbnail:hover, a.thumbnail:focus, a.thumbnail.active {border-color: #f5a63f;}
    .table > thead > tr > th {border-bottom: 1px solid #ddd;}
    .fl_left{width: 220px;float: left;padding: 5px;}
    .fl_right{width: 220px;float: right;padding: 5px;margin-top:0px;}
    /* .biddingstatusdiv{display: none;} 
    .biddiv{display: none;}  */
    
      @media(max-width:767px)
      {
          .pmr{padding-right: 15px;}
      }
  </style>    
  
  <div class="cat-items-grid">
  <section id="home" class="home-page-content page-content">

      {{-- <section class="homepage-slider">
      <div class="container">
      
      <div class="homeCarousel flexslider" data-animation="fade" data-slideshowspeed="2000">
      <ul class="slides">
      
      <li style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;" class="flex-active-slide">
          <a href=""><img src="{{ asset('fontend') }}/img/oldimg/banner1.jpg" alt="banners" draggable="false" style="max-height: 80px;width: 100%;"></a></li>
      
      </ul>
      <ul class="flex-direction-nav">
          <li class="flex-nav-prev"><a class="flex-prev flex-disabled" href="#" tabindex="-1">Previous</a></li>
          <li class="flex-nav-next"><a class="flex-next flex-disabled" href="#" tabindex="-1">Next</a></li></ul>
        </div>
      
      </div>
      </section> --}}
      
      
      <section class="products-section">
      <div class="container">
        <div class="row">  


        @include('inc.fontend_sidebar')




        <div id="main_contents" style="width: 95%;">
         
            <div class="header_title">
                <h3> <?php if($pagelanguage['LG_language'] == 'en'){?>Change Password<?php }else{?>パスワードの変更<?php }?></h3>
            </div>

            <div class="col-md-6  col-xs-12" style="border:2px solid #F5A64E;border-radius: 16px;padding-top:15px;">
                
                <div id="system_page">
                  
                  <div class="header_title">
                    <div id="bidder_info">
                        
                    <br>
                </div>
                
                  </div>
                  
                  <div id="page_content" style="width: 100%">
                    
                    <div>
                    
                        <form action="{{route('bidder.changepassword')}}"  method="POST" enctype="multipart/form-data" class="form-horizontal" style="margin-bottom: 35px;">

                            @csrf
    
                            <input type="hidden" name="bidderid" value="{{$bidderid}}">  

                        <div class="card-body">
                            
                            <div class="form-group row">
                                <label for="title"
                                    class="col-sm-4 text-end control-label col-form-label"><?php if($pagelanguage['LG_language'] == 'en'){?>Login ID<?php }else{?>ログインID<?php }?></label>
                                <div class="col-sm-6">
                                    <input type="text"  name="username" class="form-control @error('username') is-invalid @enderror" autocomplete="off">
                                    @error('username')
                                        <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="title"
                                    class="col-sm-4 text-end control-label col-form-label"><?php if($pagelanguage['LG_language'] == 'en'){?>New Password<?php }else{?>新しいパスワード<?php }?></label>
                                <div class="col-sm-6">
                                    <input type="text"  name="newpass" class="form-control @error('newpass') is-invalid @enderror">
                                    @error('newpass')
                                        <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title"
                                    class="col-sm-4 text-end control-label col-form-label"><?php if($pagelanguage['LG_language'] == 'en'){?>Confirm Password<?php }else{?>パスワードの確認<?php }?></label>
                                <div class="col-sm-6">
                                    <input type="text"  name="confirmed" class="form-control @error('confirmed') is-invalid @enderror">
                                    @error('confirmed')
                                        <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
    
                            
                            
                           
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary" ><?php if($pagelanguage['LG_language'] == 'en'){?>Change<?php }else{?>変更<?php }?></button>
                            </div>
                        </div>
                    </form>
                    
                    
                
                    </div>
                    
                  </div>
                 
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