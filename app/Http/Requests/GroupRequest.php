<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
{
    public function authorize()
    {
        // TODO: Only allow this action to be performed by Coordinators and above.
        return true;
    }

    public function rules()
    {
        return [
            'supergroup_id' => ['nullable', 'numeric', 'min:1', 'max:9223372036854775807', 'exists:supergroups,id'],
            'channel_id' => ['nullable', 'numeric', 'min:1', 'max:9223372036854775807', 'exists:channels,id'],
            'name' => ['string', 'min:3', 'max:100'],
            'description' => ['nullable', 'string'],
            'recruiting' => ['boolean'],
            'position' => ['numeric', 'min:0', 'max:32767']
        ];
    }
}
