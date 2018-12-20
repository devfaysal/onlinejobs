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
        $jobs = Job::all();

        return DataTables::of($jobs)
        ->addColumn('action', function ($job) {
            $string = '<a href="'.route('job.show', $job->id).'" class="btn btn-xs btn-primary">View</a> ';
            return $string;
        })
        ->make(true);
    }
}
