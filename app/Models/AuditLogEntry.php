<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLogEntry extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'entry'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
