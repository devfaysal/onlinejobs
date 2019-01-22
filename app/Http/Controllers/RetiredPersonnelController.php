<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use App\Country;
use App\MaritalStatus;
use App\RetiredPersonnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RetiredPersonnelRegistration;

class RetiredPersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('retired.index');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('retired.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marital_statuses = MaritalStatus::where('status', 1)->get();
        $countrys = Country::where('status', 1)->get();
        return view('retired.create', compact('countrys','marital_statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make('DefPassRetired');
        $user->public_id = time().md5($request->email);

        $user_country = $request->country;
        $user->code = $this->user_code($user_country);
        $user->save();

        $user->attachRole('retired');

        $retiredPersonnel = new RetiredPersonnel;
        $retiredPersonnel->user_id = $user->id;
        $retiredPersonnel->name = $request->name;
        $retiredPersonnel->nric = $request->nric;
        $retiredPersonnel->address = $request->address;
        $retiredPersonnel->postcode = $request->postcode;
        $retiredPersonnel->state = $request->state;
        $retiredPersonnel->age = $request->age;
        $retiredPersonnel->gender = $request->gender;
        $retiredPersonnel->email = $request->email;
        $retiredPersonnel->phone = $request->phone;
        $retiredPersonnel->marital_status = $request->marital_status;
        $retiredPersonnel->country = $request->country;
        $retiredPersonnel->government_employee = $request->government_employee;
        $retiredPersonnel->highest_academic_qualification = $request->highest_academic_qualification;
        $retiredPersonnel->specialization = $request->specialization;
        $retiredPersonnel->full_time = $request->full_time;
        $retiredPersonnel->describe_working_hours = $request->describe_working_hours;
        $retiredPersonnel->save();

        Session::flash('message', 'Information saved successfully!'); 
        Session::flash('alert-class', 'alert-success');
        Auth::login($user);
        //Send notification to admins
        $data = $user;
        $admins = User::whereRoleIs('superadministrator')->get();
        Notification::send($admins, new RetiredPersonnelRegistration($data));
        return redirect()->route('retiredPersonnelExperience.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RetiredPersonnel  $retiredPersonnel
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $user = User::where('id', $id)->first();
        return view('retired.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RetiredPersonnel  $retiredPersonnel
     * @return \Illuminate\Http\Response
     */
    public function edit(RetiredPersonnel $retiredPersonnel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RetiredPersonnel  $retiredPersonnel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RetiredPersonnel $retiredPersonnel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RetiredPersonnel  $retiredPersonnel
     * @return \Illuminate\Http\Response
     */
    public function destroy(RetiredPersonnel $retiredPersonnel)
    {
        //
    }

    public function user_code($country_id)
    {
        $country = Country::where('id', $country_id)->first();
        for($i=1; $i<10000; $i++){
            if($i < 10){
                //00009
                $j = '0000' . $i;
            }elseif($i >= 10 && $i < 100){
                //00099
                $j = '000' . $i;
            }elseif($i >= 100 && $i < 1000){
                //00999
                $j = '00' . $i;
            }elseif($i >= 1000 && $i < 10000){
                //09999
                $j = '0' . $i;
            }else{
                //99999
                $j = $i;
            }
            $user_code = $country->code . $j;
            if(!User::where('code', '=', $user_code)->exists()){
                break;
            }
        }
        return $user_code;
    }
}
