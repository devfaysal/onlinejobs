<?php

namespace App\Http\Controllers;

use App\User;
use App\Skill;
use App\Gender;
use App\Country;
use App\Language;
use App\Religion;
use Carbon\Carbon;
use App\Traits\OptionTrait;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use OptionTrait;
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
        $registered_job_seekers = User::whereRoleIs('professional')->count();
        $registered_foreign_workers = User::whereRoleIs('worker')->count();
        $registered_domestic_maids = User::whereRoleIs('maid')->count();
        $registered_employers = User::whereRoleIs('employer')->count();
        $registered_business_partners = User::whereRoleIs('agent')->count();
        $registered_retired_personnels = User::whereRoleIs('retired')->count();
        $search_locations = $this->getOptions('Job Search Location');
        $search_experiences = $this->getOptions('Job Search Experience');
        $search_salarys = $this->getOptions('Job Search Salary');

        return view('index', [
            'registered_job_seekers' => $registered_job_seekers,
            'registered_foreign_workers' => $registered_foreign_workers,
            'registered_domestic_maids' => $registered_domestic_maids,
            'registered_employers' => $registered_employers,
            'registered_business_partners' => $registered_business_partners,
            'registered_retired_personnels' => $registered_retired_personnels,
            'search_locations' => $search_locations,
            'search_experiences' => $search_experiences,
            'search_salarys' => $search_salarys,
        ]);
    }

    public function maids()
    {
        $religions = Religion::where('status', '=', 1)->get();
        $nationalitys = Country::where('status', '=', 1)->get();
        $genders = Gender::where('status', '=', 1)->get();
        $languages = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Language')->get();
        $page = 'maids';
        $total_maids = User::whereRoleIs('maid')->count();

        $users = User::whereRoleIs('maid')
                        ->with('Profile')
                        ->where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->take(20)
                        ->get();

        return view('maids', compact('users', 'religions','nationalitys','genders','languages','page','total_maids'));
    }

    public function maidsearch(Request $request){

        $religions = Religion::where('status', '=', 1)->get();
        $nationalitys = Country::where('status', '=', 1)->get();
        $genders = Gender::where('status', '=', 1)->get();
        $languages = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Language')->get();
        $page = 'maids';

        // date filter related
        // $age_term = $request->age_term;
        // $age_value = $request->age_value;
        // $today = date('Y-m-d');
        // $birthdate = date("Y-m-d", strtotime("-$age_value years", strtotime($today)));
        if($request->age_term == '18-24'){
            $birthdate_start = Carbon::now()->subYears(24)->toDateString();
            $birthdate_end = Carbon::now()->subYears(18)->toDateString();
        }elseif($request->age_term == '25-35'){
            $birthdate_start = Carbon::now()->subYears(35)->toDateString();
            $birthdate_end = Carbon::now()->subYears(25)->toDateString();
        }elseif($request->age_term == '36-45'){
            $birthdate_start = Carbon::now()->subYears(45)->toDateString();
            $birthdate_end = Carbon::now()->subYears(36)->toDateString();
        }else{
            $birthdate_start = '';
            $birthdate_end = '';
        }
        if($request->nationality == null && $request->religion == null && $request->gender == null && $request->age_term == null){
            $total_maids = User::whereRoleIs('maid')->count();

        $users = User::whereRoleIs('maid')
                        ->with('Profile')
                        ->where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->take(20)
                        ->get();
        }else{
            $users = User::whereRoleIs('maid')
                        ->with('Profile')
                        ->where('status', 1)
                        ->whereHas('Profile', function($query) use($request,$birthdate_start,$birthdate_end){
                            $query->when($request->nationality, function($query) use($request){
                                return $query->where('nationality', $request->nationality);
                            })->when($request->religion, function($query) use($request){
                                return $query->where('religion', $request->religion);
                            })->when($request->gender, function($query) use($request){
                                return $query->where('gender', $request->gender);
                            })->when($birthdate_start, function($query) use($birthdate_start, $birthdate_end){
                                return $query->WhereBetween('date_of_birth', [$birthdate_start, $birthdate_end]);
                            });
                        })->get();
            $total_maids = $users->count();
            $users = $users->take(20);
        }
        return view('maids', compact('users','religions','nationalitys','genders','languages','page','total_maids', 'request'));
    }

    public function workers()
    {
        $religions = Religion::where('status', '=', 1)->get();
        $nationalitys = Country::where('status', '=', 1)->get();
        $genders = Gender::where('status', '=', 1)->get();
        $languages = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Language')->get();
        $page = 'workers';
        $total_workers = User::whereRoleIs('worker')->count();

        $users = User::whereRoleIs('worker')
                        ->with('Profile')
                        ->where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->take(20)
                        ->get();

        return view('workers', compact('users', 'religions','nationalitys','genders','languages','page','total_workers'));
    }

    public function workersearch(Request $request){

        $religions = Religion::where('status', '=', 1)->get();
        $nationalitys = Country::where('status', '=', 1)->get();
        $genders = Gender::where('status', '=', 1)->get();
        $languages = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Language')->get();
        $page = 'workers';

        // date filter related
        // $age_term = $request->age_term;
        // $age_value = $request->age_value;
        // $today = date('Y-m-d');
        // $birthdate = date("Y-m-d", strtotime("-$age_value years", strtotime($today)));
        if($request->age_term == '18-24'){
            $birthdate_start = Carbon::now()->subYears(24)->toDateString();
            $birthdate_end = Carbon::now()->subYears(18)->toDateString();
        }elseif($request->age_term == '25-35'){
            $birthdate_start = Carbon::now()->subYears(35)->toDateString();
            $birthdate_end = Carbon::now()->subYears(25)->toDateString();
        }elseif($request->age_term == '36-45'){
            $birthdate_start = Carbon::now()->subYears(45)->toDateString();
            $birthdate_end = Carbon::now()->subYears(36)->toDateString();
        }else{
            $birthdate_start = '';
            $birthdate_end = '';
        }
        if($request->nationality == null && $request->religion == null && $request->gender == null && $request->age_term == null){
            $total_workers = User::whereRoleIs('worker')->count();

            $users = User::whereRoleIs('worker')
                        ->with('Profile')
                        ->where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->take(20)
                        ->get();
        }else{
        $users = User::whereRoleIs('worker')
                        ->with('Profile')
                        ->where('status', 1)
                        ->whereHas('Profile', function($query) use($request,$birthdate_start,$birthdate_end){
                            $query->when($request->nationality, function($query) use($request){
                                return $query->where('nationality', $request->nationality);
                            })->when($request->religion, function($query) use($request){
                                return $query->where('religion', $request->religion);
                            })->when($request->gender, function($query) use($request){
                                return $query->where('gender', $request->gender);
                            })->when($birthdate_start, function($query) use($birthdate_start, $birthdate_end){
                                return $query->WhereBetween('date_of_birth', [$birthdate_start, $birthdate_end]);
                            });
                        })->get();
        $total_workers = $users->count();
        $users = $users->take(20);
        }
        return view('workers', compact('users','religions','nationalitys','genders','languages','page','total_workers', 'request'));
    }
}
