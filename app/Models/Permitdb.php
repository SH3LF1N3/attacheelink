<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permitdb extends Model
{
    use HasFactory;

    public $table = 'permitdbs';
    
    protected $fillable = [
        'rname',
        'oppo',
        'app',
        'soppo',
        'sappo',
        'ait',
        'air',
        'aia',
        'stud',
        'org',
        'not',
        'rep',
        'prof',
        'set',
        'astud',
        'estud',
        'aorg',
        'eorg',
        'aoppo',
        'eoppo',
        'da1',
        'da2',
        'da3',
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
