<?php

namespace App\Http\Controllers;

use App\User;
use App\Qualification;
use App\ProfessionalProfile;
use Illuminate\Http\Request;
use App\ProfessionalExperience;

class ProfessionalProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('professional.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('professional.create');
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
        return $request;
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

            return redirect()->route('professional.edit', $user->id);
        }
    }
}
