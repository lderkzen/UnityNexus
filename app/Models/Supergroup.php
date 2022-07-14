<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supergroup extends Model
{
    protected $fillable = ['name', 'deleted_at'];
    protected $casts = [
        'deleted_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function Groups() {
        return $this->hasMany(Group::class, 'supergroup_id', 'id');
    }
}
