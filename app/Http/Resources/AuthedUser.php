<?php

namespace App\Http\Resources;

use App\Models\PermissionFlag;
use App\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthedUser extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => "{$this->username}#{$this->discriminator}",
        ];
    }
}
