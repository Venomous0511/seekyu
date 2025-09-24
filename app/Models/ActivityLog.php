<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'log_id','time_iso','user_id','account_id','name','role','type','source','details'
    ];
    protected $casts = ['time_iso' => 'datetime'];
}
