<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supergroup extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'position'];

    public function groups()
    {
        return $this->hasMany(Group::class, 'supergroup_id', 'id');
    }
}
