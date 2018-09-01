<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function maids()
    {
        return view('maids');
    }

    public function maidsearch(Request $request){
        $users = User::whereRoleIs('maid')->with('Profile')->where('status', 1)->whereHas('Profile', function($q){
            global $request;
            $q->where('religion', $request->religion);
        })->get();

        return view('maids', compact('users'));
    }
}
