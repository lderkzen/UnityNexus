<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLogEntry extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'entry', 'created_at'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s'
    ];
}
