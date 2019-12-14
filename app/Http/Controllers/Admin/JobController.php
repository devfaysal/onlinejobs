<?php

namespace App\Http\Controllers\Admin;

use App\Job;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SuggestJobseeker;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Notification;

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
            if(auth()->user()->hasRole('superadministrator')){
                $string .= '<a target="_blank" href="'.route('admin.job.suggestJobseekers', $job->id).'" class="btn btn-xs btn-info">Suggestion</a> ';
            }
            
            return $string;
        })
        ->make(true);
    }

    public function getJobseekerByPosition(Job $job)
    {
        $users = User::with('professional_profile')->where('status', 0)->whereRoleIs('professional')->get();

        $users = $users->reject(function ($user) use ($job){
                    return $user->professional_profile->resume_headline != $job->positions_name || in_array($user->id, $job->suggested_jobseekers ?: []);
                });
        
        return DataTables::of($users)
        ->addColumn('action', function ($user) {
            $string = '<a href="'.route('professional.show', $user->id).'" class="btn btn-sm btn-primary">View</a> ';
            $string .= ' <input class="ml-1" type="checkbox" name="ids[]" value="'.$user->id.'">';
            return $string;
        })
        ->addColumn('city', function($user) {
            return $user->professional_profile['city'];
        })
        ->addColumn('profile_image', function($user) {
            $img = $user->professional_profile['profile_image'] != '' ? asset('storage/resume/'.$user->professional_profile['profile_image']) :  asset('images/dummy.jpg');
            return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
        })
        ->addColumn('name', function($user) {
            return $user->professional_profile['name'];
        })
        ->addColumn('age', function($user) {
            return $user->professional_profile->age();
        })
        ->addColumn('education', function($user) {
            return $user->professional_profile->highest_qualification;
        })
        ->addColumn('position', function($user) {
            return $user->professional_profile->resume_headline;
        })
        ->addColumn('email', function($user) {
            return $user->professional_profile['email'];
        })
        ->rawColumns(['profile_image', 'action'])
        ->removeColumn('password')
        ->make(true);
    }

    public function suggestJobseekers(Job $job)
    {
        return view('admin.job.suggestJobseekers', [
            'job' => $job
        ]);
    }

    public function sendSuggesion(Request $request, Job $job)
    {
        if($job->suggested_jobseekers == null){
            $job->suggested_jobseekers = $request->ids;
        }else{
            $job->suggested_jobseekers = array_merge($job->suggested_jobseekers, $request->ids);
        }
        
        $job->save();

        $employer = User::find($job->user_id);
        Notification::send($employer, new SuggestJobseeker());

        Session::flash('message', 'Invitation sent successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect(route('admin.job.suggestJobseekers', $job->id));
    }
}
