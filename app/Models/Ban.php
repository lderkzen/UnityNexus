<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Ban extends Model
{
    protected $fillable = ['user_id', 'banned_at'];
    protected $hidden = ['ip_address'];
    protected $casts = [
        'banned_at' => 'datetime:Y-m-d H:i:s'
    ];

    /**
     * Interact with the user's address.
     *
     * @return  Attribute
     */
    protected function ip_address(): Attribute
    {
        return Attribute::make(
            set: fn ($val) => Hash::make($val)
        );
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
