<?php

namespace App\Http\Controllers\Admin;

use App\Job;
use App\User;
use App\Traits\OptionTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SuggestJobseeker;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Notification;

class JobController extends Controller
{
    use OptionTrait;
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
            $string  = '';
            if(auth()->user()->hasRole('superadministrator')){
                $string .= '<a target="_blank" href="'.route('applicants', $job->id).'" class="btn btn-xs btn-primary">View</a> ';
            }elseif(auth()->user()->hasRole('employer')){
                $string .= '<a target="_blank" href="'.route('job.show', $job->id).'" class="btn btn-xs btn-primary">View</a> ';
                $string .= '<a target="_blank" href="'.route('availableJobseekers', $job->id).'" class="btn btn-xs btn-info">Available Resume</a> ';
            }
            $string .= '<a target="_blank" href="'.route('job.edit', $job->id).'" class="btn btn-xs btn-warning">Edit</a> ';
            if(auth()->user()->hasRole('superadministrator')){
                $string .= '<a target="_blank" href="'.route('admin.job.suggestJobseekers', $job->id).'" class="btn btn-xs btn-info">Suggestion</a> ';
            }
            
            return $string;
        })
        ->addColumn('company_name', function($job) {
            return $job->company()->company_name;
        })
        ->make(true);
    }

    public function getJobseekerByPosition(Job $job)
    {
        $users = User::with('professional_profile')->where('status', 0)->whereRoleIs('professional')->get();

        $users = $users->reject(function ($user) use ($job){
                    return $user->professional_profile->resume_headline != $job->positions_name || $job->alreadyApplied($user->id);
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

    public function suggestJobseekers(Job $job, Request $request)
    {
        $qualifications = $this->getOptions('Job Academic Qualification');
        $field_of_studys = $this->getOptions('Job Academic Field');
        $salarys = $this->getOptions('Jobseeker Search Salary');
        $age_terms = [
            '18-24' => [18, 24],
            '25-35' => [25, 35],
            '36-45' => [36, 45],
            '46-60' => [46, 60],
            'Above 60' => [61, 100],
        ];

        $jobseekers = $job->availableJobseekers();
        if(isset($request->age_term)){
            $jobseekers = $jobseekers->filter(function ($jobseeker) use($age_terms, $request){
                return $jobseeker->professional_profile->age() > $age_terms[$request->age_term][0] && $jobseeker->professional_profile->age() < $age_terms[$request->age_term][1];
            });
        }
        if(isset($request->city)){
            $jobseekers = $jobseekers->filter(function ($jobseeker) use($age_terms, $request){
                return $jobseeker->professional_profile->city == $request->city;
            });
        }
        if(isset($request->qualification)){
            $jobseekers = $jobseekers->filter(function ($jobseeker) use($request){
                $qualifications = $jobseeker->qualifications;
                foreach($qualifications as $qualification){
                    return $qualification->qualification == $request->qualification;
                }
            });
        }
        if(isset($request->field_of_study)){
            $jobseekers = $jobseekers->filter(function ($jobseeker) use($request){
                $qualifications = $jobseeker->qualifications;
                foreach($qualifications as $qualification){
                    return $qualification->subject == $request->field_of_study;
                }
            });
        }
        if(isset($request->salary)){
            $jobseekers = $jobseekers->filter(function ($jobseeker) use($request){
                return $jobseeker->professional_profile->expected_salary <= $request->salary && $jobseeker->professional_profile->expected_salary > $request->salary - 500;
            });
        }

        return view('admin.job.suggestJobseekers', [
            'job' => $job,
            'jobseekers' => $jobseekers,
            'qualifications' => $qualifications,
            'field_of_studys' => $field_of_studys,
            'salarys' => $salarys
        ]);
    }

    public function sendSuggesion(Request $request, Job $job)
    {
        $request->validate([
            'ids' => 'required'
        ]);

        foreach($request->ids as $id){
            $job->jobApplicants()->create([
                'user_id' => $id,
                'suggested_by_admin' => true
            ]);
        }

        $employer = User::find($job->user_id);
        Notification::send($employer, new SuggestJobseeker($job));

        Session::flash('message', 'Suggestion sent successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect(route('admin.job.suggestJobseekers', $job->id));
    }

    public function applicants(Job $job)
    {
        return view('admin.job.applicants', [
            'job' => $job
        ]);
    }

    public function changestatus(Job $job, User $applicant)
    {
        $statuses = [
            '1' => 'Called for interview',
            '2' => 'Finalized interview date',
            '3' => 'Interview Done',
            '4' => 'Hired',
        ];
        return view('admin.job.changestatus', [
            'job' => $job,
            'applicant' => $applicant,
            'data' => $job->jobApplicants->where('user_id', $applicant->id)->first(),
            'statuses' => $statuses
        ]);
    }

    public function updatestatus(Job $job, User $applicant, Request $request)
    {
        $applicant_info = $job->jobApplicants->where('user_id', $applicant->id)->first();
        $applicant_info->status = $request->status;
        if($request->status == 2){
            $applicant_info->interview_date = $request->date;
        }elseif($request->status == 4){
            $applicant_info->hiring_date = $request->date;
        }
        $applicant_info->save();

        Session::flash('message', 'Status Updated successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect(route('applicants', $job->id));
    }

    public function getJobApplicants(Job $job)
    {
        $applicants = $job->jobApplicants->pluck('user_id');

        $users = User::find($applicants);

        return DataTables::of($users)
        ->addColumn('action', function ($user) use ($job) {
            $string = '<a href="'.route('professional.show', $user->id).'" class="btn btn-sm btn-primary">View</a> ';
            $string .= '<a href="'.route('applicants.changestatus', [$job->id, $user->id]).'" class="btn btn-sm btn-warning ml-2">Change Status</a>';
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
        ->addColumn('status', function($user) use($job){
            $string = '';
            $applicant = $job->jobApplicants->where('user_id', $user->id)->first();
            if($applicant->invited_by_employer == true){
                $string .= '<span class="bade badge-success p-1">Selected by Employer</span>';
            }else{
                if($applicant->suggested_by_admin == true){
                    $string .= '<span class="bade badge-warning p-1">Suggested By Admin</span>';
                }elseif($applicant->applied_by_jobseeker == true){
                    $string .= '<span class="bade badge-info p-1">Applied by Jobseeker</span>';
                }
            }
            $statuses = [
                '1' => 'Called for interview',
                '2' => 'Finalized interview date',
                '3' => 'Interview Done',
                '4' => 'Hired',
            ];

            if($applicant->status != null){
                $string .= '<br/><span class="bade badge-success px-1 mt-1" style="display:inline-block">' . $statuses[$applicant->status] . '</span>';
            }
            
            return $string;
        })
        ->rawColumns(['profile_image', 'status', 'action'])
        ->removeColumn('password')
        ->make(true);
    }
}
