<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductWonerController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\ActionProductController;
use App\Http\Controllers\BidderRegisterController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\DeliveryPlaceController;
use App\Http\Controllers\MemberProductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('/');
Route::get('/guidebook', [MainController::class, 'guidebook'])->name('/guidebook');


//////member panel, login, product add and other activity/////////////////////////////
Route::get('/member_loginform', [MainController::class,'member_login_form'])->name('member.loginform');
Route::post('/check_member_logininfo',[MainController::class,'check_member_logininfo'])->name('check_member_logininfo');
Route::get('/member_dashboard',[MemberProductController::class,'member_dashboard'])->name('member_dashboard');
//member.profile
Route::get('/member/profile',[MemberProductController::class,'member_profile'])->name('member.profile');


Route::get('/member/product/add_form', [MemberProductController::class,'member_product_add_form'])->name('member.product.add_form');
Route::post('/member/product/store', [MemberProductController::class,'member_product_store'])->name('member.product.store');
Route::get('/member_product/viewbyid/{id}', [MemberProductController::class,'viewbyid']);
Route::get('/member_product/edit/{id}', [MemberProductController::class,'edit']);
Route::post('member_product/update/{id}', [MemberProductController::class,'update'])->name('member.product.update');
Route::get('member_product/view_condition_report/{id}',[MemberProductController::class,'view_condition_report']);
Route::get('member_product/videoview/{product_id}', [MemberProductController::class,'productvideo_view']);

Route::get('/member/product/view_newlyadded_productlist', [MemberProductController::class,'view_newlyadded_productlist'])->name('member.product.view_newlyadded_productlist');
Route::get('member_product/request_for_approve/{id}', [MemberProductController::class,'request_for_approve'])->name('member_product.request_for_auction');

Route::get('/member/product/view_productlist_waiting_for_correction', [MemberProductController::class,'view_productlist_waiting_for_correction'])->name('member.product.view_productlist_waiting_for_correction');
Route::get('/member/product/view_productlist_waiting_for_approve', [MemberProductController::class,'view_productlist_waiting_for_approve'])->name('member.product.view_productlist_waiting_for_approve');
Route::get('/member/product/view_productlist_waiting_for_auction', [MemberProductController::class,'view_productlist_waiting_for_auction'])->name('member.product.view_productlist_waiting_for_auction');
Route::get('/member/product/view_productlist_current_auction', [MemberProductController::class,'view_productlist_current_auction'])->name('member.product.view_productlist_current_auction');
Route::get('/member/product/view_productlist_out_of_auction', [MemberProductController::class,'view_productlist_out_of_auction'])->name('member.product.view_productlist_out_of_auction');

Route::get('/member/product/view_auction_sold__product_list', [MemberProductController::class,'view_auction_sold__product_list'])->name('member.product.view_auction_sold__product_list');
//product multiple image
Route::get('member_product/imageview/{id}', [MemberProductController::class,'imageview']);
Route::get('member_productthumbnailimage/edit/{id}',[MemberProductController::class,'edit_productthumbnailimage']);
Route::post('member_product/change_thumbnail/{id}', [MemberProductController::class,'change_thumbnail']);
Route::get('member_productimage/addmore/{id}', [MemberProductController::class,'productimage_addmore']);
Route::post('member_productimage/addmoreupload', [MemberProductController::class,'productimage_addmore_upload']);
Route::get('member_productimage/delete_all_productimage/{product_id}',[MemberProductController::class,'delete_all_productimage']);
Route::get('member_productimage/edit/{id}/{selectedproduct}',[MemberProductController::class,'edit_productimage']);
Route::post('member_productimage/update/{id}',[MemberProductController::class,'update_productimage']);
Route::get('member_productimage/delete/{id}',[MemberProductController::class,'delete_productimage']);
/////////////////////////////////////////////////////////////////////////////////


Auth::routes();
Route::any('/register', function(){
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Auction
Route::get('/auction', [MainController::class,'auction'])->name('woody.auction');
Route::get('/search_site', [MainController::class,'search_site'])->name('woody.search_site');
Route::post('/search_site/bidder_login', [MainController::class,'search_site_bidder_login'])->name('woody.search_site_bidder_login');
Route::get('/search_site/logout', [MainController::class,'search_site_logout'])->name('woody.search_site_logout');
Route::get('/search_site/bid_result/{auctiondate}', [MainController::class,'search_site_bid_result'])->name('woody.search_site_bid_result');
Route::get('/guidebook', [MainController::class,'guidebook'])->name('woody.guidebook');
Route::get('/support', [MainController::class,'support'])->name('woody.support');
Route::get('/search_site/member_registration_for_search_site', [MainController::class,'member_registration_for_search_site'])->name('woody.memberregistrationforsearchsite');

//Auction Document
Route::get('/bid_document', [MainController::class,'bid_document'])->name('woody.bid_document');
Route::get('/bid_document/terms_and_condition', [MainController::class,'terms_and_condition'])->name('woody.terms_and_condition');
Route::get('/bid_document/security_deposit', [MainController::class,'security_deposit'])->name('woody.security_deposit');
Route::get('/bid_document/winner_bidding_to_payment', [MainController::class,'winner_bidding_to_payment'])->name('woody.winner_bidding_to_payment');



Route::get('/workflow', [MainController::class,'workflow'])->name('woody.workflow');
Route::get('/bid_document/bidding_style', [MainController::class,'bidding_style'])->name('bid_document.bidding_style');
Route::get('/bid_document/carry_out_of_equipment', [MainController::class,'carry_out_of_equipment'])->name('bid_document.carry_out_of_equipment');
Route::get('/bid_document/target_machines_selection', [MainController::class,'target_machines_selection'])->name('bid_document.target_machines_selection');
Route::get('/bid_document/log_in_and_bedding', [MainController::class,'log_in_and_bedding'])->name('bid_document.log_in_and_bedding');
Route::get('/bid_document/shipping_charge', [MainController::class,'shipping_charge'])->name('bid_document.shipping_charge');

//Bidder Register Request
Route::get('/member/register', [MainController::class,'member_register'])->name('member.register');
Route::post('/member/request-store', [MainController::class,'member_request_store'])->name('member.request_store');
Route::get('/member/requestion-success-message', [MainController::class,'requestion_success_message'])->name('member.requestion-success-message');

//Product owner register request
Route::get('/product_owner/register', [MainController::class,'product_owner_register'])->name('product_owner.product_owner_register');
Route::post('/product_owner/request-store', [MainController::class,'product_owner_request_store'])->name('product_owner.product_owner_request_store');
Route::get('/product_owner/requestion-success-message', [MainController::class,'product_owner_requestion_success_message'])->name('product_owner.product_owner_requestion-success-message');

Route::get('/bid_document/stolen_and_truble_case', [MainController::class,'stolen_and_truble_case'])->name('woody.stolen_and_truble_case');
Route::get('/bid/result', [MainController::class,'bid_result'])->name('woody.bid_result');
Route::get('/member/forget_password', [MainController::class,'forgetpass'])->name('member.forgetpassword');
//password_retrieve_page
Route::get('/bidder/password_retrieve_page/{fakeserial1}/{bidderid}/{fakeserial2}', [MainController::class,'password_retrieve_page']); 
Route::get('/bidder/password_retrieve_msg', [MainController::class,'password_retrieve_msg'])->name('bidder.password_retrieve_msg');

Route::post('/bidder/password_retrieve', [MainController::class,'passwordretrieve'])->name('bidder.password_retrieve');
Route::post('/bidder/changepassword', [MainController::class,'changepassword'])->name('bidder.changepassword');
Route::get('/bidder/bidderblacklisted', [MainController::class,'bidderblacklisted'])->name('bidder.bidderblacklisted');

//Auction product sorting
Route::get('auction/auctionno_asc/{selectedmenu}', [MainController::class,'auctionno_asc'])->name('auction.auctionno_asc');
Route::get('auction/auctionno_desc/{selectedmenu}', [MainController::class,'auctionno_desc'])->name('auction.auctionno_desc');
Route::get('auction/maker_asc/{selectedmenu}', [MainController::class,'maker_asc'])->name('auction.maker_asc');
Route::get('auction/maker_desc/{selectedmenu}', [MainController::class,'maker_desc'])->name('auction.maker_desc');
Route::get('auction/model_asc/{selectedmenu}', [MainController::class,'model_asc'])->name('auction.model_asc');
Route::get('auction/model_desc/{selectedmenu}', [MainController::class,'model_desc'])->name('auction.model_desc');
Route::get('auction/timeleft_asc/{selectedmenu}', [MainController::class,'timeleft_asc'])->name('auction.timeleft_asc');
Route::get('auction/timeleft_desc/{selectedmenu}', [MainController::class,'timeleft_desc'])->name('auction.timeleft_desc');
Route::get('/auction/auction_details/{id}', [MainController::class,'auction_details'])->name('auction.auction_details'); 

//Auction bid
Route::get('/auction/category/{id}', [MainController::class,'category'])->name('auction.category');
Route::get('/auction/view_byproductid/{id}', [MainController::class,'view_byproductid']);
Route::get('/auction/product/{id}', [MainController::class,'product_details'])->name('auction.product_details'); 
Route::get('/auction/bidder_login', [MainController::class,'bidder_login'])->name('auction.bidder_login'); 
Route::get('/auction/bidder_logout1', [MainController::class,'bidder_logout1'])->name('auction.bidder_logout1'); 
Route::get('/auction/bidder_logout', [MainController::class,'bidder_logout'])->name('auction.bidder_logout'); 
Route::get('/auction/bidderLogout_from_product_show', [MainController::class,'bidderLogout_from_product_show']);
Route::get('/auction/check_bidder_login', [MainController::class,'check_bidder_login'])->name('auction.check_bidder_login'); 
Route::get('/auction/check_bidderLogin_from_product_show', [MainController::class,'check_bidderLogin_from_product_show'])->name('auction.check_bidderLogin_from_product_show'); 
Route::get('/auction/bidderLogin_from_product_show', [MainController::class,'bidderLogin_from_product_show']); 
Route::post('/auction/bidforthis/{id}', [MainController::class,'bidforthis'])->name('auction.bidforthis');
Route::get('/auction/termsandcondition', [MainController::class,'termsandcondition'])->name('auction.termsandcondition');

//Route::get('/auction/bidconfirmation', [MainController::class,'auction']);
//Route::post('/auction/bidconfirmation', [MainController::class,'bidconfirmation'])->name('auction.bidconfirmation');
Route::get('/auction/bidconfirmation/{product_id}/{bidcurrentprice}/{bidder_id}/{biddercodeno}', [MainController::class,'bidconfirmation'])->name('auction.bidconfirmation');

Route::get('/auction/bidstatus/{id}/{currentprice}/{status}', [MainController::class,'bidstatus'])->name('auction.bidstatus');
Route::post('/auction/addToWatchlist', [MainController::class,'addToWatchlist']);
Route::post('/auction/removeFromWatchlist', [MainController::class,'removeFromWatchlist']);
Route::get('/auction/selected_product', [MainController::class,'selected_product'])->name('auction.selected_product');
Route::get('/auction/selected_product_result', [MainController::class,'selected_product_result'])->name('auction.selected_product_result');
Route::get('/auction/all_product', [MainController::class,'all_product'])->name('auction.all_product');
Route::get('/auction/new_today', [MainController::class,'new_today'])->name('auction.new_today');
Route::get('/auction/end_today', [MainController::class,'end_today'])->name('auction.end_today');
Route::post('/auction/search', [MainController::class,'search'])->name('auction.search');
Route::get('/change_language/{lan}', [MainController::class, 'change_language']);
Route::get('/auction/auction_final_result/{id}', [MainController::class,'auction_final_result'])->name('auction.auction_final_result'); 
Route::get('/auction/time_check', [MainController::class, 'time_check']);
Route::get('/auction/auction_time_check', [MainController::class, 'auction_time_check']);
Route::get('/auction/generally_time_check', [MainController::class, 'generally_time_check']);
Route::get('/auction/downloadZip/{id}', [MainController::class,'downloadZip']);
//auction.owner_product_show
Route::get('/auction/owner_product_show/{id}', [MainController::class,'owner_product_show'])->name('auction.owner_product_show');
// auction product_entry_form request
Route::get('/auction/product_entry_request', [MainController::class,'product_entry_request'])->name('auction.product_entry_request');
Route::get('/auction/getproductownerdata', [MainController::class, 'getproductownerdata']);


//clear_memory
Route::get('/auction/clear_memory', [MainController::class,'clear_memory']);
//
Route::get('/product/conditional_report', [MainController::class,'conditional_report']);
Route::get('/product/product_video', [MainController::class,'product_video']);



Route::group(['middleware'=>['Admin','auth']],function(){

    //user tokenno
    Route::post('admin/tokenno_check', [AdminController::class,'tokenno_check'])->name('admin.tokenno');

    //admin account
    Route::get('admin/addform', [AdminController::class,'add_form'])->name('admin.add_form');
    Route::post('admin/store', [AdminController::class,'store'])->name('admin.store');	
    Route::get('admin/view',[AdminController::class,'view'])->name('admin.view');
    Route::get('admin/edit/{id}', [AdminController::class,'edit']);
    Route::post('admin/update/{id}', [AdminController::class,'update']);
    Route::get('admin/delete/{id}', [AdminController::class,'delete']);
    Route::post('admin/change_pass/{id}', [AdminController::class,'change_pass'])->name('admin.change_pass');
    Route::get('admin/edit_token/{id}', [AdminController::class,'edit_token']);
    Route::post('admin/change_user_token/{id}', [AdminController::class,'change_user_token'])->name('admin.change_user_token');
    //admin dashboard
    Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    //db backup download
    Route::get('db/backupDatabase', [AdminController::class,'backupDatabase'])->name('db.backupDatabase');

    //category
    Route::get('category/addform', [CategoryController::class,'add_form'])->name('category.add_form');
    Route::post('category/store', [CategoryController::class,'store'])->name('category.store');	
    Route::get('category/edit/{id}', [CategoryController::class,'edit']);
    Route::post('category/update/{id}', [CategoryController::class,'update']);
    Route::get('category/view',[CategoryController::class,'view'])->name('category.view');
    Route::get('category/delete/{id}', [CategoryController::class,'delete']);

    //brand
    Route::get('brand/addform', [BrandController::class,'add_form'])->name('brand.add_form');
    Route::post('brand/store', [BrandController::class,'store'])->name('brand.store');	
    Route::get('brand/edit/{id}', [BrandController::class,'edit']);
    Route::post('brand/update/{id}', [BrandController::class,'update']);
    Route::get('brand/view',[BrandController::class,'view'])->name('brand.view');
    Route::get('brand/delete/{id}', [BrandController::class,'delete']);

    //delivery place
    Route::get('deliveryplace/addform', [DeliveryPlaceController::class,'add_form'])->name('deliveryplace.add_form');
    Route::post('deliveryplace/store', [DeliveryPlaceController::class,'store'])->name('deliveryplace.store');	
    Route::get('deliveryplace/edit/{id}', [DeliveryPlaceController::class,'edit']);
    Route::post('deliveryplace/update/{id}', [DeliveryPlaceController::class,'update']);
    Route::get('deliveryplace/view',[DeliveryPlaceController::class,'view'])->name('deliveryplace.view');
    Route::get('deliveryplace/delete/{id}', [DeliveryPlaceController::class,'delete']);

    //product
    Route::get('product/addform', [ProductController::class,'add_form'])->name('product.add_form');
    Route::post('product/set_productdata_in_temp', [ProductController::class,'set_productdata_in_temp']);
    Route::get('product/get_productdata_from_temp', [ProductController::class,'get_productdata_from_temp']);
    Route::post('product/store', [ProductController::class,'store'])->name('product.store');	
    Route::get('product/edit/{id}', [ProductController::class,'edit']);
    Route::get('/member_product/approve/{id}',[ProductController::class,'member_product_approve'])->name('member_product.approve');
    Route::get('/member_product/needtoedit/{id}', [ProductController::class,'member_needtoedit'])->name('member_needtoedit');
    Route::get('product/details_view/{id}', [ProductController::class,'details_view']);
    Route::get('product/details_view_forinvoice/{id}/{woner_id}/{enddate}', [ProductController::class,'details_view_forinvoice']);
    Route::get('product/details_view_for_customerinvoice/{id}/{woner_id}/{enddate}', [ProductController::class,'details_view_for_customerinvoice']);
    Route::post('product/update/{id}', [ProductController::class,'update'])->name('product.update');
    Route::post('product/update_forinvoice/{id}', [ProductController::class,'update_forinvoice'])->name('product.update_forinvoice');
    Route::post('product/update_for_customerinvoice/{id}', [ProductController::class,'update_for_customerinvoice'])->name('product.update_for_customerinvoice');
    Route::get('product/view',[ProductController::class,'view'])->name('product.view');
    Route::get('product/view_unsold',[ProductController::class,'view_unsold'])->name('product.view_unsold');
    Route::get('/product/view_productlist_waiting_for_approve', [ProductController::class,'view_productlist_waiting_for_approve'])->name('product.view_productlist_waiting_for_approve');

    //product condition report
    Route::get('product/view_condition_report/{id}',[ProductController::class,'view_condition_report']);
    Route::get('product/view_sold',[ProductController::class,'view_sold'])->name('product.view_sold');
    Route::get('product/delete/{id}', [ProductController::class,'delete']);
    Route::post('product/search_unsold', [ProductController::class,'search_unsold'])->name('product.search_unsold');
    Route::post('product/search_sold', [ProductController::class,'search_sold'])->name('product.search_sold');
    //product multiple image
    Route::get('productimage/addmore/{id}', [ProductController::class,'productimage_addmore']);
    Route::post('productimage/addmoreupload', [ProductController::class,'productimage_addmore_upload']);
    Route::get('productimage/edit/{id}/{selectedproduct}',[ProductController::class,'edit_productimage']);
    Route::post('productimage/update/{id}',[ProductController::class,'update_productimage']);
    Route::get('productimage/delete/{id}',[ProductController::class,'delete_productimage']);
    Route::get('productimage/delete_all_productimage/{product_id}',[ProductController::class,'delete_all_productimage']);
    

    //product multiple image
    Route::get('product/imageview/{id}', [ProductController::class,'imageview']);
    //product Thumbnail Image
    Route::get('productthumbnailimage/edit/{id}',[ProductController::class,'edit_productthumbnailimage']);
    Route::post('product/change_thumbnail/{id}', [ProductController::class,'change_thumbnail']);

    //product multiple video
    Route::get('product/videoview/{product_id}', [ProductController::class,'productvideo_view']);
    Route::get('productvideo/addmore/{id}', [ProductController::class,'productvideo_addmore']);
    Route::post('productvideo/addmoreupload/{id}', [ProductController::class,'productvideo_addmore_upload']);
    Route::get('productvideo/edit/{id}',[ProductController::class,'edit_productvideo']);
    Route::post('productvideo/update/{id}',[ProductController::class,'update_productvideo']);
    Route::get('productvideo/delete/{id}',[ProductController::class,'delete_productvideo']);
    Route::post('product/youtube_video_update/{id}',[ProductController::class,'youtube_video_update']);
    

    //product_enquiry
    Route::get('product/enquiry', [ProductController::class,'product_enquiry_view'])->name('product.enquiry');
    Route::get('product_enquiry/view_details/{id}', [ProductController::class,'product_enquiry_view_details']);
    Route::get('product_enquiry/delete/{id}', [ProductController::class,'product_enquiry_delete']);

    //product owner
    Route::get('owner/addform', [ProductWonerController::class,'add_form'])->name('owner.add_form');
    Route::post('owner/store', [ProductWonerController::class,'store'])->name('owner.store');	
    Route::get('owner/edit/{id}', [ProductWonerController::class,'edit']);
    Route::post('owner/update/{id}', [ProductWonerController::class,'update'])->name('owner.update');
    Route::get('owner/edit_credential/{id}', [ProductWonerController::class,'edit_credential']);
    Route::post('owner/change_password/{id}', [ProductWonerController::class,'change_password'])->name('owner.change_password');
    Route::get('owner/view',[ProductWonerController::class,'view'])->name('owner.view');
    Route::get('owner/delete/{id}', [ProductWonerController::class,'delete']);

    Route::get('productowner/requestview',[ProductWonerController::class,'requestview'])->name('productowner.requestview');
    Route::get('productowner/view_request_details/{id}', [ProductWonerController::class,'view_request_details']);
    Route::get('productowner/delete_request/{id}', [ProductWonerController::class,'delete_request']);
    Route::get('productowner/details_view/{id}/{pid}', [ProductWonerController::class,'details_view']);

    //auctionname
    Route::get('auctionname/addform', [AuctionController::class,'add_form'])->name('auctionname.addform');
    Route::post('auctionname/store', [AuctionController::class,'store'])->name('auctionname.store');	
    Route::get('auctionname/edit/{id}', [AuctionController::class,'edit']);
    Route::post('auctionname/update/{id}', [AuctionController::class,'update'])->name('auctionname.update');
    Route::get('auctionname/view',[AuctionController::class,'view'])->name('auctionname.view');
    Route::get('auctionname/delete/{id}', [AuctionController::class,'delete']);
    Route::get('auctionname/active_auctionname/{id}', [AuctionController::class,'active_auctionname']);
    //Auction Result
    Route::get('auction/auction_result_show',[AuctionController::class,'auction_result_show'])->name('auction.auction_result_show');
    Route::get('auction/result_publish/{id}', [AuctionController::class,'result_publish']);

    //Auction product
    Route::get('auction/auction_form/{id}', [ActionProductController::class,'add_form'])->name('auction.add_form');

    Route::post('auction/store', [ActionProductController::class,'store'])->name('auction.store');	
    Route::get('auction/edit/{id}', [ActionProductController::class,'edit']);
    Route::post('auction/update/{id}', [ActionProductController::class,'update'])->name('auction.update');
    Route::get('auction/view',[ActionProductController::class,'view'])->name('auction.view');
    Route::get('auction/biddersview/{id}',[ActionProductController::class,'auctionbidders']);
    Route::get('auction/view_old',[ActionProductController::class,'view_old'])->name('auction.view_old');
    Route::get('auction/remove/{id}', [ActionProductController::class,'remove']);
    Route::get('auction/bidderinfo/{bidderid}', [ActionProductController::class,'bidderinfo']);
    Route::get('auction/bidinfo/{pid}', [ActionProductController::class,'bidinfo']);
    Route::get('auction/monitor',[ActionProductController::class,'auction_monitor'])->name('auction.monitoring');
    Route::get('auction/monitor_forview',[ActionProductController::class,'auction_monitor_forview']);

    

    //bidder
    Route::get('bidder/addform', [BidderRegisterController::class,'add_form'])->name('bidder.add_form');
    Route::post('bidder/store', [BidderRegisterController::class,'store'])->name('bidder.store');	
    Route::get('bidder/edit_profile/{id}', [BidderRegisterController::class,'edit_profile']);
    Route::post('bidder/update_profile/{id}', [BidderRegisterController::class,'update_profile'])->name('bidder.update_profile');
    Route::get('bidder/edit_credential/{id}', [BidderRegisterController::class,'edit_credential']);
    Route::post('bidder/update_crediential/{id}', [BidderRegisterController::class,'update_crediential'])->name('bidder.update_crediential');
    Route::get('bidder/add_as_product_owner/{id}', [BidderRegisterController::class,'add_as_product_owner']);
    Route::post('bidder/store_as_product_owner/{id}', [BidderRegisterController::class,'store_as_product_owner'])->name('bidder.store_as_product_owner');

    Route::get('bidder/view',[BidderRegisterController::class,'view'])->name('bidder.view');
    Route::get('bidder/view_blacklisted',[BidderRegisterController::class,'view_blacklisted'])->name('bidder.view_blacklisted');
    Route::get('bidder/suspend_account/{id}', [BidderRegisterController::class,'suspend_account']);

    Route::get('bidder/requestview',[BidderRegisterController::class,'requestview'])->name('bidder.requestview');
    Route::get('bidder/view_request_details/{id}', [BidderRegisterController::class,'view_request_details']);
    Route::get('bidder/details_view/{id}/{pid}', [BidderRegisterController::class,'details_view']);
    //bid winner mail
    Route::get('/bid/winner_mail/{pid}', [ProductController::class,'winner_mail']);
    Route::get('/bid/bid_winner_mail/{bidderid}/{enddate}', [ProductController::class,'bid_winner_mail']);
    //auction product owner sold product mail
    Route::get('/auction/product_Owner_mail/{ownerid}/{enddate}', [ProductController::class,'product_Owner_mail']);

    //auction history
    Route::get('auction/view_auction_history', [ActionProductController::class,'view_auction_history'])->name('auction.view_auction_history');
    Route::get('auction/history/{id}', [ActionProductController::class,'auction_history']);
    Route::get('auction/history_unsold/{id}', [ActionProductController::class,'auction_history_unsold']);

    //notice
    Route::get('notice/addform', [NoticeController::class,'add_form'])->name('notice.add_form');
    Route::post('notice/store', [NoticeController::class,'store'])->name('notice.store');	
    Route::get('notice/edit/{id}', [NoticeController::class,'edit']);
    Route::post('notice/update/{id}', [NoticeController::class,'update'])->name('notice.update');
    Route::get('notice/view',[NoticeController::class,'view'])->name('notice.view');
    Route::get('notice/delete/{id}', [NoticeController::class,'delete']);
    Route::get('notice/active_notice/{id}', [NoticeController::class,'active_notice']);
    
    //Action Invoice
    Route::get('customer/searchpage', [ProductController::class,'customer_searchpage'])->name('customer.searchpage');
    Route::post('auction/get_maximum_bidder_list', [ProductController::class,'get_maximum_bidder_list'])->name('auction.get_maximum_bidder_list');
    Route::get('auction/bidder_winner_invoice/{sl}/{id}/{enddate}', [ProductController::class,'bidder_winner_invoice'])->name('auction.bidder_winner_invoice');
    Route::get('auction/get_maximum_bidders_list/{end_time_of_action}', [ProductController::class,'get_maximum_bidders_list'])->name('auction.get_maximum_bidders_list');
    Route::get('infoservice/add_service/{serviceno}/{auctionid}/{bidderid}/{enddate}', [ProductController::class,'add_service'])->name('infoservice.add_service');
    

    Route::get('owner/searchpage', [ProductController::class,'owner_searchpage'])->name('owner.searchpage');
    Route::post('auction/get_sold_product_owner_list', [ProductController::class,'get_sold_product_owner_list'])->name('auction.get_sold_product_owner_list');
    Route::get('auction/product_owner_invoice/{sl}/{id}/{enddate}', [ProductController::class,'product_owner_invoice'])->name('auction.product_owner_invoice');
    Route::get('auction/get_sold_product_owners_list/{end_time_of_action}', [ProductController::class,'get_sold_product_owners_list'])->name('auction.get_sold_product_owners_list');
    Route::get('infoservice/add_owner_service/{serviceno}/{auctionid}/{ownerid}/{enddate}', [ProductController::class,'add_owner_service'])->name('infoservice.add_owner_service');

    Route::get('auction/edit_for_invoice/{id}', [ProductController::class,'edit_for_invoice']);
    Route::post('auction/update_for_invoice/{id}', [ProductController::class,'update_for_invoice'])->name('auction.update_for_invoice');
    
    //Action Invoice Search
    Route::get('invoice/search', [ProductController::class,'invoice_search_page'])->name('invoice.search');
    Route::post('invoice/invoice_search', [ProductController::class,'invoice_search'])->name('auction.invoice_search');
    
    //sold_product_return_as_unsold
    Route::get('/product/sold_product_return_as_unsold/{id}', [ProductController::class,'sold_product_return_as_unsold'])->name('product.sold_product_return_as_unsold'); 
    Route::post('product/return_as_unsold', [ProductController::class,'return_as_unsold'])->name('product.return_as_unsold');

    //auction themepreference
    Route::get('auction/themepreference', [AdminController::class,'themepreference'])->name('auction.themepreference');
    Route::get('auction/selecttheme/{num}', [AdminController::class,'selecttheme']);

});


