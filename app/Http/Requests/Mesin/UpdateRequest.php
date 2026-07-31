<?php

namespace App\Http\Requests\Mesin;

use App\Models\Mesin;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    protected function prepareForValidation(): void
    {
        $this->merge([
            'kode_mesin' => strtoupper(trim($this->kode_mesin)),
            'nama_mesin' => trim($this->nama_mesin),
        ]);
    }

    public function rules(): array
    {
        return [
            'kode_mesin' => [
                'required',
                'string',
                'max:20',
                Rule::unique('mesin', 'kode_mesin')->ignore($this->route('id')),
            ],
            'nama_mesin' => 'required|string|max:100',
            'status' => [
                'required',
                Rule::in(Mesin::STATUS),
            ],

            'temperatur' => [
                'required',
                'numeric',
                'between:0,999.99',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'kode_mesin.required' => 'Kode mesin wajib diisi.',
            'kode_mesin.unique' => 'Kode mesin sudah digunakan.',
            'nama_mesin.required' => 'Nama mesin wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
            'temperatur.required' => 'Temperatur wajib diisi.',
            'temperatur.numeric' => 'Temperatur harus berupa angka.',
            'temperatur.between' => 'Temperatur harus berada di antara 0 - 999.99 °C.',
        ];
    }
}
