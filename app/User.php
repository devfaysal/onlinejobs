<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    protected $casts = [
        'created_at' => 'datetime:d/m/Y g:i A',
        'updated_at' => 'datetime:d/m/Y g:i A',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'phone', 'password', 'public_id','status'
    // ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function agent_profile(){
        return $this->hasOne(AgentProfile::class);
    }

    public function employer_profile(){
        return $this->hasOne(EmployerProfile::class);
    }

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function experiences(){
        return $this->hasMany(Experience::class);
    }
    public function educations(){
        return $this->hasMany(Education::class);
    }

    public function applicants(){
        return $this->hasMany(Applicant::class);
    }

    public function professional_profile(){
        return $this->hasOne(ProfessionalProfile::class);
    }
    public function retired_personnel(){
        return $this->hasOne(RetiredPersonnel::class);
    }
    public function retired_personnel_language(){
        return $this->hasMany(RetiredPersonnelsLanguage::class);
    }
    public function retired_personnel_experiences(){
        return $this->hasMany(RetiredPersonnelsWorkExperience::class);
    }
    public function professional_experiences(){
        return $this->hasMany(ProfessionalExperience::class);
    }
    public function qualifications(){
        return $this->hasMany(Qualification::class);
    }
}
