<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = ['id', 'username', 'discriminator', 'avatar'];

    public function Roles()
    {
        return $this->belongsToMany(Role::class, 'rule_user', 'user_id', 'role_id');
    }

    public function Bans()
    {
        return $this->hasMany(Ban::class, 'user_id', 'id');
    }

    public function ApplicationFormResponses()
    {
        return $this->hasMany(ApplicationFormResponse::class, 'user_id', 'id');
    }
}
