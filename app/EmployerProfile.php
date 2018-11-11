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
}
