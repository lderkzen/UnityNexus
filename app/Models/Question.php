<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $timestamps = false;
    protected $fillable = ['group_id', 'type_id', 'position' , 'question', 'hint', 'validation_rules'];

    public function getTypeAttribute()
    {
        $this->type = $this->type()->firstOrFail()->type;
        unset($this->type);
        return $this;
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
