<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Themepreference;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function dashboard()
    {
        //dd(Hash::make(123));

        $validuser = "";
        $validuser = Session::get('validuser');
        if($validuser =="")
        {
            Session::put('validuser',0) ;
        }
        
        return view('backend.admin.home');
    }

    //admin account view
    public function view()
    {
        $validuser = "";
        $validuser = Session::get('validuser');  
        if($validuser =="" || $validuser ==0)
        { 
            dd("Token Missing or Invalid");
        }
        $users = User::where('role_id','!=',2)->paginate(25);
        return view('backend.admin.account.view',compact('users'));
    }

    //add new admin account
    public function add_form()
    {
        return view('backend.admin.account.add_admin');
    }

    //store admin account
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8'
        ]);

        User::insert([
            'role_id' => 1,
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'created_at'=>Carbon::now(),
        ]);

        return Redirect()->back()->with('success','Saved Successfully'); 
    }

    //edit admin account
    public function edit($id)
    {
        $validuser = "";
        $validuser = Session::get('validuser');  
        if($validuser =="" || $validuser ==0)
        { 
            dd("Token Missing or Invalid");
        }

        $user = User::find($id);
        return view('backend.admin.account.edit_admin',compact('user'));
    }

    //edit_token
    public function edit_token($id)
    {
        $validuser = "";
        $validuser = Session::get('validuser');  
        if($validuser =="" || $validuser ==0)
        { 
            dd("Token Missing or Invalid");
        }

        $user = User::find($id);
        return view('backend.admin.account.edit_admin_token',compact('user'));
    }

    //update admin account
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        User::find($id)->update([
            'role_id' => 1,
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'updated_at'=>Carbon::now(),
        ]);

        return Redirect()->back()->with('success','Updated Successfully');
    }

    //delete admin account
    public function delete($id)
    {
        User::find($id)->delete();
        return Redirect()->back()->with('success','Account Deleted');
    }

    //change admin password
    public function change_pass(Request $request, $id)
    {
        $request->validate([
            'password_token' => 'required',
            'password' => 'required|string|min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8'
        ]);

        if($request->password_token != "19790307")
        {
            return Redirect()->back()->with('error','SK Token not match'); 
        }

        User::find($id)->update([
            'password'=> Hash::make($request->password),
            'updated_at'=>Carbon::now(),
        ]);

        return Redirect()->back()->with('success','Password changed'); 
    }

    //change token
    public function change_user_token(Request $request, $id)
    {

        $request->validate([
            'password_token' => 'required',
            'user_token_password' => 'required|string|min:3|required_with:user_token_confirmation|same:user_token_confirmation',
            'user_token_confirmation' => 'min:3'
        ]);


        if($request->password_token != "19790307")
        {
            return Redirect()->back()->with('error','SK Token not match'); 
        }
        
        //dd($request->user_token_password);
        
        User::find($id)->update([
            'user_token'=> Hash::make($request->user_token_password),
            'updated_at'=>Carbon::now(),
        ]);

        return Redirect()->back()->with('success','user token changed'); 
    }
    //tokenno_check
    public function tokenno_check(Request $request)
    {
        $users = User::where('role_id','!=',2)->get(); 
        
        if ($users && Hash::check($request->password_token, $users[0]->user_token))
        {
            Session::put('validuser',1) ;
            return redirect('/home');
        }
        else{
            Session::put('validuser',0) ;
            return redirect('/home');
        }
    }

    public function backupDatabase()
    {
        //ENTER THE RELEVANT INFO BELOW
        $mysqlHostName      = env('DB_HOST');
        $mysqlUserName      = env('DB_USERNAME');
        $mysqlPassword      = env('DB_PASSWORD');
        $DbName             = env('DB_DATABASE');
        $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';
 
 
        $queryTables = DB::select(DB::raw('SHOW TABLES'));
         foreach ( $queryTables as $table )
         {
             foreach ( $table as $tName)
             {
                 $tables[]= $tName ;
             }
         }
       // $tables  = array("users","products","categories"); //here your tables...
 
        $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword",array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $result = $statement->fetchAll();
        $output = '';
        foreach($tables as $table)
        {
            $show_table_query = "SHOW CREATE TABLE " . $table . "";
            $statement = $connect->prepare($show_table_query);
            $statement->execute();
            $show_table_result = $statement->fetchAll();
 
            foreach($show_table_result as $show_table_row)
            {
                $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
            }
            $select_query = "SELECT * FROM " . $table . "";
            $statement = $connect->prepare($select_query);
            $statement->execute();
            $total_row = $statement->rowCount();
 
            for($count=0; $count<$total_row; $count++)
            {
                $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
                $table_column_array = array_keys($single_result);
                $table_value_array = array_values($single_result);
                $output .= "\nINSERT INTO $table (";
                $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
                $output .= "'" . implode("','", $table_value_array) . "');\n";
            }
        }
 
        $file_handle = fopen($file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_name));
        ob_clean();
        flush();
        readfile($file_name);
        unlink($file_name);
        
        //download file
        $timenow = strtotime(Carbon::now());
        $time_input = strtotime($timenow); 
        $fYear = date('Y', $time_input);
        $fMonth = date('m', $time_input);
        $fDay = date('d', $time_input);
        $fHour = date('h', $time_input);
        $fMinute = date('i', $time_input);
        $fSecond = date('s', $time_input);
        $file_time = $fYear.$fMonth.$fDay.$fHour.$fMinute.$fSecond;

        $headers = [ 'Content-Disposition' => sprintf('attachment; filename="%s"', 'bk_auctiondb'.$file_time.'.sql'),];
        return response()->make($output, 200, $headers);
    }
    
    //themepreference
    public function themepreference()
    {
        $theme = Themepreference::where('selectedtheme','!=',"")->get();
        $selectedtheme =0;
        if(count($theme)>0)
        {
            $selectedtheme = $theme[0]->selectedtheme;
        }
        return view('backend.admin.auction.themepreference', compact('selectedtheme'));
    }
    //selecttheme
    public function selecttheme($num)
    {
        if($num)
        {
            Themepreference::where('id',1)->update([
                'selectedtheme'=>$num,
                'updated_at'=>Carbon::now(),
            ]);
        }

        $theme = Themepreference::where('selectedtheme','!=',"")->get();
        $selectedtheme ="";
        if(count($theme)>0)
        {
            $selectedtheme = $theme[0]->selectedtheme;
        }
        return view('backend.admin.auction.themepreference', compact('selectedtheme'));
    }




}
