<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Skill;
use App\Religion;
use App\Country;
use App\Language;

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
        return view('index');
    }

    public function maids()
    {
        $religions = Religion::where('status', '=', 1)->get();
        $nationalitys = Country::where('status', '=', 1)->get();
        $languages = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Language')->get();
        $page = 'maids';
        $total_maids = User::whereRoleIs('maid')->count();

        $users = User::whereRoleIs('maid')
                        ->with('Profile')
                        ->where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->take(20)
                        ->get();

        return view('maids', compact('users', 'religions','nationalitys','languages','page','total_maids'));
    }

    public function maidsearch(Request $request){
        $religions = Religion::where('status', '=', 1)->get();
        $nationalitys = Country::where('status', '=', 1)->get();
        $languages = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Language')->get();
        $page = 'maids';
        $total_maids = User::whereRoleIs('maid')->count();

        // date filter related
        $age_term = $request->age_term;
        $age_value = $request->age_value;
        $today = date('Y-m-d');
        $birthdate = date("Y-m-d", strtotime("-$age_value years", strtotime($today)));

        $users = User::whereRoleIs('maid')
                        ->with('Profile')
                        ->where('status', 1)
                        ->whereHas('Profile', function($query) use($request, $age_term, $birthdate){
                            $query->where('religion', $request->religion ? $request->religion : 0)
                                    ->orWhere('nationality', $request->nationality ? $request->nationality : 0)
                                    ->orWhere('date_of_birth', $age_term, $birthdate );
                        })->get();

        return view('maids', compact('users','religions','nationalitys','languages','page','total_maids', 'request'));
    }

    public function workers()
    {
        $religions = Religion::where('status', '=', 1)->get();
        $nationalitys = Country::where('status', '=', 1)->get();
        $languages = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Language')->get();
        $page = 'workers';
        $total_workers = User::whereRoleIs('worker')->count();

        $users = User::whereRoleIs('worker')
                        ->with('Profile')
                        ->where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->take(20)
                        ->get();

        return view('workers', compact('users', 'religions','nationalitys','languages','page','total_workers'));
    }

    public function workersearch(Request $request){
        $religions = Religion::where('status', '=', 1)->get();
        $nationalitys = Country::where('status', '=', 1)->get();
        $languages = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Language')->get();
        $page = 'workers';
        $total_workers = User::whereRoleIs('worker')->count();

        // date filter related
        $age_term = $request->age_term;
        $age_value = $request->age_value;
        $today = date('Y-m-d');
        $birthdate = date("Y-m-d", strtotime("-$age_value years", strtotime($today)));

        $users = User::whereRoleIs('worker')
                        ->with('Profile')
                        ->where('status', 1)
                        ->whereHas('Profile', function($query) use($request, $age_term, $birthdate){
                            $query->where('religion', $request->religion ? $request->religion : 0)
                                    ->orWhere('nationality', $request->nationality ? $request->nationality : 0)
                                    ->orWhere('date_of_birth', $age_term, $birthdate );
                        })->get();

        return view('workers', compact('users','religions','nationalitys','languages','page','total_workers', 'request'));
    }
}
