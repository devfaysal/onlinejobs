<?php

namespace App\Http\Controllers;

use App\Job;
use Session;
use App\Language;
use App\Facilities;
use App\JobAcademic;
use App\JobLanguage;
use App\Specialization;
use Illuminate\Http\Request;
use App\RetiredPersonnelAcademic;

class JobController extends Controller
{
    public function search(Request $request)
    {
        $jobs = Job::where('status', 1)
                    ->when($request->title, function($query) use($request){
                        return $query->where('title', 'like', '%'.$request->title.'%');
                    })
                    ->when($request->location, function($query) use($request){
                        return $query->where('location', $request->location);
                    })
                    ->when($request->experience, function($query) use($request){
                        return $query->where('location', $request->location);
                    })
                    ->when($request->salary, function($query) use($request){
                        return $query->where('salary_range_1','<', $request->salary);
                    })->get();

        return view('job.index', [
            'jobs' => $jobs
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->q == 'location'){
            $jobs = Job::where('location', $request->c)->get();
        }elseif($request->q == 'skill'){
            $jobs = Job::where('location', $request->c)->get();
        }elseif($request->q == 'designation'){
            $jobs = Job::where('location', $request->c)->get();
        }elseif($request->q == 'category'){
            $jobs = Job::where('location', $request->c)->get();
        }else{
            $jobs = Job::all();
        }
        
        return view('job.index', [
            'jobs' => $jobs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $academics = RetiredPersonnelAcademic::where('status', 1)->get();
        $academic_fields = Specialization::where('status', 1)->get();
        $languages = Language::where('status', 1)->get();
        $facilities = Facilities::where('status', 1)->get();
        return view('job.create', compact('facilities','languages','academics','academic_fields'));
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
            'positions_name' => 'required',
            'closing_date' => 'date',
            'vacancies_description' => 'required',
        ]);
        $job = new Job;
        $job->user_id = auth()->id();
        $job->positions_name = $request->positions_name;
        $job->vacancies_description = $request->vacancies_description;
        $job->scope_of_duties = $request->scope_of_duties;
        $job->skills = $request->skills;
        $job->related_experience_year = $request->related_experience_year;
        // $job->related_experience_month = $request->related_experience_month;
        $job->job_vacancies_type = $request->job_vacancies_type;
        $job->salary_offer_currency = $request->salary_offer_currency;
        $job->salary_offer = $request->salary_offer;
        $job->salary_offer_period = $request->salary_offer_period;
        $job->postcode = $request->postcode;
        $job->district = $request->district;
        $job->town = $request->town;
        $job->state = $request->state;
        $job->total_number_of_vacancies = $request->total_number_of_vacancies;
        $job->closing_date = $request->closing_date;
        $job->working_hours = $request->working_hours;
        $job->person_in_charge = $request->person_in_charge;
        $job->telephone_number = $request->telephone_number;
        $job->handphone_number = $request->handphone_number;
        $job->email = $request->email;
        $job->gender = $request->gender;
        $job->marital_status = $request->marital_status;
        $job->race = $request->race;
        $job->age_eligibillity = $request->age_eligibillity;
        $job->other_requirements = $request->other_requirements;
        $job->facilities = implode(", " , $request->facilities);
        // $job->language = $request->language;
        $job->minimum_academic_qualification = $request->minimum_academic_qualification;
        $job->academic_field = $request->academic_field;
        $job->driving_license = $request->driving_license;
        $job->other_skills = $request->other_skills;
        
        $job->save();

        if($request->language && $request->language[0] != null){
            for($i=0; $i< count($request->language); $i++){
                $language = new JobLanguage;
                $language->job_id = $job->id;
                $language->language = $request->language[$i];
                $language->speaking = $request->speaking[$i];
                $language->writing = $request->writing[$i];
                $language->save();
            }
        }

        if($request->academic_qualifications && $request->academic_qualifications[0] != null){
            for($i=0; $i< count($request->academic_qualifications); $i++){
                $education = new JobAcademic;
                $education->job_id = $job->id;
                $education->academic_qualification = $request->academic_qualifications[$i];
                $education->academic_field = $request->academic_fields[$i];
                $education->save();
            }
        }

        Session::flash('message', 'Job Posted Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('job.show', $job->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        return view('job.show', [
            'job' => $job
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        $academics = RetiredPersonnelAcademic::where('status', 1)->get();
        $academic_fields = Specialization::where('status', 1)->get();
        $languages = Language::where('status', 1)->get();
        $facilities = Facilities::where('status', 1)->get();
        return view('job.edit', compact('job','facilities','languages','academics','academic_fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $this->validate($request, [
            'positions_name' => 'required',
            'closing_date' => 'date',
            'vacancies_description' => 'required',
        ]);

        $job->positions_name = $request->positions_name;
        $job->vacancies_description = $request->vacancies_description;
        $job->scope_of_duties = $request->scope_of_duties;
        $job->skills = $request->skills;
        $job->related_experience_year = $request->related_experience_year;
        // $job->related_experience_month = $request->related_experience_month;
        $job->job_vacancies_type = $request->job_vacancies_type;
        $job->salary_offer_currency = $request->salary_offer_currency;
        $job->salary_offer = $request->salary_offer;
        $job->salary_offer_period = $request->salary_offer_period;
        $job->postcode = $request->postcode;
        $job->district = $request->district;
        $job->town = $request->town;
        $job->state = $request->state;
        $job->total_number_of_vacancies = $request->total_number_of_vacancies;
        $job->closing_date = $request->closing_date;
        $job->working_hours = $request->working_hours;
        $job->person_in_charge = $request->person_in_charge;
        $job->telephone_number = $request->telephone_number;
        $job->handphone_number = $request->handphone_number;
        $job->email = $request->email;
        $job->gender = $request->gender;
        $job->marital_status = $request->marital_status;
        $job->race = $request->race;
        $job->age_eligibillity = $request->age_eligibillity;
        $job->other_requirements = $request->other_requirements;
        $job->facilities = implode(", " , $request->facilities);
        // $job->language = $request->language;
        $job->minimum_academic_qualification = $request->minimum_academic_qualification;
        $job->academic_field = $request->academic_field;
        $job->driving_license = $request->driving_license;
        $job->other_skills = $request->other_skills;
        
        $job->save();

        if($request->language && $request->language[0] != null){
            foreach($job->languages as $language){
                $language->delete();
            }
            for($i=0; $i< count($request->language); $i++){
                $language = new JobLanguage;
                $language->job_id = $job->id;
                $language->language = $request->language[$i];
                $language->speaking = $request->speaking[$i];
                $language->writing = $request->writing[$i];
                $language->save();
            }
        }

        if($request->academic_qualifications && $request->academic_qualifications[0] != null){
            foreach($job->academics as $academic){
                $academic->delete();
            }
            for($i=0; $i< count($request->academic_qualifications); $i++){
                $education = new JobAcademic;
                $education->job_id = $job->id;
                $education->academic_qualification = $request->academic_qualifications[$i];
                $education->academic_field = $request->academic_fields[$i];
                $education->save();
            }
        }

        Session::flash('message', 'Job Updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('job.show', $job->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }
}
