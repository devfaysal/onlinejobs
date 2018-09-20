<?php

namespace App\Http\Controllers;

use App\AgentProfile;
use Illuminate\Http\Request;
use App\Country;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Profile;
use Session;

class AgentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if($user->status != 1){
            return view('agent.review');
        }
        $workers_maids = User::whereHas('profile', function ($q) {
            $user = auth()->user();
            $q->where('agent_code', $user->agent_profile->agent_code);
        })->get();

        return view('agent.show', compact('user', 'workers_maids'));
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
        return view('auth.register');
    }

    public function saveuser( Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->public_id = time().md5($request->email);

        $role = $request->role;
        if($role == 'maid' || $role == 'worker'){
            $user->status = 1;
        }elseif($role == 'agent'){
            $user->status = 0;
        }

        $user->save();
  
        if($role == 'maid' || $role == 'worker' || $role == 'agent'){
            $user->attachRole($role);
        }

        if($role == 'maid' || $role == 'worker'){
            $profile = new Profile;
            $profile->user_id = $user->id;
            $profile->agent_code = $request->agent_code;
            $profile->name = $user->name;
            $profile->phone = $user->phone;
            $profile->save();
        }
        Session::flash('message', ucfirst($role).' Created successfully!! now update profile'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('profile.edit', $user->id);
    }
}
