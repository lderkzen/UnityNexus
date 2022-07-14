<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $fillable = ['id', 'name', 'position'];

    public function Users()
    {
        return $this->belongsToMany(User::class, 'rule_user', 'role_id', 'user_id');
    }

    public function PermissionFlags() {
        return $this->belongsToMany(PermissionFlag::class, 'permission_flag_role', 'role_id', 'permission_flag_id')->using(PermissionFlagRolePivot::class)->withPivot(['attached_at']);
    }
}
