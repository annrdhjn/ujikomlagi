<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMejaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'no_meja' => 'required',
            'kapasitas' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'no_meja.required' => 'Nomor meja belum diisi',
            'kapasitas.required' => 'Data kapasitas meja belum diisi',
            'status.required' => 'Data status meja belum diisi'
        ];
    }
}
