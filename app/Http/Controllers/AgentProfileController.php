<?php

namespace App\Http\Controllers;

use Session;
use Storage;
use App\User;
use App\Skill;
use App\Gender;
use App\Country;
use App\Profile;
use App\Language;
use App\Religion;
use App\Education;
use App\Experience;
use App\SkillLevel;
use App\AgentProfile;
use App\MaritalStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image; /* https://github.com/Intervention/image */

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
        $skills = Skill::where('status', '=', 1)->get();
        return view('agent.createuser', compact('religions','nationalitys','languages','skill_levels','marital_statuses','genders','skills'));
    }

    public function saveuser( Request $request)
    {
        //return request('Drill');
        //return var_dump($request->Welding);
        // $skills = Skill::where('status', '=', 1)->get();
        // foreach($skills as $skill){
        //     $arr[$skill->slug] = request($skill->slug) ?? 'No';
        // }
        // //return $arr;
        // $var = json_encode($arr);
        // $vars= json_decode($var);
        //  $arrs = (array) $vars;
        // foreach($skills as $skill){
        //     $checked = $arrs[$skill->slug] == 'Yes'?  'checked': '';
        //     echo '<label for="able_to_cook">'.$skill->name.'</label>';
        //     echo '<input type="checkbox" id="" name="'.$skill->slug.'" value="Yes"'.$checked.'>';
        // }

        // die();

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email ?? time().'@test.com';
        $user->phone = $request->phone;
        $user->password = Hash::make('password');
        $user->public_id = time().md5($request->email);
        $user->status = 1;
        $role = $request->role;
        
        if($role == 'maid'){
            $skills = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Skill')->get();
            $languages = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Language')->get();
        }else if($role == 'worker'){
            $skills = Skill::where('status', '=', 1)->where('for', 'gw')->where('type','Skill')->get();
            $languages = Skill::where('status', '=', 1)->where('for', 'gw')->where('type','Language')->get();
        }
        $user->save();
        $user->attachRole($role);

        $profile = new Profile;
        foreach($skills as $skill){
            $skill_arr[$skill->slug] = request($skill->slug) ?? 'No';
        }
        $profile->skill_set = json_encode($skill_arr);

        foreach($languages as $language){
            $lang_arr[$language->slug] = request($language->slug) ?? 'No';
        }
        $profile->language_set = json_encode($lang_arr);

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

        if($request->file('passport_file')){
            $this->validate($request, [
                'passport_file' => 'image|max:250',
            ]);
            
            $image_basename = explode('.',$request->file('passport_file')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('passport_file')->getClientOriginalExtension();

            $img = Image::make($request->file('passport_file')->getRealPath());
            $img->stream();

            //Upload image
            Storage::disk('local')->put('public/'.$image, $img);

            //Remove if there was any old image
            if($profile->passport_file != ''){
                Storage::disk('local')->delete('public/'.$profile->passport_file);
            }

            //add new image path to database
            $profile->passport_file = $image;
            
        }

        if($request->file('medical_certificate')){
            $this->validate($request, [
                'medical_certificate' => 'image|max:250',
            ]);
            
            $image_basename = explode('.',$request->file('medical_certificate')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('medical_certificate')->getClientOriginalExtension();

            $img = Image::make($request->file('medical_certificate')->getRealPath());
            $img->stream();

            //Upload image
            Storage::disk('local')->put('public/'.$image, $img);

            //Remove if there was any old image
            if($profile->medical_certificate != ''){
                Storage::disk('local')->delete('public/'.$profile->medical_certificate);
            }

            //add new image path to database
            $profile->medical_certificate = $image;
            
        }

        if($request->file('immigration_security_clearence')){
            $this->validate($request, [
                'immigration_security_clearence' => 'image|max:250',
            ]);
            
            $image_basename = explode('.',$request->file('immigration_security_clearence')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('immigration_security_clearence')->getClientOriginalExtension();

            $img = Image::make($request->file('immigration_security_clearence')->getRealPath());
            $img->stream();

            //Upload image
            Storage::disk('local')->put('public/'.$image, $img);

            //Remove if there was any old image
            if($profile->immigration_security_clearence != ''){
                Storage::disk('local')->delete('public/'.$profile->immigration_security_clearence);
            }

            //add new image path to database
            $profile->immigration_security_clearence = $image;
            
        }

        $profile->user_id = $user->id;
        $profile->agent_code = $request->agent_code;
        $profile->name = $request->name;
        $profile->date_of_birth = $request->date_of_birth;
        $profile->address = $request->address;
        $profile->district = $request->district;
        $profile->city = $request->city;
        $profile->state = $request->state;
        $profile->nationality = $request->nationality;
        $profile->gender = $request->gender;
        $profile->marital_status = $request->marital_status;
        $profile->children = $request->children;
        $profile->siblings = $request->siblings;
        $profile->religion = $request->religion;
        $profile->height = $request->height;
        $profile->weight = $request->weight;
        $profile->email = $request->email;
        $profile->phone = $request->phone;
        $profile->father_name = $request->father_name;
        $profile->mother_name = $request->mother_name;
        $profile->father_contact_number = $request->father_contact_number;

        /*Emergency Contact*/
        $profile->emergency_contact_name = $request->emergency_contact_name;
        $profile->emergency_contact_relationship = $request->emergency_contact_relationship;
        $profile->emergency_contact_phone = $request->emergency_contact_phone;
        $profile->emergency_contact_address = $request->emergency_contact_address;

        /*Passport Info*/
        $profile->passport_number = $request->passport_number;
        $profile->passport_issue_date = $request->passport_issue_date;
        $profile->passport_issue_place = $request->passport_issue_place;
        $profile->passport_expire_date = $request->passport_expire_date;
        

        $profile->save();

        if($request->employer_name){
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
        if($request->education_level){
            for($i=0; $i< count($request->education_level); $i++){
                $education = new Education;
                $education->user_id = $user->id;
                $education->education_level = $request->education_level[$i];
                $education->education_remark = $request->education_remark[$i];
                $education->save();
            }
        }
        
        Session::flash('message', ucfirst($role).' Created successfully!! now update profile'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.home');
    }


    public function print($id, $data)
    {
        $user = User::where('id', $id)->first();
        $profile = $user->agent_profile;
        return view('agent.print', compact('data', 'profile'));
    }
}
