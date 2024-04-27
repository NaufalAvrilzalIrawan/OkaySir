<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class DetailRequest extends FormRequest
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
            'penjualanID' => 'required|integer',
            'produkID' => 'required|integer',
            'namaMember' => 'required|string',
            'jumlah' => 'required|integer',
            'subtotal' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'penjualanID.required' => "penjualanID harus terisi",
            'penjualanID.integer' => "penjualanID harus berupa karakter",

            'produkID.required' => "produkID harus terisi",
            'produkID.integer' => "produkID harus berupa karakter",

            'namaMember.required' => "Nama Member harus terisi",
            'namaMember.string' => "Nama Member harus berupa karakter",
            
            'jumlah.required' => "Jumlah harus terisi",
            'jumlah.integer' => "Jumlah harus berbentuk nomor",

            'subtotal.required' => "subtotal harus terisi",
            'subtotal.numeric' => "subtotal harus berbentuk nomor",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return response()->json($validator->errors(), 422);
    }
}