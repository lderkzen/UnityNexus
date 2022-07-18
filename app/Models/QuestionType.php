<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'type';
    protected $fillable = ['type'];
}
