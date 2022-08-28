<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supergroup extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'position'];

    public function getGroupsAttribute()
    {
        return $this->groups()->orderBy('position')->get()->except(['supergroup_id']);
    }

    public function groups()
    {
        return $this->hasMany(Group::class, 'supergroup_id', 'id');
    }
}
