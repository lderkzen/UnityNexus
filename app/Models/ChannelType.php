<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChannelType extends Model
{
    protected $fillable = ['id', 'name'];

    public function Channels() {
        return $this->hasMany(Channel::class, 'type_id', 'id');
    }
}
