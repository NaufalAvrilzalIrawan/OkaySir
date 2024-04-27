<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ProdukRequest extends FormRequest
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
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => "Nama harus terisi",
            'nama.string' => "Nama harus berupa karakter",

            'harga.required' => "Harga harus terisi",
            'harga.numeric' => "Harga harus berbentuk nomor",

            'stok.required' => "Stok harus terisi",
            'stok.integer' => "Stok harus berbentuk nomor"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return response()->json($validator->errors(), 422);
    }
}
