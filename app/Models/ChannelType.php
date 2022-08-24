<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChannelType extends Model
{
    public $timestamps = false;
    protected $fillable = ['id', 'type'];

    public function channels()
    {
        return $this->hasMany(Channel::class, 'type_id', 'id');
    }
}
