@extends('layouts.fontend_master2')

@section('content')

 <!-- Swiper -->
 <!-- Breadcrumbs-->
 <style>
  @media(min-width:768px)
  {
    .container{width: 950px !important;}
    .mobilestyle{margin-top: 15px; margin-left: 40px;}
  }
  .yellow {background: #F5A641;}
  .red{background:#e94335;}
  .green{background:#34a853;}
  .blue{background:#4285f4;}
  .yellow a,.red a,.green a,.blue a{font-size:20px;font-weight:bold;color:#fff;display:block;}
  .yellow a span,.red a span,.green a span,.blue a span
  {
      clear: left;
      margin-top: 0px;
      display: block;
  }
  .yellow a i,.red a i,.green a i,.blue a i
  {
      font-size: 20px;
  }
  .yellow-color a, .yellow-color a i{color:#F5A641;}
  .red-color a, .red-color a i{color:#e94335;}
  .blue-color a, .blue-color a i{color:#4285f4;}
  #div_yellow {border-left: 8px dotted #F5A641;}
  #div_red {border-left: 8px dotted #e94335;}
  #div_green {border-left: 8px dotted #34a853;}
  #div_blue {border-left: 8px dotted #4285f4;}
  .list-group {margin-left: 10px;}
  .list-group-item {border: 1px solid #fff;}
  .textmessage{border: 1px solid #f9a404;border-radius: 50px;font-size: 16px;font-weight: bold;color: #f9a404;}
  </style>        
<!--=============================  ======================================-->
<section class="section section-md bg-white excavatorimgdiv">
  <div class="shell shell-wide wow fadeInUpSmall divsize" data-wow-offset="150" style="margin-left: 0px;margin-right:0px;">
  <div class="cat-items-grid">
  <section id="home" class="home-page-content page-content">
      <section class="products-section">
      <div class="container">

        

        <div class="row">  
          <div class="col-md-4">
            <marquee direction="left" width="350" height="180" behavior="alternate" scrolldelay="60" style="margin-top: -90px">
              <marquee behavior="alternate">
                <img src="{{url('fontend/images/excavator.png')}}" id="excavatorimg" style="z-index: 100;position: relative;">
              </marquee>
            </marquee>
          </div>
          <div class="col-md-4" >
            <a href="{{route('woody.auction')}}">
            <img src="{{ asset('fontend') }}/images/woodyauction.jpg" class="mobilestyle" style="z-index: 10;">
            </a>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12" style="width: 97%;margin:15px;">  
            @if(isset($notice))
            <marquee direction="left" width="100%" height="35"  scrollamount="5" onmouseover="this.stop();" onmouseout="this.start();" class="textmessage">
              @foreach($notice as $n)
                  {{$n->notice_message}}
                @endforeach
            </marquee>
            @endif
          </div>
        </div> 

        <div class="row">  
            <div class="col-md-6">
                <div id="div_yellow">
                  <ul class="list-group">
                    <li class="list-group-item yellow">
                        <a href="{{route('woody.auction')}}">Woody Auction</span></a>
                    </li>
                    <li class="list-group-item yellow-color"><a href="{{route('woody.bid_document')}}">Auction rule</a></li>
                    {{-- <li class="list-group-item yellow-color"><a href="{{route('product_owner.product_owner_register')}}">Product Owner Registration</a></li> --}}
                    <li class="list-group-item yellow-color"><a href="{{route('bid_document.bidding_style')}}">Auction workflow</a></li>
                    <li class="list-group-item yellow-color"><a href="{{route('member.register')}}">Member Registration</a></li>
                  </ul>
                </div>  
            </div>    
            <div class="col-md-6">
                <div id="div_red">
                <ul class="list-group">
                    <li class="list-group-item red">
                        <a href="{{route('woody.search_site')}}"> Woody auction result search site</a>
                    </li>
                    {{-- <li class="list-group-item red-color">
                      <a href="{{route('woody.stolen_and_truble_case')}}">
                
                        Stolen Machines / Trouble Cases
                      </a>
                    </li> --}}
                    {{-- <li class="list-group-item red-color">
                      <a href="{{route('woody.memberregistrationforsearchsite')}}">
                       
                        Member Registration for Search site
                      </a>
                    </li> --}}
                    <li class="list-group-item red-color">
                      <a href="{{route('bidder.bidderblacklisted')}}">
                        
                        Blacklist
                      </a>
                    </li>
                    <li class="list-group-item">---- ---- ---- ---- ---</li>
                    <li class="list-group-item">---- ---- ---- ---- ---</li>
                    
                  </ul>
                </div> 
            </div> 
       </div>
       <div class="row">  
        <div class="col-md-6">
            <div id="div_green">
            <ul class="list-group">
                <li class="list-group-item green">
                    <a href="{{url('/guidebook')}}"> Woody Auction Futures<span></span></a>
                </li>
                <li class="list-group-item"><a href="{{route('auction.product_entry_request')}}">Auction Product Entry</a></li>
                <li class="list-group-item"><a href="javascript:">---- ---- ---- ---- ---</a></li>
                <li class="list-group-item"><a href="javascript:">---- ---- ---- ---- ---</a></li>
                <li class="list-group-item"><a href="javascript:">---- ---- ---- ---- ---</a></li>
              </ul>
            </div>  
        </div>    
        <div class="col-md-6">
            <div id="div_blue">
            <ul class="list-group">
                <li class="list-group-item blue">
                    <a href="javascript:"> Our Support Services<span></span></a>
                </li>
                <li class="list-group-item blue-color">
                  <a href="{{url('fontend/images/document/smartphone.pdf#zoom=100')}}" target="_blank">
                    
                    {{$pagelanguage['LG_Smartphone_Access']}}
                  </a>
                </li>
                <li class="list-group-item"><a href="javascript:">---- ---- ---- ---- ---</a></li>
                <li class="list-group-item"><a href="javascript:">---- ---- ---- ---- ---</a></li>
                <li class="list-group-item"><a href="javascript:">---- ---- ---- ---- ---</a></li>
              </ul>
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