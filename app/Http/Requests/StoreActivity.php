<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TimeSpeedRule;

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
            'type' => 'required|in:text,timespeed',
            'title' => 'required|string',
            'default_value' => 'required|numeric',
            'target' => [
                'required',
                new TimeSpeedRule(request()->type),
            ],
            'can_change' => 'required|boolean',
            'use_textfield' => 'required|boolean',
            'color' => 'required|string',
        ];
    }
}
