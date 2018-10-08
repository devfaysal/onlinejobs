<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployerProfile extends Model
{
    public function country_data(){
        return $this->belongsTo(Country::class, 'country');
    }
}
