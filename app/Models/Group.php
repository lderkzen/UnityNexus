<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'supergroup_id', 'application_form_id', 'notification_channel_id', 'recruiting', 'created_at', 'deleted_at'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function Supergroup() {
        return $this->belongsTo(Supergroup::class, 'supergroup_id', 'id');
    }

    public function Channel() {
        return $this->belongsTo(Channel::class, 'channel_id', 'id');
    }
}
