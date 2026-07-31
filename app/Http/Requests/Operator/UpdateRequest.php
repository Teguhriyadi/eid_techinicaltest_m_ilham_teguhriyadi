<?php

namespace App\Http\Requests\Operator;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    protected function prepareForValidation(): void
    {
        $this->merge([
            'nama' => trim($this->nama)
        ]);
    }

    public function rules(): array
    {
        return [
            'nama' => [
                'required',
                'string',
                'max:100',
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama operator wajib diisi.',
            'nama.max' => 'Nama operator maksimal 100 karakter.'
        ];
    }
}
