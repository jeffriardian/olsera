<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ItemRequest extends FormRequest
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
        $rules = [
            'tax_name' => 'required|array|min:2',
        ];

        if($this->isMethod('put')) {
            $rules += ['id' => 'required'];
            $rules += ['nama' => 'required'];
        }
        
        if($this->isMethod('post')) {
            $rules += ['nama' => 'required'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'tax_name.min' => 'Please fill min 2 items tax!'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
