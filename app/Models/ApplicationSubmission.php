<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationSubmission extends Model
{
    protected $fillable = ['group_id', 'applicant_id', 'assigned_id', 'status_id', 'public', 'age', 'location', 'refinement_since', 'attempts'];

    public function getGroupAttribute() {
        return $this->group()->firstOrFail();
    }

    public function getApplicantAttribute() {
        return $this->applicant()->firstOrFail();
    }

    public function getAssignedAttribute() {
        return $this->assigned()->firstOrFail();
    }

    public function getStatusAttribute() {
        return $this->status()->firstOrFail();
    }

    public function getAnswersAttribute()
    {
        return $this->answers()->get()->except(['application_submission_id']);
    }

    public function getAnswersWithFeedbackAttribute()
    {
        return $this->answers()->get()->append(['feedback'])->except(['application_submission_id']);
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function applicant()
    {
        return $this->belongsTo(User::class, 'applicant_id', 'id');
    }

    public function assigned()
    {
        return $this->belongsTo(User::class, 'assigned_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'application_submission_id', 'id');
    }
}
