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
    public function show(Agent $agent)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit(Agent $agent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agent $agent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agent $agent)
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
        Session::flash('message', ucfirst($role).' Created under this agent successfully!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('agent.index');
    }
}
