<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $timestamps = false;
    protected $fillable = ['application_submission_id', 'question_id', 'question', 'answer'];

    public function getFeedbackAttribute()
    {
        return $this->feedback()->get()->except(['answer_id']);
    }

    public function getQuestionAttribute()
    {
        return Question::find($this->question_id);
    }

    public function submission()
    {
        return $this->belongsTo(ApplicationSubmission::class, 'application_submission_id', 'id');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'answer_id', 'id');
    }
}
