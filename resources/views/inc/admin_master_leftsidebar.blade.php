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
      color: rgb(4 255 0);
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
    $products = App\Models\Product::latest()->where('final_result','unsold')->where('whoadd',1)->get();
    $waitingforapproveproductlist = 0;
    $waitingforauctionproductlist = 0;
?>
@foreach($products as $b)
<?php 
    if($b->state == 1){$waitingforapproveproductlist++;}
    if($b->state == 2){$waitingforauctionproductlist++;}
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
                        href="{{ route('home') }}" aria-expanded="false">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                            <span class="hide-menu">Dashboard</span>
                    </a>
                </li>


                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="nav-icon fas fa-edit"></i>
                        <span class="hide-menu">Category </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('category.add_form') }}" class="sidebar-link">
                                <i class="mdi mdi-note-outline"></i>
                                <span class="hide-menu"> Add Category</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('category.view') }}" class="sidebar-link">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu"> View Category
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="nav-icon fas fa-edit"></i>
                        <span class="hide-menu">Brand </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('brand.add_form') }}" class="sidebar-link">
                                <i class="mdi mdi-note-outline"></i>
                                <span class="hide-menu"> Add Brand</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('brand.view') }}" class="sidebar-link">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu"> View Brand
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="nav-icon fas fa-edit"></i>
                        <span class="hide-menu">Delivery Place </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('deliveryplace.add_form') }}" class="sidebar-link">
                                <i class="mdi mdi-note-outline"></i>
                                <span class="hide-menu"> Add Delivery Place</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('deliveryplace.view') }}" class="sidebar-link">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu"> View Delivery Place
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

            <?php 
               $product_owner_request = App\Models\Product_woner_request::latest()->get(); 
               $countownerrequest = $product_owner_request->count();    
            ?>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="nav-icon fas fa-edit"></i>
                        <span class="hide-menu">Product Owner </span>
                        {{-- <span class="mailrequest">{{$countownerrequest}}</span> --}}
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        {{-- <li class="sidebar-item">
                            <a href="{{ route('owner.add_form') }}" class="sidebar-link">
                                <i class="mdi mdi-note-outline"></i>
                                <span class="hide-menu"> Add Owner</span>
                            </a>
                        </li> --}}
                        <li class="sidebar-item">
                            <a href="{{ route('owner.view') }}" class="sidebar-link">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu"> View Owner
                                </span>
                            </a>
                        </li>
                        {{-- <li class="sidebar-item">
                            <a href="{{ route('productowner.requestview') }}" class="sidebar-link">
                                <i class="nav-icon far fa-envelope"></i>
                                <span class="hide-menu"> View New Request List</span>
                                <span class="mailbox">{{$countownerrequest}}</span>
                            </a>
                        </li> --}}
                    </ul>
                </li>

                

                <li class="sidebar-item"> 
                    <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false">
                    <i class="nav-icon fas fa-edit"></i>
                    <span
                        class="hide-menu">
                        <?php 
                        $memberrequest =0;
                        if($waitingforapproveproductlist != 0 || $waitingforauctionproductlist !=0){$memberrequest=1;}
                        if($memberrequest !=0)
                        {
                        ?>
                        <span class="blink">Member Request</span>
                        <?php
                        }
                        else 
                        {
                        ?>
                        Member Request
                        <?php 
                        }
                        ?>
                    </span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item">
                        <a href="{{ route('product.view_productlist_waiting_for_approve') }}" class="sidebar-link">
                            <i class="mdi mdi-receipt"></i>
                            <span class="hide-menu"> 
                                Waiting For Approve <span>{{$waitingforapproveproductlist !=0? '('.$waitingforapproveproductlist.')' : ''}}</span>
                            </span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('product.view_unsold') }}" class="sidebar-link">
                            <i class="mdi mdi-receipt"></i>
                            <span class="hide-menu"> 
                                <span class="hide-menu"> Waiting For Auction <span>{{$waitingforauctionproductlist !=0? '('.$waitingforauctionproductlist.')' : ''}}</span>
                            </span>
                        </a>
                    </li>
                    
                    
                </ul>
            </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                        href="javascript:void(0)" aria-expanded="false">
                        <i class="nav-icon fas fa-edit"></i>
                        <span
                            class="hide-menu">Product </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('product.add_form') }}" class="sidebar-link">
                                <i class="mdi mdi-note-outline"></i>
                                <span class="hide-menu"> Add Product</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('product.view_unsold') }}" class="sidebar-link">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu"> View Unsold Products 
                                </span>
                            </a>
                        </li>
                        
                        
                    </ul>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false">
                    <i class="nav-icon fas fa-edit"></i>
                    <span
                        class="hide-menu">Auction Name </span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item">
                        <a href="{{ route('auctionname.addform') }}" class="sidebar-link">
                            <i class="mdi mdi-note-plus"></i>
                            <span class="hide-menu"> Add Auction Name
                            </span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('auctionname.view') }}" class="sidebar-link">
                            <i class="mdi mdi-receipt"></i>
                            <span class="hide-menu"> View Auction Name
                            </span>
                        </a>
                    </li>
                    
                </ul>
            </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false">
                    <i class="nav-icon fas fa-edit"></i>
                    <span
                        class="hide-menu">Auction Product</span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item">
                        <a href="{{ route('auction.view') }}" class="sidebar-link">
                            <i class="mdi mdi-note-plus"></i>
                            <span class="hide-menu"> Current Auction
                            </span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('auction.monitoring') }}" class="sidebar-link">
                            <i class="mdi mdi-note-plus"></i>
                            <span class="hide-menu"> Auction Monitoring
                            </span>
                        </a>
                    </li>
                    {{-- <li class="sidebar-item">
                        <a href="{{ route('auction.auction_result_show') }}" class="sidebar-link">
                            <i class="mdi mdi-note-plus"></i>
                            <span class="hide-menu"> Auction Result Show
                            </span>
                        </a>
                    </li> --}}
                    
                </ul>
            </li>

            <?php 
               $bidder_request = App\Models\Bidder_request::latest()->get(); 
               $count = $bidder_request->count();    
            ?>
                <li class="sidebar-item">
                    
                    <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false">
                    <i class="nav-icon fas fa-edit"></i>
                    <span
                        class="hide-menu">
                        <?php 
                        
                        
                        if($count !=0)
                        {
                        ?>
                        <span class="blink">Member Registration</span>
                        <span class="mailrequest">{{$count}}</span>
                        <?php
                        }
                        else 
                        {
                        ?>
                        Member Registration
                        <?php 
                        }
                        ?>
                    </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('bidder.add_form') }}" class="sidebar-link">
                                <i class="mdi mdi-note-outline"></i>
                                <span class="hide-menu"> Add Member</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('bidder.view') }}" class="sidebar-link">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu"> View Member List
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('bidder.requestview') }}" class="sidebar-link">
                                <i class="nav-icon far fa-envelope"></i>
                                <span class="hide-menu"> View New Request List</span>
                                <span class="mailbox">{{$count}}</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('bidder.view_blacklisted') }}" class="sidebar-link">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu"> View Black List</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="nav-icon fas fa-edit"></i>
                        <span class="hide-menu">Notice </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('notice.add_form') }}" class="sidebar-link">
                                <i class="mdi mdi-note-outline"></i>
                                <span class="hide-menu"> Add Notice</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('notice.view') }}" class="sidebar-link">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu"> View Notice
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="nav-icon fas fa-copy"></i>
                        <span class="hide-menu">Invoice </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('invoice.search') }}" class="sidebar-link">
                                <i class="mdi mdi-note-plus"></i>
                                <span class="hide-menu"> Invoice Search
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('customer.searchpage') }}" class="sidebar-link">
                                <i class="mdi mdi-note-plus"></i>
                                <span class="hide-menu"> Customer Invoice
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('owner.searchpage') }}" class="sidebar-link">
                                <i class="mdi mdi-note-plus"></i>
                                <span class="hide-menu"> Owner Invoice
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <span class="hide-menu">History </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('auction.view_auction_history') }}" class="sidebar-link">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu"> view_auction_history
                                </span>
                            </a>
                        </li>
                        {{-- <li class="sidebar-item">
                            <a href="{{ route('product.view_sold') }}" class="sidebar-link">
                                <i class="mdi mdi-receipt"></i>
                                <span class="hide-menu"> View Sold Products
                                </span>
                            </a>
                        </li> --}}
                        {{-- <li class="sidebar-item">
                            <a href="{{ route('auction.view_old') }}" class="sidebar-link">
                                <i class="mdi mdi-note-plus"></i>
                                <span class="hide-menu"> Old Auction
                                </span>
                            </a>
                        </li> --}}
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="mdi mdi-receipt"></i>
                        <span class="hide-menu">Others </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="javascript:" onclick="memory_clear()" class="sidebar-link">
                                <i class="mdi mdi-note-plus"></i>
                                <span class="hide-menu"> Memory Clear
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('auction.themepreference') }}"  class="sidebar-link">
                                <i class="mdi mdi-note-plus"></i>
                                <span class="hide-menu">Theme Preference</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('db.backupDatabase') }}"  class="sidebar-link">
                                <i class="mdi mdi-note-plus"></i>
                                <span class="hide-menu"> DB Backup
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{url('backend/Woody_Auction_Working_Manual.pdf#zoom=100')}}" target="_blank" class="sidebar-link">
                                <i class="mdi mdi-note-plus"></i>
                                <span class="hide-menu">Working Manual</span>
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