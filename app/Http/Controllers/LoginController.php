<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\User;
use Auth;
use Hash;



class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

/*    public function __construct() 
{
  $this->middleware('auth');
}*/


    public function index()
    {
         return view('viewpanel.login')->with('title','Login');
    }

    public function register(){
         return view('viewpanel.register')->with('title','Register');
    }

    public function authenticate_user(Request $request){
        $data=$request->only('email','password');

        if(\Auth::attempt($data)){
            $user = Auth::user();
            //echo "<pre>";print_r($user);exit;
            return redirect()->intended('dashboard'); 
            
           
        }else{
           return redirect('login')->with('error','Invald email or password'); 
        }
    }

     public function logout(){
        Auth::logout();// log the user out of our application
        return redirect()->intended('login'); 
    }

    public function save_user(Request $request){
        $password = Hash::make($request->password);

        $validation = Validator::make($request->all(), [
         'name'     => 'required',
         'email' => 'required',
         'password' => 'required',
         'confirm_password' => 'required|same:password'
        
         ]);

      // Check if it fails //
      if( $validation->fails() ){
         return redirect()->back()->withInput()->with('errors', $validation->errors() );
      }



        $data=array(
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$password,
            'api_key'=>md5(time()),
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s')
        );



       

         if(DB::table('users')->insert($data)){
            return redirect('register-new-user')->with('success','New user has been registered'); 
           }else{
            return redirect('register-new-user')->with('error','Unable to save user'); 
         }
    }

    


 
}
