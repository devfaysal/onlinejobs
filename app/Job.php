<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $casts = [
        'closing_date' => 'datetime:d/m/Y',
    ];
}
