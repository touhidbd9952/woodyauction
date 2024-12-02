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
    $auction_date =  date('Y-m-d',strtotime(App\Models\Auction::max('auction_end')));  
    $auction_dates = App\Models\Auction::distinct('auction_end')->where('auction_end','not like', '%'.$auction_date.'%')->orderby('auction_end','desc')->get();    //dd($auction_dates);
    ?>
    
      
      <section class="products-section">
      <div class="container">
        <div class="row">  


        <div class="col-md-12">
            <a href="{{route('woody.search_site_logout')}}" class="btn btn-primary" style="float: right;margin-top:-50px;">{{$pagelanguage['LG_Logout']}}</a>
         
          <table  class="table table-striped table-bordered" style="max-height:600px;height:auto;overflow-y: scroll;">
            <thead>
              <tr>
                  <th>{{$pagelanguage['LG_WOODY_AUCTION_RESULT']}}</th>
                  <th>{{$pagelanguage['LG_AUCTION_DATE']}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($auction_dates as $acs)   
                <?php 
                $auctiondate = $acs->auction_end;

                

                ?>
              <tr>
                <td>
                    <a href="{{url('search_site/bid_result/'.date('Y-m-d',strtotime($acs->auction_end)))}}">
                      <span class="redcolor">
                        {{$pagelanguage['LG_Auction_Information']}}
                      </span>
                    </a>
                </td>
                <td><a href="{{url('search_site/bid_result/'.date('Y-m-d',strtotime($acs->auction_end)))}}">{{date('Y-m-d',strtotime($acs->auction_end))}}</a></td>
              </tr>
              
              @endforeach
        </tbody>
         
        </table>
            
         
        </div>
        

        

       </div>
      
      </div>
      </section>
      
      
      </section>
  </div>
    
    
  </div>
</section>


  @endsection