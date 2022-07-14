<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationFormResponse extends Model
{
    use SoftDeletes;

    protected $fillable = ['response', 'accepted', 'assigned_user_id', 'created_at'];
    protected $casts = [
        'response' => 'array',
        'created_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function User() {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function AssignedUser() {
        return $this->hasOne(User::class, 'assigned_user_id', 'id');
    }

    public function ApplicationForm() {
        return $this->belongsTo(ApplicationForm::class, 'application_form_id', 'id');
    }
}
