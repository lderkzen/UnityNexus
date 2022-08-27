<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supergroup extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'position'];

    public function getGroupsAttribute()
    {
        return $this->groups()->get()->except(['supergroup_id']);
    }

    public function groups()
    {
        return $this->hasMany(Group::class, 'supergroup_id', 'id');
    }
}
