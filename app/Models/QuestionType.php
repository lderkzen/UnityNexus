<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['type'];

    public function questions()
    {
        return $this->hasMany(Question::class, 'type_id', 'id');
    }
}
