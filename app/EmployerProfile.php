<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployerProfile extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function country_data(){
        return $this->belongsTo(Country::class, 'country');
    }
    public function company_country_data(){
        return $this->belongsTo(Country::class, 'company_country');
    }

    public function offers(){
        return $this->hasMany(Offer::class, 'employer_id', 'user_id');
    }

    public function hireCount()
    {
        $count = 0;
        foreach($this->offers as $offer){
            $count += $offer->applicants->where('status', 3)->count();
        }

        return $count;
    }
}
