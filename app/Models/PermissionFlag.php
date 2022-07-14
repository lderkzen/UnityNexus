<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionFlag extends Model
{
    protected $fillable = ['name'];

    public function Roles() {
        return $this->belongsToMany(Role::class, 'permission_flag_role', 'permission_flag_id', 'role_id')->using(PermissionFlagRolePivot::class)->withPivot(['attached_at']);
    }
}
