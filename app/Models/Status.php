<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $timestamps = false;
    protected $fillable = ['status'];

    public function submissions()
    {
        return $this->hasMany(ApplicationSubmission::class, 'status_id', 'id');
    }
}
