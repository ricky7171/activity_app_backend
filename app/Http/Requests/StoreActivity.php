<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

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
            'title' => 'required|string',
            'default_value' => 'required|numeric',
            'target' => 'required|numeric',
            'can_change' => 'required|boolean',
            'use_textfield' => 'required|boolean',
            'description' => 'required|string',
            'color' => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator) {
        dd($validator->errors());
    }
}
