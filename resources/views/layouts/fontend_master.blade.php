<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <!-- Site Title-->
    <title>Woody Auction</title>
    <meta name="format-detection" content="telephone=no">
    {{-- <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"> --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">

    <meta name="description" content="A Site for Equipment Dealers! The Newest and Fastest Search Site! 24/7/365 Net Auction Service">
    <meta name="Keywords" content="WOODY,ウッディ,検索,オークション,盗難車,リクルート,求人,ノリ,トラック,海外,スケジュール,ニュース,建設機械,建機,中古,中古建設機械,WOODY,SEARCH,WOODY AUCTION,TRUCK,SCHEDULE,NEWS,WOODY NETWORK,HEAVY EQUIPMENT,EXCAVATOR,WHEEL LOADER,TRACTOR,LOADER, CRANE,ROLLER,MISCELLANEOUS,CATERPILLAR,KOMATSU,HITACHI"> 
    
    <!--Cache clear-->
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="cache-control" content="no-store" />
    <meta http-equiv="cache-control" content="must-revalidate" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <!---->

    <link rel="icon" href="{{ asset('fontend') }}/images/woodyfavicon.ico" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto+Mono:300,400,500,700">
    <link rel="stylesheet" href="{{ asset('fontend') }}/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('fontend') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('fontend') }}/css/toastr.css">
    
		<!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="{{ asset('fontend') }}/images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="{{ asset('fontend') }}/js/html5shiv.min.js"></script>
		<![endif]-->
    <style>
      body {color: #373636 !important;}
      * {margin: 0;padding: 0;font-family: Arial, "メイリオ", Meiryo, sans-serif;font-style: normal;list-style: none;vertical-align: top;font-size: 13px;}
      .btn-primary {color: #fff;background-color: #f5a63f;border-color: #f5a63f;}
      .btn-primary:hover {color: #fff;background-color: #424242;border-color: #424242;}
      #product_details td{text-align: left;text-align: left;padding-left:10px;}
      #product_details th {
    padding: 5px 10px;
    border-bottom: 1px solid #FFFFFF;
    width: 150px;
    color: #3F3F3F;
    background: #F3F3F3;
}
.section__header-element{display: none;}
.table .table {color: #1a1818;}

#main_contents {margin-left: 240px;min-width: 700px;}

#side_menus {float: left;width: 220px;padding-bottom: 24px;padding: 15px 0px;}
#side_menus ul{list-style-type: circle;}
#side_menus ul li{background: #f4f4f4;margin-bottom: 3px;}
#side_menus ul li a{padding: 2px 15px;width: 220px;display:inline-block;font-size:13px;}
.menutitle{padding-left: 15px;background: #ccc;width: 100%;display: block;color:#fff;font-weight:bold;font-size:16px;}
.menutitle:hover, .menutitle:focus {
    color: #fff !important;
    text-decoration: none;
    outline: none;
}
footer a,footer p{color: #fff !important;}

/* top menu */
.rd-navbar-fixed .rd-navbar-nav-wrap {
  transform: translateX(0) !important;
  position: relative !important;
  z-index: 100;
  top: 0px;
  left: 0;
  width: 100% !important;
  padding: 5px 0px !important;
  bottom: 0px;
 margin-top: -45px;

}
.rd-navbar-fixed .rd-navbar-brand{left: 5px !important; top:10px;}
.rd-navbar-fixed .rd-navbar-toggle {
  display: none !important;
}
.rd-navbar-panel{max-width: 150px !important;}
.rd-navbar-fixed .rd-navbar-nav li {text-align: left;float: left;}
.rd-navbar-fixed .rd-navbar-nav {display: block;margin: 0px 0 0 250px;height: auto;text-align: left;}
.rd-navbar-fullwidth .rd-navbar-nav {display: inline-block;}
.brand{padding-right: 100px}
.ytp-chrome-top-buttons {display: none !important;}

@media (min-width:992px)
{
  /* .section-md {padding: 50px 0;} */
}

@media (max-width:767px)
{
  .container{margin: 0px !important;}
  
  #main_contents {margin-left: 225px !important;width: 95% !important;}
  #side_menus {float: left;width: 220px;padding-bottom: 24px;border: 1px solid #ccc;padding: 15px 0;}
}
    </style>
  </head>
  <body>
    <!-- Page Loader-->
    <div id="page-loader">
      <div class="page-loader-logo">
        <div class="brand">
          <div class="brand__name"><img src="{{ asset('fontend') }}/images/woody-logo.png" alt="" width="123" height="47"/>
          </div>
        </div>
      </div>
      <div class="page-loader-body">
        <div id="loadingProgressG">
          <div class="loadingProgressG" id="loadingProgressG_1"></div>
        </div>
      </div>
    </div>
    <!-- Page-->
    <div class="page">
      <header class="page-header section">
        <!-- RD Navbar-->
        @include('inc.fontend_master_top_navbar')
        
      </header>



  

  @yield('content')





 
  <!--======== Page Footer ==========-->
  <footer class="footer-corporate">
    <div class="footer-corporate__main bg-gray-7">
      <div class="shell shell-fluid shell-condensed">
        <div class="range range-xs-center range_xl-ten range-50 footer-corporate__range">

          <!--================ Main Office ========================================================================================-->
          <?php  
              if(session()->get('language')=='en')
              {
            ?>
          <div class="cell-xs-10 cell-sm-6 cell-md-4 cell-lg-4 cell-xl-2 footer-corporate__column">
            <h4 class="heading-bordered">Office</h4>
            <ul class="list-md">
              <li> 
                <p class="address">
                  <dl class="list-terms-inline">
                    <dt>Tokyo Office</dt>
                    <dd>1-4-4 Higashi Yaguchi Ota-Ku Tokyo, Japan 146-0094</dd>
                  </dl>
                </p>
                <ul class="list-inline-0">
                 <li>
                  <dl class="list-terms-inline">
                    <dt>E-mail</dt>
                    <dd><a href="mailto:#">info@woodyltd.com</a></dd>
                  </dl>
                  </li>
                  <li>
                    <dl class="list-terms-inline">
                      <dt>Phone No</dt>
                      <dd>+81(0)3-5700-4622</dd>
                    </dl>
                  </li>
                  <li>
                    <dl class="list-terms-inline">
                      <dt>Mobile No</dt>
                      <dd>+8190-8944-2747</dd>
                    </dl>
                  </li>
                  <li>
                    <dl class="list-terms-inline">
                      <dt>Fax</dt>
                      <dd>+81(0)3-5700-4625</dd>
                    </dl>
                  </li>

                </ul>
              </li>


              <li>
                <dl class="list-terms-inline">
                  <dt>Narita Factory</dt>
                  <dd>185-943 Tokura Tomisato-Shi, Chiba 286-0212</dd>
                </dl>
              </li>
              <li style="margin-top: 0px;">
                <dl class="list-terms-inline">
                  <dt>Phone No</dt>
                  <dd>+81(0)4-7637-6694</dd>
                </dl>
              </li>
              <li style="margin-top: 0px;">
                <dl class="list-terms-inline">
                  <dt>Fax</dt>
                  <dd>+81(0)4-7637-6695</dd>
                </dl>
              </li>

            </ul>
          </div>
          <?php     

            }
            else 
            {
            ?>
            <div class="cell-xs-10 cell-sm-6 cell-md-4 cell-lg-4 cell-xl-2 footer-corporate__column">
              <h4 class="heading-bordered">オフィス</h4>
              <ul class="list-md">
                <li> 
                  <p class="address">
                    <dl class="list-terms-inline">
                      <dt>東京オフィス</dt>
                      <dd><br>東京都大田区東矢口1-4-4</dd>
                    </dl>
                  </p>
                  <ul class="list-inline-0">
                  
                   <li style="display: block;">
                    <dl class="list-terms-inline">
                      <dt>TEL</dt>
                      <dd>03-5700-4622</dd>
                    </dl>
                  </li>
                  <li style="display: block;">
                    <dl class="list-terms-inline">
                      <dt>FAX</dt>
                      <dd>03-5700-4625</dd>
                    </dl>
                  </li>
                  <li style="display: block;">
                    <dl class="list-terms-inline">
                      <dt>携帯</dt>
                      <dd>090-8944-2747</dd>
                    </dl>
                  </li>
                  <li>
                    <dl class="list-terms-inline">
                      <dt>Eメール</dt>
                      <dd><a href="mailto:#">info@woodyltd.com</a></dd>
                    </dl>
                   </li>
                    
                    
                  </ul>
                </li>


                <li>
                  <dl class="list-terms-inline">
                    <dt>ファクトリーオフィス</dt>
                    <dd><br>〒286-0212 <br>千葉県富里市十倉185-943</dd>
                  </dl>
                </li>
                <li style="margin-top: 0px;">
                  <dl class="list-terms-inline">
                    <dt>TEL</dt>
                    <dd>04-7637-6694</dd>
                  </dl>
                </li>
                <li style="margin-top: 0px;">
                <dl class="list-terms-inline">
                  <dt>FAX</dt>
                  <dd>04-7637-6695</dd>
                </dl>
              </li>
              <li style="margin-top: 0px;">
                <dl class="list-terms-inline">
                  <dt>Eメール</dt>
                  <dd>info@woodyltd.com</dd>
                </dl>
              </li>
                
              </ul>
            </div>
          <?php   
            }
          ?> 








<!--================ Latest News (footer)========================================================================================-->
          <div class="cell-xs-6 cell-sm-6 cell-md-5 cell-lg-5 footer-corporate__column">
            <?php  
              if(session()->get('language')=='en')
              {
            ?>
            <h4 class="heading-bordered">ATTENTION</h4>
            <ul class="post-group post-light-group">
              <li>
                <article class="post-light">
                  <p class="post-light__title"><a href="javascript:">
                    We found that unidentified people impersonate us and send the offer of other suppliers machines through woodyltd.jp@gmail.com.		
                    Our email domain to contact with and send the offer to our customers is @woodyltd.com only.		
                    No other domain such as gmail, yahoo, hotmail and so on is never used.		
                    In case you received the e-mail other than from our account, @woodyltd.com, again,		
                    please do not contact/reply them.		<br><br>
                    The Bank we are using is MUFG BANK,LTD,KAMATA BRANCH, the account name is WOODY CO.,LTD.		
                    Your prompt attention and cooperation is highly appreciated.		
                    Please do not hesitate any questions on this matter.		

                  </a>
                </p>
                </article>
              </li>
              
            </ul>
            <?php     
            }
            else 
            {
            ?>
            <h4 class="heading-bordered">注意</h4> 
            <ul class="post-group post-light-group">
              <li>
                <article class="post-light">
                  <p class="post-light__title">
                    <a href="javascript:">
                      正体不明の人々が我々に扮し、woodyltd.jp@gmail.comという メールアドレスを使用して、他社機械をオファーをしていることが発覚致しました。 		
                      私達がお客様へ連絡をとり、オファーメールを送付するドメインは、@woodyltd.com　のみです。 <br>
                      Gmail、Yahoo、Hotmailなどのような他のドメインは決して使用致しません。<br>		
                      もし弊社の、@woodyltd.com　以外のメールアドレスよりメールを受け取った際は、彼らに連絡/返信をしないで下さい。<br><br>
                      弊社の取引銀行は三菱UFJ銀行の蒲田支店、		口座名は有限会社　ウッディーです。
		
                      ご対応とご協力をよろしくお願い致します。
		
                      この件についてご質問ございましたらご連絡下さい。		
                      よろしくお願い致します。	
                    </a>
                  </p>
                  
                </article>
              </li>
              
            </ul>
            <?php   
            }
            ?>
          </div>




<!--================ Links (footer)========================================================================================-->
          <div class="cell-xs-4 cell-sm-6 cell-md-3 cell-lg-3 cell-xl-1 footer-corporate__column">
            
            <?php  
              if(session()->get('language')=='en')
              {
            ?>

            <h4 class="heading-bordered">Links</h4>

            <ul class="list-xxs list_darker">
              <li><a href="{{url('/')}}">Top Page</a></li>
              <li><a href="{{route('woody.auction')}}">Woody Auction</a></li>
              <li><a href="{{route('woody.search_site')}}">Woody Search Site</a></li>
              {{-- <li><a href="{{route('woody.guidebook')}}">Woody Guidebook</a></li> --}}
              <li><a href="{{route('woody.support')}}">Support</a></li>
      
            </ul>
            <?php     

            }
            else {
            ?>
            <h4 class="heading-bordered">リンク</h4>

            <ul class="list-xxs list_darker">
              <li><a href="{{url('/')}}">トップページ</a></li>
              <li><a href="{{route('woody.auction')}}">ウッディオークション</a></li>
              <li><a href="{{route('woody.search_site')}}">ウッディ検索サイト</a></li>
              {{-- <li><a href="{{route('woody.guidebook')}}">ウッディガイドブック</a></li> --}}
              <li><a href="{{route('woody.support')}}">サポート</a></li>
      
            </ul>
          <?php   
            }
          ?> 

          </div>
        </div>
      </div>
    </div>
    <div class="footer-corporate__aside bg-gray-8 text-center">
      <div class="shell shell-fluid shell-condensed">
        <div class="range range-20 range_xl-ten footer-corporate__range">
          <div class="cell-sm-8 cell-xl-6 footer-corporate__aside-column text-sm-left">
            <!-- Rights-->
            <p class="rights">
              <span>woodyltd.com</span>
              <span>&nbsp;&copy;&nbsp;</span>
              <span>1991</span>.&nbsp;
              <br class="veil-xs">
              
            </p>
          </div>
          <div class="cell-sm-4 cell-xl-4 footer-corporate__aside-column text-sm-right"> 
            <ul class="list-inline-xxs"> 
              <li><a class="icon icon-xs icon-style-modern fa fa-twitter" href="#"></a></li>
              <li><a class="icon icon-xs icon-style-modern fa fa-facebook" href="#"></a></li>
              <li><a class="icon icon-xs icon-style-modern fa fa-instagram" href="#"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
</div>

<!-- Modal start -->
<style>
  .forget {
            max-width: 400px;
            min-height: 250px;
            margin: 0 auto;
            color:rgb(29, 5, 246);
            text-decoration: underline;
        }
        
        input#email {
            min-height: 30px;
            line-height: 30px;
            width: 250px;
            float: left;
            border: 1px solid #f5a63f;
            padding-left: 5px;
            color: #000;
        }
        .ml{margin-left: 10px}
        .modal-body p{color:#000;}
</style>

<div class="modal fade" id="forgetPasswordForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          <?php 
          if(Session::get('language') == 'en')
          {
          ?>
          Inquiry of Password
          <?php 
          }
          else
          {
          ?>
          パスワードの問い合わせ
          <?php 
          }
          ?>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="font-size: 24px;">&times;</span>
          </button>
        </h5>
        
      </div>
      <div class="modal-body">
        <?php 
          if(Session::get('language') == 'en')
          {
          ?>
            <p>
              If you forget your password, put your e-mail address in the box below and click "Send" button. 
              We will send you password change link by e-mail after confirming your information. 
              Check your e-mail account after a while. 
            </p>
        <?php 
          }
          else
          {
          ?>
            <p>
              もしパスワードをお忘れの際は、下記にメールアドレスを入力し、"送信"ボタンをクリックしてください。
              情報を確認した後にEメールにてパスワード変更のリンクをお送り致します。
              少し経った後でEメールをご確認下さい。
            </p>  
          <?php 
          }
          ?>

        <form action="{{route('bidder.password_retrieve')}}" method="POST" style="min-height: 50px;" class="from-prevent-multiple-submits">
          @csrf
            <input type="email" name="email" id="email" value="" autocomplete="off">
            <button type="submit" class="btn btn-primary ml from-prevent-multiple-submits">
          <?php 
          if(Session::get('language') == 'en')
          {
          ?>
              Send
          <?php 
          }
          else
          {
          ?>
              送信
          <?php 
          }
          ?>
            </button>
            
          </form>
      </div>
      <div class="modal-footer">
        
      </div>

    </div>
  </div>
</div>
<!-- Modal end -->




<!-- Global Mailform Output-->
<div class="snackbars" id="form-output-global"></div>
<!-- Javascript-->
<script src="{{ asset('fontend') }}/js/core.min.js"></script>
<script src="{{ asset('fontend') }}/js/script.js"></script>

<script type="text/javascript" src="{{ asset('fontend') }}/js/toastr.min.js"></script>
<script>
  @if(Session::has('message'))
    var type ="{{Session::get('alert-type','info')}}"
    switch(type){
        case 'info':
            toastr.info(" {{Session::get('message')}} ");
            break;
        case 'success':
            toastr.success(" {{Session::get('message')}} ");
            break;
        case 'warning':
            toastr.warning(" {{Session::get('message')}} ");
            break;
        case 'error':
            toastr.error(" {{Session::get('message')}} ");
            break;
    }
@endif
</script>

<script type="text/javascript">
  $("#getchapcha").click(function(){
  
    $.ajax({
       type:'GET',
       url:'/refresh_captcha',
       success:function(data)
       {
  
          $(".captcha span").html(data.captcha);
  
       }
  
    });
  
  });
  
  </script>

<script>
  function biddecreasepriceset(id)
  {
      
      var bidincreaseprice ="";
      var bidcurrentprice ="";
      var bidstartprice ="";
      var bidprice =0;
      var bidtotalprice="";
  
      biddecreaseprice = parseInt(document.getElementById('biddecreaseprice'+id).value); 
      //bidcurrentprice = parseInt(document.getElementById('bidcurrentprice'+id).value);
      //bidingstartprice = parseInt(document.getElementById('bidingstartprice'+id).value);
      //bidprice = parseInt(document.getElementById('bidprice'+id).value);
      //bidtotalprice = document.getElementById('bidtotalprice'+id).value;
      bidcurrentprice = parseInt(document.getElementById('bidcurrentprice'+id).value);
      bidingstartprice = parseInt(document.getElementById('bidingstartprice'+id).value);
      bidtotalprice = parseInt(document.getElementById('bidtotalprice'+id).value);
      //bidprice = document.getElementById('bidprice'+id).value;  
      
      if(bidcurrentprice > bidtotalprice)
      {
          bidprice = bidcurrentprice - biddecreaseprice; 
          document.getElementById('bidprice'+id).value = bidprice.toLocaleString("en-US");
          document.getElementById('bidcurrentprice'+id).value = bidprice;
          if(bidprice == bidtotalprice)
          {
              document.getElementById('bidbtn'+id).style.display="none";
          }
      }
      else{
          document.getElementById('bidbtn'+id).style.display="none";
      }
      
      //alert(bidprice);
  
  }
  function bidincreasepriceset(id)
  {
      //alert(id);
      var bidincreaseprice ="";
      var bidcurrentprice ="";
      var bidstartprice ="";
      var bidprice =0;
      var bidtotalprice=0;
  
      bidincreaseprice = parseInt(document.getElementById('bidincreaseprice'+id).value);   
      bidcurrentprice = parseInt(document.getElementById('bidcurrentprice'+id).value); //alert(bidcurrentprice);
      bidingstartprice = parseInt(document.getElementById('bidingstartprice'+id).value);
  
      bidprice = bidcurrentprice + bidincreaseprice;
      document.getElementById('bidprice'+id).value = bidprice.toLocaleString("en-US");
      document.getElementById('bidcurrentprice'+id).value = bidprice;
      document.getElementById('bidbtn'+id).style.display="block";
  }
  function reload(id)
  {
      //alert(id); 
      var session = '<%=Session["logger_id"] != null%>';
      if (session == false) {
          location.reload();
      }

      $.ajax({
              type:'GET',
              url: '/auction/view_byproductid/'+id,
              dataType:'json',
              success:function(data){
                
                  document.getElementById('product_no'+id).innerHTML = data.pro_no; 
                  document.getElementById('brand'+id).innerHTML = data.brand.toUpperCase(); 
                  document.getElementById('modelyear'+id).innerHTML = data.modelyear;
                  document.getElementById('usedhour'+id).innerHTML = data.usedhour; 
                  document.getElementById('deliveryplace'+id).innerHTML = data.deliveryplace[0].toUpperCase() + data.deliveryplace.substring(1).toLowerCase()+"<br>Arrived (搬入済)";
                  document.getElementById('realeasingcharge'+id).innerHTML = data.realeasingcharge !='0'? "JPY "+data.realeasingcharge:"";
                  document.getElementById('modelno'+id).innerHTML = data.modelno;
                  document.getElementById('auction_max_bidder_price'+id).innerHTML = data.auction_max_bidder_price;   
  
                  // document.getElementById('biddercountry'+id).innerHTML = data.biddercountry ==""?"":'<img class="flag" src="'+data.biddercountry+'">';
                  document.getElementById('auction_max_bidder_code'+id).innerHTML = data.biddercodeno != ""? data.biddercodeno : '';     //alert(id);
                  //document.getElementById('bidder_id'+id).innerHTML = data.bidder_id != ""? data.bidder_id : 0;   
                  
                  //$('#totalbidno').val(data.id);
                  //$('#timeleft').val(data.id);data.timeleft
                  //document.getElementById('timeleft'+id).innerHTML = data.timeleft;
                  
                  document.getElementById('timeleft'+id).innerHTML = data.timeleft; 
                  document.getElementById('totalbids'+id).innerHTML = data.totalbidno;                   
  
                  document.getElementById('featureandcomment'+id).innerHTML = data.featureandcomment;   
                  if(data.biddingstatus =="yes")
                  {
                    if(data.current_bidder_id == data.auction_max_bidder_id)
                    {
                      document.getElementById('biddingstatus'+id).innerHTML = "You are currently the highest bidder." ;    //alert(id);
                      document.getElementById('biddingstatusresult'+id).style.cssText = 'text-align:center; background-color:#29AE6C; line-height:35px;';  //alert(id);
                    }
                    else if(data.current_bidder_id == data.auction_2ndmax_bidder_id)
                    {
                      document.getElementById('biddingstatus'+id).innerHTML = "You are not currently the highest bidder" ;
                      document.getElementById('biddingstatusresult'+id).style.cssText = 'text-align:center; background-color:#FF1F0E; line-height:35px;';
                    }
                    else if(data.this_auction_bided =="yes")
                    {
                      document.getElementById('biddingstatus'+id).innerHTML = "You lose the bid" ;
                      document.getElementById('biddingstatusresult'+id).style.cssText = 'text-align:center; background-color:#FF1F0E; line-height:35px;';
                    }
                  }
                  else if(data.biddingstatus =="no")
                  {
                      document.getElementById('biddingstatus'+id).innerHTML = "You are not currently the highest bidder" ;
                      document.getElementById('biddingstatusresult'+id).style.cssText = 'text-align:center; background-color:#FF1F0E; line-height:35px;';
                  }
                  else if(data.biddingstatus ==null)
                  {  
                      document.getElementById('biddingstatus'+id).innerHTML = "" ;
                      document.getElementById('biddingstatusresult'+id).style.cssText = 'text-align:center; background-color:#FFFFFF; line-height:35px;';
                  }
  
                  //bid button control
                  if(data.auction_max_bidder_id != data.current_bidder_id)
                  {
                    document.getElementById('bidbutton'+id).innerHTML = "" ;    //alert(id);
                    document.getElementById('bidbutton'+id).innerHTML = '<input type="submit"  value="Bid" class="button bid" style="padding: 0px 0px !important;margin-top: 0px;">';
                  }
                  else
                  {
                    document.getElementById('bidbutton'+id).innerHTML = "" ;
                    document.getElementById('bidbutton'+id).innerHTML = '<span  class="button bid" style="padding: 0px 0px !important;margin-top: 0px;"><i class="fas fa-check"></i> Bid</span>';
                  }
                  //document.getElementById('biddingstatus'+id).innerHTML = data.biddingstatus ;     
  
                  document.getElementById('biddecreaseprice'+id).value = parseInt(data.biddecreaseprice);   
                  document.getElementById('bidincreaseprice'+id).value = parseInt(data.bidincreaseprice); 
  
                  document.getElementById('bidingstartprice'+id).value = parseInt(data.bidingstartprice); 
  
                  
                  document.getElementById('bidcurrentprice'+id).value = parseInt(data.bidcurrentprice);
                  document.getElementById('bidingstartprice'+id).value = parseInt(data.bidingstartprice);  
  
                  
                  document.getElementById('bidprice'+id).value = data.bidprice;     //alert(id);

              }
          });

          generally_time_check();
  }

  function bidderLogin()
  {
    var username = document.getElementById('username').value;
    var userpass = document.getElementById('userpass').value;  //alert(userpass);
    if(username !="" && userpass !="")
    {
      //alert(username);
      $.ajax({
                type:'GET',
                url: '/auction/bidder_login',
                data: {
                      "_token": "{{ csrf_token() }}",
                      "username":username,
                      "password":userpass,
                  },
                dataType:'json',
                success:function(data)
                {  
                  //location.reload();
                  if(data.loginstatus ==1)
                  {
                    location.reload();
                    document.getElementById('login').style.display="none";
                    document.getElementById('bidder_section').style.display="block";
                    
                  }
                  else if(data.loginstatus == 2)
                  { 
                    location.reload(); 
                    document.getElementById('login').style.display="none";
                    document.getElementById('login_from_product_show').style.display="none";
                    document.getElementById('bidder_section').style.display="block";

                    for(var i=0;i<30;i++)
                    {
                      document.getElementsByClassName('biddingstatusdiv')[i].style.display="none";
                      document.getElementsByClassName('biddiv')[i].style.display="none"; 
                    }
                    //alert(data.loginstatus);
                   
                  }
                  else if(data.loginstatus == '-1')
                  {
                    location.reload();
                    document.getElementById('login').style.display="none";
                    document.getElementById('login_from_product_show').style.display="none";
                    document.getElementById('bidder_section').style.display="block";

                    for(var i=0;i<30;i++)
                    {
                      document.getElementsByClassName('biddingstatusdiv')[i].style.display="none";
                      document.getElementsByClassName('biddiv')[i].style.display="none"; 
                    }
                    //alert(data.loginstatus);
                    
                  }
                  else if(data.loginstatus == 0)
                  {
                    document.getElementById('username').value = "";
                    document.getElementById('userpass').value = ""; 
                   // errorloginmsg
                   if(data.language == 'en')
                   {
                    document.getElementById('errorloginmsg').innerHTML = "LoginID or Password is incorrect";
                   }
                   else
                   {
                    document.getElementById('errorloginmsg').innerHTML = "ログインIDまたはパスワードが違います。";
                   }
                    
                    document.getElementById('errorloginmsg').style.color="red";
                    document.getElementById('errorloginmsg').style.width="100%";
                    document.getElementById('errorloginmsg').style.fontSize ="11px";
                    document.getElementById('errorloginmsg').style.border="1px solid red";
                    document.getElementById('errorloginmsg').style.margin="10px 0 0 0";
                    document.getElementById('errorloginmsg').style.padding="2px 0 0 5px";
                    document.getElementById('errorloginmsg').style.display="block";

                    //alert('UserID or Password is incorrect');
                  }
                  else 
                  {
                    document.getElementById('login').style.display="block";
                    document.getElementById('bidder_section').style.display="none";
                   // alert('UserID or Password is incorrect');
                    location.reload();
                  }
                  

                }
    
            })
    }     

  }
  
  function check_bidderloginstatus()
  {
    
    $.ajax({
                type:'GET',
                url: '/auction/check_bidder_login',
                data: {
                      "_token": "{{ csrf_token() }}",
                      
                  },
                dataType:'json',
                success:function(data)
                {      //alert('check_bidderloginstatus'); //alert(data.loginstatus); 
                  if(data.loginstatus ==1)
                  {
                    document.getElementById('login').style.display="none";
                    document.getElementById('bidder_section').style.display="block";

                  }
                  else if(data.loginstatus ==2)
                  {
                    document.getElementById('login').style.display="none";
                    document.getElementById('login_from_product_show').style.display="none";
                    document.getElementById('bidder_section').style.display="block";

                    for(var i=0;i<30;i++)
                    {
                      document.getElementsByClassName('biddingstatusdiv')[i].style.display="none";
                      document.getElementsByClassName('biddiv')[i].style.display="none"; 
                    }
                    location.reload();

                  }
                  else if(data.loginstatus == '-1')
                  {
                    document.getElementById('login').style.display="none";
                    document.getElementById('login_from_product_show').style.display="none";
                    document.getElementById('bidder_section').style.display="block";

                    for(var i=0;i<30;i++)
                    {
                      document.getElementsByClassName('biddingstatusdiv')[i].style.display="none";
                      document.getElementsByClassName('biddiv')[i].style.display="none"; 
                    }
                    location.reload();
                  }
                  else if(data.loginstatus ==0)
                  {
                    document.getElementById('login').style.display="block";
                    document.getElementById('bidder_section').style.display="none";
                    for(var i=0;i<30;i++)
                    {
                      document.getElementsByClassName('biddingstatusdiv')[i].style.display="none";
                      document.getElementsByClassName('biddiv')[i].style.display="none";
                      
                    }
                    
                  }

                  

                }
            })
  }
  
  function bidderLoginout()
  {
    $.ajax({
                type:'GET',
                url: '/auction/bidder_logout',
                data: {
                      "_token": "{{ csrf_token() }}",
                      
                  },
                dataType:'json',
                success:function(data){  //alert(data.loginstatus);
                  if(data.loginstatus ==1)
                  {
                    location.reload(); 
                    document.getElementById('login').style.display="none";
                    document.getElementById('login_from_product_show').style.display="none";
                    document.getElementById('bidder_section').style.display="block";
                  }
                  else if(data.loginstatus ==2 || data.loginstatus == '-1')
                  {
                    location.reload(); 
                    document.getElementById('login').style.display="none";
                    document.getElementById('login_from_product_show').style.display="none";
                    document.getElementById('bidder_section').style.display="block";
                  }
                  else if(data.loginstatus ==0)
                  {
                    location.reload(); 
                    document.getElementById('login').style.display="block";
                    document.getElementById('bidder_section').style.display="none";
                  }

                }
            })
  }

  ///////////

  function bidderLogin_from_product_show()
  {
    var username = document.getElementById('username').value;
    var userpass = document.getElementById('userpass').value;
    if(username !="" && userpass !="")
    {
      //alert(username);
      $.ajax({
                type:'GET',
                url: '/auction/bidderLogin_from_product_show',
                data: {
                      "_token": "{{ csrf_token() }}",
                      "username":username,
                      "password":userpass,
                  },
                dataType:'json',
                success:function(data)
                {  
                  if(data.loginstatus ==1)
                  {
                    location.reload();
                    //document.getElementById('login').style.display="none";
                    document.getElementById('login_from_product_show').style.display="none";
                    document.getElementById('bidderdiv').style.display="block";
                    //document.getElementById('bidbtn').style.display="block";
                    //document.getElementById('logout_from_product_show').style.display="block";
                  }
                  else if(data.loginstatus ==0){
                    alert('LoginID or Password is invalid');
                  }
                  else 
                  {
                    location.reload();
                    document.getElementById('login_from_product_show').style.display="block";
                    document.getElementById('bidderdiv').style.display="none";
                    //document.getElementById('bidbtn').style.display="none";
                    //document.getElementById('logout_from_product_show').style.display="none";
                  }

                }
                
            })
    }
    
  
  }

  function check_bidderLogin_from_product_show()
  {
    $.ajax({
                type:'GET',
                url: '/auction/check_bidderLogin_from_product_show',
                data: {
                      "_token": "{{ csrf_token() }}",
                      
                  },
                dataType:'json',
                success:function(data){  //alert(data.loginstatus);
                  if(data.loginstatus ==1)
                  {
                    document.getElementById('login').style.display="none";
                    document.getElementById('login_from_product_show').style.display="none";
                    document.getElementById('bidderdiv').style.display="block";
                    document.getElementById('bidbtn').style.display="block";
                    document.getElementById('logout_from_product_show').style.display="block";
                    //location.reload();
                  }
                  
                  else if(data.loginstatus ==0)
                  {
                    document.getElementById('login_from_product_show').style.display="block";
                    document.getElementById('bidderdiv').style.display="none";
                    document.getElementById('bidbtn').style.display="none";
                    document.getElementById('logout_from_product_show').style.display="none";
                    //location.reload();
                  }

                }
            })
  } 

  function bidderLogout_from_product_show()
  { 
    $.ajax({
                type:'GET',
                url: '/auction/bidderLogout_from_product_show',
                data: {
                      "_token": "{{ csrf_token() }}",
                      
                  },
                dataType:'json',
                success:function(data){  
                  if(data.loginstatus ==1)
                  {
                    location.reload();
                    document.getElementById('login_from_product_show').style.display="none";
                    document.getElementById('bidderdiv').style.display="block";
                    document.getElementById('bidbtn').style.display="block";
                    document.getElementById('logout_from_product_show').style.display="block";
                    
                    //document.getElementById('bidsingle').style.display="block";
                    //document.getElementById('logoutsingle').style.display="block";
                  }
                  
                  else if(data.loginstatus ==0)
                  {
                    location.reload();
                    document.getElementById('login_from_product_show').style.display="block";
                    document.getElementById('bidderdiv').style.display="none";
                    document.getElementById('bidbtn').style.display="none";
                    document.getElementById('logout_from_product_show').style.display="none";
                    //document.getElementById('bidsingle').style.display="none";
                    //document.getElementById('logoutsingle').style.display="none";
                  }

                }
            })
  } 

  function time_check(id)
  {
    reload(id); 
    $.ajax({
                type:'GET',
                url: '/auction/time_check',
                data: {
                      "_token": "{{ csrf_token() }}",
                      "product_id":id,
                  },
                dataType:'json',
                success:function(data)
                {                  
                  if(data.result == 'sold' || data.result == 'auction close')
                  {
                    location.reload();
                  }
                }
            })
  }


  function auction_time_check()
  {
    reload_page();
    $.ajax({
                type:'GET',
                url: '/auction/auction_time_check',
                data: {
                      "_token": "{{ csrf_token() }}",
                  },
                dataType:'json',
                success:function(data)
                {      //alert(data.result);                 
                  location.reload();
                }
            })
  }

  function bidforthis(id)
  {
    var bidcurrentprice = parseInt(document.getElementById('bidcurrentprice'+id).value); //alert(bidcurrentprice);
    $.ajax({
                type:'POST',
                url: '/auction/bidforthis',
                data: {
                      "_token": "{{ csrf_token() }}",
                      "product_id":id,
                      "bidcurrentprice":bidcurrentprice,
                  },
                dataType:'json',
                success:function(data){  
                  alert(data.bidtype);

                }
            })
  }

  ///bidForSubmit
  function bidForSubmit(id)
  {
    //alert(product_id);
    var bidcurrentprice = parseInt(document.getElementById('bidcurrentprice'+id).value); alert(bidcurrentprice);
  }

  //Auction product selection
  function addToWatchlist(id)
  {
    //alert(id);
    $.ajax({
                type:'POST',
                url: '/auction/addToWatchlist',
                data: {
                      "_token": "{{ csrf_token() }}",
                      "product_id":id,
                  },
                dataType:'json',
                success:function(data){  
                  
                  //alert(data.selection_status);
                  location.reload();

                }
            })
  }
  function removeFromWatchlist(id)
  {
    $.ajax({
                type:'POST',
                url: '/auction/removeFromWatchlist',
                data: {
                      "_token": "{{ csrf_token() }}",
                      "product_id":id,
                  },
                dataType:'json',
                success:function(data){  
                  
                  //alert(data.selection_status);
                  location.reload();

                }
            })
  }
  
  function reload_page()
  {
    location.reload();
    generally_time_check();
  }

  function generally_time_check()
  {
    ///auction/generally_time_check
    $.ajax({
                type:'GET',
                url: '/auction/generally_time_check',
                data: {
                      "_token": "{{ csrf_token() }}",
                  },
                dataType:'json',
                success:function(data){  
                  
                  //alert(data.selection_status);
                  location.reload();

                }
            })

  }

  $( document ).ready(function() {
    check_bidderloginstatus();
    check_bidderLogin_from_product_show();

    function CheckSession() {
            var session = '<%=Session["logger_id"] != null%>';
            if (session == false) {
                alert("Your Session has expired");
                //window.location = "login.aspx";
                location.reload();
            }
        }

  setInterval(CheckSession(),500);
  

        //reload time every 1 second

        //reload or refresh page  start
      let time = new Date().getTime();
    const setActivityTime = (e) => {
      time = new Date().getTime();
    }
    document.body.addEventListener("mousemove", setActivityTime);
    document.body.addEventListener("keypress", setActivityTime);

    const refresh = () => {
      if (new Date().getTime() - time >= 60000) {
        //window.location.reload(true);
        //location.reload();
        reload_page();

      } else {
        setTimeout(refresh, 10000);
      }
    }

    setTimeout(refresh, 10000);
    //reload or refresh page  end
  

   });
  </script>

<script>
  function productownerlogin()
  {
    
  }

</script>

<script type="text/javascript">
  (function(){
  $('.from-prevent-multiple-submits').on('submit', function(){
      $('.from-prevent-multiple-submits').attr('disabled','true');
  })
  })();
  </script>





<style>
.form-input {
    color: #1c1b1b;
}
</style>  

{{-- Design Changer --}}



</body>
</html>