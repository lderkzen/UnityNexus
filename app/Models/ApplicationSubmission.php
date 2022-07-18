<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationSubmission extends Model
{
    use SoftDeletes;

    protected $fillable = ['group_id', 'applicant_id', 'assigned_user_id', 'status', 'refinement_since', 'public', 'attempts', 'created_at', 'updated_at', 'answered_at', 'answers_updated_at', 'deleted_at'];
    protected $casts = [
        'refinement_since' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'answered_at' => 'datetime:Y-m-d H:i:s',
        'answers_updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];
}
