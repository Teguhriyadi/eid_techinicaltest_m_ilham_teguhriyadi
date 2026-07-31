<?php

namespace App\Http\Requests\Produksi;

use App\Models\Mesin;
use App\Models\ProduksiLog;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    protected function prepareForValidation(): void
    {
        $this->merge([
            'mesin_id' => trim((string) $this->mesin_id),
            'operator_id' => trim((string) $this->operator_id),
        ]);
    }

    public function rules(): array
    {
        return [
            'mesin_id' => [
                'required',
                'exists:mesin,id',
            ],

            'operator_id' => [
                'required',
                'exists:operator,id',
            ],

            'tanggal_produksi' => [
                'required',
                'date',
            ],

            'shift' => [
                'required',
                Rule::in(ProduksiLog::SHIFT),
            ],

            'jumlah_produksi' => [
                'required',
                'integer',
                'min:1',
            ],

            'temperatur' => [
                'required',
                'numeric',
                'between:0,999.99',
            ],

            'status' => [
                'required',
                Rule::in(Mesin::STATUS),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'mesin_id.required' => 'Mesin wajib dipilih.',
            'mesin_id.exists' => 'Mesin tidak ditemukan.',

            'operator_id.required' => 'Operator wajib dipilih.',
            'operator_id.exists' => 'Operator tidak ditemukan.',

            'tanggal_produksi.required' => 'Tanggal produksi wajib diisi.',
            // 'tanggal_produksi.date' => 'Tanggal produksi tidak valid.',

            'shift.required' => 'Shift wajib dipilih.',
            'shift.in' => 'Shift tidak valid.',

            'jumlah_produksi.required' => 'Jumlah produksi wajib diisi.',
            'jumlah_produksi.integer' => 'Jumlah produksi harus berupa angka.',
            'jumlah_produksi.min' => 'Jumlah produksi minimal 1.',

            'temperatur.required' => 'Temperatur wajib diisi.',
            'temperatur.numeric' => 'Temperatur harus berupa angka.',
            'temperatur.between' => 'Temperatur maksimal 999.99 °C.',

            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ];
    }
}
