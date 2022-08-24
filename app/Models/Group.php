<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    protected $fillable = ['supergroup_id', 'channel_id', 'name', 'description', 'recruiting', 'position'];

    public function getFormAttribute()
    {
        return $this->form = $this->form()->get()->except(['group_id'])->append(['type']);
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
