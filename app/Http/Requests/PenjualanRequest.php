<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class PenjualanRequest extends FormRequest
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
            'total' => 'required|numeric',
            'totalAkhir' => 'required|numeric',
            'bayar' => 'required|numeric',
            'kembalian' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'total.required' => "Total harus terisi",
            'total.numeric' => "Total harus berbentuk nomor",

            'totalAkhir.required' => "Total Akhir harus terisi",
            'totalAkhir.numeric' => "Total Akhir harus berbentuk nomor",

            'bayar.required' => "bayar harus terisi",
            'bayar.numeric' => "bayar harus berbentuk nomor",

            'kembalian.required' => "kembalian harus terisi",
            'kembalian.numeric' => "kembalian harus berbentuk nomor",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return response()->json($validator->errors(), 422);
    }
}
