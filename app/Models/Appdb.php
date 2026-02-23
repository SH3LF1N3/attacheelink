<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appdb extends Model
{
    use HasFactory;

    public $table = 'appdbs';
    
    protected $fillable = [
        'role',
        'org',
        'date',
        'status',
        'stud',
        'foth1',
        'foth2',
        'foth3',
        'foth4',
        'foth5',
        'foth6',
        'foth7',
        'foth8',
        'foth9',
        'foth10',

    ];
}
