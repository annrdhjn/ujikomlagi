<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJenisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_jenis' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama_jenis.required' => 'Data nama menu belum diisi'
        ];
    }
}
