<?php

namespace App\Http\Requests;

use App\Models\Group;
use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationSubmissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $group = Group::where('id', '=', $this->route('group')->id)->withCount('form')->firstOrFail();

        return [
            'public' => ['boolean'],
            'age' => ['required', 'numeric', 'min:1', 'max:9223372036854775807'],
            'location' => ['required', 'string', 'min:1', 'max:255'],
            'answers' => ['required', 'array', 'size:' . $group->form_count]
        ];
    }
}
