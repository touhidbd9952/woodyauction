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
    $auction_dates = App\Models\Auction::distinct('auction_end')->where('auction_end','not like', '%'.$auction_date.'%')->orderby('auction_end','desc')->get();  
    //dd($auction_dates);
    ?>
    
      
      <section class="products-section">
      <div class="container">
        <div class="row">  


        <div class="col-md-8">
         
          <table  class="table table-striped table-bordered" style="max-height:600px;height:auto;overflow-y: scroll;">
            <thead>
              <tr>
                  <th>{{$pagelanguage['LG_WOODY_AUCTION_RESULT']}}</th>
                  <th>{{$pagelanguage['LG_AUCTION_DATE']}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($auction_dates as $acs)   
                
              <tr>
                <td>
                  <span class="redcolor">
                    {{$pagelanguage['LG_Auction_Information']}}
                  </span>
                </td>
                <td>{{date('Y-m-d',strtotime($acs->auction_end))}}</td>
              </tr>
              
              @endforeach
            </tbody>
         
        </table>
            
         
        </div>
        <div class="col-md-4">
              <div class="panel panel-primary">
                <div class="panel-heading" style="background: #F5A85F;border-color: #F5A85F;">
                    <div class="text-center">
                        Member Log-in
                    </div>
                </div>

                <div class="panel-body">
                    <div class="row">
                      <form action="{{route('woody.search_site_bidder_login')}}" method="POST">
                        @csrf

                        <div class="col-xs-12 form-group">
                          {{$pagelanguage['LG_Login_ID']}}<br>
                            <input type="text"  name="username" tabindex="1" maxlength="37" class="form-control" placeholder="Login ID">
                        </div>

                        <div class="col-xs-12 form-group">
                          {{$pagelanguage['LG_Password']}}<br>
                            <input type="password"  name="password" tabindex="2" maxlength="37" class="form-control" placeholder="Password">
                        </div>

                        <div class="col-xs-12" style="display: none">
                            <b>Location：</b>

                            <input type="radio" name="place" tabindex="3" value="0" id="place0" checked>
                            <label for="place0">Office</label>&nbsp;&nbsp;

                            <input type="radio" name="place" tabindex="3" value="1" id="place1">
                            <label for="place1">Outside</label>&nbsp;&nbsp;

                            <input type="radio" name="place" tabindex="3" value="2" id="place2">
                            <label for="place2">Home</label>&nbsp;&nbsp;

                        </div>
                        <div class="col-xs-12 form-group" style="display: none">
                          ※This section use for date wise auction result show.
                      </div>
                      <div class="col-xs-12 form-group text-center">
                          <button class="btn btn-primary">{{$pagelanguage['LG_Login']}}</button>
                      </div>
                    </form>

                    @if(session('esuccess'))     
                    <br><br>  
                    <span style="color: #FF0000;width: 100%;text-align: center;display: block;"><strong>Error!</strong> {{ session('esuccess') }}</span>
                    @endif

                    </div>
                </div>
                

              </div>
              <div class="form-group">
                <div class="text-center form-group">
                    <button data-toggle="modal" data-target="#forgetPasswordForm" class="btn btn-primary btn-lg btn-block">{{$pagelanguage['LG_Forgot_Your_Password']}}</button>
                </div>
        
                <div class="text-center form-group">
                    <a href="{{route('member.register')}}" class="btn btn-primary btn-lg btn-block">
                      {{$pagelanguage['LG_Member_registration_for_Bidding']}}
                    </a>
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