<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logsdb extends Model
{
    protected $table = 'logsdbs';

    protected $fillable = [
        'uid', 'uname', 'role', 'service',
        'foth1','foth2','foth3','foth4','foth5',
        'foth6','foth7','foth8','foth9','foth10',
    ];

    // Helper: write a log entry 

    public static function record(string $service, $user = null): void
    {
        $user = $user ?? auth()->user();

        static::create([
            'uid'     => $user?->id,
            'uname'   => $user?->uname,
            'role'    => $user?->role,
            'service' => $service,
        ]);
    }
}