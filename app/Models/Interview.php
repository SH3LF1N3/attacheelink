<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    protected $fillable = [
        'application_id',
        'interview_date',
        'interview_time',
        'type',
        'location_or_link',
        'notes',
    ];

    protected $casts = [
        'interview_date' => 'date',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}