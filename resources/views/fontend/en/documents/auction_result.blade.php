@extends('layouts.fontend_master2')

@section('content')
 
 
 <!-- Swiper -->
 <!-- Breadcrumbs-->
 

<!--=============================  ======================================-->
<section class="section section-md bg-white">
  <div class="shell shell-wide wow fadeInUpSmall divsize" data-wow-offset="150" style="margin-left: 0px;margin-right:0px;">
    
    <style>
      .headercolor{
    background: #FBE8D0;
    color: #776161;
    border-color: #FBE8D0;
}
    
      @media(max-width:767px)
      {
          .pmr{padding-right: 15px;}
      }
  </style>    
  
  <div class="cat-items-grid">
  <section id="home" class="home-page-content page-content">
      <section class="products-section">
      <div class="container">
        <div class="row">  


        @include('inc.fontend_sidebar')




        <div id="main_contents">
         <div style="width: 100%;min-height:100px;border:1px solid #ccc;padding:10px;">  
            
            <div id="contents-wrapper">
                <?php 
                //echo $auction_date;exit;
                ?>
                <h4>Results of {{date('Y-m-d',strtotime($last_auction_date))}}</h4>
                [SOLD]<br>
                <table  class="table table-striped table-bordered">
                    <thead  class="thead-dark">
                        <tr class="table-secondary">
                            <th class="headercolor">AUCTION No.</th>
                            <th class="headercolor">Model</th>
                            <th class="headercolor">Serial No.</th>
                            <th class="headercolor">Location</th>
                            <th class="headercolor">Sold Price</th>
                        </tr>
                    </thead>
                 <tbody>
                @foreach($auction_result as $acs)   
                  <?php 
                  if($acs->final_result == 'sold')
                  {
                  ?>
                 <tr>
                  <td>
                    <a  href="{{route('auction.auction_details',[$acs->id])}}">
                      {{$acs->product_no}}
                    </a>
                    </td>
                  <td>{{$acs->model_no}}</td>
                  <td>{{$acs->serial_no}}</td>
                  <td>{{$acs->delivery_place_id !=""?$acs->delivery->name_en:""}}</td>
                  <td style="text-align: right;">{{number_format($acs->auction_max_bid_amount)}}</td>
                 </tr>
                 <?php 
                  }
                 ?>
                 @endforeach
                 </tbody>
                </table>

                <br><br>

{{--                 

                [UNSOLD]<br>

                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <thead  class="thead-dark">
                            <tr class="table-secondary">
                                <th class="headercolor">AUCTION No.</th>
                                <th class="headercolor">Model</th>
                                <th class="headercolor">Serial No.</th>
                                <th class="headercolor">Location</th>
                                <th class="headercolor"></th>
                            </tr>
                        </thead>
                    </thead>

                 <tbody>
                 
                    @foreach($auction_result as $acs)   
                    <?php 
                    if($acs->final_result == 'unsold')
                    {
                    ?>
                   <tr>
                    <td>{{$acs->product_no}}</td>
                    <td>{{$acs->model_no}}</td>
                    <td>{{$acs->serial_no}}</td>
                    <td>{{$acs->delivery->name_en}}</td>
                    <td>&nbsp;</td>
                   </tr>
                   <?php 
                    }
                   ?>
                   @endforeach
                </tbody>
            </table> --}}
                
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