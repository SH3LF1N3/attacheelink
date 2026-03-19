<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permitdb extends Model
{
    use HasFactory;

    public $table = 'permitdbs';

    protected $fillable = [
        // Role name
        'rname',
        // Feature access flags
        'oppo', 'app', 'soppo', 'sappo',
        'ait',  'air', 'aia',
        // Section access
        'stud', 'org', 'not', 'rep', 'prof', 'set',
        // Student CRUD
        'astud', 'estud',
        // Org CRUD
        'aorg',  'eorg',
        // Opportunity CRUD
        'aoppo', 'eoppo',
        // Date ranges / spares
        'da1', 'da2', 'da3',
        'foth1','foth2','foth3','foth4','foth5',
        'foth6','foth7','foth8','foth9','foth10',
    ];

    // Cast all permission flags to booleans automatically
    protected $casts = [
        'oppo'  => 'boolean', 'app'   => 'boolean',
        'soppo' => 'boolean', 'sappo' => 'boolean',
        'ait'   => 'boolean', 'air'   => 'boolean', 'aia' => 'boolean',
        'stud'  => 'boolean', 'org'   => 'boolean',
        'not'   => 'boolean', 'rep'   => 'boolean',
        'prof'  => 'boolean', 'set'   => 'boolean',
        'astud' => 'boolean', 'estud' => 'boolean',
        'aorg'  => 'boolean', 'eorg'  => 'boolean',
        'aoppo' => 'boolean', 'eoppo' => 'boolean',
    ];

    // ── Relationships ────────────────────────────────

    /**
     * Users that have this permission profile assigned.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role', 'rname');
    }

    // ── Helper: load permit for a given role name ────

    public static function forRole(string $role): ?self
    {
        return static::where('rname', $role)->first();
    }

    // ── Permission check shortcuts ───────────────────

    public function can(string $permission): bool
    {
        return (bool) ($this->$permission ?? false);
    }
}