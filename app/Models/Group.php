<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = ['supergroup_id', 'channel_id', 'name', 'description', 'recruiting', 'position'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
        'channel_id' => 'string'
    ];

    public function getSupergroupAttribute()
    {
        return $this->supergroup()->firstOrFail();
    }

    public function getChannelAttribute()
    {
        return $this->channel()->firstOrFail();
    }

    public function getFormAttribute()
    {
        return $this->form()->orderBy('position', 'asc')->get()->append(['type'])->except(['group_id']);
    }

    public function supergroup()
    {
        return $this->belongsTo(Supergroup::class, 'supergroup_id', 'id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id', 'id');
    }

    public function form()
    {
        return $this->hasMany(Question::class, 'group_id', 'id');
    }

    public function submissions()
    {
        return $this->hasMany(ApplicationSubmission::class, 'group_id', 'id');
    }
}
