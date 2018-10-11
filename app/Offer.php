<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
}
