<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function religion_data(){
        return $this->belongsTo(Religion::class, 'religion');
    }
    public function nationality_data(){
        return $this->belongsTo(Country::class, 'nationality');
    }
    public function native_language_data(){
        return $this->belongsTo(Language::class, 'native_language');
    }
    public function skill_level_data(){
        return $this->belongsTo(SkillLevel::class, 'skill_level');
    }
    public function marital_status_data(){
        return $this->belongsTo(MaritalStatus::class, 'marital_status');
    }
    public function gender_data(){
        return $this->belongsTo(Gender::class, 'gender');
    }
}
