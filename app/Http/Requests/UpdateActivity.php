<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateActivity extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|in:value,count,speedrun',
            'description' => 'nullable|string',
            'title' => 'required|string',
            'value' => [
                'required',
                new SpeedrunRule(request()->type)
            ],
            'target' => 'required|numeric',
            'can_change' => 'boolean',
            // 'use_textfield' => 'boolean',
            'color' => 'string',
        ];
    }
}
