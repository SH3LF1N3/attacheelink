<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationPreference extends Model
{
    protected $fillable = ['user_id', 'in_app', 'email'];

    protected $casts = [
        'in_app' => 'boolean',
        'email'  => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get or create preference for a user, defaulting both channels to true.
     */
    public static function forUser(int $userId): self
    {
        return static::firstOrCreate(
            ['user_id' => $userId],
            ['in_app' => true, 'email' => true]
        );
    }
}