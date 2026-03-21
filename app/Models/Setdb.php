<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setdb extends Model
{
    protected $table = 'setdbs';

    protected $fillable = [
        'sname', 'logo', 'email',
        'foth1','foth2','foth3','foth4','foth5',
        'foth6','foth7','foth8','foth9','foth10',
    ];
}