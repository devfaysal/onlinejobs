<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use App\Country;
use App\Qualification;
use App\ProfessionalProfile;
use Illuminate\Http\Request;
use App\ProfessionalExperience;
use Illuminate\Support\Facades\Auth;

class ProfessionalProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()){
            $user = Auth::user();
            return view('professional.index', [
                'user' => $user
            ]);
        }
        return view('professional.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countrys = Country::where('status', 1)->get();
        return view('professional.create', compact('countrys'));
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
     * @param  \App\ProfessionalProfile  $professionalProfile
     * @return \Illuminate\Http\Response
     */
    public function show(ProfessionalProfile $professionalProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProfessionalProfile  $professionalProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(User $professional)
    {
        return view('professional.edit',[
            'user' => $professional
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProfessionalProfile  $professionalProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $professional)
    {
        if($request->file('resume_file')){
            $this->validate($request, [
                'resume_file' => 'mimes:pdf,doc,docx|max:1024',
            ]);
        }
        if($request->file('profile_image')){
            $this->validate($request, [
                'profile_image' => 'image|max:1024',
            ]);
        }
        $professional = $professional->professional_profile;
        $professional->name = $request->name;
        $professional->resume_headline = $request->resume_headline;
        $professional->skills = $request->skills;
        $professional->city = $request->city;
        $professional->country = $request->country;
        $professional->current_salary = $request->current_salary;
        $professional->expected_salary = $request->expected_salary;
        $professional->email = $request->email;
        $professional->phone = $request->phone;
        if($request->file('resume_file')){
            $image_basename = explode('.',$request->file('resume_file')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('resume_file')->getClientOriginalExtension();

            $request->resume_file->storeAs('public/resume', $image);

            //add new image path to database
            $professional->resume_file = $image;
            
        }
        if($request->file('profile_image')){
            $image_basename = explode('.',$request->file('profile_image')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('profile_image')->getClientOriginalExtension();

            $request->profile_image->storeAs('public/resume', $image);

            //add new image path to database
            $professional->profile_image = $image;
            
        }
        $professional->save();
        Session::flash('message', 'Profile Updated Successfully!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('professional.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProfessionalProfile  $professionalProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfessionalProfile $professionalProfile)
    {
        //
    }

    public function editQualification(User $user)
    {
        return view('professional.editQualification', [
            'user' => $user
        ]);
    }

    public function updateQualification(Request $request, User $user)
    {
        if($request->qualification){
            foreach($user->qualifications as $qualification){
                $qualification->delete();
            }

            for($i=0; $i< count($request->qualification); $i++){
                $qualification = new Qualification;
                $qualification->user_id = $user->id;
                $qualification->qualification = $request->qualification[$i];
                $qualification->subject = $request->subject[$i];
                $qualification->specialization = $request->specialization[$i];
                $qualification->university = $request->university[$i];
                $qualification->passing_year = $request->passing_year[$i];
                $qualification->save();
            }

            return redirect()->route('professionalExperience.edit', $user->id);
        }
    }

    public function editProfessionalExperience(User $user)
    {
        return view('professional.editProfessionalExperience', [
            'user' => $user
        ]);
    }

    public function updateProfessionalExperience(Request $request, User $user)
    {
        if($request->designation){
            foreach($user->professional_experiences as $professional_experience){
                $professional_experience->delete();
            }

            for($i=0; $i< count($request->designation); $i++){
                $professional_experience = new ProfessionalExperience;
                $professional_experience->user_id = $user->id;
                $professional_experience->designation = $request->designation[$i];
                $professional_experience->company = $request->company[$i];
                $professional_experience->from = $request->from[$i];
                $professional_experience->to = $request->to[$i];
                $professional_experience->save();
            }

            return redirect()->route('professional.index');
        }
    }
}
