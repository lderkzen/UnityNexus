<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicationSubmissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'public' => ['sometimes', 'boolean'],
            'age' => ['sometimes', 'numeric', 'min:1', 'max:9223372036854775807'],
            'location' => ['sometimes', 'string', 'min:1', 'max:255'],
            'answers' => ['sometimes', 'array']
        ];
    }
}
