<style>
    .mailbox{
        margin-left: 20px;
        color: red;
        background: #fff;
        width: 35px;
        text-align: center;
    }
    .mailrequest{
        margin-left: 20px;
        color: red;
    }
</style>
<style>
    .blink {
      animation: blink-animation 1s steps(5, start) infinite;
      -webkit-animation: blink-animation 1s steps(5, start) infinite;
      color: rgb(250, 4, 4);
    }
    @keyframes blink-animation {
      to {
        visibility: hidden;
      }
    }
    @-webkit-keyframes blink-animation {
      to {
        visibility: hidden;
      }
    }
</style>

<?php 
    $memberid = Session::get('loggermemberid') ;
    $productlistforcount = App\Models\Product::latest()->get();
    $newaddedproductlist = 0;
    $waitingforapproveproductlist = 0;
    $waitingforauctionproductlist = 0;
    $currentauctionproductlist = 0;
    $soldproductlist = 0;
    $waitingforcorrectionproductlist = 0;
    $outofauctionproductlist = 0;
?>
@foreach($productlistforcount as $b)
<?php 
    if($b->state == 0 && $b->final_result == 'unsold' && $b->whoadd == 1 && $b->woner_id == $memberid){$newaddedproductlist++;}
    if($b->state == 1 && $b->final_result == 'unsold' && $b->whoadd == 1 && $b->woner_id == $memberid){$waitingforapproveproductlist++;}
    if($b->state == 2 && $b->final_result == 'unsold' && $b->whoadd == 1 && $b->woner_id == $memberid){$waitingforauctionproductlist++;}
    if($b->state == 3 && $b->final_result == 'unsold' && $b->woner_id == $memberid){$currentauctionproductlist++;}
    if($b->state == 3 && $b->final_result == 'sold'   && $b->woner_id == $memberid){$soldproductlist++;}
    if($b->state == 4 && $b->final_result == 'unsold' && $b->whoadd == 1 && $b->woner_id == $memberid){$waitingforcorrectionproductlist++;}
    if($b->state == 5 && $b->final_result == 'unsold' && $b->woner_id == $memberid){$outofauctionproductlist++;}
?>
@endforeach

<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">

                <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('member_dashboard') }}" aria-expanded="false">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                            <span class="hide-menu">Dashboard</span>
                    </a>
                </li>



                <li class="sidebar-item"> <a class="sidebar-link  waves-effect waves-dark active"
                        href="javascript:void(0)" aria-expanded="false">
                        <i class="nav-icon fas fa-book"></i>
                        <span
                            class="hide-menu">Product </span></a>
                    <ul aria-expanded="false" class="  first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('member.product.add_form') }}" class="sidebar-link">
                                <i class="mdi mdi-note-outline"></i>
                                <span class="hide-menu"> Add Product</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('member.product.view_newlyadded_productlist') }}" class="sidebar-link">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu"> View Products <span>{{$newaddedproductlist !=0? '('.$newaddedproductlist.')' : ''}}</span>
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('member.product.view_productlist_waiting_for_correction') }}" class="sidebar-link">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu"> 
                                     
                                    <span
                                    class="hide-menu">
                                    <?php 
                                    $correction =0;
                                    if($waitingforcorrectionproductlist != 0 ){$correction=1;}
                                    if($correction !=0)
                                    {
                                    ?>
                                    <span class="blink">Waiting For Correction</span>
                                    <?php
                                    }
                                    else 
                                    {
                                    ?>
                                    Waiting For Correction
                                    <?php 
                                    }
                                    ?>
                                </span>
                                    <span>{{$waitingforcorrectionproductlist !=0? '('.$waitingforcorrectionproductlist.')' : ''}}</span>
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('member.product.view_productlist_waiting_for_approve') }}" class="sidebar-link">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu"> Waiting For Approve <span>{{$waitingforapproveproductlist !=0? '('.$waitingforapproveproductlist.')' : ''}}</span>
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('member.product.view_productlist_waiting_for_auction') }}" class="sidebar-link">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu"> Waiting For Auction <span>{{$waitingforauctionproductlist !=0? '('.$waitingforauctionproductlist.')' : ''}}</span>
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('member.product.view_productlist_current_auction') }}" class="sidebar-link">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu"> Current Auction <span>{{$currentauctionproductlist !=0? '('.$currentauctionproductlist.')' : ''}}</span>
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('member.product.view_productlist_out_of_auction') }}" class="sidebar-link">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu"> Out of Auction <span>{{$outofauctionproductlist !=0? '('.$outofauctionproductlist.')' : ''}}</span>
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('member.product.view_auction_sold__product_list') }}" class="sidebar-link">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu"> 
                                    Sold List 
                                    <span>{{$soldproductlist !=0? '('.$soldproductlist.')' : ''}}</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

                




            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>