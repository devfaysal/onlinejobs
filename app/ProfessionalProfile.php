<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ProfessionalProfile extends Model
{
    protected $casts = [
        'dob' => 'date'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function country_data(){
        return $this->belongsTo(Country::class, 'country');
    }
    public function dob_day(){

        if($this->dob != null){
            return date('d', strtotime($this->dob));
        }

    }

    public function dob_month(){

        if($this->dob != null){
            return date('m', strtotime($this->dob));
        }

    }

    public function dob_year(){

        if($this->dob != null){
            return date('Y', strtotime($this->dob));
        }

    }

    public function age()
    {
        if($this->dob != null){
            return $this->dob->diff(Carbon::now())->format('%y');
        }else{
            return '';
        }
        
    }
}
