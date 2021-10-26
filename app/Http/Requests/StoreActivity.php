<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\SpeedrunRule;

class StoreActivity extends FormRequest
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
            'type' => 'required|in:value,count,speedrun,alarm,badhabit',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'value' => [
                'required_if:type,value,speedrun',
                new SpeedrunRule(request()->type)
            ],
            'target' => 'required_unless:type,alarm|numeric',
            'can_change' => 'required_if:type,value|boolean',
            // 'use_textfield' => 'required|boolean',
            'color' => 'required|string',
            'increase_value' => 'nullable|required_unless:count,speedrun|numeric|min:1',
            'is_hide' => 'required|boolean',
        ];
    }
}
