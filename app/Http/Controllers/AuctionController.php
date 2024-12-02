<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\Product;
use App\Models\Skauction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class AuctionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function checkvaliduser()
    {
        $validuser = "";
        $validuser = Session::get('validuser');  
        if($validuser =="" || $validuser ==0)
        { 
            echo '<div style="width:300px;padding:20px;min-height:100px;margin:0 auto;border:1px solid #ccc;text-align:center;margin-top:15%;"><br>Token Missing or Invalid';
            echo '<br><br>Go to &nbsp;<a href="'.route('home').'">Dashboard</a>&nbsp; and set user token number</div>';exit;
        }
        //$this->checkvaliduser();
    }
    public function add_form()
    {
        $this->checkvaliduser();
        $today = Carbon::now();
        $auctionlist = Auction::where('auction_end','<=',$today)->orderby('id','desc')->get();
        return view('backend.admin.auctionname.add_auctionname',compact('auctionlist'));
    }
    //Auction Store
    public function store(Request $request)
    { 
        $this->checkvaliduser();

        $request->validate([
            'name' => 'required|max:255|unique:auctions',
            'start_time_of_action' => 'required',
            'end_time_of_action' => 'required',
        ]);

        $id = Auction::insertGetId([
            'name'=>$request->name,
            'auction_start'=>Carbon::parse($request->start_time_of_action)->format('Y-m-d H:i:s'),
            'auction_end'=>Carbon::parse($request->end_time_of_action)->format('Y-m-d H:i:s'),
            'start_time_of_auction'=>$request->start_time_of_action,
            'end_time_of_auction'=>$request->end_time_of_action,
            'user_id'=>Auth::user()->id,
            'created_at'=>Carbon::now(),
        ]);
        Skauction::insertGetId([
            'auctionid'=>$id,
            'created_at'=>Carbon::now(),
        ]);
        
        return Redirect()->back()->with('success','Saved Successfully'); 
    }

    //All Notice View
    public function view()
    {
        $this->checkvaliduser();
        //get all data from categories table
        $auctions = Auction::latest()->get();  
        return view('backend.admin.auctionname.view_auctionname', compact('auctions'));
    }

    //Notice edit
    public function edit($id)
    {
        $this->checkvaliduser();

        $auction = Auction::find($id);
        return view('backend.admin.auctionname.edit_auctionname', compact('auction'));
    }

    //Notice update
    public function update(Request $request, $id)
    { 
        $this->checkvaliduser();  
        //validation  
        $request->validate([
            'name' => 'required|max:255|unique:auctions',
            'start_time_of_action' => 'required',
            'end_time_of_action' => 'required',
        ]);
        

        Auction::find($id)->update([
            'name'=>$request->name,
            'auction_start'=>Carbon::parse($request->start_time_of_action)->format('Y-m-d H:i:s'),
            'auction_end'=>Carbon::parse($request->end_time_of_action)->format('Y-m-d H:i:s'),
            'start_time_of_auction'=>$request->start_time_of_action,
            'end_time_of_auction'=>$request->end_time_of_action,
            'user_id'=>Auth::user()->id,
            'updated_at'=>Carbon::now(),
        ]);
        return Redirect()->back()->with('success','Notice Message updated');
    }
    //active message
    public function active_auctionname($id)
    { 
        $this->checkvaliduser();

        $notices = Auction::latest()->get();  //dd($notices);
        foreach($notices as $n)
        {
            if($n->id == $id)
            {
                Auction::find($id)->update([
                    'status'=>1,
                    'user_id'=>Auth::user()->id,
                    'updated_at'=>Carbon::now(),
                ]);
            }
            else
            {
                Auction::find($n->id)->update([
                    'status'=>0,
                    'user_id'=>Auth::user()->id,
                    'updated_at'=>Carbon::now(),
                ]);
            }
        }
        
        
        return Redirect()->back()->with('success','Auction Active');
    }


    //Notice delete
    public function delete($id)
    {
        $this->checkvaliduser();
        $products = Product::where('auction_id',$id)->get();
        if(count($products)==0)
        {
            if(Skauction::where('auctionid',$id)->delete())
            {
                if(Auction::find($id)->delete())
                {
                    return Redirect()->back()->with('success','Auction Name Deleted');
                }
            }
        }
        else{
            return Redirect()->back()->with('error','This auction has record in product table, can not deleted');
        }
        
    }
    public function auction_result_show()
    {
        $this->checkvaliduser();
        //get all data from categories table
        $auctions = Auction::latest()->get();  
        return view('backend.admin.auctionname.show_auction_result', compact('auctions'));
    }
    //
    public function result_publish($id)
    { 
        $this->checkvaliduser();

        $notices = Auction::latest()->get();  //dd($notices);
        foreach($notices as $n)
        {
            if($n->id == $id)
            {
                Auction::find($id)->update([
                    'result_show'=>1,
                    'user_id'=>Auth::user()->id,
                    'updated_at'=>Carbon::now(),
                ]);
            }
            else
            {
                Auction::find($n->id)->update([
                    'result_show'=>0,
                    'user_id'=>Auth::user()->id,
                    'updated_at'=>Carbon::now(),
                ]);
            }
        }
        
        
        return Redirect()->back()->with('success','Selected Auction Result Publish ');
    }
}
