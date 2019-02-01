<?php

namespace App\Http\Controllers\Admin;

use App\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.job.index');
    }

    public function getJobsData()
    {
        if(auth()->user()->hasRole('employer')){
            $jobs = Job::where('user_id', auth()->id())->get();
        }else{
            $jobs = Job::all();
        }


        return DataTables::of($jobs)
        ->addColumn('action', function ($job) {
            $string  = '<a target="_blank" href="'.route('job.show', $job->id).'" class="btn btn-xs btn-primary">View</a> ';
            $string .= '<a target="_blank" href="'.route('job.edit', $job->id).'" class="btn btn-xs btn-warning">Edit</a> ';
            return $string;
        })
        ->make(true);
    }
}
