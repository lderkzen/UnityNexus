<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PermissionFlagRolePivot extends Pivot {

    protected $casts = [
        'attached_at' => 'datetime:Y-m-d H:i:s'
    ];
}
