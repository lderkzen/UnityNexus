<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supergroup extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
}
