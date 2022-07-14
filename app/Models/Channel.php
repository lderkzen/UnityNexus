<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['id', 'type_id', 'name'];

    public function ChannelType() {
        return $this->belongsTo(ChannelType::class, 'type_id', 'id');
    }

    public function Groups() {
        return $this->hasMany(Group::class, 'notification_channel_id', 'id');
    }
}
