<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $casts = [
        'closing_date' => 'datetime:d/m/Y'
    ];

    public function languages()
    {
        return $this->hasMany(JobLanguage::class);
    }

    public function academics()
    {
        return $this->hasMany(JobAcademic::class);
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function company()
    {
        return EmployerProfile::where('user_id', $this->user_id)->first();
    }

    public function jobApplicants()
    {
        return $this->hasMany(JobApplicant::class);
    }

    public function alreadyApplied($user)
    {
        $applicants = $this->jobApplicants->pluck('user_id')->toArray();

        return in_array($user, $applicants);
    }

    public function suggested_jobseekers()
    {
        return $this->jobApplicants->where('suggested_by_admin', true);
    }

    public function availableJobseekers()
    {
        $users = User::with('professional_profile')->where('status', 0)->whereRoleIs('professional')->get();

        $users = $users->reject(function ($user){
                    return $user->professional_profile->resume_headline != $this->positions_name || $this->alreadyApplied($user->id);
                });
        return $users;
    }
}
