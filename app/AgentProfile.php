<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentProfile extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function country_data(){
        return $this->belongsTo(Country::class, 'agency_country');
    }
    public function nationality_data(){
        return $this->belongsTo(Country::class, 'nationality');
    }
}
