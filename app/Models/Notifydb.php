<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifydb extends Model
{
    use HasFactory;

    public $table = 'notifydbs';

    protected $fillable = [
        'title', 'mess', 'status', 'from', 'to',
        'foth1','foth2','foth3','foth4','foth5',
        'foth6','foth7','foth8','foth9','foth10',
    ];

    // Scopes

    public function scopeForUser($query, string $uname)
    {
        return $query->where('to', $uname)->orWhere('to', 'all');
    }

    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    // Helpers

    /**
     * Send an in-app notification to a specific user or 'all'.
     */
    public static function send(string $to, string $title, string $message, string $from = 'system'): self
    {
        return static::create([
            'to'     => $to,
            'from'   => $from,
            'title'  => $title,
            'mess'   => $message,
            'status' => 'unread',
        ]);
    }

    public function markRead(): void
    {
        $this->update(['status' => 'read']);
    }

    public function isUnread(): bool
    {
        return $this->status === 'unread';
    }
}