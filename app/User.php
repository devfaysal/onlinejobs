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
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'public_id','status'
    ];

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

    public function applicants(){
        return $this->hasMany(Applicant::class);
    }
}
