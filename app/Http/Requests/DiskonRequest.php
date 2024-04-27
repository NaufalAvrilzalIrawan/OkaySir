<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class DiskonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nominal' => 'required|numeric',
            'persen' => 'required|integer|max:100',
        ];
    }

    public function messages()
    {
        return [
            'nominal.required' => "Nominal harus terisi",
            'nominal.numeric' => "Nominal harus berbentuk nomor",

            'persen.required' => "Diskon harus terisi",
            'persen.integer' => "Diskon harus berbentuk nomor",
            'persen.max' => "Diskon tidak boleh lebih dari :max"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return response()->json($validator->errors(), 422);
    }
}
