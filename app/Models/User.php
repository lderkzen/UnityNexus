<?php

namespace App\Models;

use App\Http\Facades\Discord;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    public $timestamps = false;
    protected $fillable = ['id', 'username', 'discriminator', 'joined_at', 'avatar', 'deleted_at'];
    protected $casts = [
        'deleted_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function roles() {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }
}
