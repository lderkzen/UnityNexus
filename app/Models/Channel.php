<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public $timestamps = false;
    protected $fillable = ['type_id', 'parent_id', 'name'];

    public function getTypeAttribute()
    {
        return $this->type()->firstOrFail();
    }

    public function getParentAttribute()
    {
        return $this->parent()->first();
    }

    public function type()
    {
        return $this->belongsTo(ChannelType::class, 'type_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Channel::class, 'parent_id', 'id');
    }

    public function groups()
    {
        return $this->hasMany(Group::class, 'channel_id', 'id');
    }
}
