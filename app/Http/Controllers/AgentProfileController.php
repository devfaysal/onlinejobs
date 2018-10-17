<?php

namespace App\Http\Controllers;

use App\AgentProfile;
use Illuminate\Http\Request;
use App\Country;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Profile;
use Session;
use Image; /* https://github.com/Intervention/image */
use Storage;
use App\Religion;
use App\Language;
use App\SkillLevel;
use App\MaritalStatus;
use App\Gender;
use App\Experience;

class AgentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()){
            abort(404);
        }
        $user = auth()->user();
        if($user->status != 1){
            return view('agent.review');
        }
        $workers_maids = User::whereHas('profile', function ($q) {
            $user = auth()->user();
            $q->where('agent_code', $user->agent_profile->agent_code);
        })->get();

        return redirect('/admin');
        //return view('agent.show', compact('user', 'workers_maids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countrys = Country::where('status', 1)->get();
        $nationalitys = $countrys;
        return view('agent.create', compact('countrys','nationalitys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(AgentProfile $agentProfile)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit($agent)
    {
        $countrys = Country::where('status', 1)->get();
        $nationalitys = $countrys;
        $agentProfile = AgentProfile::where('id', $agent)->first();
        return view('agent.edit', compact('agentProfile','countrys','nationalitys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $agent)
    {
        $agent = AgentProfile::where('id', $agent)->first();
        $agent->agency_registered_name = $request->agency_registered_name;
        $agent->agency_address = $request->agency_address;
        $agent->agency_city = $request->agency_city;
        $agent->agency_country = $request->agency_country;
        $agent->agency_phone = $request->agency_phone;
        $agent->agency_fax = $request->agency_fax;
        $agent->agency_email = $request->agency_email;
        $agent->license_no = $request->license_no;
        $agent->license_issue_date = $request->license_issue_date;
        $agent->license_expire_date = $request->license_expire_date;

        if($request->file('license_file')){
            $this->validate($request, [
                'license_file' => 'image|max:250',
            ]);
            
            $image_basename = explode('.',$request->file('license_file')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('license_file')->getClientOriginalExtension();

            $img = Image::make($request->file('license_file')->getRealPath());
            $img->stream();

            //Upload image
            Storage::disk('local')->put('public/'.$image, $img);

            //add new image path to database
            $agent->license_file = $image;
            
        }
        //Point of Contact
        $agent->first_name = $request->name;
        $agent->middle_name = $request->middle_name;
        $agent->last_name = $request->last_name;
        $agent->designation = $request->designation;
        $agent->address = $request->address;
        $agent->nationality = $request->nationality;
        $agent->passport = $request->passport;
        $agent->nic = $request->nic;
        $agent->phone = $request->phone;
        $agent->email = $request->email;
        $agent->save();

        Session::flash('message', 'Profile Updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('agent.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(AgentProfile $agentProfile)
    {
        //
    }

    public function createuser()
    {
        $religions = Religion::where('status', '=', 1)->get();
        $nationalitys = Country::where('status', '=', 1)->get();
        $languages = Language::where('status', '=', 1)->get();
        $skill_levels = SkillLevel::where('status', '=', 1)->get();
        $marital_statuses = MaritalStatus::where('status', '=', 1)->get();
        $genders = Gender::where('status', '=', 1)->get();
        return view('agent.createuser', compact('religions','nationalitys','languages','skill_levels','marital_statuses','genders'));
    }

    public function saveuser( Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email ?? 'test@test.com';
        $user->phone = $request->phone;
        $user->password = Hash::make('password');
        $user->public_id = time().md5($request->email);
        $user->status = 1;
        $role = $request->role;

        $user->save();
        $user->attachRole($role);

        $profile = new Profile;

        if($request->file('image')){
            $this->validate($request, [
                'image' => 'image|max:250',
            ]);
            
            $image_basename = explode('.',$request->file('image')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();

            $img = Image::make($request->file('image')->getRealPath());
            $img->stream();

            //Upload image
            Storage::disk('local')->put('public/'.$image, $img);

            //Remove if there was any old image
            if($profile->image != ''){
                Storage::disk('local')->delete('public/'.$profile->image);
            }

            //add new image path to database
            $profile->image = $image;
            
        }

        if($request->file('full_image')){
            $this->validate($request, [
                'full_image' => 'image|max:250',
            ]);
            
            $image_basename = explode('.',$request->file('full_image')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('full_image')->getClientOriginalExtension();

            $img = Image::make($request->file('full_image')->getRealPath());
            $img->stream();

            //Upload image
            Storage::disk('local')->put('public/'.$image, $img);

            //Remove if there was any old image
            if($profile->full_image != ''){
                Storage::disk('local')->delete('public/'.$profile->full_image);
            }

            //add new image path to database
            $profile->full_image = $image;
            
        }

        $profile->user_id = $user->id;
        $profile->agent_code = $request->agent_code;
        $profile->name = $request->name;
        $profile->phone = $request->phone;
        $profile->gender = $request->gender;
        $profile->date_of_birth = $request->date_of_birth;
        $profile->nationality = $request->nationality;
        $profile->religion = $request->religion;
        $profile->native_language = $request->native_language;
        $profile->other_languages = $request->other_languages;
        $profile->marital_status = $request->marital_status;
        $profile->height = $request->height;
        $profile->weight = $request->weight;
        $profile->highest_education = $request->highest_education;
        $profile->skill_level = $request->skill_level;
        $profile->work_on_off_days_with_compensation = $request->work_on_off_days_with_compensation;
        $profile->able_to_handle_pork = $request->able_to_handle_pork;
        $profile->able_to_gardening = $request->able_to_gardening;
        $profile->able_to_care_dog_cat = $request->able_to_care_dog_cat;
        $profile->able_to_simple_sewing = $request->able_to_simple_sewing;
        $profile->able_to_wash_car = $request->able_to_wash_car;
        $profile->able_to_eat_pork = $request->able_to_eat_pork;
        $profile->able_to_care_infants = $request->able_to_care_infants;
        $profile->able_to_care_elderly = $request->able_to_care_elderly;
        $profile->able_to_care_disabled = $request->able_to_care_disabled;
        $profile->able_to_do_general_housework = $request->able_to_do_general_housework;
        $profile->able_to_cook = $request->able_to_cook;

        $profile->save();

        if(count($request->employer_name)>0){
            for($i=0; $i< count($request->employer_name); $i++){
                $experience = new Experience;
                $experience->user_id = $user->id;
                $experience->employer_name = $request->employer_name[$i];
                $experience->country = $request->country[$i];
                $experience->from_date = $request->from_date[$i];
                $experience->to_date = $request->to_date[$i];
                $experience->remark = $request->remark[$i];
                $experience->save();
            }
        }
        
        Session::flash('message', ucfirst($role).' Created successfully!! now update profile'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.home');
    }


    public function print($data)
    {
        $profile = auth()->user()->agent_profile;
        return view('agent.print', compact('data', 'profile'));
    }
}
