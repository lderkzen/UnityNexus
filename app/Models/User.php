<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasFactory;

    public $timestamps = false;
    protected $fillable = ['id', 'username', 'discriminator', 'joined_at', 'avatar'];
    protected $appends = ['banned'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function submissions()
    {
        return $this->hasMany(ApplicationSubmission::class, 'applicant_id', 'id');
    }

    public function assignments()
    {
        return $this->hasMany(ApplicationSubmission::class, 'assigned_id', 'id');
    }

    public function auditLogEntries()
    {
        return $this->hasMany(AuditLogEntry::class, 'user_id', 'id');
    }
}
