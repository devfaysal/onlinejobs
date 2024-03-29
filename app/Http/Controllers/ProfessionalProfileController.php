<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use App\Country;
use Carbon\Carbon;
use App\Qualification;
use App\Traits\OptionTrait;
use App\ProfessionalProfile;
use Illuminate\Http\Request;
use App\ProfessionalExperience;
use Illuminate\Support\Facades\Auth;

class ProfessionalProfileController extends Controller
{
    use OptionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()){
            return redirect()->route('professional.profile');
        }
        return view('professional.index');
    }

    public function profile()
    {
        $user = Auth::user();

        $totalExperience = $this->calculateTotalYearsOfExperience($user);

        return view('professional.show', [
            'user' => $user,
            'totalExperience' => $totalExperience
        ]);
    }

    public function calculateTotalYearsOfExperience($user)
    {
        if($user->professional_experiences->count() > 0){

            foreach($user->professional_experiences as $experience){

                $all_from_dates[] = $experience->from;
    
                $all_to_dates[] = $experience->to ?? date('Y-m-d', time());
    
            }
    
            $from = min($all_from_dates);
    
            $to = max($all_to_dates);
    
            return Carbon::parse($from)->diffInYears(Carbon::parse($to));
        }

        return 0;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $qualifications = $this->getOptions('Job Academic Qualification');
        $field_of_studys = $this->getOptions('Job Academic Field');
        $countrys = Country::where('status', 1)->get();

        return view('professional.create', [
            'countrys' => $countrys,
            'qualifications' => $qualifications,
            'field_of_studys' => $field_of_studys
        ]);
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
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        $totalExperience = $this->calculateTotalYearsOfExperience($user);
        return view('professional.show', [
            'user' => $user,
            'totalExperience' => $totalExperience
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProfessionalProfile  $professionalProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(User $professional)
    {
        $PositionNames = $this->getOptions('Position Name');
        $qualifications = $this->getOptions('Job Academic Qualification');
        $field_of_studys = $this->getOptions('Job Academic Field');
        $countrys = Country::where('status', 1)->get();
        return view('professional.edit',[
            'user' => $professional,
            'countrys' => $countrys,
            'PositionNames' => $PositionNames,
            'qualifications' => $qualifications,
            'field_of_studys' => $field_of_studys
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
        $professional->highest_qualification = $request->qualification;
        $professional->subject = $request->subject;
        $professional->skills = $request->skills;
        $professional->it_skills = $request->it_skills;
        $professional->city = $request->city;
        $professional->country = $request->country;
        $professional->current_salary = $request->current_salary;
        $professional->expected_salary = $request->expected_salary;
        $professional->email = $request->email;
        $professional->phone = $request->phone;
        $professional->dob = $request->dob_year .'-'. $request->dob_month.'-'. $request->dob_day;
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

        return redirect()->route('professional.profile');
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
        $qualifications = $this->getOptions('Job Academic Qualification');
        $field_of_studys = $this->getOptions('Job Academic Field');

        return view('professional.editQualification', [
            'user' => $user,
            'qualifications' => $qualifications,
            'field_of_studys' => $field_of_studys
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
                $qualification->graduation_date = $request->graduation_year[$i] .'-'. $request->graduation_month[$i].'-'. $request->graduation_day[$i];
                $qualification->save();
            }
            if(request('type') == 'pro'){
                return redirect()->route('professionalExperience.edit', $user->id);
            }else{
                return redirect()->route('professional.profile'); 
            }
            
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
                $professional_experience->from = $request->from_year[$i] .'-'. $request->from_month[$i].'-'. '1';
                if($request->to_year[$i]){
                    $professional_experience->to = $request->to_year[$i] .'-'. $request->to_month[$i].'-'. '1';
                }
                $professional_experience->position_level = $request->position_level[$i];
                $professional_experience->experience_description = $request->experience_description[$i];
                $professional_experience->is_present_job = $request->is_present_job[$i];
                $professional_experience->save();
            }

            return redirect()->route('professional.profile');
        }
    }
}
