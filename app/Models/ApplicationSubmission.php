<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationSubmission extends Model
{
    protected $fillable = ['group_id', 'applicant_id', 'assigned_id', 'status_id', 'public', 'age', 'location', 'refinement_since', 'attempts'];

    public function getGroupAttribute() {
        $this->group = $this->group()->firstOrFail();
        unset ($this->group_id);
        return $this;
    }

    public function getApplicantAttribute() {
        $this->applicant = $this->applicant()->firstOrFail();
        unset ($this->applicant_id);
        return $this;
    }

    public function getAssignedAttribute() {
        $this->assigned = $this->assigned()->firstOrFail();
        unset ($this->assigned_id);
        return $this;
    }

    public function getStatusAttribute() {
        $this->status = $this->status()->firstOrFail();
        unset ($this->status_id);
        return $this;
    }

    public function getAnswersAttribute() {
        return $this->answers = $this->answers()->get()->except(['application_submission_id']);
    }

    public function getAnswersWithFeedbackAttribute() {
        return $this->answers = $this->answers()->get()->except(['application_submission_id'])->append(['feedback']);
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
