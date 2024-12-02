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
    .panel-primary {border-color: #F5A85F;}
    .redcolor{background: #FF0000;color: #FFFFFF;border: solid 1px #FF0000;border-radius: 10px;padding: 0.0em 0.5em;font-weight: bold;}
  </style>    
  
  <div class="cat-items-grid">
  <section id="home" class="home-page-content page-content">

      
    <?php 
    $auction_date =  date('Y-m-d',strtotime(App\Models\Product::max('auction_date')));  
    $auction_dates = App\Models\Product::distinct('auction_date')->where('auction_date','not like', '%'.$auction_date.'%')->orderby('auction_date','desc')->get();  //dd($auction_dates);
    ?>
    
      
      <section class="products-section">
      <div class="container">
        <div class="row">  


        <div class="col-md-12">
            <a href="{{route('woody.search_site_logout')}}" class="btn btn-primary" style="float: right;display:inline-block;margin-top:-50px;">{{$pagelanguage['LG_Logout']}}</a>
            <a href="javascript:" onclick="history.back(); return false;" class="btn" style="float:right;display:inline-block;margin-top:-50px;margin-right:100px;border: 1px solid #F5A63F;color: #F5A63F;">
                <img src="{{url('fontend/images/left-arrow.png')}}" style="height: 20px;">{{$pagelanguage['LG_Back']}}
            </a>
         
            <h4>{{$pagelanguage['LG_language'] == 'en'?'Results of '.date('Y-m-d',strtotime($auctiondate)):date('Y-m-d',strtotime($auctiondate)).'の結果'}}</h4>
            [SOLD]<br>
            <table  class="table table-striped table-bordered">
              <thead  class="thead-dark">
                <tr class="table-secondary">
                    <th class="headercolor">{{$pagelanguage['LG_Auction_No']}}</th>
                    <th class="headercolor">{{$pagelanguage['LG_Model']}}</th>
                    <th class="headercolor">{{$pagelanguage['LG_Serial']}}</th>
                    <th class="headercolor">{{$pagelanguage['LG_Delivery_Place']}}</th>
                    <th class="headercolor">{{$pagelanguage['LG_Price']}}</th>
                </tr>
            </thead>
             <tbody>
              <?php 
              $deliveryPlaceName = "";  
             ?>
            @foreach($auction_result as $acs)   
              <?php 
              if($acs->final_result == 'sold')
              {
              ?>
              @foreach($deliveryplaces as $d)
              <?php 
              if($d->id == $acs->delivery_place_id){$deliveryPlaceName = $d->name_en;}
              ?>
              @endforeach
             <tr>
              <td>{{$acs->product_no}}</td>
              <td>{{$acs->model_no}}</td>
              <td>{{$acs->serial_no}}</td>
              <td>{{$deliveryPlaceName}}</td>
              <td style="text-align: right">{{number_format($acs->auction_max_bid_amount)}}</td>
             </tr>
             <?php 
              }
             ?>
             @endforeach
             </tbody>
            </table>

            <br><br>

            {{-- [UNSOLD]<br> --}}

            {{-- <table class="table table-striped table-bordered">
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
                <td>{{$acs->delivery_place}}</td>
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
      </section>
      
      
      </section>
  </div>
    
    
  </div>
</section>


  @endsection