<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'nomorTelepon' => 'required|numeric|digits_between:10,15',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => "Nama harus terisi",
            'nama.string' => "Nama harus berupa karakter",

            'alamat.required' => "Alamat harus terisi",
            'alamat.string' => "Alamat harus berupa karakter",

            'nomorTelepon.required' => "Nomor telepon harus terisi",
            'nomorTelepon.numeric' => "Nomor telepon berupa nomor",
            'nomorTelepon.digits_between' => "Nomor telepon tidak boleh lebih dari 10 - 15"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return response()->json($validator->errors(), 422);
    }
}
