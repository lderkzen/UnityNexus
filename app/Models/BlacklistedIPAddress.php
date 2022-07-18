<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlacklistedIPAddress extends Model
{
    const CREATED_AT = 'blacklisted_at';

    public $timestamps = false;
    protected $primaryKey = 'ip_address';
    protected $fillable = ['ip_address', 'blacklisted_at'];
    protected $casts = [
        'blacklisted_at' => 'datetime:Y-m-d H:i:s'
    ];
}
