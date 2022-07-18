<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannedUser extends Model
{
    const CREATED_AT = 'banned_at';

    public $timestamps = false;
    protected $fillable = ['id', 'banned_at'];
    protected $casts = [
        'banned_at' => 'datetime:Y-m-d H:i:s'
    ];
}
