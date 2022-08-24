<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannedUser extends Model
{
    const CREATED_AT = 'banned_at';

    public $timestamps = false;
    protected $fillable = ['id'];
}
