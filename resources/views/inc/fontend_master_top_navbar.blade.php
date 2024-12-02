<div class="rd-navbar-wrap">
    <nav class="rd-navbar rd-navbar-creative" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-sm-device-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fullwidth" data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-fullwidth" data-lg-layout="rd-navbar-fullwidth" data-stick-up-clone="false" data-md-stick-up-offset="150px" data-lg-stick-up-offset="60px" data-md-stick-up="true" data-lg-stick-up="true">
      <div class="rd-navbar-aside-outer rd-navbar-content-outer">
        <div class="rd-navbar-content__toggle rd-navbar-fullwidth--hidden" data-rd-navbar-toggle=".rd-navbar-content"><span></span></div>
        <div class="rd-navbar-aside rd-navbar-content">
          <div class="rd-navbar-aside__item">
            <ul class="rd-navbar-items-list">
              


               <!--===== Language =======---> 
              <li>
                <div class="unit unit-spacing-xxs unit-horizontal">
                  
                  <div class="unit__body">
                    <p>
                      Language<?php if(session()->get('language')=='jp'){?>(言語)<?php }?>:
                      <?php  
                        if(session()->get('language')=='en')
                        {
                      ?>
                      <a href="javascript:" onclick="change_language('jp')">Japanese</a>
                      <?php     
                        }
                        else {
                       ?>
                       <a href="javascript:" onclick="change_language('en')">English</a> 
                       <?php    
                        }
                      ?> 
                    </p>
                  </div>
                </div>
              </li>


            </ul>
          </div>
          <div class="rd-navbar-aside__item">
            <ul class="rd-navbar-items-list">
              <?php 
              $bidder_id = Session::get('logger_id');
              $biddername_en = "";
              $biddername_jp = "";

              if($bidder_id !="")
              {
                if($bidder_id != '-1')
                {
                  $Bidder = App\Models\Bidder_register::findOrFail($bidder_id); 
                
                  $biddername_en = $Bidder->name_en;
                  $biddername_jp = $Bidder->name_jp;
                }
                else 
                {
                  $biddername_en = 'Admin Controller';
                  $biddername_jp = 'Admin Controller';
                }
                
              }
               

                if(session()->get('language')=='en')
                {
                  if($biddername_en !="")
                  {
              ?>
              <li>
                <div class="unit unit-spacing-xxs unit-horizontal">
                  <div class="unit__left"><span class="text-primary">Logger:</span></div>
                  <div class="unit__body"><a href="javascript:">{{$biddername_en}}</a></div>
                </div>
              </li>
              <?php 
                  }
              ?>
              <li>
                <div class="unit unit-spacing-xxs unit-horizontal">
                  <div class="unit__left"><span class="text-primary">Phone:</span></div>
                  <div class="unit__body"><a href="callto:#">+81-(0)3-5700-4622</a></div>
                </div>
              </li>
              <?php     
                }
                else {
                  if($biddername_jp !="")
                  {
                ?>
                <li>
                  <div class="unit unit-spacing-xxs unit-horizontal">
                    <div class="unit__left"><span class="text-primary">ロガー:</span></div>
                    <div class="unit__body"><a href="javascript:">{{$biddername_jp}}</a></div>
                  </div>
                </li>
                <?php 
                  }
                ?>
                <li>
                  <div class="unit unit-spacing-xxs unit-horizontal">
                    <div class="unit__left"><span class="text-primary">電話:</span></div>
                    <div class="unit__body"><a href="callto:#">+81-(0)3-5700-4622</a></div>
                  </div>
                </li>
                <?php    
                }
                ?> 
            </ul>
          </div>
        </div>
      </div>
      <div class="rd-navbar-main-outer" style="border-bottom: 1px solid #E6E6E6;">
        <div class="rd-navbar-main">
          <!-- RD Navbar Panel -->
          <div class="rd-navbar-panel">
            <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
            <!-- RD Navbar Brand-->
            <div class="rd-navbar-brand" style="width: 250px;">
              <a class="brand" href="{{url('/')}}">
                <div class="brand__name">
                  <img src="{{ asset('fontend') }}/images/woody-logo.png" alt="" width="123" height="47"/>
                  
                </div>
              </a>
            </div>
          </div>
          <!-- RD Navbar Nav -->
          <div class="rd-navbar-nav-wrap" >
            
            <!-- RD Navbar Nav-->
            <?php  
              if(session()->get('language')=='en')
              {
            ?>

           
            <ul class="rd-navbar-nav">
              <li><a href="{{url('/')}}">Top Page</a></li>
              <li><a href="{{route('woody.auction')}}">Woody Auction</a></li>
              <li><a href="{{route('woody.search_site')}}">Woody Search Site</a></li>
              {{-- <li><a href="{{route('woody.guidebook')}}">Woody Guidebook</a></li> --}}
              {{-- <li><a href="{{route('woody.support')}}">Support</a></li> --}}
              <li><a href="{{url('fontend/images/document/smartphone.pdf#zoom=100')}}">Support</a></li>

              <li style="float: right;"><a href="{{route('member.loginform')}}">Member</a></li>
      
            </ul>
            <?php     

            }
            else {
            ?>

            
            <ul class="rd-navbar-nav">
              <li><a href="{{url('/')}}">トップページ</a></li>
              <li><a href="{{route('woody.auction')}}">ウッディーオークション</a></li>
              <li><a href="{{route('woody.search_site')}}">ウッディー検索サイト</a></li>
              {{-- <li><a href="{{route('woody.guidebook')}}">ウッディガイドブック</a></li> --}}
              {{-- <li><a href="{{route('woody.support')}}">サポート</a></li> --}}
              <li><a href="{{url('fontend/images/document/smartphone.pdf#zoom=100')}}" >サポート</a></li>

              <li style="float: right;"><a href="{{route('member.loginform')}}" >メンバー</a></li>
      
            </ul>
          <?php   
            }
          ?> 
          </div>
        </div>
      </div>
    </nav>
  </div>

  <script>
    function change_language(lan)
    {
      $.ajax({
            type:'GET',
            url: '/change_language/'+lan,
            dataType:'json',
            success:function(response){
              location.reload();
            }
        })
    }
  </script>

