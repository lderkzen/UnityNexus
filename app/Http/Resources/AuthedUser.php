<?php

namespace App\Http\Resources;

use App\Models\PermissionFlag;
use App\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthedUser extends JsonResource
{
    public function toArray($request)
    {
        $flags = [];
        $roles = $this->roles();
        $roles->each(function (Role $role) use (&$flags) {
            $role->permissionFlags()->each(function (PermissionFlag $flag) use (&$flags) {
                array_push($flags, $flag->flag);
            });
        });

        return [
            'id' => $this->id,
            'username' => "{$this->username}#{$this->discriminator}",
            'flags' => $flags
        ];
    }
}
