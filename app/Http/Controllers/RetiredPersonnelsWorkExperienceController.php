<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\RetiredPersonnelsWorkExperience;

class RetiredPersonnelsWorkExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('retired.addExperience');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        if($request->company_name && $request->company_name[0] != null){
            for($i=0; $i< count($request->company_name); $i++){
                $experience = new RetiredPersonnelsWorkExperience;
                $experience->user_id = auth()->id();
                $experience->company_name = $request->company_name[$i];
                $experience->address = $request->address[$i];
                $experience->position = $request->position[$i];
                $experience->work_description = $request->work_description[$i];
                $experience->from = $request->from[$i];
                $experience->to = $request->to[$i];
                $experience->nature_of_company_business = $request->nature_of_company_business[$i];
                $experience->save();
            }
        }

        Session::flash('message', 'Information saved successfully!'); 
        Session::flash('alert-class', 'alert-success');
        
        return redirect()->route('retiredPersonnelsLanguage.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
