<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Delivery_place;
use App\Models\Bidder_register; 
use App\Models\Product_woner;  
use App\Models\Product_multiple_image;   
use App\Models\Product_video;   
use App\Models\AuctionHistory;  
use App\Models\Auction;
use App\Models\Themepreference;
use App\Models\Skauction_histories; 
use App\Models\Visitor;
use App\Models\User;
use App\Models\Notice;
use App\Models\Category;
use App\Models\Bidder_request;
use App\Models\Product_woner_request;
use Illuminate\Support\Facades\Mail;
use App\Mail\auctionBidLossMail;
use App\Mail\auctionBidMail;
use App\Mail\auctionBidOwnMail;
use App\Mail\forgetpass;
use App\Mail\registrationSuccessMail;
use App\Mail\ownerRegistrationSuccessMail;
use ZipArchive;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function __construct()
    {
        //base url
        $base_url = URL::to('/'); 
        Session::put('base_url',$base_url) ;
        //$base_url = Session::get('base_url');

        //language
        if (Session::has('language')) 
        {
            $language = "";
            $language = Session::get('language');
            if($language =="")
            {
                $language = "en";
                Session::put('language',$language) ;
            }
        }
        ///////////////////////////////////////////
        

    }
    public function change_language($lan)
    {
        $pageurl ="";
        if($lan =="en")
        {
            Session::put('language','en') ; 
        }
        else if($lan =="jp"){
            Session::put('language','jp') ;
        }
        //return response()->json('changed');
        return response()->json($lan);
    }
    
    public function get_pageurl($en_url,$jp_url)
    {
        $pageurl ="";
        $language = "";
        $language = Session::get('language'); 
        if($language =="" || $language =="en")
        {
            $language = "en";
            Session::put('language',$language) ; 
            $pageurl  = $en_url;
        }
        else if($language =="jp"){
            $language = "jp";
            Session::put('language',$language) ;
            $pageurl  = $jp_url;
        }

        return $pageurl ;
    }

    public function set_visitor()
    {
        $visitor_ip = $_SERVER['REMOTE_ADDR'];
        $visitorslist = Visitor::all();
        $previous_visitor = 0;
        if(count($visitorslist)>0)
        {
            for($i=0;$i<count($visitorslist);$i++)
            {
                if($visitor_ip == $visitorslist[$i]->visitor_ip)
                {
                    $previous_visitor = 1;
                    //if exist, time update
                    if(date("Y-m-d") != $visitorslist[$i]->updated_at)
                    {
                        Visitor::find($visitorslist[$i]->id)->update([
                            'updated_at'=> Carbon::now(),
                        ]);
                    }
                    
                }
                else{
                    $previous_visitor = 0;
                }
            }
        }
        //if not exist, new insert
        if($previous_visitor == 0)
        {
            Visitor::insert([
                'visitor_ip'=> $_SERVER['REMOTE_ADDR'],
                'visit_date'=> Carbon::now(),
                'total_visit'=> 1,
                'created_at'=> Carbon::now(),
            ]);
        }
        //$visitorslist = Visitor::all();
        //return $visitorslist;
        
    }

    public function index()
    {
        $this->set_visitor();

        $page =$this->get_pageurl('fontend.en.welcome','fontend.jp.welcome');   //dd('paisi');
        $pagelanguage = $this->get_pagelanguage(); //dd($pagelanguage);
        $notice = Notice::where('status',1)->get(); 
        
        return view($page,compact('notice','pagelanguage'));
    }

    public function auction_page()
    {
        $theme = Themepreference::where('selectedtheme','!=',"")->get();  
        $selectedtheme =1;
        $page ="";
        if(count($theme)>0)
        {
            $selectedtheme = $theme[0]->selectedtheme;
        }
        if($selectedtheme == 1)
        {
            $page =$this->get_pageurl('fontend.en.auction_product','fontend.jp.auction_product');  
        }
        else if($selectedtheme == 2)
        {
            $page =$this->get_pageurl('fontend.en.auction_product_backup','fontend.jp.auction_product_backup'); 
        }
        return $page;
    }
    public function auction()
    {  
        //
        //$actionpro = Product::where('id',2)->get();   dd($actionpro[0]['product_no']);
        //
        //$loginstatus =  Session::get('loggercodeno'); dd($loginstatus);
        ////////////////////////////////
        $page = $this->auction_page(); 
        
        $auction =  Auction::where('status',1)->get();
        $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->paginate(30); 
        $deliveryplaces = Delivery_place::latest()->get(); 
        $pagelanguage = $this->get_pagelanguage(); //dd($pagelanguage);
        $selectedmenu = "0"; //0 all, 1 new today, 2 end soon
        
        
        return view($page,compact('auctionproducts','pagelanguage','deliveryplaces','selectedmenu'));
    }
    //auctionno_asc
    public function auctionno_asc($selectedmenu)
    {  
        //$page =$this->get_pageurl('fontend.en.auction_product','fontend.jp.auction_product');
        $page = $this->auction_page();

        $auction =  Auction::where('status',1)->get();
        Session::put('sort', 1);
        if($selectedmenu == 1)
        {
            $today = date('m/d/Y', strtotime(Carbon::now())); 
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->where('start_time_of_auction','like','%' .$today. '%')->orderBy('product_no','ASC')->paginate(30); 
        }
        else if($selectedmenu == 2)
        {
            $today = date('m/d/Y', strtotime(Carbon::now())); 
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->where('end_time_of_auction','like','%' .$today. '%')->orderBy('product_no','ASC')->paginate(30); 
        }
        else
        {
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->orderBy('product_no','ASC')->paginate(30); 
        }
        $deliveryplaces = Delivery_place::latest()->get(); 
        $pagelanguage = $this->get_pagelanguage(); //dd($pagelanguage);
        //$selectedmenu = "0"; //0 all, 1 new today, 2 end soon
        
        return view($page,compact('auctionproducts','pagelanguage','deliveryplaces','selectedmenu'));
    }
    //auctionno_desc
    public function auctionno_desc($selectedmenu)
    {  
        //$page =$this->get_pageurl('fontend.en.auction_product','fontend.jp.auction_product');
        $page = $this->auction_page();

        $auction =  Auction::where('status',1)->get();
        Session::put('sort', 2);
        if($selectedmenu == 1)
        {
            $today = date('m/d/Y', strtotime(Carbon::now())); 
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->where('start_time_of_auction','like','%' .$today. '%')->orderBy('product_no','DESC')->paginate(30); 
        }
        else if($selectedmenu == 2)
        {
            $today = date('m/d/Y', strtotime(Carbon::now())); 
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->where('end_time_of_auction','like','%' .$today. '%')->orderBy('product_no','DESC')->paginate(30); 
        }
        else
        {
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->orderBy('product_no','DESC')->paginate(30); 
        }
        $deliveryplaces = Delivery_place::latest()->get(); 
        $pagelanguage = $this->get_pagelanguage(); //dd($pagelanguage);
        //$selectedmenu = "0"; //0 all, 1 new today, 2 end soon
        
        return view($page,compact('auctionproducts','pagelanguage','deliveryplaces','selectedmenu'));
    }
    //maker_asc
    public function maker_asc($selectedmenu)
    {  
       // $page =$this->get_pageurl('fontend.en.auction_product','fontend.jp.auction_product');
       $page = $this->auction_page();

        $auction =  Auction::where('status',1)->get();
        Session::put('sort', 3);
        if($selectedmenu == 1)
        {
            $today = date('m/d/Y', strtotime(Carbon::now())); 
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->where('start_time_of_auction','like','%' .$today. '%')->orderBy('brand_name_en','asc')->paginate(30); 
        }
        else if($selectedmenu == 2)
        {
            $today = date('m/d/Y', strtotime(Carbon::now())); 
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->where('end_time_of_auction','like','%' .$today. '%')->orderBy('brand_name_en','asc')->paginate(30); 
        }
        else
        {
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->orderBy('brand_name_en','asc')->paginate(30); 
        }
        $deliveryplaces = Delivery_place::latest()->get(); 
        $pagelanguage = $this->get_pagelanguage(); //dd($pagelanguage);
        //$selectedmenu = "0"; //0 all, 1 new today, 2 end soon
        
        return view($page,compact('auctionproducts','pagelanguage','deliveryplaces','selectedmenu'));
    }
    //maker_desc
    public function maker_desc($selectedmenu)
    {  
        //$page =$this->get_pageurl('fontend.en.auction_product','fontend.jp.auction_product');
        $page = $this->auction_page();

        $auction =  Auction::where('status',1)->get();
        Session::put('sort', 4);
        if($selectedmenu == 1)
        {
            $today = date('m/d/Y', strtotime(Carbon::now())); 
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->where('start_time_of_auction','like','%' .$today. '%')->orderBy('brand_name_en','desc')->paginate(30); 
        }
        else if($selectedmenu == 2)
        {
            $today = date('m/d/Y', strtotime(Carbon::now())); 
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->where('end_time_of_auction','like','%' .$today. '%')->orderBy('brand_name_en','desc')->paginate(30); 
        }
        else
        {
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->orderBy('brand_name_en','desc')->paginate(30); 
        }
        $deliveryplaces = Delivery_place::latest()->get(); 
        $pagelanguage = $this->get_pagelanguage(); //dd($pagelanguage);
        //$selectedmenu = "0"; //0 all, 1 new today, 2 end soon
        
        return view($page,compact('auctionproducts','pagelanguage','deliveryplaces','selectedmenu'));
    }
    //model_asc
    public function model_asc($selectedmenu)
    {  
        //$page =$this->get_pageurl('fontend.en.auction_product','fontend.jp.auction_product');
        $page = $this->auction_page();

        $auction =  Auction::where('status',1)->get();
        Session::put('sort', 5);
        if($selectedmenu == 1)
        {
            $today = date('m/d/Y', strtotime(Carbon::now())); 
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->where('start_time_of_auction','like','%' .$today. '%')->orderBy('model_no','ASC')->paginate(30); 
        }
        else if($selectedmenu == 2)
        {
            $today = date('m/d/Y', strtotime(Carbon::now())); 
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->where('end_time_of_auction','like','%' .$today. '%')->orderBy('model_no','ASC')->paginate(30); 
        }
        else
        {
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->orderBy('model_no','ASC')->paginate(30); 
        }
        $deliveryplaces = Delivery_place::latest()->get(); 
        $pagelanguage = $this->get_pagelanguage(); //dd($pagelanguage);
        //$selectedmenu = "0"; //0 all, 1 new today, 2 end soon
        
        return view($page,compact('auctionproducts','pagelanguage','deliveryplaces','selectedmenu'));
    }
    //model_desc
    public function model_desc($selectedmenu)
    {  
        //$page =$this->get_pageurl('fontend.en.auction_product','fontend.jp.auction_product');
        $page = $this->auction_page();

        $auction =  Auction::where('status',1)->get();
        Session::put('sort', 6);
        if($selectedmenu == 1)
        {
            $today = date('m/d/Y', strtotime(Carbon::now())); 
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->where('start_time_of_auction','like','%' .$today. '%')->orderBy('model_no','DESC')->paginate(30); 
        }
        else if($selectedmenu == 2)
        {
            $today = date('m/d/Y', strtotime(Carbon::now())); 
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->where('end_time_of_auction','like','%' .$today. '%')->orderBy('model_no','DESC')->paginate(30); 
        }
        else
        {
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->orderBy('model_no','DESC')->paginate(30); 
        }
        $deliveryplaces = Delivery_place::latest()->get(); 
        $pagelanguage = $this->get_pagelanguage(); //dd($pagelanguage);
        //$selectedmenu = "0"; //0 all, 1 new today, 2 end soon
        
        return view($page,compact('auctionproducts','pagelanguage','deliveryplaces','selectedmenu'));
    }
    //timeleft_asc
    public function timeleft_asc($selectedmenu)
    {  
        //$page =$this->get_pageurl('fontend.en.auction_product','fontend.jp.auction_product');
        $page = $this->auction_page();

        $auction =  Auction::where('status',1)->get();
        Session::put('sort', 7);
        if($selectedmenu == 1)
        {
            $today = date('m/d/Y', strtotime(Carbon::now())); 
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->where('start_time_of_auction','like','%' .$today. '%')->orderBy('auction_end','ASC')->paginate(30); 
        }
        else if($selectedmenu == 2)
        {
            $today = date('m/d/Y', strtotime(Carbon::now())); 
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->where('end_time_of_auction','like','%' .$today. '%')->orderBy('auction_end','ASC')->paginate(30); 
        }
        else
        {
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->orderBy('auction_end','ASC')->paginate(30); 
        }
        $deliveryplaces = Delivery_place::latest()->get(); 
        $pagelanguage = $this->get_pagelanguage(); //dd($pagelanguage);
        //$selectedmenu = "0"; //0 all, 1 new today, 2 end soon
        
        return view($page,compact('auctionproducts','pagelanguage','deliveryplaces','selectedmenu'));
    }
    //timeleft_desc
    public function timeleft_desc($selectedmenu)
    {  
        //$page =$this->get_pageurl('fontend.en.auction_product','fontend.jp.auction_product');
        $page = $this->auction_page();

        $auction =  Auction::where('status',1)->get();
        Session::put('sort', 8);
        if($selectedmenu == 1)
        {
            $today = date('m/d/Y', strtotime(Carbon::now())); 
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->where('start_time_of_auction','like','%' .$today. '%')->orderBy('auction_end','DESC')->paginate(30); 
        }
        else if($selectedmenu == 2)
        {
            $today = date('m/d/Y', strtotime(Carbon::now())); 
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->where('end_time_of_auction','like','%' .$today. '%')->orderBy('auction_end','DESC')->paginate(30); 
        }
        else
        {
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product',1)->where('final_result','unsold')->orderBy('auction_end','DESC')->paginate(30); 
        }
        $deliveryplaces = Delivery_place::latest()->get(); 
        $pagelanguage = $this->get_pagelanguage(); //dd($pagelanguage);
        //$selectedmenu = "0"; //0 all, 1 new today, 2 end soon
        
        return view($page,compact('auctionproducts','pagelanguage','deliveryplaces','selectedmenu'));
    }


    public function get_pagelanguage()
    {
        $language = "";
        $language = Session::get('language'); 
        if($language =="" || $language =="en")
        {
            $pagelanguage = array();
            $pagelanguage['LG_language'] = "en";
            $pagelanguage['LG_Login_ID'] = "Login ID";
            $pagelanguage['LG_Password'] = "Password";
            $pagelanguage['LG_Login'] = "Login";
            
            $pagelanguage['LG_Forgot_Your_Password'] = "Forgot Your Password";
            $pagelanguage['LG_Auction_No'] = "LOT No.";
            $pagelanguage['LG_Maker'] = "Maker";
            $pagelanguage['LG_Year'] = "Year";
            $pagelanguage['LG_Hour'] = "Hour";
            $pagelanguage['LG_Delivery_Yard'] = "Delivery Yard";
            $pagelanguage['LG_Delivery_Place'] = "Delivery Place";
            $pagelanguage['LG_Releasing_Charge'] = "Releasing Charge";
            $pagelanguage['LG_Price'] = "Price";
            $pagelanguage['LG_Model'] = "Model";
            $pagelanguage['LG_Serial'] = "Serial";
            $pagelanguage['LG_Current_Bid'] = "Current Bid";
            $pagelanguage['LG_Bidder_No'] = "Bidder No";
            $pagelanguage['LG_Bids'] = "Bid";
            $pagelanguage['LG_Bid'] = "Bid";
            $pagelanguage['LG_Time_Left'] = "Time Left";
            $pagelanguage['LG_Feature'] = "Feature";
            $pagelanguage['LG_Comment'] = "Comment";
            $pagelanguage['LG_Bidding_Status'] = "Bidding Status";
            $pagelanguage['LG_Category_List'] = "Category List";
            $pagelanguage['LG_Item_Search'] = "Item Search";
            $pagelanguage['LG_Search'] = "Search";
            $pagelanguage['LG_Choice'] = "Choice";
            $pagelanguage['LG_Sort'] = "Sort";
            $pagelanguage['LG_ALL'] = "ALL";
            $pagelanguage['LG_New_Today'] = "New Today";
            $pagelanguage['LG_End_soon'] = "End soon";
            $pagelanguage['LG_Reload'] = "Reload";
            $pagelanguage['LG_Refresh'] = "Refresh";
            $pagelanguage['LG_RemoveFromselection'] = "Remove from Watch list";
            $pagelanguage['LG_AddToSelection'] = "Add to Watch list";
            $pagelanguage['LG_JPY'] = "JPY";
            $pagelanguage['LG_You_are_currently_the_highest_bidder'] = "You are currently the highest bidder";
            $pagelanguage['LG_You_are_not_currently_the_highest_bidder'] = "You are not currently the highest bidder";
            $pagelanguage['LG_You_lose_the_bid'] = "You lose the bid";
            $pagelanguage['LG_Sorry_No_Auction_Data_Found'] = "";

            $pagelanguage['LG_Product_details'] = "Product Details";
            $pagelanguage['LG_Start_Price'] = "Start Price";
            $pagelanguage['LG_Increment'] = "Increment";
            $pagelanguage['LG_Logout'] = "Logout";
            $pagelanguage['LG_Back_to_Previous_Page'] = "Back to Previous Page";
            $pagelanguage['LG_Back_to_List'] = "Back to List";
            $pagelanguage['LG_Back'] = "BACK";

            $pagelanguage['LG_Bidding'] = "Information";
            
            $pagelanguage['LG_Smartphone_Access'] = "Smartphone Access";
            $pagelanguage['LG_How_to_Bid_and_Deposit'] = "How to Bid & Deposit";
            $pagelanguage['LG_Member_registration_for_Bidding'] = "Member registration for Bidding";
            $pagelanguage['LG_Terms_and_Conditions_for_Bidding'] = "Terms and Conditions for Bidding";
            $pagelanguage['LG_Security_Deposit'] = "Security Deposit";
            $pagelanguage['LG_Winner_Bidding_to_Payment'] = "Winner Bidding to Payment";
            $pagelanguage['LG_Carry_Out_of_Equipment'] = "Carry-Out of Equipment";
            $pagelanguage['LG_Bidding_Style'] = "Bidding Style";
            $pagelanguage['LG_Log_in_and_Bedding'] = "Log-in & Bedding";
            $pagelanguage['LG_Auction_Entry_Application'] = "Auction Entry Application";
            $pagelanguage['LG_Shipping_charge'] = "Shipping chage";
            $pagelanguage['LG_auction_photo'] = "How to Take and set Auction Photos";
            $pagelanguage['LG_autobid'] = "Auto Bid JPY";
            $pagelanguage['LG_amount_sign'] = "";
            $pagelanguage['LG_Next'] = "Next";
            $pagelanguage['LG_Previous'] = "Previous";
            $pagelanguage['LG_Download_Photos'] = "Download Photos";
            $pagelanguage['LG_Condition_Report'] = "Condition Report";

            $pagelanguage['LG_Consignor'] = "Consignor";
            $pagelanguage['LG_AuctionResults'] = "Auction results";
            $pagelanguage['LG_WOODY_AUCTION_RESULT'] = "WOODY AUCTION RESULT";
            $pagelanguage['LG_AUCTION_DATE'] = "AUCTION DATE";

            $pagelanguage['LG_Auction_Information'] = "Auction Information";


            return $pagelanguage;
        }
        else
        {
            $pagelanguage = array();
            $pagelanguage['LG_language'] = "jp";
            $pagelanguage['LG_Login_ID'] = "ログインID";
            $pagelanguage['LG_Password'] = "パスワード";
            $pagelanguage['LG_Login'] = "ログイン";
            $pagelanguage['LG_Forgot_Your_Password'] = "パスワードをお忘れですか";
            $pagelanguage['LG_Auction_No'] = "LOT No.";
            $pagelanguage['LG_Maker'] = "メーカー";
            $pagelanguage['LG_Year'] = "製造年";
            $pagelanguage['LG_Hour'] = "メーター";
            $pagelanguage['LG_Delivery_Yard'] = "引渡場所";
            $pagelanguage['LG_Delivery_Place'] = "引渡場所";
            $pagelanguage['LG_Releasing_Charge'] = "出庫料";
            $pagelanguage['LG_Price'] = "価格";
            $pagelanguage['LG_Model'] = "モデル";
            $pagelanguage['LG_Serial'] = "製造番号";
            $pagelanguage['LG_Current_Bid'] = "現在価格";
            $pagelanguage['LG_Bidder_No'] = "最高入札者番号";
            $pagelanguage['LG_Bids'] = "入札";
            $pagelanguage['LG_Bid'] = "入札";
            $pagelanguage['LG_Time_Left'] = "残り時間";
            $pagelanguage['LG_Feature'] = "特徴";
            $pagelanguage['LG_Comment'] = "コメント";
            $pagelanguage['LG_Bidding_Status'] = "入札状況";
            $pagelanguage['LG_Category_List'] = "カテゴリーリスト";
            $pagelanguage['LG_Item_Search'] = "アイテム検索";
            $pagelanguage['LG_Search'] = "検索";
            $pagelanguage['LG_Choice'] = "選択";
            $pagelanguage['LG_Sort'] = "並び順";
            $pagelanguage['LG_ALL'] = "全て";
            $pagelanguage['LG_New_Today'] = "今日の新機能";
            $pagelanguage['LG_End_soon'] = "もうすぐ終了";
            $pagelanguage['LG_Reload'] = "更新";
            $pagelanguage['LG_Refresh'] = "更新";
            $pagelanguage['LG_RemoveFromselection'] = "ウォッチリストから削除";
            $pagelanguage['LG_AddToSelection'] = "ウォッチリストへ追加";
            $pagelanguage['LG_JPY'] = "JPY";
            $pagelanguage['LG_You_are_currently_the_highest_bidder'] = "あなたは現在最高入札者です";
            $pagelanguage['LG_You_are_not_currently_the_highest_bidder'] = "あなたは現在、最高入札者ではありません";
            $pagelanguage['LG_You_lose_the_bid'] = "あなたは入札を失います";
            $pagelanguage['LG_Sorry_No_Auction_Data_Found'] = "";

            $pagelanguage['LG_Product_details'] = "製品の詳細";
            $pagelanguage['LG_Start_Price'] = "スタート価格";
            $pagelanguage['LG_Increment'] = "入札単位";
            $pagelanguage['LG_Logout'] = "ログアウト";
            $pagelanguage['LG_Back_to_Previous_Page'] = "前のページに戻る";
            $pagelanguage['LG_Back_to_List'] = "リストに戻る";
            $pagelanguage['LG_Back'] = "戻る";

            $pagelanguage['LG_Bidding'] = "情報";

            $pagelanguage['LG_Smartphone_Access'] = "スマートフォンアクセス";
            $pagelanguage['LG_How_to_Bid_and_Deposit'] = "入札と保証金の方法";
            $pagelanguage['LG_Member_registration_for_Bidding'] = "入札会員登録";
            $pagelanguage['LG_Terms_and_Conditions_for_Bidding'] = "入札条件";
            $pagelanguage['LG_Security_Deposit'] = "保証金";
            $pagelanguage['LG_Winner_Bidding_to_Payment'] = "支払いへの勝者の入札";
            $pagelanguage['LG_Carry_Out_of_Equipment'] = "機器の持ち出し";
            $pagelanguage['LG_Bidding_Style'] = "入札スタイル";
            $pagelanguage['LG_Log_in_and_Bedding'] = "ログインと寝具";
            $pagelanguage['LG_Auction_Entry_Application'] = "オークションエントリー申し込み";
            $pagelanguage['LG_Shipping_charge'] = "船積費用";
            $pagelanguage['LG_auction_photo'] = "オクタン写真を設定する方法";
            $pagelanguage['LG_autobid'] = "自動入札額";
            $pagelanguage['LG_amount_sign'] = "円";
            $pagelanguage['LG_Next'] = "次";
            $pagelanguage['LG_Previous'] = "前";
            $pagelanguage['LG_Download_Photos'] = "写真のダウンロード";
            $pagelanguage['LG_Condition_Report'] = "査定表";

            $pagelanguage['LG_Consignor'] = "荷送人";
            $pagelanguage['LG_AuctionResults'] = "オークション結果";
            $pagelanguage['LG_WOODY_AUCTION_RESULT'] = "ウッディーオークション結果";
            $pagelanguage['LG_AUCTION_DATE'] = "オークション日";

            $pagelanguage['LG_Auction_Information'] = "オークション情報";

            return $pagelanguage;
        }
    }

    public function search_site()
    {
        if (Session::has('logger_id'))
        {
            $page =$this->get_pageurl('fontend.en.search_site_auction','fontend.jp.search_site_auction');
            $pagelanguage = $this->get_pagelanguage();
            return view($page,compact('pagelanguage'));
        }
        else
        {
            //need to login
            $page =$this->get_pageurl('fontend.en.search_site','fontend.jp.search_site');
            $pagelanguage = $this->get_pagelanguage();
            return view($page,compact('pagelanguage'));
        }
        
    }
    public function search_site_bidder_login(Request $request) 
    {
        $username = $request->username;
        $password = $request->password;  

        $register = Bidder_register::where('username',$username)->orwhere('email1',$username)->where('permission','approve')->where('status','active')->get();  
        if(count($register)==1)
        {
            //return response()->json($register[0]['password'] );
            $dbpass = $register[0]['password'];  
            if (Hash::check($password, $dbpass))
            {
                //login user data
                if (Session::has('logger_id')) 
                {
                    Session::put('loggercodeno', $register[0]['usercodeno']);
                    Session::put('logger', $register[0]['name_en']);
                    Session::put('logger_id', $register[0]['id']);
                    Session::put('loginstatus',1) ;  
                    return Redirect()->route('woody.search_site');
                }
                else
                {
                    Session::put('loggercodeno', $register[0]['usercodeno']);
                    Session::put('logger', $register[0]['name_en']);
                    Session::put('logger_id', $register[0]['id']);
                    Session::put('loginstatus',1) ; 
                    return Redirect()->route('woody.search_site');
                }
            }
            else
            {
                return Redirect()->route('woody.search_site')->with('esuccess', 'Wrong username or password');
            }
        }
        else
        {
            return Redirect()->route('woody.search_site')->with('esuccess', 'Wrong username or password');
        }
    }

    public function search_site_logout()
    {  
        Session::forget('logger_id');
        Session::forget('loggercodeno');
        Session::forget('logger');
        Session::forget('loginstatus');
        Session::put('loginstatus',0) ;

        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: text/html');
        //Artisan::call('cache:clear');
        //dd('aaf');
        return Redirect()->route('/');
    }

    //member_registration_for_search_site
    public function member_registration_for_search_site()
    {
        $page =$this->get_pageurl('fontend.en.member_registration_for_search_site','fontend.jp.member_registration_for_search_site');
        $pagelanguage = $this->get_pagelanguage(); //dd($pagelanguage);
        return view($page,compact('pagelanguage'));
    }


    public function search_site_bid_result($auctiondate)
    {
        $page =$this->get_pageurl('fontend.en.search_site_auction_result','fontend.jp.search_site_auction_result');

        $auction_result = Product::with('delivery')->where('auction_date','like', '%'.date('Y-m-d',strtotime($auctiondate)).'%')->get();
        $deliveryplaces = Delivery_place::latest()->get();
        $pagelanguage = $this->get_pagelanguage(); //dd($pagelanguage);
        return view($page,compact('auctiondate','auction_result','pagelanguage','deliveryplaces'));
    }

    public function guidebook()
    {
        $page =$this->get_pageurl('fontend.en.guidebook','fontend.jp.guidebook');
        $pagelanguage = $this->get_pagelanguage(); //dd($pagelanguage);
        return view($page,compact('pagelanguage'));
    }

    public function support()
    {
        $page =$this->get_pageurl('fontend.en.support','fontend.jp.support');
        
        return view($page);
    }

    public function category($id)
    {
        //$page =$this->get_pageurl('fontend.en.auction_product','fontend.jp.auction_product'); 
        $page = $this->auction_page();
        $pagelanguage = $this->get_pagelanguage();
        $deliveryplaces = Delivery_place::latest()->get();

        if($id == -1)
        {
            $auctionproducts = Product::where('auction_product',1)->where('final_result','unsold')->orderBy('id','asc')->paginate(30);
        }
        else
        {
            $auctionproducts = Product::where('auction_product',1)->where('final_result','unsold')->where('category_id',$id)->orderBy('id','asc')->paginate(30);
        }
        $selectedmenu = "0"; //0 all, 1 new today, 2 end soon
        return view($page,compact('auctionproducts','pagelanguage','deliveryplaces','selectedmenu'));
    }

    ///////////////////////////////////////////////////////Auction view_byproductid/////////////////////////////////////////////

    public function view_byproductid($id)
    {
        $data = array();
        $auctionproduct = Product::find($id);
        if(is_array($auctionproduct) && count($auctionproduct)==0){return redirect()->route('woody.auction');}  //error handling

        $brand = Brand::where('id',$auctionproduct->brand_id)->get(); 

        $data['biddercountry'] = "";
        $data['biddercodeno'] = "";
        $data['bidder_id'] = ""; 

        if($auctionproduct->auction_max_bidder_id !=0 )
        {
            $bidder = Bidder_register::where('id',$auctionproduct->auction_max_bidder_id)->get();  
            if(is_array($bidder) && count($bidder)>0)
            {
                $data['biddercountry'] = $bidder[0]['country'] !=""?$bidder[0]['country']:"";
                $data['biddercodeno'] = $bidder[0]['usercodeno']== Session::get('loggercodeno')?$bidder[0]['usercodeno']:substr($bidder[0]['usercodeno'], 0, 4)."****";
                $data['bidder_id'] = $bidder[0]['id']!=""?$bidder[0]['id']:"";
            }
        }
         
        $auctionHistory = AuctionHistory::where('product_id',$id)->where('bidder_id',Session::get('logger_id'))->get(); 
        $data['current_bidder_id'] = Session::get('logger_id');
        $data['auction_max_bidder_id'] = $auctionproduct->auction_max_bidder_id;
        $data['auction_2ndmax_bidder_id'] = $auctionproduct->auction_2ndmax_bidder_id;
        $data['this_auction_bided'] = count($auctionHistory)>0?'yes':'no'; //if bidder bid for this auction product 'yes'
        //dd($brand[0]['name_en']);
        
        
        $data['pro_no'] = $auctionproduct->product_no;
        $data['brand'] = $brand[0]['name_en'];                 
        $data['modelyear'] = $auctionproduct->model_year;
        $data['usedhour'] = $auctionproduct->used_hour;
        $data['deliveryplace'] = $auctionproduct->delivery->name_en;
        $data['realeasingcharge'] = number_format($auctionproduct->releasing_charge);
        $data['modelno'] = $auctionproduct->model_no;
        $data['bidstartprice'] = $auctionproduct->bid_start_price;              
        //$data['totalbidno'] = $auctionproduct.id;


        ///////time left calculation start////////
        $auction_startdate = strtotime($auctionproduct->start_time_of_auction);
        $auction_enddate = strtotime($auctionproduct->end_time_of_auction);
        $today_date = strtotime(Carbon::now());
        $timeduration="";
        $day = 86400;
        $hour = 3600;
        $minute = 60;
        $daysout=0;
        $hoursout=0;
        $minutesout=0;
        $secondsout =0;
        $timeleft="";
        if($today_date < $auction_startdate)
        {
            //start - end
            $timeduration =  $auction_enddate - $auction_startdate;

            if($timeduration <=0){$timeleft = 0;}
            else
            {
                $daysout = floor($timeduration / $day);
                $hoursout = floor(($timeduration - $daysout * $day)/$hour);
                $minutesout = floor(($timeduration - $daysout * $day - $hoursout * $hour)/$minute);
                $secondsout = floor(($timeduration - $daysout * $day - $hoursout * $hour - $minutesout * $minute)/60);
                if($daysout>0){$timeleft=$daysout."d";}
                if($hoursout>0){$timeleft.="/".$hoursout."h/";}
                if($minutesout>0){$timeleft.= $minutesout."m";}
                //if($secondsout>0){$timeleft.= $secondsout." second";}
            }
        }
        else if($today_date >= $auction_startdate && $today_date < $auction_enddate)
        {
            //end - today
            $timeduration =  $auction_enddate - $today_date;

            if($timeduration <=0){$timeleft = 0;}
            else{
                $daysout = floor($timeduration / $day);
                $hoursout = floor(($timeduration - $daysout * $day)/$hour);
                $minutesout = floor(($timeduration - $daysout * $day - $hoursout * $hour)/$minute);
                $secondsout = floor(($timeduration - $daysout * $day - $hoursout * $hour - $minutesout * $minute)/60);
                if($daysout>0){$timeleft=$daysout."d";}
                if($hoursout>0){$timeleft.="/".$hoursout."h/";}
                if($minutesout>0){$timeleft.= $minutesout."m";}
                if($secondsout>0){$timeleft.= $secondsout." second";}
            }
        }
        else {
            //old dated
            $timeleft = 0;
            
        }
        ///////time left calculation end////////



        $data['timeleft'] = $timeleft;
        $data['featureandcomment'] = $auctionproduct->long_description;
        $data['biddingstatus'] = $auctionproduct->bidding_result; //yes,no  yes:own the bid
        $data['biddecreaseprice'] = $auctionproduct->bid_increase_decrease_price;
        $data['bidincreaseprice'] = $auctionproduct->bid_increase_decrease_price;    
        $bid_start_price = $auctionproduct->bid_start_price;
        $auction_max_bid_amount = $auctionproduct->auction_max_bid_amount;
        $bidder_max_price = $auction_max_bid_amount >= $bid_start_price ? $auction_max_bid_amount : $bid_start_price;
        $data['bidcurrentprice'] = $bidder_max_price;
        $data['bidcurrentprice'] = $bidder_max_price;
        $data['auction_max_bidder_price'] = number_format($bidder_max_price);
        $data['bidprice'] = number_format($bidder_max_price);  
        $data['totalbidno'] = $auctionproduct->total_bids;                    
        //return response()->json($data);
        return response()->json($data);
    }
    //auction product details show
    public function product_details($id)
    {
        $page =$this->get_pageurl('fontend.en.single_product','fontend.jp.single_product'); 
        $pagelanguage = $this->get_pagelanguage();

        $products = Product::where('auction_product',1)->where('final_result','unsold')->where('id',$id)->get();
        if(is_array($products) && count($products)==0){return redirect()->route('woody.auction');}

        $product_multiple_images = Product_multiple_image::where('publish_status','publish')->where('product_id',$id)->orderBy('id','asc')->get();
        $product_multiple_videos = Product_video::where('publish_status','publish')->where('product_id',$id)->get();

        $auction_max_bidder_id = $products[0]->auction_max_bidder_id; 
        $auction_max_bid_amount = $products[0]->auction_max_bid_amount; 
        $auction_max_autobid_amount = $products[0]->auction_max_autobid_amount; 

        $auction_start = $products[0]->auction_start;
        $auction_end = $products[0]->auction_end;   
        $bidderid = session()->get('loginstatus')==1? session()->get('logger_id'):"";

        $auction_history ="";
        if(session()->get('loginstatus')==1 && $auction_max_bidder_id == $bidderid)
        {
            if($auction_max_autobid_amount !=0)
            {
                $auction_history = AuctionHistory::with('product','bidder')
                                            ->where('product_id',$id)
                                            ->where('bidding_price','<=',$auction_max_bid_amount)
                                            ->where('product_return','!=',1)
                                            //->whereBetween('bid_time',[$auction_start,$auction_end])
                                            ->where('bid_time','>=',$auction_start)
                                            ->orderby('bidding_price','desc')->get();
            }
            else
            {
                $auction_history = AuctionHistory::with('product','bidder')
                                        ->where('product_id',$id)
                                        //->where('bidding_price','>=',$auction_max_bid_amount)
                                        ->where('product_return','!=',1)
                                        //->whereBetween('bid_time',[$auction_start,$auction_end])
                                        ->where('bid_time','>=',$auction_start)
                                        ->orderby('bidding_price','desc')->get();
            }
        
            return view($page,compact('products','product_multiple_images','product_multiple_videos','pagelanguage','auction_history','bidderid'));
        }
        else if(session()->get('loginstatus')==1 && $auction_max_bidder_id != $bidderid)
        {
            $auction_history = AuctionHistory::with('product','bidder')
                                        ->where('product_id',$id)
                                        ->where('bidding_price','<=',$auction_max_bid_amount)
                                        ->where('product_return','!=',1)
                                        //->whereBetween('bid_time',[$auction_start,$auction_end])
                                        ->where('bid_time','>=',$auction_start)
                                        ->orderby('bidding_price','desc')->get();

            return view($page,compact('products','product_multiple_images','product_multiple_videos','pagelanguage','auction_history','bidderid'));
        }
        else
        {
            $auction_history = AuctionHistory::with('product','bidder')
                                        ->where('product_id',$id)
                                        ->where('bidding_price','<=',$auction_max_bid_amount)
                                        ->where('product_return','!=',1)
                                        //->whereBetween('bid_time',[$auction_start,$auction_end])
                                        ->where('bid_time','>=',$auction_start)
                                        ->orderby('bidding_price','desc')->get();

            return view($page,compact('products','product_multiple_images','product_multiple_videos','pagelanguage','auction_history','bidderid'));
        }
        
    }
    //bidder login
    public function bidder_login(Request $request) 
    {
        $username = $request->username;
        $password = $request->password;  

        $register = Bidder_register::where('username',$username)->orWhere('email1', '=', $username)->where('permission','approve')->where('status','active')->get(); 
        if(count($register) ==1)
        {
            //return response()->json($register[0]['password'] );
            $dbpass = $register[0]['password'];  
            if (Hash::check($password, $dbpass))
            {
                
                //login user data
                if (Session::has('logger_id')) 
                {
                    Session::put('loggercodeno', $register[0]['usercodeno']);
                    Session::put('logger', $register[0]['name_en']);
                    Session::put('logger_id', $register[0]['id']);
                    Session::put('loginstatus',1) ;
                    return response()->json(array(
                        'loginstatus' => 1,
                        'language'=>Session::get('language'),
                    ));
                }
                else
                {
                    Session::put('loggercodeno', $register[0]['usercodeno']);
                    Session::put('logger', $register[0]['name_en']);
                    Session::put('logger_id', $register[0]['id']);
                    Session::put('loginstatus',1) ;

                    //return response()->json('login successfull');
                    return response()->json(array(
                        'loginstatus' => 1,
                        'language'=>Session::get('language'),
                    ));
                }
                
            }
            else
            {
                //return response()->json('username or password not match');
                return response()->json(array(
                    'loginstatus' => 0,
                    'language'=>Session::get('language'),
                ));
            }
            
        }
        else
        {
            //product owner
            $woner = Product_woner::where('username',$username)->where('status','active')->get(); //dd($woner);
            if(count($woner) ==1)
            {
                $dbpass = $woner[0]['password']; 
                if (Hash::check($password, $dbpass))
                {
                    //login user data
                    if (Session::has('logger_id')) 
                    {
                        Session::put('loggercodeno', $woner[0]['usercodeno']);
                        Session::put('logger', $woner[0]['name_en']);
                        Session::put('logger_id', $woner[0]['id']);
                        Session::put('loginstatus',2) ;
                        return response()->json(array(
                            'loginstatus' => 2,
                            'language'=>Session::get('language'),
                        ));
                    }
                    else
                    {
                        Session::put('loggercodeno', $woner[0]['usercodeno']);
                        Session::put('logger', $woner[0]['name_en']);
                        Session::put('logger_id', $woner[0]['id']);
                        Session::put('loginstatus',2) ;

                        //return response()->json('login successfull');
                        return response()->json(array(
                            'loginstatus' => 2,
                            'language'=>Session::get('language'),
                        ));
                    }
                    
                }
                else
                {
                    //return response()->json('username or password not match');
                    return response()->json(array(
                        'loginstatus' => 0,
                        'language'=>Session::get('language'),
                    ));
                }
            }


            //admin control
            /////////////
            $adminuser = User::where('email',$username)->get();
            if(count($adminuser)==1)
            {
                $dbpass = $adminuser[0]['password'];  
                if (Hash::check($password, $dbpass))
                {
                    //login user data
                    Session::put('loggercodeno', '-1');
                    Session::put('logger', 'Action Controller');
                    Session::put('logger_id', '-1');
                    Session::put('loginstatus',1) ;
                    return response()->json(array(
                        'loginstatus' => '-1',
                        'language'=>Session::get('language'),
                    ));
                }
                else{
                    return response()->json(array(
                        'loginstatus' => 0,
                        'language'=>Session::get('language'),
                    ));
                }
            }
            else{
                return response()->json(array(
                    'loginstatus' => 0,
                    'language'=>Session::get('language'),
                ));
            }
           /////////////
            
        }
        
    }

    public function bidderLogin_from_product_show(Request $request) 
    {
        $username = $request->username;
        $password = $request->password;  

        $register = Bidder_register::where('username',$username)->orWhere('email1', '=', $username)->where('status','active')->get(); 
        if(count($register)==1)
        {
            $dbpass = $register[0]['password'];  
            if (Hash::check($password, $dbpass))
            {
                //login user data
                if (Session::has('logger_id')) 
                {
                    Session::put('loggercodeno', $register[0]['usercodeno']);
                    Session::put('logger', $register[0]['name_en']);
                    Session::put('logger_id', $register[0]['id']);
                    Session::put('loginstatus',1) ;

                    return response()->json(array(
                        'loginstatus' => 1,
                    ));
                }
                else
                {
                    Session::put('loggercodeno', $register[0]['usercodeno']);
                    Session::put('logger', $register[0]['name_en']);
                    Session::put('logger_id', $register[0]['id']);
                    Session::put('loginstatus',1) ;

                    return response()->json(array(
                        'loginstatus' => 1,
                    ));
                }
                
            }
            else
            {
                return response()->json(array(
                    'loginstatus' => 0,
                ));
            }
        }
        else
        {
            //product owner
            $woner = Product_woner::where('username',$username)->where('status','active')->get(); //dd($woner);
            if(count($woner) ==1)
            {
                $dbpass = $woner[0]['password']; 
                if (Hash::check($password, $dbpass))
                {
                    //login user data
                    if (Session::has('logger_id')) 
                    {
                        Session::put('loggercodeno', $woner[0]['usercodeno']);
                        Session::put('logger', $woner[0]['name_en']);
                        Session::put('logger_id', $woner[0]['id']);
                        Session::put('loginstatus',2) ;
                        return response()->json(array(
                            'loginstatus' => 2,
                        ));
                    }
                    else
                    {
                        Session::put('loggercodeno', $woner[0]['usercodeno']);
                        Session::put('logger', $woner[0]['name_en']);
                        Session::put('logger_id', $woner[0]['id']);
                        Session::put('loginstatus',2) ;

                        //return response()->json('login successfull');
                        return response()->json(array(
                            'loginstatus' => 2,
                        ));
                    }
                    
                }
                else
                {
                    //return response()->json('username or password not match');
                    return response()->json(array(
                        'loginstatus' => 0,
                    ));
                }
            }


            //admin control
            /////////////
            $adminuser = User::where('email',$username)->get();
            if(count($adminuser)==1)
            {
                $dbpass = $adminuser[0]['password'];  
                if (Hash::check($password, $dbpass))
                {
                    //login user data
                    Session::put('loggercodeno', '-1');
                    Session::put('logger', 'Action Controller');
                    Session::put('logger_id', '-1');
                    Session::put('loginstatus',1) ;
                    return response()->json(array(
                        'loginstatus' => '-1',
                    ));
                }
                else{
                    return response()->json(array(
                        'loginstatus' => 0,
                    ));
                }
            }
            else{
                return response()->json(array(
                    'loginstatus' => 0,
                ));
            }
           /////////////
            
        }
    }
    //bidder logout
    public function bidder_logout()
    {  
        Session::forget('logger_id');
        Session::forget('loggercodeno');
        Session::forget('logger');
        Session::forget('loginstatus');
        Session::put('loginstatus',0) ;

        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: text/html');
        
        //dd('aaf');
        return Redirect()->route('woody.auction');
    }
    // public function bidder_logout()
    // {  
    //     Session::forget('logger_id');
    //     Session::forget('loggercodeno');
    //     Session::forget('logger');
    //     Session::forget('loginstatus');
    //     Session::put('loginstatus',0) ;

    //     if(session()->get('loginstatus')==1)
    //     {
    //         return response()->json(array(
    //             'loginstatus' => 1,
    //         ));
    //     }
    //     else
    //     {
    //         return response()->json(array(
    //             'loginstatus' => 0,
    //         ));
    //     }
    // }
    public function bidderLogout_from_product_show()
    {  
        Session::forget('logger_id');
        Session::forget('loggercodeno');
        Session::forget('logger');
        Session::forget('loginstatus');
        Session::put('loginstatus',0) ;

        if(session()->get('loginstatus')==1)
        {
            return response()->json(array(
                'loginstatus' => 1,
            ));
        }
        else
        {
            return response()->json(array(
                'loginstatus' => 0,
            ));
        }
    }
    //check bidder_login
    public function check_bidder_login()
    {
        if(session()->get('loginstatus')==1)
        {
            return response()->json(array(
                'loginstatus' => 1,
            ));
        }
        else if(session()->get('loginstatus')==2)
        {
            return response()->json(array(
                'loginstatus' => 2,
            ));
        }
        else if(session()->get('loginstatus')== '-1')
        {
            return response()->json(array(
                'loginstatus' => '-1',
            ));
        }
        else
        {
            return response()->json(array(
                'loginstatus' => 0,
            ));
        }
    }
    public function check_bidderLogin_from_product_show()
    {
        if(session()->get('loginstatus')==1)
        {
            return response()->json(array(
                'loginstatus' => 1,
            ));
        }
        else if(session()->get('loginstatus')== '2')
        {
            return response()->json(array(
                'loginstatus' => '2',
            ));
        }
        else if(session()->get('loginstatus')== '-1')
        {
            return response()->json(array(
                'loginstatus' => '-1',
            ));
        }
        else
        {
            return response()->json(array(
                'loginstatus' => 0,
            ));
        }
    }

    ///////////////// Bidding ///////////////////////////////////////
    


    public function bidforthis(Request $request,$product_id)
    {   
        //dd($product_id);
        //$product_id = $request->product_id;
        //$bidcurrentprice = "bidcurrentprice".$product_id;
        $bidcurrentprice = $request->bidcurrentprice;    
        $auctionproduct = Product::findOrFail($product_id); 
        if(is_array($auctionproduct) && count($auctionproduct)==0){return redirect()->route('woody.auction');}  //error handling

        $bidder_id = Session::get('logger_id'); 
        $Bidder = Bidder_register::findOrFail($bidder_id);    
        $biddercodeno = $Bidder->usercodeno;
        $biddername = $Bidder->name; 
        
        $timenow = strtotime(Carbon::now());     //1634801379  
        $auction_startdate = strtotime($auctionproduct->start_time_of_auction);  //dd($auction_startdate);//1634830200 
        $auction_enddate = strtotime($auctionproduct->end_time_of_auction);   //1635003000

        $bid_start_price = $auctionproduct->bid_start_price;
        $bid_increase_decrease_price = $auctionproduct->bid_increase_decrease_price;
        $auction_max_bid_amount = $auctionproduct->auction_max_bid_amount;
        $auction_max_bidder_id = $auctionproduct->auction_max_bidder_id;
        $auction_2ndmax_bid_amount = $auctionproduct->auction_2ndmax_bid_amount;
        $auction_2ndmax_bidder_id = $auctionproduct->auction_2ndmax_bidder_id;

        $bid_system = ((double)$bidcurrentprice - (double)$bid_start_price) > (double)$bid_increase_decrease_price? "AUTOBID":"BID";      
        
        
        //echo $auction_startdate;exit;
        if($timenow >= $auction_startdate && $timenow <= $auction_enddate)
        { 
            //dd((int)$auction_max_bid_amount);
            //////process-1 
            if((int)$auction_max_bid_amount == 0)
            { 
                //dd('bidforthis-2-1');
                //echo "paisi-1";exit;
                //go to confirmation page with data
                $page =$this->get_pageurl('fontend.en.bid_confirmation','fontend.jp.bid_confirmation');
                $pagelanguage = $this->get_pagelanguage();
        
                return view($page,compact('product_id','bidcurrentprice','auctionproduct','bidder_id','biddercodeno','biddername','pagelanguage'));

            }
            //////process-2 
            else if((int)$auction_max_bid_amount >= (int)$bid_start_price)
            { 
                //dd('bidforthis-2-2');
                //echo "paisi-2";exit;
                ///go to confirmation page with data
                $page =$this->get_pageurl('fontend.en.bid_confirmation','fontend.jp.bid_confirmation');
                $pagelanguage = $this->get_pagelanguage();
        
                return view($page,compact('product_id','bidcurrentprice','auctionproduct','bidder_id','biddercodeno','biddername','pagelanguage'));
            }
            else{
                //dd((int)$auction_max_bid_amount);
                //dd((int)$bid_start_price);
                $page =$this->get_pageurl('fontend.en.bid_confirmation','fontend.jp.bid_confirmation');
                $pagelanguage = $this->get_pagelanguage();
        
                return view($page,compact('product_id','bidcurrentprice','auctionproduct','bidder_id','biddercodeno','biddername','pagelanguage'));
            }
            
        }
        else{ 
            //dd('bidforthis-3');
            //echo "timeover";exit;
            return Redirect()->back()->with('errormsg','Time is over');
        }

        
        
    }

    //bid confirm mail
    public function bid_confirm_mail($bidder_id,$auctionproduct,$bidcurrentprice,$bid_system)
    {
        $Bidder = Bidder_register::find($bidder_id);       //dd($bidder_id.','.$Bidder['email1'].','.$auctionproduct['product_no'].','.$bidcurrentprice);
        $data = array();
        $data['companyname'] = $Bidder['company_name'];
        $data['person_incharge'] = $Bidder['person_incharge'];
        $data['biddercode'] = $Bidder['usercodeno'];
        $data['auctionno'] = $auctionproduct['product_no'];
        $data['modelno'] = $auctionproduct['model_no'];
        $data['serialno'] = $auctionproduct['serial_no'];
        $data['bid_price'] = $bidcurrentprice;
        $data['bid_system'] = $bid_system;
        

        Mail::to($Bidder['email1'])->send(new auctionBidMail($data));
    }
    //lose bid mail
    public function lose_bid_mail($bidder_id, $auctionproduct)
    {
        $bidderinfo = Bidder_register::find($bidder_id);      //dd($bidder_id.','.$bidderinfo['email1'].','.$auctionproduct['product_no']);

        $data = array();
        $data['companyname'] = $bidderinfo['company_name'];
        $data['person_incharge'] = $bidderinfo['person_incharge'];
        $data['biddercode'] = $bidderinfo['usercodeno'];
        $data['auctionno'] = $auctionproduct['product_no'];
        $data['modelno'] = $auctionproduct['model_no'];
        $data['bid_2nd_price'] = $auctionproduct['auction_2ndmax_bid_amount'];
        $data['bid_max_price'] = $auctionproduct['auction_max_bid_amount'];

        Mail::to($bidderinfo['email1'])->send(new auctionBidLossMail($data));
    }
    //insert record in history 
    public function insert_history($product_no,$product_id,$bidcurrentprice, $bid_system,$bidderid, $highest_bidder)
    {
        $historyrecord ="";
        $historyrecord = AuctionHistory::where('product_id',$product_id)->where('bidding_price',$bidcurrentprice)->where('bidder_id',$bidderid)->get();
        if(count($historyrecord)==0)
        {
            $id = AuctionHistory::insertGetId([ 
                'auction_no'=>$product_no,
                'product_id'=>$product_id,
                'bidder_id'=>$bidderid,
                'bidding_price' => $bidcurrentprice,
                'bid_system' => $bid_system,
                'highest_bidder' => $highest_bidder,
                'bid_time' => Carbon::now(),
                'created_at' => Carbon::now(),
            ]);
            return $id;
        }
        else
        {
            $id="";
            return $id;
        }
    }

    //////****bid confirmation for main bidding calculation*****////////////
    public function bidconfirmation($product_id,$bidcurrentprice,$bidder_id,$biddercodeno)
    {
        //$product_id = $product_id; 
        //$bidcurrentprice = $request->bidcurrentprice; //bidcurrentprice
        $auctionproduct = Product::findOrFail($product_id); 

        //bidder information
        $bidder_id = Session::get('logger_id'); 
        $Bidder = Bidder_register::findOrFail($bidder_id);    
        $biddercodeno = $Bidder->usercodeno;
        $biddername = $Bidder->name;

        $bidderlist = "";
        $bidderlist = $auctionproduct->bidders;
        if($bidderlist !="")
        {
            $bidderarray = explode(",", $bidderlist);
            if(is_array($bidderarray))
            {
                if(count($bidderarray)>0)
                {
                    if (!in_array($bidder_id, $bidderarray))
                    {
                        array_push($bidderarray, $bidder_id);
                        $bidderlist = implode(",", $bidderarray);
                    }
                }
            }
        }
        else
        {
            $bidderlist = $bidder_id;
        }
        
        //time
        $timenow = strtotime(Carbon::now());
        $auction_startdate = strtotime($auctionproduct->start_time_of_auction); //db
        $auction_enddate = strtotime($auctionproduct->end_time_of_auction); //db

        $bid_start_price = $auctionproduct->bid_start_price; //db
        $bid_increase_decrease_price = $auctionproduct->bid_increase_decrease_price; //db
        $auction_max_autobid_amount = $auctionproduct->auction_max_autobid_amount; //db
        $auction_max_bid_amount = $auctionproduct->auction_max_bid_amount; //db
        $auction_max_bidder_id = $auctionproduct->auction_max_bidder_id; //db
        $auction_2ndmax_bid_amount = $auctionproduct->auction_2ndmax_bid_amount; //db
        $auction_2ndmax_bidder_id = $auctionproduct->auction_2ndmax_bidder_id; //db

        $total_bids = $auctionproduct->total_bids;
        
        $bidstatus =0;
        if($timenow >= $auction_startdate && $timenow <= $auction_enddate)
        {  
            //////process-1 for first bid. if auction_max_bid_amount of db equal to 0
            if($total_bids == 0 && $auction_max_bid_amount == 0 && $auction_max_autobid_amount == 0 )
            {
                $bid_system = (double)$bidcurrentprice > (double)$bid_start_price ? "AUTOBID":"BID";
                //$auction_2ndmax_bid_amount = $bid_start_price - $bid_increase_decrease_price;  
                Product::find($product_id)->update([
                    'auction_max_autobid_amount' => (double)$bidcurrentprice > (double)$bid_start_price ? (double)$bidcurrentprice: 0,
                    'auction_max_bid_amount'=> $bid_start_price,
                    'auction_max_bidder_id'=>Session::get('logger_id'),
                    'bid_system' => $bid_system,
                    'total_bids' => 1,
                    'bidding_result' =>'yes',
                    'need_to_pay' => $bid_start_price,
                    'bidders'=> $bidderlist,
                ]);
                //insert history
                $highest_bidder = 1;
                $bidderid = Session::get('logger_id');

                $send_mail = 0;

                if($bid_system == "AUTOBID")
                {
                    $id = AuctionHistory::insertGetId([ 
                                    'auction_no'=>$auctionproduct->product_no,
                                    'product_id'=>$product_id,
                                    'bidder_id'=>$bidderid,
                                    'bidding_price' => $bidcurrentprice,
                                    'bid_system' => $bid_system,
                                    'highest_bidder' => $highest_bidder,
                                    'bid_time' => Carbon::now(),
                                    'created_at' => Carbon::now(),
                                ]);
                    if($id !="")
                    {
                        Skauction_histories::insertGetId([ 	
                            'auctionhistoryid' => $id,	
                            'created_at'=> Carbon::now(),
                        ]);
                        $this->bid_confirm_mail($bidder_id,$auctionproduct,$bidcurrentprice,$bid_system);
                        $send_mail = 1;
                    }
                }
                
                $highest_bidder = 1;
                $bidcurrentprice = $bid_start_price;
                $bid_system = "BID";
                $bidderid = Session::get('logger_id');
                $id = AuctionHistory::insertGetId([ 
                                    'auction_no'=>$auctionproduct->product_no,
                                    'product_id'=>$product_id,
                                    'bidder_id'=>$bidderid,
                                    'bidding_price' => $bidcurrentprice,
                                    'bid_system' => $bid_system,
                                    'highest_bidder' => $highest_bidder,
                                    'bid_time' => Carbon::now(),
                                    'created_at' => Carbon::now(),
                                ]);
                if($id !="")
                {
                    Skauction_histories::insertGetId([ 	
                        'auctionhistoryid' => $id,	
                        'created_at'=> Carbon::now(),
                    ]);
                    if($send_mail == 0){
                        $this->bid_confirm_mail($bidder_id,$auctionproduct,$bidcurrentprice,$bid_system);
                    }
                    
                }
            
                $bidstatus =1; //hight bidder
                return redirect()->route('auction.bidstatus', [$product_id,$bidcurrentprice,$bidstatus]);
            }
            else 
            {    
                //////process-2 for next bid. if auction_max_bid_amount of db greater than  bid_start_price of db
            
                //if bidcurrentprice is greater than auction_max_bid_amount of db
                $auctionHistorys = AuctionHistory::where('product_id',$product_id)->where('bidder_id',Session::get('logger_id'))->where('product_return','=',0)->orderby('bidding_price','Desc')->get();     // dd((double)$auctionHistorys[0]->bidding_price);
                foreach($auctionHistorys as $ahistory)
                {
                    if((double)$ahistory->bidding_price == (double)$bidcurrentprice)
                    {
                        $this->auction();
                    }
                }

                if((double)$bidcurrentprice > (double)$auction_max_bid_amount)
                { 
                    if(Session::get('logger_id') == $auction_max_bidder_id)
                    {
                        //only increase auction_max_autobid_amount
                        if((double)$bidcurrentprice > (double)$auction_max_autobid_amount)
                        {
                            //product update for auction
                            Product::find($product_id)->update([
                                'auction_max_autobid_amount' =>(double)$bidcurrentprice,
                                'bid_system' => "AUTOBID",
                            ]);
                            $auctionHistorys ="";
                            $auctionHistorys = AuctionHistory::where('product_id',$product_id)->where('bidder_id',$auction_max_bidder_id)->where('bidding_price',$bidcurrentprice)->where('product_return','=',0)->get();
                            if(count($auctionHistorys)==0)
                            {
                                $bid_system = "AUTOBID";
                                $id = AuctionHistory::insertGetId([ 
                                    'auction_no'=>$auctionproduct->product_no,
                                    'product_id'=>$product_id,
                                    'bidder_id'=>$auction_max_bidder_id,
                                    'bidding_price' => $bidcurrentprice,
                                    'bid_system' => "AUTOBID",
                                    'highest_bidder' => 1,
                                    'bid_time' => Carbon::now(),
                                    'created_at' => Carbon::now(),
                                ]);
                                if($id !="")
                                {
                                    Skauction_histories::insertGetId([ 	
                                        'auctionhistoryid' => $id,	
                                        'created_at'=> Carbon::now(),
                                    ]);
                                    $this->bid_confirm_mail($auction_max_bidder_id,$auctionproduct,$bidcurrentprice,$bid_system);
                                }
                                else
                                {
                                    AuctionHistory::find($auctionHistorys[0]->id)->update([
                                        'bidding_price' =>(double)$bidcurrentprice,
                                        'bid_time' => Carbon::now(),
                                    ]);
                                }
                                return redirect()->route('auction.bidstatus', [$product_id,$bidcurrentprice,$bidstatus]);
                            }else{}
                            
                            return redirect()->route('auction.bidstatus', [$product_id,$bidcurrentprice,$bidstatus]);
                        }
                        else
                        {
                            return redirect()->route('auction.bidstatus', [$product_id,$bidcurrentprice,$bidstatus]);
                        }
                    }
                    //else
                    if((double)$bidcurrentprice > (double)$auction_max_autobid_amount && (double)$auction_max_autobid_amount !=0)
                    {
                        //dd('paisi-3');
                        
                        if(Session::get('logger_id') == $auction_max_bidder_id)
                        {
                            if((double)$bidcurrentprice <= (double)$auction_max_autobid_amount)
                            {
                                return redirect()->route('auction.bidstatus', [$product_id,$bidcurrentprice,$bidstatus]);
                            }
                            else if((double)$bidcurrentprice > (double)$auction_max_autobid_amount)
                            {
                                if((double)$bidcurrentprice > ((double)$auction_max_autobid_amount + $bid_increase_decrease_price ))
                                {
                                    //product update for auction
                                    Product::find($product_id)->update([
                                        'auction_max_autobid_amount' =>(double)$bidcurrentprice,
                                        'bid_system' => "AUTOBID",
                                    ]);
                                    
                                }
                                else
                                {
                                    //product update for auction
                                    Product::find($product_id)->update([
                                        'auction_max_autobid_amount' =>(double)$bidcurrentprice,
                                    ]);
                                }
                                
                                return redirect()->route('auction.bidstatus', [$product_id,$bidcurrentprice,$bidstatus]);
                            }else{}
                            return redirect()->route('auction.bidstatus', [$product_id,$bidcurrentprice,$bidstatus]);
                        }
                        
                        $bid_system = "BID";
                        if(Session::get('logger_id') == $auction_max_bidder_id)
                        {
                            $bid_system = "AUTOBID";
                        }
                        else
                        {
                            $bid_system = (double)$bidcurrentprice > ((double)$auction_max_autobid_amount  + (double)$bid_increase_decrease_price)? "AUTOBID":"BID";
                        }
                            
                        
                            $bidstatus =1; //hight bidder
                            $total_bids =  $auctionproduct->total_bids;
                            if(Session::get('logger_id') != $auction_max_bidder_id)
                            {
                                $total_bids =  $auctionproduct->total_bids + 1;
                            }
                            
                            $need_to_pay = $auction_max_bid_amount + $bid_increase_decrease_price;
                            //product update for auction
                            Product::find($product_id)->update([
                                'auction_max_autobid_amount' =>(double)$bidcurrentprice > ((double)$auction_max_autobid_amount + (double)$bid_increase_decrease_price)? $bidcurrentprice:0,
                                'auction_max_bid_amount'=> (double)$auction_max_autobid_amount + (double)$bid_increase_decrease_price,
                                'auction_max_bidder_id'=> Session::get('logger_id'),
                                'bid_system' => $bid_system,
                                'auction_2ndmax_bid_amount'=> $auction_max_autobid_amount, //previous max bid amount
                                'auction_2ndmax_bidder_id' => $auction_max_bidder_id, //previous max bidder id
                                'total_bids' => $total_bids,
                                'bidding_result' =>'yes',
                                'need_to_pay' => $need_to_pay,
                                'bidders'=> $bidderlist,
                            ]);

                            //insert history
                            $send_mail = 0;
                            if($bid_system == "AUTOBID" )
                            {
                                
                                $highest_bidder = 1;
                                $bidderid = Session::get('logger_id');
                                $auctionHistorys ="";
                                $auctionHistorys = AuctionHistory::where('product_id',$product_id)->where('bidder_id',$bidderid)->where('bidding_price',$bidcurrentprice)->where('product_return','=',0)->get();
                                if(count($auctionHistorys)==0)
                                {
                                    $bid_system = "AUTOBID";
                                    $id = AuctionHistory::insertGetId([ 
                                        'auction_no'=>$auctionproduct->product_no,
                                        'product_id'=>$product_id,
                                        'bidder_id'=>$bidderid,
                                        'bidding_price' => $bidcurrentprice,
                                        'bid_system' => "AUTOBID",
                                        'highest_bidder' => $highest_bidder,
                                        'bid_time' => Carbon::now(),
                                        'created_at' => Carbon::now(),
                                    ]);
                                    if($id !="")
                                    {
                                        Skauction_histories::insertGetId([ 	
                                            'auctionhistoryid' => $id,	
                                            'created_at'=> Carbon::now(),
                                        ]);
                                        $this->bid_confirm_mail($bidderid,$auctionproduct,$bidcurrentprice,$bid_system);
                                        $send_mail = 1;
                                    }
                                }
                                
                            }
                            $highest_bidder = 1;
                            $bidcurrentprice =  (double)$auction_max_autobid_amount + (double)$bid_increase_decrease_price;
                            $bidderid = Session::get('logger_id');
                            $auctionHistorys ="";
                            $auctionHistorys = AuctionHistory::where('product_id',$product_id)->where('bidder_id',$bidderid)->where('bidding_price',$bidcurrentprice)->where('product_return','=',0)->get();
                            if(count($auctionHistorys)==0)
                            {
                                $id = AuctionHistory::insertGetId([ 
                                    'auction_no'=>$auctionproduct->product_no,
                                    'product_id'=>$product_id,
                                    'bidder_id'=>$bidderid,
                                    'bidding_price' => $bidcurrentprice,
                                    'bid_system' => $bid_system,
                                    'highest_bidder' => $highest_bidder,
                                    'bid_time' => Carbon::now(),
                                    'created_at' => Carbon::now(),
                                ]);
                                if($id !="")
                                {
                                    Skauction_histories::insertGetId([ 	
                                        'auctionhistoryid' => $id,	
                                        'created_at'=> Carbon::now(),
                                    ]);

                                    if($send_mail == 0)
                                    {
                                        $this->bid_confirm_mail($bidderid,$auctionproduct,$bidcurrentprice,$bid_system);
                                    }
                                    
                                }
                            }
                        
                            return redirect()->route('auction.bidstatus', [$product_id,$bidcurrentprice,$bidstatus]);
                        
                        
                    }
                    else if($bidcurrentprice > $auction_max_autobid_amount && $auction_max_autobid_amount ==0)
                    {
                        if(Session::get('logger_id') == $auction_max_bidder_id)
                        {
                            if((double)$bidcurrentprice > (double)$auction_max_bid_amount)
                            {
                                if($bidcurrentprice > ((double)$auction_max_bid_amount  + $bid_increase_decrease_price ))
                                {
                                    //product update for auction
                                    Product::find($product_id)->update([
                                        'auction_max_autobid_amount' =>(double)$bidcurrentprice,
                                        'bid_system' => "AUTOBID",
                                    ]);
                                    
                                    $send_mail = 0;
                                    $bidderid = $auction_max_bidder_id;
                                    $auctionHistorys ="";
                                    $auctionHistorys = AuctionHistory::where('product_id',$product_id)->where('bidder_id',$bidderid)->where('bidding_price',$bidcurrentprice)->where('product_return','=',0)->get();
                                    if(count($auctionHistorys)==0)
                                    {
                                        $bid_system = "AUTOBID";
                                        $id = AuctionHistory::insertGetId([ 
                                            'auction_no'=>$auctionproduct->product_no,
                                            'product_id'=>$product_id,
                                            'bidder_id'=>$auction_max_bidder_id,
                                            'bidding_price' => $bidcurrentprice,
                                            'bid_system' => "AUTOBID",
                                            'highest_bidder' => 1,
                                            'bid_time' => Carbon::now(),
                                            'created_at' => Carbon::now(),
                                        ]);
                                        if($id !="")
                                        {
                                            Skauction_histories::insertGetId([ 	
                                                'auctionhistoryid' => $id,	
                                                'created_at'=> Carbon::now(),
                                            ]);
                                            $this->bid_confirm_mail($auction_max_bidder_id,$auctionproduct,$bidcurrentprice,$bid_system);
                                            $send_mail = 1;
                                        }else{}
                                        return redirect()->route('auction.bidstatus', [$product_id,$bidcurrentprice,$bidstatus]);
                                    }else{}
                                    return redirect()->route('auction.bidstatus', [$product_id,$bidcurrentprice,$bidstatus]);
                                }
                                else
                                {
                                    //product update for auction
                                    Product::find($product_id)->update([
                                        'auction_max_autobid_amount' =>(double)$bidcurrentprice,
                                        'bid_system' => "AUTOBID",
                                    ]);
                                    $send_mail = 0;
                                    $bidderid = $auction_max_bidder_id;
                                    $auctionHistorys ="";
                                    $auctionHistorys = AuctionHistory::where('product_id',$product_id)->where('bidder_id',$bidderid)->where('bidding_price',$bidcurrentprice)->where('product_return','=',0)->get();
                                    if(count($auctionHistorys)==0)
                                    {
                                        $bid_system = "AUTOBID";
                                        $id = AuctionHistory::insertGetId([ 
                                            'auction_no'=>$auctionproduct->product_no,
                                            'product_id'=>$product_id,
                                            'bidder_id'=>$auction_max_bidder_id,
                                            'bidding_price' => $bidcurrentprice,
                                            'bid_system' => "AUTOBID",
                                            'highest_bidder' => 1,
                                            'bid_time' => Carbon::now(),
                                            'created_at' => Carbon::now(),
                                        ]);
                                        if($id !="")
                                        {
                                            Skauction_histories::insertGetId([ 	
                                                'auctionhistoryid' => $id,	
                                                'created_at'=> Carbon::now(),
                                            ]);
                                            $this->bid_confirm_mail($auction_max_bidder_id,$auctionproduct,$bidcurrentprice,$bid_system);
                                            $send_mail = 1;
                                        }
                                        return redirect()->route('auction.bidstatus', [$product_id,$bidcurrentprice,$bidstatus]);
                                    }
                                    return redirect()->route('auction.bidstatus', [$product_id,$bidcurrentprice,$bidstatus]);
                                }
                                
                                return redirect()->route('auction.bidstatus', [$product_id,$bidcurrentprice,$bidstatus]);
                            }
                        }
                        


                        $bid_system = "BID";
                        if(Session::get('logger_id') == $auction_max_bidder_id)
                        {
                            $bid_system = "AUTOBID";
                        }
                        else
                        {
                            $bid_system = (double)$bidcurrentprice > ((double)$auction_max_bid_amount  + (double)$bid_increase_decrease_price)? "AUTOBID":"BID";
                        }
                        
                        $bidstatus =0; //hight bidder
                        if($bidcurrentprice > $auction_max_bid_amount)
                        {
                            $bidstatus =1;
                        }

                        $total_bids =  $auctionproduct->total_bids;
                        if(Session::get('logger_id') != $auction_max_bidder_id)
                        {
                            $total_bids =  $auctionproduct->total_bids + 1;
                        }
                        //$total_bids =  $auctionproduct->total_bids + 1;
                        $need_to_pay = $auction_max_bid_amount + $bid_increase_decrease_price;
                        //product update for auction
                        Product::find($product_id)->update([
                            'auction_max_autobid_amount' =>(double)$bidcurrentprice > ((double)$auction_max_bid_amount + (double)$bid_increase_decrease_price)? $bidcurrentprice:0,
                            'auction_max_bid_amount'=> (double)$auction_max_bid_amount + (double)$bid_increase_decrease_price,
                            'auction_max_bidder_id'=> Session::get('logger_id'),
                            'bid_system' => $bid_system,
                            'auction_2ndmax_bid_amount'=> $auction_max_bid_amount, //previous max bid amount
                            'auction_2ndmax_bidder_id' => $auction_max_bidder_id, //previous max bidder id
                            'total_bids' => $total_bids,
                            'bidding_result' =>'yes',
                            'need_to_pay' => $need_to_pay,
                            'bidders'=> $bidderlist,
                        ]);
                        //insert history
                        $send_mail = 0;
                        if($bid_system == "AUTOBID" )
                        {
                            
                            $highest_bidder = 1;
                            $bid_system = "AUTOBID";
                            $bidderid = Session::get('logger_id');
                            $auctionHistorys ="";
                            $auctionHistorys = AuctionHistory::where('product_id',$product_id)->where('bidder_id',$bidderid)->where('bidding_price',$bidcurrentprice)->where('product_return','=',0)->get();
                            if(count($auctionHistorys)==0)
                            {
                                $bid_system = "AUTOBID";
                                $id = AuctionHistory::insertGetId([ 
                                    'auction_no'=>$auctionproduct->product_no,
                                    'product_id'=>$product_id,
                                    'bidder_id'=>$bidderid,
                                    'bidding_price' => $bidcurrentprice,
                                    'bid_system' => "AUTOBID",
                                    'highest_bidder' => $highest_bidder,
                                    'bid_time' => Carbon::now(),
                                    'created_at' => Carbon::now(),
                                ]);
                                if($id !="")
                                {
                                    Skauction_histories::insertGetId([ 	
                                        'auctionhistoryid' => $id,	
                                        'created_at'=> Carbon::now(),
                                    ]);
                                    $this->bid_confirm_mail($bidderid,$auctionproduct,$bidcurrentprice,$bid_system);
                                    $send_mail = 1;
                                }
                            }
                            
                        }
                        $highest_bidder = 1;
                        $bidding_price = (double)$auction_max_bid_amount + (double)$bid_increase_decrease_price;
                        $bidderid = Session::get('logger_id');
                        $auctionHistorys ="";
                        $auctionHistorys = AuctionHistory::where('product_id',$product_id)->where('bidder_id',$bidderid)->where('bidding_price',$bidding_price)->where('product_return','=',0)->get();
                        if(count($auctionHistorys)==0)
                        {
                            $id = AuctionHistory::insertGetId([ 
                                'auction_no'=>$auctionproduct->product_no,
                                'product_id'=>$product_id,
                                'bidder_id'=>$bidderid,
                                'bidding_price' => $bidding_price,
                                'bid_system' => $bid_system,
                                'highest_bidder' => $highest_bidder,
                                'bid_time' => Carbon::now(),
                                'created_at' => Carbon::now(),
                            ]);
                            if($id !="")
                            {
                                Skauction_histories::insertGetId([ 	
                                    'auctionhistoryid' => $id,	
                                    'created_at'=> Carbon::now(),
                                ]);
                                if($send_mail == 0)
                                {
                                    $this->bid_confirm_mail($bidderid,$auctionproduct,$bidding_price,$bid_system);
                                }
                                
                            }
                      
                        }
                    
                        return redirect()->route('auction.bidstatus', [$product_id,$bidcurrentprice,$bidstatus]);
                    }
                    else if($bidcurrentprice == $auction_max_autobid_amount)
                    {
                        //AUTBID time update
                        $bidderid = Session::get('logger_id');
                        $historyrecord ="";
                        $historyrecord = AuctionHistory::where('product_id',$product_id)->where('product_return',0)->where('bidding_price',$bidcurrentprice)->where('bidder_id',$auction_max_bidder_id)->orderby('id','desc')->get();
                        if(count($historyrecord)>0)
                        {
                            if(count($historyrecord)==1)
                            {
                                if($historyrecord[0]->bid_system == "AUTOBID")
                                {
                                    AuctionHistory::find($historyrecord[0]->id)->update([
                                        'bid_time'=>Carbon::now(),
                                        'updated_at'=>Carbon::now(),
                                    ]);
                                }
                            }
                            else if(count($historyrecord)>1)
                            {
                                if($historyrecord[0]->bid_system == "AUTOBID")
                                {
                                    AuctionHistory::find($historyrecord[0]->id)->update([
                                        'bid_time'=>Carbon::now(),
                                        'updated_at'=>Carbon::now(),
                                    ]);
                                }
                                if($historyrecord[1]->bid_system == "AUTOBID")
                                {
                                    AuctionHistory::find($historyrecord[1]->id)->update([
                                        'bid_time'=>Carbon::now(),
                                        'updated_at'=>Carbon::now(),
                                    ]);
                                }
                            }
                        }
                        

                        if(Session::get('logger_id') == $auction_max_bidder_id)
                        {
                            if((double)$bidcurrentprice >= (double)$auction_max_bid_amount)
                            {
                                $this->auction();
                            }
                            else
                            {
                                $bid_system = "BID";
                            }
                        }

                        $bidstatus =0; //hight bidder
                        $total_bids =  $auctionproduct->total_bids + 1;
                       
                        $need_to_pay = $auction_max_autobid_amount ;
                        ////software bid
                        Product::find($product_id)->update([
                            'auction_max_autobid_amount' =>0,
                            'auction_max_bid_amount'=> $auction_max_autobid_amount,
                            'auction_max_bidder_id'=> $auction_max_bidder_id, //Session::get('logger_id'),
                            'auction_2ndmax_bid_amount'=> $bidcurrentprice, //previous max bid amount
                            'auction_2ndmax_bidder_id' => Session::get('logger_id'), //previous max bidder id
                            'total_bids' => $total_bids,
                            'bidding_result' =>'yes',
                            'need_to_pay' => $need_to_pay,
                            'bidders'=> $bidderlist,
                        ]);
                        
                        $send_mail = 0;
                        $highest_bidder = 1;
                        $tempprice = $bidcurrentprice;
                        $bidcurrentprice = $auction_max_autobid_amount;
                        $bidderid = $auction_max_bidder_id;
                        $auctionHistorys ="";
                        $auctionHistorys = AuctionHistory::where('product_id',$product_id)->where('bidder_id',$bidderid)->where('bidding_price',$bidcurrentprice)->where('product_return','=',0)->get();
                        if(count($auctionHistorys)==0)
                        {
                            $bid_system = "AUTOBID";
                            $id = AuctionHistory::insertGetId([ 
                                'auction_no'=>$auctionproduct->product_no,
                                'product_id'=>$product_id,
                                'bidder_id'=>$bidderid,
                                'bidding_price' => $bidcurrentprice,
                                'bid_system' => "AUTOBID",
                                'highest_bidder' => $highest_bidder,
                                'bid_time' => Carbon::now(),
                                'created_at' => Carbon::now(),
                            ]);
                            if($id !="")
                            {
                                Skauction_histories::insertGetId([ 	
                                    'auctionhistoryid' => $id,	
                                    'created_at'=> Carbon::now(),
                                ]);
                                $this->bid_confirm_mail($bidderid,$auctionproduct,$bidcurrentprice,$bid_system);
                                $send_mail = 1;
                            }
                        }
                        
                        //current bidder bid
                        //bid for bidder
                        Product::find($product_id)->update([
                            'total_bids' => $total_bids + 1,
                        ]);
                        $highest_bidder = 0;
                        $bidcurrentprice = $tempprice;
                        $bidderid = Session::get('logger_id');
                        $auctionHistorys ="";
                        $auctionHistorys = AuctionHistory::where('product_id',$product_id)->where('bidder_id',$bidderid)->where('bidding_price',$bidcurrentprice)->where('product_return','=',0)->get();
                        if(count($auctionHistorys)==0)
                        {
                            $bid_system = "BID";
                            $id = AuctionHistory::insertGetId([ 
                                'auction_no'=>$auctionproduct->product_no,
                                'product_id'=>$product_id,
                                'bidder_id'=>$bidderid,
                                'bidding_price' => $bidcurrentprice,
                                'bid_system' => "BID",
                                'highest_bidder' => $highest_bidder,
                                'bid_time' => Carbon::now(),
                                'created_at' => Carbon::now(),
                            ]);
                            if($id !="")
                            {
                                Skauction_histories::insertGetId([ 	
                                    'auctionhistoryid' => $id,	
                                    'created_at'=> Carbon::now(),
                                ]);
                                if($send_mail == 0)
                                {
                                    $this->bid_confirm_mail($bidderid,$auctionproduct,$bidcurrentprice,$bid_system);
                                }
                                
                            }
                        }
                        
                    
                        return redirect()->route('auction.bidstatus', [$product_id,$bidcurrentprice,$bidstatus]);
                    }
                    else if($bidcurrentprice < $auction_max_autobid_amount && $bidcurrentprice > $auction_max_bid_amount)
                    {
                        /////Do bid for auction_max_bidder_id////////
                        if(Session::get('logger_id') == $auction_max_bidder_id)
                        {
                            if((double)$bidcurrentprice >= (double)$auction_max_bid_amount)
                            {
                                $this->auction();
                            }
                            else
                            {
                                $bid_system = (double)$bidcurrentprice > ((double)$auction_max_bid_amount  + (double)$bid_increase_decrease_price)? "AUTOBID":"BID";
                            }
                        }

                        $bid_system = "BID";
                        $bidstatus =0; //hight bidder
                        //$total_bids =  $auctionproduct->total_bids + 1;
                        $total_bids =  $auctionproduct->total_bids;
                        if(Session::get('logger_id') != $auction_max_bidder_id)
                        {
                            $total_bids =  $auctionproduct->total_bids + 1;
                        }
                        $need_to_pay = (double)$bidcurrentprice + $bid_increase_decrease_price;
                        
                        //product update for auction_max_bidder
                        if($auction_max_autobid_amount >= $need_to_pay)
                        {
                            //software bid
                            Product::find($product_id)->update([
                                'auction_max_bid_amount'=> $need_to_pay,
                                'auction_max_bidder_id'=> $auction_max_bidder_id, 
                                'auction_2ndmax_bid_amount'=> $bidcurrentprice, 
                                'auction_2ndmax_bidder_id' => Session::get('logger_id'), 
                                'total_bids' => $total_bids,
                                'bidding_result' =>'yes',
                                'need_to_pay' => $need_to_pay,
                                'bidders'=> $bidderlist,
                            ]);

                            $bidderid = $auction_max_bidder_id;
                            $historyrecord = "";
                            $historyrecord = AuctionHistory::where('product_id',$product_id)->where('bidding_price',$need_to_pay)->where('bidder_id',$bidderid)->get();
                            if(count($historyrecord)==0)
                            {
                                $id = "";
                                $id = AuctionHistory::insertGetId([ 
                                    'auction_no'=>$auctionproduct->product_no,
                                    'product_id'=>$product_id,
                                    'bidder_id'=> $auction_max_bidder_id,
                                    'bidding_price' => $need_to_pay,
                                    'bid_system' =>  "AUTOBID",
                                    'highest_bidder' =>1,
                                    'bid_time' => Carbon::now(),
                                    'created_at' => Carbon::now(),
                                ]);
                                Skauction_histories::insertGetId([ 	
                                    'auctionhistoryid' => $id,	
                                    'created_at'=> Carbon::now(),
                                ]);
                                //$this->bid_confirm_mail($auction_max_bidder_id,$auctionproduct,$need_to_pay);
                            }
							// else
                            // {
                            //     //dd('problem');
                            //     //update auction_max_bidder bid_time
                            //     if($historyrecord[0]->bid_system == "AUTOBID")
                            //     {
                            //         AuctionHistory::find($historyrecord[0]->id)->update([
                            //             'bid_time'=>Carbon::now(),
                            //             'updated_at'=>Carbon::now(),
                            //         ]);
                            //     }
                            // }
                            
                            //bid for bidder
                            Product::find($product_id)->update([
                                'total_bids' => $total_bids + 1,
                            ]);

                            $bidderid = Session::get('logger_id');
                            $historyrecord ="";
                            $historyrecord = AuctionHistory::where('product_id',$product_id)->where('bidding_price',$bidcurrentprice)->where('bidder_id',$bidderid)->get();
                            if(count($historyrecord)==0)
                            {
                                $bid_system = 'BID';
                                $id = AuctionHistory::insertGetId([ 
                                    'auction_no'=>$auctionproduct->product_no,
                                    'product_id'=>$product_id,
                                    'bidder_id'=> Session::get('logger_id'),
                                    'bidding_price' => $bidcurrentprice,
                                    'bid_system' => 'BID',
                                    'highest_bidder' =>0,
                                    'bid_time' => Carbon::now(),
                                    'created_at' => Carbon::now(),
                                ]);
                                Skauction_histories::insertGetId([ 	
                                    'auctionhistoryid' => $id,	
                                    'created_at'=> Carbon::now(),
                                ]);
                                $this->bid_confirm_mail(Session::get('logger_id'),$auctionproduct,$bidcurrentprice,$bid_system);
                            }
                        }
                        else
                        {
                            //software bid
                            Product::find($product_id)->update([
                                'auction_max_bid_amount'=> $auction_max_autobid_amount,
                                'auction_max_bidder_id'=> $auction_max_bidder_id, //Session::get('logger_id'),
                                'auction_2ndmax_bid_amount'=> $bidcurrentprice, //previous max bid amount
                                'auction_2ndmax_bidder_id' => Session::get('logger_id'), //previous max bidder id
                                'total_bids' => $total_bids,
                                'bidding_result' =>'yes',
                                'need_to_pay' => $need_to_pay,
                                'bidders'=> $bidderlist,
                            ]);
                            
                            $bidderid = $auction_max_bidder_id;
                            $historyrecord ="";
                            $historyrecord = AuctionHistory::where('product_id',$product_id)->where('bidding_price',$auction_max_autobid_amount)->where('bidder_id',$bidderid)->get();
                            if(count($historyrecord)==0)
                            {
                                $bid_system = 'AUTOBID';
                                $id = "";
                                $id = AuctionHistory::insertGetId([ 
                                    'auction_no'=>$auctionproduct->product_no,
                                    'product_id'=>$product_id,
                                    'bidder_id'=> $auction_max_bidder_id,
                                    'bidding_price' => $auction_max_autobid_amount,
                                    'bid_system' => 'AUTOBID',
                                    'highest_bidder' =>1,
                                    'bid_time' => Carbon::now(),
                                    'created_at' => Carbon::now(),
                                ]);
                                Skauction_histories::insertGetId([ 	
                                    'auctionhistoryid' => $id,	
                                    'created_at'=> Carbon::now(),
                                ]);
                                //$this->bid_confirm_mail($auction_max_bidder_id,$auctionproduct,$auction_max_autobid_amount,$bid_system);
                            }
                            // else
                            // {
                            //     //update auction_max_bidder bid_time
                            //     if($historyrecord[0]->bid_system == "AUTOBID")
                            //     {
                            //         AuctionHistory::find($historyrecord[0]->id)->update([
                            //             'bid_time'=>Carbon::now(),
                            //             'updated_at'=>Carbon::now(),
                            //         ]);
                            //     }
                            // }
                            
                            //bid for bidder
                            Product::find($product_id)->update([
                                'total_bids' => $total_bids + 1,
                            ]);

                            $bidderid = Session::get('logger_id');
                            $historyrecord ="";
                            $historyrecord = AuctionHistory::where('product_id',$product_id)->where('bidding_price',$bidcurrentprice)->where('bidder_id',$bidderid)->get();
                            if(count($historyrecord)==0)
                            {
                                $bid_system = 'BID';
                                $id = "";
                                $id = AuctionHistory::insertGetId([ 
                                    'auction_no'=>$auctionproduct->product_no,
                                    'product_id'=>$product_id,
                                    'bidder_id'=> Session::get('logger_id'), 
                                    'bidding_price' => $bidcurrentprice,
                                    'bid_system' => 'BID',
                                    'highest_bidder' =>0,
                                    'bid_time' => Carbon::now(),
                                    'created_at' => Carbon::now(),
                                ]);
                                Skauction_histories::insertGetId([ 	
                                    'auctionhistoryid' => $id,	
                                    'created_at'=> Carbon::now(),
                                ]);
                                $this->bid_confirm_mail(Session::get('logger_id'),$auctionproduct,$bidcurrentprice,$bid_system);
                            }
                        }
                    
                        return redirect()->route('auction.bidstatus', [$product_id,$bidcurrentprice,$bidstatus]);
                    }
                }
                else if($bidcurrentprice == $auction_max_bid_amount )
                {
                    return $this->auction();  //do nothing, just return back if time not ok
                    //below or equal to auction_max_bid_amount, do nothing (chika chan)
                    //return redirect()->route('auction.bidstatus', [$product_id,$bidcurrentprice,$bidstatus]);

                }
            }

        }
        else
        {
            return $this->auction();  //do nothing, just return back if time not ok
        }
    }

    ///////bid status after bid confirmation////////
    public function bidstatus($product_id,$currentprice,$status)
    {
        //auto increase end_time_of_auction if required during bidding
        $this->auction_time_increase($product_id);

        $auctionproduct = Product::findOrFail($product_id);
        if(is_array($auctionproduct) && count($auctionproduct)==0){return redirect()->route('woody.auction');}  //error handling

        $auction_start = $auctionproduct->auction_start; //db
        $auction_end = $auctionproduct->auction_end;

        
        $auction_max_bidder_id = $auctionproduct->auction_max_bidder_id;
        $auction_max_bid_amount = $auctionproduct->auction_max_bid_amount;

        $auction_max_autobid_amount = $auctionproduct->auction_max_autobid_amount;
        

        $auctionno = $auctionproduct->product_no;
        $productimage = $auctionproduct->thumbnail_sm_image;
        $modelno = $auctionproduct->model_no;
        $serialno = $auctionproduct->serial_no;
        $bid_system = $auctionproduct->bid_system;

        $bidder_id = Session::get('logger_id');
        $loginstatus = Session::get('loginstatus');

        if($auction_max_autobid_amount >= $auction_max_bid_amount && $loginstatus == 1 && $auction_max_bidder_id == $bidder_id)
        { //dd('1');
            $auction_history = AuctionHistory::with('product','bidder')
                                        ->where('product_id',$product_id)
                                        //->where('bidding_price','<=',$auction_max_autobid_amount)
                                        //->where('bidding_price','<=',$auction_max_bid_amount)
                                        ->where('product_return','=',0)
                                        ->where('bid_time','>=',$auction_start)
                                        //->whereBetween('bid_time',[$auction_start,$auction_end])
                                        ->orderby('bidding_price','desc')->get();
        }
        else if($auction_max_autobid_amount < $auction_max_bid_amount && $loginstatus == 1 && $auction_max_bidder_id != $bidder_id)
        {//dd('2');
            $auction_history = AuctionHistory::with('product','bidder')
                                        ->where('product_id',$product_id)
                                        ->where('bidding_price','<=',$auction_max_bid_amount)
                                        ->where('product_return','=',0)
                                        ->where('bid_time','>=',$auction_start)
                                        //->whereBetween('bid_time',[$auction_start,$auction_end])
                                        ->orderby('bidding_price','desc')->get();
                                        
        }
        else
        {//dd('3');
            $auction_history = AuctionHistory::with('product','bidder')
                                        ->where('product_id',$product_id)
                                        ->where('bidding_price','<=',$auction_max_bid_amount)
                                        ->where('product_return','=',0)
                                        ->where('bid_time','>=',$auction_start)
                                        //->whereBetween('bid_time',[$auction_start,$auction_end])
                                        ->orderby('bidding_price','desc')->get();
        }
        
        

        //$bidder_id = Session::get('logger_id'); 
        $Bidder = Bidder_register::findOrFail($bidder_id);    
        $biddercodeno = $Bidder->usercodeno;
        $biddername = $Bidder->name;

        $bidstatus = $status;

        $page =$this->get_pageurl('fontend.en.bid_after_confirmation','fontend.jp.bid_after_confirmation');
        $pagelanguage = $this->get_pagelanguage();
        return view($page,compact('auctionno','product_id','productimage','modelno','serialno','bidder_id','auction_max_bidder_id','biddercodeno','biddername','bidstatus','auction_history','bid_system','pagelanguage'));
    }

    //addToWatchlist
    public function addToWatchlist(Request $request)
    {
        $bidder_id = Session::get('logger_id'); 
        if($bidder_id !="")
        {
            $bidder_info = Bidder_register::findOrFail($bidder_id);
            $selected_product_list = "";
            $selected_product_list = $bidder_info->selection;
            if($selected_product_list !="")
            {
                $selected_product = explode(",",$selected_product_list);
                if(!in_array($request->product_id, $selected_product))
                {
                    $selected_product_list .=','.$request->product_id;
                    Bidder_register::findOrFail($bidder_id)->update([
                        "selection" => $selected_product_list,
                    ]);
                    return response()->json(array(
                        'selection_status' => "Added in selection",
                        'alert-type'=>'success'
                    )); 
                }
                else{
                    return response()->json(array(
                        'selection_status' => "Already added in selection",
                        'alert-type'=>'success'
                    )); 
                }
            }
            else
            {
                $selected_product_list = $request->product_id;
                Bidder_register::findOrFail($bidder_id)->update([
                    "selection" => $selected_product_list,
                ]);
                return response()->json(array(
                    'selection_status' => "Added in selection",
                    'alert-type'=>'success'
                ));
            }
        }
        else{
            return response()->json(array(
                'selection_status' => "Please, Logging first",
                'alert-type'=>'error'
            ));
        }
    }
    //removeFromWatchlist
    public function removeFromWatchlist(Request $request)
    {
        $bidder_id = Session::get('logger_id'); 
        if($bidder_id !="")
        {
            $bidder_info = Bidder_register::findOrFail($bidder_id);
            $selected_product_list = "";
            $selected_product_list = $bidder_info->selection;
            if($selected_product_list !="")
            {
                $searchForValue = ',';
                
                $selected_product = explode(",",$selected_product_list);
                
                if(in_array($request->product_id, $selected_product))
                {
                    $productidstring ="";
                    $count = count($selected_product);
                    if($count == 1)
                    {
                        Bidder_register::findOrFail($bidder_id)->update([
                            "selection" => "",
                        ]);
                        return response()->json(array(
                            'selection_status' => "Removed in selection",
                            'alert-type'=>'success'
                        ));
                    }
                    else
                    {
                        for($i=0; $i< count($selected_product);$i++)
                        {
                            if($selected_product[$i] != $request->product_id)
                            {
                                if($productidstring =="")
                                {
                                    $productidstring = $selected_product[$i];
                                }
                                else{
                                    $productidstring .= ",".$selected_product[$i];
                                }
                            }
                        }
                        Bidder_register::findOrFail($bidder_id)->update([
                            "selection" => $productidstring,
                        ]);
                        return response()->json(array(
                            'selection_status' => "Removed in selection",
                            'alert-type'=>'success'
                        ));
                    }
                    
                }
            }
        }
        else{
            return response()->json(array(
                'selection_status' => "Please, Logging first",
                'alert-type'=>'error'
            ));
        }
    }

    //auction selected_product
    public function selected_product() 
    {
        //$page =$this->get_pageurl('fontend.en.auction_product','fontend.jp.auction_product');
        $page = $this->auction_page();
        $pagelanguage = $this->get_pagelanguage();

        $deliveryplaces = Delivery_place::latest()->paginate(25);

        $bidder_id = Session::get('logger_id'); 
        $auction =  Auction::where('status',1)->get(); 
        //$selectedmenu = "1";

        if($bidder_id !="")
        {
            $bidder_info = Bidder_register::findOrFail($bidder_id);
            $selected_product_list = "";
            $selected_product_list = $bidder_info->selection;
            if($selected_product_list !="")
            {
                $selected_product = explode(",",$selected_product_list);
                $auctionproducts = Product::where('auction_product',1)->where('auction_id',$auction[0]->id)->whereIn('id',$selected_product)->paginate(30); 
                return view($page,compact('auctionproducts','pagelanguage','deliveryplaces'));
            }
            else
            {
                $auctionproducts = Product::where('auction_product',1)->where('auction_id',$auction[0]->id)->where('id',0)->paginate(30);
                return view($page,compact('auctionproducts','pagelanguage','deliveryplaces'));
            }
        }
        else
        {
            //$auctionproducts = Product::where('auction_product',1)->where('final_result','unsold')->paginate(30);
            //$auctionproducts = Product::where('auction_product',1)->where('auction_id',$auction[0]->id)->where('final_result','unsold')->paginate(30);
            $auctionproducts = Product::where('auction_product',1)->where('auction_id',$auction[0]->id)->where('id',0)->paginate(30);
            return view($page,compact('auctionproducts','pagelanguage','deliveryplaces'));
        }
    }

    //auction selected_product
    public function selected_product_result() 
    {
        //$page =$this->get_pageurl('fontend.en.auction_product','fontend.jp.auction_product');
        $page = $this->auction_page();
        $pagelanguage = $this->get_pagelanguage();

        $deliveryplaces = Delivery_place::latest()->paginate(25);

        $bidder_id = Session::get('logger_id'); 
        $auction =  Auction::where('status',1)->get(); 

        if($bidder_id !="")
        {
            $bidder_info = Bidder_register::findOrFail($bidder_id);
            $selected_product_list = "";
            $selected_product_list = $bidder_info->selection;
            if($selected_product_list !="")
            {
                $selected_product = explode(",",$selected_product_list);
                $auctionproducts = Product::where('auction_product',1)->where('auction_id',$auction[0]->id)->whereIn('id',$selected_product)->where('final_result','sold')->paginate(30); 
                return view($page,compact('auctionproducts','pagelanguage','deliveryplaces'));
            }
            else{
                $auctionproducts = Product::where('auction_product',1)->where('auction_id',$auction[0]->id)->where('final_result','unsold')->paginate(30);
                return view($page,compact('auctionproducts','pagelanguage','deliveryplaces'));
            }
        }
        else{
            $auctionproducts = Product::where('auction_product',1)->where('auction_id',$auction[0]->id)->where('final_result','unsold')->paginate(30);
            return view($page,compact('auctionproducts','pagelanguage','deliveryplaces'));
        }
    }

    //all_product of auction
    public function all_product()
    {
        return $this->auction();
    }
    //new_today product added in auction
    public function new_today()
    {
        $today = date('m/d/Y', strtotime(Carbon::now())); 
        $auction =  Auction::where('status',1)->get(); 
        $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('start_time_of_auction','like','%' .$today. '%')->paginate(30);
        //$page =$this->get_pageurl('fontend.en.auction_product','fontend.jp.auction_product');
        $page = $this->auction_page();
        $pagelanguage = $this->get_pagelanguage();
        $deliveryplaces = Delivery_place::latest()->get();
        $selectedmenu = "1"; //0 all, 1 new today, 2 end soon
        return view($page,compact('auctionproducts','pagelanguage','deliveryplaces','selectedmenu'));
    }
    public function end_today()
    {
        $today = date('m/d/Y', strtotime(Carbon::now())); 
        $auction =  Auction::where('status',1)->get(); 
        $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('end_time_of_auction','like','%' .$today. '%')->paginate(30);
        //$page =$this->get_pageurl('fontend.en.auction_product','fontend.jp.auction_product');
        $page = $this->auction_page();
        $pagelanguage = $this->get_pagelanguage();
        $deliveryplaces = Delivery_place::latest()->get();
        $selectedmenu = "2"; //0 all, 1 new today, 2 end soon
        return view($page,compact('auctionproducts','pagelanguage','deliveryplaces','selectedmenu'));
    }

    //auction terms and condition
    public function termsandcondition()
    {
        $page =$this->get_pageurl('fontend.en.terms_and_condition','fontend.jp.terms_and_condition');
        $pagelanguage = $this->get_pagelanguage();
        
        return view($page);
    }

    ///search by keyword////
    public function search(Request $request)
    { //model auctionno deliveryarea
        //dd($request->deliveryarea);
        $auction =  Auction::where('status',1)->get(); 

        $auctionproducts = array();
        if($request->model !=""){
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('model_no','like', '%'.$request->model.'%')->where('auction_product', 1)->where('final_result', 'unsold')->paginate(30);  //dd($auctionproducts);
        }
        else if($request->auctionno !=""){
            $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('product_no','like', '%'.$request->auctionno.'%')->where('auction_product', 1)->where('final_result', 'unsold')->paginate(30);  //dd($auctionproducts);
        }
        else if($request->deliveryarea !="")
        {
            if($request->deliveryarea == "all")
            {
                $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('auction_product', 1)->where('final_result', 'unsold')->paginate(30);  //dd($auctionproducts);
            }
            else
            {
                $auctionproducts = Product::where('auction_id',$auction[0]->id)->where('delivery_place_id','like', $request->deliveryarea)->where('auction_product', 1)->where('final_result', 'unsold')->paginate(30);  //dd($auctionproducts);
            }
            
        }
        
        //$auctionproducts = Product::where('model_no','like', '%'.$request->model.'%')->orWhere('product_no','like', '%'.$request->auctionno.'%')->orWhere('delivery_place','like', '%'.$request->deliveryarea.'%')->paginate(30);  //dd($products);

        
        $search_model = $request->model;
        $search_auctionno = $request->auctionno;
        $search_deliveryarea = $request->deliveryarea;

        //$page =$this->get_pageurl('fontend.en.auction_product','fontend.jp.auction_product');
        $page = $this->auction_page();
        $pagelanguage = $this->get_pagelanguage();
        $deliveryplaces = Delivery_place::latest()->paginate(25);
        $selectedmenu = "0"; //0 all, 1 new today, 2 end soon
        return view($page,compact('auctionproducts','pagelanguage','deliveryplaces','selectedmenu','search_model','search_auctionno','search_deliveryarea'));
    }
    
    //auction final result
    public function auction_final_result($id)
    {
        $actionpro = Product::where('id',$id)->get();  
        if(is_array($actionpro) && count($actionpro)==0){return redirect()->route('woody.auction');}  //error handling
        //dd($actionpro);
        /////timeleft calculation start/////
        $auction_startdate = strtotime($actionpro[0]->start_time_of_auction);
        $auction_enddate = strtotime($actionpro[0]->end_time_of_auction);
        $today_date = strtotime(Carbon::now());
        $timeduration="";
        $day = 86400;
        $hour = 3600;
        $minute = 60;
        $daysout=0;
        $hoursout=0;
        $minutesout=0;
        $secondsout =0;
        $timeleft="";
        if($today_date < $auction_startdate)
        {
            //start - end
            $timeduration =  $auction_enddate - $auction_startdate;

            if($timeduration <=0){$timeleft = 0;}
            else{
                $daysout = floor($timeduration / $day);
                $hoursout = floor(($timeduration - $daysout * $day)/$hour);
                $minutesout = floor(($timeduration - $daysout * $day - $hoursout * $hour)/$minute);
                //$secondsout = $timeduration - $daysout * $day - $hoursout * $hour - $minutesout * $minute;
                if($daysout>0){$timeleft=$daysout."d";}
                if($hoursout>0){$timeleft.="/".$hoursout."h/";}
                if($minutesout>0){$timeleft.=$minutesout."m";}
            }
        }
        else if($today_date >= $auction_startdate && $today_date < $auction_enddate)
        {
            //end - today
            $timeduration =  $auction_enddate - $today_date;

            if($timeduration <=0){$timeleft = 0;}
            else
            {
                $daysout = floor($timeduration / $day);
                $hoursout = floor(($timeduration - $daysout * $day)/$hour);
                $minutesout = floor(($timeduration - $daysout * $day - $hoursout * $hour)/$minute);
                //$secondsout = $timeduration - $daysout * $day - $hoursout * $hour - $minutesout * $minute;
                if($daysout>0){$timeleft=$daysout."d";}
                if($hoursout>0){$timeleft.="/".$hoursout."h/";}
                if($minutesout>0){$timeleft.= $minutesout."m";}
            }
            
        }
        else {
            //old dated
            $timeleft = 0;
            
        }
        /////timeleft calculation end/////

        if($timeleft == 0 && $actionpro[0]->total_bids >0 && $today_date >= $auction_enddate && $actionpro[0]->auction_max_bidder_id !=0)
        {
            //update product auction
            Product::findOrFail($id)->update([
                'final_result' => 'sold',
                'updated_at' => Carbon::now(),
            ]);
            
            /////send win mail to the maximum bidder////
            $product_max_bidder_id = $actionpro[0]->auction_max_bidder_id;
            $bidder = Bidder_register::findOrFail($product_max_bidder_id);  
            $bidder_email1 = $bidder['email1'];  
            $bidder_email2 = $bidder['email2'];
            $companyname = $bidder['company_name'];
            $person_incharge = $bidder['person_incharge'];
            $biddercode = $bidder['usercodeno'];

            $data = [
                'companyname' => $companyname,
                'person_incharge' => $person_incharge,
                'biddercode' => $biddercode,
                'auctionno' => $actionpro[0]->product_no,
                'name_en' => $actionpro[0]->name_en,
                'name_jp' => $actionpro[0]->name_jp,
                'thumbnail_image' => $actionpro[0]->thumbnail_image,
                'thumbnail_sm_image' => $actionpro[0]->thumbnail_sm_image,
                'product_no' => $actionpro[0]->product_no,
                'end_time_of_auction' => $actionpro[0]->end_time_of_auction,
                'bid_max_price' => $actionpro[0]->auction_max_bid_amount,
                'modelno' => $actionpro[0]->model_no,
                'serial_no' =>$actionpro[0]->serial_no,
                'model_year' => $actionpro[0]->model_year,
                'used_hour' => $actionpro[0]->used_hour,
                'deliveryplace' => $actionpro[0]->delivery->name_jp,
                //'message' => $actionpro[0]->message,
            ];
            
            Mail::to($bidder_email1)->send(new auctionBidOwnMail($data));
            
            $notification=array(
                'message'=>'Mail Sent...',
                'alert-type'=>'success'
            );
    
            return response()->json($notification);
        }

    }

    ////Time increase for bidding
    public function auction_time_increase($id)
    {
        $actionpro = Product::find($id);     //dd($actionpro->start_time_of_auction);
        /////timeleft calculation start/////
        $auction_startdate = strtotime($actionpro->start_time_of_auction);
        $auction_enddate = strtotime($actionpro->end_time_of_auction);
        $today_date = strtotime(Carbon::now());
        $timeduration="";
        $day = 86400;
        $hour = 3600;
        $minute = 60;
        $daysout=0;
        $hoursout=0;
        $minutesout=0;
        $secondsout =0;
        $timeleft="";
        //start - end
        //$timeduration =  $auction_enddate - $auction_startdate;

        if($today_date > $auction_startdate && $today_date < $auction_enddate)
        {
            // if($auction_enddate - $today_date > 120 && $auction_enddate - $today_date <= 180)
            // {
            //     $newEndTime = date("Y-m-d H:i:s",strtotime("+3 minutes", $auction_enddate));  
            //     Product::findOrFail($id)->update([
            //         'end_time_of_auction' => $newEndTime,
            //         'updated_at' => Carbon::now(),
            //     ]);
            // }
            // else if($auction_enddate - $today_date >= 1 && $auction_enddate - $today_date <= 120)
            // {
            //     $newEndTime = date("Y-m-d H:i:s",strtotime("+2 minutes", $auction_enddate));  
            //     Product::findOrFail($id)->update([
            //         'end_time_of_auction' => $newEndTime,
            //         'updated_at' => Carbon::now(),
            //     ]);
            // }
            // else if($auction_enddate - $today_date > 240 && $auction_enddate - $today_date <= 300)
            // {
            //     $newEndTime = date("Y-m-d H:i:s",strtotime("+5 minutes", $auction_enddate));  
            //     Product::findOrFail($id)->update([
            //         'end_time_of_auction' => $newEndTime,
            //         'updated_at' => Carbon::now(),
            //     ]);
            // }

            if($auction_enddate - $today_date > 0 && $auction_enddate - $today_date <= 180)
            {
                $timecount = $actionpro->timecount;
                if($timecount == 0)
                {
                    $newEndTime = date("Y-m-d H:i:s",strtotime("+3 minutes", $auction_enddate));  
                    Product::findOrFail($id)->update([
                        'end_time_of_auction' => $newEndTime,
                        'timecount' =>1,
                        'updated_at' => Carbon::now(),
                    ]);
                }
                else if($timecount == 1)
                {
                    $newEndTime = date("Y-m-d H:i:s",strtotime("+2 minutes", $auction_enddate));  
                    Product::findOrFail($id)->update([
                        'end_time_of_auction' => $newEndTime,
                        'timecount' =>1,
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }

        }
    }

    ////time_check if not exist close auction
    ///get result sold/unsold 
    public function time_check(Request $request)
    {
        $product_id = $request->product_id;  
        $actionpro = Product::where('id',$product_id)->get();  //dd($actionpro);
        
        

        /////timeleft calculation start/////
        $auction_startdate = strtotime($actionpro[0]['start_time_of_auction']);   
        $auction_enddate = strtotime($actionpro[0]['end_time_of_auction']);
        $today_date = strtotime(Carbon::now());
        $timeduration="";
        $day = 86400;
        $hour = 3600;
        $minute = 60;
        $daysout=0;
        $hoursout=0;
        $minutesout=0;
        $secondsout =0;
        $timeleft="";
        //start - end
        $timeduration =  $auction_enddate - $auction_startdate;    

        

        if($timeduration !=0 && $today_date >= $auction_enddate && $actionpro[0]['final_result'] !='sold' && $actionpro[0]['total_bids']>0)
        {
            Product::findOrFail($product_id)->update([
                'final_result' => 'sold',
                'updated_at' => Carbon::now(),
            ]);

            //mailing System Start
            //send win mail to winner bidder (auction_max_bidder_id)
            $auction_max_bidder_id ="";
            $auction_max_bidder_id = $actionpro[0]['auction_max_bidder_id'];

            $bidderinfo = Bidder_register::where('status','active')->get();
            if($auction_max_bidder_id !="")
            {
                //$this->auctionBidOwnMail($auction_max_bidder_id,$bidderinfo,$actionpro[0]);
                foreach($bidderinfo as $bidder)
                {
                    if($bidder->id == $auction_max_bidder_id)
                    {
                        $data = array();
                        $data['companyname'] = $bidder['company_name'];
                        $data['person_incharge'] = $bidder['person_incharge'];
                        $data['biddercode'] = $bidder['usercodeno'];
                        $data['auctionno'] = $actionpro[0]['product_no'];
                        $data['modelno'] = $actionpro[0]['model_no'];
                        $data['bid_max_price'] = $actionpro[0]['auction_max_bid_amount'];
                        $data['deliveryplace'] = $actionpro[0]->delivery->name_jp;

                        Mail::to($bidderinfo['email1'])->send(new auctionBidOwnMail($data));
                    }
                }
            }
            
            //send bid loss mail to loser bidder
            $bidderlist = "";
            $bidderlist = $actionpro[0]['bidders'];
            if($bidderlist !="")
            {
                $bidders = explode(",", $bidderlist);
                if(count($bidders)>0)
                {
                    $this->auctionBidLossMail($bidders,$bidderinfo,$actionpro[0]);
                }
            }
            //mailing System End

            return response()->json(array(
                'result' => "sold",
            ));
        }
        else if($timeduration !=0 && $today_date >= $auction_enddate && $actionpro[0]['final_result'] !='sold' && $actionpro[0]['total_bids']==0)
        {
            Product::findOrFail($product_id)->update([
                'auction_product' => 0,
                'updated_at' => Carbon::now(),
            ]);

            //clear zip file from the directory
            File::cleanDirectory('./uploads/zipfiles');

            return response()->json(array(
                'result' => "auction close",
            ));
        }

    }
    ///time check if not exist close auction
    ///get result sold/unsold
    public function auction_time_check()
    {  
        $actionpro = Product::where('auction_product',1)->where('final_result', '!=','sold')->get();   //dd($actionpro);
 
        //$actionpro[$i]['start_time_of_auction']
        
        /////timeleft calculation start/////
        for($i=0;$i<count($actionpro);$i++)
        {
            $auction_startdate = strtotime($actionpro[$i]['start_time_of_auction']);   
            $auction_enddate = strtotime($actionpro[$i]['end_time_of_auction']);
            $today_date = strtotime(Carbon::now());
            $timeduration="";
            $day = 86400;
            $hour = 3600;
            $minute = 60;
            $daysout=0;
            $hoursout=0;
            $minutesout=0;
            $secondsout =0;
            $timeleft="";
            //start - end
            $timeduration =  $auction_enddate - $auction_startdate;    

            if($timeduration !=0 && $today_date >= $auction_enddate && $actionpro[$i]['final_result'] !='sold' && $actionpro[$i]['total_bids']>0)
            {
                Product::findOrFail($actionpro[$i]['id'])->update([
                    'final_result' => 'sold',
                    'updated_at' => Carbon::now(),
                ]);
                //send win mail to winner bidder (auction_max_bidder_id)
                $auction_max_bidder_id ="";
                $auction_max_bidder_id = $actionpro[$i]['auction_max_bidder_id'];

                $bidderinfo = Bidder_register::where('status','active')->get();
                if($auction_max_bidder_id !="")
                {
                    $this->auctionBidOwnMail($auction_max_bidder_id,$bidderinfo,$actionpro[$i]);
                }

                //send bid loss mail to loser bidder (auction_2ndmax_bidder_id)
                $bidderlist = "";
                $bidderlist = $actionpro[$i]['bidders'];
                if($bidderlist !="")
                {
                    $bidders = explode(",", $bidderlist);
                    if(count($bidders)>0)
                    {
                        $this->auctionBidLossMail($bidders,$bidderinfo,$actionpro[$i]);
                    }
                }

                return response()->json(array(
                    'result' => "sold",
                ));
            }
            else if($timeduration !=0 && $today_date >= $auction_enddate && $actionpro[$i]['final_result'] !='sold' && $actionpro[$i]['total_bids']==0)
            {
                Product::findOrFail($actionpro[$i]['id'])->update([
                    'auction_product' => 0,
                    'updated_at' => Carbon::now(),
                ]);
                //clear zip file from the directory
                File::cleanDirectory('./uploads/zipfiles');

                return response()->json(array(
                    'result' => "auction close",
                ));
            }
        }
    }


    //auctionBidOwnMail
    public function auctionBidOwnMail($auction_max_bidder_id,$bidderinfo,$actionpro)
    {
        foreach($bidderinfo as $bidder)
        {
            if($bidder->id == $auction_max_bidder_id)
            {
                $data = array();
                $data['companyname'] = $bidder['company_name'];
                $data['person_incharge'] = $bidder['person_incharge'];
                $data['biddercode'] = $bidder['usercodeno'];
                $data['auctionno'] = $actionpro['product_no'];
                $data['modelno'] = $actionpro['model_no'];
                $data['bid_max_price'] = $actionpro['auction_max_bid_amount'];
                $data['deliveryplace'] = $actionpro->delivery->name_jp;

                Mail::to($bidderinfo['email1'])->send(new auctionBidOwnMail($data));
            }
        }
    }

    //auctionBidLossMail
    public function auctionBidLossMail($bidders,$bidderinfo,$actionpro)
    {
        foreach($bidderinfo as $bidder)
        {
            for($i=0;$i<count($bidders);$i++)
            {
                $lossbidderid ="";
                if($actionpro['auction_max_bidder_id'] != $bidders[$i] && $bidders[$i] !="")
                {
                    if($bidder->id == $bidders[$i])
                    {
                        $data = array();
                        $data['companyname'] = $bidder['company_name'];
                        $data['person_incharge'] = $bidder['person_incharge'];
                        $data['biddercode'] = $bidder['usercodeno'];
                        $data['auctionno'] = $actionpro['product_no'];
                        $data['modelno'] = $actionpro['model_no'];
                        $data['bid_2nd_price'] = $actionpro['auction_2ndmax_bid_amount'];
                        $data['bid_max_price'] = $actionpro['auction_max_bid_amount'];
                
                        Mail::to($bidderinfo['email1'])->send(new auctionBidLossMail($data));
                    }
                }
            }
        }
    }

    ///////hide auction thats time 0///////
    public function generally_time_check()
    {  
        $actionpro = Product::where('auction_product',1)->where('final_result', '!=','sold')->get();   //dd($actionpro);
 
        //$actionpro[$i]['start_time_of_auction']
        
        /////timeleft calculation start/////
        for($i=0;$i<count($actionpro);$i++)
        {
            $auction_startdate = strtotime($actionpro[$i]['start_time_of_auction']);   
            $auction_enddate = strtotime($actionpro[$i]['end_time_of_auction']);
            $today_date = strtotime(Carbon::now());
            $timeduration="";
            $day = 86400;
            $hour = 3600;
            $minute = 60;
            $daysout=0;
            $hoursout=0;
            $minutesout=0;
            $secondsout =0;
            $timeleft="";
            //start - end
            $timeduration =  $auction_enddate - $auction_startdate;    

            if($timeduration !=0 && $today_date >= $auction_enddate && $actionpro[$i]['final_result'] !='sold' && $actionpro[$i]['total_bids']>0)
            {
                Product::findOrFail($actionpro[$i]['id'])->update([
                    'final_result' => 'sold',
                    'updated_at' => Carbon::now(),
                ]);
                //send win mail to winner bidder (auction_max_bidder_id)
                $auction_max_bidder_id ="";
                $auction_max_bidder_id = $actionpro[$i]['auction_max_bidder_id'];

                $bidderinfo = Bidder_register::where('status','active')->get(); 

                if($auction_max_bidder_id !="")
                {
                    $this->auctionBidOwnMail($auction_max_bidder_id,$bidderinfo,$actionpro[$i]);
                }

                //send bid loss mail to loser bidder (auction_2ndmax_bidder_id)
                $bidderlist = "";
                $bidderlist = $actionpro[$i]['bidders'];
                if($bidderlist !="")
                {
                    $bidders = explode(",", $bidderlist);
                    if(count($bidders)>0)
                    {
                        $this->auctionBidLossMail($bidders,$bidderinfo,$actionpro[$i]);
                    }
                }

                return response()->json(array(
                    'result' => "sold",
                ));
                
            }
            else if($timeduration !=0 && $today_date >= $auction_enddate && $actionpro[$i]['final_result'] !='sold' && $actionpro[$i]['total_bids']==0)
            {
                Product::findOrFail($actionpro[$i]['id'])->update([
                    'auction_product' => 0,
                    'updated_at' => Carbon::now(),
                ]);

                //clear zip file from the directory
                File::cleanDirectory('./uploads/zipfiles');

                return response()->json(array(
                    'result' => "auction close",
                ));

            }
        }
        

    }

    /////////////All Auction Related Documents/////////////////////////////
    public function bid_document()
    {
        $page =$this->get_pageurl('fontend.en.documents.agreement','fontend.jp.documents.agreement');
        return view($page);
    }
    public function bidding_style()
    {
        $page =$this->get_pageurl('fontend.en.documents.bidding_style','fontend.jp.documents.bidding_style');
        return view($page);
    }
    public function carry_out_of_equipment()
    {
        $page =$this->get_pageurl('fontend.en.documents.carry_out_of_equipment','fontend.jp.documents.carry_out_of_equipment');
        return view($page);
    }
    public function target_machines_selection()
    {
        $page =$this->get_pageurl('fontend.en.documents.target_machines_selection','fontend.jp.documents.target_machines_selection');
        return view($page);
    }
    public function log_in_and_bedding()
    {
        $page =$this->get_pageurl('fontend.en.documents.log_in_and_bedding','fontend.jp.documents.log_in_and_bedding');
        return view($page);
    }
    public function shipping_charge()
    {
        $page =$this->get_pageurl('fontend.en.documents.fob_and_washing_charge','fontend.jp.documents.fob_and_washing_charge');
        return view($page);
    }
    public function stolen_and_truble_case()
    {
        $page =$this->get_pageurl('fontend.en.documents.stolen_and_truble_case','fontend.jp.documents.stolen_and_truble_case');
        return view($page);
    }
    public function bid_result()
    {
        $page =$this->get_pageurl('fontend.en.documents.auction_result','fontend.jp.documents.auction_result');

        $auctiondata = Auction::where('result_show','=',1)->get(); 
        $auction_result = "";
        if(count($auctiondata)>0)
        {
            //$auction_date =  date('Y-m-d',strtotime(Auction::max('auction_end')->where('status','!=',1)));  
            $auction_end = $auctiondata[0]->auction_end;
            $last_auction_date = Product::where(function ($query) use ($auction_end) {
                // subqueries goes here
                $query->where('auction_end','like', '%'.$auction_end.'%');
            })
            ->max('auction_end');

            $auction_result = Product::where('auction_end','like', '%'.date('Y-m-d',strtotime($last_auction_date)).'%')->get();
        }
       
        $pagelanguage = $this->get_pagelanguage(); //dd($pagelanguage);
        return view($page,compact('last_auction_date','auction_result','pagelanguage'));
    }
    
    

    public function terms_and_condition()
    {
        $page =$this->get_pageurl('fontend.en.documents.terms_and_condition','fontend.jp.documents.terms_and_condition');
        return view($page);
    }
    public function security_deposit()
    {
        $page =$this->get_pageurl('fontend.en.documents.security_deposit','fontend.jp.documents.security_deposit');
        return view($page);
    }
    public function winner_bidding_to_payment()
    {
        $page =$this->get_pageurl('fontend.en.documents.winner_bidding_to_payment','fontend.jp.documents.winner_bidding_to_payment');
        return view($page);
    }

    //woner register request
    public function product_owner_register()
    {
        $page =$this->get_pageurl('fontend.en.product_woner_registration','fontend.jp.product_woner_registration');
        $pagelanguage = $this->get_pagelanguage();
        return view($page,compact('pagelanguage'));
    }
    public function product_owner_request_store(Request $request)
    { //dd($request->all());
        $request->validate([
            'company_name_en' => 'max:255',
            'company_name_jp' => 'max:255',
            'name_en' => 'max:255',
            'name_jp' => 'max:255',
            'person_incharge_en' => 'max:255',
            'person_incharge_jp' => 'max:255',
            'address' => 'required|max:500',
            'postcode' => 'required|max:255',
            'country' => 'required|max:255',
            'email1' => 'required|email|max:255',
            'phone1' => 'required|max:255',
            'fax' => 'required|max:255'
        ]);

        Product_woner_request::insert([
            
            'company_name_en'=>$request->company_name_en,
            'company_name_jp'=>$request->company_name_jp,
            'name_en'=>$request->name_en,
            'name_jp'=>$request->name_jp,
            'person_incharge_en'=>$request->person_incharge_en,
            'person_incharge_jp'=>$request->person_incharge_jp,
            'address'=>$request->address,
            'postcode'=>$request->postcode,
            'country'=>$request->country,
            'email1'=>$request->email1,
            'email2'=>$request->email2,
            'phone1'=>$request->phone1,
            'phone2'=>$request->phone2,
            'fax'=>$request->fax,
            'created_at'=>Carbon::now(),
        ]);

        // $data = array();
        // $data["company_name_en"] = $request->company_name;
        // $data["company_name_jp"] = $request->company_name;
        // $data["name_en"] = $request->name;
        // $data["name_jp"] = $request->name;
        // $data["person_incharge_en"] = $request->person_incharge;
        // $data["person_incharge_jp"] = $request->person_incharge;
        
        // $data["address"] = $request->address;
        // $data["postcode"] = $request->postcode;
        // $data["country"] = $request->country;
        // $data["email1"] = $request->email1;
        // $data["email2"] = $request->email2;
        // $data["phone1"] = $request->phone1;
        // $data["phone2"] = $request->phone2;
        // $data["fax"] = $request->fax;

        // Mail::to($request->email1)->send(new ownerRegistrationSuccessMail($data));
        return Redirect()->route('product_owner.product_owner_requestion-success-message');
    }
    public function product_owner_requestion_success_message()
    {
        $page =$this->get_pageurl('fontend.en.product_owner_registration_message','fontend.jp.product_owner_registration_message');
        return view($page);
    }



    //bidder register request
    public function member_register()
    {
        $page =$this->get_pageurl('fontend.en.bidder_registration','fontend.jp.bidder_registration');
        $pagelanguage = $this->get_pagelanguage();
        return view($page,compact('pagelanguage'));
    }
    //forgetpass
    public function forgetpass()
    {
        $page =$this->get_pageurl('fontend.en.forgetpassword','fontend.jp.forgetpassword');
        $pagelanguage = $this->get_pagelanguage();
        return view($page,compact('pagelanguage'));
    }
    public function member_request_store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'postcode' => 'required|max:255',
            'country' => 'required|max:255',
            'email1' => 'required|max:255|unique:bidder_requests|unique:bidder_registers',
            'email2' => 'max:255',
            'phone1' => 'required|max:255|max:255|unique:bidder_requests|unique:bidder_registers',
            'phone2' => 'max:255',
            'fax' => 'required|max:255|unique:bidder_requests|unique:bidder_registers',
            'company_name' => 'required|max:255',
            'person_incharge' => 'required|max:255',
            'other_auction' => 'max:255',
            'antique_license' => 'max:255',
        ]);

        Bidder_request::insert([
            "name" => $request->name,
            "address" => $request->address,
            "postcode" => $request->postcode,
            "country" => $request->country,
            "email1" => $request->email1,
            "email2" => $request->email2,
            "phone1" => $request->phone1,
            "phone2" => $request->phone2,
            "fax" => $request->fax,
            "company_name" => $request->company_name,
            "person_incharge" => $request->person_incharge,
            "other_auction" => $request->other_auction,
            "antique_license" => $request->antique_license,
            
            'created_at'=>Carbon::now(),
        ]);

        $data = array();
        $data["name"] = $request->name;
        $data["address"] = $request->address;
        $data["postcode"] = $request->postcode;
        $data["country"] = $request->country;
        $data["email1"] = $request->email1;
        $data["email2"] = $request->email2;
        $data["phone1"] = $request->phone1;
        $data["phone2"] = $request->phone2;
        $data["fax"] = $request->fax;
        $data["company_name"] = $request->company_name;
        $data["person_incharge"] = $request->person_incharge;
        $data["other_auction"] = $request->other_auction;

        Mail::to($request->email1)->send(new registrationSuccessMail($data));
        return Redirect()->route('member.requestion-success-message');
    }
    public function requestion_success_message()
    {
        $page =$this->get_pageurl('fontend.en.bidder_registration_message','fontend.jp.bidder_registration_message');
        return view($page);
    }
    //passwordretrieve
    public function passwordretrieve(Request $request)
    {
        $request->validate([
            "_token" => 'required',
            "email" => 'required'
        ]);
        
        $bidder_email = $request->email; 
        $request->email = "";
        $bidderdata = ""; 
        $bidderdata = Bidder_register::where('email1',$bidder_email)->where('permission','approve')->where('status','active')->get(); 
        $msg="";
        $emsg="";

        if(count($bidderdata) >0)
        {
            //dd($bidderdata);
            $bidderid = $bidderdata[0]->id;  
            $fakeserial1 = rand(1,10);
            $fakeserial2 = rand(1,10);
            $url = url('').'/bidder/password_retrieve_page/'.$fakeserial1.'/'.$bidderid.'/'.$fakeserial2; 

            $data = [
                'url'=>$url,
            ];
            
            Mail::to($bidder_email)->send(new forgetpass($data));

            
            //return Redirect()->back()->with('success',"Password retrieve mail is sent. Please login to your mail account");
            //$page =$this->get_pageurl('fontend.en.passwordretrieve_message','fontend.jp.passwordretrieve_message');
            $pagelanguage = $this->get_pagelanguage();
            if($pagelanguage == 'en')
            {
                $msg = "Password retrieve mail is sent. Please login to your mail account";
            }
            else
            {
                $msg = "パスワード変更メールをお送り致しました。メールをご確認下さい。";
            }
            
            Session::put('retrieve',1) ;
            //return view($page,compact('msg','pagelanguage'));
        }
        else
        {
            //return Redirect()->back()->with('err',"Invalid User...");
            //$page =$this->get_pageurl('fontend.en.passwordretrieve_message','fontend.jp.passwordretrieve_message');
            //$pagelanguage = $this->get_pagelanguage();
            $emsg = "Invalid Email Address";
            Session::put('retrieve',0) ;
            //return view($page,compact('emsg','pagelanguage'));
        }
        //$this->password_retrieve_msg($msg,$emsg);
        //return Redirect()->route('/bidder/password_retrieve_msg/'.$msg.'/'.$emsg); 
        return redirect()->route('bidder.password_retrieve_msg');
    }
    public function password_retrieve_msg()
    {
        $pagelanguage = $this->get_pagelanguage();
        $page =$this->get_pageurl('fontend.en.passwordretrieve_message','fontend.jp.passwordretrieve_message');
        
        $retrieve = session()->get('retrieve');
        $msg = "";
        $emsg ="";
        if($retrieve == 1)
        {
            //$msg = "Password retrieve mail is sent. Please login to your mail account";
            $pagelanguage = $this->get_pagelanguage();
            if($pagelanguage == 'en')
            {
                $msg = "Password retrieve mail is sent. Please login to your mail account";
            }
            else
            {
                $msg = "パスワード変更メールをお送り致しました。メールをご確認下さい。";
            }
        }
        else
        {
            //$emsg = "Invalid Email Address";
            $pagelanguage = $this->get_pagelanguage();
            if($pagelanguage == 'en')
            {
                $emsg = "Invalid Email Address";
            }
            else
            {
                $emsg = "無効な電子メールアドレス";
            }
        }
        return view($page,compact('msg','emsg','pagelanguage'));
    }
    public function password_retrieve_page($fakeserial1,$bidderid,$fakeserial2)
    { 
        $page =$this->get_pageurl('fontend.en.change_password','fontend.jp.change_password');
        $pagelanguage = $this->get_pagelanguage();

        return view($page,compact('bidderid','pagelanguage'));
    }
    //changepass
    public function changepassword(Request $request)
    {
        $request->validate([
            'username' => 'required|max:255',
            'newpass' => 'min:6|required_with:confirmed|same:confirmed',
        ]);

        $bidderdata = ""; 
        $bidderdata = Bidder_register::find($request->bidderid);  //dd($bidderdata->id);

        if($bidderdata != "")
        {
            if($bidderdata->username == $request->username)
            {
                $newpass = Hash::make($request->newpass);
                Bidder_register::find($request->bidderid)->update([
                    'password'=> $newpass,
                    'user_id'=>$request->bidderid,
                    'updated_at'=>Carbon::now(),
                ]);
                Product_woner::where('usercodeno',$bidderdata->username)->update([
                    'password'=> $newpass,
                    'user_id'=>$request->bidderid,
                    'updated_at'=>Carbon::now(),
                ]);
    
                $page =$this->get_pageurl('fontend.en.passwordretrieve_message','fontend.jp.passwordretrieve_message');
                $pagelanguage = $this->get_pagelanguage();
                $msg = "Password Changed Successfully, Please try to login by new password";
                return view($page,compact('msg','pagelanguage'));
            }
            else
            {
                $page =$this->get_pageurl('fontend.en.passwordretrieve_message','fontend.jp.passwordretrieve_message');
                $pagelanguage = $this->get_pagelanguage();
                $msg = "Invalid User";
                return view($page,compact('msg','pagelanguage'));
            }
        }
        else
        {
            $page =$this->get_pageurl('fontend.en.passwordretrieve_message','fontend.jp.passwordretrieve_message');
            $pagelanguage = $this->get_pagelanguage();
            $msg = "Invalid User";
            return view($page,compact('msg','pagelanguage'));
        }
        
    }
    //bidderblacklisted
    public function bidderblacklisted()
    {
        $page =$this->get_pageurl('fontend.en.bidderblacklisted','fontend.jp.bidderblacklisted');
        $pagelanguage = $this->get_pagelanguage();
        $bidderdata = Bidder_register::where('permission','black listed')->get();
        return view($page,compact('pagelanguage','bidderdata'));
    }


    //file download
    public function downloadZip($id)
    {
        $imgarr = []; 
        //image
        $data = Product_multiple_image::where('product_id',$id)->get();
        foreach($data as $key => $value)
        {
            if(file_exists($value->image_L))
            {
                $imgarr[] =  $value->image_L;
            }
        }

        //conditional_report
        $productdata = Product::where('id',$id)->get();
        if(count($productdata)>0)
        {
            foreach($productdata as $key => $value)
            {
                if(file_exists($value->conditional_report))
                {
                    $imgarr[] =  $value->conditional_report;
                }
            }
        }

        $timeName = time();
        $ziplink = $this->converToZip($imgarr,$timeName);
        //return redirect($ziplink);

        //$response = response()->download('./uploads/images/product/multipleimage/'. $timeName . '.zip');
        $response = response()->download('./uploads/zipfiles/'. $timeName . '.zip');
        return $response;
    }
    public function converToZip($imgarr,$timeName)
    {   //dd($imgarr);
        $zip = new ZipArchive;
        //$storage_path = 'uploads/images/product/multipleimage';
        $storage_path = 'uploads/zipfiles';
        //$timeName = time();
        $zipFileName = $storage_path . '/' . $timeName . '.zip';
        $zipPath = asset($zipFileName);
        $res = $zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE); 
        if ($res) 
        {
            foreach ($imgarr as $file) 
            {
                $file = (string)$file;
                $zip->addFile($file,basename($file));
            }
            $zip->close();

            if ($zip->open($zipFileName) === true) {
                return $zipPath;
            } else {
                return false;
            }
        }
    }
    //clear memory
    public function clear_memory()
    {
        //clear zip file from the directory
        File::cleanDirectory('./uploads/zipfiles');
        return response()->json(array(
            'result' => "Memory clear",
        ));
    }
    public function conditional_report()
    {
        return view('fontend.en.documents.report');
    }
    public function product_video()
    {
        return view('fontend.en.documents.product_video');
    }
    //owner_product_show
    public function owner_product_show($id)
    {
        //$page =$this->get_pageurl('fontend.en.auction_product','fontend.jp.auction_product'); 
        $page = $this->auction_page();
        $pagelanguage = $this->get_pagelanguage();
        $deliveryplaces = Delivery_place::latest()->paginate(25);

        $logger_id = Session::get('logger_id'); 
        $loginstatus = Session::get('loginstatus');
        if($loginstatus == 2 && $id != -1 && $logger_id == $id)
        {
            $auctionproducts = Product::where('auction_product',1)->where('woner_id',$id)->orderBy('id','asc')->paginate(30);
        }
        else
        {
            $auctionproducts = Product::where('auction_product',1)->where('final_result','unsold')->orderBy('id','asc')->paginate(30);
        }
        
        return view($page,compact('auctionproducts','pagelanguage','deliveryplaces'));
    }

    public function auction_details($id)
    {
        $page =$this->get_pageurl('fontend.en.documents.auction_result_details','fontend.jp.documents.auction_result_details'); 
        $pagelanguage = $this->get_pagelanguage();

        $products = Product::where('auction_product',1)->where('id',$id)->get();
        if(is_array($products) && count($products)==0){return redirect()->route('woody.auction');}  //error handling

        $product_multiple_images = Product_multiple_image::where('publish_status','publish')->where('product_id',$id)->get();
        $product_multiple_videos = Product_video::where('publish_status','publish')->where('product_id',$id)->get();

        return view($page,compact('products','product_multiple_images','product_multiple_videos','pagelanguage'));
    }
    public function product_entry_request()
    {
        $page =$this->get_pageurl('fontend.en.auction_request','fontend.jp.auction_request');  
        $categories = Category::orderby('sl','asc')->get();
        $brands = Brand::orderby('name_en','asc')->get(); 
        $deliveryplaces = Delivery_place::orderby('name_en','asc')->get();

        $pagelanguage = $this->get_pagelanguage();
        return view($page,compact('pagelanguage','categories','brands','deliveryplaces'));
    }
    public function getproductownerdata(Request $request) 
    {
        $username = $request->username;
        $password = $request->password;  

        $register = Product_woner::where('username',$username)->orWhere('email1', '=', $username)->where('status','active')->get(); 
        if(count($register) >0)
        {
            //return response()->json($register[0]['password'] );
            $dbpass = $register[0]['password'];  
            $ownerid = $register[0]['id'];  
            $name_en = $register[0]['name_en'] != ""? $register[0]['name_en'] : $register[0]['name_jp'];  
            $company_name_en = $register[0]['company_name_en'] != ""? $register[0]['company_name_en'] : $register[0]['company_name_jp'];  
            $person_incharge_en = $register[0]['person_incharge_en'] != ""? $register[0]['person_incharge_en'] : $register[0]['person_incharge_jp'];
            
            if (Hash::check($password, $dbpass))
            {
                return response()->json(array(
                    'loginstatus' => 1,
                    'ownerid' => $ownerid,
                    'precidentname' => $name_en,
                    'company' => $company_name_en,
                    'personininchage' => $person_incharge_en,
                    'language'=>Session::get('language'),
                ));
            }
            else
            {
                //return response()->json('username or password not match');
                return response()->json(array(
                    'loginstatus' => 0,
                    'language'=>Session::get('language'),
                ));
            }
            
        }
        else
        {
            //return response()->json('username or password not match');
            //return response()->json(count($register));
            return response()->json(array(
                'loginstatus' => 0,
                'language'=>Session::get('language'),
            ));
            
        }
        
    }



    ///////////////// Member login, check login info //////////////////////////////////////////////

    public function member_login_form()
    {
        return view('fontend.en.member_login');
    }
    public function check_member_logininfo(Request $request)
    {
        $request->validate([
            'loginid' => 'required',
            'password' => 'required',
        ]);

        $username = $request->loginid;
        $pass = $request->password;
        $userdata = Product_woner::where('username',$username)->get(); //dd($userdata);
        if(count($userdata)>0)
        {   
            if(Hash::check($pass,$userdata[0]->password))
            {
                //Session
                Session::put('loggermemberid',$userdata[0]->id) ;
                Session::put('loggermembername',$userdata[0]->name) ;
                Session::put('loggermemberemail',$userdata[0]->email1) ;
                return Redirect()->route('member_dashboard');
                //return view('backend.member.member_dashboard',compact('userdata'));
            }
            else{
                return Redirect()->back()->with('esuccess', 'Wrong username or password');
            }
        }
        else{
            return Redirect()->back()->with('esuccess', 'Wrong username or password');
        }
    }




    /////////////////////////////////////////////////////////////////////////////////////////////////






}
