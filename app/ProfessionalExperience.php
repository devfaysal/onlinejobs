<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfessionalExperience extends Model
{
    public function from_day(){

        return date('d', strtotime($this->from));

    }

    public function from_month(){

        return date('m', strtotime($this->from));

    }

    public function from_year(){

        return date('Y', strtotime($this->from));

    }

    public function to_day(){

        return date('d', strtotime($this->to));

    }

    public function to_month(){

        return date('m', strtotime($this->to));

    }

    public function to_year(){

        return date('Y', strtotime($this->to));

    }
}
