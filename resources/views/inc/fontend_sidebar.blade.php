<div id="side_menus">
<style>
    #login {
    background-color: #fbe8d0;
    padding: 16px 16px 8px 16px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    -ms-border-radius: 4px;
    border-radius: 4px;
    margin-bottom: 15px;
}
#login input.login {background: #f5a63f;border-color: #f5a63f;height:32px;line-height: 0px;color: #fff;border-radius: 3px;}
#bidder_section a.button {background: #f5a63f;border-color: #f5a63f;height:32px;color: #fff;border-radius: 3px;margin: 5px;width: 95%;padding:0 !important;}
.bidderselection{background: #f4f4f4;margin-bottom: 15px;}
#side_menus ul li a {line-height: 18px;}
.subicon{
    width: 10%;
    display: block;
    float: left;
    height: 100%;
}
.subtex{
    width: 90%;
    display: block;
    float: right;
}
@font-face {
  font-family: 'password';
  font-style: normal;
  font-weight: 400;
  src: url(https://jsbin-user-assets.s3.amazonaws.com/rafaelcastrocouto/password.ttf);
}
input.myclass{font-family: 'password';}
</style>

    <?php 
        $logger_id = Session::get('logger_id'); 
        $loginstatus = Session::get('loginstatus');
        if($loginstatus != 1 && $loginstatus != 2 && $logger_id != '-1')
        {
    ?>
    <div id="login"> 
        <form id="form" action="" method="post" autocomplete="off">
        <dl>
        <dt style="color: #F5A64E;">{{$pagelanguage['LG_Login_ID']}}</dt>
        <dd>
            <input type="search" id="username" autocomplete="off" style="border: #fbe8d0;padding-left: 5px;color: #000;width: 180px;min-height:25px;" required>
        </dd>
        <dt style="color: #F5A64E;">{{$pagelanguage['LG_Password']}}</dt>
        <dd>
            <input type="text"  id="userpass" class="myclass"  autocomplete="off"   style="border: #fbe8d0;padding-left: 5px;color: #000;width: 180px;min-height:25px;" required>
        </dd>
        </dl>
        <input type="button" class="login button" value="{{$pagelanguage['LG_Login']}}" onclick="bidderLogin(); return false;" style="margin-top: 10px;">
        <br>
        <span id="errorloginmsg" style="display: none"></span>
        
        <a class="forget" href="javascript:" data-toggle="modal" data-target="#forgetPasswordForm">{{$pagelanguage['LG_Forgot_Your_Password']}}</a>
        </form>
        
    </div>
    <?php 
        }
        else
        {
    ?>  
    

    <!--===== After Login start======--->
    <div id="bidder_section" class="bidderselection">  
        <form id="favorite" method="post" action="">
            <a href="{{route('auction.selected_product')}}" class="button"><?php if(session()->get('language')=='en'){?>Watch List<?php }else{?>ウォッチリスト<?php }?></a>
            {{-- <a href="{{route('auction.selected_product_result')}}" class="button"><?php if(session()->get('language')=='en'){?>Result of Selections<?php }else{?>選考結果<?php }?></a> --}}
            {{-- <a href="" class="button"><?php if(session()->get('language')=='en'){?>Winner's Account<?php }else{?>当選者アカウント<?php }?></a> --}}
            <?php 
            if($loginstatus == 2)
            {
            ?>
            <a href="{{route('auction.owner_product_show',[$logger_id])}}" class="button"><?php if(session()->get('language')=='en'){?>My Product<?php }else{?>当選者アカウント<?php }?></a>
            <?php 
            }
            ?>    
        </form>
        {{-- <form class="logout" action="" method="post"  style="padding-left: 5px;">
            <label onclick="bidderLoginout(); return false;" style="cursor: pointer">
                <i class="fa fa-sign-out"></i> 
                <?php if(session()->get('language')=='en'){?>Logout<?php }else{?>ログアウト<?php }?>
            </label>
        </form> --}}
        <a href="{{url('auction/bidder_logout')}}" style="padding-left: 10px;"><i class="fa fa-sign-out"></i>{{$pagelanguage['LG_Logout']}}</a>
    </div>
    
    <!--===== After login end========--->

    <?php 
        }
    ?>   
    



    <!---===== Side Menu of welcome page ======-->
    <div class="rd-navbar-nav-wrap__inner">
        <?php 
            $categories = App\Models\Category::where('status','active')->orderBy('sl','asc')->get();    
        ?>
        <!-- Navbar Nav-->
        <ul>
            <a href="javascript:" class="menutitle">{{$pagelanguage['LG_Category_List']}}</a>
            <li>
                <?php 
                    $all= -1;
                    $auction =  App\Models\Auction::where('status',1)->get(); 
                    $productlist = App\Models\Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->get();
                    $totalrow = $productlist->count();
                ?>
                <a href="{{route('auction.category',[$all])}}">
                    <?php if(session()->get('language')=='en'){?>ALL<?php }else{?>全て<?php }?>
                    <span style="float: right;color:#F5A64E">{{$totalrow}}</span>
                </a>
            </li>
            @foreach($categories as $category)  
                <?php 
                    $products = App\Models\Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->where('category_id',$category->id)->get();
                    $countedproduct = $products->count();
                ?>
                <li>
                    <a href="{{route('auction.category',[$category->id])}}">
                        <?php if(session()->get('language')=='en'){?><span style="text-transform:uppercase;">{{$category->name_en}}</span><?php }else{?>{{$category->name_jp}}<?php }?>
                        <span style="float: right;color:#F5A64E">{{$countedproduct}}</span>
                    </a>
                </li>
                
            @endforeach    
          
        </ul>
      </div>


      <div class="rd-navbar-nav-wrap__inner" style="margin-top: 15px;">
        
        <!-- Navbar Nav-->
        <ul>
            <a href="javascript:" class="menutitle">{{$pagelanguage['LG_Bidding']}}</a>
            <li>
                <a href="{{url('fontend/images/document/smartphone.pdf#zoom=100')}}" target="_blank">{{$pagelanguage['LG_Smartphone_Access']}}</a>
            </li>
            {{-- <li>
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
            </li> --}}
            <li>
                <a href="{{route('bid_document.shipping_charge')}}">
                    {{$pagelanguage['LG_Shipping_charge']}}
                </a>
            </li>
            
        </ul>
      </div>


      <div class="rd-navbar-nav-wrap__inner" style="margin-top: 15px;">
        
        <!-- Navbar Nav-->
        <ul>
            <a href="javascript:" class="menutitle">{{$pagelanguage['LG_Consignor']}}</a>
            <li>
                <a href="{{route('woody.search_site')}}">{{$pagelanguage['LG_AuctionResults']}}</a>
            </li>
            {{-- <li>
                <a href="{{url('fontend/images/document/auction_photos.pdf#zoom=100')}}" target="_blank">{{$pagelanguage['LG_auction_photo']}}</a>
            </li> --}}
            
        </ul>
      </div>

</div>