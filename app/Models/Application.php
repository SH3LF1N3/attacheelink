<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'user_id',
        'oppodb_id',
        'cv_path',
        'cover_letter',
        'additional_info',
        'status',
    ];

    public function opportunity()
    {
        return $this->belongsTo(Oppodb::class, 'oppodb_id');
    }

    public function student()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function interview()
    {
        return $this->hasOne(\App\Models\Interview::class);
    }
}