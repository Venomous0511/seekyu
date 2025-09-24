<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // if using auth
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'accounts';

    protected $fillable = [
        'account_id', 'full_name', 'username', 'role', 'password', 'removed_at'
    ];

    protected $hidden = ['password'];

    public function isRemoved(): bool {
        return !is_null($this->removed_at);
    }
}
