<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationForm extends Model
{
    protected $fillable = ['created_at'];
    protected $casts = [
        'created_at' => 'Y-m-d H:i:s'
    ];

    public function Group() {
        return $this->belongsTo(Group::class, 'application_form_id', 'id');
    }

    public function ApplicationFormResponses() {
        return $this->hasMany(ApplicationFormResponse::class, 'application_form_id', 'id');
    }
}
