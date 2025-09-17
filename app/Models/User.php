<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role_id',
        'role',
        'name',
        'email',
        'password',
        'status',
    ];

    // Active Guards
    public function scopeActiveGuards($query)
    {
        return $query->where('role', 'security_guard')
            ->where('status', 'active');
    }

    // Active Clients
    public function scopeActiveClients($query)
    {
        return $query->where('role', 'client')
            ->where('status', 'active');
    }

    // Pending Requests (applicants or guards waiting approval)
    public function scopePendingRequests($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
