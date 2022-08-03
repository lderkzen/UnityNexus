<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;
    protected $fillable = ['id', 'name', 'position'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }

    public function permissionFlags()
    {
        return $this->belongsToMany(PermissionFlag::class, 'permission_flag_role', 'role_id', 'permission_flag_id');
    }
}
