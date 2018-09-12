<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('home');
        $userType = \Auth::user()->user_type;

        if($userType->user_type == "Admin") {

            return view('admin.index',compact('userType'));

        } else if($userType->user_type == "Seller") {

            return view('sellers.index',compact('userType'));

        }  else if($userType->user_type == "Buyer") {

            return view('buyers.index',compact('userType'));

        }
    }
}
