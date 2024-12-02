@extends('layouts.fontend_master2')

@section('content')
 <!-- Swiper -->
 <!-- Breadcrumbs-->

<!--=============================  ======================================-->
<section class="section section-md bg-white">
  <div class="shell shell-wide wow fadeInUpSmall divsize" data-wow-offset="150" style="margin-left: 0px;margin-right:0px;">
  <div class="cat-items-grid">
  <section id="home" class="home-page-content page-content">
      <section class="products-section">
      <div class="container">
        <div class="row">  
            <h2>Guide Book</h2>
            <ul>
              <a href="javascript:" class="menutitle">
                {{$pagelanguage['LG_Bidding']}}
              </a>
              <li>
                  <a href="{{url('fontend/images/document/smartphone.pdf#zoom=100')}}" target="_blank">
                    <span class="subicon"><i class="fas fa-play pdli"></i></span>
                    <span class="subtex">{{$pagelanguage['LG_Smartphone_Access']}}</span>
                  </a>
              </li>
              <li>
                  <a href="javascript:">{{$pagelanguage['LG_How_to_Bid_and_Deposit']}}</a>
              </li>
              <li>
                  <a href="{{route('member.register')}}" class="pdl">
                      <span class="subicon"><i class="fas fa-play pdli"></i></span> 
                      <span class="subtex">{{$pagelanguage['LG_Member_registration_for_Bidding']}}</span>
                  </a>
              </li>
              
              <li>
                  <a href="{{route('woody.terms_and_condition')}}">
                      <span class="subicon"><i class="fas fa-play pdli"></i></span> 
                      <span class="subtex">{{$pagelanguage['LG_Terms_and_Conditions_for_Bidding']}}</span>
                  </a>
              </li>
              <li>
                  <a href="{{route('woody.security_deposit')}}">
                      <span class="subicon"><i class="fas fa-play pdli"></i></span> 
                      <span class="subtex">{{$pagelanguage['LG_Security_Deposit']}}</span>
                  </a>
              </li>
              <li>
                  <a href="{{route('woody.winner_bidding_to_payment')}}">
                      <span class="subicon"><i class="fas fa-play pdli"></i></span>
                      <span class="subtex">{{$pagelanguage['LG_Winner_Bidding_to_Payment']}}</span>
                  </a>
              </li> 
              <li>
                  <a href="{{route('bid_document.carry_out_of_equipment')}}">
                      <span class="subicon"><i class="fas fa-play pdli"></i></span>
                      <span class="subtex">{{$pagelanguage['LG_Carry_Out_of_Equipment']}}</span>
                  </a>
              </li>
              <li>
                  <a href="{{route('bid_document.bidding_style')}}">
                      <span class="subicon"><i class="fas fa-play pdli"></i></span>
                      <span class="subtex">{{$pagelanguage['LG_Bidding_Style']}}</span>
                  </a>
              </li>
              <li>
                  <a href="{{route('bid_document.log_in_and_bedding')}}">
                      <span class="subicon"><i class="fas fa-play pdli"></i></span>
                      <span class="subtex">{{$pagelanguage['LG_Log_in_and_Bedding']}}</span>
                  </a>
              </li>
              <li>
                  <a href="{{route('bid_document.shipping_charge')}}">
                    <span class="subicon"><i class="fas fa-play pdli"></i></span>
                    <span class="subtex">{{$pagelanguage['LG_Shipping_charge']}}</span>
                  </a>
              </li>
              
          </ul>

        </div>
      </div>
      </section>
      </section>
  </div>
  </div>
</section>





  @endsection