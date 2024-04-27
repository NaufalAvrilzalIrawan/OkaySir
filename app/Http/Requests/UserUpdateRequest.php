<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string|min:8'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Nama harus terisi",
            'name.string' => "Nama harus berupa karakter",

            'email.required' => "Email harus terisi",
            'email.email' => "Format email salah",

            'password.string' => "password harus berupa karakter",
            'password.min' => "password minimal terdiri dari :min karakter"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return response()->json($validator->errors(), 422);
    }
}
