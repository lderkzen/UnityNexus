<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['group_id', 'type_id', 'position' , 'question', 'hint', 'validation_rules'];

    public function getGroupAttribute()
    {
        return $this->group()->firstOrFail();
    }

    public function getTypeAttribute()
    {
        return $this->type()->firstOrFail();
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(QuestionType::class, 'type_id', 'id');
    }
}
