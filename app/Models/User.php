<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string|null $uname
 * @property string|null $fname
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $gender
 * @property string|null $role
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'uname', 'fname', 'phone', 'gender', 'role',
        'cv', 'sid', 'email', 'password',
        'foth1','foth2','foth3','foth4','foth5',
        'foth6','foth7','foth8','foth9','foth10',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // Relationships 
    /**
     * Applications submitted by this student.
     * Used by Reports::studentStats() for withCount('applications').
     */
    public function applications()
    {
        return $this->hasMany(Application::class, 'user_id');
    }
}