<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logsdb extends Model
{
    use HasFactory;

    public $table = 'logsdbs';
    
    protected $fillable = [
         'uid',
         'uname',
         'role',
         'service',
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
