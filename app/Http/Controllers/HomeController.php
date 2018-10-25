<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
        $languages = Language::where('status', '=', 1)->get();
        $page = 'maids';

        $users = User::whereRoleIs('maid')
                        ->with('Profile')
                        ->where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->take(20)
                        ->get();

        return view('maids', compact('users', 'religions','nationalitys','languages','page'));
    }

    public function maidsearch(Request $request){
        $religions = Religion::where('status', '=', 1)->get();
        $nationalitys = Country::where('status', '=', 1)->get();
        $languages = Language::where('status', '=', 1)->get();
        $page = 'maids';

        $users = User::whereRoleIs('maid')
                        ->with('Profile')
                        ->where('status', 1)
                        ->whereHas('Profile', function($query) use($request){
                            $query->where('religion', $request->religion ? $request->religion : 0)
                                    ->orWhere('nationality', $request->nationality ? $request->nationality : 0)
                                    /*->orWhere('language_set', $request->native_language ?  $request->native_language : 0)*/;
                        })->get();

        return view('maids', compact('users','religions','nationalitys','languages','page'));
    }

    public function workers()
    {
        $religions = Religion::where('status', '=', 1)->get();
        $nationalitys = Country::where('status', '=', 1)->get();
        $languages = Language::where('status', '=', 1)->get();
        $page = 'workers';

        $users = User::whereRoleIs('worker')
                        ->with('Profile')
                        ->where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->take(20)
                        ->get();

        return view('workers', compact('users', 'religions','nationalitys','languages','page'));
    }

    public function workersearch(Request $request){
        $religions = Religion::where('status', '=', 1)->get();
        $nationalitys = Country::where('status', '=', 1)->get();
        $languages = Language::where('status', '=', 1)->get();
        $page = 'workers';

        $users = User::whereRoleIs('worker')
                        ->with('Profile')
                        ->where('status', 1)
                        ->whereHas('Profile', function($query) use($request){
                            $query->where('religion', $request->religion ? $request->religion : 0)
                                    ->orWhere('nationality', $request->nationality ? $request->nationality : 0)
                                    /*->orWhere('native_language', $request->native_language ?  $request->native_language : 0)*/;
                        })->get();

        return view('workers', compact('users','religions','nationalitys','languages','page'));
    }
}
