<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplicant extends Model
{
    protected $guarded = [];
    /**
     * 1 = Called for interview
     * 2 = finalized interview date
     * 3 = Interview Done
     * 4 = Hired
     */

    protected $casts = [
        'interview_date' => 'date',
        'hiring_date' => 'date'
    ];

    public function jobseeker()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
