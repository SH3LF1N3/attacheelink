<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifydb extends Model
{
    use HasFactory;

    public $table = 'notifydbs';
    
    protected $fillable = [
        'mess',
        'status',
        'from',
        'to',
        'title',
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
