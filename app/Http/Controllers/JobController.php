<?php

namespace App\Http\Controllers;

use Session;
use App\Job;
use Illuminate\Http\Request;

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
        return view('job.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $job = new Job;
        $job->user_id = auth()->user()->id;
        $job->title = $request->title;
        $job->company = $request->company;
        $job->description = $request->description;
        $job->location = $request->location;
        $job->salary_range_1 = $request->salary_range_1;
        $job->salary_range_2 = $request->salary_range_2;
        $job->vacancy = $request->vacancy;
        $job->nature = $request->nature;
        $job->save();

        Session::flash('message', 'Job Posted Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('job.index');
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
        //
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
        //
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
