<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use App\Country;
use App\MaritalStatus;
use App\Specialization;
use App\RetiredPersonnel;
use App\Traits\OptionTrait;
use Illuminate\Http\Request;
use App\RetiredPersonnelAcademic;
use App\RetiredPersonnelEducation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RetiredPersonnelRegistration;

class RetiredPersonnelController extends Controller
{
    use OptionTrait;
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
        $academics = RetiredPersonnelAcademic::where('status', 1)->get();
        $specializations = Specialization::where('status', 1)->get();
        $countrys = Country::where('status', 1)->get();
        $health_statements = $this->getOptions('Retired Health Statement');
        return view('retired.create', compact('countrys','marital_statuses','academics','specializations', 'health_statements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users',
        ]);
        if($request->file('resume_file')){
            $this->validate($request, [
                'resume_file' => 'mimes:pdf,doc,docx|max:1024',
            ]);
        }
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
        $retiredPersonnel->govt_department = $request->govt_department;
        $retiredPersonnel->highest_academic_qualification = $request->highest_academic_qualification;
        $retiredPersonnel->specialization = $request->specialization;
        $retiredPersonnel->full_time = $request->full_time;
        $retiredPersonnel->describe_working_hours = $request->describe_working_hours;
        $retiredPersonnel->fit_to_work = $request->fit_to_work;
        $retiredPersonnel->have_blood_pressure = $request->have_blood_pressure;
        $retiredPersonnel->have_diabetes = $request->have_diabetes;
        $retiredPersonnel->health_statement = $request->health_statement;
        $retiredPersonnel->additional_health_statement = $request->additional_health_statement;
        $retiredPersonnel->additional_health_statement = $request->additional_health_statement;
        if($request->file('resume_file')){
            $image_basename = explode('.',$request->file('resume_file')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('resume_file')->getClientOriginalExtension();

            $request->resume_file->storeAs('public/resume', $image);

            //add new image path to database
            $retiredPersonnel->resume = $image;
            
        }
        $retiredPersonnel->save();

        if($request->academic_qualifications && $request->academic_qualifications[0] != null){
            for($i=0; $i< count($request->academic_qualifications); $i++){
                $education = new RetiredPersonnelEducation;
                $education->user_id = $user->id;
                $education->academic_qualification = $request->academic_qualifications[$i];
                $education->specialization = $request->specializations[$i];
                $education->save();
            }
        }
        

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
    public function edit($id)
    {
        $marital_statuses = MaritalStatus::where('status', 1)->get();
        $academics = RetiredPersonnelAcademic::where('status', 1)->get();
        $specializations = Specialization::where('status', 1)->get();
        $countrys = Country::where('status', 1)->get();
        $user = User::where('id', $id)->first();
        $health_statements = $this->getOptions('Retired Health Statement');
        return view('retired.edit', [
            'user' => $user,
            'marital_statuses' => $marital_statuses,
            'academics' => $academics,
            'specializations' => $specializations,
            'countrys' => $countrys,
            'health_statements' => $health_statements,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RetiredPersonnel  $retiredPersonnel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->file('resume_file')){
            $this->validate($request, [
                'resume_file' => 'mimes:pdf,doc,docx|max:1024',
            ]);
        }

        $user = User::where('id', $id)->first();

        $retiredPersonnel = $user->retired_personnel;

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
        $retiredPersonnel->govt_department = $request->govt_department;
        $retiredPersonnel->highest_academic_qualification = $request->highest_academic_qualification;
        $retiredPersonnel->specialization = $request->specialization;
        $retiredPersonnel->full_time = $request->full_time;
        $retiredPersonnel->describe_working_hours = $request->describe_working_hours;
        $retiredPersonnel->fit_to_work = $request->fit_to_work;
        $retiredPersonnel->have_blood_pressure = $request->have_blood_pressure;
        $retiredPersonnel->have_diabetes = $request->have_diabetes;
        $retiredPersonnel->health_statement = $request->health_statement;
        $retiredPersonnel->additional_health_statement = $request->additional_health_statement;
        $retiredPersonnel->additional_health_statement = $request->additional_health_statement;
        if($request->file('resume_file')){
            $image_basename = explode('.',$request->file('resume_file')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('resume_file')->getClientOriginalExtension();

            $request->resume_file->storeAs('public/resume', $image);

            //add new image path to database
            $retiredPersonnel->resume = $image;
            
        }
        $retiredPersonnel->save();

        Session::flash('message', 'Information updated successfully!');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('retiredPersonnel.show', $user->id);
        
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
