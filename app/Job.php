<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $casts = [
        'closing_date' => 'datetime:d/m/Y',
        'suggested_jobseekers' => 'array'
    ];

    public function languages()
    {
        return $this->hasMany(JobLanguage::class);
    }

    public function academics()
    {
        return $this->hasMany(JobAcademic::class);
    }

    public function company()
    {
        return EmployerProfile::where('user_id', $this->user_id)->first();
    }

    public function jobApplicants()
    {
        return $this->hasMany(JobApplicant::class);
    }
}
