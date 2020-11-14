<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\User;
use App\Product;
use Auth;
use Hash;



class HomeController extends Controller
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
         return view('viewpanel.dashboard')->with('title','Dashboard');
    }

     public function logout(){
        Auth::logout();// log the user out of our application
        return redirect()->intended('login'); 
    }

    public function api_details(){
        
         return view('viewpanel.api_details')->with('title','API Details');
    }

   
}
