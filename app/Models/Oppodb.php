<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oppodb extends Model
{
    use HasFactory;

    public $table = 'oppodbs';
    
    protected $fillable = [
        'oname',
        'org',
        'loc',
        'duration',
        'dead',
        'slot',
        'descr',
        'status',
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
