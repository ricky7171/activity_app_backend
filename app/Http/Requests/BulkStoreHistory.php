<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;


class BulkStoreHistory extends FormRequest
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
            'activity_id' => 'required|integer|exists:activities,id',
            'history.*.date' => 'required|date_format:Y-m-d',
            'history.*.time' => 'required|date_format:H:i:s',
            'history.*.value' => 'required_without:history.*.value_textfield|numeric',
            'history.*.value_textfield' => 'string',
        ];
    }

    protected function failedValidation(Validator $validator) {
        dd($validator->errors());
    }
}
