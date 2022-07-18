<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $timestamps = false;
    protected $fillable = ['group_id', 'type' , 'question', 'hint', 'validation_rules', 'created_at'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s'
    ];
}
